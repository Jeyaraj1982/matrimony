<form method="post" action="">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="form-group row">
                <div class="col-sm-3">
                <h4 class="card-title" style="margin-bottom: 0px;margin-top: 0px;">Report</h4>
                </div>
                        <div class="col-sm-9" style="text-align:right;padding-top:5px;color:skyblue;">
                        <a href="../ManageMember" ><small>All</small></a>&nbsp;|&nbsp;
                        <a href="../ManageActiveMembers"><small>Active</small></a>&nbsp;|&nbsp;
                        <a href="../ManageDeactiveMembers"><small>Deactive</small></a>&nbsp;|&nbsp;
                        <a href="../Franchiseewise"><small>Franchisee-wise</small></a>&nbsp;|&nbsp;
                        <a href="Report/Report"><small style="font-weight:bold;text-decoration:underline">Report</small></a>
                </div>
                </div>
                 <table class="table table-bordered">
                    <tbody>
                     <?php $EmailVs=$mysql->select("SELECT COUNT(*) FROM _tbl_members where IsEmailVerified='1'");
                           $MobileVs=$mysql->select("SELECT COUNT(*) FROM _tbl_members where IsMobileVerified='1'");
                           $EmailNs=$mysql->select("SELECT COUNT(*) FROM _tbl_members where IsEmailVerified='0'");
                           $MobileNs=$mysql->select("SELECT COUNT(*) FROM _tbl_members where IsMobileVerified='0'");
                           $VEmailandMobiles=$mysql->select("SELECT COUNT(*) FROM _tbl_members where IsMobileVerified='1' and IsEmailVerified='1'");
                           $NEmailandMobiles=$mysql->select("SELECT COUNT(*) FROM _tbl_members where IsMobileVerified='0' and IsEmailVerified='0'");
                                      ?>
                      <tr>
                        <td>Email Verified Members</td>
                        <td style="text-align:right;width: 70px;"><?php foreach($EmailVs as $EmailV) { echo $EmailV['COUNT(*)'];}?></td>
                        <td style="text-align:right;width: 75px;"><a href="<?php echo GetUrl("Members/Report/EmailVerifiedMembers");?>">View</a></td>
                      </tr>
                      <tr>
                        <td>Mobile Verified Members</td>
                        <td style="text-align:right;"><?php foreach($MobileVs as $MobileV) { echo $MobileV['COUNT(*)'];}?></td>
                        <td style="text-align:right"><a href="<?php echo GetUrl("Members/Report/MobileVerifiedMembers");?>">View</a></td>
                      </tr>
                      <tr>
                        <td>Email not Verified Members</td>
                        <td style="text-align:right"><?php foreach($EmailNs as $EmailN) { echo $EmailN['COUNT(*)'];}?></td>
                        <td style="text-align:right"><a href="<?php echo GetUrl("Members/Report/EmailNotVerifiedMembers");?>">View</a></td>
                      </tr>
                      <tr>
                        <td>Mobile not Verified Members</td>
                        <td style="text-align:right"><?php foreach($MobileNs as $MobileN) { echo $MobileN['COUNT(*)'];}?></td>
                        <td style="text-align:right"><a href="<?php echo GetUrl("Members/Report/MobileNotVerifiedMembers");?>">View</a></td>
                      </tr>
                      <tr>
                        <td>Verified Email and Mobile</td>
                        <td style="text-align:right"><?php foreach($VEmailandMobiles as $VEmailandMobile) { echo $VEmailandMobile['COUNT(*)'];}?></td>
                        <td style="text-align:right"><a href="<?php echo GetUrl("Members/Report/MobileandEmailVerifiedMembers");?>">View</a></td>
                      </tr>
                      <tr>
                        <td>non Verified Email and Mobile</td>
                        <td style="text-align:right"><?php foreach($NEmailandMobiles as $NEmailandMobile) { echo $NEmailandMobile['COUNT(*)'];}?></td>
                        <td style="text-align:right"><a href="<?php echo GetUrl("Members/Report/NotVerifiedEmailandMobileMembers");?>">View</a></td>
                      </tr>
                    </tbody>
                  </table>
             </div>
        </div>
    </div>
</form>          