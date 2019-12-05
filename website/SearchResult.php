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
                        <td style="width: 694px;"><h2>Search Result</h2></td>
                        <td><h2><a href="search.php" class="btn btn-primary">Modify Search</a></h2></td>
                    </tr>
                </table> <br><br>
            <div class="row">     
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 container-contentbar">
                    <div class="page-main">     
                        <div class="article-detail">
                            <?php
                            include_once(application_config_path);
                            
							if (isset($_POST['BasicSearch'])) {
								$_POST['Religion']=implode(",",$_POST['Religion']);
								$_POST['Caste']=implode(",",$_POST['Caste']);
                              $response = $webservice->getData("Member","GetSearchResultProfiles",$_POST);
							}
							if (isset($_POST['AdvanceSearch'])) {
								$_POST['Religion']=implode(",",$_POST['Religion']);
								$_POST['Caste']=implode(",",$_POST['Caste']);
								$_POST['MaritalStatus']=implode(",",$_POST['MaritalStatus']);
								$_POST['IncomeRange']=implode(",",$_POST['IncomeRange']);
								$_POST['Occupation']=implode(",",$_POST['Occupation']);
								$_POST['FamilyType']=implode(",",$_POST['FamilyType']);
								$_POST['WorkingPlace']=implode(",",$_POST['WorkingPlace']);
								$_POST['Diet']=implode(",",$_POST['Diet']);
								$_POST['Smoke']=implode(",",$_POST['Smoke']);
								$_POST['Drink']=implode(",",$_POST['Drink']);
								$_POST['BodyType']=implode(",",$_POST['BodyType']);
								$_POST['Complexion']=implode(",",$_POST['Complexion']);
                              $response = $webservice->getData("Member","GetAdvanceSearchResultProfiles",$_POST);
							}
							if(isset($_POST['SearchByID'])){
							  $response = $webservice->getData("Member","SearchByProfileIDResult",$_POST);
							}
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
                                                        <th>Education &amp; Annual Income</th>
                                                        <td>
                                                            <?php echo $p['EducationDegree'];?> &amp;<?php echo $Profile['AnnualIncome'];?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Country - State - City</th>
                                                        <td>
                                                            <?php echo $Profile['Country'];?> - <?php echo $Profile['State'];?> - <?php echo $Profile['City'];?> </td>
                                                    </tr>
                                                    <tr class="hidden-md hidden-lg">
                                                        <th>Last Login</th>
                                                        <td>
                                                            <?php echo $Profile['LastSeen'];?>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 hidden-xs hidden-sm" style="text-align: right;">
                                                <a class="btn btn-warning btn-sm" href="Profile.php?Code=<?php echo $Profile['ProfileCode']?>">View Profile</a>
                                                <!--  <a class="btn btn-success btn-sm" href="#">Send Message</a>
                    <a class="btn btn-danger btn-sm" href="#">Photo Request</a>
                    <a class="btn btn-success btn-sm" href="#">Express Interest</a>-->
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
<?php } } else{?>
							<div id="profilebox" style="text-align:center;border:none">
							<img src="website/assets/images/notfound.png" style="height:128px"><br>
								No Profiles found 
							</div>
								<?php } ?>
                        </div>

                    </div>
                </div>
               <!-- <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 container-sidebar">
                    <div class="page-main">
                        <div class="article-detail" style="padding:0px">
                                <?php /* 
include_once(application_config_path);
 $response = $webservice->getData("Member","GetSearchResultProfiles");
 foreach($response['data'] as $p){ 
 $Profile=$p['ProfileInfo']                  
            ?>
                                <div style="border-left:2px solid #f0f0f0;border-right:2px solid #f0f0f0;padding:10px;min-height:100px">
                                    <div class="col-sm-2" style="margin-right:40px;margin-left:-15px">
                                        <img src="<?php echo $p['ProfileThumb'];?>" style="border-radius: 50%;width: 64px;border: 1px solid #ddd !important;height: 64px;padding: 5px;background: #fff;">
                                    </div>
                                    <div class="col-sm-9" style="margin-right:-40px;">
                                        <span style="font-size:15px;color:#d60ccc;"><?php echo $Profile['ProfileCode']?></span>
                                        <br><?php echo $Profile['Age'];?> Years <br><?php echo $Profile['Height'];?>  
                                        <br> <?php echo $Profile['City'];?>
                                    </div>
                                    <div class="col-sm-1" style="margin-right:-40px;">
                                        <button type="button" class="close" style="margin-right: -9px;">&times;</button>
                                    </div>
                                </div>                                      
                                <?php } */?>
                        </div>

                    </div>
                </div>-->
            </div>
        </div>                                                    
    </section>

    <?php include_once("includes/footer.php");?>