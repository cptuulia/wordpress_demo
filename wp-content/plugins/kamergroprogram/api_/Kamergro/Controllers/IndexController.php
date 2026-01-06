<?php

namespace Kamergro\Controllers;

use Kamergro\Models\Matches;
use Kamergro\Plugins\Http\Response as Status;
use Kamergro\Factory\FModel;
class IndexController extends BaseController
{
    /**
     * Controller function used to test whether the project was set up properly.
     *
     * @return void
     */
    public function test()
    {
        // Respond with 200 (OK):
        (new Status\Ok(['message' => 'Hello world!']))->send();
    }
    protected function getValidationRules(): array
    {
        return [];
    }
}
