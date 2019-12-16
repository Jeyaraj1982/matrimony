<?php 
 $layout=0;
 include_once("includes/header.php");?>
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
              
          
         
         <section class="page-container" style="margin-top: -19px">
            <div class="container">
               <br><br>
                <div class="row">
                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 container-contentbar">
                        <div class="page-main">
                            <div class="article-detail">
                                <?php
                                include_once(application_config_path);
    $response = $webservice->getData("Member","GetLandingpageProfileInfo",array("ProfileCode"=>$_GET['Code']));
    $ProfileInfo          = $response['data']['ProfileInfo'];
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
                    <div class="col-sm-12">
                        <h3 style="margin-top:0px;color:#d60ccc;"><?php echo $ProfileInfo['ProfileName'];?> <span style="font-size:15px;color:#d60ccc;">[ <?php echo $ProfileInfo['ProfileCode']?> ]</span></h3>
                    </div>
                </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Profile Created By</label>
                        <label class="col-sm-8 col-form-label" style="color:#737373;">:&nbsp;&nbsp;
                            <?php if ( trim($ProfileInfo['ProfileFor'])=="Myself") { echo "Own"; }?>
                                <?php if ((trim($ProfileInfo['ProfileFor']))=="Brother"){ echo "Brother"; }?>
                                <?php if ((trim($ProfileInfo['ProfileFor']))=="Sister"){ echo "Sister"; }?>
                                <?php if ((trim($ProfileInfo['ProfileFor']))=="Daughter"){ echo "Father"; }?>
                                <?php if ((trim($ProfileInfo['ProfileFor']))=="Son"){ echo "Father"; }?>
                                <?php if ((trim($ProfileInfo['ProfileFor']))=="Sister In Law"){ echo "Sister In Law"; }?>
                                <?php if ((trim($ProfileInfo['ProfileFor']))=="Brother In Law"){ echo "Brother In Law"; }?>
                                <?php if ((trim($ProfileInfo['ProfileFor']))=="Son In Law"){ echo "Uncle"; }?>
                                <?php if ((trim($ProfileInfo['ProfileFor']))=="Daughter In Law"){ echo "Uncle"; }?>
                        </label>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label" >Profile ID</label>
                        <label class="col-sm-8 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['ProfileCode'];?></label>
                    </div>
                    <div class="form-group row">
                         <label class="col-sm-4 col-form-label" >Gender & Age</label>
                         <label class="col-sm-8 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['Sex'];?>,&nbsp;<?php echo $ProfileInfo['Age'];?>&nbsp;yrs</label>
                    </div>
                   <!-- <div class="form-group row">
                         <label class="col-sm-3 col-form-label" style="margin-right: 20px;">Gender</label>
                         <label class="col-sm-8 col-form-label"  style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['Sex'];?></label>   
                    </div>-->
                    <div class="form-group row">
                         <label class="col-sm-4 col-form-label" >Marital Status</label>
                         <label class="col-sm-8 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['MaritalStatus'];?></label>   
                    </div>
                    <!--<div class="form-group row">
                         <label class="col-sm-3 col-form-label" style="margin-right: 20px;">Mother Tongue</label>
                         <label class="col-sm-8 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['MotherTongue'];?></label>  
                    </div>-->
                    <div class="form-group row">
                         <label class="col-sm-4 col-form-label" >Religion</label>
                         <label class="col-sm-8 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['Religion'];?></label>   
                    </div>
                    <div class="form-group row">
                         <label class="col-sm-4 col-form-label" >Caste</label>
                         <label class="col-sm-8 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['Caste'];?></label>   
                    </div>
                    <?php if(strlen($ProfileInfo['SubCaste']>0)){?>
                    <div class="form-group row">
                         <label class="col-sm-4 col-form-label" >Sub Caste</label>
                         <label class="col-sm-8 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['SubCaste'];?></label>   
                    </div>
                    <?php } ?>
                    <div class="form-group row">
                         <label class="col-sm-4 col-form-label" >Community</label>
                         <label class="col-sm-8 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['Community'];?></label>  
                    </div>
                    <div class="form-group row">
                         <label class="col-sm-4 col-form-label">Nationality</label>
                         <label class="col-sm-8 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['Nationality'];?></label>   
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
</div>
<br>
<div class="article-detail"> 
<div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
    <h4 class="card-title">Education Details</h4>
         <table class="table table-bordered" id="doctable">           
            <thead style="background: #f1f1f1;border-left: 1px solid #ccc;border-right: 1px solid #ccc;">
                <tr>
                    <th>Qualification</th>
                    <th>Education Degree</th>
                    <th>Main Education</th>
                    <th>Remarks</th>
                </tr>
            </thead>
            <tbody>
            <?php   if (sizeof($EducationAttachment)>0) {    ?>
                <?php foreach($EducationAttachment as $Document) { ?>
                <tr>    
                    <td style="text-align:left"><?php echo $Document['EducationDetails'];?></td>
                    <td style="text-align:left">
                            <?php if($Document['EducationDegree']== "Others"){?>
                            <?php echo trim($Document['OtherEducationDegree']);?>
                        <?php } else { ?>
                             <?php echo trim($Document['EducationDegree']);?>  
                        <?php } ?> 
                    </td>
                    <td style="text-align:left"><?php echo $Document['MainEducation'];?></td>
                    <td style="text-align:left"><?php echo $Document['EducationDescription'];?></td>
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
</div>
<br>
<div class="article-detail"> 
<div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
    <h4 class="card-title">Occupation Details</h4>
     <div class="form-group row">
            <label class="col-sm-3 col-form-label">Employed as</label>                 
            <label class="col-sm-9 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['EmployedAs']))> 0 ? trim($ProfileInfo['EmployedAs']) : "N/A "; ?></label>
        </div>
        <?php if($ProfileInfo['EmployedAsCode']=="O001"){ ?>
        <div class="form-group row">
            <label  class="col-sm-3 col-form-label">Occupation type</label>              
            <label class="col-sm-9 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['TypeofOccupation']))> 0 ? trim($ProfileInfo['TypeofOccupation']) : "N/A "; ?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Occupation</label>                   
            <label class="col-sm-9 col-form-label" style="color:#737373;">:&nbsp;&nbsp;  
                <?php if($ProfileInfo['OccupationTypeCode']=="OT112") {?>
                <?php echo strlen(trim($ProfileInfo['OtherOccupation']))> 0 ? trim($ProfileInfo['OtherOccupation']) : "N/A "; ?>
                <?php } else { echo $ProfileInfo['OccupationType']; } ?>&nbsp;&nbsp;
                <?php if(strlen(trim($ProfileInfo['OccupationDescription']))> 0){
                    echo "(&nbsp;&nbsp;". trim($ProfileInfo['OccupationDescription']) . "&nbsp;&nbsp;)"; }?>
            </label>
        </div>
        <div class="form-group row">
             <label class="col-sm-3 col-form-label">Annual income</label>                
             <label class="col-sm-9 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen(trim($ProfileInfo['AnnualIncome']))> 0 ? trim($ProfileInfo['AnnualIncome']) : "N/A "; ?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Working country</label>                      
            <label class="col-sm-9 col-form-label" style="color:#737373;">:&nbsp;&nbsp;
                <?php echo strlen(trim($ProfileInfo['WorkedCountry']))> 0 ? trim($ProfileInfo['WorkedCountry']) : "N/A "; ?>&nbsp;&nbsp;
                <?php if(strlen(trim($ProfileInfo['WorkedCityName']))> 0){
                    echo "(&nbsp;&nbsp;". trim($ProfileInfo['WorkedCityName']) . "&nbsp;&nbsp;)"; }?>
            </label> 
        </div>
        <?php }?>
    </div>
  </div>
</div>
</div>
<br>
<!--<div class="article-detail"> 
<div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
    <h4 class="card-title">Family Information</h4>
       <div class="form-group row">
            <label class="col-sm-3 col-form-label">Father's Name</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php/* echo $ProfileInfo['FathersName'];?></label>
             <label class="col-sm-3 col-form-label">Father Alive</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['FathersAlive'];?></label> 
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Father's Occupation</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['FathersOccupation'];?></label>
            <label class="col-sm-3 col-form-label">Father's Income</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['FathersIncome'];?></label>
        </div>
        <div class="form-group row">
             <label class="col-sm-3 col-form-label">Mother's Name</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['MothersName'];?> </label>
             <label class="col-sm-3 col-form-label">Mother Alive</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['MothersAlive'];?></label>
         </div>
        <div class="form-group row">
             <label class="col-sm-3 col-form-label">Mother's Occupation</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['MothersOccupation'];?></label>
             <label class="col-sm-3 col-form-label">Mother's Income</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['MothersIncome'];?></label>
        </div>
        <div class="form-group row">
             <label class="col-sm-3 col-form-label">Father's Contact</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['FathersContact'];?></label>
             <label class="col-sm-3 col-form-label">Mother's Contact</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['MothersContact'];?></label>
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
             <label class="col-sm-2 col-form-label">Number Of Brothers</label>
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
             <label class="col-sm-2 col-form-label">Number Of Sisters</label>
             <label class="col-sm-1 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['NumberofSisters'];?>
             </label>
             <label class="col-sm-1 col-form-label">Elder</label>
             <label class="col-sm-1 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['ElderSister'];?>
             </label>
             <label class="col-sm-2 col-form-label">Younger</label>
             <label class="col-sm-1 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['YoungerSister'];?>
             </label>
             <label class="col-sm-2 col-form-label">Married</label>
             <label class="col-sm-1 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['MarriedSister'];*/?>
             </label>
        </div>
        </div>
    </div>
  </div>
</div>-->
<div class="article-detail"> 
  <div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
    <h4 class="card-title">Family Information</h4>
            <div class="form-group row">
                <div class="col-sm-12" style="text-align: center;">
                    <img src="website/assets/images/lockimage.png">
                </div>
                <div class="col-sm-12" style="text-align: center;">
                    <a href="login.php" class="btn btn-success">Login to view full details</a><br><br> 
                </div>
            </div>
         </div>
    </div>
  </div>
 </div>
<br>
<!--<div class="article-detail"> 
  <div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
    <h4 class="card-title">Physical Information</h4>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Physically Impaired?</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php/* echo $ProfileInfo['PhysicallyImpaired'];?></label>
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
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['DrinkingHabit'];*/?>   
             </label>
        </div>                                                           
    </div>
  </div>
</div>
</div>-->
<div class="article-detail"> 
  <div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
    <h4 class="card-title">Physical Information</h4>
            <div class="form-group row">
                <div class="col-sm-12" style="text-align: center;">
                    <img src="website/assets/images/lockimage.png">
                </div>
                <div class="col-sm-12" style="text-align: center;">
                    <a href="login.php" class="btn btn-success">Login to view full details</a><br><br> 
                </div>
            </div>
         </div>
    </div>
  </div>
 </div>
<br>
<!--<div class="article-detail"> 
  <div class="col-12 grid-margin">                                              
  <div class="card">
    <div class="card-body">
    <h4 class="card-title">Horoscope Details</h4>
     <?php /*if($response['data']['ShowHoroscopeDetails']=="1"){?>
         <div class="form-group row">
            <label class="col-sm-3 col-form-label">Time Of Birth</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['TimeOfBirth'];?></label>
            <label class="col-sm-3 col-form-label">Place Of Birth</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['PlaceOfBirth'];?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Star Name</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['StarName'];?></label>
            <label class="col-sm-3 col-form-label">Rasi Name</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['RasiName'];?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Rasi Name</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['RasiName'];?></label>
            <label class="col-sm-3 col-form-label">Chevvai Dhosham</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $ProfileInfo['ChevvaiDhosham'];?></label>
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
        <?php } else {?>
         <div class="form-group row">
            <label class="col-sm-3 col-form-label">Time Of Birth</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo "XXXXX";?></label>
            <label class="col-sm-3 col-form-label">Place Of Birth</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo "XXXXX";?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Star Name</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo "XXXXX";?></label>
            <label class="col-sm-3 col-form-label">Rasi Name</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo "XXXXX";?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Rasi Name</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo "XXXXX";?></label>
            <label class="col-sm-3 col-form-label">Chevvai Dhosham</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo "XXXXX";?></label>
        </div>
        <?php }*/?>
        </div>
    </div>
  </div>
  </div>-->
  <div class="article-detail"> 
  <div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
    <h4 class="card-title">Horoscope Details</h4>
            <div class="form-group row">
                <div class="col-sm-12" style="text-align: center;">
                    <img src="website/assets/images/lockimage.png">
                </div>
                <div class="col-sm-12" style="text-align: center;">
                    <a href="login.php" class="btn btn-success">Login to view full details</a><br><br> 
                </div>
            </div>
         </div>
    </div>
  </div>
 </div>
<br>
<div class="article-detail"> 
  <div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
    <h4 class="card-title">Partner's Expectation</h4>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Age </label>
            <label class="col-sm-9 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $PartnerExpectation['AgeFrom'];?> &nbsp;&nbsp;to&nbsp;&nbsp;<?php echo $PartnerExpectation['AgeTo'];?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Religion</label>
            <label class="col-sm-9 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $PartnerExpectation['Religion'];?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Caste</label>
            <label class="col-sm-9 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $PartnerExpectation['Caste'];?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Marital Status</label>
            <label class="col-sm-9 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $PartnerExpectation['MaritalStatus'];?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Income Range</label>
            <label class="col-sm-9 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $PartnerExpectation['AnnualIncome'];?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Education</label>
            <label class="col-sm-9 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $PartnerExpectation['Education'];?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Employed As</label>
            <label class="col-sm-9 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $PartnerExpectation['EmployedAs'];?></label>
        </div>
        
    </div>
  </div>
</div>
</div>
<br>
<!--<div class="article-detail"> 
<div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
    <h4 class="card-title">Communication Details</h4>
    <?php /* if($response['data']['ShowCommunicationDetails']=="1"){?>
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
        <?php } else{?>
           <div class="form-group row">
            <label class="col-sm-3 col-form-label">Email ID</label>
            <label class="col-sm-9 col-form-label"style="color:#737373;">:&nbsp;&nbsp;<?php echo "XXXXX";?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Mobile Number</label>
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo "XXXXX";?></label>
            <label class="col-sm-3 col-form-label">Whatsapp Number</label>
             <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo "XXXXX";?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Address</label>
            <label class="col-sm-9 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo "XXXXX";?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label"></label>
            <label class="col-sm-9 col-form-label" style="color:#737373;">&nbsp;&nbsp; <?php echo "XXXXX";?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label"></label>
            <label class="col-sm-9 col-form-label" style="color:#737373;">&nbsp;&nbsp; <?php echo "XXXXX";?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Pincode</label>
            <label class="col-sm-9 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo "XXXXX";?></label>
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
        <?php }*/?> 
        </div>
    </div>
  </div>                                                                
  </div>--> 
  <div class="article-detail"> 
  <div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
    <h4 class="card-title">Communication Details</h4>
            <div class="form-group row">
                <div class="col-sm-12" style="text-align: center;">
                    <img src="website/assets/images/lockimage.png">
                </div>
                <div class="col-sm-12" style="text-align: center;">
                    <a href="login.php" class="btn btn-success">Login to view full details</a><br><br> 
                </div>
            </div>
         </div>
    </div>
  </div>
 </div>   <br><br>
 
            
               
                            </div>
                        </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 container-sidebar">
                                                      
                    </div>
                </div>
            </div>
        </section>
         
           <?php include_once("includes/footer.php");?>