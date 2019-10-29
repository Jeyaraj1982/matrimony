<?php include_once("header.php");?>
<style>
    .navbar-inverse {

    background-color: transparent;
    border-color: transparent;
         color:#fff;
}
.navbar-inverse .navbar-nav > li > a {

    color: white;

}
.errorstring{                           
    color:red;
}
</style>
        
         <nav class="navbar dashboard-menu">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-md-9">
                        <div class="navbar-header">
                            <button data-toggle="collapse-side" data-target=".side-collapse" data-target-2=".side-collapse-container" type="button" class="navbar-toggle">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar top-bar"></span>
                                <span class="icon-bar middle-bar"></span>
                                <span class="icon-bar bottom-bar"></span>
                            </button>
                        </div>
                        <div class="navbar-inverse side-collapse in">
                            <div role="navigation" class="navbar-collapse" id="scroll-submenu1" style="height: auto;">
                                <ul class="nav navbar-nav">
                                    <li class="dropdown">
                                        <a class="hidden-xs visible-sm visible-md visible-lg disabled dropdown-toggle" data-toggle="dropdown" href="my_matrimony.php">My Home</a>
                                        <a class="visible-xs hidden-sm hidden-md hidden-lg dropdown-toggle" data-toggle="dropdown" href="javascript:;"><span class="am-mmenu-icon"><img src="images/kv-mmenu-icon-home.png"></span> My Home <span class="fa fa-angle-down"></span></a>
                                    </li>
                                    <li class="dropdown">
                                        <a class="hidden-xs visible-sm disabled visible-md visible-lg dropdown-toggle " data-toggle="dropdown" href="recommended_matches.php">Matches</a>
                                        <a class="visible-xs hidden-sm hidden-md hidden-lg dropdown-toggle " data-toggle="dropdown" href="javascript:;"><span class="am-mmenu-icon"><img src="images/kv-mmenu-icon-matches2.png"></span> Matches <span class="fa fa-angle-down"></span></a>
                                    </li>

                                    <li class="dropdown">
                                        <a class="disabled hidden-xs visible-sm visible-md visible-lg dropdown-toggle" data-toggle="dropdown" href="search_index.php">Search</a>
                                        <a class="visible-xs hidden-sm hidden-md hidden-lg dropdown-toggle" data-toggle="dropdown" href="javascript:;"><span class="am-mmenu-icon"><img src="images/kv-mmenu-icon-search.png"></span> Search <span class="fa fa-angle-down"></span></a>
                                    </li>
                                    <li class="dropdown">
                                        <a class="disabled hidden-xs visible-sm visible-md visible-lg dropdown-toggle" data-toggle="dropdown" href="interest_recieved.php">Messages</a>
                                        <a class="visible-xs hidden-sm hidden-md hidden-lg dropdown-toggle" data-toggle="dropdown" href="interest_recieved.php"><span class="am-mmenu-icon"><img src="images/kv-mmenu-icon-messages.png"></span> Messages <span class="fa fa-angle-down"></span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <ul class="nav navbar-nav navbar-right user-profile">
                        <li class="dropdown hidden-xs">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="help.php">Help</a>
                        </li>
                        <li class="dropdown drpprofile">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)">

                                <img class="img-circle" src="">
                                <span class="fa fa-angle-down"></span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
         </nav> 
<script>
    function SubmitEmail() {
        $('#ErrFpUserName').html("");
        return IsNonEmpty("FpUserName","ErrFpUserName","Please Enter Valid Login Name or Email");
    }
</script>
          <?php
            if (isset($_POST['btnResetPassword'])) {
                
                $response = $webservice->getData("Member","forgotPassword",$_POST);
                if ($response['status']=="success") {
                    ?>
                    <form action="forget-password-otp.php" id="reqFrm" method="post">
                        <input type="hidden" value="<?php echo $response['data']['reqID'];?>" name="reqID">
                        <input type="hidden" value="<?php echo $response['data']['email'];?>" name="reqEmail">
                    </form>
                    <script>document.getElementById("reqFrm").submit();</script>
                <?php
                    }
                    else{
                        $errormessage = $response['message']; 
                    } 
            }
            ?>
         <div class="page-container" style="margin-top: -19px">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 container-contentbar">
                        <div class="page-main">
                            <div style="background:white ;height: 310px;width: 361px;margin-top: 50px;margin-bottom: 110px;padding-top:34px;border-radius: 10px;margin-left: 373px;padding-left:35px;padding-right:35px">
                     <form method="POST" action="" onsubmit="return SubmitEmail();">
                <div class="form-group">
                <div align="center"><p style="text-align: center;color: #E3425B;font-size: 21px;">Forget Password</p></div>
                  <div class="input-group">
                    <small style="font-size: 12px;font-weight: 400;">Please provide your Member Id or Registered Email Address, we'll send a verification code to your email address to reset your password.</small>
                  </div>
                </div>
                <input type="text"  placeholder="Member Id / Registered Email Address" id="FpUserName" name="FpUserName" value="<?php echo isset($_POST['FpUserName']) ? $_POST['FpUserName'] : '';?>" style="width:100%;margin-bottom:10px;padding: 7px;">
                 <span class="errorstring" id="ErrFpUserName"><?php echo isset($ErrFpUserName)? $ErrFpUserName : "";?></span>
                <?php echo '<div style="color:red">'; echo $errormessage;?>
                <button type="submit" class="btn btn-primary" name="btnResetPassword" style="width:100%">Submit</button>
                <hr>
                <div>
                  <a href="index.php" class="text-small forgot-password text-black">Back to SignIn</a>
                </div>
              </form>
                        </div>
                    </div>
                    </div>
                    
                    </div>
                </div>
        </div>
         <?php include_once("footer.php");?>