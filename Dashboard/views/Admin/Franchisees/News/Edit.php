 <?php
    $News = $mysql->select("select * from _tbl_franchisees_news where NewsID='".$_GET['Code']."'");
    if (isset($_POST['BtnSaveStory'])) {
    $mysql->execute("update _tbl_franchisees_news set NewsTitle='".$_POST['NewsTitle']."',
                                                      NewsDetails='".$_POST['NewsDetails']."',
                                                      NewsDetails='".$_POST['NewsDetails']."',
                                                      UnPublishedOn='".date("Y-m-d H:i:s")."',
                                                      IsActive='".$_POST['Status']."'
                                                      where  NewsID='".$_GET['Code']."'");
    unset($_Post);
    echo "Updated Successfully";
    }
    $News = $mysql->select("select * from _tbl_franchisees_news where NewsID='".$_GET['Code']."'");
?>
<script>

$(document).ready(function () {

   $("#NewsTitle").blur(function () {
    
        IsNonEmpty("NewsTitle","ErrNewsTitle","Please Enter Valid News Title");
                        
   });
   $("#NewsDetails").blur(function () {
    
        IsNonEmpty("NewsDetails","ErrNewsDetails","Please Enter Valid News Details");
                        
   });
   });

 function SubmitCreateNews() {
                        $('#ErrNewsTitle').html("");
                        $('#ErrNewsDetails').html("");
                         
                         ErrorCount=0;
        
                        if(IsNonEmpty("NewsTitle","ErrNewsTitle","Please Enter Valid News Title")){
                        IsAlphaNumeric("NewsTitle","ErrNewsTitle","Please Enter Aplpha Numeric Characters Only");
                        }
                        if(IsNonEmpty("NewsDetails","ErrNewsDetails","Please Enter Valid News Details")){
                        IsAlphaNumeric("NewsDetails","ErrNewsDetails","Please Enter Valid News Details");
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
                             <h4 class="card-title">Franchisees</h4>
                             <h4 class="card-title">Edit News</h4>
                                 <form class="forms-sample">
                                 <?php if($News['Viewed']>0) {?> 
                                        <div class="form-group row">
                                                <label for="Story Code" class="col-sm-3 col-form-label">News Code<span id="star">*</span></label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" disabled="disabled" id="NewsCode" name="NewsCode" value="<?php echo (isset($_POST['NewsCode']) ? $_POST['NewsCode'] : $News[0]['NewsCode']);?>" placeholder="News Code">
                                                <span class="errorstring" id="ErrNewsCode"><?php echo isset($ErrNewsCode)? $ErrNewsCode : "";?></span>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                                <label for="Story Title" class="col-sm-3 col-form-label">News Title<span id="star">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="NewsTitle" name="NewsTitle" value="<?php echo (isset($_POST['NewsTitle']) ? $_POST['NewsTitle'] : $News[0]['NewsTitle']);?>" placeholder="News Title">
                                                <span class="errorstring" id="ErrNewsTitle"><?php echo isset($ErrNewsTitle)? $ErrNewsTitle : "";?></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                                <label for="Story Details" class="col-sm-3 col-form-label">News Details<span id="star">*</span></label>
                                            <div class="col-sm-9">
                                                <textarea rows="10" class="form-control" id="NewsDetails" name="NewsDetails" ><?php echo (isset($_POST['NewsDetails']) ? $_POST['NewsDetails'] : $News[0]['NewsDetails']);?></textarea> 
                                                <span class="errorstring" id="ErrNewsDetails"><?php echo isset($ErrNewsDetails)? $ErrNewsDetails: "";?></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                        <label for="Photo" class="col-sm-3 col-form-label">Status<span id="star">*</span></label>
                                        <div class="col-sm-3">
                                            <select name="Status" class="form-control" style="width: 140px;" >
                                                <option value="1" <?php echo ($News[0]['IsActive']==1) ? " selected='selected' " : "";?>>Published</option>
                                                <option value="0" <?php echo ($News[0]['IsActive']==0) ? " selected='selected' " : "";?>>Unpublished</option>
                                            </select>
                                        </div>
                                        </div>
                                        <div class="form-group row">
                                                <label for="Created On" class="col-sm-3 col-form-label">Created On</label>
                                            <div class="col-sm-9">
                                                <label style="color:#737373;"><?php echo putDateTime($News[0]['CreatedOn']);?> </label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3"><button type="submit" name="BtnSaveStory" class="btn btn-primary mr-2">Update Information</button></div>
                                        </div>
                                        
                                        <?php } else {?>
                                        
                                        <div class="form-group row">
                                                <label for="Story Code" class="col-sm-3 col-form-label">News Code<span id="star">*</span></label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" disabled="disabled" id="NewsCode" name="NewsCode" value="<?php echo (isset($_POST['NewsCode']) ? $_POST['NewsCode'] : $News[0]['NewsCode']);?>" placeholder="News Code">
                                                <span class="errorstring" id="ErrNewsCode"><?php echo isset($ErrNewsCode)? $ErrNewsCode : "";?></span>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                                <label for="Story Title" class="col-sm-3 col-form-label">News Title<span id="star">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" disabled="disabled" id="NewsTitle" name="NewsTitle" value="<?php echo (isset($_POST['NewsTitle']) ? $_POST['NewsTitle'] : $News[0]['NewsTitle']);?>" placeholder="News Title">
                                                <span class="errorstring" id="ErrNewsTitle"><?php echo isset($ErrNewsTitle)? $ErrNewsTitle : "";?></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                                <label for="Story Details" class="col-sm-3 col-form-label">News Details<span id="star">*</span></label>
                                            <div class="col-sm-9">
                                                <textarea rows="10" class="form-control" disabled="disabled" id="NewsDetails" name="NewsDetails" ><?php echo (isset($_POST['NewsDetails']) ? $_POST['NewsDetails'] : $News[0]['NewsDetails']);?></textarea> 
                                                <span class="errorstring" id="ErrNewsDetails"><?php echo isset($ErrNewsDetails)? $ErrNewsDetails: "";?></span>
                                            </div>
                                        </div>                                            
                                        <div class="form-group row">
                                        <label for="Photo" class="col-sm-3 col-form-label">Status<span id="star">*</span></label>
                                        <div class="col-sm-3">
                                            <select name="Status" class="form-control" style="width: 140px;" >
                                                <option value="1" <?php echo ($News[0]['IsActive']==1) ? " selected='selected' " : "";?>>Published</option>
                                                <option value="0" <?php echo ($News[0]['IsActive']==0) ? " selected='selected' " : "";?>>Unpublished</option>
                                            </select>
                                        </div>
                                        </div>
                                        <div class="form-group row">
                                                <label for="Created On" class="col-sm-3 col-form-label">Created On</label>
                                            <div class="col-sm-9">
                                                <label style="color:#737373;"><?php echo putDateTime($News[0]['PublishedOn']);?> </label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3"><button type="submit" name="BtnSaveStory" class="btn btn-primary mr-2">Update Information</button></div>
                                        </div>
                                        <?php } ?>
                                 </form>                                  
                       </div>
                  </div>
                 </div>
                 <div class="col-sm-12 grid-margin" style="text-align: center; padding-top:5px;color:skyblue;">
                        <a href="../NewsandEvents "><small style="font-weight:bold;text-decoration:underline">List of News</small></a>&nbsp;|&nbsp;
                        <a href="#"><small style="font-weight:bold;text-decoration:underline">List of Viewed Members</small></a>
                 </div>
</form>
