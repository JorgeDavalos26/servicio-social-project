<?php 

namespace App\Services;

class StorageService {

    private $nameOfService;

    function __construct($nameOfService) {
        $this->nameOfService = $nameOfService;
    }

    public function storeMedia($file, $disk, $prePath = ""): String {
        $name = $file->hashName();
        $firstPortion = substr($name, 0, 3);
        $secondPortion = substr($name, 3);
        $path = $file->storeAs(
            $prePath . "/test" . $firstPortion,
            $secondPortion,
            $disk
        );
        return $path;
    }

}