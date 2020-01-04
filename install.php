<?php

if (isset($_GET['action'])) {
echo $_GET['action']();    
} else {
    echo homescreen();
}
function page_header() {
     $return = '
     <style>
        .txtbox {padding:6px;border:1px solid #bbb;margin-bottom:10px;width:100%;margin-top:3px;font-family:arial;font-size:14px;color:#666}
        .txtbox:hover {background:#fcf8de}
        body,table,tr,td {font-family:arial;color:#444;font-size:15px}
     </style>
     <body style="background:#aaa;margin:10%;">
     <div style="background:#fff;border:1px solid #888;width:800px;margin:0px auto;height:500px;border-radius:10px;overflow:hidden;min-width: 800px;max-width: 800px; box-shadow: 5px 5px #888888;">
     <div style="background:#10a5bc;float:left;width:250px;height:500px;border-radius:10px 0px 0px 10px;">
     
     </div>
     <div style="background:red;float:left;height:450px;width:500px;background:#f9f9f9;padding:25px;">
     
     
     
    ';
    return $return;
}
function page_footer() {
     $return = '
     
     </div>
      </div>
     </body>
    ';
     return $return;
}
function homescreen() {
    
    $return = '
           <form action="?action=cmsdb" method="Post">       
            <div style="height:200px;width:100%;overflow:auto;border:1px solid #ccc;">
                  ddddd
            </div>
            <input type="checkbox"><bR>
            <div style="text-align:right">
            <input type="submit" value="Next">
            </div>
          </form>
    ';
    return page_header().$return.page_footer();
    
    
}

function cmsdb() {
    
    $return = '
     <h2>Website CMS Database Details</h2>
           <form action="?action=matridb" method="Post">       
            <div style="height:350px;width:100%;overflow:auto;">
            <table style="width:100%" cellpadding="0" cellspacing="3">
                <tr>
                    <td>Host Name*</td>
                </tr>
                <tr>
                    <td><input type="Text" placeholder="Host Name" class="txtbox"></td>
                </tr>
                <tr>
                    <td>Database Username*</td>
                </tr>
                <tr>
                    <td><input type="Text" placeholder="Database username" class="txtbox"></td>
                </tr>
                  <tr>
                    <td>Database Password*</td>
                </tr>
                <tr>
                    <td><input type="Text" placeholder="Database password" class="txtbox"></td>
                </tr>
                  <tr>
                    <td>Database Name*</td>
                </tr>
                <tr>
                    <td><input type="Text" placeholder="Database Name" class="txtbox"></td>
                </tr>
                
            
            </table>
           
            
            
            </div>
             
            <div style="text-align:right">
            <input type="submit" value="Next">
            </div>
          </form>
    ';
    return page_header().$return.page_footer();
    
    
}
       

function matridb() {
    
    $return = '
    <h2>Matrimony Application Database Details</h2>
              <form action="?action=matridb" method="Post">       
            <div style="height:350px;width:100%;overflow:auto;">
            <table style="width:100%" cellpadding="0" cellspacing="3">
                <tr>
                    <td>Host Name*</td>
                </tr>
                <tr>
                    <td><input type="Text" placeholder="Host Name" class="txtbox"></td>
                </tr>
                <tr>
                    <td>Database Username*</td>
                </tr>
                <tr>
                    <td><input type="Text" placeholder="Database username" class="txtbox"></td>
                </tr>
                  <tr>
                    <td>Database Password*</td>
                </tr>
                <tr>
                    <td><input type="Text" placeholder="Database password" class="txtbox"></td>
                </tr>
                  <tr>
                    <td>Database Name*</td>
                </tr>
                <tr>
                    <td><input type="Text" placeholder="Database Name" class="txtbox"></td>
                </tr>
                
            
            </table>
           
            
            
            </div>
             
            <div style="text-align:right">
            <input type="submit" value="Next">
            </div>
          </form>
    ';
    return page_header().$return.page_footer();
    
    
}


function superusers() {
    
    $return = '
    <h2>Super user account details</h2>
           <form action="?action=matrisettings" method="Post">       
            <div style="height:350px;width:100%;overflow:auto;">
            <h3>Website CMS</h3>
            <input type="Text" placeholder="Host Name"><br>
            <input type="Text" placeholder="DB User Name">  <br>
            <input type="Text" placeholder="DB User Name">  <br>
            <h3>Matrimony Application</h3>
            <input type="Text" placeholder="DB User Password">  <br>
            <input type="Text" placeholder="DB User Password">  <br>
            <input type="Text" placeholder="DB User Password">  <br>
            <input type="Text" placeholder="Database Name">  <br>
            
            
            </div>
             
            <div style="text-align:right">
            <input type="button" value="Next">
            </div>
          </form>
    ';
    return page_header().$return.page_footer();
    
    
}
function execute_cmsdb() {
    
}
function execute_matridb() {
    
}
function execute_settings() {
    
}
?>