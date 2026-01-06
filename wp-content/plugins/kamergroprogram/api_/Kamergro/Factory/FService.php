<?php

namespace Kamergro\Factory;

/**
 * Factory class to generate different types of request types
 *
 * The supported types are:
 *
 * 'application/json'
 * 'application/x-www-form-urlencoded'
 * 'FormUrlencoded'
 *
 */
abstract class FService extends FBase
{
    /**
     * @inheritdoc
     */
    public static function build(string $class = '', array $constructorParams = [])
    {
        $class = 'Kamergro\Services\\' . $class;
        return parent::build($class, $constructorParams);
    }
}