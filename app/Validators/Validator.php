<?php

namespace App\Validators;

class Validator
{
    public $errors = [];
    public $data;

    public function validate($data, $validateArray): array
    {
        foreach ($validateArray as $key => $value) {
            $this->data = $data;
            $this->processRequest($key, $value);
        }

        return $this->errors;
    }

    protected function processRequest($key, $value): void
    {
        $values = explode('|', $value);

        foreach ($values as $value) {
            $valueArray = explode(",", $value);
            $method = trim($valueArray[0]);
            $param = isset($valueArray[1]) ? trim($valueArray[1]) : null;
            if (method_exists(Validator::class, $method)) {
                $this->$value($key, $param);
            } else {
                $this->errors[$key] = $value . ' does not exist';
            }
        }
    }

    protected function required($key): void
    {
        if (!isset($this->data[$key])) {
            $this->errors[$key] = $key . ' required!';
        }
    }

    protected function integer($key): void
    {
        if (isset($this->data[$key]) && !ctype_digit($this->data[$key])) {
            $this->errors[$key] = $key . ' not an integer!';
        }
    }

    protected function length($key, $param): void
    {
        if (isset($this->data[$key])) {
            if (!is_int($param)) {
                $this->errors[$key] = $param . ' not an integer!';
            }

            if (is_int($param) && strlen(trim(strip_tags($this->data[$key]))) > (int)$param) {
                $this->errors[$key] = $key . ' maximum length exceeded!';
            }
        }
    }
}
