<?php 
    $page="ServiceRequest";
    include_once("service_request_to_menu.php");
	//$response    = $webservice->getData("Member","GetSupportTeamDetails");
	
?>
<script>
function CreateSupportticket()  {
            
            $('#ErrSubject').html("");
            $('#ErrDescription').html("");
             ErrorCount=0; 
             IsNonEmpty("Subject","ErrSubject","Please Enter Subject");
             IsNonEmpty("Description","ErrDescription","Please Enter Description");
                      
            return (ErrorCount==0) ? true : false;
         
       
}
</script>
<?php if (isset($_POST['SubmitRequest'])) {
        
        $target_dir = "uploads/";
        if (!is_dir('uploads/ServiceRequest/'.$_GET['Code'].'/Ticket')) {
            mkdir('uploads/ServiceRequest/'.$_GET['Code'].'/Ticket', 0777, true);
        }
        
        $err=0;
        $_POST['File']= "";
        $acceptable = array('image/jpeg','image/jpg','image/png');
        if(($_FILES['File']['size'] >= 5000000)) {
            $err++;
            echo "File must be less than 5 megabytes.";
        }
        
        if((!in_array($_FILES['File']['type'], $acceptable)) && (!empty($_FILES["File"]["type"]))) {
            $err++;
            echo "Invalid file type. Only JPG,PNG,JPEG types are accepted.";
        }
        $Tickets ="";
        if (isset($_FILES["File"]["name"]) && strlen(trim($_FILES["File"]["name"]))>0 ) {
            $Tickets = time().$_FILES["File"]["name"];  
            if (!(move_uploaded_file($_FILES["File"]["tmp_name"], 'uploads/ServiceRequest/'.$_GET['Code'].'/Ticket/'. $Tickets))) {
                $err++;
                  $Tickets ="";
                echo "Sorry, there was an error uploading your file.";
            } 
        }
        
        if ($err==0) {
            $_POST['File']= $Tickets;
            $res =$webservice->getData("Franchisee","AddNewSupportTicket",$_POST);
            if ($res['status']=="success") {                
               echo $successmessage = $res['message'];   
            } else {
                $errormessage = $res['message']; 
            }
        } 
    }
    ?>
<div class="col-lg-12 grid-margin stretch-card">
	<div class="card">
		<div class="card-body">
			<h4 class="card-title">Create Support ticket</h4>
			<form method="post" action="" enctype="multipart/form-data" onsubmit="return CreateSupportticket();">
			<div class="form-group row">
				<div class="col-sm-2">Team</div>
				<div class="col-sm-6">
					<select id="Team" class="form-control" name="Team" style="border: 1px solid #ccc;padding: 3px;padding-left: 3px;padding-left: 10px;">
                    <?php// foreach($response['data']['Team'] as $Team) { ?>
						 <!--<option value="<?php echo $Team['SoftCode'];?>" <?php echo ($_POST['Team']==$Team['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $Team['CodeValue'];?></option>-->
					<?php //} ?>
					<option value="SalesTeam">Sales Team</option>
					<option value="BillingTeam">Billing Team</option>
					<option value="SupportTeam">Support Team</option>
					<option value="AdminTeam">Admin Team</option>
					<option value="WebMasterTeam">Web Master Team</option>
                </select>
                <span class="errorstring" id="ErrTeam"><?php echo isset($ErrTeam)? $ErrTeam : "";?></span>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-sm-2">Subject</div>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="Subject" name="Subject"  value="<?php echo (isset($_POST['Subject']) ? $_POST['Subject'] : "");?>" placeholder="Subject">
					<span class="errorstring" id="ErrSubject"><?php echo isset($ErrSubject)? $ErrSubject : "";?></span>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-sm-2">Description</div>
				<div class="col-sm-6">
					<textarea class="form-control" id="Description" name="Description"><?php echo (isset($_POST['Description']) ? $_POST['Description'] : "");?></textarea>
					<span class="errorstring" id="ErrDescription"><?php echo isset($ErrDescription)? $ErrDescription : "";?></span>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-sm-2">Attachment</div>
				<div class="col-sm-6"><input type="file" name="File" id="File"></div>
			</div>
			<div class="form-group row">
				<div class="col-sm-3"><button type="submit" name="SubmitRequest" id="SubmitRequest" class="btn btn-primary" style="font-family:roboto">Continue</button></div>
			</div>
			</form>
		</div>
	</div>
</div>
		