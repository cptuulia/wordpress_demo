<script>
    //ccc
    class TantoniusMollieFront {

        /**
         *  constructor
         */
        constructor() {
            this.initialize(this);
            this.initializeEvents(this);
        }

        /**
         * initialize 
         */
        initialize(thisObj) {

            <?php if (isset($_GET['mandatedone'])) : ?>
                jQuery('#taMollieRecurringPaymentFormSubscribing').show();
                jQuery.get("/wp-content/plugins/tantonius-mollie/api/subscribe.php", function(data, status) {
                    thisObj.showPaymentSuccess()
                }).fail(function() {
                    jQuery('#taMollieRecurringPaymentFormAjaxError').show();
                    jQuery('#taMollieRecurringPaymentFormSubscribing').hide();
                });;
                return;
            <?php endif ?>

            <?php if (isset($_GET['onetimepaymentdone'])) : ?>
                thisObj.showPaymentSuccess()
                return;
            <?php endif ?>

            jQuery('#taMollieRecurringPaymentForm').show();

        }

        /**
         * initializeEvents
         */
        initializeEvents(thisObj) {
            jQuery('#taMollieSubmitButton').on("click", function(event) {
                event.preventDefault();
                thisObj.validate(thisObj);
            })

            jQuery('#taMollieConfirmButton').on("click", function(event) {
                event.preventDefault();
                /* in demo  we stop here*/
                jQuery('#taMollieRecurringPaymentFormConfirmation').hide();
                jQuery('#taMollieRecurringPaymentFormSuccess').show();
                return;
                /* end demo */
                thisObj.register(thisObj);
            })

            jQuery('#taMollieCancelConfirmButton').on("click", function(event) {
                event.preventDefault();
                thisObj.cancelConfirm(thisObj);
            })

            jQuery('.TaMollieRecurringAmountChooseOption').on("click", function(event) {
                thisObj.selectPaymentAmountOption(this, thisObj);

            })
            jQuery('#taMollieRecurringPaymentFormOtherAmountDiv').on("click", function(event) {
                thisObj.selectPaymentOtherAmountOption(this, thisObj);
            })

            jQuery('.TaMollieRecurringPeriodChooseOption').on("click", function(event) {
                thisObj.selectPaymentPeriod(this, thisObj);
            })

            jQuery('.TaMollieRecurringPaymentMethodChooseOption').on("click", function(event) {
                thisObj.selectPaymentMethod(this, thisObj);
            })

        }

        /**
         * Register 
         */
        register(thisObj) {
            let interval = jQuery('[name="interval"]').val();
            let selector = (interval == 'once') ? '#taMollieRecurringPaymentFormConnecting' : '#taMollieRecurringPaymentFormRegistering';

            jQuery(selector).show();
            jQuery('#taMollieRecurringPaymentFormConfirmation').hide();

            var formDataObj = {};
            jQuery('#taMollieRecurringPaymentForm input').each(function(index, data) {
                var value = jQuery(this).val();
                var name = jQuery(this).attr('name');
                formDataObj[name] = value
            });
            let jsonData = JSON.stringify(formDataObj)


            let url = "/wp-content/plugins/tantonius-mollie/api/register.php"
            jQuery.post(url, {
                    'form': jsonData
                },
                function(data, status) {
                    window.location.href = data.link.payment_link;
                }).fail(function() {
                jQuery('#taMollieRecurringPaymentFormAjaxError').show();
                jQuery(selector).hide();
            });
        }

        /**
         * Validate
         * 
         */
        validate(thisObj) {

            jQuery('#taMollieRecurringPaymentFormErrorMessages').hide();
            jQuery('#taMollieRecurringPaymentFormEmailExistsError').hide();
           // jQuery("html, body").animate({
              //  scrollTop: 0
            //}, "slow");

            let isValid = true;
            let textFields = ['senderFirstName', 'senderLastName', 'senderEmail'];
            textFields.forEach(function(item) {
                let selector = 'input[name="' + item + '"]';
                jQuery(selector).removeClass('taMollieInputError');
                if (jQuery(selector).val() == '') {
                    jQuery(selector).addClass('taMollieInputError');
                    isValid = false;
                }
                if (item == 'senderEmail' && !thisObj.validateEmailFormat((jQuery(selector).val()))) {
                    jQuery(selector).addClass('taMollieInputError');
                    isValid = false;
                }
            });

            let radioFields = [{
                    inputId: '#taMollieRecurringPaymentFormAmount',
                    selector: '#TaMollieRecurringAmountChoose',
                    emptyValue: 4
                },
                {
                    inputId: '#taMollieRecurringPaymentFormInterval',
                    selector: '#TaMollieRecurringPeriodChoose',
                    emptyValue: ''
                },
                {
                    inputId: '#taMollieRecurringPaymentFormPaymentMethod',
                    selector: '#TaMollieRecurringPaymentMethodChoose',
                    emptyValue: ''
                },
            ];

            radioFields.forEach(function(item, index) {
                jQuery(item.selector).removeClass('taMollieInputError');
                if (jQuery(item.inputId).val() == item.emptyValue ||
                    (jQuery.isNumeric(item.emptyValue) && jQuery(item.inputId).val() <= item.emptyValue)) {
                    isValid = false;
                    jQuery(item.selector).addClass('taMollieInputError');
                }
            });


              if (isValid) {
                            thisObj.showConfirmationDiv(thisObj);
                        } else {
                            jQuery('#taMollieRecurringPaymentFormErrorMessages').show();
                        }
            return;

            // Check if e-mail is in use by ajax

            let interval = jQuery('[name="interval"]').val();
            if (interval != 'once') {
                jQuery('#taMollieRecurringPaymentFormSpinner').show();
                let selector = 'input[name="senderEmail"]';
                let email = jQuery(selector).val();
                let url = "/wp-content/plugins/tantonius-mollie/api/verifyEmail.php?email=" + email;
                jQuery.get(url,
                    function(data, status) {
                        jQuery('#taMollieRecurringPaymentFormSpinner').hide();
                        if (data.email_exists) {
                            jQuery('#taMollieRecurringPaymentFormEmailExistsError').show();
                            jQuery(selector).addClass('taMollieInputError');
                            isValid = false;
                        }

                        if (isValid) {
                            thisObj.showConfirmationDiv(thisObj);
                        } else {
                            jQuery('#taMollieRecurringPaymentFormErrorMessages').show();
                        }
                    });
            } else {
                if (isValid) {
                    thisObj.showConfirmationDiv(thisObj);
                } else {
                    jQuery('#taMollieRecurringPaymentFormErrorMessages').show();
                }
            }

        }



        /**
         * validateEmailFormat
         */
        validateEmailFormat(email) {
            var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            return emailReg.test(email);
        }

        /**
         * showConfirmationDiv
         */
        showConfirmationDiv(thisObj) {

            if (jQuery('#taMollieRecurringPaymentFormInterval').val() != 'once') {
                jQuery('#taMollieCancelConfirmMandateInfo').show();
            } else {
                jQuery('#taMollieCancelConfirmMandateInfo').hide();
            }

            jQuery('#taMollieRecurringPaymentFormConfirmation').show();
            jQuery('#taMollieRecurringPaymentForm').hide();
            jQuery('#taMollieRecurringPaymentForm input').each(function(d) {
                let selector = '#taMollieRecurringPaymentFormConfirmation_' + jQuery(this).attr('name');
                let value = jQuery(this).val();
                jQuery(selector).html(value);
            })
        }

        /**
         * showConfirmationDiv
         */
        cancelConfirm(thisObj) {
            jQuery('#taMollieRecurringPaymentFormConfirmation').hide();
            jQuery('#taMollieRecurringPaymentForm').show();
        }

        /**
         * selectPaymentAmountOption
         */
        selectPaymentAmountOption(button, thisObj) {
            let amount = jQuery(button).attr('rel');
            jQuery('.TaMollieRecurringAmountChooseOption').removeClass('selected');
            jQuery('#taMollieRecurringPaymentFormOtherAmountDiv').removeClass('selected');
            jQuery('#taMollieRecurringPaymentFormAmountDiv').hide();
            jQuery(button).addClass('selected');
            jQuery('#taMollieRecurringPaymentFormAmount').val(amount);
        }


        /**
         * selectPaymentOtherAmountOption
         */
        selectPaymentOtherAmountOption(button, thisObj) {

            jQuery('#taMollieRecurringPaymentFormAmountDiv').show();
            jQuery('.TaMollieRecurringAmountChooseOption').removeClass('selected');
            jQuery(button).addClass('selected');
        }

        /**
         * selectPaymentPeriod
         */
        selectPaymentPeriod(button, thisObj) {
            let period = jQuery(button).attr('rel');
            let periodName = jQuery(button).html();

            jQuery('#taMollieRecurringPaymentFormInterval').val(period);
            jQuery('#taMollieRecurringPaymentFormIntervalName').val(periodName);
            jQuery('.TaMollieRecurringPeriodChooseOption').removeClass('selected');
            jQuery(button).addClass('selected');
        }

        selectPaymentMethod(button, thisObj) {
            let method = jQuery(button).attr('rel');
            jQuery('#taMollieRecurringPaymentFormPaymentMethod').val(method);
            jQuery('.TaMollieRecurringPaymentMethodChooseOption').removeClass('selected');
            jQuery(button).addClass('selected');
        }

        /**
         * showPaymentSuccess
         */
        showPaymentSuccess() {
            jQuery('#taMollieRecurringPaymentFormSuccess').show();
            jQuery('#taMollieRecurringPaymentFormSubscribing').hide();
        }

    }
</script>