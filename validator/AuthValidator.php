<?php

class AuthValidator {
    public static function loginValidation($data) {
        $errors = [];
        
        if (empty($data['email'])) {
            $errors[] = "Email is required now";
        }

        return $errors;
    }
}