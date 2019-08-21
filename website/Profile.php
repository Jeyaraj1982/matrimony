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
 <style>
 .table-bordered > tbody > tr > td{
     width: 75px;
height: 75px;
text-align:center;
 }
 #doctable > tbody > tr > td{
 width: 75px;
height: 33px;
text-align: left;
 }
 #doctable {
    border-top: 2px solid #ddd;
}
  .form-group {
    margin-bottom: 0px;
}
.photoview {
    float: right;
    margin-right: 10px;
    margin-bottom: 10px;
}
.Documentview {
    float: left;
    margin-right: 10px;
    text-align: center;
    border: 1px solid #eaeaea;
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 10px;
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
                                        <a class="disabled hidden-xs visible-sm visible-md visible-lg dropdown-toggle" data-toggle="dropdown" href="search_index.php">Search</a>
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
                                <h2>About Best Matrimony</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 container-contentbar">
                        <div class="page-main">
                            <div class="article-detail">
                                <?php
    $response = $webservice->GetFullProfileInformation(array("ProfileCode"=>$_GET['Code']));
//    echo $_GET['Code'];
    $ProfileInfo          = $response['data']['ProfileInfo'];
   // print_r($response);
    $Member = $response['data']['Members'];
    $EducationAttachment = $response['data']['EducationAttachments'];
    $PartnerExpectation = $response['data']['PartnerExpectation'];                                                                      
?>

<form method="post" action="" onsubmit="">                                                                 
<div class="col-12 grid-margin">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Profile Information</h4>
              <div class="form-group row">
                <div class="col-sm-8">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label" style="margin-right: 20px;">Profile For</label>
                        <label class="col-sm-8 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['ProfileFor'];?></label>
                         </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label" style="margin-right: 20px;">Name</label>
                        <label class="col-sm-8 col-form-label"  style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['ProfileName'];?></label>
                    </div>
                    <div class="form-group row">
                         <label class="col-sm-3 col-form-label" style="margin-right: 20px;">Date of birth</label>
                         <label class="col-sm-8 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['DateofBirth'];?></label>
                    </div>
                    <div class="form-group row">
                         <label class="col-sm-3 col-form-label" style="margin-right: 20px;">Sex</label>
                         <label class="col-sm-8 col-form-label"  style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['Sex'];?></label>   
                    </div>
                    <div class="form-group row">
                         <label class="col-sm-3 col-form-label" style="margin-right: 20px;">Marital Status</label>
                         <label class="col-sm-8 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['MaritalStatus'];?></label>   
                    </div>
                    <div class="form-group row">
                         <label class="col-sm-3 col-form-label" style="margin-right: 20px;">Mother Tongue</label>
                         <label class="col-sm-8 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['MotherTongue'];?></label>  
                    </div>
                    <div class="form-group row">
                         <label class="col-sm-3 col-form-label" style="margin-right: 20px;">Religion</label>
                         <label class="col-sm-8 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['Religion'];?></label>   
                    </div>
                    <div class="form-group row">
                         <label class="col-sm-3 col-form-label" style="margin-right: 20px;">Caste</label>
                         <label class="col-sm-8 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['Caste'];?></label>   
                    </div>
                    <div class="form-group row">
                         <label class="col-sm-3 col-form-label" style="margin-right: 20px;">Community</label>
                         <label class="col-sm-8 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['Community'];?></label>  
                    </div>
                    <div class="form-group row">
                         <label class="col-sm-3 col-form-label" style="margin-right: 20px;">Nationality</label>
                         <label class="col-sm-8 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['Nationality'];?></label>   
                    </div>
                    <div class="form-group row">
                         <label class="col-sm-3 col-form-label" style="margin-right: 20px;">About me</label>
                         <div class="col-sm-8 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['AboutMe'];?></div> 
                    </div>
              </div>
              <div class="col-sm-4">                                                             
              <div class="form-group row">
             <div class="col-sm-12" style="text-align:right">
                   <div class="photoview">
                    <img src="<?php echo $response['data']['ProfileThumb'];?>" style="height: 200px;width: 150px;">
                  </div>
              </div> 
             </div>
            </div>
              </div>
         </div>
</div>
</div>
<div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
    <h4 class="card-title">Education Details</h4>
         <table class="table table-bordered" id="doctable">           
            <thead style="background: #f1f1f1;border-left: 1px solid #ccc;border-right: 1px solid #ccc;">
                <tr>
                    <th>Qualification</th>
                    <th>Education Degree</th>
                    <th>Remarks</th>
                </tr>
            </thead>
            <tbody>
            <?php   if (sizeof($EducationAttachment)>0) {    ?>
                <?php foreach($EducationAttachment as $Document) { ?>
                <tr>    
                    <td style="text-align:left"><?php echo $Document['EducationDetails'];?></td>
                    <td style="text-align:left"><?php echo $Document['EducationDegree'];?></td>
                    <td style="text-align:left"><?php echo $Document['EducationRemarks'];?></td>
                </tr>
                <?php } 
            
            } else {?>
                <tr>    
                    <td colspan="3" style="text-align:center">No datas found</td>
                </tr>
                <?php }?>
            </tbody>
        </table>
    </div>
  </div>
</div>
<div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
    <h4 class="card-title">Occupation Details</h4>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Employed As</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['EmployedAs'];?></label>
            <label class="col-sm-3 col-form-label">Annual Income</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['AnnualIncome'];?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Occupation</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['OccupationType'];?></label>
            <label  class="col-sm-3 col-form-label">Occupation Type</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['TypeofOccupation'];?>
             </label>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Country</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['WorkedCountry'];?></label>
        </div>
    </div>
  </div>
</div>
<div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
    <h4 class="card-title">Family Information</h4>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Father's Name</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['FathersName'];?></label>
             <label class="col-sm-3 col-form-label">Father's Occupation</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['FathersOccupation'];?></label>
        </div>
        <div class="form-group row">
             <label class="col-sm-3 col-form-label">Mother's Name</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['MothersName'];?>
             </label>
             <label class="col-sm-3 col-form-label">Mother's Occupation</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['MothersOccupation'];?>   
             </label>
        </div>
        <div class="form-group row">
             <label class="col-sm-3 col-form-label">Family Type</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['FamilyType'];?>
             </label>
             <label class="col-sm-3 col-form-label">Family Affluence</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['FamilyAffluence'];?>   
             </label>
        </div>
        <div class="form-group row">
             <label class="col-sm-3 col-form-label">Family Value</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['FamilyValue'];?>
             </label>
        </div>
        <div class="form-group row">
             <label class="col-sm-3 col-form-label">Number Of Brothers</label>
             <label class="col-sm-1 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['NumberofBrothers'];?>
             </label>
             <label class="col-sm-1 col-form-label">Elder</label>
             <label class="col-sm-1 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['Elder'];?>
             </label>
             <label class="col-sm-2 col-form-label">Younger</label>
             <label class="col-sm-1 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['Younger'];?>
             </label>
             <label class="col-sm-2 col-form-label">Married</label>
             <label class="col-sm-1 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['Married'];?>
             </label>
        </div>
        <div class="form-group row">
             <label class="col-sm-3 col-form-label">Number Of Sisters</label>
             <label class="col-sm-1 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['NumberofSisters'];?>
             </label>
             <label class="col-sm-1 col-form-label">Elder</label>
             <label class="col-sm-1 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['ElderSister'];?>
             </label>
             <label class="col-sm-2 col-form-label">Younger</label>
             <label class="col-sm-1 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['YoungerSister'];?>
             </label>
             <label class="col-sm-2 col-form-label">Married</label>
             <label class="col-sm-1 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['MarriedSister'];?>
             </label>
        </div>
        </div>
    </div>
  </div>
  <div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
    <h4 class="card-title">Physical Information</h4>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Physically Impaired?</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['PhysicallyImpaired'];?></label>
            <?php if($ProfileInfo['PhysicallyImpaired'] =="Yes"){?> 
            <label class="col-sm-2 col-form-label">Description</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['PhysicallyImpaireddescription'];?></label>
            <?php }?>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Visually Impaired?</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['VisuallyImpaired'];?></label>
            <?php if($ProfileInfo['VisuallyImpaired'] =="Yes"){?> 
            <label class="col-sm-2 col-form-label">Description</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['VisuallyImpairedDescription'];?></label>
            <?php }?>
        </div>
        <div class="form-group row">
             <label class="col-sm-3 col-form-label">Vission Impaired?</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['VissionImpaired'];?> </label>
             <?php if($ProfileInfo['VissionImpaired'] =="Yes"){?> 
            <label class="col-sm-2 col-form-label">Description</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['VissionImpairedDescription'];?></label>
            <?php }?>
         </div>
        <div class="form-group row">
             <label class="col-sm-3 col-form-label">Speech Impaired?</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['SpeechImpaired'];?></label>
             <?php if($ProfileInfo['SpeechImpaired'] =="Yes"){?> 
            <label class="col-sm-2 col-form-label">Description</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['SpeechImpairedDescription'];?></label>
            <?php }?>
        </div>
        <div class="form-group row">
             <label class="col-sm-3 col-form-label">Height</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['Height'];?>
             </label>
             <label class="col-sm-3 col-form-label">Weight</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['Weight'];?>   
             </label>
        </div>
        <div class="form-group row">
             <label class="col-sm-3 col-form-label">Blood Group</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['BloodGroup'];?>
             </label>
             <label class="col-sm-3 col-form-label">Complexation</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['Complexation'];?>   
             </label>
        </div>
        <div class="form-group row">
             <label class="col-sm-3 col-form-label">Body Type</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['BodyType'];?>
             </label>
             <label class="col-sm-3 col-form-label">Diet</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['Diet'];?>   
             </label>
        </div>
        <div class="form-group row">
             <label class="col-sm-3 col-form-label">Smoking Habit</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['SmokingHabit'];?>
             </label>
             <label class="col-sm-3 col-form-label">Drinking Habit</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['DrinkingHabit'];?>   
             </label>
        </div>
    </div>
  </div>
</div>
  <div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
    <h4 class="card-title">Horoscope Details</h4>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Star Name</label>
            <label class="col-sm-9 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['StarName'];?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Rasi Name</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['RasiName'];?></label>
            <label class="col-sm-3 col-form-label">Lakanam</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['Lakanam'];?></label>
        </div>
        <div class="form-group row">
            <div class="col-sm-6">
               <table class="table table-bordered">
                <tbody>
                  <tr>
                    <td><?php echo $ProfileInfo['R1'];?></td>
                    <td><?php echo $ProfileInfo['R2'];?></td>
                    <td><?php echo $ProfileInfo['R3'];?></td>
                    <td><?php echo $ProfileInfo['R4'];?></td>
                  </tr>
                  <tr>
                    <td><?php echo $ProfileInfo['R5'];?></td>
                    <td colspan="2" rowspan="2" style="text-align:center;padding-top:61px">Rasi</td>
                    <td><?php echo $ProfileInfo['R8'];?></td>
                  </tr>
                  <tr>
                    <td><?php echo $ProfileInfo['R9'];?></td>
                    <td><?php echo $ProfileInfo['R12'];?></td>
                  </tr>
                  <tr>
                    <td><?php echo $ProfileInfo['R13'];?></td>
                    <td><?php echo $ProfileInfo['R14'];?></td>
                    <td><?php echo $ProfileInfo['R15'];?></td>
                    <td><?php echo $ProfileInfo['R16'];?></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="col-sm-6">
               <table class="table table-bordered">
                <tbody>
                  <tr>
                    <td><?php echo $ProfileInfo['A1'];?></td>
                    <td><?php echo $ProfileInfo['A2'];?></td>
                    <td><?php echo $ProfileInfo['A3'];?></td>
                    <td><?php echo $ProfileInfo['A4'];?></td>
                  </tr>
                  <tr>
                    <td><?php echo $ProfileInfo['A5'];?></td>
                    <td colspan="2" rowspan="2" style="text-align:center;padding-top:61px">Amsam</td>
                    <td><?php echo $ProfileInfo['A8'];?></td>
                  </tr>
                  <tr>
                    <td><?php echo $ProfileInfo['A9'];?></td>
                    <td><?php echo $ProfileInfo['A12'];?></td>
                  </tr>
                  <tr>
                    <td><?php echo $ProfileInfo['A13'];?></td>
                    <td><?php echo $ProfileInfo['A14'];?></td>
                    <td><?php echo $ProfileInfo['A15'];?></td>
                    <td><?php echo $ProfileInfo['A16'];?></td>
                  </tr>
                </tbody>
              </table>
            </div>
        </div>
        </div>
    </div>
  </div>
  <div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
    <h4 class="card-title">Partner's Expectation</h4>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Age </label>
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $PartnerExpectation['AgeFrom'];?> &nbsp;&nbsp;to&nbsp;&nbsp;<?php echo $PartnerExpectation['AgeTo'];?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Religion</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $PartnerExpectation['Religion'];?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Caste</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $PartnerExpectation['Caste'];?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Marital Status</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $PartnerExpectation['MaritalStatus'];?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Income Range</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $PartnerExpectation['AnnualIncome'];?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Education</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $PartnerExpectation['Education'];?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Employed As</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $PartnerExpectation['EmployedAs'];?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Description</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $PartnerExpectation['Details'];?></label>
        </div>
    </div>
  </div>
</div>
<div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
    <h4 class="card-title">Communication Details</h4>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Email ID</label>
            <label class="col-sm-9 col-form-label"style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['EmailID'];?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Mobile Number</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['MobileNumber'];?></label>
            <label class="col-sm-3 col-form-label">Whatsapp Number</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['WhatsappNumber'];?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Address</label>
            <label class="col-sm-9 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['AddressLine1'];?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label"></label>
            <label class="col-sm-9 col-form-label" style="color:#737373;">&nbsp;&nbsp; <?php echo $ProfileInfo['AddressLine2'];?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label"></label>
            <label class="col-sm-9 col-form-label" style="color:#737373;">&nbsp;&nbsp; <?php echo $ProfileInfo['AddressLine3'];?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Pincode</label>
            <label class="col-sm-9 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['Pincode'];?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">City</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['City'];?></label>
            <label class="col-sm-3 col-form-label">Other Location</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['OtherLocation'];?></label>
        </div> 
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">State</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['State'];?></label>
            <label class="col-sm-3 col-form-label">Country</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['Country'];?></label>
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