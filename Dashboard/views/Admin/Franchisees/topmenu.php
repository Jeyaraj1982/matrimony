<h4 style="margin-top:0px;background:#fff;padding:20px;padding-left:35px;margin:0px;">Franchisees</h4>
<div class="scrollmenu shadow">
  <a href="<?php echo GetUrl("Franchisees/View/". $_GET['Code'].".html");?>" class="<?php echo ($page=="PrimaryDetails") ? ' linkactive ':'';?>">Primary Details</a>
  <?php if($page =="FranchiseeStaffs") {?>
  <a href="<?php echo GetUrl("Franchisees/FranchiseeStaffs/". $_GET['Code'].".html");?>" class="<?php echo ($page=="FranchiseeStaffs") ? ' linkactive ':'';?>">Staffs</a>
  <?php } ?>
</div>
<style>
 .content-wrapper {padding:0px !important;padding-left:2px !important;}
</style>
<br> 