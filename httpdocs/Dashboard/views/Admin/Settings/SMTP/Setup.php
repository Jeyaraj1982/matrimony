<?php
    if (isset($_POST['SaveSMTP'])) {
        
        $SMTPID = $mysql->insert("_tbl_master_codemaster",array("HardCode"  => "EMAILDATA",
                                                                "SoftCode"  => $_POST['HostName'],
                                                                "CodeValue" => $_POST['UserName'],
                                                                "ParamA"    => $_POST['Password'],
                                                                "ParamB"    => $_POST['Serverport']));
                                                                  
        if ($SMTPID>0) {
            echo "Successfully Added";
            unset($_POST);
        } else {
            echo "Error occured. Couldn't save SMTP";
        }
    
    }
    
    

    
?>
<script>
 function SubmitSMTP() {
                         $('#ErrHostName').html("");
                         $('#ErrUserName').html("");
                         $('#ErrPassword').html("");
                         $('#ErrServerport').html("");
                         
                         ErrorCount=0;
        
                        IsNonEmpty("HostName","ErrHostName","Please Enter Host Name");
                        IsNonEmpty("UserName","ErrUserName","Please Enter User Name");
                        IsNonEmpty("Password","ErrPassword","Please Enter Password");
                        IsNonEmpty("Serverport","ErrServerport","Please Enter Server port");
         
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>

<form method="post" action="" onsubmit="return SubmitSMTP();">
        <div class="main-panel">
        <div class="content-wrapper">
          <div class="col-12 stretch-card">                                         
                  <div class="card">
                    <div class="card-body">
                    <h4 class="card-title">SMTP setup(pop</h4>
                      <form class="forms-sample">
                      <div class="form-group row">
                         <label for="Host Name" class="col-sm-3 col-form-label"><small>Host Name<span id="star">*</span></small></label>
                         <div class="col-sm-9"><input type="text" class="form-control" id="HostName" name="HostName">
                         <span class="errorstring" id="ErrHostName"><?php echo isset($ErrHostName)? $ErrHostName : "";?></span> 
                      </div>
                      </div>
                      <div class="form-group row">
                         <label for="User Name" class="col-sm-3 col-form-label"><small>User Name<span id="star">*</span></small></label>
                         <div class="col-sm-6"><input type="text" class="form-control" id="UserName" name="UserName">
                         <span class="errorstring" id="ErrUserName"><?php echo isset($ErrUserName)? $ErrUserName : "";?></span> 
                         </div>
                         </div>
                      <div class="form-group row">
                          <label for="Password" class="col-sm-3 col-form-label"><small>Password<span id="star">*</span></small></label>
                          <div class="col-sm-6"><input type="Password" class="form-control" id="Password" name="Password">
                          <span class="errorstring" id="ErrPassword"><?php echo isset($ErrPassword)? $ErrPassword : "";?></span> 
                          </div>
                          </div>
                      <div class="form-group row">
                          <label for="Server port" class="col-sm-3 col-form-label"><small>Server port<span id="star">*</span></small></label>
                          <div class="col-sm-6"><input type="text" class="form-control" id="Serverport" name="Serverport">
                          <span class="errorstring" id="ErrServerport"><?php echo isset($ErrServerport)? $ErrServerport : "";?></span>
                          </div> 
                          </div>
                         <div id="link"><button type="submit" name="SaveSMTP" class="btn btn-primary">Save Settings </button></div> 
                        </form>
                      </div>
                    </div>
                  </div>
          </div>
        </div>
       </form>        