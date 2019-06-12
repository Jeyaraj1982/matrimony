
<?php include_once("header.php");?>
<script>
function val()
{
var otp=document.getElementById("otp");

if(otp.value=="")
{
alert("Enter recieved otp")
otp.focus();
return false;
}


}
</script>
    <form method="post" action="SignupCompleted.php" onsubmit="return val();">
        <div class="container"  id="sp">
            <h2>Signup</h2><br>
            <div style="font-size:medium">We have sent OTP to your mail. Please enter and continue</div>
            <div class="a">
            <div class="form-group" >
                <input type="text" class="form-control otpbox"  maxlength="1" id="otp"  name="sotp">
                <input type="text" class="form-control otpbox" maxlength="1" id="otp"  name="sotp">
                <input type="text" class="form-control otpbox" maxlength="1" id="otp"  name="sotp">
                <input type="text" class="form-control otpbox" maxlength="1" id="otp"  name="sotp">
            </div>
            </div>
            <br>
            <br>
            <div class="form-group">
           <button type="submit" class="btn btn-primary" onclick="val()">Verify</button>&nbsp;
           <a href="#">Resend</a>
            </div>
            </form>
<?php include_once("footer.php");?>