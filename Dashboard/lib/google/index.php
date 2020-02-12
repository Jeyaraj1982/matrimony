<?php
exit;
//Include GP config file && User class
include_once 'gpConfig.php';
 

if(isset($_GET['code'])){
	$gClient->authenticate($_GET['code']);
	$_SESSION['token'] = $gClient->getAccessToken();
	header('Location: ' . filter_var($redirectURL, FILTER_SANITIZE_URL));
}

if (isset($_SESSION['token'])) {
	$gClient->setAccessToken($_SESSION['token']);
}

if ($gClient->getAccessToken()) {
	//Get user profile data from google
	$gpUserProfile = $google_oauthV2->userinfo->get();
	  die;
	//Initialize User class
	//$user = new User();
	
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
    $userData = $user->checkUser($gpUserData);
	  die;
	//Storing user data into session
	$_SESSION['userData'] = $userData;
	
	//Render facebook profile data
    if(!empty($userData)){
        $output = '<h1>Google+ Profile Details</h1>';
        $output .= '<img src="'.$userData['picture'].'" width="300" height="220">';
        $output .= '<br/>Google ID : ' . $userData['oauth_uid'];
        $output .= '<br/>Name : ' . $userData['first_name'].' '.$userData['last_name'];
        $output .= '<br/>Email : ' . $userData['email'];
        $output .= '<br/>Gender : ' . $userData['gender'];
        $output .= '<br/>Locale : ' . $userData['locale'];
        $output .= '<br/>Logged in with : Google';
        $output .= '<br/><a href="'.$userData['link'].'" target="_blank">Click to Visit Google+ Page</a>';
        $output .= '<br/>Logout from <a href="logout.php">Google</a>'; 
    }else{
        $output = '<h3 style="color:red">Some problem occurred, please try again.</h3>';
    }
} else {
	$authUrl = $gClient->createAuthUrl();
	$output = '<a href="'.filter_var($authUrl, FILTER_SANITIZE_URL).'"><img src="images/glogin.png" alt=""/></a>';
}
?>
<html>
<body>

</body>
</html>
<h2>User Registration Page</h2>
<form action="Userregistrationprocess.php" method="post" >
First Name: <input type="text" placeholder="Enter Name" name="txt_fname"> Last Name: <input type="text" placeholder="Enter Name" name="txt_lname"><br><br>
Password: <input type="text" placeholder="Password" name="txt_password"><br><br>
Confirm Password: <input type="text" placeholder="Re-type Password" name="txt_repassword"><br><br>
Email Address: <input type="text" placeholder="Email" name="txt_email"><br><br>
Mobile Number: <input type="text" placeholder="mobile" name="txt_mobile"><br><br>
<button type="submit" name="btn_submit">Submit<br></button>
<button type="submit" name="btn_cancel">Cancel</button> <br><br>
<button type="submit" name="btn_fb">Register with Facebook</button> <br><br>

 </form>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login with Google using PHP by QAWebPrints</title>
<style type="text/css">
h1{font-family:Arial, Helvetica, sans-serif;color:#999999;}
</style>
</head>
<body>
<div><?php echo $output; ?></div>
</body>
</html>