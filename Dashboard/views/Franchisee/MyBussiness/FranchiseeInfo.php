<?php
     $response = $webservice->getData("Franchisee","GetFranchiseeInformation");
     
    $Franchisee=$response['data'];
?>
<form method="post" action="" onsubmit="">
          <div class="col-12 grid-margin">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Business Information</h4>  
                      <form class="forms-sample">
                      <div class="form-group row">
                          <div class="col-sm-3"><small>Franchisee Code</small></div>
                          <div class="col-sm-3"><small style="color:#737373; padding-top:50px;"><?php echo $Franchisee['FranchiseeCode'];?></small></div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-3"><small>Franchisee Name</small></div>
                          <div class="col-sm-3"><small style="color:#737373; padding-top:50px;"><?php echo $Franchisee['FranchiseName'];?></small></div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-3"><small>Franchisee Email Id</small></div>
                          <div class="col-sm-3"><small style="color:#737373;"><?php echo $Franchisee['ContactEmail'];?></small></div>
                        </div>
                         <div class="form-group row">
                          <div class="col-sm-3"><small>Mobile Number</small></div>
                          <div class="col-sm-3"><small style="color:#737373;"><?php echo $Franchisee['ContactNumber'];?></small></div>
                        </div>
                         <div class="form-group row">
                          <div class="col-sm-3"><small>Whatsapp Number </small></div>
                          <div class="col-sm-3"><small style="color:#737373;"><?php echo $Franchisee['ContactWhatsapp'];?></small></div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-3"><small>Landline Number</small></div>
                          <div class="col-sm-3"><small style="color:#737373;"><?php echo $Franchisee['ContactLandline'];?></small></div>
                        </div>
                         <div class="form-group row">
                          <div class="col-sm-3"><small>Address</small></div>
                          <div class="col-sm-3"><small style="color:#737373;"><?php echo $Franchisee['BusinessAddressLine1'];?></small></div> 
                        </div>                                                                               
                        <div class="form-group row">
                           <div class="col-sm-3"><small>City Name</small></div> 
                           <div class="col-sm-3"><small style="color:#737373;"><?php echo $Franchisee['CityName'];?></small></div>
                        </div>
                        <div class="form-group row"> 
                           <div class="col-sm-3"><small>Land Mark</small></div> 
                           <div class="col-sm-3"><small style="color:#737373;"><?php echo $Franchisee['Landmark'];?></small></div>
                        </div> 
                        <div class="form-group row">
                          <div class="col-sm-3"><small>Country Name</small></div>
                          <div class="col-sm-3"><small style="color:#737373;"><?php echo $Franchisee['CountryName'];?></small></div> 
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-3"><small>State Name</small></div>
                          <div class="col-sm-3"><small style="color:#737373;"><?php echo $Franchisee['StateName'];?></small></div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-3"><small>District Name</small></div>
                          <div class="col-sm-3"><small style="color:#737373;"><?php echo $Franchisee['DistrictName'];?></small></div> 
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-3"><small>PinCode</small></div>
                          <div class="col-sm-3"><small style="color:#737373;"><?php echo $Franchisee['PinCode'];?></small></div>
                        </div>
                        <div class="form-group row"> 
                          <div class="col-sm-3"><small>Plan</small></div>
                          <div class="col-sm-3"><small style="color:#737373;"><?php echo $Franchisee['Plan'];?></small></div> 
                        </div>
                    </div>
                  </div>
                </div>
                
           
</form>

