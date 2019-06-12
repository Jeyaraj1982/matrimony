<?php
    $Members = $mysql->select("select * from _tbl_members where MemberName='".$_POST['MemberDetails']."' or MobileNumber='".$_POST['MemberDetails']."'or EmailID='".$_POST['MemberDetails']."'");
?>
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
            <h4 class="card-title">Search Member</h4>
                <form method="post" action="" onsubmit="return SubmitSearch();">
                    <div class="form-group row">
                        <label for="Member Details" class="col-sm-3 col-form-label">Member Details<span id="star">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="MemberDetails" name="MemberDetails" value="<?php echo isset($_POST['MemberDetails']) ? $_POST['MemberDetails'] : '';?>" >
                            <small style="color:#737373; font-size:X-smaller;" >eg: member code or member name or mobile number or member email</small>
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


<?php
    $Members = array();
    if (isset($_POST['MemberDetails'])) {
        $Members = $mysql->select("SELECT 
                                    tb1_1.MemberID AS MemberID,
                                    tb1_1.MemberName AS MemberName,
                                    tb1_1.MemberCode AS MemberCode,
                                    tb1_1.MobileNumber AS MobileNumber,
                                    _tbl_franchisees.FranchiseeCode AS FranchiseeCode,
                                    _tbl_franchisees.FranchiseName AS FranchiseeName,
                                    tb1_1.CreatedOn AS CreatedOn,
                                    tb1_1.IsActive AS IsActive
                                  FROM 
                                    (select * from _tbl_members where  MemberCode like '%".$_POST['MemberDetails']."%' or MemberName like '%".$_POST['MemberDetails']."%' or MobileNumber like '%".$_POST['MemberDetails']."%' or EmailID like '%".$_POST['MemberDetails']."%') AS tb1_1
                                  INNER JOIN 
                                    _tbl_franchisees
                                  ON 
                                    tb1_1.ReferedBy =_tbl_franchisees.FranchiseeID;"); 
    }
    
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
                        </tr>                                        
                    </thead>
                    <tbody>  
                    <?php foreach($Members as $Member) { ?>
                        <tr>
                            <td><span class="<?php echo ($Member['IsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span>&nbsp;&nbsp;&nbsp;<?php echo $Member['MemberCode'];?></td>
                            <td><?php echo $Member['MemberName'];?></td>
                            <td>[<?php echo $Member['FranchiseeCode'];?>]&nbsp;<?php echo $Member['FranchiseeName'];?></td>
                            <td><?php echo $Member['MobileNumber'];?></td>
                        </tr>
                    <?php } ?>            
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