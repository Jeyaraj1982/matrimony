 <style>
.mytr:hover{background:#f6f6f6;cursor:pointer}
</style>
<script src="./../../assets/js/jquery-1.7.2.js"></script>
<link rel="stylesheet" href="./../../assets/css/demo.css">
<body style="margin:0px;">
<div class="titleBar">List of User</div>  
<?php 
include_once("../../config.php");
    if (!(CommonController::isLogin())){
        echo CommonController::printError("Login Session Expired. Please Login Again");
        exit;
    } 
    
    echo "<table  cellspacing='0' cellspadding='5' style='font-size:13px;font-family:Trebuchet MS;color:#222;width:100%'>";
   
    foreach (JUsertable::getUser() as $r)
    {
        ?>
    <tr class='mytr'>
            <td style='padding:5px'>
                <b>Person Name:<?php echo $r["personname"];?></b><br>
                <br>User Name:<b><?php echo $r["uname"];?></b> &nbsp;&nbsp;
                Password:<b><?php echo $r["pwd"];?></b>   
                <br><div style="padding:3px;padding-left:0px;">
                Created On: <span style="color:#444;font-weight:bold;"><?php echo $r["createdon"]; ?></span>&nbsp;&nbsp;
                Status: 
                <?php if ($r["isactive"]) {?>
                    <span style='color:#08912A;font-weight:bold;'>Active</span> 
                <?php } else { ?>
                    <span style='color:#FF090D;font-weight:bold;'>In Active</span> 
                <?php } ?>
                </div>
            </td>
            <td width='160' style='text-align:center;'>
                <form action='manageuser.php' method='post' style='height:0px;'>
                    <input type='hidden' value='<?php echo $r["userid"];?>' name='rowid' id='rowid' >
                    <input style='font-size:11px;' type='submit' name='editbtn' value='Edit'>
                    <input style='font-size:11px;' type='submit' name='viewbtn' value='View'>
                </form>
            </td>
          </tr>
          <tr>
            <td colspan='2'><hr style='border:none;border-bottom:1px solid #f1f1f1'></td>
          </tr>
           <?php
    }
     echo"</table>"           
?>
</body>

