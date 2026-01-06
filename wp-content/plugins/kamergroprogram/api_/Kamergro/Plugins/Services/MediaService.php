<?php

namespace Kamergro\Services;

use Kamergro\Factory\FModel;
use Kamergro\Factory\FService;
use Kamergro\Models\Media;
use Kamergro\Models\Item;


class MediaService extends BaseService
{
    protected $modelName = 'Media';

    /**
     * Construct
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Search
     */
    public function search(?int $id): array
    {
        return $this->model->get(
            $id,
            [
                'order' => [
                    'name' => 'asc',
                ],
                'with' => ['item']
            ]
        );
    }

    /**
     * Show
     */
    public function show(int $id): array
    {
        return $this->model->get($id, ['with' => ['item']]);
    }


    /**
     * Delete
     */
    public function delete(int $id): void
    {

        // on test we don't test delete photo
        if (php_sapi_name() != "cli" && php_sapi_name() != 'fpm-fcgi') {
            $this->deletePhoto($id);
        }
      
        $this->model->delete($id);
    }

    /**
     * Delete the photo from the folder
     */
    private function deletePhoto($id) : void
    {
        $mediaItem = current($this->model->get($id));
        $url = $mediaItem['url'];
        $fileName = end(explode('/', $url));
        $absolutePath = $this->absolutePath($fileName);

        if (is_file($absolutePath)) {
            unlink($absolutePath);
        }
    }

    /**
     * Store
     */
    public function store(array $request): array
    { 
       // $request = $this->fixQuotes($request);
        $id = $this->model->insert($request);

        if (isset($_FILES['categoryItemPhoto'])) {
             $request['id'] = $id;
             $this->imageUpload($request);
        }
        return $this->show($id);
    }

    /**
     *  Upload image
     */
    private function imageUpload(array $request) {
            $id = $request['id'];
            $itemId = $request['item_id'];
           
            /** @var $mItem  Item */
            $mItem = FModel::build('Item');
            $categoryId = current($mItem->get($itemId))['category_id'];
            
        
            $uploadedFileName = $_FILES['categoryItemPhoto']['name'];
            if ($uploadedFileName == '') {
                return;
            }
            $extension = pathinfo($uploadedFileName, PATHINFO_EXTENSION);
            $fileName = $categoryId . '_' . $itemId . '_' . $id . '.' . $extension;

            $absolutePath = $this->absolutePath($fileName);
            move_uploaded_file($_FILES['categoryItemPhoto']['tmp_name'], $absolutePath);
           
            // update url to database
            $parts = explode('/wp-content/', $absolutePath);
            $relativeLocation = '/wp-content/' .$parts[1];
            $this->model->update(['id' => $id, 'url' => $relativeLocation]);
    }

    /**
     * Get absolute path and enable move_uploaded_file and unlink on tantonius.com
     * 
     */
    private function absolutePath(string $fileName): string
    {
        $config = require __DIR__ . '/../../config/config.php';
        $path = $config['slide_show_images'] . 'categoryItems/';

        if (!str_contains($_SERVER ["HTTP_HOST"], 'tantonius.com')) {
            return $path . $fileName; 
        }
        // we strip '/' from the end of path others ini_set('open_basedir',  $absolutePath) does not work
        $CONTEXT_DOCUMENT_ROOT = isset ($_SERVER['CONTEXT_DOCUMENT_ROOT']) ? $_SERVER['CONTEXT_DOCUMENT_ROOT'] : '';
        $absolutePath = $CONTEXT_DOCUMENT_ROOT . substr($path, 0, -1);

        // Note with  ini_set('open_basedir',  $absolutePath)  the absolute Path may not end
        // by /
        // correct : /home/tuulia/domains/tantonius.com/public_html/handenpoottest/wp-content/plugins/kamergroProgram/images/categoryItems
        // no correct /home/tuulia/domains/tantonius.com/public_html/handenpoottest/wp-content/plugins/kamergroProgram/images/categoryItems/
       
        ini_set('open_basedir',  $absolutePath);
        $absolutePath = $absolutePath . '/' . $fileName;
        return $absolutePath;
    }

    /**
     * Update
     */
    public function update(array $request): array
    {
        //$request = $this->fixQuotes($request);
        $this->model->update($request);
        if (isset($_FILES['categoryItemPhoto'])) {
            // This does not work on tantonius.com 
            // So it is comments
            //$this->deletePhoto($request['id']);
            $this->imageUpload($request);
        }
        return $this->show($request['id']);
    }

    /**
     * Fix quotes
     * 
     * This function is not in use because FTP does not update it on  kamermuziekfestivalgroningen 
     * server and I have no time to solve it
     */
    private function fixQuotes(array $request): array
    {
         $columns = ['name', 'text'];
        foreach ($columns as $column) {
            if (isset($request[$column])) {
               
                $request[$column] = str_replace('\"', '"',    $request[$column]);
                $request[$column] = str_replace("\'", ' &apos;',    $request[$column]);
            }
        }
        return $request;
    }
}
