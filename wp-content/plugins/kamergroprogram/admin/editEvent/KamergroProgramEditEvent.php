
<?php

use Kamergro\Controllers\MediaController;


if (!class_exists('KamergroProgramEditEvent')) {

    class KamergroProgramEditEvent
    {
      

        /**
         * uploadThumbnail
         */
        public static function uploadThumbnail(): void
        {  
            $image = $_POST['image'];
            $id =  $_POST['id'];
            $itemId =  $_POST['itemId'];
            $name =  $_POST['name'];

            list($type, $image) = explode(';', $image);
            list(, $image) = explode(',', $image);

            $image = base64_decode($image);
            $image_name = $_POST['id'] . '.png';
            $uploadDir = __DIR__ . '/../../images/categoryThumbnails/';
            file_put_contents($uploadDir . $image_name, $image);
 
            $thumbnail =  '/wp-content/plugins/kamergroprogram/images/categoryThumbnails/' . $image_name;
            $params = [
                'localCall' => 1,
                'id' => $id,
                'item_id' => $itemId,
                'name' => $name,
                'url' => $thumbnail,
            ];
             
            (new MediaController($params))->update($params);
            die ($thumbnail);
        }
    }
}

