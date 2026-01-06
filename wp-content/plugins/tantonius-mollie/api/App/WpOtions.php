<?php

namespace App;

use App\TaDbConnect;

class WpOtions
{

    private static array $mollieOptions = [];
    private static array $mailServerOptions = [];

    public static function mollie(): array
    {
        if (empty(self::$mollieOptions)) {

            $sql = 'select option_value from wp_options where option_name = "ta_mollie_plugin_options"';
            $result = TaDbConnect::connect()->query($sql);
            $row = $result->fetch_assoc();
            $unserialized =  unserialize($row["option_value"]);
            self::$mollieOptions = $unserialized;
        }
        return self::$mollieOptions;
    }

    public static function mailServer(): array
    {
        if (empty(self::$mailServerOptions)) {
            $optionNames = '"mailserver_url","mailserver_port","mailserver_login","mailserver_pass"';
            $sql = 'select option_name, option_value from wp_options where option_name IN (' . $optionNames . ')';
            $result = TaDbConnect::connect()->query($sql);
            
            while ($row = $result->fetch_assoc()) {
                $key = str_replace('mailserver_', '', $row["option_name"]);
               self::$mailServerOptions[$key] = $row["option_value"];
            }
        }
        return self::$mailServerOptions;
    }
}
