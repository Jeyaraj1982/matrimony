<?php $mainlink="Search";
$page="BasicSearch";?>
        <?php
  if (isset($_POST['Continue'])) {
      $response = $webservice->getData("Member","ViewOrders",array("Code"=>$_GET['Code']));
   $Oreders= $response['data']['Order'];
       
            echo "<script>location.href='../ChoosePaymentMode/".$Oreders['OrderNumber'].".htm'</script>";   
    }  
   $response = $webservice->getData("Member","ViewOrders",array("Code"=>$_GET['Code']));
   $Oreders= $response['data']['Order'];
   $Member= $response['data']['Member'];
   $Plans= $response['data']['Plan'];  
?>
            
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Plans</h4>
                                <div style="width:770px;border:1px solid #737373;padding: 10px 20px;">
                                    <div class="from-group row" style="margin-bottom: -10px;">
                                        <label class="col-sm-6 col-form-label" style="color:#737373;">Order To&nbsp;</label>
                                        <label class="col-sm-6 col-form-label" style="color:#737373;text-align: right">Order From&nbsp;</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-6 col-form-label" style="color:#737373;">
                                            <?php echo $Member['MemberName'];?><br><br>
                                            <?php echo $Member['EmailID'];?><br><br>
                                            <?php echo $Member['MobileNumber'];?>
                                        </label>
                                        <label class="col-sm-6 col-form-label" style="color:#737373;text-align: right">
                                            <?php echo $Oreders['OrderNumber'];?><br>
                                        </label>
                                    </div>
                                    <hr style="margin-right: -22px;margin-left: -19px;">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <td>Sl No</td>
                                                <td>Particulars</td>
                                                <td>Qty</td>
                                                <td>Amount</td>
                                            </tr>
                                        </thead>
                                         <tbody>
                                         <?php foreach($Plans as $Plan) {?>
                                            <tr>
                                                <td>1</td>
                                                <td><?php echo $Plan['PlanName'];?></td>
                                                <td>1</td>
                                                <td style="text-align: right"><?php echo number_format($Plan['Amount'],2);?></td>
                                            </tr>
                                         <?php } ?>
                                         <tr>
                                            <td colspan="3"></td>
                                            <td style="text-align:right">Total&nbsp;:&nbsp;&nbsp;<?php echo number_format($Plans[0]['Amount'],2);?></td>
                                         </tr>
                                         </tbody>
                                    </table>
                                    <div class="form-group row">
                                        <div class="col-sm-12" style="text-align: right;">
                                            <form method="post" action="" onsubmit="">
                                                <input type="hidden" name="OrderNumber" value="<?php echo $Oreders['OrderNumber'];?>">
                                                <button type="submit" name="Continue" class="btn btn-primary" style="font-family: roboto;">Continue to pay</button> 
                                            </form>                                           
                                        </div>
                                    </div>
                                </div>
                                
                        </div>

                    </div>
                </div>

         