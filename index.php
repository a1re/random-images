<?
    error_reporting(E_ALL);

    include 'func.php';
    
    $width = 500;
    $height = 800;
    
    $images = [ ];
    
    if (count($_POST) > 0) {
        $n = htmlspecialchars($_POST['n']);
        
        if (is_numeric($n) && $n < 50 && $n > 0) {
            cleanImages(getcwd(), 60);
    
            for ($i = 0; $i < $n; $i++) {
                $text = '#' . ($i + 1) . ' ' . date('H:i d.m.Y', time());
                $images[] = createImage($width, $height, getcwd(), $text);
            }
        }
    } else {
        $n = '1';
    }

?>
<html>
<head><title>Random image</title></head>
<body>
<form method="post">
    <label for="n">Количество изображений</label>
    <input type="text" name="n" value="<?=$n?>"/>
    <button type="submit">Сгенерировать</button>
</form>
<? if (count($images) > 0): ?>
<? foreach ($images as $image): ?>
<img src="<?=$image?>" width="<?=$width/2?>" height="<?=$height/2?>" alt="" style="margin: 5px"/>
<? endforeach; ?>
<? endif; ?>
</body>
</html>