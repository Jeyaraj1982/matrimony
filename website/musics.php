<?php 
include_once("config.php");
include_once("includes/header.php");

?>
 
    <div class="jTitle">Music Galary</div><br>
    
        <?php 
            if (isset($_REQUEST['album'])) {
                $album = $mysql->select("select * from _jalbum where albumid=".$_REQUEST['album']);
                $album = $album[0];
        ?>
        
        <table cellpadding="5" cellpadding="0" width="100%" style="font-family:'Droid Sans';font-size:13px;color:#444444">
            <tr>
                <td colspan="2"><a href="musics.php?album=<?php echo $album['albumid'];?>" style="font-family:Oswald;font-size:16px;color:brown;"><?php echo $album["albumtit"];?></a></td>
            </tr>
            <tr>
                <td style="width: 125px;">
                    <img src="assets/<?php echo $config['thumb'].$album["filepath"];?>" height="160" width="120" style="border:1px solid #ccc;padding:2px;">    
                </td>
                <td valign="top">
                    <?php echo $album['albumdesc'];?><br><br>
                    
                </td>
            </tr>
        </table>
        
        <hr style="border:none;border-bottom:1px solid #f1f1f1">
         
        <table cellpadding="0" cellpadding="0" width="100%" style="margin:10px;font-family:'Droid Sans';font-size:13px;color:#444444">
            <?php foreach($mysql->select("select * from _jmusics where albumid=".$album['albumid']) as $music) { ?>
            <tr>
                <td><?php echo $music["musictitle"];?></td>
                <td style="width: 203px;">
                    <iframe src="assets/dewplayer.swf?mp3=/<?php echo $config['musics'].$music["musicfilepath"];?>&autostart=false&autoreplay=false" style="height: 20px;;width:200px;border:none;background:none;" ></iframe>
                </td>
                <td style="width:24px;">
                    <a style="outline: none;" target="_blank" href ="assets/<?php echo $config['musics'].$music["musicfilepath"];?>" title="Download File"><img src="assets/images/DownloadButtonGreen32.gif" style="width: 22px;" title="Download"></a>                    
                </td>
            </tr>
            <?php } ?>
        </table>
    
    <?php } else  { ?>
        
        <table cellpadding="5" cellpadding="0" width="100%" style="font-family:'Droid Sans';font-size:13px;color:#444444">
            <?php 
                foreach(JMusics::getMusicAlbum() as $album) {
                    $musics = $mysql->select("select * from _jmusics where albumid=".$album['albumid']);
            ?>
            <tr>
                <td colspan="2"><a href="musics.php?album=<?php echo $album['albumid'];?>" style="font-family:Oswald;font-size:16px;color:brown;"><?php echo $album["albumtit"];?></a></td>
            </tr>
            <tr>
                <td style="width: 125px;">
                    <img src="assets/<?php echo $config['thumb'].$album["filepath"];?>" height="160" width="120" style="border:1px solid #ccc;padding:2px;">    
                </td>
                <td valign="top">
                    <?php echo $album['albumdesc'];?><br><br>
                    Total Musics: <?php echo sizeof($musics);?><br>
                    <a href="musics.php?album=<?php echo $album['albumid'];?>" style="font-size:airal;font-size:12px;color:red;">View Musics</a>                 
                </td>
            </tr>
            <?php } ?>
        </table>
          

       
       
       <?php } ?>
                   
<?php
include_once("includes/footer.php");
?>
