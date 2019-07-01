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
        <input type="checkbox">&nbsp;I understand that all content will be delete <a href="">Lean more</a>
        <br><br>
        <div class="form-group row">
            <div class="col-sm-4">
                <button type="submit" name="Btnupdate" class="btn btn-primary mr-2" style="font-family: roboto;">Delete Member</button>
            </div>
        </div>
    </div>
</form>                
<?php include_once("settings_footer.php");?>                   