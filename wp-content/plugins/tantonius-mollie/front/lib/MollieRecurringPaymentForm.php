<?php

    class MollieRecurringPaymentForm
    {

        /**
         * Se locale to en_GB on english pages
         */
        public static function setlocale(): void
        {
            if (str_contains($_SERVER["REQUEST_URI"], '/en/')) {
                TaMollieTranslations::setLocale('en_GB');
            }
        }

        /**
         * Get wp-options for this plugin
         */
        public static function options(): array
        {
            global $wpdb;
            $sql = 'select * from wp_options where option_name = %s';
            $sql = $wpdb->prepare($sql, 'ta_mollie_plugin_options');
            $result = $wpdb->get_results($sql);
            $options = unserialize($result[0]->option_value);
            return $options;
        }

    }

