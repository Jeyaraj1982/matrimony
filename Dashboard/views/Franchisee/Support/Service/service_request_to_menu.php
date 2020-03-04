<h4 style="margin-top:0px;background:#fff;padding:20px;padding-left:35px;margin:0px;">Service Request</h4>
<div class="scrollmenu shadow">
  <a href="<?php echo GetUrl("Support/Service/ServiceRequest");?>" class="<?php echo ($page=="ServiceRequest") ? ' linkactive ':'';?>">Service Request</a>
  <a href="<?php echo GetUrl("Support/Service/OpenTickets");?>" class="<?php echo ($page=="OpenTickets") ? ' linkactive ':'';?>">Open Tickets</a>
  <a href="<?php echo GetUrl("Support/Service/InProccessTickets");?>" class="<?php echo ($page=="InProccessTickets") ? ' linkactive ':'';?>">Inproccess Tickets</a>
  <a href="<?php echo GetUrl("Support/Service/ClosedTickets");?>" class="<?php echo ($page=="ClosedTickets") ? ' linkactive ':'';?>">Closed Tickets</a>
 </div>
<style>
 .content-wrapper {padding:0px !important;padding-left:2px !important;}
</style>
<br> 