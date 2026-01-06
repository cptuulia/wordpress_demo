<?php
include_once(__DIR__ . '/style/admin.php');
$options = get_option('ta_mollie_plugin_options');
$clientId = $options["client_id"];
?>
<script>
    class TantonniusAdminMollieClients {

        constructor() {
            this.getClients();
        }
        /**
         * Get clients
         */
        getClients() {
            jQuery.get("/wp-content/plugins/tantonius-mollie/api/getclients.php", function(data, status) {
                let rowClass = "oneven";
                jQuery('#LoadingMollieClients').hide();
                jQuery(data).each(function(index) {
                    rowClass = rowClass == "oneven" ? "" : "oneven";
                    let customerLink = 'https://my.mollie.com/dashboard/<?php echo $clientId ?>' +
                        '/customers/' + this.customer_id
                    customerLink = '<a href="' + customerLink + '" target="_blank"><span class="dashicons dashicons-visibility"></span></span></a>'

                    let cancelLink = '/wp-content/plugins/tantonius-mollie/pages/cancel.php?cancelsubscription=' + this.customer_id
                    cancelLink = '<a href="' + cancelLink + '" target="_blank"><span class="dashicons dashicons-trash"></span></a>'

                    let newRow = '<tr class ="' + rowClass + '">'
                    newRow += '<td>' + this.name + '</td>';
                    newRow += '<td>' + this.email + '</td>';
                    newRow += '<td>' + this.customer_id + '</td>';
                    newRow += '<td>' + customerLink + '&nbsp;&nbsp;' + cancelLink + '</td>';
                    newRow += '</tr>';

                    jQuery("#TantoniusAdmniMollieClientRows").append(newRow);
                })
            });
        }
    }


    jQuery(document).ready(function() {
        let tantonniusAdminMollieClients = new TantonniusAdminMollieClients();
    });
</script>
<h1>Mollie Clients</h1>


<div class='slidehowAdminPage'>
    <table class="slideshowIndex">
        <thead>
            <th>Name</th>
            <th>Email</th>
            <th>ID</th>
            <th></th>
        </thead>
        <tbody id="TantoniusAdmniMollieClientRows">
        </tbody>
    </table>
    <div id='LoadingMollieClients'><img src="/wp-content/plugins/tantonius-mollie/images/hourglass.gif"> Loading clients from Mollie server...</div>
</div>