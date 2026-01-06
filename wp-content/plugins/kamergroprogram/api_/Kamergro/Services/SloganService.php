<?php

namespace Kamergro\Services;

use Kamergro\Factory\FModel;


class SloganService extends BaseService
{
    protected $modelName = 'Slogan';

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
                    'ordering' => 'asc',
                ],
                'with' => ['category']
            ]
        );
    }

    /**
     * Show
     */
    public function show(int $id): array
    {
        return $this->model->get($id, ['with' => ['category']]);
    }


    /**
     * Delete
     */
    public function delete(int $id): void
    {
        $this->model->delete($id);
    }


    /**
     * Store
     */
    public function store(array $request): array
    {   
        $request['text'] = $this->formatTextBeforeSave( $request['text']);
        $id = $this->model->insert($request);
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
        $request['text'] = $this->formatTextBeforeSave( $request['text']);
        $this->model->update($request);
        return $this->show($request['id']);
    }

    private function formatTextBeforeSave(string $text): string {
        $text = str_replace('\\"', ' &quot;', $text);
        $text = str_replace('"', ' &quot;',  $text);
        return $text;
    }

   


}
