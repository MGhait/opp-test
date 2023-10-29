<?php

class Validator
{

    private $data;
    private $errors = [];
    private static $fields = ['username', 'email']; // static variable to call self

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function validateForm()
    {
        foreach (self::$fields as $field) {
            if (!array_key_exists($field, $this->data)) {
                trigger_error("{$field} is not present in data");
                return;
            }
        }

        // if both data exists
        $this->validateEmail();
        $this->validateUsername();

        // return errors if exists
        return $this->errors;
    }

    private function validateUsername()
    {
        $value = trim($this->data['username']);
        if (empty($value)) {
            $this->addError('username', 'Username Can NOT be empty');
        } else {
            if (!preg_match('/^[a-zA-Z0-9]{6,12}$/', $value)) {
                $this->addError('username', 'Username has to be from 6 to 12 chars & alphanumeric only');
            }
        }
    }

    private function validateEmail()
    {
        $value = trim($this->data['email']);
        if (empty($value)) {
            $this->addError('email', 'Email Can NOT be empty');
        } else {
            if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                $this->addError('email', 'Email must be a valid Email');
            }
        }
    }

    private function addError($key, $value)
    {
        $this->errors[$key] = $value;
    }

}
