<?php

namespace Integration;

require_once __DIR__ . '/../BaseTest.php';

use Kamergro\Factory\FModel;
use Tests\BaseTest;
use Kamergro\Models\Category;
use Kamergro\Models\Item;
use Kamergro\Models\Media;
use Kamergro\Enums\EMediaType;

class kamergroProgramModelsTest extends BaseTest
{

    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Test Category
     */
    public function testCategory(): void
    {
        /** @var  Category $mCategory*/
        $mCategory = FModel::build('Category');
        $id = $mCategory->insert([
            'name' => 'test',
            'ticket_url' => 'https://www.ticketkantoor.nl/shop/opening24',
            ]);
        $category = current($mCategory->get($id));
        $this->assertEquals('test', $category['name']);
        $this->assertEquals('https://www.ticketkantoor.nl/shop/opening24', $category['ticket_url']);
    }

    /**
     * Test Item
     */
    public function testItem(): void
    {
        //
        // Insert parent Category
        //
        /** @var  Category $mCategory*/
        $mCategory = FModel::build('Category');
        $categoryId = $mCategory->insert(['name' => 'testCategory']);

        //
        // Insert item with parent Category
        //
        /** @var  Item $mItem*/
        $mItem = FModel::build('Item');
        $id = $mItem->insert([
            'name' => 'testItem',
            'category_id' => $categoryId,
            'ticket_url' => 'https://www.ticketkantoor.nl/shop/opening24',
        ]);

        $item = current($mItem->get($id, ['with' => ['category']]));
        $this->assertEquals('testItem', $item['name']);
        $this->assertEquals('https://www.ticketkantoor.nl/shop/opening24', $item['ticket_url']);
        $category = $item['category'];
        $this->assertEquals('testCategory', $category['name']);
        

        //
        // Insert second  item with parent Category
        //
        /** @var  Item $mItem*/
        $mItem->insert([
            'name' => 'testItem2',
            'category_id' => $categoryId
        ]);

        //
        //Get tht items of the parent category
        //
        $category = current(
            $mCategory->get($id, ['with' => ['items']])
        );

        //
        // Check the category has 2 items
        //
        $items = $category['items'];
        $this->assertEquals(2, count($items));
    }

    /**
     * test item ordering with multiple categories
     */
    public function testItemOrderingWithMultipleCategories(): void
    {
        // Insert parent Categories
        /** @var  Category $mCategory*/
        $mCategory = FModel::build('Category');
        $categoryId1 = $mCategory->insert(['name' => 'testCategory1']);
        $categoryId2 = $mCategory->insert(['name' => 'testCategory2']);

        // Test by each category
        /** @var  Item $mItem*/
        $mItem = FModel::build('Item');
        foreach ([$categoryId1, $categoryId2] as $categoryId) {
            // Insert items
            $ids = [];
            for ($index = 0; $index < 3; $index++) {
                $ids[] = $mItem->insert([
                    'name' => 'testItem',
                    'category_id' => $categoryId
                ]);
            }

            // check ordering
            $category = current($mCategory->get($categoryId, ['with' => ['items']]));
            $ordering = array_column($category['items'], 'ordering');
            $this->assertEquals([1, 2, 3], $ordering);

            // Delete the middle item and check ordering
            $mItem->delete($ids[1]);
            $category = current($mCategory->get($categoryId, ['with' => ['items']]));
            $ordering = array_column($category['items'], 'ordering');
            $this->assertEquals([1, 2], $ordering);
        }
    }

    /**
     * Test media
     */
    public function testMedia(): void
    {

        //
        // Insert parent Category
        //
        /** @var  Category $mCategory*/
        $mCategory = FModel::build('Category');
        $categoryId = $mCategory->insert(['name' => 'testCategory']);

        //
        // Insert item with parent Category
        //
        /** @var  Item $mItem*/
        $mItem = FModel::build('Item');
        $itemId = $mItem->insert([
            'name' => 'testItem',
            'category_id' => $categoryId,
        ]);

        //
        // Insert media
        //
        /** @var  Item $mMedia*/
        $mMedia = FModel::build('Media');
        $id = $mMedia->insert([
            'name' => 'testMedia',
            'type' => EMediaType::$IMAGE,
            'item_id' => $itemId,
            'ticket_url' => 'https://www.ticketkantoor.nl/shop/opening24',
            'event_page_url' => 'https://staging-9a16-kamermuziekfestivalgroningen.wpcomstaging.com/lunchconcert-en-masterclass/',
        ]);
        $media = current($mMedia->get($id, ['with' => ['item']]));
        $this->assertEquals('testMedia', $media['name']);
         $this->assertEquals('https://www.ticketkantoor.nl/shop/opening24', $media['ticket_url']);
        $this->assertEquals(1, $media['ordering']);
        $this->assertEquals(EMediaType::$IMAGE, $media['type']);
        $this->assertEquals('testItem', $media['item']['name']);

        //
        //  Insert second media
        //
        $id = $mMedia->insert([
            'name' => 'testMedia2',
            'type' => EMediaType::$YOUTUBE,
            'item_id' => $itemId,
        ]);
        $media = current($mMedia->get($id, ['with' => ['item']]));
        $this->assertEquals(2, $media['ordering']);
        //
        // Check item has 2 medias
        //
        $item =  current(
            $mItem->get($itemId, ['with' => ['medias']])
        );
        $medias = $item['medias'];
        $this->assertEquals(2, count($medias));

        //
        // Delete category, all items should be gone
        //
        $mCategory->delete($categoryId);
        $this->assertEmpty($mCategory->get($categoryId));
        $this->assertEmpty($mItem->get());
        $this->assertEmpty($mMedia->get());
    }

    /**
     * Test media ordering with multiple items
     */
    public function testMediaOrderingWithMultipleItems(): void
    {
        // Insert parent Category
        /** @var  Category $mCategory*/
        $mCategory = FModel::build('Category');
        $categoryId = $mCategory->insert(['name' => 'testCategory1']);

        // Insert parent items
        /** @var  Item $mItem*/
        $mItem = FModel::build('Item');
        $itemId1 = $mItem->insert([
            'name' => 'testItem',
            'category_id' => $categoryId,
        ]);
        $itemId2 = $mItem->insert([
            'name' => 'testItem',
            'category_id' => $categoryId,
        ]);

        // Test by each item
        /** @var  Media $mMedia*/
        $mMedia = FModel::build('Media');
        foreach ([$itemId1, $itemId2] as $itemId) {
            // Insert items
            $ids = [];
            for ($index = 0; $index < 3; $index++) {
                $ids[] = $mMedia->insert([
                    'name' => 'testMedia',
                    'item_id' => $itemId
                ]);
            }

            // check ordering
            $item = current($mItem->get($itemId, ['with' => ['medias']]));
            $ordering = array_column($item['medias'], 'ordering');
            $this->assertEquals([1, 2, 3], $ordering);

            // Delete the middle item and check ordering
            $mMedia->delete($ids[1]);
            $item = current($mItem->get($itemId, ['with' => ['medias']]));
            $ordering = array_column($item['medias'], 'ordering');
            $this->assertEquals([1, 2], $ordering);
        }
    }
}
