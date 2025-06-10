<?php

namespace Ilya\MyFrameworkProject\Validator;

use Ilya\MyFrameworkProject\Database\Database;

class Validator
{
    private array $errors = [];
    private array $rules = ['required', 'email', 'max', 'min', 'match', 'unique'];
    private array $errorMessage = [
        'required' => 'Данное поле не должно быть пустым.',
        'email' => 'Введите корректный Email.',
        'max' => 'Данное поле должно содержать не более :ruleValue: символов.',
        'min' => 'Данное поле должно содержать не менее :ruleValue: символов.',
        'match' => 'Пароль и подтверждение пароля не совпадают.',
        'unique' => 'Данный :field: занят, попробуйте другой.'
    ];
    private array $dataItems;

    public function validate(array $data, array $rules): void
    {
        $this->dataItems = $data;
        foreach ($data as $field => $value) {
            if (array_key_exists($field, $rules)) {
                $this->check([
                    'field' => $field,
                    'value' => is_string($value) ? trim($value) : $value,
                    'rules' => $rules[$field]
                ]);
            }
        }
    }

    private function check(array $data): void
    {
        foreach ($data['rules'] as $rule => $ruleValue) {
            if (in_array($rule, $this->rules)) {
                if (!call_user_func_array([$this, $rule], [$data['value'], $ruleValue])) {
                    $this->addError(
                        $data['field'],
                        str_replace(
                            [':ruleValue:', ':field:'],
                            [$ruleValue, $data['field']],
                            $this->errorMessage[$rule]
                        )
                    );
                }
            }
        }
    }

    public function hasErrors(): bool
    {
        return empty($this->errors);
    }

    private function addError(string $field, string $errorMessage): void
    {
        $this->errors[$field][] = $errorMessage;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    private function required(mixed $value, mixed $ruleValue): bool
    {
        return !empty($value);
    }

    private function email(mixed $value, mixed $ruleValue): bool
    {
        return (bool)filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    private function max(mixed $value, mixed $ruleValue): bool
    {
        return $ruleValue >= mb_strlen($value, 'UTF-8');
    }

    private function min(mixed $value, mixed $ruleValue): bool
    {
        return $ruleValue <= mb_strlen($value, 'UTF-8');
    }

    private function match(mixed $value, mixed $ruleValue): bool
    {
        return $value === $this->dataItems[$ruleValue];
    }

    private function unique(mixed $value, mixed $ruleValue): bool
    {
        $params = explode(':', $ruleValue);
        $table = $params[0];
        $column = $params[1];
        return !Database::getInstance()->findOne($table, $value, $column);
    }
}
