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
        return md5( uniqid (rand(), true));
    }

    public static function processImage($file, $imageName, $imageFolder) {
        self::createDirectory($imageFolder);

        $manager = new Image(new Driver());
        $image = $manager->read($file["tmp_name"])->cover(800,800);
        $image->save($imageFolder . $imageName . '.png');
        $image->save($imageFolder . $imageName . '.webp');
    }

    public static function deleteImage($route) {
        if (file_exists($route)) {
            unlink($route);
        }
    }

}