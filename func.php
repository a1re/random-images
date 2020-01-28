<?

function cleanImages ($dir, $age_in_seconds) {
    if ($handle = opendir($dir)) {
        while (false !== ($entry = readdir($handle))) {
            $file = $dir . '/' . $entry;
        
            if (!is_file($file)) {
                continue;
            }
            
            $ext = mb_substr($entry, mb_strrpos($entry, '.')+1);
            $age = time() - filectime($file);
                
            if ($ext === 'jpg' & $age > $age_in_seconds) {
                unlink($file);
            }
        }
        closedir($handle);
    }
}
    
function createImage ($width, $height, $dir, $text) {
    $img = new Imagick();
    $img->newImage($width, $height, new ImagickPixel('#fff'));

    $draw = new ImagickDraw();
    $draw->setFillColor('black');
    $draw->setFontSize(50);
    $draw->setGravity(Imagick::GRAVITY_CENTER);
    $img->borderImage('black', 1, 1);

    $img->annotateImage($draw, 0, 0, 0, $text);
    $img->setImageFormat('jpg');
    
    $image_filename = md5(rand(0, 1000)). '.jpg';
    
    $img->writeImage($dir . '/' . $image_filename);
    chmod($dir . '/' . $image_filename, 0644);
    
    return $image_filename;
}