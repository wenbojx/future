<?php header("Content-type: text/xml");?>
<?php echo '<?xml version="1.0" encoding="utf-8" ?>';?>
<?php echo '<Image TileSize="'.$datas['tileSize'].'" Overlap="0" Format="jpg" ServerFormat="Default">
<Size Width="'.$datas['imgSize'].'" Height="'.$datas['imgSize'].'" />
</Image>';?>