<?php

use Kamergro\Controllers\CategoryController;
use Kamergro\Controllers\ItemController;

if (!class_exists('ProgramEditCategory')) {
    class ProgramEditCategory
    {
        /**
         *  Delete
         */
        public static function delete(): void
        {
            $params = [
                'localCall' => 1,
                'id' => $_GET["delete"]
            ];
            (new ItemController($params))->destroy($params);
        }

        /**
         * Save
         */
        public static function save(): array
        { 
            $result = (isset($_POST['id']))
                ? (new CategoryController($_POST))->update($_POST)
                : (new CategoryController($_POST))->store($_POST);

            if (!isset($result['errors'])) {

                $categoryItem = $result['data'][0];
                $url = '/wp-admin/admin.php?page=program%2Fprogram';
                echo '<script>window.location.href = "' . $url . '";</script>';
                die;
            }

            return [
                'category' => $_POST,
                'items' => isset($_POST['medias']) ? $_POST['medias'] : [],
                'errors' => $result['errors'],
            ];
        }

        /**
         * Get an item
         */
        public static function get(): array
        {
            if (!isset($_GET['category'])) {
                return self::newItem();
            }
            return self::getFromDatabase();
        }

        /**
         * Create a new item
         */
        private static function newItem(): array
        {
            return [
                'category' => [],
                'items' => [],
                'errors' => [],
            ];
        }

        /**
         * Get item from database
         */
        private static function getFromDatabase(): array
        {
          
            $params = [
                'localCall' => 1,
                'id' => $_GET["category"]
            ];

            $category = (new CategoryController($params))->show($params)['data'][0];

            return [
                'category' => $category,
                'items' => isset($category['items']) ?  $category['items'] : [],
                'errors' => [],
            ];
        }
    }
}
