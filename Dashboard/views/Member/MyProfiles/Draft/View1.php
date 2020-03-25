<?php
    $response = $webservice->getData("Member","GetDraftProfileInfo",array("ProfileCode"=>$_GET['Code']));
    $ProfileInfo          = $response['data']['ProfileInfo'];
    $Member = $response['data']['Members'];
    $EducationAttachment = $response['data']['EducationAttachments'];
    $PartnerExpectation = $response['data']['PartnerExpectation'];
?>
 <style>
 .MultiCarousel { float: left; overflow: hidden; padding: 15px; width: 100%; position:relative; }
    .MultiCarousel .MultiCarousel-inner { transition: 1s ease all; float: left; }
        .MultiCarousel .MultiCarousel-inner .item { float: left;}
        .MultiCarousel .MultiCarousel-inner .item > div { text-align: center; padding:10px; margin:10px; background:#f1f1f1; color:#666;}
    .MultiCarousel .leftLst, .MultiCarousel .rightLst { position:absolute; border-radius:50%;top:calc(50% - 20px); }
    .MultiCarousel .leftLst { left:0; }
    .MultiCarousel .rightLst { right:0; }
    
        .MultiCarousel .leftLst.over, .MultiCarousel .rightLst.over { pointer-events: none; background:#ccc; }
 
  .form-group {
    margin-bottom: 0px;
}
.photoview {
    float: right;
    margin-right: 10px;
    margin-bottom: 10px;
}
 </style>
<form method="post" action="" onsubmit="">
<?php if($ProfileInfo['RequestToVerify']=="0"){?>
<div class="col-12 grid-margin" style="text-align:right"> 
        <a href="<?php echo GetUrl("MyProfiles/Draft/Edit/GeneralInformation/".$_GET['Code'].".htm ");?>">Edit</a>&nbsp;
        <a href="javascript:void(0)" onclick="showConfirmPublish('<?php echo $_GET['Code'];?>')" class="btn btn-success" name="Publish" style="font-family:roboto">Submit Profile</a>
</div>
<?php }?>
<br>


<div class="col-12 grid-margin">                                                     
    <div class="card">
        <div class="card-body">
         <div class="form-group row">
            <div class="col-sm-6"><h4 class="card-title">Profile Information</h4></div>
            <div class="col-sm-6" style="text-align:right"><a href="<?php echo GetUrl("MyProfiles/Draft/Edit/GeneralInformation/". $_GET['Code'].".htm");?>">Edit</a></div>
         </div>
              <div class="form-group row">
                <div class="col-sm-5">
                    <div style="border: 1px solid #e6e6e6;;padding: 0px;width: 318px;height: 378px;"> 
                    <div class="form-group row">                                                       
                        <div class="col-sm-12">
                            <div class="photoview" style="float:left;width: 316px;height:280px">
                                <img src="<?php echo $response['data']['ProfileThumb'];?>" style="height: 100%;width: 100%;">
                            </div>
                        </div> 
                    </div>
                    <div class="container">
    <div class="row">
        <div class="MultiCarousel" data-items="1,3,5,6" data-slide="1" id="MultiCarousel"  data-interval="1000">
            <div class="MultiCarousel-inner">
                <div class="item">
                    <div class="pad15">
                        <p class="lead">Multi Item Carousel</p>
                        <p> 1</p>
                        <p> 6000</p>
                        <p>50% off</p>
                    </div>
                </div><div class="item">
                    <div class="pad15">
                        <p class="lead">Multi Item Carousel</p>
                        <p> 1</p>
                        <p> 6000</p>
                        <p>50% off</p>
                    </div>
                </div><div class="item">
                    <div class="pad15">
                        <p class="lead">Multi Item Carousel</p>
                        <p> 1</p>
                        <p> 6000</p>
                        <p>50% off</p>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary leftLst"><</button>
            <button class="btn btn-primary rightLst">></button>
        </div>
    </div>
    
</div>
                    <div style="padding-left: 10px;padding-right: 10px;">
                      <div class="col-sm-1" style="padding-left: 0px;padding-top: 26px;"><img src="<?php echo SiteUrl?>assets/images/nextarrow.jpg" style="width:30px"></div>
                        <div class="col-sm-10">
                        <?php foreach($response['data']['ProfilePhotos'] as $ProfileP) {?>
                            <div class="photoview" style="float: left;">
                                <img src="<?php echo $ProfileP['ProfilePhoto'];?>" style="height: 62px;width: 44px;">
                            </div>
                        <?php }?>
                        </div>
                       <div class="col-sm-1" style="padding-left: 0px;padding-top: 26px;"><img src="<?php echo SiteUrl?>assets/images/rightarrow.jpg" style="width:30px"></div>
                  </div>
                </div>
                </div>
                <div class="col-sm-7">
                    <div class="form-group row">                                       
                        <label class="col-sm-12 col-form-label" style="color: #1e1e1e;font-size: 17px;"><?php echo strlen(trim($ProfileInfo['ProfileName']))> 0 ? trim($ProfileInfo['ProfileName']) : "N/A "; ?>&nbsp;<?php if((strlen(trim($ProfileInfo['Age'])))>0){ echo "("." ".trim($ProfileInfo['Age'])." "."yrs".")";  }?>&nbsp;</label>
                    </div>
                    <div class="form-group row">                                       
                        <label class="col-sm-12 col-form-label" style="color:#737373;"><?php if((strlen(trim($ProfileInfo['Height'])))>0){ echo trim($ProfileInfo['Height']);?>&nbsp;&nbsp;<span style="color: #ccc;">(approximate)</span><?php }?></label>
                    </div>
                    <div class="form-group row">
                         <label class="col-sm-12 col-form-label" style="color:#737373;"><?php echo trim($ProfileInfo['MaritalStatus']);?></label> 
                    </div>
                    <?php if($ProfileInfo['MaritalStatusCode']!= "MST001"){?>
                        <?php if(trim($ProfileInfo['Children'])>0) {?>
                            <div class="form-group row">
                                    <label class="col-sm-12 col-form-label" style="color:#737373;"><?php if(trim($ProfileInfo['Children'])=="1") { echo "Child"; } else { echo "Children";} ?>&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo trim($ProfileInfo['Children']);?>&nbsp;&nbsp;
                                        <?php if(trim($ProfileInfo['IsChildrenWithYou'])=="1") {
                                            if(trim($ProfileInfo['Children'])=="1") { echo "( Child with me )"; } else { echo "( Children with me )";} 
                                            } else { 
                                            if(trim($ProfileInfo['Children'])=="1") { echo "( Child not with me )"; } else { echo "( Children not with me )";} 
                                            }
                                        ?> 
                                    </label> 
                            </div>
                        <?php } else {    ?>
                        <div class="form-group row">
                                    <label class="col-sm-12 col-form-label" style="color:#737373;">Children&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo trim($ProfileInfo['Children']);?></label>
                            </div>
                        <?php } ?>
                    <?php }?>
                    <div class="form-group row">
                        <label class="col-sm-12 col-form-label" style="color:#737373;">
                        <?php if($ProfileInfo['ReligionCode']== "RN009"){?>
                            <?php echo trim($ProfileInfo['OtherReligion']);?>
                        <?php } else { ?>
                             <?php echo trim($ProfileInfo['Religion']);?>  
                        <?php } ?> 
                    </label>
                    </div>
                   <div class="form-group row">
                        <label class="col-sm-12 col-form-label" style="color:#737373;">
                        <?php if($ProfileInfo['CasteCode']== "CSTN248"){?>
                            <?php echo trim($ProfileInfo['OtherCaste']);?>
                        <?php } else { ?>
                             <?php echo trim($ProfileInfo['Caste']);?>  
                        <?php } ?> 
                        <?php if((strlen(trim($ProfileInfo['SubCaste'])))>0){   ?>&nbsp;&nbsp; , &nbsp;&nbsp;
                        <?php      echo "Sub caste :" . trim($ProfileInfo['SubCaste']);    }   ?>
                    </label>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-form-label" style="color:#737373;"><?php echo trim($ProfileInfo['Community']);?></label>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-form-label" style="color:#737373;"><?php echo trim($ProfileInfo['Nationality']);?></label>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-form-label" style="color:#737373;"><?php echo trim($ProfileInfo['MotherTongue']);?></label>
                    </div>
                     <div class="form-group row">
                        <label class="col-sm-12 col-form-label" style="color:#737373;"><?php if((strlen(trim($ProfileInfo['City'])))>0){ echo trim($ProfileInfo['City']);?>,&nbsp;&nbsp;<?php }?><?php if((strlen(trim($ProfileInfo['State'])))>0){ echo trim($ProfileInfo['State']);?>,&nbsp;&nbsp;<?php }?><?php echo trim($ProfileInfo['Country']);?></label>
                    </div>
                  
              </div>
              </div>
         </div>
</div>
</div>
</form>
 
 <script>
 $(document).ready(function () {
    var itemsMainDiv = ('.MultiCarousel');
    var itemsDiv = ('.MultiCarousel-inner');
    var itemWidth = "";

    $('.leftLst, .rightLst').click(function () {
        var condition = $(this).hasClass("leftLst");
        if (condition)
            click(0, this);
        else
            click(1, this)
    });

    ResCarouselSize();




    $(window).resize(function () {
        ResCarouselSize();
    });

    //this function define the size of the items
    function ResCarouselSize() {
        var incno = 0;
        var dataItems = ("data-items");
        var itemClass = ('.item');
        var id = 0;
        var btnParentSb = '';
        var itemsSplit = '';
        var sampwidth = $(itemsMainDiv).width();
        var bodyWidth = $('body').width();
        $(itemsDiv).each(function () {
            id = id + 1;
            var itemNumbers = $(this).find(itemClass).length;
            btnParentSb = $(this).parent().attr(dataItems);
            itemsSplit = btnParentSb.split(',');
            $(this).parent().attr("id", "MultiCarousel" + id);


            if (bodyWidth >= 1200) {
                incno = itemsSplit[3];
                itemWidth = sampwidth / incno;
            }
            else if (bodyWidth >= 992) {
                incno = itemsSplit[2];
                itemWidth = sampwidth / incno;
            }
            else if (bodyWidth >= 768) {
                incno = itemsSplit[1];
                itemWidth = sampwidth / incno;
            }
            else {
                incno = itemsSplit[0];
                itemWidth = sampwidth / incno;
            }
            $(this).css({ 'transform': 'translateX(0px)', 'width': itemWidth * itemNumbers });
            $(this).find(itemClass).each(function () {
                $(this).outerWidth(itemWidth);
            });

            $(".leftLst").addClass("over");
            $(".rightLst").removeClass("over");

        });
    }


    //this function used to move the items
    function ResCarousel(e, el, s) {
        var leftBtn = ('.leftLst');
        var rightBtn = ('.rightLst');
        var translateXval = '';
        var divStyle = $(el + ' ' + itemsDiv).css('transform');
        var values = divStyle.match(/-?[\d\.]+/g);
        var xds = Math.abs(values[4]);
        if (e == 0) {
            translateXval = parseInt(xds) - parseInt(itemWidth * s);
            $(el + ' ' + rightBtn).removeClass("over");

            if (translateXval <= itemWidth / 2) {
                translateXval = 0;
                $(el + ' ' + leftBtn).addClass("over");
            }
        }
        else if (e == 1) {
            var itemsCondition = $(el).find(itemsDiv).width() - $(el).width();
            translateXval = parseInt(xds) + parseInt(itemWidth * s);
            $(el + ' ' + leftBtn).removeClass("over");

            if (translateXval >= itemsCondition - itemWidth / 2) {
                translateXval = itemsCondition;
                $(el + ' ' + rightBtn).addClass("over");
            }
        }
        $(el + ' ' + itemsDiv).css('transform', 'translateX(' + -translateXval + 'px)');
    }

    //It is used to get some elements from btn
    function click(ell, ee) {
        var Parent = "#" + $(ee).parent().attr("id");
        var slide = $(Parent).attr("data-slide");
        ResCarousel(ell, Parent, slide);
    }

});
 </script>
               