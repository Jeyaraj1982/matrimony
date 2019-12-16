<?php 
    //include_once("../config.php");
    $msg = "";
    if (isset($_POST['loginbtn'])) {
    
          $record = $mysql->select("select * from _jusertable where uname='".trim($_POST['uname'])."' and pwd='".trim($_POST['upass'])."' and isactive=1");
          if (sizeof($record)>0) {
            $_SESSION['USER'] = $record[0];
            echo "<script>location.href='dashboard.php';</script>";
          } else {
              $msg = "Invalid Login Details";
          }
    }
?>
<style>
.inputbox {padding:4px;font-size:12px;color:#666;font-family:'Trebuchet MS';border:1px solid #ccc;width:250px}
.inputbox:hover {background:#ffffdb}
</style>
<body style="margin:0px;background:#fcfcfc"> 
    <form action="" method="post">
        <div style="margin:0px auto;margin-top:150px;border:1px solid #ccc;border-radius:7px;width:400px;padding:10px;background:#f9f9f9">
            <table align="center" cellpadding="5" cellspacing="0" style="font-size:12px;color:#666;font-family:'Trebuchet MS';width:100%">
                <tr>
                    <td colspan="2" style="font-size:16px;color:orange;font-family:'Trebuchet MS';font-weight: bold;;">
                        <b>JWeb</b>
                        <hr style="border:none;border-bottom:1px solid #e5e5e5">
                    </td>
                </tr>
                <tr>   
                    <td>
                        <table align="center" cellpadding="5" cellspacing="0" style="font-size:12px;color:#666;font-family:'Trebuchet MS'">
                            <tr>
                                <td style="text-align: right;">User Name</td>
                                <td><input class="inputbox" autocomplete="off"  type="text" name="uname" id="uname" title="Login User Name" value="<?php echo $_POST['uname'];?>"></td>
                            </tr>                                   
                            <tr>
                                <td style="text-align: right;">Password</td>
                                <td><input class="inputbox" type="password" name="upass" id="upass"  title="Login Password" value="<?php echo $_POST['upass'];?>"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" value=" " name="loginbtn" style="cursor:pointer;border: medium none; background: url('http://png-3.findicons.com/files/icons/2017/free_button/40/login.png') repeat scroll 0px 0px transparent; width: 40px; height: 19px;" id="loginbtn">
                                    <?php if (strlen(trim($msg))>0) { ?>
                                        &nbsp;&nbsp;&nbsp;<span style="color:red;text-align:center;font-weight:normal;"><?php echo $msg;?></span>
                                    <?php } ?>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>                                   
            </table>
        </div>
    </form>
    <div style="font-size:12px;color:#999;font-family:'Trebuchet MS';text-align:center;">
        Powered By : <a href='http://www.nicussoftware.com' style="color:#999;">j2jsoftwaresolutions.com</a>
    </div>
</body>  
