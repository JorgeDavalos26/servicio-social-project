<?php 

namespace App\Services;

use Illuminate\Support\Facades\Storage;

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
            $prePath . "/" . $firstPortion,
            $secondPortion,
            $disk
        );
        return $path;
    }

    /**
     * 
     * For example: 
     * getAbsolutePath('local_custom', 'INGENIERIA_NIVELACION_2000A/MOV/8jCJ7X038k3VFWXKpJdvD9OIHGFfWeDX7i5oN.jpg')
     * returns: J:\datos\pruebas2-archivos\INGENIERIA_NIVELACION_2000A/MOV/8jCJ7X038k3VFWXKpJdvD9OIHGFfWeDX7i5oN.jpg
     */
    public function getAbsolutePath($disk, $filepath)
    {
        return Storage::disk($disk)->path($filepath);
    }

    /**
     * 
     * Retrieves the content of a file
     * 
     */
    public function getContent($disk, $filepath)
    {
        return Storage::disk($disk)->get($filepath);
    }

    public function downloadContent($disk, $filepath)
    {
        return Storage::disk($disk)->download($filepath);
    }

    public function getFile($disk, $filepath)
    {
        return new \Illuminate\Http\File(self::getAbsolutePath($disk, $filepath));
    }

    /**
     * 
     * getAsset('INGENIERIA_NIVELACION_2000A/testMOV/8jCJ7X038k3VFWXKpJdvD9OIHGFfWeDX7i5oN.jpg')
     * returns: http://localhost:9200/storage/INGENIERIA_NIVELACION_2000A/MOV/8jCJ7X038k3VFWXKpJdvD9OIHGFfWeDX7i5oN.jpg
     * 
     */
    public function getAsset($filepath) {
        return asset(Storage::url($filepath));
    }

    /**
     * 
     * getAsset2('/storage/INGENIERIA_NIVELACION_2000A/testMOV/8jCJ7X038k3VFWXKpJdvD9OIHGFfWeDX7i5oN.jpg')
     * returns: http://localhost:9200/storage/INGENIERIA_NIVELACION_2000A/testMOV/8jCJ7X038k3VFWXKpJdvD9OIHGFfWeDX7i5oN.jpg
     * 
     */
    public function getAsset2($filepath) {
        return asset($filepath);
    }

    /**
     * 
     * storage/avatars/95aweJsLmapYkuZkd9cfCc2jvWZEZrZSeX2RFCQC.jpg
     * 
     */
    public function getImgAsset($filepath) {
        echo "<img src=" . asset($filepath) . " alt='image asset'>";
    }

    /**
     * 
     * https://www.gravatar.com/avatar/857fa4c52cd2f24b50b11023b48a1b2c?s=100&d=https%3A%2F%2Fs3.amazonaws.com%2Flaracasts%2Fimages%2Fforum%2Favatars%2Fdefault-avatar-23.png
     * 
     */
    public function getImgAssetUrl($url) {
        echo "<img src='$url' alt='image asset'>";
    }

}