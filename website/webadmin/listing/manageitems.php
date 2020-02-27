<?php include_once(__DIR__."/../header.php"); ?>
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
            <td width="150" style="padding:10px;">Category</td>
            <td style="padding:10px;">Description</td>
            <td width="100" style="padding:10px;">Price</td>
            <td width="120" style="padding:10px;">Posted On</td>
            <td width="50" style="padding:10px;"></td>
        </tr>
<?php 
   
        if (!(CommonController::isLogin())){
        echo CommonController::printError("Login Session Expired. Please Login Again");
        exit;
    }

    $result= JListing::getItem(); 
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
                            <?php echo $r["itemname"];?>  
                        </td>
                        <td style='width:150px;' >
                            <?php echo $r["categoryname"];?>  
                        </td>
                        <td>
                             <?php echo substr(strip_tags($r["itemdesc"]),0,200);?> 
                        </td>
                        <td>
                             <?php echo $r["itemprice"];?> 
                        </td>
                        <td>
                             <?php echo $r["postedon"];?> 
                        </td>
                        
                        <td>
                            <a href="edititem.php?id=<?php echo $r['itemid'];?>">Edit</a>
                            
                        </td>
                    </tr>
                
    
    <?php
        
    
    }

    
?></table>
</div>
</body>