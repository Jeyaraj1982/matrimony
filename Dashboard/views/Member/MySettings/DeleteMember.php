<?php
    $page="DeleteMember";
    $response = $webservice->GetMemberInfo();
    $Member=$response['data'];    
?>
<?php include_once("settings_header.php");?>
<form method="post" action="">
    <div class="col-sm-9" style="margin-top: -8px;">
        <h4 class="card-title">Delete Member</h4>
        <span style="color:#666;">if you delete a member it will all immediately and permanently delete all associated data. This will also affect your analytics, so we only recommend deleteing members that never used in future.</span><br><br>
        <br><br><br><br><br>
        <input type="checkbox">&nbsp;I understand that all content will be delete <a href="#" data-toggle="modal" data-target="#condition">Lean more</a>
        <br><br>
        <div class="form-group row">
            <div class="col-sm-4">
                <a name="Btnupdate" data-toggle="modal" data-target="#DeleteModal" class="btn btn-primary mr-2" style="font-family: roboto;color:white">Delete Member</a>
            </div>
        </div>
    </div>
        <div class="modal" id="condition" style="padding-top:200px;padding-right:0px;background:rgba(9, 9, 9, 0.13) none repeat scroll 0% 0%;">
        <div class="modal-dialog" style="width:367px">
            <div class="modal-content">
                <div class="modal-body">
                    <form method="POST" action="" >
                    <div style="padding:10px;">
                    <h3 style="text-align:left;margin-top:0px">Welcome <?php echo "<b style='color:red'>";echo $_Member['MemberName'] ; echo "</b>";?></h3></div>
                    <div style="padding:10px;overflow: auto;"><?php echo $_Member['WelcomeMessage'] ?></div>
                    <div style="text-align:center;"><input type="submit" class="btn btn-primary" name="welcomebutton" value="Continue"/></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
 <!--   
<div class="modal" id="condition" style="padding-top:177px;">
    <div class="modal-dialog" style="width: 367px;">
        <div class="modal-content">
            <div class="modal-body" style="padding:20px">
                    <div  style="height: 315px;">
                    <h5 style="text-align:center">Delete Member</h5>
                   I. Indian Nationals & Citizens.  <br>
                   II. Persons of Indian Origin (PIO). <br>
                   III. Non Resident Indians (NRI). <br>
                   IV. Persons of Indian Descent or Indian Heritage  <br>
                   V. Not prohibited or prevented by any applicable law for the time being in force from entering into a valid marriage.<br>
                   VI.Sharing of confidential and personal data with each other but not limited to sharing of bank details, etc. <br>
                    <button type="button" class="btn btn-prinary" data-dismiss="modal">Close</button>
                    
                </div>
            </div>
        </div>
    </div>
</div> 
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
</form>                
<?php include_once("settings_footer.php");?>                   