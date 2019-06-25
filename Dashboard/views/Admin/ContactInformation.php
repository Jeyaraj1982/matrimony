<?php include_once("header.php");?>
<form method="post" action="" onsubmit="">
        <div class="container"  id="sp">
           <h2>Contact Information</h2><br>
              <div class="form-group">
             <div class="row">
             <div class="col-sm-3">Name</div>
             <div class="col-sm-9"><input type="text" class="form-control" id="name" name="name"></div> 
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
             <div class="col-sm-3">Mobile No</div>
             <div class="col-sm-9"><input type="text" class="form-control" id="mobile" name="mobile"></div> 
             </div>
             </div>
             <br>
             <div class="form-group">
             <div class="row">
             <div class="col-sm-3">Whatsapp No</div>
             <div class="col-sm-9"><input type="text" class="form-control" id="whatsapp" name="whatsapp"></div> 
             </div>
             </div>
             <br>
             <div class="form-group">
             <div class="row">
             <div class="col-sm-3">Landline No</div>
             <div class="col-sm-9"><input type="text" class="form-control" id="Landline" name="Landline"></div> 
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
              <div class="col-sm-3" align="left">District Name</div>
              <div class="col-sm-9" align="right">
                   <select class="form-control" id="district"  name="district">
                       <option>Select</option>
                       <option>Kanyakumari</option>
                       <option>Trinelveli</option>
                       <option>Tuticorn</option>
                    </select></div>
              </div>
              </div>
              <br>
              <div class="form-group">
              <div class="row">
              <div class="col-sm-3">Pincode</div>
              <div class="col-sm-9"><input type="text" class="form-control" id="pincode" name="pincode"></div> 
              </div>
              </div>
              <br>
            <div class="form-group">
            <div class="row">
               <div class="col-sm-3" align="left">Valid upto</div>
               <div class="col-sm-9" align="right"><input type="date" class="form-control" id="date" name="date"></div>
            </div>   
            </div>         
            </form>
<?php include_once("footer.php");?>