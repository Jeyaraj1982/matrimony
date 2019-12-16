<?php
    include_once("../../config.php");
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<?php 
    if (!(CommonController::isLogin())){
        echo CommonController::printError("Login Session Expired. Please Login Again");
        exit;
    } 
?>
<script src="<?php echo BaseUrl;?>assets/js/jquery-1.7.2.js"></script>
<link rel="stylesheet" href="<?php echo BaseUrl;?>assets/css/demo.css">
<style>
    .mytr:hover{background:#c4e9f2;cursor:pointer}
    .title_Bar {background:url(../images/blue/titlebackground.png);padding:5px;color:#589cb5;font-family:'Trebuchet MS';font-size:13px !important;font-weight: bold;padding:11px !important;}   
    .odd {background:#f2fcff}
    .odd:hover {background:#c4e9f2}
    .even {background:#fff}
    .even:hover {background:#c4e9f2}
    .label {font-family:arial;font-size:12px;color:#555}
    input[type="text"] {border:1px solid #c8ddf7;padding:2px}
    textarea {border:1px solid #c8ddf7;padding:2px}
    select {border:1px solid #c8ddf7;padding:2px}
    
    .submitbtnblue{
        border:none;
        cursor: pointer;
            background: #42b8dd; /* this is a light blue */
            color: white;
            padding: 8px 30px;
            text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2);
        }

        .submitbtnblue:hover    {
            background: #32a6c9; /* this is a light blue */
            
        }
    .arrow-down {
  width: 0; 
  height: 0; 
  border-left: 5px solid transparent;
  border-right: 5px solid transparent;
  
  border-top: 5px solid #006621;
    margin-top: 6px;
    position: absolute;
}
.arrow-right {
  width: 0; 
  height: 0; 
  border-top: 60px solid transparent;
  border-bottom: 60px solid transparent;
  
  border-left: 60px solid green;
}

.arrow-left {
  width: 0; 
  height: 0; 
  border-top: 10px solid transparent;
  border-bottom: 10px solid transparent; 
  
  border-right:10px solid blue; 
}

.arrow-up {
  width: 0; 
  height: 0; 
  border-left: 5px solid transparent;
  border-right: 5px solid transparent;
  
  border-bottom: 5px solid black;
}
</style>
<body style="margin:0px;background:#f2f7ff">