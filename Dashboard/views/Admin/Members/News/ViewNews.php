 <?php
    $News = $mysql->select("select * from _tbl_franchisees_news where NewsID='".$_GET['Code']."'");
?>
<form method="post" action="" onsubmit="">
             <div class="col-12 grid-margin stretch-card">
                  <div class="card">
                       <div class="card-body">
                             <h4 class="card-title">Manage News</h4>
                             <h4 class="card-title">News Information</h4>
                                 <form class="forms-sample">
                                        <div class="form-group row">
                                                <label for="Story Code" class="col-sm-3 col-form-label">News Code</label>
                                            <div class="col-sm-9">
                                                <label style="color:#737373;"><?php echo $News[0]['NewsCode'];?> </label>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                                <label for="Story Title" class="col-sm-3 col-form-label">News Title</label>
                                            <div class="col-sm-9">
                                                <label style="color:#737373;"><?php echo $News[0]['NewsTitle'];?> </label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                                <label for="Story Details" class="col-sm-3 col-form-label">News Details</label>
                                            <div class="col-sm-9">
                                                <label style="color:#737373;"><?php echo $News[0]['NewsDetails'];?> </label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                                <label for="Created On" class="col-sm-3 col-form-label">Published</label>
                                            <div class="col-sm-3">
                                                <label style="color:#737373;">
                                                    <?php if($News[0]['IsActive']==1){
                                                        echo "Published";
                                                        }
                                                        else{
                                                         echo "Unpublished";
                                                         }
                                                ?>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                                <label for="Created On" class="col-sm-3 col-form-label">Status</label>
                                            <div class="col-sm-3">
                                                <label style="color:#737373;">
                                                <?php if($News[0]['IsActive']==1){
                                                        echo "Active";
                                                        }
                                                        else{
                                                         echo "Deactive";
                                                         }
                                                ?>
                                                </label>
                                        </div>
                                        </div>
                                        <div class="form-group row">
                                                <label for="Created On" class="col-sm-3 col-form-label">Created On</label>
                                            <div class="col-sm-9">
                                                <label style="color:#737373;"><?php echo putDateTime($News[0]['CreatedOn']);?> </label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                                <label for="Created On" class="col-sm-3 col-form-label">Published On</label>
                                            <div class="col-sm-9">
                                                <label style="color:#737373;"><?php //echo $News[0]['CreatedOn'];?> </label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                                <label for="Created On" class="col-sm-3 col-form-label">Unpublished On</label>
                                            <div class="col-sm-9">
                                                <label style="color:#737373;"><?php //echo $News[0]['CreatedOn'];?> </label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                                <label for="ViewMember" class="col-sm-3 col-form-label">View</label>
                                            <div class="col-sm-9">
                                                <label style="color:#737373;"></label>
                                            </div>
                                        </div>
                                 </form>
                       </div>
                  </div>
             </div>
<div class="col-sm-12 grid-margin" style="text-align: center; padding-top:5px;color:skyblue;">
                        <a href="../NewsandEvents "><small style="font-weight:bold;text-decoration:underline">List of News</small></a>&nbsp;|&nbsp;
                        <a href="<?php echo GetUrl("Members/News/EditNews/".$_GET['Code'].".htm");?>"><small style="font-weight:bold;text-decoration:underline">Edit News</small></a>&nbsp;|&nbsp;
                        <a href="<?php //echo GetUrl("Members/News/EditNews/".$_GET['Code'].".htm");?>"><small style="font-weight:bold;text-decoration:underline">List of Viewed Members</small></a>
</div>
                                 
</form>
