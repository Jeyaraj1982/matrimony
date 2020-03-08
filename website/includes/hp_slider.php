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
  
           <!-- <div class="carousel-caption d-none d-md-block">
    <h5 style="font-size:40px;font-family:arial;">Welcome to Nanjil Properties</h5>
    <p>We are a premier real estate service provider in kanyakumari district.
    We are providing online real estate advertisement & dealing with consumer services .
    <br />     <br /><br />
    <button type="button" class="btn btn-success btn-lg">Post Your requirement</button>
    <button type="button" class="btn btn-outline-success btn-lg">Browser property</button>
    </p>
    
  </div> -->
  
  <div class="carousel-inner">

<!--    <div class="carousel-item active">
      <img src="https://thumbor.forbes.com/thumbor/960x0/https%3A%2F%2Fspecials-images.forbesimg.com%2Fdam%2Fimageserve%2F556528705%2F960x0.jpg%3Ffit%3Dscale" alt="Los Angeles" style="height:400px;width:100%;border-radius:5px">
   
    </div>
    <div class="carousel-item">
      <img src="https://blog.hubspot.com/hubfs/Sales_Blog/real-estate-business-compressor.jpg" alt="Chicago"  style="height:400px;width:100%;border-radius:5px">
    </div>
    <div class="carousel-item">
      <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSFXHIKxYGs2C1yWMrbzGM7FMKzkrTFtNEaxTzs0xxbflyxcrSXhA&s" alt="New York" style="height:400px;width:100%;border-radius:5px">
    </div>
  </div>  -->
  
      <?php $i=0; foreach(JSlider::getActiveSliders() as $sliderimage) {?>
    <div class="carousel-item <?php echo ($i==0) ? ' active ' : "";?>">
        <img src="<?php echo BaseUrl;?><?php echo $config['slider'].$sliderimage['filepath'];?>" alt="Los Angeles"  style="height:400px;width:100%;border-radius:5px">
    </div>
  <?php $i++;} ?>
      
  
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
 
 
 
      