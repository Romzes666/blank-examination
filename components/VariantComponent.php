<?php

namespace app\components;

use Imagick;

class VariantComponent
{
    public static function kimFragmentation($new_name, $path, $new_path): int
    {
        if (isset($new_name)) {
            $pdf = new Imagick();
            $pdf->pingImage($path . $new_name);
            $count = $pdf->getNumberImages();
            $pdf->clear();
            $pdf->destroy();
            $count_task = 0;
            list($first_width, $first_height) = '';
            if (!is_dir($new_path)) {
                mkdir($new_path,0777, true);
            }
            for ($num_page = 1; $num_page < $count; $num_page++) {
                $im = new imagick();
                $im->setResolution(200, 200);
                $im->readImage($path . $new_name . '[' . $num_page . ']');
                $im->setImageFormat('jpeg');
                $im->writeImage($new_path . $num_page . '.jpg');
                $im->clear();
                $im->destroy();
                if ($num_page == 1) {
                    list($first_width, $first_height) = getimagesize($new_path . $num_page . '.jpg');
                } else {
                    list($sec_width, $sec_height) = getimagesize($new_path . $num_page . '.jpg');
                    if ($first_width < $sec_width || $num_page > 8) {
                        $count_task++;
                        rename("$new_path/$num_page.jpg", "$new_path/task$count_task.jpg");
                    }
                }
            }
            return $count_task;
        }
    }
    public static function saveFile($path, $file) : ?string
    {
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        if (!is_dir($path)) {
            mkdir($path,0777, true);
        }
        $new_name = uniqid() . '.' . $extension;
        $_source_path = $file['tmp_name'];
        $target_path = $path . $new_name;
        if (move_uploaded_file($_source_path, $target_path)) {
            return $new_name;
        }
        return NULL;
    }
}