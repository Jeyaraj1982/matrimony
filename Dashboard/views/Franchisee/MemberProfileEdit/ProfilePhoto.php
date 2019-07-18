<?php
    $page="ProfilePhoto";       
   ?>
<?php include_once("settings_header.php");?>
<style>
.photoview {
    float: left;
    margin-right: 10px;
    text-align: center;
    border: 1px solid #eaeaea;
    height: 211px;
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 10px;
}
.photoview:hover{
    border:1px solid #9b9a9a;
}
.errorstring{
    font-size:12px
}
</style>
<div class="col-sm-10" style="margin-top: -8px;">
<script>
function submitUpload() {
            $('#Errcheck').html("");
            ErrorCount==0
            if (document.form1.check.checked == false) {
                $("#Errcheck").html("Please read the instruction");
                return false;
            }
            if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }

        }
</script>
<form method="post" onsubmit="return submitUpload()" name="form1" id="form1" action="" enctype="multipart/form-data">
    <h4 class="card-title">Profile Photo</h4>
    <span style="color:#555">"A picture is worth a thousand words". Adding your picture is one of the most important aspects of your profile, as per statistics it increases your chances up to 20 times. Most members won't even search a profile without a picture. Picture is the first impression that is given to the viewers and you don't want to give them a blank first impression.<Br><Br><br></span>
    <?php
                if (isset($_POST['UpdateProfilePhoto'])) {
                    
                    $target_dir = "uploads/";
                    $err=0;
                    $_POST['ProfilePhoto']= "";
                    $acceptable = array('image/jpeg',
                                        'image/jpg',
                                        'image/png'
                                    );
                    
                    if(($_FILES['ProfilePhoto']['size'] >= 5000000) || ($_FILES["ProfilePhoto"]["size"] == 0)) {
                        $err++;
                           echo "File too large. File must be less than 5 megabytes.";
                    }
                            
                    if((!in_array($_FILES['ProfilePhoto']['type'], $acceptable)) && (!empty($_FILES["ProfilePhoto"]["type"]))) {
                        $err++;
                           echo "Invalid file type. Only JPG,PNG,JPEG types are accepted.";
                    }

                    
                    if (isset($_FILES["ProfilePhoto"]["name"]) && strlen(trim($_FILES["ProfilePhoto"]["name"]))>0 ) {
                        $profilephoto = time().$_FILES["ProfilePhoto"]["name"];
                        if (!(move_uploaded_file($_FILES["ProfilePhoto"]["tmp_name"], $target_dir . $profilephoto))) {
                           $err++;
                           echo "Sorry, there was an error uploading your file.";
                        }
                    }
                    
                    if ($err==0) {
                        $_POST['ProfilePhoto']= $profilephoto;
                        $res =$webservice->getData("Franchisee","AddProfilePhoto",$_POST);
                        if ($res['status']=="success") {
                            echo  $res['message']; 
                        } else {
                            print_r($photos);
                            echo $res['message']; 
                        }
                    } else {
                        $res =$webservice->getData("Franchisee","AddProfilePhoto");
                    }
                } else {
                     $res =$webservice->getData("Franchisee","AddProfilePhoto");
                     
                }
                $profile = $res['data'];
              
            ?>
    <div class="form-group row">
        <div class="col-sm-12">
            <input type="File" id="ProfilePhoto" name="ProfilePhoto" Placeholder="File">
            <span style="color:#888">supports png, jpg, jpeg & File size Lessthan 5 MB </span>
        </div>
    </div>
    <input type="checkbox" name="check" id="check">&nbsp;<label for="check" style="font-weight:normal"> I read the instructions  </label>&nbsp;&nbsp;<a href="javascript:void(0)"  onclick="showLearnMore()">Lean more</a>
        <br><span class="errorstring" id="Errcheck"></span><br><br>
    <div class="form-group row" style="margin-bottom:0px;">
        <div class="col-sm-3">
            <button type="submit" name="UpdateProfilePhoto" class="btn btn-primary mr-2" style="font-family:roboto">Update</button>
        </div>
    </div><br>
    
    </form>
    <script>
function showLearnMore() {
      $('#LearnMore').modal('show'); 
      var content = '<div class="LearnMore_body" style="padding:20px">'
                    +   '<div  style="height:500px;">'
                       +  '<h5 style="text-align:center">Please follow the below instructions :</h5><button type="button" class="close" data-dismiss="modal" style="margin-top: -38px;margin-right: 10px;">&times;</button>'
                            + '<ol> '
                               + ' <li>The image file should be in jpg, jpeg and png formats only. </li>'
                               + '<li>Size of each photograph must not exceed 5 MB. </li>'
                                + '<li>Your chosen photograph(s) must be in accordance with the socially acceptable standards.</li>'
                                + '<li>Administrator reserves the right to remove/delete any photograph that violates socially accepted norms of decency.</li>'
                                 + '<li>Do not post caricatures or copyrighted images. </li>'
                                + '</ol>'
                        +  '<button type="button" data-dismiss="modal" class="btn btn-primary">close</button>'
                       +  '</div><br>'
                +  '</div>'
            $('#LearnMore_body').html(content);
}
</script>
    <div>
    <?php if(sizeof($res['data'])==0){  ?>
         <div style="margin-right:10px;text-align: center;">
                 No Profile Photos Found   
        </div>
   <?php }  else {       ?>
    <?php
        foreach($res['data'] as $d) { ?> 
        <div id="photoview_<?php echo $d['ProfilePhotoID'];?>" class="photoview">
            <div style="text-align:right;height:22px;">
                <a href="javascript:void(0)" onclick="showConfirmDelete('<?php  echo $d['ProfilePhotoID'];?>','<?php echo $_GET['Code'];?>')" name="Delete" style="font-family:roboto"><button type="button" class="close" >&times;</button></a>    
            </div>
            <div><img src="<?php echo AppUrl;?>uploads/<?php echo $d['ProfilePhoto'];?>" style="height:120px;"></div>
            <div>
                <?php if($d['IsApproved']==0){ echo "verification pending" ; }?>
            <?php if($d['IsApproved']==1){ echo "Approved" ; }?>
                <br><?php echo PutDateTime($d['UpdateOn']);?>   
            </div>
        </div>
   
        <?php }   ?>
         <div style="clear:both"></div>
         <?php }?>
    </div>
</div>
<div class="modal" id="Delete" role="dialog" data-backdrop="static" style="padding-top:177px;padding-right:0px;background:rgba(9, 9, 9, 0.13) none repeat scroll 0% 0%;">
            <div class="modal-dialog" style="width: 367px;">
                <div class="modal-content" id="model_body" style="height: 150px;">
            
                </div>
            </div>
        </div>
<script>
    function showConfirmDelete(ProfilePhotoID,ProfileID) {
        $('#Delete').modal('show'); 
        var content = '<div class="modal-body" style="padding:20px">'
                        + '<div  style="height: 315px;">'
                            + '<form method="post" id="form_'+ProfilePhotoID+'" name="form_'+ProfilePhotoID+'" > '
                                + '<input type="hidden" value="'+ProfilePhotoID+'" name="ProfilePhotoID">'
                                + '<input type="hidden" value="'+ProfileID+'" name="ProfileID">'
                                + '<div style="text-align:center">Are you sure want to Delete?  <br><br>'
                                    + '<button type="button" class="btn btn-primary" name="Delete"  onclick="ConfirmDelete(\''+ProfilePhotoID+'\')">Yes</button>&nbsp;&nbsp;'
                                    + '<button type="button" data-dismiss="modal" class="btn btn-primary">No</button>'
                                + '</div>'
                            + '</form>'
                        + '</div>'
                     +  '</div>';
        $('#model_body').html(content);
    }
    
    function ConfirmDelete(ProfilePhotoID) {
        
        var param = $( "#form_"+ProfilePhotoID).serialize();
        $('#model_body').html(preloader);
        $.post(API_URL + "m=Franchisee&a=DeletProfilePhoto", param, function(result2) {
            $('#model_body').html(result2);
            $('#photoview_'+ProfilePhotoID).hide();
        }
    );
}

</script>
<?php include_once("settings_footer.php");?>                    