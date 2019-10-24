<?php include_once("PaymentModeHeader.php");?>
<?php 
print_r($_POST);
  $response = $webservice->getData("Member","ConfirmOrderandPayAmountThroughtWallet",$_POST);
  print_R($response);
                    if ($response['status']=="success") {
                      echo $successmessage = $response['message']; 
                    } else {
                        $errormessage = $response['message']; 
                    }

 ?>
  <?php print_r($_GET);?>
<form method="post" action="">
    <div class="col-sm-9" style="margin-top: -8px;" >
        <p style="text-align:center"><img src="<?php echo SiteUrl?>assets/images/verifiedtickicon.jpg"><br>
            Ordered Proccess Successfully<br>
    </div>

<?php include_once("PaymentModeFooter.php");?>                    