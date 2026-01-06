<?php

namespace Tests\Traits;

use Kamergro\Factory\FModel;
use Kamergro\Models\WpEwdFeupUsers;

trait THelpers
{
    protected function getTestUser(string $userName = ''): int
    {
        /** @var WpEwdFeupUsers $mUser */
        $mUser = FModel::build('WpEwdFeupUsers');
        return $mUser->insert(
            ['Username' => $userName = !'' ? $userName : 'testuser' . uniqid()]
        );
    }

}