<?php

require_once __DIR__ . '/TaMollieAdminSettingsFormParts/TaMollieAdminSettingsFormPartsAccount.php';
require_once __DIR__ . '/TaMollieAdminSettingsFormParts/TaMollieAdminSettingsFormPartsEmails.php';
require_once __DIR__ . '/TaMollieAdminSettingsFormParts/TaMollieAdminSettingsFormEmailAlerts.php';
require_once __DIR__ . '/TaMollieAdminSettingsFormParts/TaMollieAdminSettingsFormPartsPaymentOptions.php';
require_once __DIR__ . '/TaMollieAdminSettingsFormParts/TaMollieAdminSettingsFormPartsPeriodOptions.php';
require_once __DIR__ . '/TaMollieAdminSettingsFormMailServerSettings.php';

class TaMollieAdminSettings
{
    use TaMollieAdminSettingsFormPartsAccount;
    use TaMollieAdminSettingsFormPartsEmails;
    use TaMollieAdminSettingsFormEmailAlerts;
    use TaMollieAdminSettingsFormPartsPaymentOptions;
    use TaMollieAdminSettingsFormPartsPeriodOptions;
    use TaMollieAdminSettingsFormMailServerSettings;

    /**
     * option_name in table wp_options
     */
    private static string $wpOptionName = 'ta_mollie_plugin_options';

    /**
     * Section name for this plugin *to be used in the form
     */
    private static string $pluginSectionName = 'ta_mollie_plugin_section';


    /**
     * Add setting page for this plugin
     * 
     * https://developer.wordpress.org/reference/functions/add_options_page/
     */
    public  static function addSettingsPage()
    {

        $pageTitle =  'Mollie';
        $menuName = 'Mollie Settings';
        $urlSlug = 'ta-mollie-settings';

        add_options_page(
            $pageTitle,
            $menuName,
            'manage_options',
            $urlSlug,
            [self::class, 'renderForm']
        );

        add_action('admin_init', [self::class, 'registerSection']);
        add_action('admin_init', [self::class, 'registerMollieClientSettingsSection']);
        add_action('admin_init', [self::class, 'registerMolliePaymentOptionsSection']);
        add_action('admin_init', [self::class, 'registerMolliePeriodOptionsSection']);
        add_action('admin_init', [self::class, 'registerMollieClientEmailsSection']);
        add_action('admin_init', [self::class, 'registerMollieClientEmailAlertsSection']);
        add_action('admin_init', [self::class, 'registerMollieClientEmailAlertsSection']);
        add_action('admin_init', [self::class, 'registerMollieClientServerSettingsSection']);
    }

    public static function renderForm()
    {
?>
        <style>
            #taMollieSettingsDiv .form-table {
                background-color: #c2e9ef !important;
                width: 1000px;
            }
        </style>
        <div id="taMollieSettingsDiv">
            <h2>Mollie Settings</h2>

            <form action="options.php" method="post">
                <?php
                settings_fields(self::$wpOptionName);
                do_settings_sections(self::$pluginSectionName);
                ?>
                <input name="submit" class="button button-primary" type="submit" value="<?php esc_attr_e('Save'); ?>" />
            </form>
        </div>
<?php
    }

    /**
     * Register the section of this plugin
     */
    public static function registerSection()
    {
        register_setting(self::$wpOptionName, self::$wpOptionName);
    }
}
