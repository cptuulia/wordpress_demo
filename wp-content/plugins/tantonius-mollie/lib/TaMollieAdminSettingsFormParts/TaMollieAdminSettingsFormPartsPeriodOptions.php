<?php

/**
 * @property string $wpOptionName
 * @property string $pluginSectionName
 */
trait TaMollieAdminSettingsFormPartsPeriodOptions
{

    private static array $periods = [
        'once',
        '1 month',
        '2 months',
        '3 months',
        '4 months',
        '6 months',
        '12 months',
    ];

    /**
     * Register API section in the form
     */
    public static function registerMolliePeriodOptionsSection()
    {
        $apiSettingSectionKey = 'period_option_settings';
        add_settings_section(
            $apiSettingSectionKey,
            'Payment period options',
            [self::class, 'periodOptionsSectionText'],
            self::$pluginSectionName
        );


        add_settings_field(
            self::$pluginSectionName . 'period_options',
            'Period options ',
            [self::class, 'periodOptions'],
            self::$pluginSectionName,
            $apiSettingSectionKey
        );
    }

    /**
     * Text to API section
     */
    public static function periodOptionsSectionText()
    {
        echo '<p>Here you can define the payment intervals.';
        echo ' Only the fields having a value are taken into account.';
        echo '</p>';
    }

    public static  function periodOptions()
    {
        echo '<table>';
        echo '<tr><th>Period</th></tr>';
        for ($index = 1; $index <= count(self::$periods); $index++) {
            self::periodOption($index);
        }
        echo '</table>';
    }

    private static function periodOption(int $index)
    {
        $options = get_option(self::$wpOptionName);
        
        $value = $options['period_option_' . $index];
        echo ('<tr><td>');
      
      

        $value = $options['period_option_interval' . $index];
        echo '<select id="molliePeriodOptionInterval_' . $index . '" 
         name="' . self::$wpOptionName . '[period_option_interval' . $index . ']" 
        />';
        echo '<option value="">Select</option>';
        foreach(self::$periods as $period) {
            $selected =  $value == $period ? ' selected ' : ' ';
            echo '<option value="'.$period.'"'.$selected.'>'.$period.'</option>';
        }
        echo '</select>';
        echo ('</td></tr>');
    }
}
