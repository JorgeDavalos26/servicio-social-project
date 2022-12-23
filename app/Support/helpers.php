<?php

use App\Enums\TypesQuestion;

if (!function_exists('to_boolean')) {
    /**
     * Convert to boolean
     *
     * @param $booleable
     * @return boolean
     */
    function to_boolean($booleable)
    {
        return filter_var($booleable, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
    }
}

if (!function_exists('get_data_regarding_type')) {
    function get_data_regarding_type($type) {
        $value = null;
        switch($type) {
            case TypesQuestion::BOOLEAN: $value = true; break;
            case TypesQuestion::STRING: $value = "A string"; break;
            case TypesQuestion::DATETIME: $value = "2022-12-21 10:32:13"; break;
            case TypesQuestion::TIME: $value = "10:32:13"; break;
            case TypesQuestion::FLOAT: $value = 26.6; break;
            case TypesQuestion::INT: $value = 26; break;
            case TypesQuestion::FILE: $value = "data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/"; break;
            case TypesQuestion::SELECT: $value = "A selected value"; break;
            case TypesQuestion::MULTIPLE: $value = "A value1,A value2,A value3"; break;
            default: $value = "";
        }
        return $value;
    }
}
