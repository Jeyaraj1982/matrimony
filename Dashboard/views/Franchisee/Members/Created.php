<form method="post" action="">
    <div class="col-12 stretch-card">
        <div class="card">
            <div class="card-body">
            <p style="text-align:center"><img src="<?php echo SiteUrl?>assets/images/verifiedtickicon.jpg"><br>
            Created Successfully<br>
            MemberID:<?php echo $_GET['Code'];?>
            </p>
            
            <p style="text-align:center">Do you want create profile?<a href="<?php echo GetUrl("CreateProfile/".$_GET['Code'].".htm");?>">Create Profile</a><br>
                
            </p>
            </div>
        </div>
    </div>
</form>