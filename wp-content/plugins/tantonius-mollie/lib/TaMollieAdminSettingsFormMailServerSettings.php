<?php

/**
 * @property string $wpOptionName
 * @property string $pluginSectionName
 */
trait TaMollieAdminSettingsFormMailServerSettings
{
    /**
     * Register API section in the form
     */
    public static function registerMollieClientServerSettingsSection()
    {

        $apiSettingSectionKey = 'mail_server_settings';

        add_settings_section(
            $apiSettingSectionKey,
            'Mail server ',
            [self::class, 'mollieClientSettingsServerSettingsSectionText'],
            self::$pluginSectionName
        );

        add_settings_field(
            self::$pluginSectionName . 'mollie_mail_server',
            'E-mail server',
            [self::class, 'mollieServerSettingsEmail'],
            self::$pluginSectionName,
            $apiSettingSectionKey
        );
    }

    /**
     * Text 
     */
    public static function mollieClientSettingsServerSettingsSectionText()
    {
        echo '<p>These are the settings same as your standard Wordpress setting in the section' .
            ' <a href="/wp-admin/options-writing.php" target="_blank">Write<br>';
    }


    /**
     * Field
     */
    public static  function mollieServerSettingsEmail()
    {


        echo 'Email server<br>';
        echo '<input 
            id="molliMailserverUrl" 
            name = "mailserver_url" 
            type = "text" 
            value="' . esc_attr(get_option('mailserver_url')) . '" 
        >';
        echo '<br>Port<br>';
        echo '<input 
            id="molliMailserverPort" 
            name = "mailserver_port" 
            type = "text" 
            value="' . esc_attr(get_option('mailserver_port')) . '" 
        >';

        echo '<br>Login name<br>';
        echo '<input 
            id="molliMailserverLogin" 
            name = "mailserver_login" 
            type = "text" 
            value="' . esc_attr(get_option('mailserver_login')) . '" 
        >';
        echo '<br>Password<br>';
        echo '<input 
            id="molliMailserverPass" 
            name = "mailserver_pass" 
            type = "password" 
            value="' . esc_attr(get_option('mailserver_pass')) . '" 
        >';
    }
}
