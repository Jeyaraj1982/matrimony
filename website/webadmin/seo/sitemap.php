<?php
    include_once("../../config.php");
    $obj = new CommonController();
     
    if (!($obj->isLogin())){
        echo $obj->printError("Login Session Expired. Please Login Again");
        exit;
    }

    if (isset($_POST['sitemapid'])) {
         $sitemap = '<?xml version="1.0" encoding="UTF-8" ?>\n 
            \t<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">\n';
        
    foreach(JPages::getPages(0,"ispublish=1" ) as $p) {
        $sitemap .= "\t\t<url>\n";
            $sitemap .= "\t\t\t<loc>".JFrame::getAppSetting('siteurl')."/index.php?page=".$p['pageid']."</loc>\n";
        $sitemap .= "\t\t</url>\n";
    }
    
    foreach(JPages::getEvents(0,"ispublish=1") as $e) {
        $sitemap .= "\t\t<url>\n";
            $sitemap .= "\t\t\t<loc>".JFrame::getAppSetting('siteurl')."/index.php?page=".$e['pageid']."</loc>\n";
        $sitemap .= "\t\t</url>\n";
    }
     
    foreach(JPages::getNews(0,"ispublish=1") as $n) {
        $sitemap .= "\t\t<url>\n";
            $sitemap .= "\t\t\t<loc>".JFrame::getAppSetting('siteurl')."/index.php?page=".$n['pageid']."</loc>\n";
        $sitemap .= "\t\t</url>\n";
    }
    
    foreach(JPhotogallery::getPhotoGalleries(0,"ispublished=1") as $pho) {
        $sitemap .= "\t\t<url>\n";
            $sitemap .= "\t\t\t<loc>".JFrame::getAppSetting('siteurl')."/photos.php?groupid=".$pho['groupid']."</loc>\n";
        $sitemap .= "\t\t</url>\n";
    }
    
      
    foreach(JDownloads::getDownloadAlbum(0,"ispublish=1") as $d) {
        $sitemap .= "\t\t<url>\n";
            $sitemap .= "\t\t\t<loc>".JFrame::getAppSetting('siteurl')."/downloads.php?dalbum=".$d['dalbumid']."</loc>\n";
        $sitemap .= "\t\t</url>\n";
    }
    
    foreach(JMusics::getMusicAlbum(0,"ispublish=1") as $m) {
        $sitemap .= "\t\t<url>\n";
            $sitemap .= "\t\t\t<loc>".JFrame::getAppSetting('siteurl')."/musics.php?album=".$m['albumid']."</loc>\n";
        $sitemap .= "\t\t</url>\n";
    }
    
    foreach(JVideos::getVideos() as $v) {
        $sitemap .= "\t\t<url>\n";
            $sitemap .= "\t\t\t<loc>".JFrame::getAppSetting('siteurl')."/videos.php?viewvid=".$v['videoid']."</loc>\n";
        $sitemap .= "\t\t</url>\n";
    }
    
        
    foreach(JSuccessStory::getStory(0,"ispublish=1") as $s) {
        $sitemap .= "\t\t<url>\n";
            $sitemap .= "\t\t\t<loc>".JFrame::getAppSetting('siteurl')."/index.php?spage=".$s['storyid']."</loc>\n";
        $sitemap .= "\t\t</url>\n";
    }
    
    foreach(JSuccessStory::getTestimonials(0,"ispublish=1") as $t) {
        $sitemap .= "\t\t<url>\n";
            $sitemap .= "\t\t\t<loc>".JFrame::getAppSetting('siteurl')."/index.php?spage=".$t['storyid']."</loc>\n";
        $sitemap .= "\t\t</url>\n";
    }
    
        $sitemap .= "\t\t<url>\n";
            $sitemap .= "\t\t\t<loc>".JFrame::getAppSetting('siteurl')."/testimonials.php"."</loc>\n";
        $sitemap .= "\t\t</url>\n"; 
        
        $sitemap .= "\t\t<url>\n";
            $sitemap .= "\t\t\t<loc>".JFrame::getAppSetting('siteurl')."/successstory.php"."</loc>\n";
        $sitemap .= "\t\t</url>\n";
        
        $sitemap .= "\t\t<url>\n";
            $sitemap .= "\t\t\t<loc>".JFrame::getAppSetting('siteurl')."/musics.php"."</loc>\n";
        $sitemap .= "\t\t</url>\n";
        
        $sitemap .= "\t\t<url>\n";
            $sitemap .= "\t\t\t<loc>".JFrame::getAppSetting('siteurl')."/news.php"."</loc>\n";
        $sitemap .= "\t\t</url>\n";
        
         $sitemap .= "\t\t<url>\n";
            $sitemap .= "\t\t\t<loc>".JFrame::getAppSetting('siteurl')."/faq.php"."</loc>\n";
        $sitemap .= "\t\t</url>\n";
        
        $sitemap .= "\t\t<url>\n";
            $sitemap .= "\t\t\t<loc>".JFrame::getAppSetting('siteurl')."/events.php"."</loc>\n";
        $sitemap .= "\t\t</url>\n";
        
        $sitemap .= "\t\t<url>\n";
            $sitemap .= "\t\t\t<loc>".JFrame::getAppSetting('siteurl')."/downloads.php"."</loc>\n";
        $sitemap .= "\t\t</url>\n";
        
        $sitemap .= "\t\t<url>\n";
            $sitemap .= "\t\t\t<loc>".JFrame::getAppSetting('siteurl')."/photos.php"."</loc>\n";
        $sitemap .= "\t\t</url>\n";
        
        $sitemap .= "\t\t<url>\n";
            $sitemap .= "\t\t\t<loc>".JFrame::getAppSetting('siteurl')."/videos.php"."</loc>\n";
        $sitemap .= "\t\t</url>\n";
        
        $sitemap .= "\t\t<url>\n";
            $sitemap .= "\t\t\t<loc>".JFrame::getAppSetting('siteurl')."</loc>\n";
        $sitemap .= "\t\t</url>\n";
        
        $sitemap .= "\t\t<url>\n";
            $sitemap .= "\t\t\t<loc>".JFrame::getAppSetting('siteurl')."/index.php"."</loc>\n";
        $sitemap .= "\t\t</url>\n";
        
        foreach(JPages::getEvents(0,"ispublish=1") as $ep) {
        $sitemap .= "\t\t<url>\n";
            $sitemap .= "\t\t\t<loc>".JFrame::getAppSetting('siteurl')."/events.php?p=".$ep['pageid']."</loc>\n";
        $sitemap .= "\t\t</url>\n";
        }
        
        foreach(JPages::getNews(0,"ispublish=1") as $np) {
        $sitemap .= "\t\t<url>\n";
            $sitemap .= "\t\t\t<loc>".JFrame::getAppSetting('siteurl')."/news.php?p=".$np['pageid']."</loc>\n";
        $sitemap .= "\t\t</url>\n";
        }
        
        foreach(JSuccessStory::getStory(0,"ispublish=1") as $sp) {
        $sitemap .= "\t\t<url>\n";
            $sitemap .= "\t\t\t<loc>".JFrame::getAppSetting('siteurl')."/successstory.php?p=".$sp['storyid']."</loc>\n";
        $sitemap .= "\t\t</url>\n";
        } 
    
        foreach(JSuccessStory::getTestimonials(0,"ispublish=1") as $st) {
        $sitemap .= "\t\t<url>\n";
            $sitemap .= "\t\t\t<loc>".JFrame::getAppSetting('siteurl')."/testimonials.php?p=".$st['storyid']."</loc>\n";
        $sitemap .= "\t\t</url>\n";
        }
      
    $sitemap .= "</urlset>";
    
    $mysql->insert("_jsitemap",array("postedon"=>date("Y-m-d H:i:s"),"content"=>$sitemap));
    echo $obj->printSuccess("Site Map Generated Successfully");
    }
?>
    
<script src="./../../assets/js/jquery-1.7.2.js"></script>
<link rel="stylesheet" href="./../../assets/css/demo.css"> 
 <body style="margin:0px;">
 <div class="titleBar">Generate Site Map</div>   
    <form action="" method="post" name="siteid" id="siteid">
            <table style="margin:10px;width:100%;font-size:12px;font-family:'Trebuchet MS';color:#333" cellpadding="3" cellspacing="0" align="center">
                 <tr>
                    <td>
                         <input type="submit" value="Generate Sitemap" name="sitemapid" id="sitemapid">
                    </td>
                 </tr>
            </table>
        </form>
    <?php 
    $data = $mysql->select("select * from _jsitemap order by sitemapid desc");      
        foreach ($data as $r){ 
    ?>
        <table  cellspacing='0' cellspadding='5' style='font-size:13px;font-family:"Trebuchet MS";color:#222;'>
            <tr>
                <td style='padding-bottom:10px;'>
                    Date Of Generated: <span style="color:#444;font-weight:bold;"><?php echo $r["postedon"]; ?></span>
                </td>
                <td width='80' style='text-align:center;'>
                    <form action='viewsitemap.php' method='post'>
                        <input type='hidden' value='<?php echo $r["sitemapid"];?>' name='rowid' id='rowid'>
                        <input style='font-size:11px;' type='submit' name='viewbtn' value='View'>
                    </form>
                </td>
            </tr>
         </table>
    <?php } ?>
</body>
<script>$('#success').hide(3000);</script>   