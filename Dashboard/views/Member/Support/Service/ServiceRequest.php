<?php 
    $page="ServiceRequest";
    include_once("service_request_to_menu.php");
    $res = $webservice->getData("Member","GetRequestFor");
                if (isset($_POST['SubmitRequest'])) {       
                  if($_POST['ServiceRequest']=="SRF0003"){  ?>
                    <?php    echo "<script>location.href='".AppUrl."Support/Service/DeleteRequest/".$_POST['ServiceRequest'].".htm'</script>";
                      }
                      if($_POST['ServiceRequest']=="SRF0002"){
                        echo "<script>location.href='".AppUrl."Support/Service/DeactiveRequest/".$_POST['ServiceRequest'].".htm'</script>";
                      }
                      if($_POST['ServiceRequest']<>"SRF0002" && $_POST['ServiceRequest']<>"SRF0003"){
                        echo "<script>location.href='".AppUrl."Support/Service/CreateNewSupportTicket/".$res['data']['Member'][0]['MemberCode'].".htm'</script>";
                      }
                } 
?>                                                      
<div class="col-lg-12 grid-margin stretch-card">
	<div class="card">                                                                                      
		<div class="card-body">
			<h4 class="card-title">Service Request</h4>
			<form method="post" action="">
			<div class="form-group row">
				<div class="col-sm-4" style="margin-right: -23px;">
					<div class="custom-control custom-radio">
						<input type="radio" class="custom-control-input" id="CreateNewSupportTicket" name="ServiceRequest">
						<label class="custom-control-label" for="CreateNewSupportTicket">Create new support ticket</label>
					</div>
				</div>
			</div>
            <?php foreach($res['data']['RequestFor'] as $RequestFor) { if($RequestFor['SoftCode']=="SRF0002" || $RequestFor['SoftCode']=="SRF0003"){?>
				<div class="form-group row" >
					<div class="col-sm-4" style="margin-right: -23px;">
						<div class="custom-control custom-radio">
							<input type="radio" class="custom-control-input" id="ServiceReq_<?php echo $RequestFor['SoftCode'];?>" name="ServiceRequest" value="<?php echo $RequestFor['SoftCode'];?>">
							<label class="custom-control-label" for="ServiceReq_<?php echo $RequestFor['SoftCode'];?>"><?php echo $RequestFor['CodeValue'];?></label>
						</div>
					</div>                                                                      
				</div>
            <?php } }?>
				<div class="form-group row">
					<div class="col-sm-3"><button type="submit" name="SubmitRequest" id="SubmitRequest" class="btn btn-primary" style="font-family:roboto">Continue</button></div>
				</div>
			</form>
		</div>
	</div>
</div>
