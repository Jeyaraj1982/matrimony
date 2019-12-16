  <table>
<?php
    include_once("config.php");        
    $path = "assets/".$_REQUEST['path'];
    if (isset($_REQUEST['file'])) {
        unlink($path."/".$_REQUEST['file']);
    }
     
     $q= scandir($path);
     
     foreach($q as $q1) {
     if (!($q1=="." || $q1=="..")) {
?>
    <tr>
        <td><img src="<?php echo $path."/".$q1;?>" width="300px"></td>
        <td>
            <?php
                $f = $mysql->select("select * from _jslider where filepath='".$q1."'");
                if (sizeof($f)==0) {
            ?>
            <a href="path.php?path=<?php echo $_REQUEST['path'];?>&file=<?php echo $q1;?>">del</a>
            <?php } ?>
        </td>
    </tr>
<?php
      }
}
?>
</table>
 