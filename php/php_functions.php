<?php 
function generateRandomString($length = 12) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function is_image($path)
{
    $a = getimagesize($path);
    $image_type = $a[2];
    
    if(in_array($image_type , array(IMAGETYPE_GIF , IMAGETYPE_JPEG ,IMAGETYPE_PNG , IMAGETYPE_BMP)))
    {
        return true;
    }
    return false;
}

function compress_image($source_url, $destination_url, $quality)
{
    $info = getimagesize($source_url);
    if ($info['mime'] == 'image/jpeg') $image = imagecreatefromjpeg($source_url);
    elseif ($info['mime'] == 'image/gif') $image = imagecreatefromgif($source_url);
    elseif ($info['mime'] == 'image/png'){
        //$image = imagecreatefrompng($source_url);

        $path = trim('../src/imagick/' . basename($destination_url).PHP_EOL);

        $image = file_get_contents($source_url);
        $img = new Imagick();
        $img->readImageBlob($image);

        list($width, $height, $type, $attr) = getimagesize($source_url);
        $white=new Imagick();
        $white->newImage($width, $height, "white");
        $white->compositeimage($img, Imagick::COMPOSITE_OVER, 0, 0);
        $white->setImageFormat('jpeg');
        //$white->writeImage($path);
        file_put_contents($path, $white);

        $img->destroy();

        $source_url = $path;
        $image = imagecreatefromjpeg($path);

        list($width, $height, $type, $attr) = getimagesize($source_url);
        $image = imagescale($image, $width / 2, $height / 2);
        imagejpeg($image, $destination_url, $quality);
        imagedestroy($image);

        unlink($path);
        return;
    }
    if(!is_image($source_url)){
        ?> <script> showMessage("Error", "The image is broken ;c"); </script><?php
        die();
    }
    list($width, $height, $type, $attr) = getimagesize($source_url);
    $image = imagescale($image, $width / 2, $height / 2);
    imagejpeg($image, $destination_url, $quality);
    imagedestroy($image);
}

function getPath($start){
    if (!file_exists('../src/')) {
        mkdir('../src/', 0755);
    }

    if (!file_exists('../src/imagick/')) {
        mkdir('../src/imagick/', 0755);
    }

    if (!file_exists('../src/full/')) {
        mkdir('../src/full/', 0755);
    }

    if (!file_exists('../src/low/')) {
        mkdir('../src/low/', 0755);
    }

    $pth_trp_Y = $start . date("Y"); //../src/full/2021
    if(!is_dir($pth_trp_Y)){
        mkdir($pth_trp_Y, 0755);
    }

    $pth_trp_M = $pth_trp_Y . '/' . date("m"); //../src/full/2021/03
    if(!is_dir($pth_trp_M)){
        mkdir($pth_trp_M, 0755);
    }

    $pth_trp_D = $pth_trp_M . '/' . date("d") . '/'; //../src/full/2021/03/21/
    if(!is_dir($pth_trp_D)){
        mkdir($pth_trp_D, 0755);
    }

    return $pth_trp_D;
}

function Ecronirovanie($value){
    $value = htmlspecialchars(htmlspecialchars_decode($value));
    return $value;
}
?>