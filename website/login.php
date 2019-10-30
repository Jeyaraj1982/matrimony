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
    include_once("includes/header.php");
?>
<div class="container">
    <div class="center">
        <h2>Login</h2>
    </div>
    <div class="row contact-wrap">
        <div class="status alert alert-success" style="display: none"></div>
        <div class="col-md-6 col-md-offset-3">
            <div id="sendmessage"></div>
            <div id="errormessage"></div>
            <form action="login" method="post" role="form" class="contactForm">
                <table style="margin: 0px auto;line-height: 28px;color: #333;">
                    <tr>
                        <td style="width:335px"  colspan="2">
                            <div class="form-group">
                                Member ID / Registered Email <br>
                                <input type="text" name="UserName" class="form-control" id="UserName" placeholder="Member ID / Registered Email" value="<?php echo isset($_POST['UserName']) ? $_POST['UserName'] : '';?>"  data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                                <div class="validation"></div> 
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="form-group">
                                Password <br>
                                <input type="Password" name="Password" class="form-control" id="Password" placeholder="Password" value="<?php echo isset($_POST['Password']) ? $_POST['Password'] : '';?>" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                                <div class="validation"></div> 
                            </div>
                        </td>
                    </tr> 
                    <tr>
                        <td style="text-align:left">
                            <div class="form-group">
                                <button type="submit" name="login" class="btn btn-primary btn-lg" style="font-size: 13px;font-weight: bold;" required="required">Login</button>
                            </div>
                        </td>
                        <td style="text-align:right">
                            <a href="forget-password.php">Forget Password?</a>
                        </td>
                    </tr>
                    <?php if (isset($loginError)) { ?>
                    <tr>
                        <td style="text-align:center;color:red">
                            <div class="form-group"><?php echo $loginError; ?></div>
                        </td>
                    </tr>
                    <?php } ?>
             </table>
             <div class="form-group" style="text-align:center">
                Not a member yet? <a href="register">Register now</a>
             </div>
        </form>
    </div>
    </div>
</div>
<?php include_once("includes/footer.php");?>