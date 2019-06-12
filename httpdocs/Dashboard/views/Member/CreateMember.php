<?php //include_once("header.php");?>
<form method="post" action="<?php echo SiteUrl?>Member/MemberCreated" onsubmit="">
        <div class="container"  id="sp">
           <h2>Create Member</h2><br>
              
              <div class="form-group">
             <div class="row">
             <div class="col-sm-3">Member Name</div>
             <div class="col-sm-9"><input type="text" class="form-control" id="staffname" name="staffname"></div> 
             </div>
             </div>
             <br>
             <div class="form-group">
             <div class="row">
             <div class="col-sm-3">Mobile Number</div>
             <div class="col-sm-9"><input type="text" class="form-control" id="mobile" name="mobile"></div> 
             </div>
             </div>
             <br>
             <div class="form-group">
              <div class="row">
              <div class="col-sm-3">Password</div>
              <div class="col-sm-9"><input type="password" class="form-control" id="pincode" name="pincode"></div> 
              </div>
              </div>
              <br>
             <div class="form-group">
             <div class="row">
             <div class="col-sm-3">Email Id</div>
             <div class="col-sm-9"><input type="text" class="form-control" id="email" name="email"></div> 
             </div>
             </div>
             <br>
             <div id="link"><button type="submit" class="btn btn-primary">Create Member </button></div> 
            </div>      
            </form>
<?php //include_once("footer.php");?>