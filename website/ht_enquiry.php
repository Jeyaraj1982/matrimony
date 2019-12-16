<?php 
 
    include_once("config.php");
    $enquiry=true;
    include_once(DOCPATH."/includes/header.php");

    function isValidEmail($email){ 
     $pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$"; 

     if (eregi($pattern, $email)){ 
        return true; 
     } 
     else { 
        return false; 
     }    
} 

 
    if (isset($_REQUEST["/"])) {
        
        $param = explode("-",$_REQUEST["/"]);
   
        if (isset($_REQUEST["/"])) {
            if ($param[0]>0) {
                $result= JListing::getItem($param[0]);  
                $r = $result[0];
                $item_shortdesc = "Price : Rs. ".$r['itemprice']."   ".$r['item_shortdesc'];
            }  
        }
    }
    
    if (isset($_REQUEST["itemtitle"])) {
        
        $result= JListing::getItemByTitle($_REQUEST["itemtitle"]);  
        $r = $result[0];
        $item_shortdesc = "Price : Rs. ".$r['itemprice']."   ".$r['item_shortdesc'];
    }
      
       
     //$param = explode("-",$_REQUEST["/"]);
     if (sizeof($result)==0) {
         echo "Couldn't send request without product. Please select Product";
     } else {
         
         
         if (isset($_POST['BtnSendEnquiry'])) {
             
             $err=0;
             
             if (strlen($_POST['mobilenumber'])!=10) {
                echo "<script>alert('Please Enter Valid Mobile Number');</script>";
                $err++;
             } 
             
             if (!($_POST['mobilenumber']>7000000000 && $_POST['mobilenumber']<9999999999 )) {
                echo "<script>alert('Please Enter Valid Mobile Number');</script>";
                $err++;
             } 
        
             if (!(isValidEmail($_POST['emailid']))) {
                $err++;
                echo "<script>alert('Please Enter Valid Email id');</script>";
             }
        
            if ($err==0) {
                $mysql->insert("_nicus_enquiry",array("orgname"=>$_POST['orgname'],
                                                      "custname"=>$_POST['custname'],
                                                      "itemid"=>$_POST['itemid'],
                                                      "emailid"=>$_POST['emailid'],
                                                      "purpose"=>$_POST['purpose'],
                                                      "mobilenumber"=>$_POST['mobilenumber'],
                                                      "landline"=>$_POST['landline'],
                                                      "shortdescription"=>$_POST['shortdescription'],
                                                      "detaildescription"=>$_POST['detaildescription'],
                                                      "enquiredon"=>date("Y-m-d H:i:s")));
                echo "<script>alert('Your Request has been Send');</script>";
                unset($_POST);
            }
        }
?>
<div>
    <table align="center" width="100%" cellpadding="5" cellspacing=0>
        <tr>
            <td colspan="2" style="background: #f1f1f1 none repeat scroll 0% 0%; padding: 15px; text-align: center; font-family: arial; font-weight: bold; font-size: 19px; color: #666;">
                 Business Enquiry Form<br>
                 <span style="font-size:12px;font-weight:normal">Save time and let us provide your correct information, we call back shorlty </span>
            </td>
        </tr>
        <tr>
            <td style="vertical-align: top;">
                 <form action="" method="post">
                    <input type="hidden" value="<?php echo $param[0];?>" name="itemid">
                    <table cellpadding="5" cellspacing="0" style="font-size:12px;color:#666;font-family:arial;font-weight:bold;width:100%">
                        <tr>
                            <td>Purpose</td>
                            <td style="text-align: center;"> </td>
                        </tr>
                        <tr>
                            <td>
                                <select name="purpose" style="border:1px solid #ccc;padding:5px;width:200px;padding-bottom:7px;padding-left:7px;">
                                    <option value="Individual Purpose">For Individual Purpose</option>
                                    <option value="Business Purpose">For Business Purpose</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Company/Business Name</td>
                        </tr>
                        <tr>
                            <td><input value="<?php echo isset($_POST['orgname']) ? $_POST['orgname'] : '';?>" type="text" name="orgname" style="border:1px solid #ccc;padding:5px;width:400px;padding-bottom:7px;padding-left:7px;" placeholder="Company/Business Name"></td>
                        </tr>
                        <tr>
                            <td>Person Name</td>
                        </tr>
                        <tr>
                            <td><input value="<?php echo isset($_POST['custname']) ? $_POST['custname'] : '';?>"  type="text" name="custname" style="border:1px solid #ccc;padding:5px;width:400px;padding-bottom:7px;padding-left:7px;" placeholder="Your Name"></td>
                        </tr>
                        <tr>
                            <td>Email ID</td>
                        </tr>
                        <tr>
                            <td><input value="<?php echo isset($_POST['emailid']) ? $_POST['emailid'] : '';?>"  type="text" name="emailid" style="border:1px solid #ccc;padding:5px;width:400px;padding-bottom:7px;padding-left:7px;" placeholder="E-Mail Address"></td>
                        </tr>
                        <tr>
                            <td>Mobile Number</td>
                        </tr>
                        <tr>
                            <td>+91 <input value="<?php echo isset($_POST['mobilenumber']) ? $_POST['mobilenumber'] : '';?>"  type="text" name="mobilenumber" style="border:1px solid #ccc;padding:5px;width:375px;padding-bottom:7px;padding-left:7px;" placeholder="Contact Mobile Number"></td>
                        </tr>
                        <tr>
                            <td>Landline No (Optional)</td>
                        </tr>
                        <tr>
                            <td><input value="<?php echo isset($_POST['landline']) ? $_POST['landline'] : '';?>"  type="text" name="landline" style="border:1px solid #ccc;padding:5px;width:400px;padding-bottom:7px;padding-left:7px;" placeholder="Contact Landline Number"></td>
                        </tr>
                        <tr>
                            <td>Short Description</td>
                        </tr>
                        <tr>
                            <td><input value="<?php echo isset($_POST['shortdescription']) ? $_POST['shortdescription'] : '';?>"  type="text" name="shortdescription" style="border:1px solid #ccc;padding:5px;width:400px;padding-bottom:7px;padding-left:7px;" placeholder="Short Description"></td>
                        </tr>
                        <tr>
                            <td>Detail Description</td>
                        </tr>
                        <tr>
                            <td><textarea name="detaildescription" style="border:1px solid #ccc;padding:5px;width:400px;padding-bottom:7px;padding-left:7px;height:100px"><?php echo isset($_POST['detaildescription']) ? $_POST['detaildescription'] : '';?></textarea></td>
                        </tr>
                        <tr>
                            <td><input type="submit" value="Send Enquiry" name="BtnSendEnquiry"></td>
                        </tr>
                    </table>
                </form>
            </td>
            <td  style="vertical-align: top;width:240px;background: #f9f9f9;padding:10px;">
                        <div>
                            <?php
                               
                                
                                 if (sizeof($result)>0)    {
                                    
                                    echo Type_enquiry($result[0]);
                                }
                                
                                
                            ?> 
                        </div>
            </td>
        </tr>
    </table>
</div>

<?php
     }
include_once("includes/footer.php");
?>
