 
<?php  
    include_once("config.php");        
?>
<html>
  <head>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <style>
    <style>
    .mytr:hover{background:#c4e9f2;cursor:pointer}
    .title_Bar {background:url(images/blue/titlebackground.png);padding:5px;color:#589cb5;font-family:'Trebuchet MS';font-size:13px !important;font-weight: bold;padding:11px !important;}   
    .odd {background:#f2fcff}
    .odd:hover {background:#c4e9f2}
    .even {background:#fff}
    .even:hover {background:#c4e9f2}
    .label {font-family:arial;font-size:12px;color:#555}
    input[type="text"] {border:1px solid #ccc;padding:2px}
    
    </style>
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
        
        function filescount($directory) {
           // $directory = '/var/www/ajaxform/';
$files = glob($directory . '*.*');

if ( $files !== false )
{
    $filecount = count( $files );
    return $filecount;
}
else
{
    return 0;
}
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

        $disk_used = format_size(foldersize(__DIR__."/../"));
        $disk_remaining = $SIZE_LIMIT - $disk_used;          
        
    ?>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Used Space : '+<?php echo $disk_used;?> + " MB", <?php echo $disk_used;?>],   
          ['Free Space : '+ <?php echo 3072-$disk_used;?>+ " MB", <?php echo 3072-$disk_used;?>]
        ]);

        var options = {
          title: 'Disk Space',
          is3D: false,             
          colors: ['#e6693e', '#f1f1f1', '#ec8f6e', '#f3b49f', '#f6c7b6'],
          'chartArea': {'width': '100%', 'height': '80%'},
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>
  </head>
<script src="assets/js/jquery-1.7.2.js"></script>
<link rel="stylesheet" href="assets/css/demo.css">
  <body style="margin:0px;">
  <div class="title_Bar">Dash Board</div> 
  <table cellspacing='10' cellspadding='5' style="font-size:12px;font-family:'Trebuchet MS';width:100%">
    <tr>
        <td>  
            <div id="piechart_3d" style="width: 500px; height: 300px;"></div>
            <table cellspacing='0' cellspadding='5' style="font-size:12px;font-family:'Trebuchet MS';">
                <tr>
                    <td>Allotted</td>
                    <td>3072 MB (3GB)</td>
                    <td>&nbsp;Used :&nbsp;<?php echo $disk_used;?> MB</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td width="50%">
            <div style="border:1px solid #DEECFE">
                <div class="title_Bar">Recent Enquiries</div>
                <div style="height:250px;overflow: auto;">
                
                </div>
            </div>
          
        </td>
        <td width="50%">
            
              <div style="border:1px solid #DEECFE">
                <div class="title_Bar">Recent Contacts</div>
                   <div style="height:250px;overflow: auto;">
                
                </div>
            </div>
        </td>
    </tr>
  </table>
</body>
</html>
<!--
<td valign="top">
            <table cellspacing='0' cellspadding='5' style="font-size:12px;font-family:'Trebuchet MS';display:none">
                <tr>
                    <td class="mytdhead" style="width:200px">Dir Name</td>
                    <td class="mytdhead" style="width:180px">Files Size</td>
                    <td class="mytdhead" style="width:180px">File(s)</td>
                    <td class="mytdhead" style="width:180px">Browse</td>
                    <td></td>
                </tr>
                <tr class="<?php echo (($count%2)==0) ? "trodd" : "treven";?>">
                    <td class="mytd">Downloads</td>
                    <td class="mytd" style="text-align:right"><?php echo format_size(foldersize("assets/".$config['downloads']),1); ?></td>
                    <td></td>
                </tr>
                <tr class="<?php echo (($count%2)==0) ? "trodd" : "treven";?>">
                    <td class="mytd">Slider</td>
                    <td class="mytd" style="text-align:right"><?php echo format_size(foldersize("assets/".$config['slider']),1); ?></td>
                    <td class="mytd" style="text-align:right"><?php echo filescount("assets/".$config['slider']); ?></td>
                    <td class="mytd" style="text-align:right"><a  href="path.php?path=<?php echo $config['slider'];?>">View Files</a></td>
                </tr>
                <tr class="<?php echo (($count%2)==0) ? "trodd" : "treven";?>">
                    <td class="mytd">Musics</td>
                    <td class="mytd" style="text-align:right"><?php echo format_size(foldersize("assets/".$config['musics']),1); ?></td>
                    <td></td>
                </tr>
                <tr class="<?php echo (($count%2)==0) ? "trodd" : "treven";?>">
                    <td class="mytd">Trash</td>
                    <td class="mytd" style="text-align:right"><?php echo format_size(foldersize("assets/".$config['trash']),1); ?></td>
                    <td></td>
                </tr>
                <tr class="<?php echo (($count%2)==0) ? "trodd" : "treven";?>">
                    <td class="mytd">Backup</td>
                    <td class="mytd" style="text-align:right"><?php echo format_size(foldersize("assets/".$config['backup']),1); ?></td>
                    <td></td>
                </tr>
               <tr class="<?php echo (($count%2)==0) ? "trodd" : "treven";?>">
                    <td class="mytd">Thumb</td>
                    <td class="mytd" style="text-align:right"><?php echo format_size(foldersize("assets/".$config['thumb']),1); ?></td>
                    <td></td>
                </tr>
                <tr class="<?php echo (($count%2)==0) ? "trodd" : "treven";?>">
                    <td class="mytd">Photos</td>
                    <td class="mytd" style="text-align:right"><?php echo format_size(foldersize("assets/".$config['photos']),1); ?></td>
                    <td></td>
                </tr>
                <tr class="<?php echo (($count%2)==0) ? "trodd" : "treven";?>">
                    <td class="mytd">Files</td>
                    <td class="mytd" style="text-align:right"><?php echo format_size(foldersize("assets/".$config['files']),1); ?></td>
                    <td></td>
                </tr>
          </table>
        </td>
        -->










