<?php

if (!function_exists('splitFullName')) {
    function splitFullName(?string $fullName)
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

    if (!function_exists('formatPhoneNumber')) {
        function formatPhoneNumber(?string $phone)
        {
            if (strpos($phone, '07') === 0) {
                return config('constants.country_code') . substr($phone, 1);

            }
            return $phone;
        }
    }
    ;
}