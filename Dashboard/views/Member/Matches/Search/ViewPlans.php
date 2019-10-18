<?php $mainlink="Search";
$page="BasicSearch";?>
        <?php
  if (isset($_POST['continue'])) {

        $response = $webservice->getData("Member","SelectPlanAndContinue",$_POST);
        if ($response['status']=="success") {
            echo "<script>location.href='../ViewOrders/".$_GET['Code'].".htm'</script>";   
        } else {
            $errormessage = $response['message']; 
        }
    }
    $response = $webservice->getData("Member","BasicSearchViewMemberPlan",array()); 
    if (sizeof($response['data'])>0) {
?>
            <form method="post" action="" onsubmit="">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Plans</h4>
                            <?php echo $errormessage;?>
                                <?php echo $successmessage;?>
                                    <div class="table-responsive">
                                        <table id="myTable" class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <td>Plan</td>
                                                    <td>Duration</td>
                                                    <td>Amount</td>
                                                    <td>No of Profiles</td>
                                                    <td></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php  foreach($response['data'] as $plans) { ?>
                                                    <tr>
                                                        <td><?php echo $plans['PlanName']?></td>
                                                        <td><?php echo $plans['Decreation']?></td>
                                                        <td><?php echo $plans['Amount']?></td>
                                                        <td><?php echo $plans['FreeProfiles'];?></td>
                                                        <td>
                                                            <button type="Submit" name="continue" class="btn btn-primary">Continue</button>
                                                        </td>
                                                    </tr>
                                                    <?php  } ?>
                                            </tbody>
                                        </table>
                                    </div>

                        </div>

                    </div>
                </div>
            </form>

            <?php } ?>

                <script>
                    $(document).ready(function() {
                        $('#myTable').dataTable();
                        setTimeout("DataTableStyleUpdate()", 500);
                    });
                </script>