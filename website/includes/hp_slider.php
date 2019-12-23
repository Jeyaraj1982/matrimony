<?php if (JFrame::getAppSetting('slider_top_space')>0) {?>
    <div style="height:<?php echo JFrame::getAppSetting('slider_top_space');?>px;<?php echo (JFrame::getAppSetting('slider_top_space_need_color')==1) ? "background:#".JFrame::getAppSetting('slider_top_space_color') : "";?>"></div>  
<?php } ?>
<div id="demo" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ul class="carousel-indicators">
    <?php $i=0; foreach(JSlider::getActiveSliders() as $sliderimage) {?>
    <li data-target="#demo" data-slide-to="<?php echo $i;?>" <?php echo ($i==0) ? '  class="active" ' : "";?> ></li>
    <?php $i++;} ?>
  </ul>
  <!-- The slideshow -->
  <div class="carousel-inner">
    <?php $i=0; foreach(JSlider::getActiveSliders() as $sliderimage) {?>
    <div class="item <?php echo ($i==0) ? ' active ' : "";?>">
        <img src="<?php echo BaseUrl;?><?php echo $config['slider'].$sliderimage['filepath'];?>" alt="Los Angeles">
    </div>
  <?php $i++;} ?>
  </div>
<!-- Left and right controls -->
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div>
<?php if (JFrame::getAppSetting('slider_bottom_space')>0) {?>
    <div style="height:<?php echo JFrame::getAppSetting('slider_bottom_space');?>px;<?php echo (JFrame::getAppSetting('slider_bottom_space_need_color')==1) ? "background:#".JFrame::getAppSetting('slider_bottom_space_color') : "";?>"></div>  
<?php } ?>
<!--
<tr>
    <td>
        <style type="text/css">
            ul.bjqs{position:relative; list-style:none;padding:0;margin:0;overflow:hidden; display:none;}
            li.bjqs-slide{position:absolute; display:none;}
            ul.bjqs-controls{list-style:none;margin:0;padding:0;z-index:9999;}
            ul.bjqs-controls.v-centered li a{position:absolute;}
            ul.bjqs-controls.v-centered li.bjqs-next a{right:0;}
            ul.bjqs-controls.v-centered li.bjqs-prev a{left:0;}
            ol.bjqs-markers{list-style: none; padding: 0; margin: 0; width:100%;display:none;}
            ol.bjqs-markers.h-centered{text-align: center;}
            ol.bjqs-markers li{display:inline;}
            ol.bjqs-markers li a{display:inline-block;}
            p.bjqs-caption{display:block;width:96%;margin:0;padding:2%;position:absolute;bottom:0;}
            #container{max-width:620px;margin:0 auto;padding-bottom:80px;}
            #banner-fade, #banner-slide{margin-bottom:0px;}
            ul.bjqs-controls.v-centered li a{display:<?php echo JFrame::getAppSetting('sliderhideicon');?>;padding:10px;background:#fff;font-family:Trebuchet MS;font-size:13px;color:#000;text-decoration: none;}
            ul.bjqs-controls.v-centered li a:hover{background:#000;color:#fff;}
            ol.bjqs-markers li a{padding:5px 10px;background:#000;color:#fff;margin:5px;text-decoration: none;}
            ol.bjqs-markers li.active-marker a, ol.bjqs-markers li a:hover{background: #999;}
            p.bjqs-caption{background: rgba(255,255,255,0.5);}
            .bjqs {
                border-left:<?php echo JFrame::getAppSetting('slider_border_left_size');?>px solid #<?php echo JFrame::getAppSetting('slider_border_left_color');?>;
                border-right:<?php echo JFrame::getAppSetting('slider_border_right_size');?>px solid #<?php echo JFrame::getAppSetting('slider_border_right_color');?>;
                border-top:<?php echo JFrame::getAppSetting('slider_border_top_size');?>px solid #<?php echo JFrame::getAppSetting('slider_border_top_color');?>;
                border-bottom:<?php echo JFrame::getAppSetting('slider_border_bottom_size');?>px solid #<?php echo JFrame::getAppSetting('slider_border_bottom_color');?>;
                border-radius: <?php echo JFrame::getAppSetting('slider_border_radius_left_top');?>px <?php echo JFrame::getAppSetting('slider_border_radius_right_top');?>px <?php echo JFrame::getAppSetting('slider_border_radius_right_bottom');?>px <?php echo JFrame::getAppSetting('slider_border_radius_left_bottom');?>px;
            }
        </style>
        <script src="<?php echo BaseUrl;?>assets/js/bjqs-1.3.min.js"></script>
        <?php if (JFrame::getAppSetting('slider_top_space')>0) {?>
            <div style="height:<?php echo JFrame::getAppSetting('slider_top_space');?>px;<?php echo (JFrame::getAppSetting('slider_top_space_need_color')==1) ? "background:#".JFrame::getAppSetting('slider_top_space_color') : "";?>"></div>  
        <?php } ?>
        <div id="banner-fade">
            <ul class="bjqs">
                <?php foreach(JSlider::getActiveSliders() as $sliderimage) {?>
                <li><img src='<?php echo BaseUrl;?>assets/<?php echo $config['slider'].$sliderimage['filepath'];?>'></li>
                <?php } ?>
            </ul>
        </div>
        <?php if (JFrame::getAppSetting('slider_bottom_space')>0) {?>
            <div style="height:<?php echo JFrame::getAppSetting('slider_bottom_space');?>px;<?php echo (JFrame::getAppSetting('slider_bottom_space_need_color')==1) ? "background:#".JFrame::getAppSetting('slider_bottom_space_color') : "";?>"></div>  
        <?php } ?>
        <script class="secret-source">jQuery(document).ready(function($) {$('#banner-fade').bjqs({height:<?php echo JFrame::getAppSetting('slider_height');?>,width:'100%',responsive:true});});</script>
    </td>
</tr>
-->