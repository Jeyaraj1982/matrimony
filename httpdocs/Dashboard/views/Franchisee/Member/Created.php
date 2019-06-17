<form method="post" action="">
    <div class="col-12 stretch-card">
        <div class="card">
            <div class="card-body">
            <p style="text-align:center"><img src="<?php echo SiteUrl?>assets/images/verifiedtickicon.jpg"><br>
            Created Successfully</p>
            <p style="text-align:center"><a href="<?php echo GetUrl("Member/EditMember/". $Member['MemberID'].".html");?>">Do you want edit your profile</a></p>
            </div>
        </div>
    </div>
</form>