<?php
    if (isset($_POST['BtnSaveStory'])) {
        $NewsID = $mysql->insert("_tbl_franchisees_news",array("NewsID"      => $_POST['NewsCode'],
                                                                    "NewsFor"     => $_POST['NewsFor'],
                                                                    "NewsTitle"   => $_POST['NewsTitle'],
                                                                    "NewsDetails" => $_POST['NewsDetails'],
                                                                    "CreatedOn"=> date("Y-m-d H:i:s"))); 
                                                                  
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
                        $('#ErrNewsFor').html("");
                        $('#ErrNewsTitle').html("");
                        $('#ErrNewsDetails').html("");
                         
                         ErrorCount=0;
        
                        IsNonEmpty("NewsCode","ErrNewsCode","Please Enter Valid News Code");
                        IsNonEmpty("NewsFor","ErrNewsFor","Please Enter Valid News For");
                        IsNonEmpty("NewsTitle","ErrNewsTitle","Please Enter Valid News Title");
                        IsNonEmpty("NewsDetails","ErrNewsDetails","Please Enter Valid News Details");
                        
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>

<form method="post" action="" onsubmit="return SubmitCreateNews();">
  <div class="main-panel">
             <div class="col-12 grid-margin stretch-card">
                  <div class="card">
                       <div class="card-body">
                             <h4 class="card-title">Create News</h4>
                                 <form class="forms-sample">
                                        <div class="form-group row">
                                                <label for="Story Code" class="col-sm-3 col-form-label">News Code<span id="star">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="NewsCode" name="NewsCode" value="" placeholder="News Code">
                                                <span class="errorstring" id="ErrNewsCode"><?php echo isset($ErrNewsCode)? $ErrNewsCode : "";?></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                                <label for="Story Title" class="col-sm-3 col-form-label">News For<span id="star">*</span></label>
                                          <div class="col-sm-9">
                                                <?php $NewsFors = $mysql->select("select * from _tbl_master_codemaster Where HardCode='NEWSFOR'");    ?>
                                              <select class="form-control" id="NewsFor"  name="NewsFor" >
                                                <?php foreach($NewsFors as $NewsFor) { ?>
                                                    <option value="<?php echo $NewsFor['SoftCode'];?>" <?php echo ($_POST['NewsFor']==$NewsFor['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $NewsFor['CodeValue'];?></option>
                                                <?php } ?>
                                              </select>
                                              <span class="errorstring" id="ErrNewsFor"><?php echo isset($ErrNewsFor)? $ErrNewsFor : "";?></span>
                                        </div>
                                        </div>
                                        <div class="form-group row">
                                                <label for="Story Title" class="col-sm-3 col-form-label">News Title<span id="star">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="NewsTitle" name="NewsTitle" value="" placeholder="News Title">
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
                                                <label for="Photo" class="col-sm-3 col-form-label">Photo<span id="star">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="File">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3"><button type="submit" name="BtnSaveStory" class="btn btn-success mr-2">Save</button></div>
                                            <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="NewsandEvents "><small>List of News</small> </a></div>
                                        </div>
                                 </form>
                       </div>
                  </div>
             </div>
       </div>
</form>