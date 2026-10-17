<?php
/**
 * Enquiry form. Expects:
 *   $variant  'full' (contact page) or 'compact' (home page)
 *   $old      previously entered values
 *   $errors   field errors
 */
defined('SITE_ROOT') or exit;

$variant = $variant ?? 'full';
$old     = $old ?? [];
$errors  = $errors ?? [];
$id      = $variant === 'compact' ? 'q' : 'f';
$val     = static fn(string $k): string => e($old[$k] ?? '');

$field = static function (string $name, string $label, string $type, bool $required, array $extra = []) use ($id, $val, $errors): void {
    $has = isset($errors[$name]);
    $attrs = '';
    foreach ($extra as $k => $v) {
        $attrs .= ' ' . $k . '="' . e((string) $v) . '"';
    }
    ?>
    <div class="field<?= $has ? ' field--error' : '' ?>">
        <label for="<?= $id . '-' . $name ?>"><?= e($label) ?><?php if ($required): ?> <span class="req" aria-hidden="true">*</span><?php endif; ?></label>
        <input id="<?= $id . '-' . $name ?>" name="<?= $name ?>" type="<?= $type ?>" value="<?= $val($name) ?>"<?= $required ? ' required' : '' ?><?= $has ? ' aria-invalid="true" aria-describedby="' . $id . '-' . $name . '-err"' : '' ?><?= $attrs ?>>
        <?php if ($has): ?><p class="field__error" id="<?= $id . '-' . $name . '-err' ?>"><?= e($errors[$name]) ?></p><?php endif; ?>
    </div>
    <?php
};
?>
<form class="enquiry enquiry--<?= e($variant) ?>" method="post" action="<?= e(url('contact')) ?>" novalidate>
    <input type="hidden" name="_t" value="<?= e(form_stamp()) ?>">
    <div class="hp" aria-hidden="true">
        <label for="<?= $id ?>-company_site">Leave this field empty</label>
        <input id="<?= $id ?>-company_site" name="company_site" type="text" tabindex="-1" autocomplete="off">
    </div>

    <?php $field('name', 'Your name', 'text', true, ['autocomplete' => 'name', 'maxlength' => 80]); ?>
    <?php $field('phone', 'Phone number', 'tel', true, ['autocomplete' => 'tel', 'inputmode' => 'tel', 'maxlength' => 25]); ?>

    <div class="field-row">
        <?php $field('from', 'Moving from', 'text', false, ['placeholder' => 'City or area', 'maxlength' => 100]); ?>
        <?php $field('to', 'Moving to', 'text', false, ['placeholder' => 'City or area', 'maxlength' => 100]); ?>
    </div>

    <div class="field">
        <label for="<?= $id ?>-service">Service</label>
        <select id="<?= $id ?>-service" name="service">
            <option value="">Select a service</option>
            <?php foreach (service_options() as $option): ?>
                <option value="<?= e($option) ?>"<?= ($old['service'] ?? '') === $option ? ' selected' : '' ?>><?= e($option) ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <?php if ($variant === 'full'): ?>
        <div class="field-row">
            <?php $field('email', 'Email', 'email', false, ['autocomplete' => 'email', 'maxlength' => 120]); ?>
            <?php $field('date', 'Preferred date', 'date', false, ['min' => date('Y-m-d')]); ?>
        </div>
        <div class="field">
            <label for="f-message">Details</label>
            <textarea id="f-message" name="message" rows="5" maxlength="2000" placeholder="What is being moved, floor and lift at both ends, anything we should know."><?= $val('message') ?></textarea>
        </div>
    <?php endif; ?>

    <button class="btn btn--primary btn--block" type="submit">Request a quote</button>
    <p class="form-note">We use these details only to reply to your enquiry.</p>
</form>
