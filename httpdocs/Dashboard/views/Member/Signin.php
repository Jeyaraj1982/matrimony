<?php include_once("header.php");?>

<script>
function SignUpSubmit()
{
    $('#error_username').html("");
    if ($('#username').val().trim().length==0) {
        $('#error_username').html("Please enter valid Email/Phone Number");
        $('#username').focus();
        return false;
    }
     else if ($('#password').val().trim().length==0) {
        $('#error_password').html("Please enter your Password  Must Contain 8characters");
        $('#password').focus();
        return false;
    }
    return true;
}
</script>
    <form method="post" action="" onsubmit="return SignUpSubmit();">
        <div class="container"  id="sp">
            <h2>Sign In</h2><br>
            <div class="form-group">
                <input type="text" class="form-control" id="username" placeholder="Mobile Number / Email address" name="username">
                <div id="error_username" class="inputerror"></div>
                </div>
            
             <div class="form-group">    
                <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                <div id="error_password" class="inputerror"></div>
                </div>
            
            <div>
                <div style="float:left"> <button type="submit" class="btn btn-primary">Sign In</button> </div>
                <div style="float:right;padding-top:5px;"><a href="ForgetPassword.php">Forget Password</a></div>
            </div>
            <div style="clear:both"></div>
            <hr style="margin-top:50px;margin-bottom: 10px;">
            <div  id="link"><h6>Not a member yet?&nbsp;<a href="#">Signup now</a></h6></div>
            </div>
            </form>
<?php include_once("footer.php");?>
