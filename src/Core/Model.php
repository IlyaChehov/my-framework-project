<?php

namespace Ilya\MyFrameworkProject\Core;

use Ilya\MyFrameworkProject\Database\Database;
use Ilya\MyFrameworkProject\Validator\Validator;

abstract class Model
{
    protected array $allowedFields = [];
    public array $validFields = [];
    protected array $fillable = [];
    protected array $rules = [];
    protected array $errors = [];
    protected string $table;
    public function loadData($data): void
    {
        foreach ($this->allowedFields as $field) {
            if (isset($data[$field])) {
                $this->validFields[$field] = $data[$field];
            } else {
                $this->validFields[$field] = '';
            }
        }
    }

    public function validate(array $data = [], array $rules = []): bool
    {
        if (empty($data)) {
            $data = $this->validFields;
        }

        if (empty($rules)) {
            $rules = $this->rules;
        }

        $validator = new Validator();
        $validator->validate($data, $rules);
        $this->errors = $validator->getErrors();
        return $validator->hasErrors();
    }

    public function getValidFields(): array
    {
        return $this->validFields;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function save(): string|false
    {
        foreach ($this->validFields as $field => $value) {
            if (!in_array($field, $this->fillable)) {
                unset($this->validFields[$field]);
            }
        }
        $keys = array_keys($this->validFields);
        $columns = array_map(fn($el) => "`{$el}`", $keys);
        $columns = implode(', ', $columns);
        $values = array_map(fn($el) => ":{$el}", $keys);
        $values = implode(', ', $values);
        $db = Database::getInstance()->query("INSERT INTO {$this->table} ({$columns}) VALUES ({$values})", $this->validFields);
        return $db->getInsertId();
    }
}
