<?php
declare(strict_types=1);

defined('SITE_ROOT') or exit;

/**
 * Enquiry form handling: validation, anti-spam and delivery.
 * No sessions are used, so the pages stay cacheable and no cookie is set.
 */

function clean_multiline(mixed $value, int $max): string
{
    $value = is_string($value) ? $value : '';
    // Drop control characters except newline and tab.
    $value = preg_replace('/[^\P{C}\n\t]/u', '', $value) ?? '';
    return mb_substr(trim($value), 0, $max);
}

function clean_line(mixed $value, int $max): string
{
    $value = preg_replace('/\s+/u', ' ', clean_multiline($value, $max * 2)) ?? '';
    return mb_substr(trim($value), 0, $max);
}

/** @return array{0: array<string,string>, 1: array<string,string>} cleaned values and errors */
function enquiry_validate(array $in): array
{
    $d = [
        'name'    => clean_line($in['name'] ?? '', 80),
        'phone'   => clean_line($in['phone'] ?? '', 25),
        'email'   => clean_line($in['email'] ?? '', 120),
        'service' => clean_line($in['service'] ?? '', 80),
        'from'    => clean_line($in['from'] ?? '', 100),
        'to'      => clean_line($in['to'] ?? '', 100),
        'date'    => clean_line($in['date'] ?? '', 10),
        'message' => clean_multiline($in['message'] ?? '', 2000),
    ];
    $errors = [];

    if (mb_strlen($d['name']) < 2) {
        $errors['name'] = 'Please enter your name.';
    }

    $digits = preg_replace('/\D+/', '', $d['phone']);
    if (strlen($digits) < 8 || strlen($digits) > 15 || preg_match('/[^0-9+\-\s()]/', $d['phone'])) {
        $errors['phone'] = 'Please enter a valid phone number.';
    }

    if ($d['email'] !== '' && !filter_var($d['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'This email address does not look right.';
    }

    if ($d['service'] !== '' && !in_array($d['service'], service_options(), true)) {
        $d['service'] = '';
    }

    if ($d['date'] !== '') {
        $date = DateTimeImmutable::createFromFormat('!Y-m-d', $d['date']);
        if (!$date || $date->format('Y-m-d') !== $d['date'] || $date < new DateTimeImmutable('today')) {
            $errors['date'] = 'Please choose a date from today onwards.';
        }
    }

    return [$d, $errors];
}

// ---- Anti-spam ------------------------------------------------------------

function form_secret(): string
{
    $secret = (string) site('secret');
    return $secret !== '' ? $secret : hash('sha256', SITE_ROOT . '|' . ($_SERVER['SERVER_NAME'] ?? ''));
}

/** Signed timestamp placed in the form, so we know how long it was open. */
function form_stamp(): string
{
    $time = time();
    return $time . '.' . hash_hmac('sha256', (string) $time, form_secret());
}

/** @return 'ok'|'fast'|'expired' */
function form_stamp_status(string $stamp): string
{
    [$time, $sig] = array_pad(explode('.', $stamp, 2), 2, '');
    if (!ctype_digit($time) || !hash_equals(hash_hmac('sha256', $time, form_secret()), $sig)) {
        return 'expired';
    }
    $age = time() - (int) $time;
    if ($age < 3) {
        return 'fast';
    }
    return $age > 6 * 3600 ? 'expired' : 'ok';
}

function same_origin(): bool
{
    $origin = $_SERVER['HTTP_ORIGIN'] ?? $_SERVER['HTTP_REFERER'] ?? '';
    if ($origin === '') {
        return true;
    }
    $from = parse_url($origin, PHP_URL_HOST);
    $self = parse_url('//' . ($_SERVER['HTTP_HOST'] ?? ''), PHP_URL_HOST);
    return $from !== null && $self !== null && strcasecmp((string) $from, (string) $self) === 0;
}

/** At most $max accepted enquiries per IP address in $window seconds. */
function throttled(int $max = 5, int $window = 3600): bool
{
    $dir = SITE_ROOT . '/storage/throttle';
    if (!is_dir($dir)) {
        @mkdir($dir, 0750, true);
    }
    $file = $dir . '/' . hash('sha256', $_SERVER['REMOTE_ADDR'] ?? 'unknown') . '.json';
    $now = time();
    $hits = is_file($file) ? (json_decode((string) @file_get_contents($file), true) ?: []) : [];
    $hits = array_values(array_filter($hits, static fn($t) => is_int($t) && $t > $now - $window));
    if (count($hits) >= $max) {
        return true;
    }
    $hits[] = $now;
    @file_put_contents($file, json_encode($hits), LOCK_EX);
    return false;
}

// ---- Delivery -------------------------------------------------------------

function enquiry_deliver(array $d): void
{
    // Keep a copy on disk so an enquiry is never lost if mail() fails.
    $record = json_encode(
        ['time' => date('c'), 'ip' => $_SERVER['REMOTE_ADDR'] ?? '', 'enquiry' => $d],
        JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
    );
    @file_put_contents(SITE_ROOT . '/storage/enquiries.log', $record . PHP_EOL, FILE_APPEND | LOCK_EX);

    $lines = [
        'Name:     ' . $d['name'],
        'Phone:    ' . $d['phone'],
        'Email:    ' . ($d['email'] ?: '-'),
        'Service:  ' . ($d['service'] ?: '-'),
        'From:     ' . ($d['from'] ?: '-'),
        'To:       ' . ($d['to'] ?: '-'),
        'Date:     ' . ($d['date'] ?: '-'),
        '',
        $d['message'] !== '' ? $d['message'] : '(no message)',
    ];

    $subject = 'New enquiry: ' . ($d['service'] ?: 'Quote request') . ' - ' . $d['name'];
    $fromName = str_replace(['"', '\\'], '', (string) site('name'));
    $headers = [
        'MIME-Version: 1.0',
        'Content-Type: text/plain; charset=UTF-8',
        'From: ' . mb_encode_mimeheader($fromName, 'UTF-8') . ' <' . site('mail_from') . '>',
    ];
    if ($d['email'] !== '') {
        $headers[] = 'Reply-To: ' . $d['email'];
    }

    @mail((string) site('mail_to'), mb_encode_mimeheader($subject, 'UTF-8'), implode("\r\n", $lines), implode("\r\n", $headers));
}
