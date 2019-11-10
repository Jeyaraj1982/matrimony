<?php
    $page="MyOrders";
    $response = $webservice->getData("Member","GetOrderInvoiceReceiptDetails",array("Request"=>"Order"));
?>
<?php include_once("accounts_header.php");?>
<form method="post" action="">
    <div class="col-sm-9" style="margin-top: -8px;">
        <h4 class="card-title">My Orders</h4>
        <?php if (sizeof($response['data'])>0) {   ?>
        <div class="table-responsive" style="width: 120%;">
        <table id="myTable" class="table table-striped" style="width:100%;border-bottom:1px solid #ccc;">
            <thead>  
                <tr>
                    <th>Order Number</th> 
                    <th>Order Date</th> 
                    <th style="text-align:right">Order Value</th> 
                    <th>Invoice Number</th> 
                    <th></th> 
                </tr>  
            </thead>
            <tbody>  
            <?php foreach($response['data'] as $Orders) {
            ?>
                <tr>
                    <td><?php echo $Orders['OrderNumber'];?></td>
                    <td><?php echo PutDateTime($Orders['OrderDate']);?></td>
                    <td style="text-align:right"><?php echo number_format($Orders['OrderValue'],2);?></td>
                    <td>
                        <?php if($Orders['IsPaid']==1){ 
                             echo $Orders['InvoiceNumber'];
                        } else{ ?>
                       <?php if($Orders['IsPaid']==0 && $Orders['IsCancelled']==0) { ?>
                         <a href="<?php echo SiteUrl;?>ChoosePaymentMode/<?php echo $Orders['OrderNumber'];?>.htm"><button type="button" name="Paynow" class="btn btn-primary" style="font-family: roboto;padding-top: 1px;padding-bottom: 1px;">Pay Now</button></a>&nbsp;&nbsp; 
                       <?php } ?>
                           <a href="javascript:void(0)" onclick="showConfirmDelete('<?php  echo $Orders['OrderNumber'];?>')" name="Cancel" class="btn btn-danger" style="font-family: roboto;padding-top: 1px;padding-bottom: 1px;">Cancel</a> 
                      <?php }  ?>
                        
                    </td>
                    <td><a href="<?php echo GetUrl("MyAccounts/ViewOrders/". $Orders['OrderNumber'].".htm");?>">View</a></td>
                </tr>
            <?php } ?>            
            </tbody>                        
        </table>
    </div>
    <?php } else {?>
        <div style="padding:40px;padding-bottom:100px;text-align:center;color:#aaa">
            <img src="<?php echo ImageUrl;?>receipt.svg" style="height:128px"><Br><Br>
            No orders found at this time<br><br>
        </div>
    <?php } ?>
    </div>
</form>      
<div class="modal" id="Cancel" role="dialog" data-backdrop="static" style="padding-top:177px;padding-right:0px;background:rgba(9, 9, 9, 0.13) none repeat scroll 0% 0%;">
            <div class="modal-dialog" style="width: 367px;">
                <div class="modal-content" id="model_body" style="height: 220px;">
            
                </div>
            </div>
        </div>
        
 <script>
 function showConfirmDelete(OrderNumber) {                                           
        $('#Cancel').modal('show'); 
        var content = '<div class="modal-body" style="padding:20px">'
                        + '<div  style="height: 315px;">'
                            + '<form method="post" id="form_'+OrderNumber+'" name="form_'+OrderNumber+'" > '
                                + '<input type="hidden" value="'+OrderNumber+'" name="OrderNumber">'
                                  + '<button type="button" class="close" data-dismiss="modal">&times;</button>'
                                   + '<h4 class="modal-title">Confirm Cancel</h4><br>'
                                + '<div style="text-align:center">Are you sure want to cancel the order?  <br><br>'
                                    + '<button type="button" class="btn btn-primary" name="Delete"  onclick="ConfirmDelete(\''+OrderNumber+'\')">Yes</button>&nbsp;&nbsp;'
                                    + '<button type="button" data-dismiss="modal" class="btn btn-primary">No</button>'
                                + '</div>'
                            + '</form>'
                        + '</div>'
                     +  '</div>';
        $('#model_body').html(content);
    }
 
function ConfirmDelete(OrderNumber) {
        var param = $("#form_"+OrderNumber).serialize();
        $('#model_body').html(preloader);
        $.post(API_URL + "m=Member&a=CancelOrder", param, function(result2) {                                             
            $('#model_body').html(result2);                                     
          //  $('#Documentview_'+AttachmentID).hide();
        }
    );
}
 </script>          
<?php include_once("accounts_footer.php");?>                    

