<?php
    $page="DeleteMember";
    $response = $webservice->GetMemberInfo();    
    $Member=$response['data'];    
?>
<?php include_once("settings_header.php");?>
<script>
function submitdelete() {
            $('#Errcheck').html("");
            ErrorCount==0
            if (document.form1.check.checked == false) {
                $("#Errcheck").html("Please agree terms and conditions");
                return false;
            }
            if (document.form1.check.checked == true){
                $(document).ready(function(){
            $("#DeleteModal").modal('show');});
            return false;
            }
            if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }

        }
</script>
<style>
    .errorstring{
        font-size: 13px;
    }
</style>
<form method="post" action="" onsubmit="return submitdelete()" name="form1" id="form1">
    <div class="col-sm-9" style="margin-top: -8px;">
        <h4 class="card-title">Delete Member</h4>
        <span style="color:#666;">If you delete a member it will all immediately and permanently delete all associated data. This will also affect your analytics, so we only recommend deleteing members that never used in future.</span><br><br>
        <br><br><br><br><br>
        <input type="checkbox" name="check" id="check">&nbsp;<label for="check" style="font-weight:normal">I understand that all content will be delete  </label>&nbsp;&nbsp;<a href="#" data-toggle="modal" data-target="#condition">Learn more</a>
        <br><span class="errorstring" id="Errcheck"></span><br><br>
        <div class="form-group row">
            <div class="col-sm-4">
                <button type=submit class="btn btn-primary mr-2" style="font-family: roboto;color:white">Delete Member</button>
            </div>
        </div>
    </div>
  </form>                                                     
     <div class="modal" id="condition" style="padding-top:177px;">
    <div class="modal-dialog" style="width: 367px;">
        <div class="modal-content">
            <div class="modal-body" style="padding:20px">
                    <div  style="height: 315px;">
                    <h5 style="text-align:center">Delete Member</h5><button type="button" class="close" data-dismiss="modal" style="margin-top: -38px;margin-right: 10px;">&times;</button>
                   <ol>
                    <li>Indian Nationals & Citizens. </li>
                    <li> Persons of Indian Origin (PIO). </li>
                    <li> Non Resident Indians (NRI).</li>
                    <li> Persons of Indian Descent or Indian Heritage  </li>
                    <li> Not prohibited or prevented by any applicable law for the time being in force from entering into a valid marriage.</li>
                    <li>Sharing of confidential and personal data with each other but not limited to sharing of bank details, etc.</li>
                   </ol>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<?php if (isset($_POST['Delete'])) {
        $response = $webservice->getData("Member","DeleteMember");
         if ($response['status']=="success") { ?>
          <script> $(document).ready(function(){
            $("#DeletedMember").modal('show');});
       </script>
      <?php   } else {
            $errormessage = $response['message']; 
        }
    }
     ?>
    <div class="modal" id="DeleteModal" role="dialog"  style="padding-top:177px;padding-right:0px;background:rgba(9, 9, 9, 0.13) none repeat scroll 0% 0%;">
    <div class="modal-dialog" style="width: 367px;">
        <div class="modal-content">
            <div class="modal-body" style="padding:20px">
                    <div  style="height: 125px;">
                    <form method="post" action="" > 
                    <h5 style="text-align:center">Delete Member</h5>    <button type="button" class="close" data-dismiss="modal" style="margin-top: -38px;margin-right: 10px;">&times;</button>
                   <div style="text-align:center">Are you sure want to delete?  <br><br>
                   <button type="submit" class="btn btn-primary" name="Delete">Yes</button>&nbsp;<button type="submit" data-dismiss="modal" class="btn btn-primary">No</button></div><br>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="DeletedMember" role="dialog"  style="padding-top:177px;padding-right:0px;background:rgba(9, 9, 9, 0.13) none repeat scroll 0% 0%;">
    <div class="modal-dialog" style="width: 367px;">
        <div class="modal-content">
            <div class="modal-body" style="padding:20px">
                    <div  style="height: 125px;">
                    <h5 style="text-align:center">Delete Member</h5> <button type="button" class="close" data-dismiss="modal" style="margin-top: -38px;margin-right: 10px;">&times;</button>
                        Your account was deleted successfully       <br> <br>
                  <div style="text-align: center;"><a href="<?php echo SiteUrl;?>?action=logout&redirect=../index" class="btn btn-primary">Continue</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
 <!--   
 
<div class="modal" id="DeleteModal" role="dialog"  style="padding-top:177px;padding-right:0px;background:rgba(9, 9, 9, 0.13) none repeat scroll 0% 0%;">
    <div class="modal-dialog" style="width: 367px;">
        <div class="modal-content">
            <div class="modal-body" style="padding:20px">
                    <div  style="height: 315px;">
                    <h5 style="text-align:center">Delete Member</h5>
                   Are you sure want to delete?
                   <div style="text-align:center"><a href="#" class="btn btn-primary">Yes</a>&nbsp;<a href="#" class="btn btn-primary">No</a></div><br>
                    <button type="button" class="btn btn-prinary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>  -->
                
<?php include_once("settings_footer.php");?>                   