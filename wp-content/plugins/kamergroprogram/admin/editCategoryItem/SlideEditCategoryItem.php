
<?php

use Kamergro\Controllers\ItemController;
use Kamergro\Controllers\MediaController;

if (!class_exists('SlideEditCategoryItem')) {

    class SlideEditCategoryItem
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
            (new MediaController($params))->destroy($params);
        }

        /**
         * Save
         */
        public static function save(): array
        {
            $result = (isset($_GET['category']))
                ? (new ItemController($_POST))->store($_POST)
                : (new ItemController($_POST))->update($_POST);

            if (!isset($result['errors'])) {

                $categoryItem = $result['data'][0];
                $url = '/wp-admin/admin.php?page=program%2Feditcategory&category=' . $categoryItem["category_id"];
                echo '<script>window.location.href = "' . $url . '";</script>';
                die;
            }

            return [
                'categoryItem' => $_POST,
                'medias' => isset($_POST['medias']) ? $_POST['medias'] : [],
                'errors' => $result['errors'],
            ];
        }

        /**
         * Get an item
         */
        public static function get(): array
        {
            if (!isset($_GET['item'])) {
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
                'categoryItem' => [
                    'category_id' => $_GET['category'],
                    'category' => ['name' => '']
                ],
                'medias' => [],
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
                'id' => $_GET["item"]
            ];
            $categoryItem =  (new ItemController($params))->show($params)['data'][0];
            return [
                'categoryItem' => $categoryItem,
                'medias' => isset($categoryItem["medias"]) ? $categoryItem["medias"] : [],
                'errors' => [],
            ];
        }

        /**
         * uploadThumbnail
         */
        public static function uploadThumbnail(): void
        {
            $image = $_POST['image'];
            $id =  $_POST['id'];
            $categoryId =  $_POST['categoryId'];
            $name =  $_POST['name'];

            list($type, $image) = explode(';', $image);
            list(, $image) = explode(',', $image);

            $image = base64_decode($image);
            $image_name = $_POST['id'] . '.png';
            $uploadDir = __DIR__ . '/../../images/categoryThumbnails/';
            file_put_contents($uploadDir . $image_name, $image);

            $thumbnail =  '/wp-content/plugins/kamergro_program/images/categoryThumbnails/' . $image_name;
            $params = [
                'localCall' => 1,
                'id' => $id,
                'category_id' => $categoryId,
                'name' => $name,
                'thumbnail' => $thumbnail,
            ];

            (new ItemController($params))->update($params);
            die ($thumbnail);
        }
    }
}

