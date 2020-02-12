<?php
if (file_exists("./../../../config.php")) {
   include_once("./../../../config.php");
} else {
 exit;
}

session_start();
require_once( 'Facebook/autoload.php' );
$fb = new Facebook\Facebook([
  'app_id' => '2466720886885490',
  'app_secret' => 'b4adde9656e8267b8c156de3312b3530',
  'default_graph_version' => 'v2.12',
]);  
  
$helper = $fb->getRedirectLoginHelper();  
  
try {  
  $accessToken = $helper->getAccessToken();  
} catch(Facebook\Exceptions\FacebookResponseException $e) {  
  // When Graph returns an error  
  
  echo 'Graph returned an error: ' . $e->getMessage();  
  exit;  
} catch(Facebook\Exceptions\FacebookSDKException $e) {  
  // When validation fails or other local issues  

  echo 'Facebook SDK returned an error: ' . $e->getMessage();  
  exit;  
}  


try {
  $response = $fb->get('/me?fields=id,name,email,first_name,last_name', $accessToken->getValue());
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'ERROR: Graph ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  echo 'ERROR: validation fails ' . $e->getMessage();
  exit;
}
$me = $response->getGraphUser();

//echo "Full Name: ".$me->getProperty('name')."<br>";
//echo "First Name: ".$me->getProperty('first_name')."<br>";
//echo "Last Name: ".$me->getProperty('last_name')."<br>";
//echo "Email: ".$me->getProperty('email');
//echo "Facebook ID: <a href='https://www.facebook.com/".$me->getProperty('id')."' target='_blank'>".$me->getProperty('id')."</a>";

 
 

$id =  $db->insert("_tbl_v3_SocialMediaSignup", array("SocialMedia"=>"Facebook",
            "FullName"=>$me->getProperty('name'),
            "FirstName"=>$me->getProperty('first_name'),
            "LastName"=>$me->getProperty('last_name'),
            "EmailID"=>$me->getProperty('email'),
            "RequestedOn"=>date("Y-m-d H:i:s"),
            "responsetxt"=>json_encode($response)));
            
            $iuongouser = $db->select("select * from _tblclients where emailid='".$me->getProperty('email')."'");
            
            if (sizeof($iuongouser)>0) {
                $message = "
                    <div style='text-align:center;padding:175px 100px;'>
                                    <img src='assets/preloading.gif'>
                                    <div style='text-align:center;padding:10px;'>Loading Dashboard</div>
                               </div>
                  
                    <form action='app/index.php' method='post'  id='facebookform'>
                        <input type='hidden' name='social_email' value='".md5($me->getProperty('email')."DEVELOPER.JEYARAJ_123@YAHOO.COM")."'>
                        <input type='hidden' name='facebook_email' value='".md5($me->getProperty('email')."DEVELOPER.JEYARAJ_123@YAHOO.COM")."'>
                        <input type='hidden' value=' Continue ' name='signin'>
                    </form>
                    
                ";
            } else {
                 $insertID = $db->insert("_tblclients", array("emailid"      => $me->getProperty('email'),
                                                              "firstname"    => $me->getProperty('first_name'),
                                                              "lastname"     => $me->getProperty('last_name') ,
                                                              "signupfrom"   => "Facebook" ,
                                                              "registeredon" => date("Y-m-d H:i:s")));
                $message = "
                  <div style='text-align:center;padding:100px 50px;'>
                        <img src='app/assets/images/icon_jobposted.png' style='height:64px;width:64px'>
                        <div style='text-align:center;padding:10px;padding-top:30px;color:#555'>Registration completed successfully.</div>
                   </div>
                   
                    
                      <form action='app/index.php' method='post' id='facebookform_choosetype'>
                        <input type='hidden' name='social_email' value='".md5($me->getProperty('email')."DEVELOPER.JEYARAJ_123@YAHOO.COM")."'>
                        <input type='hidden' name='facebook_email' value='".md5($me->getProperty('email')."DEVELOPER.JEYARAJ_123@YAHOO.COM")."'>
                        <div style='border-radius: 0 0 3px 3px;border: 1px solid #ddd;padding: 20px;padding-top:10px;text-align:center;color:#666'>
                            I would like to Join as  <br><br>
                            <input type='submit' class='btnprimary' name='btnBuyer' value='   Buyer   ' style='width:164px;padding-left:0px;padding-right:0px;font-weight:bold;'>&nbsp;&nbsp;             
                            <input type='submit' class='btnprimary' name='btnManufacturer' value='   Manufacturer   ' style='width:164px;padding-left:0px;padding-right:0px;;font-weight:bold;'>             
                        </div>
                    </form> 
                
                ";
            }

if ($id>0) {
    ?>
     <form action="http://www.iuongo.com" method="post" id="facebookform">
             <input type="hidden" name="facebook_email" value="<?php echo $me->getProperty('email'); ?>">
        <input type="hidden" name="pagefrom" value="facebook">
        <input type="hidden" name="code" value="facebook">
        <textarea name="content" style="display: none;"><?php echo base64_encode($message);?></textarea>
      </form>
      <script>
        document.getElementById("facebookform").submit();
      </script>
    <?php
}

 

?>