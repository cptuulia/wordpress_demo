<?php $confirmFields = [
    ['trns' => '__FIRST_NAME__', 'id' => 'senderFirstName'],
    ['trns' => '__FAMILY_NAME__',  'id' => 'senderLastName'],
    ['trns' => '__EMAIL__',   'id' => 'senderEmail'],
    ['trns' => '__AMOUNT_EUR__',   'id' => 'amount'],
    ['trns' => '__PERIOD__',   'id' => 'intervalName'],
    ['trns' => '__PAYMENT_METHOD__', 'id' => 'paymentMethod'],

]
?>
<div id="taMollieRecurringPaymentFormConfirmation">
    <h5><?php echo TaMollieTranslations::trns('__CONFIRM__') ?></h5>
    <?php foreach ($confirmFields as $confirmField) : ?>
        <p> <?php echo TaMollieTranslations::trns($confirmField['trns']) ?>:&nbsp;
            <span id='taMollieRecurringPaymentFormConfirmation_<?php echo TaMollieTranslations::trns($confirmField['id']) ?>'>
            </span>
        </p>
        <div style="clear: both;"></div>
    <?php endforeach ?>
    <p>&nbsp;</p>
    <div style="clear: both;"></div>
    <span id= 'taMollieCancelConfirmMandateInfo'> <?php echo TaMollieTranslations::trns('__MANDATE_INFO__'); ?><br>&nbsp;<br>
   </span>
   
    <input type="submit" id="taMollieCancelConfirmButton" value="<?php echo TaMollieTranslations::trns('__BACK__') ?>" />
    <input type="submit" id="taMollieConfirmButton" value="<?php echo TaMollieTranslations::trns('__SEND__') ?>" />

</div>