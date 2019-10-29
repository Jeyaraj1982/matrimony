<?php include_once("header.php");?>
<style>
    .navbar-inverse {

    background-color: transparent;
    border-color: transparent;
         color:#fff;
}
.navbar-inverse .navbar-nav > li > a {

    color: white;

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
                            <div class="page-title-left">
                                <h2>Search</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 container-contentbar">
                        <div class="page-main">
                            <div class="article-detail">
                            <?php $Info = $webservice->getData("Member","GetBasicSearchElements"); ?>
                            
                      
<form method="post" action="" onsubmit="">                                                                 
<div class="col-12 grid-margin">
    <div class="card">
        <div class="card-body">
              <div class="form-group row">
                <div class="col-sm-12">
                    <div class="form-group row">
                       <div class="col-sm-3">Looking For</div>
                                <div class="col-sm-8">
                                     <select class="form-control" style="height:32px !important;;padding-top:6px;" id="LookingFor"  name="LookingFor">
                                            <option value="Bride">Bride</option>
                                            <option value="Groom">Groom</option>
                                            
                                        </select> 
                                </div>
                       </div>
                    <div class="form-group row">
                       <div class="col-sm-3">Age</div>
                                <div class="col-sm-3">
                                    <select name="age" id="age" class="form-control" style="height:32px !important;;padding-top:6px;">
                                             <?php for($i=18;$i<=70;$i++) {?>
                                            <option value="<?php echo $i; ?>"><?php echo $i;?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-sm-2">To</div>
                                <div class="col-sm-3">
                                    <select name="toage" id="toage" class="form-control" style="height:32px !important;;padding-top:6px;">
                                             <?php for($i=18;$i<=70;$i++) {?>
                                            <option value="<?php echo $i; ?>"><?php echo $i;?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                       </div>
                    <div class="form-group row">
                         <div class="col-sm-3">Religion</div>
                                <div class="col-sm-8">
                                     <select class="form-control" style="height:32px !important;;padding-top:6px;" id="Religion"  name="Religion">
                                            <option value="All">All</option>
                                            <?php foreach($Info['data']['Religion'] as $Religion) { ?>
                                            <option value="<?php echo $Religion['SoftCode'];?>" <?php echo ($_POST['Religion']==$Religion['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $Religion['CodeValue'];?></option>
                                            <?php } ?>
                                        </select> 
                                </div>
                    </div>
                    <div class="form-group row">
                         <div class="col-sm-3">Caste</div>
                                <div class="col-sm-8">
                                    <select class="form-control" style="height:32px !important;;padding-top:6px;"  id="Caste"  name="Caste">
                                            <option value="All">All</option>
                                            <?php foreach($Info['data']['Caste'] as $Caste) { ?>
                                            <option value="<?php echo $Caste['SoftCode'];?>" <?php echo ($_POST['Caste']==$Caste['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $Caste['CodeValue'];?></option>
                                            <?php } ?>
                                        </select> 
                         </div> 
                    </div>
                    <div class="form-group row">
                        <a href="SearchResult.php" class="btn btn-primary" name="Search">Search</a>
                    </div>
                    
              </div>
              </div>
         </div>
</div>
</div>
</form>
</div>
               
                            </div>
                        </div> 
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 container-sidebar">
                        <aside id="sidebar">
                            <div class="widget widget-categories">
                                <div class="widget-top">
                                    <h3 class="widget-title">General Search</h3>
                                </div>
                                <div class="widget-body">
                                    <ul class="widget-list">
                                        <li><a href="search_index.php">Best Search</a></li>
                                        <li><a href="search_index.php?type=dGFiLXNyY2gtcHJvZmVzc2lvbmFs">Professional Search</a></li>
                                        <li><a href="search_index.php?type=dGFiLXNyY2gtZWR1Y2F0aW9u">Education Search</a></li>
                                        <li><a href="search_index.php?type=dGFiLXNyY2gtc3Rhcg">Star Search</a></li>
                                        <li><a href="search_index.php?type=dGFiLXNyY2gtc3BsY2FzZXM">Special Cases</a></li>
                                        <li><a href="search_index.php?type=dGFiLXNyY2gtYWR2">Advanced Search</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="widget widget-categories" style="display:none">
                                <div class="widget-top">
                                    <h3 class="widget-title">Astro Search</h3>
                                </div>
                                <div class="widget-body">
                                    <ul class="widget-list">
                                        <li><a href="javascript:;">Generate Horoscope</a></li>
                                        <li><a href="javascript:;">Horoscope Match</a></li>
                                        <li><a href="javascript:;">Horoscope Product</a></li>
                                        <li><a href="javascript:;">Full Horoscope</a></li>
                                        <li><a href="javascript:;">Gem Finder</a></li>
                                        <li><a href="javascript:;">Numerology</a></li>
                                        <li><a href="javascript:;">Super Horoscope</a></li>
                                        <li><a href="javascript:;">Daily Prediction</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="widget widget-categories">
                                <div class="widget-top">
                                    <h3 class="widget-title">Matrimony Service</h3>
                                </div>
                                <div class="widget-body">
                                    <ul class="widget-list">
                                        <li><a href="javascript:;">Wedding Directory</a></li>
                                        <li><a href="javascript:;">Branches</a></li>
                                        <li><a href="javascript:;">Branches Search</a></li>
                                        <li><a href="compare-pricing-plan.php">Payment Option</a></li>
                                        <li><a href="index.php">Member Login</a></li>
                                        <li><a href="index.php">Register Free</a></li>
                                        <li><a href="contact-us.php">Contact Us</a></li>
                                    </ul>
                                </div>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </section>
         
           <?php include_once("footer.php");?>