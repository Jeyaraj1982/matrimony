<?php include_once("topmenu.php");?>
<div class="col-12 grid-margin" style="padding:0px !important">
    <div class="card" style="padding:15px;">
       
        All  | Age | Religion | Income | Education | Occupation 
        <div class="card-body" style="padding:80px;text-align:center;color:#aaa">
            <img src="<?php echo ImageUrl;?>noprofile.svg" style="height:128px"><Br>
            No profiles found in your account<br><Br><br><Br><br><Br>
            <span style="color:#555">You must be create an profile and activate.</span><br>  
            <a style="font-weight:Bold;font-family:'Roboto';" href="<?php echo GetUrl("MyProfiles/ManageProfile");?>">Create Profile</a>
            <br>
        </div>
    </div>
</div>
             