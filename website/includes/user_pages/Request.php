
<?php
          
            if (isset($_POST['btnResetPassword'])) {
                include_once(application_config_path);
                $response = $webservice->getData("Member","RequestAction",$_POST);
                if ($response['status']=="success") {
                    ?>
                    <form action="Request-action" id="reqFrm" method="post">
                        <input type="hidden" value="<?php echo $response['data']['reqID'];?>" name="reqID">
                        <input type="hidden" value="<?php echo $response['data']['email'];?>" name="reqEmail">
                        <input type="hidden" value="<?php echo $response['data']['ReqFor'];?>" name="ReqFor">
                    </form>
                    <script>document.getElementById("reqFrm").submit();</script>
                <?php
                    }
                    else{
                        $errormessage = $response['message']; 
                    } 
            }              
             $isShowSlider = false;
             $layout=0;
            include_once("includes/header.php");
            ?>
  <br><br><br> 
  <script>
function submitMemberForgetPswd() {
        $('#ErrFpUserName').html("");
        ErrorCount=0;
        
        IsNonEmpty("FpUserName","ErrFpUserName","Please Enter Registered Email");
         return  (ErrorCount==0) ? true : false;
    }    
</script>
  <div class="row">
	<div class="col-sm-3"></div>
        <div class="col-sm-6">
			<div style="min-width: 400px;max-width:400px;margin:0px auto;">
            <div style="text-align:center">
                <h2>Request</h2>
            </div>
          <div id="errormessage"></div>
          <form action="" method="post" role="form" class="contactForm" onsubmit="return submitMemberForgetPswd();">
            <div class="form-group">
            Request For
              <select name="RequestFor" id="RequestFor" class="form-control" >
                <option value="Reactive">Reactive</option>
                <option value="Restore">Restore</option>
              </select>
             <div class="validation"></div>
            </div>
            <div class="form-group">
            Email ID
              <input type="text" class="form-control"  name="FpUserName" id="FpUserName" placeholder="Registered Email" value="<?php echo isset($_POST['FpUserName']) ? $_POST['FpUserName'] : '';?>" />
			  <span class="errorstring" id="ErrFpUserName"><?php echo isset($ErrFpUserName)? $ErrFpUserName : "";?>&nbsp;</span>
			 <div class="validation"></div>
            </div>
            <div class="form-group" style="color:red">
                <?php echo $errormessage;?>
            </div>
                <div class="form-group">
                    <a href="login.php">Back to login</a>
                    <div style="float: right;">
                        <button type="submit" name="btnResetPassword" class="btn btn-primary" required="required">Continue</button>
                    </div>
                </div>
            </form>
        </div>
		</div>
        <div class="col-sm-3"></div>
    </div>                                                                                
  <br><br><br>
 <?php include_once("includes/footer.php");?>