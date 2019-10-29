 <style>
 .mytd {border:1px solid #f1f1f1;padding:3px;color:#444}
 .mytd form{height:0px;}
 .mytdhead{font-weight:bold;text-align:center;color:#222;background:#ccc;padding:5px;font-size:12px;}
 .trodd{background:#fff;}
 .treven{background:#f6f6f6}
 .trodd:hover{background:#e9e9e9;cursor:pointer}
 .treven:hover{background:#e9e9e9;cursor:pointer}
</style>
<?php  
    include_once("config.php");        
?>
<html>
  <head>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <?php
      
      function foldersize($path) {
          $total_size = 0;
          $files = scandir($path);

          foreach($files as $t) {
            if (is_dir(rtrim($path, '/') . '/' . $t)) {
              if ($t<>"." && $t<>"..") {
                  $size = foldersize(rtrim($path, '/') . '/' . $t);
                  $total_size += $size;
              }
            } else {
              $size = filesize(rtrim($path, '/') . '/' . $t);
              $total_size += $size;
            }
          }
          return $total_size;
        }  
                
       function format_size($size,$mess=false) {
          $mod = 1024;
          $units = explode(' ','B KB MB GB TB PB');
          for ($i = 0; $size > $mod; $i++) {
            $size /= $mod;
          }
          if ($mess) {
              return round($size, 2) . ' ' . $units[$i];
          } else {
            return round($size, 2);    
          }
          
        } 
    
        $SIZE_LIMIT = 5368709120; // 5 GB     5120-    1024 MB (1GB) x 5 5120

        $disk_used = format_size(foldersize("assets/cms/".$config['dataDir']));
        $disk_remaining = $SIZE_LIMIT - $disk_used;          
        
    ?>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Used Memory', <?php echo $disk_used;?>],   
          ['Free Memory', <?php echo 5120-$disk_used;?>]
        ]);

        var options = {
          title: 'Disk Space',
          is3D: false,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>
  </head>
<script src="assets/js/jquery-1.7.2.js"></script>
<link rel="stylesheet" href="assets/css/demo.css">
  <body style="margin:0px;">
  <div class="titleBar">Dash Board</div> 
  <table cellspacing='0' cellspadding='5' style="font-size:12px;font-family:'Trebuchet MS';">
    <tr>
        <td>  
            <div id="piechart_3d" style="width: 320px; height: 240px;"></div>
            <table cellspacing='0' cellspadding='5' style="font-size:12px;font-family:'Trebuchet MS';">
                <td>Allotted</td>
                <td>5 GB (5120 MB);</td>
                <td>&nbsp;Used :&nbsp;<?php echo format_size(foldersize("assets/cms/".$config['dataDir']),1);?></td>
            </table>
        </td>
        <td valign="top">
            <table cellspacing='0' cellspadding='5' style="font-size:12px;font-family:'Trebuchet MS';">
                <tr>
                    <td class="mytdhead" style="width:200px">Directory Name</td>
                    <td class="mytdhead" style="width:180px">Directory Size</td>
                </tr>
                <tr class="<?php echo (($count%2)==0) ? "trodd" : "treven";?>">
                    <td class="mytd">Downloads</td>
                    <td class="mytd" style="text-align:right"><?php echo format_size(foldersize("assets/".$config['downloads']),1); ?></td>
                </tr>
          
                <tr class="<?php echo (($count%2)==0) ? "trodd" : "treven";?>">
                    <td class="mytd">Slider</td>
                    <td class="mytd" style="text-align:right"><?php echo format_size(foldersize("assets/".$config['slider']),1); ?></td>
                </tr>
                
                <tr class="<?php echo (($count%2)==0) ? "trodd" : "treven";?>">
                    <td class="mytd">Musics</td>
                    <td class="mytd" style="text-align:right"><?php echo format_size(foldersize("assets/".$config['musics']),1); ?></td>
                </tr>
                
                <tr class="<?php echo (($count%2)==0) ? "trodd" : "treven";?>">
                    <td class="mytd">Trash</td>
                    <td class="mytd" style="text-align:right"><?php echo format_size(foldersize("assets/".$config['trash']),1); ?></td>
                </tr>
                
                <tr class="<?php echo (($count%2)==0) ? "trodd" : "treven";?>">
                    <td class="mytd">Backup</td>
                    <td class="mytd" style="text-align:right"><?php echo format_size(foldersize("assets/".$config['backup']),1); ?></td>
                </tr>
                
                <tr class="<?php echo (($count%2)==0) ? "trodd" : "treven";?>">
                    <td class="mytd">Thumb</td>
                    <td class="mytd" style="text-align:right"><?php echo format_size(foldersize("assets/".$config['thumb']),1); ?></td>
                </tr>
                
                <tr class="<?php echo (($count%2)==0) ? "trodd" : "treven";?>">
                    <td class="mytd">Photos</td>
                    <td class="mytd" style="text-align:right"><?php echo format_size(foldersize("assets/".$config['photos']),1); ?></td>
                </tr>
                
                <tr class="<?php echo (($count%2)==0) ? "trodd" : "treven";?>">
                    <td class="mytd">Files</td>
                    <td class="mytd" style="text-align:right"><?php echo format_size(foldersize("assets/".$config['files']),1); ?></td>
                </tr>
          </table>
        </td>
    </tr>
  </table>
</body>
</html>










