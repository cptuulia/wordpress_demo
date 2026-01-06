<?php

/**
 * @property string $wpOptionName
 * @property string $pluginSectionName
 */
trait TaMollieAdminSettingsFormPartsPaymentOptions
{


    /**
     * Register API section in the form
     */
    public static function registerMolliePaymentOptionsSection()
    {
        $apiSettingSectionKey = 'payment_option_settings';
        add_settings_section(
            $apiSettingSectionKey,
            'Payment options',
            [self::class, 'paymentOptionsSectionText'],
            self::$pluginSectionName
        );


        add_settings_field(
            self::$pluginSectionName . 'payment_options',
            'Payment options ',
            [self::class, 'paymentOptions'],
            self::$pluginSectionName,
            $apiSettingSectionKey
        );
    }

    /**
     * Text to API section
     */
    public static function paymentOptionsSectionText()
    {
        echo '<p>Here you can define the payment options.';
        echo ' Only the fields having a value are taken into account.';
        echo '</p>';
    }

    public static  function paymentOptions()
    {
        echo '<table>';
        echo '<tr><th>Amount (Eur)</th></tr>';
        for ($index = 1; $index <=10; $index++) {
            self::paymentOption($index);
        }
         echo '</table>';
    }



    private static function paymentOption(int $index)
    {
        $options = get_option(self::$wpOptionName);
       
        echo ('<tr><td>');
       
        $value = $options['payment_option_value' . $index];

        echo '<input id="molliePaymentOptionValue_' . $index . '" 
        type ="number"
         name="' . self::$wpOptionName . '[payment_option_value' . $index . ']"
         value ="' . esc_attr($value) . '"  
        />';
        echo ('</td></tr>');
    }
}
