<?php
namespace W\WineNotClasses;

use \W\Security\StringUtils;

class Photo
{
    public function createPhoto($photo, $photoName, $form, $type)
    {
        $photoName = StringUtils::clean_url($photoName);

        $filename = $photo['name']  . '.' . pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
        $fileext  = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
        // Réécrire une URL dynamique
        $filepath = 'assets/content/photos/temp/' . StringUtils::clean_url($filename);

        $x        = $form['x'];
        $y        = $form['y'];
        $w        = $form['w'];
        $h        = $form['h'];
        $resizeW  = $form['resizeW'];
        $resizeH  = $form['resizeH'];
        $realSize = getimagesize($filepath);

        $targ_w = 300;
        $targ_h = 300;

        $jpeg_quality = 100;

        $src = $filepath;

        if ($fileext == 'png') {
            $img_r = imagecreatefrompng($src);
        } else {
            $img_r = imagecreatefromjpeg($src);            
        }

        $dst_r = ImageCreateTrueColor( $targ_w, $targ_h );

        imagecopyresized($img_r, $img_r, 0, 0, 0, 0, $resizeW, $resizeH, $realSize[0], $realSize[1]);
        imagecopyresampled($dst_r,$img_r,0,0,$x,$y,
        $targ_w,$targ_h,$w,$h);

        unlink($filepath);

        $filename = StringUtils::clean_url($photoName)  . time() . '.' . $fileext;
        $filepath = 'assets/content/photos/' . $type . '/' . $filename;

        imagejpeg($dst_r,$filepath,$jpeg_quality);
        imagecreatefromjpeg($filepath);

        return $filename;
    }
}
