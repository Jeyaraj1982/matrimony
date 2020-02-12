<?php
    include_once("./../../../config.php");
    
    $config['callback_url']  = 'https://www.iuongo.com/app/services/signup/linkedin/process.php';
    $config['Client_ID']     = '81oxeb1ckempkv';
    $config['Client_Secret'] = '3ApPFJEX0uttJHTE';
    $error_message = "";
    
    //$_GET['code']="http://aranzia.com/linkedin.php?code=AQRKLhcd-NMPse6EBAXFKPUhbeeJr7eUWsdhTBjroE0FhTgZfuUteahJDHF2fl64_mcxz1u0-n7WT3fLz2PL7iJ-1Ug3BMuDM6Jq6-JdLoUqFnXmJ6re_dI5p2h_eTOS1vmOmKDxYGSaXoa7L8J2hlZO_2xILQ&state=98765EeFWf45A53sdfKef4233#!";
    function post_curl($url,$param="")
    {
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        if($param!="")
        curl_setopt($ch,CURLOPT_POSTFIELDS,$param);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }
 
    if (isset($_GET['error'])) {
         $error_message = $_GET['error_description'];
    }
    
    if(isset($_GET['code'])) // get code after authorization
    {
        $url = 'https://www.linkedin.com/uas/oauth2/accessToken'; 
        $param = 'grant_type=authorization_code&code='.$_GET['code'].'&redirect_uri='.$config['callback_url'].'&client_id='.$config['Client_ID'].'&client_secret='.$config['Client_Secret'];
        $return = (json_decode(post_curl($url,$param),true)); // Request for access token
    
        if($return['error']) // if invalid output error
        {
            $error_message = $return['error_description'];
        }
        else // token received successfully
        {
            $url = 'https://api.linkedin.com/v1/people/~:(id,firstName,lastName,pictureUrls::(original),headline,publicProfileUrl,location,industry,positions,email-address)?format=json&oauth2_access_token='.$return['access_token'];
            $Userdata = post_curl($url); // Request user information on received token
            $User = json_decode($Userdata,true); // Request user information on received token
        }
    }  
    if (strlen(trim($User["emailAddress"]))==0) {
        //error_message = "Process failed";
        ?>
        <script>
            location.href="https://www.iuongo.com";
        </script>
        <?php
    } else {
    
    $id =  $db->insert("_tbl_v3_SocialMediaSignup", array("SocialMedia"=>"LinkedIn",
                                                          "FullName"=>" ",
                                                          "FirstName"=>$User["firstName"],
                                                          "LastName"=>$User["lastName"],
                                                          "EmailID"=>$User["emailAddress"],
                                                          "RequestedOn"=>date("Y-m-d H:i:s"),
                                                          "responsetxt"=>$Userdata));
    $iuongouser = $db->select("select * from _tblclients where emailid='".$User["emailAddress"]."'");
    
    if (sizeof($iuongouser)>0) {
        $message = "<div style='text-align:center;padding:175px 100px;'>
                                    <img src='assets/preloading.gif'>
                                    <div style='text-align:center;padding:10px;'>Loading Dashboard</div>
                               </div>
                  
                
                    <form action='app/index.php' method='post' id='linkedinform'>
                        <input type='hidden' name='linked_email' value='".md5($User["emailAddress"]."DEVELOPER.JEYARAJ_123@YAHOO.COM")."'>
                        <input type='hidden' name='social_email' value='".md5($User["emailAddress"]."DEVELOPER.JEYARAJ_123@YAHOO.COM")."'>
                        <input type='hidden' value=' Continue ' name='signin'>
                    </form>
                   
                ";
    } else {
                 $insertID = $db->insert("_tblclients", array("emailid"      => $User["emailAddress"],
                                                              "firstname"    => $User["firstName"],
                                                              "lastname"     => $User["lastName"] ,
                                                              "signupfrom"   => "LinkedIn" ,
                                                              "registeredon" => date("Y-m-d H:i:s")));
                                                              
                $message = "
                 <div style='text-align:center;padding:100px 50px;'>
                        <img src='app/assets/images/icon_jobposted.png' style='height:64px;width:64px'>
                        <div style='text-align:center;padding:10px;padding-top:30px;color:#555'>Registration completed successfully.</div>
                   </div>
                   
                   
                      <form action='app/index.php' method='post' id='linkedinform_choosetype'>
                        <input type='hidden' name='social_email' value='".md5($User["emailAddress"]."DEVELOPER.JEYARAJ_123@YAHOO.COM")."'>
                        <input type='hidden' name='linked_email' value='".md5($User["emailAddress"]."DEVELOPER.JEYARAJ_123@YAHOO.COM")."'>
                        <div style='border-radius: 0 0 3px 3px;border: 1px solid #ddd;padding: 20px;padding-top:10px;text-align:center;color:#666'>
                            I would like to Join as  <br><br>
                            <input type='submit' class='btnprimary' name='btnBuyer' value=' Purchaser ' style='width:164px;padding-left:0px;padding-right:0px;font-weight:bold;'>&nbsp;&nbsp;             
                            <input type='submit' class='btnprimary' name='btnManufacturer' value='     Supplier     ' style='width:164px;padding-left:0px;padding-right:0px;;font-weight:bold;'>             
                        </div>
                    </form>"; 
                 
                  
            }
    }

if (strlen($error_message)==0) {
    ?>
    <form action="https://www.iuongo.com" method="post" id="linkedinform">
        <input type="hidden" name="linkedin_email" value="<?php echo $User["emailAddress"];?>">
        <input type="hidden" name="pagefrom" value="facebook">
        <input type="hidden" name="code" value="facebook">
        <textarea name="content" style="display: none;"><?php echo base64_encode($message);?></textarea>
    </form> 
    <script>
        document.getElementById("linkedinform").submit();
    </script>
    <?php
}  else {
    ?>
    <form action="https://www.iuongo.com" method="post" id="linkedinform">
        <input type="hidden" name="linkedin_email" value="">
        <input type="hidden" name="pagefrom" value="facebook">
        <input type="hidden" name="code" value="facebook">
        <textarea name="content" style="display: none;"><?php echo base64_encode($error_message);?></textarea>
    </form> 
    <script>
        document.getElementById("linkedinform").submit();
    </script>
    <?php
}
?>