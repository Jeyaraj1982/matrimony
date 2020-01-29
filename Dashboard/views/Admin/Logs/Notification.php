<?php $page="NotificationsandActionsLog";?>
<?php include_once("settings_header.php");?>
<div class="col-sm-10 rightwidget">   
<form method="post" action="#" onsubmit="">
<div class="card-body">
<h4 class="card-title" style="margin-bottom: 0px;margin-top: 0px;">Notification</h4>

</div>
</form>
<?php include_once("settings_footer.php");?>                    
 <script>
$(document).ready(function(){
    $('#myTable').dataTable();
    setTimeout("DataTableStyleUpdate()",500);
});
</script>