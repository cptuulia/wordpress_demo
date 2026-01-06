<?php
require_once __DIR__ . '/lib/MollieRecurringPaymentForm.php';
require_once __DIR__ . '/../lib/TaMollieTranslations.php';
require_once __DIR__ . '/js/taMollieForm.php';
require_once __DIR__ . '/style/taMollieForm.php';
?>


<script>
    jQuery(document).ready(function() {
        let tantoniusMollieFront = new TantoniusMollieFront()
    });
</script>

<?php

MollieRecurringPaymentForm::setlocale();
$redirectUrl = isset($_SERVER["HTTP_X_FORWARDED_PROTO"])
    ? $_SERVER["HTTP_X_FORWARDED_PROTO"] . '://' . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]
    : '';
?>
<?php include_once 'partials/form.php' ?>
<?php include_once 'partials/confirmation.php' ?>

<div id="taMollieRecurringPaymentFormRegistering">
    <img src="/wp-content/plugins/tantonius-mollie/images/hourglass.gif" style="width: 100px;">
    <p><?php echo TaMollieTranslations::trns('__REGISTERING__') ?></p>
</div>

<div id="taMollieRecurringPaymentFormConnecting">
    <img src="/wp-content/plugins/tantonius-mollie/images/hourglass.gif" style="width: 100px;">
    <p><?php echo TaMollieTranslations::trns('__CONNECTING__') ?></p>
</div>

<div id="taMollieRecurringPaymentFormSubscribing">
    <img src="/wp-content/plugins/tantonius-mollie/images/hourglass.gif" style="width: 100px;">
    <p> <?php echo TaMollieTranslations::trns('__SUBSCRIBING__') ?></p>
</div>

<div id="taMollieRecurringPaymentFormSuccess">
    <img src="/wp-content/plugins/tantonius-mollie/images/thanks.svg">
        <p><?php echo TaMollieTranslations::trns('__THANKS_FOR_DONATING__') ?></p>
</div>


<div id="taMollieRecurringPaymentFormAjaxError">
    <img src="/wp-content/plugins/tantonius-mollie/images/error-905.svg">
    <p><?php echo TaMollieTranslations::trns('__MOLLIE_ERROR__') ?></p>
</div>