<?php include_once("header.php");?>
<form method="post" action="Newstaffcreated.php" onsubmit="">
        <div class="container"  id="sp">
           <h2>New Staff</h2><br>
              
              <div class="form-group">
             <div class="row">
             <div class="col-sm-3">Staff Name</div>
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
             <div class="col-sm-3">Email Id</div>
             <div class="col-sm-9"><input type="text" class="form-control" id="email" name="email"></div> 
             </div>
             </div>
             <br>
             <div class="form-group">
              <div class="row">
              <div class="col-sm-3" align="left">Designation</div>
              <div class="col-sm-9" align="right">
                   <select class="form-control" id="designation"  name="designation">
                       <option></option>
                       <option>Site Admin</option>
                       <option>Super Admin</option>
                       <option>Office Admin</option>
                    </select></div>
              </div>
              </div>
              <br>
             <div class="form-group">
             <div class="row">
             <div class="col-sm-3">Address</div>
             <div class="col-sm-9"><input type="text" class="form-control" id="address" name="address"></div> 
             </div>
             </div>
             <br><div class="form-group">
             <div class="row">
             <div class="col-sm-3"></div>
             <div class="col-sm-9"><input type="text" class="form-control" id="address1" name="address1"></div> 
             </div>
             </div>
             <br>
             <div class="form-group">
             <div class="row">
             <div class="col-sm-3"></div>
             <div class="col-sm-9"><input type="text" class="form-control" id="address2" name="address2"></div> 
             </div>
             </div>
             <br>
             <div class="form-group">
              <div class="row">
              <div class="col-sm-3">Password</div>
              <div class="col-sm-9"><input type="password" class="form-control" id="pincode" name="password"></div> 
              </div>
              </div>
              <br>
              <div class="form-group">
               <input type="checkbox" value="" >
                require change password first login
            </div><br>
            <div id="link"><button type="submit" class="btn btn-primary">Create staff </button></div> 
            </div>      
            </form>
<?php include_once("footer.php");?>