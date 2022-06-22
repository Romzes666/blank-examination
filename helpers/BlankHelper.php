<?php

namespace app\helpers;

use app\models\VariantBlank;

class BlankHelper
{

    public static function ParseValues(array $inputs): array
    {
        $result = [];
        $count = 0;
        foreach ($inputs as $input) {
            if ($input['type'] === 'caption') {
                $result[$count]['options'] = explode(';',$input['input_tooltip']);
                $result[$count]['top'] = substr($input['input_top'], 0,-2);
                $result[$count]['left'] = substr($input['input_left'], 0,-2);
                $result[$count]['width'] = substr($input['input_width'], 0,-2);
                $result[$count]['height'] = substr($input['input_height'], 0,-2);
                $count++;
            }
        }
        $res = [];
        for ($i = 0; $i < $count; $i++) {
            for ($j = 0; $j < count($result[$i]['options']); $j++) {
                if (is_numeric($result[$i]['options'][$j])) {
                    $res[$i]['options'][$result[$i]['options'][$j-1]] = $result[$i]['options'][$j];
                    continue;
                }
                $res[$i]['options'][$result[$i]['options'][$j]] = $result[$i]['options'][$j];
            }
            $res[$i]['top'] = $result[$i]['top'];
            $res[$i]['left'] = $result[$i]['left'];
            $res[$i]['width'] = $result[$i]['width'];
            $res[$i]['height'] = $result[$i]['height'];
        }
        return $res;
    }

    public static function InsertInBlank(array $inputs, string $path, array $params = [])
    {
        $img = imagecreatefromjpeg($path);
        $iWidth = imagesx($img);
        $iHeight = imagesy($img);
        $k = (($iWidth+$iHeight)*2)/((1105+1560)*2);
        $fontColor = imagecolorallocate($img, 0, 0, 0);
        $fontFile = "C:\Windows\Fonts\arial.ttf"; // CHANGE TO YOUR OWN!

        foreach ($inputs as $input) {
            $fontSize = 48;
            $posX = $input['left'] * $k;
            $posY = $input['top'] * $k + $input['height'] * $k;
            if (array_key_exists('КОДБЛАНКА',$input['options'])) {
                if (!VariantBlank::findOne(['name' => $params['blank_name']. '.jpg', 'id_exam' => $params['id_exam']])) {
                    $postfix = self::randomNumber($input['options']['ПОСТФИКС']);
                    $variantBlank = new VariantBlank();
                    $variantBlank->name = $params['blank_name']. '.jpg';
                    $variantBlank->id_exam = $params['id_exam'];
                    $code = $input['options']['ПРЕФИКС'] . $postfix;
                    $variantBlank->prefix = $code;
                    $variantBlank->save(false);
                } else {
                    $variantBlank = VariantBlank::findOne([
                        'name' => $params['blank_name']. '.jpg',
                        'id_exam' => $params['id_exam']
                    ]);
                    $code = $variantBlank->prefix;
                }
                $fontSize = 72;
                $angle = $input['options']['ПОВОРОТ'];
                $txt = $code;
                if ($angle > 0) {
                    $posX = $input['left'] * $k + $fontSize;
                }
                imagettftext($img, $fontSize, $angle, $posX, $posY, $fontColor, $fontFile, $txt);
            }
            if (array_key_exists('КОДПРЕДМЕТА', $input['options'])) {
                $code = $params['code'];
                $txt = $code[$input['options']['КОДПРЕДМЕТА']];
                imagettftext($img, $fontSize, 0, $posX, $posY, $fontColor, $fontFile, $txt);
            }
            if (array_key_exists('НАЗВАНИЕПРЕДМЕТА',$input['options'])) {
                $subject = $params['subject'];
                $charlist = mb_str_split($subject);
                $txt = mb_strtoupper($charlist[$input['options']['НАЗВАНИЕПРЕДМЕТА']]);
                imagettftext($img, $fontSize, 0, $posX, $posY, $fontColor, $fontFile, $txt);
            }
            if (array_key_exists('ДЕНЬ', $input['options'])) {
                $date = date('d');
                $txt = $date[$input['options']['ДЕНЬ']];
                imagettftext($img, $fontSize, 0, $posX, $posY, $fontColor, $fontFile, $txt);
            }
            if (array_key_exists('МЕСЯЦ', $input['options'])) {
                $date = date('m');
                $txt = $date[$input['options']['МЕСЯЦ']];
                imagettftext($img, $fontSize, 0, $posX, $posY, $fontColor, $fontFile, $txt);
            }
            if (array_key_exists('ГОД', $input['options'])) {
                $date = date('y');
                $txt = $date[$input['options']['ГОД']];
                imagettftext($img, $fontSize, 0, $posX, $posY, $fontColor, $fontFile, $txt);
            }
        }
        $quality = 100;
        $newpath = \Yii::$app->basePath. '/web/blanks/'.$params['user_id'].'/'.$params['variant_id'].'/';
        if (!is_dir($newpath)) {
            mkdir($newpath,0777, true);
        }
        imagejpeg($img, $newpath.$params['blank_name'].'.jpg', $quality);
    }

    private static function randomNumber($length)
    {
        $result = '';

        for($i = 0; $i < $length; $i++) {
            $result .= mt_rand(0, 9);
        }

        return $result;
    }

    private function TextToImage()
    {

    }
}