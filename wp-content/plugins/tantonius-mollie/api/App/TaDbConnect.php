<?php

namespace App;

use mysqli;

class TaDbConnect
{

    private static ?mysqli $connectionObj = null;

    /**
     * Connect
     */
    public static function connect(): mysqli
    {
        if (is_null(self::$connectionObj)) {
            require_once($_SERVER["DOCUMENT_ROOT"] . '/wp-config.php');
            // Create connection
            self::$connectionObj = new \mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
        }

        return self::$connectionObj;
    }

    public static function toArray($result): array
    {
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row; 
        }
        return $rows;
    }
}
