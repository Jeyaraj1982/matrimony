<?php include_once("header.php");?>
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
    </style>
    <nav class="navbar dashboard-menu">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-md-9">
                    <div class="navbar-header">
                        <button data-toggle="collapse-side" data-target=".side-collapse" data-target-2=".side-collapse-container" type="button" class="navbar-toggle">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar top-bar"></span>
                            <span class="icon-bar middle-bar"></span>
                            <span class="icon-bar bottom-bar"></span>
                        </button>
                    </div>
                    <div class="navbar-inverse side-collapse in">
                        <div role="navigation" class="navbar-collapse" id="scroll-submenu1" style="height: auto;">
                            <ul class="nav navbar-nav">
                                <li class="dropdown">
                                    <a class="hidden-xs visible-sm visible-md visible-lg disabled dropdown-toggle" data-toggle="dropdown" href="my_matrimony.php">My Home</a>
                                    <a class="visible-xs hidden-sm hidden-md hidden-lg dropdown-toggle" data-toggle="dropdown" href="javascript:;"><span class="am-mmenu-icon"><img src="images/kv-mmenu-icon-home.png"></span> My Home <span class="fa fa-angle-down"></span></a>
                                </li>
                                <li class="dropdown">
                                    <a class="hidden-xs visible-sm disabled visible-md visible-lg dropdown-toggle " data-toggle="dropdown" href="recommended_matches.php">Matches</a>
                                    <a class="visible-xs hidden-sm hidden-md hidden-lg dropdown-toggle " data-toggle="dropdown" href="javascript:;"><span class="am-mmenu-icon"><img src="images/kv-mmenu-icon-matches2.png"></span> Matches <span class="fa fa-angle-down"></span></a>
                                </li>

                                <li class="dropdown">
                                    <a class="disabled hidden-xs visible-sm visible-md visible-lg dropdown-toggle" data-toggle="dropdown" href="search.php">Search</a>
                                    <a class="visible-xs hidden-sm hidden-md hidden-lg dropdown-toggle" data-toggle="dropdown" href="javascript:;"><span class="am-mmenu-icon"><img src="images/kv-mmenu-icon-search.png"></span> Search <span class="fa fa-angle-down"></span></a>
                                </li>
                                <li class="dropdown">
                                    <a class="disabled hidden-xs visible-sm visible-md visible-lg dropdown-toggle" data-toggle="dropdown" href="interest_recieved.php">Messages</a>
                                    <a class="visible-xs hidden-sm hidden-md hidden-lg dropdown-toggle" data-toggle="dropdown" href="interest_recieved.php"><span class="am-mmenu-icon"><img src="images/kv-mmenu-icon-messages.png"></span> Messages <span class="fa fa-angle-down"></span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <ul class="nav navbar-nav navbar-right user-profile">
                    <li class="dropdown">

                        <a class="dropdown-toggle disabled up-btn-upgrade hidden-xs visible-sm visible-md visible-lg" data-toggle="dropdown" href="upgrade_membership.php">Upgrade</a>
                    </li>
                    <li class="dropdown hidden-xs">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="help.php">Help</a>
                    </li>
                    <li class="dropdown drpprofile">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)">

                            <img class="img-circle" src="">
                            <span class="fa fa-angle-down"></span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="page-container" style="margin-top: -19px">
        <div class="container">
            <div class="page-title breadcrumb-top">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="col-sm-6" style="text-align: left;">
                            <div class="page-title">
                                <h2>Search Result</h2>
                            </div>
                        </div>
                        <div class="col-sm-6" style="text-align:right">
                            <div class="page-title">
                                <h2><a href="search.php" class="btn btn-primary">Modify Search</a></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 container-contentbar">
                    <div class="page-main">
                        <div class="article-detail">
                            <?php  $response = $webservice->getData("Member","GetSearchResultProfiles");
 foreach($response['data'] as $p){ 
 $Profile=$p['ProfileInfo']                  
            ?>
                                <div style="margin-bottom:25px;border:1px solid green;padding:10px;">

                                    <div class="row">
                                        <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">                                      
                                            <div class="img-border">
                                                <div class="label label-warning pull-right">SPECIAL Member</div>
                                                <br>
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
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 hidden-xs hidden-sm">
                                                <a class="btn btn-warning btn-sm" href="Profile.php?Code=<?php echo $Profile['ProfileCode']?>">View Profile</a>
                                                <!--  <a class="btn btn-success btn-sm" href="#">Send Message</a>
                    <a class="btn btn-danger btn-sm" href="#">Photo Request</a>
                    <a class="btn btn-success btn-sm" href="#">Express Interest</a>-->
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <?php }?>
                        </div>

                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 container-sidebar">
                    <div class="page-main">
                        <div class="article-detail" style="padding:0px">
                                <?php  $response = $webservice->getData("Member","GetSearchResultProfiles");
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
                                <?php }?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include_once("footer.php");?>