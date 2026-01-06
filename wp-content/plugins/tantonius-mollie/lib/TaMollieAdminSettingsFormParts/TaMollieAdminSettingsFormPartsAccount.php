<?php

/**
 * @property string $wpOptionName
 * @property string $pluginSectionName
 */
trait TaMollieAdminSettingsFormPartsAccount
{


    /**
     * Register API section in the form
     */
    public static function registerMollieClientSettingsSection()
    {
        $apiSettingSectionKey = 'api_settings';

        add_settings_section(
            $apiSettingSectionKey,
            'Mollie account settings',
            [self::class, 'mollieClientSettingsSectionText'],
            self::$pluginSectionName
        );
        add_settings_field(
            self::$pluginSectionName . 'mollie_api_key',
            'API key',
            [self::class, 'mollieApiKey'],
            self::$pluginSectionName,
            $apiSettingSectionKey
        );

        add_settings_field(
            self::$pluginSectionName . 'mollie_client_id',
            'Client id',
            [self::class, 'mollieClientId'],
            self::$pluginSectionName,
            $apiSettingSectionKey
        );
    }

    /**
     * Text to API section
     */
    public static function mollieClientSettingsSectionText()
    {
        echo '<p>You find these settings in your Mollie account<br>';
    }

    public static  function mollieApiKey()
    {
        echo '<span style ="font-size: small;">Find this in your Mollie account in the " developers , Api Keys" section</span><br>';
        $options = get_option(self::$wpOptionName);

        echo '<input 
            id="mollieApiKey" 
            name = "' . self::$wpOptionName . '[mollie_api_key]" 
            type = "text" 
            value="' . esc_attr($options['mollie_api_key']) . '" 
        >';
    }

    public static  function mollieClientId()
    {
        echo '<span style ="font-size: small;">Find this in the  url like https://my.mollie.com/dashboard/org_XXXXXX</span><br>';
        $options = get_option(self::$wpOptionName);

        echo '<input 
            id="mollieClientId" 
            name = "' . self::$wpOptionName . '[client_id]" 
            type = "text" 
            value="' . esc_attr($options['client_id']) . '" 
        >';
    }
}
