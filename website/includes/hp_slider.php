<?php if (JFrame::getAppSetting('slider_top_space')>0) {?>
    <div style="height:<?php echo JFrame::getAppSetting('slider_top_space');?>px;<?php echo (JFrame::getAppSetting('slider_top_space_need_color')==1) ? "background:#".JFrame::getAppSetting('slider_top_space_color') : "";?>"></div>  
<?php } ?>
<div id="demo" class="carousel slide" data-ride="carousel" style="margin-bottom:50px;;">
  <!-- Indicators -->
  <ul class="carousel-indicators">
    <li data-target="#demo" data-slide-to="0" class="active"></li>
    <li data-target="#demo" data-slide-to="1"></li>
    <li data-target="#demo" data-slide-to="2"></li>
  </ul>
  <div class="carousel-inner">
    <?php $i=0; foreach(JSlider::getActiveSliders() as $sliderimage) {?>
    <div class="carousel-item <?php echo ($i==0) ? ' active ' : "";?>">
        <img src="<?php echo BaseUrl;?><?php echo $config['slider'].$sliderimage['filepath'];?>" alt="Los Angeles"  style="width:100%;min-height:150px">
    </div>
    <?php 
        $i++; 
    } 
    ?>
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