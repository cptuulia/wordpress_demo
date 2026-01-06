<form method="post" id="taMollieRecurringPaymentForm">

    <div id="taMollieRecurringPaymentFormSpinner">
        <img src="/wp-content/plugins/tantonius-mollie/images/bouncing-circles.svg">
    </div>
    
  
    <input type="hidden" name="interval" value="" id="taMollieRecurringPaymentFormInterval">
    <input type="hidden" name="intervalName" value="" id="taMollieRecurringPaymentFormIntervalName">
    <input type="hidden" name="paymentMethod" value="" id="taMollieRecurringPaymentFormPaymentMethod">
    <div class="senderData">
        <p>&nbsp;</p>
        <div id="taMollieRecurringPaymentFormErrorMessages">
            <div> <?php echo TaMollieTranslations::trns('__PLEASE_CHECK_THE_FORM_FIELDS__') ?></div>
        </div>
        <div style="clear: both;"></div>
        <p> <?php echo TaMollieTranslations::trns('__FIRST_NAME__') ?> *</p>
        <input name='senderFirstName' value='' />
        <div style="clear: both;"></div>
        <p> <?php echo TaMollieTranslations::trns('__FAMILY_NAME__') ?> *</p>
        <input name='senderLastName' value='' />
        <div style="clear: both;"></div>
        <p> <?php echo TaMollieTranslations::trns('__EMAIL__') ?> *
            <span id="taMollieRecurringPaymentFormEmailExistsError">
                <br><?php echo TaMollieTranslations::trns('__EMAIL_EXISTS__') ?>
            </span>
        </p>
        <input name='senderEmail' value="" />
        <div style="clear: both;"></div>

        <p> <?php echo TaMollieTranslations::trns('__AMOUNT__') ?> *<br><small>min 5 Eur&nbsp;</small></p>
        <div id="TaMollieRecurringAmountChoose">
              <?php $options = MollieRecurringPaymentForm::options() ?>
            <?php foreach ($options as $key => $option) : ?>
           
                 <?php if (str_starts_with($key, 'payment_option_value') && $option != '') : ?>
                    <div rel="<?php echo $option ?>" class="TaMollieRecurringAmountChooseOption">
                        <?php echo $option ?> Eur
                    </div>
                <?php endif ?>
            <?php endforeach ?>
             <div id ="taMollieRecurringPaymentFormOtherAmountDiv">
                <?php echo TaMollieTranslations::trns('__OTHER_AMOUNT__') ?> 
            </div>
             <div id ="taMollieRecurringPaymentFormAmountDiv">
                <input type="number" name="amount"  maxlength="6" min="5" id="taMollieRecurringPaymentFormAmount" value="0">
            </div>
        </div>
        <div style="clear: both;"></div>


        <p> <?php echo TaMollieTranslations::trns('__PERIOD__') ?> *</p>
        <div id="TaMollieRecurringPeriodChoose">
            <?php foreach ($options as $key => $option) : ?>
                <?php if (str_starts_with($key, 'period_option_interval') && $option != '') : ?>
                    <div rel="<?php echo $option ?>" class="TaMollieRecurringPeriodChooseOption">
                      <?php echo  TaMollieTranslations::trns('__'. strtoupper($option) . '__') ?>
                    </div>
                <?php endif ?>
            <?php endforeach ?>
           
        </div>


        
        <div style="clear: both;"></div>

        <p><?php echo TaMollieTranslations::trns('__PAYMENT_METHOD__') ?> *</p>
        <div id="TaMollieRecurringPaymentMethodChoose">
            <div class="TaMollieRecurringPaymentMethodChooseOption" rel="creditcard">
                <img src="/wp-content/plugins/tantonius-mollie/images/credit-card.png">
            </div>
            <div class="TaMollieRecurringPaymentMethodChooseOption" rel="ideal">
                <img src="/wp-content/plugins/tantonius-mollie/images/ideal.png">
            </div>
        </div>
        
        <div style="clear: both;"></div>
        <p>&nbsp;</p>
        <input type="submit" id="taMollieSubmitButton" value="<?php echo TaMollieTranslations::trns('__SEND__') ?>" />
    </div>

    <div style="clear: both;"></div>
    <input type="hidden" name="mollieRedirectUrl" value="<?php echo $redirectUrl ?>">
    <br>
</form>
