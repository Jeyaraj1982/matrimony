<?php $mainlink="Search";
$page="BasicSearch";?>
        <?php
 /* if (isset($_POST['continue'])) {

        $response = $webservice->getData("Member","SelectPlanAndContinue",$_POST);
        if ($response['status']=="success") {
            echo "<script>location.href='../ChoosePaymentMode/".$_GET['Code'].".htm'</script>";   
        } else {
            $errormessage = $response['message']; 
        }
    }   */
   $response = $webservice->getData("Member","ViewOrders",array("Code"=>$_GET['Code']));
   $Oreders= $response['data'];
   print_r($response);
?>
            <form method="post" action="" onsubmit="">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Plans</h4>
                                <div style="width:770px;border:1px solid #737373;padding: 10px 20px;">
                                    <div class="from-group row">
                                        <label class="col-sm-2 col-form-label" style="color:#737373;">Order ID&nbsp;:</label>
                                        <div class="col-sm-6"><?php echo $Oreders['OrderNumber'];?></div>
                                        <label class="col-sm-2 col-form-label" style="color:#737373;">Order To&nbsp;:</label>
                                    </div>
                                    <hr style="margin-right: -22px;margin-left: -19px;">
                                </div>
                                
                        </div>

                    </div>
                </div>
            </form>

         