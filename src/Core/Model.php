<?php

namespace Ilya\MyFrameworkProject\Core;

use Ilya\MyFrameworkProject\Validator\Validator;

abstract class Model
{
    protected array $allowedFields = [];
    protected array $validFields = [];
    protected array $rules = [];
    protected array $errors = [];

    public function loadData(): void
    {
        $data = request()->getData();

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
        return $validator->hasError();
    }

    public function getValidFields(): array
    {
        return $this->validFields;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
