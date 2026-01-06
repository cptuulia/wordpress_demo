<?php

namespace Kamergro\Traits;

use Kamergro\Factory\FModel;
use Kamergro\Models\BaseModel;
use Kamergro\Plugins\Db\Db;

/**
 * This trait has some string conversion functions
 */

/**
 * @property Db $db
 */
trait TValidate
{
    public static $VALIDATE_STRING = 'string'; //FILTER_SANITIZE_STRING;
    public static $VALIDATE_INTEGER = FILTER_VALIDATE_INT;
    public static $VALIDATE_BOOLEAN = FILTER_VALIDATE_BOOLEAN;
    public static $VALIDATE_ARRAY = 'array';

    protected function validate(): array
    {
        $request = $this->request;

        $rules = $this->getValidationRules();
        $errors = [];
        foreach ($rules as $column => $rule) {

            $value = $this->request[$column] ?? null;
            $label = "'" . $rule['label'] . "'";
            if ($rule['required']) {
                if (!isset($value)) {
                    $errors[] = $label . ' is required';
                    continue;
                }
                if (!$value && $value !== 0) {
                    $errors[] = $label . ' is required';
                    continue;
                }
            }
            if (!$this->sanitate($value, $rule['type'])) {
                $errors[] = $label . ' has wrong type';
                continue;
            }
            if (isset($rule['exists'])) {
                if (!$this->validateExists($rule, $column)) {
                    $errors[] = $label . ' not found';
                    continue;
                }
            }
            if (isset($rule['in'])) {
                if (!in_array($value, $rule['in'])) {
                    $errors[] = $label .
                        ' must have one of the following values : ' .
                        implode(',', $rule['in']);
                    continue;
                }
            }

        }
        return $errors;
    }

    private function validateExists(array $rule, string $column): bool
    {

        /** @var BaseModel $model */
        $model = FModel::build($rule['exists']['model']);
        $row = $model->get($this->request[$column], ['column' => $rule['exists']['column']]);
        return !empty($row);
    }

    private function sanitate($value, string $type): bool
    {
        if (!$value) {
            return true;
        }
        switch ($type) {
            case self::$VALIDATE_STRING :
                return is_string($value);
                break;
            case self::$VALIDATE_ARRAY :
                return is_array($value);
                break;
            default:
                return filter_var($value, $type);
        }
    }

}