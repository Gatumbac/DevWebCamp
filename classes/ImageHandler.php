<?php
namespace Classes;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager as Image;

class ImageHandler {
    public static function createDirectory($imageFolder = IMAGE_FOLDER) {
        if (!is_dir($imageFolder)) {
            mkdir($imageFolder);
        }
    }

    public static function getRandomName() {
        return md5( uniqid (rand(), true) ) . ".jpg";
    }

    public static function processImage($file, $imageName) {
        self::createDirectory();
        $manager = new Image(new Driver());
        $imagen = $manager->read($file["tmp_name"])->cover(800,600);
        $imagen->save(IMAGE_FOLDER . $imageName);
    }

    public static function deleteImage($route) {
        if (file_exists($route)) {
            unlink($route);
        }
    }

}