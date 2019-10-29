<?php 
include_once("config.php");
include_once("includes/header.php");

?>
 <div class="jTitle">Downloads</div>
 
  
          <table cellpadding="0" cellpadding="0" width="100%" style="font-family:'Droid Sans';font-size:13px;color:#444444">
          <?php foreach($mysql->select("select * from _jdownalbum") as $dalbum) {?>
            <tr>
                <td style="font-family:Oswald;font-size:16px;color:brown;"><?php echo $dalbum['albumtit'];?></td>
            </tr>
          <?php 
           foreach($mysql->select("select * from _jdownloads where albumid=".$dalbum['dalbumid']) as $downloads) { ?>
            <tr>
                <td>                                          
                    <table style="margin:10px;margin:10px;font-family:'Droid Sans';font-size:13px;color:#444444">
                        <tr>
                            <td><?php echo $downloads["downloadtitle"];?></td>
                            <td style="font-weight:normal;font-size:12px;color:#666"><?php //echo $downloads["downloaddescription"];?></td>
                            <td style="width:24px;">
                                <a style="outline: none;" target="_blank" href ="assets/<?php echo $config['downloads'].$downloads["downloadfilepath"];?>" title="Download File">
                                    <img src="assets/images/DownloadButtonGreen32.gif" style="width: 22px;" title="Download"></a>                    
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        <?php  } } ?>
          </table> 
      
                      
<?php
include_once("includes/footer.php");
?>
