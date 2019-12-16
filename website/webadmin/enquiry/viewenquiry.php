<script src="./../../assets/js/jquery-1.7.2.js"></script>
<link rel="stylesheet" href="./../../assets/css/demo.css">
<style>
.mytr:hover{background:#c4e9f2;cursor:pointer}
  .title_Bar {background:url(../images/blue/titlebackground.png);padding:5px;color:#6db2bc;font-family:'Trebuchet MS';font-size:13px !important;font-weight: bold;padding:11px !important;}   
  .odd {background:#f2fcff}
  .odd:hover {background:#c4e9f2}
  .even {background:#fff}
  .even:hover {background:#c4e9f2}
 
</style>
<?php
     include_once("../../config.php");
        if (!(CommonController::isLogin())){
        echo CommonController::printError("Login Session Expired. Please Login Again");
        exit;
    }

?>
   <body style="margin:0px;background:#e3f3f7">
        
        <div class="title_Bar">Manage Items</div> 
        <div style="margin:10px;background:#fff">
  
     <?php
           $result = $mysql->select("select * from _nicus_enquiry as enq,_jlisting as lst where enq.itemid=lst.itemid and enq.enquiryid=".$_REQUEST['id']);
       //    print_r($result);
           $r = $result[0];
     ?>
  <div>
    <table align="center" width="100%" cellpadding="5" cellspacing=0>
 
        <tr>
            <td style="vertical-align: top;">
                 <form action="" method="post">
                    <input type="hidden" value="<?php echo $param[0];?>" name="itemid">
                    <table cellpadding="5" cellspacing="0" style="font-size:12px;color:#666;font-family:arial;font-weight:bold;width:100%">
           
                        <tr>
                            <td style="width:180px;">Purpose</td>
                            <td style="width:10px">:</td>
                            <td><?php echo $r['purpose'];?></td>
                        
                        <tr>     <tr>
                            <td>Company/Business Name</td>
                            <td>:</td>
                            <td><?php echo $r['orgname'];?></td>
                        
                        <tr>
                            <td>Person Name</td>
                            <td>:</td>
                             <td><?php echo $r['custname'];?></td>
                        </tr>
                 
                        <tr>
                            <td>Email ID</td>
                            <td>:</td>
                             <td><?php echo $r['custname'];?></td>
                        </tr>
                        
                        <tr>
                            <td>Mobile Number</td>
                            <td>:</td>
                            <td><?php echo $r['custname'];?></td>
                        </tr>
                        <tr>
                            
                        </tr>
                        <tr>
                            <td>Landline No (Optional)</td>
                            <td>:</td>
                             <td><?php echo $r['landline'];?></td>
                        </tr>
                        
                        <tr>
                            <td>Short Description</td>
                            <td>:</td>
                             <td><?php echo $r['shortdescription'];?></td>
                        </tr>
                     
                        <tr>
                            <td>Detail Description</td>
                            <td>:</td>
                            <td><?php echo $r['detaildescription'];?></td>
                        </tr>
                        <tr>
                            <td>Admin Feedback</td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <textarea style="height:80px;width:100%;"></textarea>
                            </td>
                        </tr>
                    </table>
                </form>
            </td>
            <td  style="vertical-align: top;width:240px;background: #e3f3f7;padding:10px;">
                        <div>
                            <?php
                               
                               
                                 
                                 //   echo Type_enquiry($result[0]['itemid']);
                                
                                  $result = '<div class="listitems" style="float:left;width:auto;margin-left:5px;margin-bottom:5px;">
                       
                        
                            <table width="100%" cellpadding="0" cellspacing="0" style="font-family:arial;font-size:12px">
                                <tr>
                                    <td style="text-align:center;height:50px;">
                                        <div style="width:236px;text-align:center;font-weight:bold;font-size:13px;font-family:\'Trebuchet MS\'">
                                    '.$r["itemname"].' 
                                    </div>
                                    </td>
                                <tr>
                                    <td style="width:236px;"><img src="../../assets/'.$config['thumb'].'/'.$r["filename"].'" style="height:177px;width:236px;"></td>
                                </tr>
                                <tr>
                                    <td style="padding-top:5px;padding-top:5px;">
                                        <div style="width: 100%; background: #ccc none repeat scroll 0 0;border: 1px solid #ccc;float: left;font-weight: bold;text-align: center;padding-top:5px;padding-bottom:5px">'.$r["itemprice"].'</div>
                                    </td>
                                </tr>
                                
                                
                            </table>
                        </div>';
        echo $result;
        
                            ?> 
                            No of Visitors<br>
                            Previous Enquuires<br>
                            View In Website<br>
                            Edit Product<br>
                            Unpublish Product<br>
                            
                        </div>
            </td>
        </tr>
    </table>
</div>

</div>
</body> 