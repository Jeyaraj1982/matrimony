<?php 
    error_reporting(0);
        include_once("../../config.php");
                    if (!(CommonController::isLogin())){
                echo CommonController::printError("Login Session Expired. Please Login Again");
                exit;
            }
             if (isset($_POST{"save"})) {
                 
                if(CommonController::isEmptyField($_POST['datepicker'])||CommonController::isEmptyField($_POST['desctamil']) || CommonController::isEmptyField($_POST['descenglish'])||CommonController::isEmptyField($_POST['descmal'])) {
                        echo CommonController::printError ("All Fields are Required"); 
                } 
                else if(JCustomize::addCustomize($_POST['datepicker'],$_POST['desctamil'],$_POST['descenglish'],$_POST['descmal'],$_POST['eventcate'])>0){
                        echo CommonController::printSuccess("Customize Added Successfully");       
                } else {
                        echo CommonController::printError("Error Adding Customize");
                  }
   }    
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css">
<script>                              
$(function() {$( "#datepicker" ).datepicker({showOn: 'button',buttonImage:'http://theonlytutorials.com/demo/x_office_calendar.png', width:20,height:20,buttonImageOnly: true,changeMonth: true,changeYear: true,showAnim: 'slideDown',duration: 'fast',dateFormat: 'yy-mm-dd'});
 });
</script>
 <style type="text/css">
.ui-datepicker {font-size:9pt;font-family:Verdana;background-color:grey;}
 .datepicker{color:black;text-decoration: none;font-size:inherit;font-size:12px;position: relative; top: 1px;}
</style>
<body style="margin:0px;">
    <div style='font-family:arial;font-size:13px;border:1px solid #ccc;background:#ccc;padding:3px;font-weight:bold;color:#444;'>Add Customize</div> 
        <form action="" method="post" style="height: 20px;" enctype="multipart/form-data">
            <table  style="margin:10px;width:100%;font-size:12px;font-family:arial;color:#333" cellpadding="3" cellspacing="0" align="center">
                <tr>
                <td style="width:150px;">Event Date</td> 
                <td><input id="datepicker" class="datepicker" type="text" size="40" name="datepicker"/></td>
               </tr>
               <tr>
                     <td style="width:150px;">Description Tamil</td>
                     <td><textarea cols="28" rows="9" name="desctamil"></textarea></td> 
               </tr>
               <tr>
                     <td style="width:150px;">Description English</td>
                     <td><textarea cols="28" rows="9" name="descenglish"></textarea></td> 
               </tr>
               <tr>
                     <td style="width:150px;">Description Malayalam</td>
                     <td><textarea cols="28" rows="9" name="descmal"></textarea></td> 
               </tr>
               <tr>
                     <td style="width:150px;">Event Category</td>
                     <td><select name="eventcate"><option value="1">X</option><option value="2">Y</option></select></td> 
               </tr>
                <tr>
                    <td align="left"><input type="submit" name="save" value="Save" bgcolor="grey">  
                    <input type="button" name="cancel" value="Cancel" bgcolor="grey" onclick="location.href='managecustomize.php'"></td></td>
              </tr> 
            </table>
        </form>
</body>