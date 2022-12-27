<?php

use App\Enums\TypesQuestion;
use App\Services\SettingsService;
use App\Services\StorageService;
use App\Services\UserService;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;

if (!function_exists('to_boolean')) {

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

if (!function_exists('base64ToUploadedFile')) {

    function base64ToUploadedFile(string $base64File): UploadedFile
    {
        // Get file data base64 string
        $fileData = base64_decode(Arr::last(explode(',', $base64File)));

        // Create temp file and get its absolute path
        $tempFile = tmpfile();
        $tempFilePath = stream_get_meta_data($tempFile)['uri'];

        // Save file data in file
        file_put_contents($tempFilePath, $fileData);

        $tempFileObject = new File($tempFilePath);
        $file = new UploadedFile(
            $tempFileObject->getPathname(),
            $tempFileObject->getFilename(),
            $tempFileObject->getMimeType(),
            0,
            true // Mark it as test, since the file isn't from real HTTP POST.
        );

        // Close this file after response is sent.
        // Closing the file will cause to remove it from temp director!
        app()->terminating(function () use ($tempFile) {
            fclose($tempFile);
        });

        // return UploadedFile object
        return $file;
    }
}

// Services 

if (!function_exists('settings')) {

    function settings() {
        // $settings = App()->make(SettingsService::class); please let this code just for knowledge
        // dd($settings->getActivePeriods()); let this one as well
        return app(SettingsService::class);
    }

}

if (!function_exists('user')) {

    function user() {
        return app(UserService::class);
    }

}

if (!function_exists('storage')) {

    function storage() {
        return app(StorageService::class);
    }

}
        
        
