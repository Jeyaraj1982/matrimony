<?php
include_once 'gpConfig.php';
if (file_exists("./../../../config.php")) {
    include_once("./../../../config.php");
} else {
    exit;
}
if(isset($_GET['code'])){
	$gClient->authenticate($_GET['code']);
	$_SESSION['token'] = $gClient->getAccessToken();
	//header('Location: ' . filter_var($redirectURL, FILTER_SANITIZE_URL));
}
if (isset($_SESSION['token'])) {
	$gClient->setAccessToken($_SESSION['token']);
}
if ($gClient->getAccessToken()) {
	//Get user profile data from google
	$gpUserProfile = $google_oauthV2->userinfo->get();
	//Insert or update user data to the database
    $gpUserData = array(
        'oauth_provider'=> 'google',
        'oauth_uid'     => $gpUserProfile['id'],
        'first_name'    => $gpUserProfile['given_name'],
        'last_name'     => $gpUserProfile['family_name'],
        'email'         => $gpUserProfile['email'],
        'gender'        => $gpUserProfile['gender'],
        'locale'        => $gpUserProfile['locale'],
        'picture'       => $gpUserProfile['picture'],
        'link'          => $gpUserProfile['link']
    );
    $userData = $gpUserProfile;
    if(!empty($userData)){
    
    }else{
        $output = '<h3 style="color:red">Some problem occurred, please try again.</h3>';
    }
} else {
	$authUrl = $gClient->createAuthUrl();
	$output = '<a href="'.filter_var($authUrl, FILTER_SANITIZE_URL).'"><img src="images/glogin.png" alt=""/></a>';
}
$_SESSION['token']="";
$response = json_decode($webservice->SocialMediaSignup(array("emailAddress" => $userData['email'],
                                                             "SocialMedia"  => "Google",
                                                             "responseText" => json_encode($userData))),true);
if ($response->IsMember==1) {
    $id=1;
    $message = "
        <div style='text-align:center;padding:175px 100px;'>
                        <img src='assets/preloading.gif'>
                        <div style='text-align:center;padding:10px;'>Loading Dashboard</div>
                   </div>
        <form action='app/index.php' method='post'  id='googleform'>    
            <input type='hidden' name='google_email' value='".md5($userData['email']."DEVELOPER.JEYARAJ_123@YAHOO.COM")."'>
            <input type='hidden' name='social_email' value='".md5($userData['email']."DEVELOPER.JEYARAJ_123@YAHOO.COM")."'>
            <input type='hidden' value=' Continue ' name='signin'>
        </form>
    ";
} else {
    $id=1;
    $message = "
       <div style='text-align:center;padding:100px 50px;'>
            <img src='app/assets/images/icon_jobposted.png' style='height:64px;width:64px'>
            <div style='text-align:center;padding:10px;padding-top:30px;color:#555'>Registration completed successfully.</div>
       </div>
       <form action='app/index.php' method='post' id='googleform_choosetype'>
            <input type='hidden' name='social_email' value='".md5($userData['email']."DEVELOPER.JEYARAJ_123@YAHOO.COM")."'>
            <input type='hidden' name='google_email' value='".md5($userData['email']."DEVELOPER.JEYARAJ_123@YAHOO.COM")."'>
            <div style='border-radius: 0 0 3px 3px;border: 1px solid #ddd;padding: 20px;padding-top:10px;text-align:center;color:#666'>
                I would like to Join as  <br><br>
                <input type='submit' class='btnprimary' name='btnBuyer' value=' Purchaser ' style='width:164px;padding-left:0px;padding-right:0px;font-weight:bold;'>&nbsp;&nbsp;             
                <input type='submit' class='btnprimary' name='btnManufacturer' value='     Supplier     ' style='width:164px;padding-left:0px;padding-right:0px;;font-weight:bold;'>             
            </div>
        </form> 
    ";
}
if ($id>0) {
    ?>
     <form action="https://www.iuongo.com" method="post" id="googleform">
             <input type="hidden" name="google_email" value="<?php echo $userData['email']; ?>">
        <input type="hidden" name="pagefrom" value="google">
        <input type="hidden" name="code" value="goolgle">
        <textarea name="content" style="display: none;"><?php echo base64_encode($message);?></textarea>
      </form>
      <script>
        document.getElementById("googleform").submit();
      </script>
<?php } ?>