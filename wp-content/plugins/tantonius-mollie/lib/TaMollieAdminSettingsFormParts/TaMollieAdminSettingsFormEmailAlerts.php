<?php

/**
 * @property string $wpOptionName
 * @property string $pluginSectionName
 */
trait TaMollieAdminSettingsFormEmailAlerts
{
    /**
     * Register API section in the form
     */
    public static function registerMollieClientEmailAlertsSection()
    {

        $apiSettingSectionKey = 'email_alert_settings';

        add_settings_section(
            $apiSettingSectionKey,
            'Email alerts ',
            [self::class, 'mollieClientSettingsEmailAlertsSectionText'],
            self::$pluginSectionName
        );

        add_settings_field(
            self::$pluginSectionName . 'mollie_email_alert',
            'Subscriptions email',
            [self::class, 'mollieEmailAlertsEmail'],
            self::$pluginSectionName,
            $apiSettingSectionKey
        );

         add_settings_field(
            self::$pluginSectionName . 'mollie_error_email_alert',
            'Payment error email',
            [self::class, 'mollieErrorEmailAlertsEmail'],
            self::$pluginSectionName,
            $apiSettingSectionKey
        );
    }

    /**
     * Text 
     */
    public static function mollieClientSettingsEmailAlertsSectionText()
    {
        echo '<p>An email alert is sent to this address when a new subscription is done or a subscription is cancelled or an error occurs in the payment process..<br>';
    }


    /**
     * Field
     */
    public static  function mollieEmailAlertsEmail()
    {
        $options = get_option(self::$wpOptionName);
        $options['email_alert'] = isset($options['email_alert']) ? $options['email_alert'] : get_option('admin_email');


        echo '<input 
            id="mollieClientId" 
            name = "' . self::$wpOptionName . '[email_alert]" 
            type = "text" 
            value="' . esc_attr($options['email_alert']) . '" 
        >';
    }

     /**
     * Field
     */
    public static  function mollieErrorEmailAlertsEmail()
    {
        $options = get_option(self::$wpOptionName);
        $options['error_email_alert'] = isset($options['error_email_alert']) ? $options['email_alert'] : get_option('admin_email');
        echo '<span style ="font-size: small;">You can use several emails by separating them by comma (,)<br> Example: test1@test.com,test2@test.com</span><br>';

        echo '<input 
            id="mollieClientId" 
            name = "' . self::$wpOptionName . '[error_email_alert]" 
            type = "text" 
            value="' . esc_attr($options['error_email_alert']) . '" 
        >';
    }
}
