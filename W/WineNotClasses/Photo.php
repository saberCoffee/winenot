<?php
namespace W\WineNotClasses;

use \W\Security\StringUtils;

class Photo
{
    public function createPhoto($photo, $photoName, $form, $type)
    {
		// Maintenant, on va donner un nom à notre image : pourquoi pas le nom de base de l'image, mais nettoyé (en y retirant les caractères spéciaux, les espaces, etc)
		$clean_name = StringUtils::clean_url($photo['name']);

		// Ici, on initialise enfin la variable qui sera le nom final de l'image.
		$filename = $clean_name;
        $filepath = 'assets/content/photos/temp/' . $filename;
        $fileext  = pathinfo($filepath, PATHINFO_EXTENSION);

        $x          = $form['x'];
        $y          = $form['y'];
        $w          = $form['w'];
        $h          = $form['h'];
        $resizeW    = $form['resizeW'];
        $resizeH    = $form['resizeH'];
        $imageInfos = getimagesize($filepath);

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

        imagecopyresized($img_r, $img_r, 0, 0, 0, 0, $resizeW, $resizeH, $imageInfos[0], $imageInfos[1]);
        imagecopyresampled($dst_r,$img_r,0,0,$x,$y,
        $targ_w,$targ_h,$w,$h);

        unlink($src);

        $filename = StringUtils::clean_url($photoName)  . '_' . time() . '.' . $fileext;
        $filepath = 'assets/content/photos/' . $type . '/' . $filename;

        imagejpeg($dst_r,$filepath,$jpeg_quality);
        imagecreatefromjpeg($filepath);

        return $filename;
    }
}
