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

class IndexControllerTest extends BaseTest
{
    /**
     * curl --location 'localhost:8000/api'
     */
    public function testIndex(): void
    {
        $response = $this->sendRequest('GET', '/api/');
        $this->assertEquals(Response\Ok::STATUS_CODE, $response['status']);
        $this->assertEquals('Hello world!', $response['body']['message']);
    }

    
}