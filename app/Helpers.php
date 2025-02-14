<?php

if (!function_exists('splitFullName')) {
    function splitFullName(?string $fullName): array
    {
        if (!$fullName) {
            return ['first_name' => '', 'last_name' => ''];
        }

        $nameParts = explode(' ', trim($fullName), 2);
        return [
            'first_name' => $nameParts[0] ?? '',
            'last_name' => $nameParts[1] ?? '',
        ];
    }
}

if (!function_exists('formatPhoneNumber')) {
    function formatPhoneNumber(string $phoneNumber): string
    {
        if (strpos($phoneNumber, '07') === 0) {
            return config('constants.country_code') . substr($phoneNumber, 1);
        }

        return $phoneNumber;
    }
}

if (!function_exists('generateUniqueCode')) {
    function generateUniqueCode(): string
    {
        return strtoupper(uniqid('CODE_'));
    }
}
