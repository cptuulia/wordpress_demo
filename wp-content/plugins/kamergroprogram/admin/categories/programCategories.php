
<?php

use Kamergro\Controllers\CategoryController;


if (!class_exists('KamergroProgramCategories')) {

    class KamergroProgramCategories
    {
        /**
         *  Delete
         */
        public static function delete(): void {

              $params = [
                'localCall' => 1,
                'id' => $_GET["delete"]
            ];

            (new CategoryController($params))->destroy();
        }

        /**
         * Get an item
         */
        public static function get(): array
        {
            return self::getFromDatabase();
        }


        /**
         * Get item from database
         */
        private static function getFromDatabase(): array
        {
            $params = ['localCall' => 1];

            $categories = (new CategoryController($params))->index($params);
            return [
                'categories' => $categories,
                'errors' => [],
            ];
        }
    }
}
