    <style>
        .detailsEnquiry {font-family:arial;background:#333;border:1px solid #222;text-decoration:none;padding:13px 26px;color:#f1f1f1;border-radius:3px}
        .detailsEnquiry:hover { background:#444;border:1px solid #333;}
    </style>
    
    <script type="text/javascript" src="assets/lib/jquery.mousewheel-3.0.6.pack.js"></script>
<link rel="stylesheet" href="assets/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
<script type="text/javascript" src="assets/source/jquery.fancybox.pack.js?v=2.1.5"></script>
<link rel="stylesheet" href="assets/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
<script type="text/javascript" src="assets/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
<script type="text/javascript" src="assets/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
<link rel="stylesheet" href="assets/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
<script type="text/javascript" src="assets/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

<div>
    <?php
        $images = JListing::getItemImages($r['itemid']);
    ?>
    <table style="width:100%" cellspacing="0" cellpadding="15" style="font-family:arial;font-size:12px;color:#333">
        <tr>
            <td colspan="2" style="padding:0px;">
                <div style="background:#f1f1f1">
                    <table style="width:100%">
                        <tr>
                            <td>
                                <a href="" style="text-decoration:none;font-family:arial;font-size:12px;color:#333"><?php echo $r["categoryname"];?></a>&nbsp;/&nbsp;
                                <a href="<?php echo $_SITEPATH."item/".$r["itemfilename"].".html";?>" style="text-decoration:none;font-family:arial;font-size:12px;color:#333"><?php echo $r["itemname"];?></a>
                            </td>
                            <td style="width:200px;text-align:right">
                                <a title="Facebook" onclick="postToFB('top','<?php echo $_SITEPATH."item/".$r["itemfilename"].".html";?>'); return false;" style="cursor: pointer;"><img src="<?php echo $_SITEPATH;?>assets/images/fb-icon.png"></a>
                                <a title="Facebook" onclick="postToTWTTR('top','<?php echo $_SITEPATH."item/".$r["itemfilename"].".html";?>'); return false;" style="cursor: pointer;"><img src="<?php echo $_SITEPATH;?>assets/images/icon-twitter.png"></a>
                                <a title="Google+" onclick="postToGPlus('top','<?php echo $_SITEPATH."item/".$r["itemfilename"].".html";?>'); return false;" style="cursor: pointer;"><img src="<?php echo $_SITEPATH;?>assets/images/google-icon.png"></a>
                                <a title="Whatapp" onclick="postToWhatsApp('<?php echo $r["itemname"];?>'); return false;" style="cursor: pointer;"><img src="<?php echo $_SITEPATH;?>assets/images/Whatsup-icon.png"></a>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
        <tr>
            <td style="width:296px;vertical-align: top;background:#fff;border-right:1px solid #efefef">
                <div style="text-align: center;">
                <a class="fancybox" rel="gallery1" href="<?php echo $_SITEPATH."assets/".$config['thumb'].$r["filename"];?>" title="<?php echo $r["itemname"];?> " style="outline:none">
                    <img id="item_image" src="<?php echo $_SITEPATH."assets/".$config['thumb'].$r["filename"];?>" style="height:210px;width:282px;">
                    </a>
                </div>
                <div style="padding-top:3px;">
                    <?php foreach($images as $i) {?>
                    
                        <?php if ($i['ispublished']==1 ) { ?>
                        <div style="width:68px;height:49px;float:left;font-size:11px;text-align:center;font-family:arial;border:3px solid #fff">
                            <a class="fancybox" rel="gallery1" href="<?php echo $_SITEPATH."assets/".$config['thumb']."/".$i["filename"];?>" title="<?php echo $r["itemname"];?> " style="outline:none">
                                <img src="<?php echo $_SITEPATH."assets/".$config['thumb']; ?><?php echo $i['filename'];?>" style="height:49px;width:68px;border:1px solid #e5e5e5;">
                            </a>
                        </div>
                        <?php }  ?>
                    
                    <?php } ?>
                </div>
            </td>
            <td style="vertical-align: top;background:#fff;font-family:arial;font-size:12px;color:#444">
                <div id="item_title" style="clear: both;;font-size:22px;font-family:arial;color:#444" >
                    <?php echo $r["itemname"];?> 
                    <div style="padding-top:5px;font-size:12px;font-family:arial;color:#666;" id="item_shortdesc">
                        <?php echo ucfirst(strip_tags($r["shortdescription"]));?>
                    </div>
                </div>

                <hr style="border:none;border-bottom:1px solid #e5e5e5">
                <?php $displayPrice=false; ?>
                <?php if ($displayPrice) { ?>
                <div style="font-size:18px;font-family:arial;color:red">
                    <?php echo JFrame::getAppSetting("currencysymbol");?><?php echo $r["itemprice"];?>
                </div>   
                
               
                <?php } ?>
                <Br><Br><Br> 
                 
                <div style="clear: both;">
                    <a class="detailsEnquiry" href="<?php echo $_SITEPATH;?>enquiry/<?php echo ($r["itemfilename"]);?>.html">Enquiry Now</a>
                </div>             
                
                
                <?php 
                $features = $mysql->select("SELECT * FROM _jlistingfeature AS listfeature, _jfeature AS jfeature WHERE jfeature.featureid=listfeature.featureid AND listfeature.itemid=".$r["itemid"]); 
                if (sizeof($features)>0) {
                ?>
                <Br><Br>
                <b>Features:</b> 
                <table style="margin:10px;font-family:arial;font-size:12px;color:#444">
                    <?php foreach($features as $f) { ?>
                       <tr>
                            <td><?php echo $f['featurename'];?></td>
                            <td>:</td>
                            <td><?php echo $f['itemvalue'];?></td>
                       </tr>
                    <?php } ?>
                </table>
                <?php }?>
                 <Br>
                <b>Detailed Descriptions:</b>
                <div style="padding-top:5px;font-size:12px;font-family:arial;color:#666;" id="item_shortdesc">
                    <?php echo  $r["itemdesc"];?>
                </div>
            </td>
        </tr>
    </table>
</div>

       <script>
         
         $(document).ready(function() {
    $(".fancybox").fancybox({
        openEffect    : 'none',
        closeEffect    : 'none',
          helpers: { 
        title: null
    }
    });
});

</script>