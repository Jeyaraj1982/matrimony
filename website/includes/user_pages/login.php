<?php
    if (isset($_POST['login'])) {
        include_once(application_config_path);
        $response = $webservice->getData("Member","Login",$_POST); 
        if ($response['status']=="success")  {
            $_SESSION['MemberDetails'] = $response['data'];
            echo "<script>location.href='".SiteUrl."';</script>";
        } else {
            $loginError=$response['message'];
        }
    }  
    
    $isShowSlider = false;
    $layout=0;
    include_once("includes/header.php");
?>  <br><br><br>

<script>
function submitMemberRegistrationform() {
        $('#ErrUserName').html("");
        $('#ErrPassword').html("");
		ErrorCount=0;
        
        IsNonEmpty("UserName","ErrUserName","Please Enter Member ID / Registered Email");
        IsNonEmpty("Password","ErrPassword","Please Enter Password");
		 return  (ErrorCount==0) ? true : false;
    }    
</script>
    <div class="row">
        <div class="col-sm-3"></div>    
        <div class="col-sm-6">
            <div style="text-align: center;">
                <h2>Login</h2>
            </div>
            <form action="" method="post" role="form" class="contactForm" onsubmit="return submitMemberRegistrationform();">
            <table style="margin: 0px auto;line-height: 28px;color: #333;min-width: 250px;max-width:100%;">
                <tr>
                    <td colspan="2">
                        <div class="form-group">
                            <label for="UserName">Member ID / Registered Email</label>
                            <input type="text" name="UserName" class="form-control" id="UserName" placeholder="Member ID / Registered Email" value="<?php echo isset($_POST['UserName']) ? $_POST['UserName'] : '';?>"  data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                            <span class="errorstring" id="ErrUserName"><?php echo isset($ErrUserName)? $ErrUserName : "";?></span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="form-group">
                            <label for="Password">Password</label>
                            <input type="Password" name="Password" class="form-control" id="Password" placeholder="Password" value="<?php echo isset($_POST['Password']) ? $_POST['Password'] : '';?>" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                            <span class="errorstring" id="ErrPassword"><?php echo isset($ErrPassword)? $ErrPassword : "";?></span>
                        </div>
                    </td>
                </tr> 
                <tr>
                    <td style="text-align:left">
                        <button type="submit" name="login" class="btn btn-primary" required="required">Login</button>
                    </td>
                    <td style="text-align:right">
                        <a href="forget-password.php">Forget Password?</a>
                    </td>
                </tr>
                <?php if (isset($loginError)) { ?>
                <tr>
                    <td colspan="2" style="color:red">
                        <div class="form-group"><?php echo $loginError; ?></div>
                    </td>
                </tr>
                <?php } ?>
                <tr>
                    <td colspan="2"><hr></td>
                </tr>
                <tr>
                    <td colspan="2">
                    <div class="form-group" style="text-align:center;margin-top:10px">
                        Not a member yet? <a href="register">Register now</a>
                    </div>
                </td>
        </tr>
            </table>
            </form>
        </div>
        <div class="col-sm-3"></div>
    </div>
    <br><br><br>
<?php include_once("includes/footer.php");?>