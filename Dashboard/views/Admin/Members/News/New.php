<?php
    if (isset($_POST['BtnSaveStory'])) {
        $NewsID = $mysql->insert("_tbl_franchisees_news",array("NewsCode"      => $_POST['NewsCode'],
                                                                "NewsFor"     => 'NF002',
                                                               "NewsTitle"   => $_POST['NewsTitle'],
                                                               "NewsDetails" => $_POST['NewsDetails'],
                                                              "PublishedOn"=> date("Y-m-d H:i:s"))); 
                                                                  
        if ($NewsID>0) {
            echo "Successfully Added";
            unset($_POST);
        } else {
            echo "Error occured. Couldn't save News";
        }
    }
?>
<script>

$(document).ready(function () {

   $("#NewsCode").blur(function () {
    
        IsNonEmpty("NewsCode","ErrNewsCode","Please Enter Valid News Code");
                        
   });
   $("#NewsFor").blur(function () {
    
        IsNonEmpty("NewsFor","ErrNewsFor","Please Enter Valid News For");
                        
   });
   $("#NewsTitle").blur(function () {
    
        IsNonEmpty("NewsTitle","ErrNewsTitle","Please Enter Valid News Title");
                        
   });
   $("#NewsDetails").blur(function () {
    
        IsNonEmpty("NewsDetails","ErrNewsDetails","Please Enter Valid News Details");
                        
   });
   });

 function SubmitCreateNews() {
                        $('#ErrNewsCode').html("");
                        $('#ErrNewsTitle').html("");
                        $('#ErrNewsDetails').html("");
                         
                         ErrorCount=0;
        
                        if (IsNonEmpty("NewsCode","ErrNewsCode","Please Enter Valid News Code")) {
                             IsAlphaNumeric("NewsCode","ErrNewsCode","Please Enter Alpha Numeric Characters");
                        }
                        
                        if (IsNonEmpty("NewsTitle","ErrNewsTitle","Please Enter News Title")) {
                        IsAlphaNumeric("NewsTitle","ErrNewsTitle","Please Enter Alphaba Numeric characters only");
                        }
                        if (IsNonEmpty("NewsDetails","ErrNewsDetails","Please Enter Valid News Details" )){
                        IsAlphaNumeric("NewsDetails","ErrNewsDetails","Please Enter Alphaba Numeric characters only");
                        }
                        
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }                          
                 }
    
</script>

<form method="post" action="" onsubmit="return SubmitCreateNews();">
             <div class="col-12 grid-margin stretch-card">
                  <div class="card">
                       <div class="card-body">
                             <h4 class="card-title">Create News </h4>
                                 <form class="forms-sample">
                                        <div class="form-group row">
                                                <label for="Story Code" class="col-sm-3 col-form-label">News Code<span id="star">*</span></label>
                                            <div class="col-sm-3">                                                     
                                                <input type="text" class="form-control" id="NewsCode" maxlength="6" name="NewsCode" value="<?php echo isset($_POST['NewsCode']) ? $_POST['NewsCode'] :  MemberNews::GetNextMemberNewsNumber();?>" placeholder="News Code">
                                                <span class="errorstring" id="ErrNewsCode"><?php echo isset($ErrNewsCode)? $ErrNewsCode : "";?></span>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                                <label for="Story Title" class="col-sm-3 col-form-label">News Tittle<span id="star">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="NewsTitle" name="NewsTitle" value="<?php echo (isset($_POST['NewsTitle']) ? $_POST['NewsTitle'] : "");?>" placeholder="News Title">
                                                <span class="errorstring" id="ErrNewsTitle"><?php echo isset($ErrNewsTitle)? $ErrNewsTitle : "";?></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                                <label for="Story Details" class="col-sm-3 col-form-label">News Details<span id="star">*</span></label>
                                            <div class="col-sm-9">
                                                <textarea  rows="10" class="form-control" id="NewsDetails" name="NewsDetails" value="" placeholder="News Details">  </textarea>
                                                <span class="errorstring" id="ErrNewsDetails"><?php echo isset($ErrNewsDetails)? $ErrNewsDetails: "";?></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="Status" class="col-sm-3 col-form-label">Status<span id="star">*</span></label>
                                              <div class="col-sm-3">
                                                    <select name="Status" class="form-control" style="width: 140px;" >
                                                        <option value="1" <?php echo ($Plan[0]['Published']==1) ? " selected='selected' " : "";?>>Published</option>
                                                        <option value="0" <?php echo ($Plan[0]['Published']==0) ? " selected='selected' " : "";?>>Unpublished</option>
                                                    </select>
                                              </div>
                                        </div>
                                        <!--<div class="form-group row">
                                        <div class="col-sm-2"><small>Status<span id="star">*</span></small></div>
                                              <div class="col-sm-3">
                                                    <select name="Status" class="form-control" style="width: 140px;" >
                                                        <option value="1" <?php echo ($Member[0]['IsActive']==1) ? " selected='selected' " : "";?>>Active</option>
                                                        <option value="0" <?php echo ($Member[0]['IsActive']==0) ? " selected='selected' " : "";?>>Deactive</option>
                                                    </select>
                                              </div>
                                        </div>   -->
                                        <div class="form-group row">
                                            <div class="col-sm-2"><button type="submit" name="BtnSaveStory" class="btn btn-primary mr-2">Create News</button></div>
                                            <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="NewsandEvents "><small>List of News</small> </a></div>
                                        </div>
                                 </form>
                       </div>
                  </div>
             </div>
</form>
<!--<div class="form-group row">
                                                <label for="Story Title" class="col-sm-3 col-form-label">News For<span id="star">*</span></label>
                                          <div class="col-sm-9">
                                                <?php // $NewsFors = $mysql->select("select * from _tbl_master_codemaster Where HardCode='NEWSFOR'");    ?>
                                              <select class="form-control" id="NewsFor"  name="NewsFor" >
                                                <?php // foreach($NewsFors as $NewsFor) { ?>
                                                    <option value="<?php// echo $NewsFor['CodeValue'];?>" <?php //echo ($_POST['NewsFor']==$NewsFor['SoftCode']) ? " selected='selected' " : "";?>> <?php //echo //$NewsFor['CodeValue'];?></option>
                                                <?php // } ?>
                                              </select>
                                              <span class="errorstring" id="ErrNewsFor"><?php //echo// isset($ErrNewsFor)? $ErrNewsFor : "";?></span>
                                        </div>
                                        </div>         --> 