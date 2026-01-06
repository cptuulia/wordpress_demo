<?php

/**
 * Cancel subscption page
 * open as
 * 
 * MY_DOMAIN/o/wp-content/plugins/tantonius-mollie/pages/cancel.php?cancelsubscription=CLIENT_ID
 * 
 * CLIENT_ID found in 
 * https://my.mollie.com/dashboard/org_19348379/customers/
 * 
 * To Test:
 * Check that the client has a row in table  ta_mollie_subscriptions
 * with the correct subscription_id
 * 
 * http://powerofreflection.ubuntuserver.io/wp-content/plugins/tantonius-mollie/pages/cancel.php?cancelsubscription=CLIENT_ID
 */
require_once(__DIR__ . '/../lib/TaMollieTranslations.php');
if (!isset($wpdb)) {
    require_once('../../../../wp-config.php');
    require_once('../../../../wp-includes/wp-db.php');
}

////////////////////////////////////////////////////////////////////////////////////////
global $wpdb;
$sql = 'select subscription_id from ta_mollie_subscriptions where customer_id = %s';
$sql = $wpdb->prepare($sql, $_GET['cancelsubscription']);

$result = $wpdb->get_results($sql);
$subscriptionId = current($result)->subscription_id;

////////////////////////////////////////////////////////////////////////////////////////


?>
<html class="no-js" lang="en-GB">

<head>
    <script src="/wp-includes/js/jquery/jquery.min.js?ver=3.7.1" id="jquery-core-js"></script>
    <script src="/wp-includes/js/jquery/jquery-migrate.min.js?ver=3.4.1" id="jquery-migrate-js"></script>
</head>
<?php require_once(__DIR__ . '/js/taMollieCancellation.php'); ?>

<script>
    jQuery(document).ready(function() {
        let TaMollieCancellationObj = new TaMollieCancellation();
    });
</script>

<style>
    .container {
        width: 25%;
        margin: auto;
    }

    .container .logo {
        width: 100%;
        background-color: #252525;
        padding: 20px;
    }

    #TaMollieCancelForm {
        display: none;
    }

    #TaMollieCancelButton {
        background-color: orange;
        color: white;
        width: fit-content;
        padding: 10px;
        border-radius: 5px;
        cursor: pointer;
    }

    #TaMollieCancelledDiv,
    #TaMollieNotFoundDiv,
    #TaMollieErrordDiv {
        display: none;
    }

    #taMollieRecurringPaymentFormCancelling {
        display: none;
    }
</style>

<body>
    <div class="container">
        <img src="/wp-content/plugins/tantonius-mollie/images/Logo-transparant-achtergrond.png" class="logo">
    </div>
    <div class="container beige">
       
        <?php include __DIR__ . '/partials/cancelForm.php' ?>

        <div id="taMollieRecurringPaymentFormQueringData">
            <img src="/wp-content/plugins/tantonius-mollie/images/hourglass.gif" style="width: 100px;">
        </div>

        <div id="taMollieRecurringPaymentFormCancelling">
            <img src="/wp-content/plugins/tantonius-mollie/images/hourglass.gif" style="width: 100px;">
            <p> Cancelling</p>
        </div>

        <div id="TaMollieCancelledDiv">
            <?php echo TaMollieTranslations::trns('__SUBCRIPTION_CANCELLED__'); ?>
        </div>

        <div id="TaMollieNotFoundDiv">
            <?php echo TaMollieTranslations::trns('__CLIENT_NOT_FOUND__'); ?>
        </div>

         <div id="TaMollieErrordDiv">
            <?php echo TaMollieTranslations::trns('__CANCEL_ERROR__'); ?>
        </div>
    </div>
</body>