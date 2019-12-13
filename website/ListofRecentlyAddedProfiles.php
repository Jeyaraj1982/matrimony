<?php
 $layout=0;
 include_once("includes/header.php");?>
    <style>
        .navbar-inverse {
            background-color: transparent;
            border-color: transparent;
            color: #fff;
        }
        
        .navbar-inverse .navbar-nav > li > a {
            color: white;
        }
    </style>
    <style>
        .img-border {
            background: none repeat scroll 0 0 #FFFFFF;
            border: 1px solid #E7E7E7;
            display: inline-block;
            float: left;
            margin: 4px 0 18px 1px;
            padding: 5px;
        }
        
        .img-border img {
            float: none !important;
            margin: 0 0 0 !important;
            width: 100% !important;
        }
        
        .hidden-lg {
            display: none !important;
        }
        
        .fright {
            float: right;
        }
         #profilebox{
            margin-bottom:25px;border:1px solid #f0f0f0;padding:10px;
        }
        #profilebox:hover{
            border: 1px solid green;
        }
		.errorstring{
	color:red;
}
    </style>
    
    <br><br><br>
    <section class="page-container" style="margin-top: -19px">
        <div class="container">
                
                <table>
                    <tr>
                        <td style="width: 694px;"><h2>Recently Added Profiles</h2></td>
                    </tr>
                </table> <br><br>
            <div class="row">     
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 container-contentbar">
                    <div class="page-main">     
                        <div class="article-detail">
                            <?php
                            include_once(application_config_path);
                            $response = $webservice->getData("Member","GetAllRecentlyAdded",array("ProfileFrom"=>"ListPage"));
								if (sizeof($response['data'])>0) {							 
								foreach($response['data'] as $p) { 
									$Profile=$p['ProfileInfo']                   
							?> 
			<div id="profilebox">

                                    <div class="row">
                                        <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">                                      
                                            <div class="img-border">
                                                <a target="_blank" href="#">
                                                    <img style="width:160px;height:160px;" src="<?php echo $p['ProfileThumb'];?>" alt="">
                                                </a>
                                            </div>

                                            <table class="table field_table hidden-sm hidden-xs" style="margin-bottom:0;">
                                                <tbody>
                                                    <tr>
                                                        <th>Last Login</th>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <?php echo date("Y-m-d H:i:s");?>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                                            <div class="row hidden-xs">
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                    <a style="float:left;" href="#">
                                                        <h3 style="margin-top:0px;color:#d60ccc;"><?php echo $Profile['ProfileName'];?> <span style="font-size:15px;color:#d60ccc;">[ <?php echo $Profile['ProfileCode']?> ]</span></h3>
                                                    </a>
                                                </div>
                                            </div>

                                            <table class="table field_table" style="margin-bottom:10px;">
                                                <tbody>                                                          
                                                    <tr>                                                          
                                                        <th>Gender &amp; Age </th>
                                                        <td>                                                
                                                            <?php echo $Profile['Sex']?>, ( <?php echo $Profile['Age'];?> Years )
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Religion - Caste or Division</th>
                                                        <td>
                                                            <?php echo $Profile['Religion'];?> - <?php echo $Profile['Caste'];?> </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Marital Status</th>
                                                        <td> <?php echo $Profile['MaritalStatus'];?></td>
                                                    </tr>
													<tr>
                                                        <th>Education - Occupation - Annual Income</th>
                                                        <td>
                                                            <?php echo $p['MainEducation'];?> - <?php echo $Profile['OccupationType'];?> - <?php echo $Profile['AnnualIncome'];?></td>
                                                    </tr>
													<?php if (isset($_POST['AdvanceSearch'])) { ?>
													<tr>
                                                        <th>Family Type</th>
                                                        <td> <?php echo $Profile['FamilyType'];?></td>
                                                    </tr>
													<tr>
                                                        <th>Diet - Drink - Smoke</th>
                                                        <td><?php echo $Profile['Diet'];?> -  <?php echo $Profile['DrinkingHabit'];?> - <?php echo $Profile['SmokingHabit'];?></td>
                                                    </tr>
													<tr>
                                                        <th>Body Type &amp; Skin Type</th>
                                                        <td> <?php echo $Profile['BodyType'];?> &amp; <?php echo $Profile['Complexation'];?></td>
                                                    </tr>
													<?php } ?>
                                                    <tr>
                                                        <th>Country - State - City</th> 
                                                        <td>
                                                            <?php echo $Profile['Country'];?> - <?php echo $Profile['State'];?> - <?php echo $Profile['City'];?> </td>
                                                    </tr>
                                                    <!--<tr class="hidden-md hidden-lg">
                                                        <th>Last Login</th>
                                                        <td>
                                                            <?php echo $Profile['LastSeen'];?>
                                                        </td>
                                                    </tr>-->
                                                </tbody>
                                            </table>
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 hidden-xs hidden-sm" style="text-align: right;">
                                                <a class="btn btn-warning btn-sm" href="Profile.php?Code=<?php echo $Profile['ProfileCode']?>">View Profile</a>
                                        </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
<?php } 
		if (sizeof($response['data'])>10) {	?>
		<div style="text-align:center">
			<a href="<?php echo JFrame::getAppSetting('siteurl')."/login";?>" class="btn btn-primary" style="margin-top: 12px;padding-top: 2px;padding-bottom: 7px;">View More</a>
		</div>
		<br><br>
		<?php } else { } ?>
 <?php } else{?>
							<div id="profilebox" style="text-align:center;border:none">
							<img src="website/assets/images/notfound.png" style="height:128px"><br>
								No Profiles found 
							</div>
								<?php } ?>
                        </div>

                    </div>
                </div>
              
            </div>
        </div>                                                    
    </section>

    <?php include_once("includes/footer.php");?>