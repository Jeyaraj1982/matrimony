<?php
    $home = $mysql->select("select * from _jpages where ishomepage=1");

    if (sizeof($home)>0) {
        
    $pageContent = $mysql->select("select * from _jpages where pageid=".$home[0]['pageid']);
    echo "<div style='padding:10px;font-family:arial;font-size:13px;text-align:justify;'>";
    echo "<div style='font-family:arial;font-size:18px;font-weight:bold;border-bottom:2px solid #222;margin-bottom:10px;padding-bottom:10px;'>".$pageContent[0]['pagetitle']."</div>";
    if ( (strlen(trim($pageContent[0]['filepath']))>0) && (file_exists("assets/cms/".$pageContent[0]['filepath']))) {
        echo "<img style='border:1px solid #ccc;height:140px' src='assets/cms/".$pageContent[0]['filepath']."'  align='right'>";    
    }
    echo $pageContent[0]['pagedescription'];
    echo "</div>";
    
    }
    
?> 
<style>
.amazon_scroller{
    padding: 0px;
    margin: 0px;
    border-radius: 10px;
    -webkit-border-radius: 10px;
    -moz-border-radius: 10px;
    -o-border-radius: 10px;
    -khtml-border-radius: 10px;
}
.amazon_scroller .amazon_scroller_nav{
    position: absolute;
}
.amazon_scroller .amazon_scroller_nav li{
    cursor: pointer;
    position: absolute;
}
.amazon_scroller .amazon_scroller_mask{
    position: absolute;
    margin-left: 30px;
    margin-right: 30px;
    overflow: hidden;
}
.amazon_scroller ul{
    padding: 0px;
    margin: 0px;
    float: left;
}
.amazon_scroller ul li{
    padding: 0px;
    margin: 0px;
    margin-left: 15px;
    margin-right: 15px;
    list-style: none;
    float: left;
    text-align: center;
    display:inline;
}
.amazon_scroller ul li a{
    text-decoration: none;
}
.amazon_scroller ul li a {
    overflow:hidden;
}
.amazon_scroller ul li a:hover{
    text-decoration: underline;
}
.amazon_scroller ul li a img{
    border: none;
}

.amazon_scroller { background-color:#FAFAFA !important; }

.amazon_scroller_mask {   width: 94% !important; }
#amazon_scroller1 {   width: 100% !important; padding:10px 0% !important; border:0 !important; height:262px !important; overflow:hidden;  }
#amazon_scroller2 {   width: 100% !important; padding:10px 0% !important; border:0 !important; height:262px !important; overflow:hidden;  }

.amazon_scroller_nav { width: 95.5% !important; top:40% !important; }
.scroll_li { width:165px !important; }
.scroll_li a:hover { text-decoration:none; }

li.right_arr { left: 101.6% !important; }

.top-profiles.bg-grey { width:99.9% !important; border-radius: 0 10px 10px !important; }

.amazon_scroller .amazon_scroller_nav li { margin-left: 0px; margin-right: 0px; }
</style>
<script>
// Copyright 2010 htmldrive.net Inc.
/**
* @projectHomepage http://www.htmldrive.net/welcome/amazon-scroller
* @projectDescription Amazon style image and title scroller
* @author htmldrive.net
* More script and css style : htmldrive.net
* @version 1.0
* @license http://www.apache.org/licenses/LICENSE-2.0
*/ 
(function(a){
    a.fn.amazon_scroller=function(p){
        var p=p||{};

        var g=p&&p.scroller_time_interval?p.scroller_time_interval:"3000";
        var h=p&&p.scroller_title_show?p.scroller_title_show:"enable";
        var i=p&&p.scroller_window_background_color?p.scroller_window_background_color:"white";
        var j=p&&p.scroller_window_padding?p.scroller_window_padding:"5";
        var k=p&&p.scroller_border_size?p.scroller_border_size:"1";
        var l=p&&p.scroller_border_color?p.scroller_border_color:"grey";
        var m=p&&p.scroller_images_width?p.scroller_images_width:"170";
        var n=p&&p.scroller_images_height?p.scroller_images_height:"150";
        var o=p&&p.scroller_title_size?p.scroller_title_size:"12";
        var q=p&&p.scroller_title_color?p.scroller_title_color:"blue";
        var r=p&&p.scroller_show_count?p.scroller_show_count:"3";
        var d=p&&p.directory?p.directory:"images";
        j += "px";
        k += "px";
        m += "px";
        n += "px";
        o += "px";
        var dom=a(this);
        var s;
        var t=0;
        var u;
        var v;
        var w=dom.find("ul:first").children("li").length;
        var x=Math.ceil(w/r);
        if(dom.find("ul").length==0||dom.find("li").length==0){
            dom.append("Require content");
            return null
        }
        dom.find("ul:first").children("li").children("a").children("img").css("width",m).css("height",n);
        if(h=='enable'){

            dom.find("ul:first").children("li").css("height",n+o+"px");
        }else{
            dom.find("ul:first").children("li").css("height",n+"px");
        }
        
        s_s_ul(dom,j,k,l,i);
        s_s_nav(dom.find(".amazon_scroller_nav"),d);
        m=parseInt(m);
        dom.find("ul:first").children("li").css("width",m+"px");
        n=parseInt(n);
        
        dom.find("ul:first").children("li").children("a").css("color",q);
        dom.find("ul:first").children("li").children("a").css("font-size",o);
        begin();
        s=setTimeout(play,g);
        dom.find(".amazon_scroller_nav").children("li").hover(
            function(){
                if($(this).parent().children().index($(this))==0){
                    $(this).css("background-position","left -50px");
                }else if($(this).parent().children().index($(this))==1){
                    $(this).css("background-position","right -50px");
                }
            },
            function(){
                if($(this).parent().children().index($(this))==0){
                    $(this).css("background-position","left top");
                }else if($(this).parent().children().index($(this))==1){
                    $(this).css("background-position","right top");
                }
            }
            );
        dom.find(".amazon_scroller_nav").children("li").click(function(){
            if($(this).parent().children().index($(this))==0){
                previous()
            }else if($(this).parent().children().index($(this))==1){
                next()
            }
        });
        dom.hover(
            function(){
                clearTimeout(s);
            },
            function(){
                s=setTimeout(play,g);
            }
        );
        function begin(){
            var a=dom.find("ul:first").children("li").outerWidth(true)*w;
            dom.find("ul:first").children("li").hide();
            dom.find("ul:first").children("li").slice(0,r).show();
            u=dom.find("ul:first").outerWidth();
            v=dom.find("ul:first").outerHeight();
            dom.find("ul:first").width(a);
            dom.width(u+60);
            dom.height(v);
            dom.children(".amazon_scroller_mask").width(u);
            dom.children(".amazon_scroller_mask").height(v);
            dom.find("ul:first").children("li").show();
            dom.css("position","relative");
            dom.find("ul:first").css("position","absolute");
            dom.children(".amazon_scroller_mask").width(u);
            dom.children(".amazon_scroller_mask").height(v);
            dom.find(".amazon_scroller_nav").css('top',(v-50)/2+parseInt(j)+"px");
            dom.find(".amazon_scroller_nav").width(u+60)
            dom.find("ul:first").clone().appendTo(dom.children(".amazon_scroller_mask"));
            dom.children(".amazon_scroller_mask").find("ul:last").css("left",a);
        }
        function previous(){
            clearTimeout(s);
            if(t > 0){
                t--;
                dom.children(".amazon_scroller_mask").find("ul").animate({
                    left: '+='+(m+49)
                },1000);
            }
        }
        function next(){
            play();
        }
        function play(){
            clearTimeout(s);
            t++;
            var a = dom.find("ul:first").children("li").outerWidth(true)*w;
            if(t >= w+1){
                t = 0;
                dom.children(".amazon_scroller_mask").find("ul:first").css("left","0px");
                dom.children(".amazon_scroller_mask").find("ul:last").css("left",a);
                s=setTimeout(play,0);
            }else{
                dom.children(".amazon_scroller_mask").find("ul").animate({
                    left: '-='+(m+72)
                },1000);
                s=setTimeout(play,g);
            }
        }
        function s_s_ul(a,b,c,d,e){
            b=parseInt(b);
            c=parseInt(c);
            var f="border: "+d+" solid "+" "+c+"px; padding:"+b+"px; background-color:"+e;
            a.attr("style",f)
        }
        function s_s_nav(a,d){
            var b=a.children("li:first");
            var c=a.children("li:last");
            a.children("li").css("width","25px");
            a.children("li").css("height","50px");
            a.children("li").css('background-image','url("'+d+'/arrow.png")');
            c.css('background-position','right top');
            a.children("li").css('background-repeat','no-repeat');
            c.css('right','0px');
            b.css('left','0px');
        }
    }
})(jQuery);
</script>
<script type="text/javascript">
       $(function() {
                $("#amazon_scroller1").amazon_scroller({
                    scroller_title_show: 'enable',
                    scroller_time_interval: '2000',
                    scroller_window_background_color: "#CCC",
                    scroller_window_padding: '10',
                    scroller_border_size: '1',
                    scroller_border_color: '#000',
                    scroller_images_width: '124',
                    scroller_images_height: '160',
                    scroller_title_size: '12',
                    scroller_title_color: 'black',
                    scroller_show_count: '4',
                    directory: 'images'
                });
				$("#amazon_scroller2").amazon_scroller({
                    scroller_title_show: 'enable',
                    scroller_time_interval: '2000',
                    scroller_window_background_color: "#CCC",
                    scroller_window_padding: '10',
                    scroller_border_size: '1',
                    scroller_border_color: '#000',
                    scroller_images_width: '124',
                    scroller_images_height: '160',
                    scroller_title_size: '12',
                    scroller_title_color: 'black',
                    scroller_show_count: '4',
                    directory: 'images'
                });
                
                
            });
    </script>
    <h2>Feature Groom</h2>
<div id="amazon_scroller1" class="amazon_scroller" style="border: 1px solid rgb(0, 0, 0); padding: 10px; background-color: rgb(204, 204, 204); width: 840px; height: 246px; position: relative;">
            <div class="amazon_scroller_mask" style="width: 780px; height: 246px;">
                <ul style="width: 4095px; position: absolute; left: -1368.77px;">
                <?php  include_once(application_config_path);
                     $response = $webservice->getData("Member","GetFeatureGroom"); 
                     
                     foreach($response['data'] as $p) { 
 $Profile=$p['ProfileInfo'] 
                ?> 
                               
                <li class="scroll_li" style="width: 124px; display: block;">
                  <a href="Profile.php?Code=<?php echo $Profile['ProfileCode']?>" style="color: black; font-size: 12px;">
					<div width="160" height="132" style="border:1px solid black;border-radius:5px">
						<div class="form-group row">
							<div class="col-sm-12">
								<img src="<?php echo $p['ProfileThumb'];?>" class="vtip" width="160" height="170">
							</div>
							<div class="col-sm-12">
								<strong style="font-size:12px;"><?php echo $Profile['ProfileName'];?></strong><br>
								<strong>Age : </strong><span style="width:auto;"><?php echo $Profile['Age'];?></span>
							</div>
						</div>
                    </div>
                  </a>
                  
                </li>
                           
  <?php } ?>              
                                   
                </ul>
            </div>
            <ul class="amazon_scroller_nav" style="top: 108px; width: 840px;">
                <li style="width: 25px; height: 50px;"><img src="website/assets/images/leftarrow.jpg" style="height:25px"></li>
                <li class="right_arr" style="width: 25px; height: 50px;" ><img src="website/assets/images/arrow.jpg" style="height:25px"></li>
            </ul>
            <div style="clear: both"></div>
        </div> 
        <br><br>
        <h2>Feature Bride</h2>
<div id="amazon_scroller2" class="amazon_scroller" style="border: 1px solid rgb(0, 0, 0); padding: 10px; background-color: rgb(204, 204, 204); width: 840px; height: 246px; position: relative;">
            <div class="amazon_scroller_mask" style="width: 780px; height: 246px;">
                <ul style="width: 4095px; position: absolute; left: -1368.77px;">
                <?php  include_once(application_config_path);
                     $response = $webservice->getData("Member","GetFeatureBride"); 
					
                     foreach($response['data'] as $p) { 
 $Profile=$p['ProfileInfo'] 
                ?> 
                               
                          <li class="scroll_li" style="width: 124px; display: block;">
                  <a href="Profile.php?Code=<?php echo $Profile['ProfileCode']?>" style="color: black; font-size: 12px;">
                <!-- <a href="member_login.php">-->
                    <div width="160" height="132" style="border:1px solid black;border-radius:5px">
						<div class="form-group row">
							<div class="col-sm-12">
								<img src="<?php echo $p['ProfileThumb'];?>" class="vtip" width="160" height="170">
							</div>
							<div class="col-sm-12">
								<strong style="font-size:12px;"><?php echo $Profile['ProfileName'];?></strong><br>
								<strong>Age : </strong><span style="width:auto;"><?php echo $Profile['Age'];?></span>
							</div>
						</div>
                    </div>
                </li>
                           
  <?php } ?>              
                                   
                </ul>
            </div>
            <ul class="amazon_scroller_nav" style="top: 108px; width: 840px;">
                <a href="javascript:void(0)"><li style="width: 25px; height: 50px;"><img src="website/assets/images/leftarrow.jpg" style="height:25px"></li></a>
                <a href="javascript:void(0)"><li class="right_arr" style="width: 25px; height: 50px;" ><img src="website/assets/images/arrow.jpg" style="height:25px"></li></a>
            </ul>
            <div style="clear: both"></div>
        </div>
      <br><br>
      
      
       <table style="width:100%;" cellpadding="0" cellspacing="0">
            <tr>
                <?php if ( (JFrame::getAppSetting('isenablephoto')) || (JFrame::getAppSetting('isenablevideo')) )  {?>
                    <td valign="top">
                        <?php
                        if (JFrame::getAppSetting('isenableevents')) {  
                        include_once("includes/hp_feature_events.php");
                        }
                        ?>
                    </td>
                    <td width="10">&nbsp;</td>
                    <td width="300" style="vertical-align: top;">
                        <?php 
                         if (JFrame::getAppSetting('isenablephoto')) {
                              include_once("includes/hp_feature_photos.php");
                         }
                         echo "<br>";
                         if (JFrame::getAppSetting('isenablevideo')) {
                              include_once("includes/hp_feature_videos.php");
                         } 
                         ?>
                    </td>
                    
                <?php } else { ?>
                    <td colspan="3"  valign="top">
                        <?php 
                          if (JFrame::getAppSetting('isenableevents')) {
                             include_once("includes/hp_feature_events.php");
                          }
                        ?>
                    </td>
                    <?php } ?>
                
            </tr>
             <tr>
                  <td colspan="3">
                     <?php 
                      if (JFrame::getAppSetting('isenablenews')) {
                          include_once("includes/hp_feature_news.php");
                      }
                     ?>
                  </td>
            </tr>
        </table>