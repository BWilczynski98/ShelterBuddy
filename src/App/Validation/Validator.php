<?php

namespace App\Validation;

class Validator
{
    public static function isNotEmpty(string ...$fields): bool
    {
        foreach ($fields as $field) {
            if (empty($field)) {
                return false;
            }
        }

        return true;
    }

    public static function isPasswordMatch(string $password, string $confirm_password): bool
    {
        return $password === $confirm_password;
    }
}