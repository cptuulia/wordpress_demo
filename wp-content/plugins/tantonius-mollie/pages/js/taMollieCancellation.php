<script>
/**
 * 
 * Class to cancel a subscription
 * 
 */
    class TaMollieCancellation {
        /**
         * constructor
         */
        constructor() {
            this.customerId = undefined;
            this.getClientData()
            this.initializeEvents(this);
        }

        /**
         * getClientData
         */
        getClientData() {
            let url = "/wp-content/plugins/tantonius-mollie/api/getclient.php?customerId=<?php echo $_GET['cancelsubscription'] ?>"
            let thisObj = this;
            jQuery.get(url, function(data) {
                thisObj.renderClientData(data, thisObj);
            }).fail(function(data) {
                 jQuery('#taMollieRecurringPaymentFormQueringData').hide();
                if(data.status == 400) {
                    jQuery('#TaMollieNotFoundDiv').show();
                } else {
                     jQuery('#TaMollieErrordDiv').show();
                }
            });
        }

        /**
         * renderClientData
         */
        renderClientData(data, thisObj) {
            jQuery('#TaMollieCancelForm .name').html(data.name)
            thisObj.customerId = data.id;

            jQuery(data.subscriptions).each(function(index) {

                if (this.id == '<?php echo $subscriptionId ?>') {
                    jQuery('#TaMollieCancelForm .subscription').html(this.description)
                    let amount = this.amount.value + ' ' + this.amount.currency
                    jQuery('#TaMollieCancelForm .amount').html(amount)
                }

            });
             jQuery('#TaMollieCancelForm').show()
             jQuery('#taMollieRecurringPaymentFormQueringData').hide();
            this.initializeEvents(thisObj);
        }

        /**
         * initializeEvents
         */
        initializeEvents(thisObj) {

            jQuery('#TaMollieCancelButton').unbind('click');
            jQuery('#TaMollieCancelButton').on("click", function(event) {
                thisObj.cancelSubscription(thisObj)
            });
        }

        /**
         *  cancelSubscription
         */
        cancelSubscription(thisObj2) {
            jQuery('#taMollieRecurringPaymentFormCancelling').show();
            jQuery('#TaMollieCancelForm').hide();
            let url = "/wp-content/plugins/tantonius-mollie/api/unsubscribe.php";

            jQuery.post(url, {
                    customerId: thisObj2.customerId,
                },
                function(data, status) {
                    jQuery('#TaMollieCancelledDiv').show();
                    jQuery('#taMollieRecurringPaymentFormCancelling').hide();
                }).fail(function(data) {
                 jQuery('#taMollieRecurringPaymentFormQueringData').hide();
                if(data.status == 400) {
                    jQuery('#TaMollieNotFoundDiv').show();
                } else {
                     jQuery('#TaMollieErrordDiv').show();
                }
            });
        }
    }
</script>