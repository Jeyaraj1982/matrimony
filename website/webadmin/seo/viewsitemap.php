<style>
 .mytd {border:1px solid #f1f1f1;padding:3px;color:#444}
 .mytd form{height:0px;}
 .mytdhead{font-weight:bold;text-align:center;color:#222;background:#ccc;padding:5px;font-size:12px;}
 .trodd{background:#fff;}
 .treven{background:#f6f6f6}
 .trodd:hover{background:#e9e9e9;cursor:pointer}
 .treven:hover{background:#e9e9e9;cursor:pointer}
</style>
<script src="./../../assets/js/jquery-1.7.2.js"></script>
<link rel="stylesheet" href="./../../assets/css/demo.css">
  <link href='./../../assets/css/styles/shCore.css' rel='stylesheet' type='text/css'>
  <link href='./../../assets/css/styles/shThemeDefault.css' rel='stylesheet' type='text/css'>
  <script src='./../../assets/js/scripts/shCore.js' type='text/javascript'></script>
  <script src='./../../assets/js/scripts/shAutoloader.js' type='text/javascript'></script>
  <script src='./../../assets/js/scripts/shBrushXml.js' type='text/javascript'></script>
  <script src='./../../assets/js/scripts/shBrushJScript.js' type='text/javascript'></script>
  <script src='./../../assets/js/scripts/shBrushCss.js' type='text/javascript'></script>
  <link type="text/css" rel="stylesheet" href="./../../assets/css/styles/shCoreDefault.css"/>
  <script type="text/javascript">SyntaxHighlighter.all();</script>

 <body style="margin:0px;">
 <div class="titleBar">View Site Map</div>
<?php 
    include_once("../../config.php");
?>
    <table cellspacing='0' cellspadding='5' style="width:100%;font-size:12px;font-family:'Trebuchet MS';">
        <tr>
            <td class="mytdhead" style="width:200px">Date Generated</td>  
            <td class="mytdhead">Content</td>
        </tr>  
            <?php
            $data = $mysql->select("select * from _jsitemap where sitemapid=".$_POST['rowid']);  
            foreach($data as $r){                                                   
            ?>
             <tr class="<?php echo (($count%2)==0) ? "trodd" : "treven";?> >">
                   <td class="mytd"><?php echo $r["postedon"];?></td> 
                   <td class="mytd"><pre class='brush: xml'> <?php echo $r["content"];?></pre></td>
                   <td class="mytd"><form action='' method='post'>
                        <input type='hidden' value='<?php echo $r["sitemapid"]?>' name='rowid' id='rowid'>
                        </form>
                   </td>
             </tr>
             <?php
        }
     echo"</table>"              
?>
</body>

