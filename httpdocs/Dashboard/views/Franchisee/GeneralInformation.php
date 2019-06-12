<form method="post" action="<?php echo GetUrl("FamilyInformation");?>" onsubmit="">
<div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                             <h4 class="card-title">Profile Information</h4>
                             <?php echo"Member ID";  echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";echo":"; ?><br>
                                <?php echo"Member Name:";?>
                                <br>
                                <hr>
                                <br>
                                 <br>
                                 <form class="forms-sample">
                                        <div class="form-group row">
                                                <label for="Member ID" class="col-sm-3 col-form-label">Name:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="name" name="Name" value="" placeholder="Name">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                                <label for="Date of birth" class="col-sm-3 col-form-label">Date of birth:</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" id="DateofBirth" name="DateofBirth" value="" placeholder="Date of Birth">
                                            </div>
                                        <label for="Sex" class="col-sm-3 col-form-label">Sex</label>
                                            <div class="col-sm-3">
                                               <select class="form-control" id="sex"  name="sex">
                                               <option>Select</option>
                                               <option>Male</option>
                                               <option>Female</option>
                                               </select>
                                            </div>
                                        </div>
                                         <div class="form-group row">
                                         <label for="Religion" class="col-sm-3 col-form-label">Religion</label>
                                            <div class="col-sm-3">
                                                <select class="form-control" id="Religion"  name="Religion">
                                                   <option>Select</option>
                                                   <option>Hindhu</option>
                                                    <option>Christian</option>
                                                    <option>Muslim</option>
                                               </select>
                                            </div>
                                        <label for="Caste" class="col-sm-3 col-form-label">Caste</label>
                                            <div class="col-sm-3">
                                               <select class="form-control" id="Caste"  name="Caste">
                                               <option>Select</option>
                                               <option>BC</option>
                                               <option>MBC</option>
                                               <option>SC</option>
                                               </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                         <label for="Community" class="col-sm-3 col-form-label">Community</label>
                                            <div class="col-sm-3">
                                                <select class="form-control" id="Community"  name="Community">
                                                   <option>Select</option>
                                                   <option>XX</option>
                                                   <option>XX</option>
                                                   <option>XX</option>
                                               </select>
                                            </div>
                                        <label for="Caste" class="col-sm-3 col-form-label">Nationality</label>
                                            <div class="col-sm-3">
                                               <select class="form-control" id="Nationality"  name="Nationality">
                                               <option>Select</option>
                                               <option>Indian</option>
                                               <option>Others</option>
                                               </select>
                                            </div>
                                        </div>  
                                        <div class="form-group row">
                                        <label for="Aadhaar" class="col-sm-3 col-form-label">Adhaar No :</label>
                                        <div class="col-sm-6" align="right">
                                        <input type="text" class="form-control" id="aadhar" name="aadhaar"></div>
                                        <div class="col-sm-3" align="left"><input type="checkbox" value="" > <small>is handicapped?</small>  </div>
                                        </div>
                                        <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-9" align="left"></div>
                                            <div class="col-sm-3" align="right"><input type="text" class="form-control" id="aadhar" name="aadhaar"></div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                                <label for="Occupation" class="col-sm-3 col-form-label">Occupation</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" id="occupation"  name="occupation">
                                                <option>Select</option>
                                                <option>XX</option>
                                                <option>YY</option>
                                                </select>
                                            </div>
                                        </div>
                                        <button type="submit" name="" class="btn btn-success mr-2">Create Profile</button>
                                 </form>
                       </div>
                  </div>
             </div>
       </div>
  </div>
</form>