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
   <body style="margin:0px;background:#e3f3f7">
        
        <div class="title_Bar">Manage Items</div> 
        <div style="margin:10px;background:#fff">
     <table cellpadding="5" cellspacing="0" width="100%" style="font-size:12px;font-family:'Trebuchet MS';color:#444"> 
        <tr style="background:#97dced;color:#fff;font-weight:bold;font-size:13px">
            <td width="132" style="padding:10px;"></td>
            <td width="150" style="padding:10px;">Item Name</td>
            <td width="150" style="padding:10px;">Name of Company</td>
            <td style="padding:10px;">Customer Name</td>
            <td width="200" style="padding:10px;">Mobile No</td>
            <td width="120" style="padding:10px;">Enquired On</td>
            <td width="50" style="padding:10px;"></td>
        </tr>
<?php 
    include_once("../../config.php");
        if (!(CommonController::isLogin())){
        echo CommonController::printError("Login Session Expired. Please Login Again");
        exit;
    }

    
    $result = $mysql->select("select * from _nicus_enquiry as enq,_jlisting as lst where enq.itemid=lst.itemid order by enq.enquiryid desc");
    $i=0;
    foreach ($result as $r)
    {
        $i++;
    ?>
 
            
           
                    <tr <?php echo ($i%2)==0 ? 'class="odd"' : 'class="even"';?>    >
                        <td>
                            <img src="../../assets/<?php echo $config['thumb'];?>/<?php echo $r["filename"];?>" style="height:99px;width:132px;">
                        </td>
                        <td style='width:150px;' >
                            <?php echo $r["itemname"];?> <br> 
                            <?php echo $r["itemprice"];?>  
                        </td>
                        <td style='width:150px;' >
                            <?php echo $r["orgname"];?>  
                        </td>
                        <td>
                             <?php echo $r["custname"];?> 
                        </td>
                        <td>
                             <?php echo $r["mobilenumber"];?> 
                        </td>
                        <td>
                             <?php echo $r["enquiredon"];?> 
                        </td>
                        
                        <td>
                            <a href="viewenquiry.php?id=<?php echo $r['enquiryid'];?>">view</a>
                            
                        </td>
                    </tr>
                
    
    <?php
        
    
    }

    
?></table>
</div>
</body> 