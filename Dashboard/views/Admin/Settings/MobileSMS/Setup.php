
<?php
    if (isset($_POST['SaveApi'])) {
        
        $MobileApiID = $mysql->insert("_tbl_master_codemaster",array("HardCode"  => "MOBILEAPI",
                                                                     "SoftCode"  => $_POST['UserName'],
                                                                     "CodeValue" => $_POST['Password'],
                                                                     "ParamA"    => $_POST['SenderId'],
                                                                     "ParamB"    => $_POST['Provider']));
                                                                  
        if ($MobileApiID>0) {
            echo "Successfully Added";
            unset($_POST);
        } else {
            echo "Error occured. Couldn't save Mobile Api";
        }
    
    }
    
    

    
?>
<script>
 function SubmitMobileSMS() {
                         $('#ErrSMSApi').html("");
                         $('#ErrUserName').html("");
                         $('#ErrPassword').html("");
                         $('#ErrSenderId').html("");
                         $('#ErrProvider').html("");
                         
                         ErrorCount=0;
        
                        IsNonEmpty("SMSApi","ErrSMSApi","Please Enter SMS Api");
                        IsNonEmpty("UserName","ErrUserName","Please Enter User Name");
                        IsNonEmpty("Password","ErrPassword","Please Enter Password");
                        IsNonEmpty("SenderId","ErrSenderId","Please Enter Sender Id");
                        IsNonEmpty("Provider","ErrProvider","Please Select Provider");
         
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>


<form method="post" action="" onsubmit="return SubmitMobileSMS();">
        <div class="main-panel">
        <div class="content-wrapper">
          <div class="col-12 stretch-card">                                         
                  <div class="card">
                    <div class="card-body">
                    <h4 class="card-title">Mobile SMS Setup</h4>
                      <form class="forms-sample">
                      <div class="form-group row">
                         <label for="SMS Api" class="col-sm-3 col-form-label">SMS Api<span id="star">*</span></label>
                         <div class="col-sm-9"><input type="text" class="form-control" id="SMSApi" name="SMSApi">
                         <span class="errorstring" id="ErrSMSApi"><?php echo isset($ErrSMSApi)? $ErrSMSApi : "";?></span> 
                      </div>
                      </div>
                      <div class="form-group row">
                         <label for="User Name" class="col-sm-3 col-form-label">User Name<span id="star">*</span></label>
                         <div class="col-sm-6"><input type="text" class="form-control" id="UserName" name="UserName">
                         <span class="errorstring" id="ErrUserName"><?php echo isset($ErrUserName)? $ErrUserName : "";?></span> 
                         </div>
                         </div>
                      <div class="form-group row">
                          <label for="Password" class="col-sm-3 col-form-label">Password<span id="star">*</span></label>
                          <div class="col-sm-6"><input type="Password" class="form-control" id="Password" name="Password">
                          <span class="errorstring" id="ErrPassword"><?php echo isset($ErrPassword)? $ErrPassword : "";?></span> 
                          </div>
                          </div>
                      <div class="form-group row">
                          <label for="Sender id" class="col-sm-3 col-form-label">Sender id<span id="star">*</span></label>
                          <div class="col-sm-6"><input type="text" class="form-control" id="SenderId" name="SenderId">
                          <span class="errorstring" id="ErrSenderId"><?php echo isset($ErrSenderId)? $ErrSenderId : "";?></span>
                          </div> 
                          </div>
                       <div class="form-group row">
                          <label for="Provider" class="col-sm-3 col-form-label">Provider<span id="star">*</span></label>
                          <div class="col-sm-6" align="right">
                               <select class="form-control" id="Provider"  name="Provider">
                                   <option></option>
                                   <option>qqq</option>
                                   <option>eee</option>
                                   <option>rrr</option>
                                </select>
                                <span class="errorstring" id="ErrBankCode"><?php echo isset($ErrProvider)? $ErrProvider : "";?></span>
                                </div>
                       </div>
                         <div id="link"><button type="submit" name="SaveApi" class="btn btn-success">Save Settings </button></div> 
                        </form>
                      </div>
                    </div>
                  </div>
          </div>
        </div>
       </form>        
          
