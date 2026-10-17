<?php
require __DIR__ . '/includes/bootstrap.php';
require_once SITE_ROOT . '/includes/enquiry.php';

$sent   = isset($_GET['sent']);
$old    = [];
$errors = [];

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    [$old, $errors] = enquiry_validate($_POST);
    $stamp = form_stamp_status((string) ($_POST['_t'] ?? ''));
    $isBot = trim((string) ($_POST['company_site'] ?? '')) !== '' || $stamp === 'fast';

    if (!same_origin()) {
        $errors['form'] = 'The request could not be verified. Please try again from this page.';
    } elseif ($isBot) {
        // Pretend it worked; do not tell a bot what tripped the filter.
        header('Location: ' . url('contact') . '?sent=1', true, 303);
        exit;
    } elseif ($stamp === 'expired') {
        $errors['form'] = 'This form was open for too long. Your details are still here; please send it again.';
    } elseif (!$errors) {
        if (throttled()) {
            $errors['form'] = 'We have received several enquiries from your network already. Please call us instead.';
        } else {
            enquiry_deliver($old);
            header('Location: ' . url('contact') . '?sent=1', true, 303);
            exit;
        }
    }
    http_response_code($errors ? 422 : 200);
} elseif (isset($_GET['service']) && in_array($_GET['service'], service_options(), true)) {
    // Links such as "Ask about this service" preselect the service.
    $old['service'] = $_GET['service'];
}

$page = [
    'key'         => 'contact',
    'title'       => 'Contact and quotes',
    'description' => 'Request a written quote from ' . site('name') . ', or call us to talk through your move.',
    'noindex'     => $sent,
];
require SITE_ROOT . '/includes/header.php';
?>

<section class="page-head">
    <div class="wrap">
        <p class="eyebrow">Contact</p>
        <h1>Request a quote</h1>
        <p class="lead">Tell us what is moving and where. We will call you to confirm the details and send a written quote.</p>
    </div>
</section>

<section class="section section--tight">
    <div class="wrap contact-layout">
        <div class="contact-layout__form" id="enquiry">
            <?php if ($sent): ?>
                <div class="notice notice--success" role="status">
                    <h2>Thank you. Your enquiry has been received.</h2>
                    <p>We will contact you on the number you gave us. If it is urgent, call <a href="<?= e(tel_href()) ?>"><?= e((string) site('phone')) ?></a>.</p>
                    <p><a class="link-arrow" href="<?= e(url()) ?>">Back to the home page</a></p>
                </div>
            <?php else: ?>
                <?php if ($errors): ?>
                    <div class="notice notice--error" role="alert">
                        <p><strong><?= isset($errors['form']) ? e($errors['form']) : 'Please check the highlighted fields and send the form again.' ?></strong></p>
                    </div>
                <?php endif; ?>
                <?php $variant = 'full'; require SITE_ROOT . '/includes/enquiry-form.php'; ?>
            <?php endif; ?>
        </div>

        <aside class="contact-layout__aside">
            <h2 class="aside-title">Talk to us</h2>
            <dl class="contact-list">
                <div><dt>Phone</dt><dd><a href="<?= e(tel_href()) ?>"><?= e((string) site('phone')) ?></a></dd></div>
                <div><dt>WhatsApp</dt><dd><a href="<?= e(whatsapp_href('Hello, I would like a quote for a move.')) ?>" rel="noopener">Message us</a></dd></div>
                <div><dt>Email</dt><dd><a href="mailto:<?= e((string) site('email')) ?>"><?= e((string) site('email')) ?></a></dd></div>
                <?php if (address_line() !== ''): ?><div><dt>Office</dt><dd><?= e(address_line()) ?></dd></div><?php endif; ?>
                <?php if (site('hours') !== ''): ?><div><dt>Hours</dt><dd><?= e((string) site('hours')) ?></dd></div><?php endif; ?>
            </dl>

            <h2 class="aside-title">What happens next</h2>
            <ol class="next-steps">
                <li>We call you to confirm what is moving and the access at both ends.</li>
                <li>You receive a written quote. For larger moves we visit first.</li>
                <li>You confirm, and we fix the date and the crew.</li>
            </ol>
        </aside>
    </div>
</section>

<?php require SITE_ROOT . '/includes/footer.php'; ?>
