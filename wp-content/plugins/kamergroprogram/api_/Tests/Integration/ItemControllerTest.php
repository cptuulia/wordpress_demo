<?php

/**
 * CategoriesControllerTest
 *
 * The uses cases of these tests are based on the test database, which can be found
 * in Tests/Scripts/sql/testContent.sql
 *
 * Please look there, if something needs to be checked.
 */

namespace Tests\Integration;

require_once __DIR__ . '/../BaseTest.php';


use Kamergro\Factory\FModel;
use Kamergro\Plugins\Http\Response;
use Tests\BaseTest;


class ItemControllerTest extends BaseTest
{

    /**
     *  Test index
     */
    public function testIndex(): void
    {
        $categoryId =  $this->testCategory();

        $items = ['R test', 'A test', 'B test'];
        /** @var  Item $mItem*/
        $mItem = FModel::build('Item');
        foreach ($items as $item) {
            $mItem->insert([
                'name' => $item,
                'category_id' => $categoryId,
            ]);
        }

        $response = $this->sendRequest('GET', '/api/items/category/' . $categoryId);

        $this->assertEquals(Response\Ok::STATUS_CODE, $response['status']);
        $this->assertEquals(3, $response['body']['count']);
        $this->assertEquals('R test', $response['body']['data']['items'][0]['name']);
        $this->assertEquals('B test', $response['body']['data']['items'][2]['name']);
    }

    /**
     *  Test store
     */
    public function testStore(): void
    {
        $categoryId =  $this->testCategory();
        $params = [
            'name' => 'new cat',
            'category_id' => $categoryId,
        ];
        $response = $this->sendRequest('POST', '/api/items', $params, self::$CONTENT_TYPE_JSON);
        $this->assertEquals(Response\Ok::STATUS_CODE, $response['status']);
        $this->assertEquals('Inserted', $response['body']['message']);
        $this->assertEquals('new cat', $response['body']['data'][0]['name']);
    }

    /**
     *  Test update
     */
    public function testUpdate(): void
    {
        $categoryId =  $this->testCategory();
        $params = [
            'name' => 'new cat',
            'category_id' => $categoryId,
        ];
        $response = $this->sendRequest('POST', '/api/items', $params, self::$CONTENT_TYPE_JSON);
        $id =  $response['body']['data'][0]['id'];

        $params = [
            'id' => $id,
            'name' => 'new name',
            'category_id' => $categoryId,
        ];

        $response = $response = $this->sendRequest('PUT', '/api/items', $params, self::$CONTENT_TYPE_JSON);
        $this->assertEquals(Response\Ok::STATUS_CODE, $response['status']);
        $this->assertEquals('Updated', $response['body']['message']);
        $this->assertEquals('new name', $response['body']['data'][0]['name']);

        // Test show
        $response = $response = $this->sendRequest('GET', '/api/items/' . $id, $params, self::$CONTENT_TYPE_JSON);
        $this->assertEquals('new name', $response['body']['data'][0]['name']);
    }

    /**
     *  testDestroy
     */
    public function testDestroy()
    {
        $categoryId =  $this->testCategory();
        $params = [
            'name' => 'new cat',
            'category_id' => $categoryId,
        ];
        $response = $this->sendRequest('POST', '/api/items', $params, self::$CONTENT_TYPE_JSON);
        $id =  $response['body']['data'][0]['id'];

        $params = ['id' => $categoryId];
        $response = $this->sendRequest('DELETE', '/api/items/' . $id, $params, self::$CONTENT_TYPE_JSON);
        $this->assertEquals('Item with id 1 is deleted.', $response['body']['message']);

        $response = $this->sendRequest('GET', '/api/items/' . $id, $params, self::$CONTENT_TYPE_JSON);
        $this->assertEquals('Item with id 1 not found', $response['body']['message']);
    }

    /**
     * get test category Id
     */
    private function testCategory(): int
    {
        $params = ['name' => 'new cat'];
        $response = $this->sendRequest('POST', '/api/categories', $params, self::$CONTENT_TYPE_JSON);
        $categoryId =  $response['body']['data'][0]['id'];
        return $categoryId;
    }
}
