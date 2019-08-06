<script>
    function SubmitSearch() {
        
        $('#ErrMemberDetails').html("");
        
        ErrorCount=0;
        
        if(IsNonEmpty("MemberDetails","ErrMemberDetails","Please Enter Valid Name or Mobile Number or Email")){
           IsSearch("MemberDetails","ErrMemberDetails","Please Enter more than 3 characters") 
        }
        
        if (ErrorCount==0) {
            return true;
        } else{
            return false;
        }
    }
</script>
<div class="content-wrapper">
    <div class="col-12 stretch-card">
        <div class="card">
            <div class="card-body">
            <h4 class="card-title">Profile</h4>
                <form method="post" action="" onsubmit="return SubmitSearch();">
                    <div class="form-group row">
                        <label for="Member Details" class="col-sm-3 col-form-label">Member Details<span id="star">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="MemberDetails" name="MemberDetails" value="<?php echo isset($_POST['MemberDetails']) ? $_POST['MemberDetails'] : '';?>" >
                            <small style="color:#737373; font-size:X-smaller;" >eg: member code or member name or mobile number or member email</small>  <br>
                            <span class="errorstring" id="ErrMemberDetails"><?php echo isset($ErrMemberDetails)? $ErrMemberDetails : "";?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4" align="left"> 
                            <button type="submit" name="BtnSearch" class="btn btn-primary mr-2">Search Member</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php if(isset($_POST['MemberDetails'])>0){
?>                                                          
  
<div class="content-wrapper">
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Manage  Member</h4>
            <div class="table-responsive">
                <table id="myTable" class="table table-striped">
                    <thead>  
                        <tr> 
                            <th>Member Code</th>  
                            <th>Member Name</th>                         
                            <th>Franchisee</th>
                            <th>Mobile Number</th>
                            <th>Profiles</th>
                            <th></th>
                        </tr>                                        
                    </thead>
                    <tbody> 
                    <?php
                    $Members = array();
                        if (isset($_POST['MemberDetails'])) {  
                        $response = $webservice->getData("Franchisee","SearchMemberDetails",$_POST);
                        print_r($response); 
                    ?> 
                    <?php foreach($response['data'] as $Member) {  ?>
                        <tr>
                            <td><span class="<?php echo ($Member['IsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span>&nbsp;&nbsp;&nbsp;<?php echo $Member['MemberCode'];?></td>
                            <td><?php echo $Member['MemberName'];?></td>
                            <td>[<?php echo $Member['FranchiseeCode'];?>]&nbsp;<?php echo $Member['FranchiseeName'];?></td>
                            <td><?php echo $Member['MobileNumber'];?></td>
                            <td><?php echo $Member['NoOfProfile'];?></td>
                            <td>
                                <?php if($Member['NoOfProfile']>0) {?>
                                    <a href="<?php echo GetUrl("ViewMemberProfile/".$Member['ProfilesID'].".htm"); ?>"><span>View</span></a>
                                    <?php if ($Member['IsEditable']==1) { ?>
                                        &nbsp;&nbsp;&nbsp;<a href="<?php echo GetUrl("MemberProfileEdit/GeneralInformation/".$Member['ProfilesID'].".htm"); ?>"><span>Edit</span></a>
                                    <?php } ?>
                                <?php } else {?>
                                    <a href="<?php echo GetUrl("CreateProfile");?>"><span>Create</span></a>  
                                <?php }  ?>
                            </td>
                        </tr>
                    <?php }} ?>            
                    </tbody>                        
                </table>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    $(document).ready(function(){
        $('#myTable').dataTable();
        setTimeout("DataTableStyleUpdate()",500);
    });
</script>
<?php }?>