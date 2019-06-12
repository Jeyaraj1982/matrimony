<?php include_once("header.php");?>
<script>
function SignInSubmit()
{
    $('#error_username').html("");
    if ($('#username').val().trim().length==0) {
        $('#error_username').html("Please enter valid Email/Mobile Number");
        $('#username').focus();
        return false;
    }
     return true;
}

</script>
<!--onsubmit="return SignInSubmit($(this));" -->
    <form method="post" action="SignupOTP.php" onsubmit="return SignInSubmit();" >
        <div class="content">
            <div class="container"  id="sp">
                <h2>Signup</h2><br>
                <div class="form-group">
                    <input type="text" class="form-control" id="username" placeholder="Email Address/Mobile Number" name="username">
                    <div id="error_username" class="inputerror"></div>
                </div>
                <div class="form-group">
                <button type="submit" class="btn btn-primary">Continue</button></div>
                <div class="form-group">
                <small>By joining,I agree to recieve mails</small></div>
                <hr style="margin-top:50px;margin-bottom:10px">
                <div class="form-group">
                <div id="link">Already a member?&nbsp;<a href="Signin.php">Sign In</a></div>
            </div>
        </div>
        </div>
    </form>
<?php include_once("footer.php");?>
