<?php
    $response = $webservice�>getData�"Franchisee"�"GetDraftProfileInfo"�array�"ProfileCode"=>$_GET['Code']��;
    $ProfileInfo          = $response['data']['ProfileInfo'];
    $Member = $response['data']['Members'];
    $EducationAttachment = $response['data']['EducationAttachments'];
    $PartnerExpectation = $response['data']['PartnerExpectation'];
?>
 <style>
 �table�bordered > tbody > tr > td{
     width: 75px;
height: 75px;
text�align:center;
 }
 #doctable > tbody > tr > td{
 width: 75px;
height: 33px;
text�align: left;
 }
 #doctable {
    border�top: 2px solid #ddd;
}
  �form�group {
    margin�bottom: 0px;
}
�photoview {
    float: right;
    margin�right: 10px;
    margin�bottom: 10px;
}
�Documentview {
    float: left;
    margin�right: 10px;
    text�align: center;
    border: 1px solid #eaeaea;
    padding: 10px;
    margin�bottom: 10px;
    border�radius: 10px;
}
 
 </style>
<form method="post" action="" onsubmit="">
<?php if�$ProfileInfo['RequestToVerify']=="0"�{?>
<div style="text�align: right" id="">
        <a href="<?php echo GetUrl�"MemberProfileEdit/GeneralInformation/"�$_GET['Code']�"�htm "�;?>">Edit</a>&nbsp;
        <a href="javascript:void�0�" onclick="showConfirmPublish�'<?php echo $_GET['Code'];?>'�" class="btn btn�success" name="Publish" style="font�family:roboto">Publish Now</a>
</div>
<?php }?>
<br>

<div class="col�12 grid�margin">
  <div class="card">                                                                                                               
    <div class="card�body">
        <div class="form�group row">
            <label class="col�sm�10 col�form�label"></label>
            <div class="col�sm�2">
                <i class="menu�icon mdi mdi�printer" style="font�size: 26px;color: purple;"></i>&nbsp;&nbsp; <label>Print</label> 
            </div>
        </div>
        <div class="form�group row">
            <label class="col�sm�10 col�form�label"></label>
                <div class="col�sm�2">
                    <i class="menu�icon mdi mdi�download" style="font�size: 26px;color: purple;"></i>&nbsp;&nbsp; <label>Download</label>   
                </div>
        </div>
       
  </div>
</div>
</div>
<div class="col�12 grid�margin">                                                     
    <div class="card">
        <div class="card�body">
         <div class="form�group row">
            <div class="col�sm�6"><h4 class="card�title">Profile Information</h4></div>
            <div class="col�sm�6" style="text�align:right"><a href="#">Edit</a></div>
         </div>
              <div class="form�group row">
                <div class="col�sm�5">
                    <div style="border: 1px solid black;padding: 0px;width: 318px;height: 378px;"> 
                    <div class="form�group row">                                                       
                        <div class="col�sm�12">
                            <div class="photoview" style="float:left;width: 316px;height:280px">
                                <img src="<?php echo $response['data']['ProfileThumb'];?>" style="height: 100%;width: 100%;">
                            </div>
                        </div> 
                    </div>
                    <div style="padding�left: 10px;padding�right: 10px;">
                      <div class="col�sm�1" style="padding�left: 0px;padding�top: 26px;"><img src="<?php echo SiteUrl?>assets/images/nextarrow�jpg" style="width:30px"></div>
                        <div class="col�sm�10">
                        <?php foreach�$response['data']['ProfilePhotos'] as $ProfileP� {?>
                            <div class="photoview" style="float: left;">
                                <img src="<?php echo $ProfileP['ProfilePhoto'];?>" style="height: 62px;width: 44px;">
                            </div>
                        <?php }?>
                        </div>
                       <div class="col�sm�1" style="padding�left: 0px;padding�top: 26px;"><img src="<?php echo SiteUrl?>assets/images/rightarrow�jpg" style="width:30px"></div>
                  </div>
                </div>
                </div>
                <div class="col�sm�7">
                    <div class="form�group row">                                       
                        <label class="col�sm�12 col�form�label" style="color: #1e1e1e;font�size: 17px;"><?php echo strlen�trim�$ProfileInfo['ProfileName']��> 0 ? trim�$ProfileInfo['ProfileName']� : "N/A "; ?>&nbsp;<?php if��strlen�trim�$ProfileInfo['Age']���>0�{ echo "�"�" "�trim�$ProfileInfo['Age']��" "�"yrs"�"�";  }?>&nbsp;</label>
                    </div>
                    <div class="form�group row">                                       
                        <label class="col�sm�12 col�form�label" style="color:#737373;"><?php if��strlen�trim�$ProfileInfo['Height']���>0�{ echo trim�$ProfileInfo['Height']�;?>&nbsp;&nbsp;<span style="color: #ccc;">�approximate�</span><?php }?></label>
                    </div>
                    <div class="form�group row">
                         <label class="col�sm�3 col�form�label" style="color:#737373;"><?php echo trim�$ProfileInfo['MaritalStatus']�;?></label> 
                    </div>
                    <?php if�$ProfileInfo['MaritalStatusCode']!= "MST001"�{?>
                    <div class="form�group row">
                            <label class="col�sm�2 col�form�label">Children</label>
                            <label class="col�sm�2 col�form�label" style="color:#737373;">:&nbsp;&nbsp;<?php echo trim�$ProfileInfo['Children']�;?></label> 
                            <label class="col�sm�3 col�form�label">Children with you</label>
                            <label class="col�sm�2 col�form�label" style="color:#737373;">:&nbsp;&nbsp;
                            <?php if�trim�$ProfileInfo['IsChildrenWithYou']�=="1"� {  echo "Yes"; } else  { echo "No";};?></label>   
                    </div>
                    <?php }?>
                    <div class="form�group row">
                        <label class="col�sm�12 col�form�label" style="color:#737373;"><?php echo trim�$ProfileInfo['Religion']�;?></label>
                    </div>
                    <div class="form�group row">
                        <label class="col�sm�12 col�form�label" style="color:#737373;"><?php echo trim�$ProfileInfo['Caste']�;?></label>
                    </div>
                     <?php if��strlen�trim�$ProfileInfo['SubCaste']���>0�{?>
                    <div class="form�group row">
                        <label class="col�sm�12 col�form�label" style="color:#737373;"><?php echo trim�$ProfileInfo['SubCaste']�;?></label>
                    </div>
                    <?php }?>
                    <div class="form�group row">
                        <label class="col�sm�12 col�form�label" style="color:#737373;"><?php echo trim�$ProfileInfo['Community']�;?></label>
                    </div>
                    <div class="form�group row">
                        <label class="col�sm�12 col�form�label" style="color:#737373;"><?php echo trim�$ProfileInfo['Nationality']�;?></label>
                    </div>
                    <div class="form�group row">
                        <label class="col�sm�12 col�form�label" style="color:#737373;"><?php echo trim�$ProfileInfo['MotherTongue']�;?></label>
                    </div>
                     <div class="form�group row">
                        <label class="col�sm�12 col�form�label" style="color:#737373;"><?php if��strlen�trim�$ProfileInfo['City']���>0�{ echo trim�$ProfileInfo['City']�;?>�&nbsp;&nbsp;<?php }?><?php if��strlen�trim�$ProfileInfo['State']���>0�{ echo trim�$ProfileInfo['State']�;?>�&nbsp;&nbsp;<?php }?><?php echo trim�$ProfileInfo['Country']�;?></label>
                    </div>
                  
              </div>
              </div>
         </div>
</div>
</div>
<div class="col�12 grid�margin">
  <div class="card">
    <div class="card�body">
     <div class="form�group row">
            <div class="col�sm�6"><h4 class="card�title">About Me</h4></div>
            <div class="col�sm�6" style="text�align:right"><a href="#">Edit</a></div>
         </div>
         <table>           
           <?php echo trim�$ProfileInfo['AboutMe']�;?>
        </table>
    </div>
  </div>
</div>
<div class="col�12 grid�margin">
  <div class="card">
    <div class="card�body">
     <div class="form�group row">
            <div class="col�sm�6"><h4 class="card�title">Education Details</h4></div>
            <div class="col�sm�6" style="text�align:right"><a href="#">Edit</a></div>
         </div>
         <table class="table table�bordered" id="doctable">           
            <thead style="background: #f1f1f1;border�left: 1px solid #ccc;border�right: 1px solid #ccc;">
                <tr>
                    <th>Qualification</th>
                    <th>Education Degree</th>
                    <th>Remarks</th>
                </tr>
            </thead>
            <tbody>
            <?php   if �sizeof�$EducationAttachment�>0� {    ?>
                <?php foreach�$EducationAttachment as $Document� { ?>
                <tr>    
                    <td style="text�align:left"><?php echo $Document['EducationDetails'];?></td>
                    <td style="text�align:left"><?php echo $Document['EducationDegree'];?></td>
                    <td style="text�align:left"><?php echo $Document['EducationRemarks'];?></td>
                </tr>
                <?php } 
            
            } else {?>
                <tr>    
                    <td colspan="3" style="text�align:center">No datas found</td>
                </tr>
                <?php }?>
            </tbody>
        </table>
    </div>
  </div>
</div>
<div class="col�12 grid�margin">
  <div class="card">
    <div class="card�body">
        <div class="form�group row">
            <div class="col�sm�6"><h4 class="card�title">Occupation Details</h4></div>
            <div class="col�sm�6" style="text�align:right"><a href="#">Edit</a></div>
         </div>
        <div class="form�group row">
            <label class="col�sm�2 col�form�label">Employed As</label>                 
            <label class="col�sm�3 col�form�label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen�trim�$ProfileInfo['EmployedAs']��> 0 ? trim�$ProfileInfo['EmployedAs']� : "N/A "; ?></label>
            <label class="col�sm�2 col�form�label">Annual Income</label>                
             <label class="col�sm�3 col�form�label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen�trim�$ProfileInfo['AnnualIncome']��> 0 ? trim�$ProfileInfo['AnnualIncome']� : "N/A "; ?></label>
        </div>
        <div class="form�group row">
            <label class="col�sm�2 col�form�label">Occupation</label>                   
            <label class="col�sm�3 col�form�label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen�trim�$ProfileInfo['OccupationType']��> 0 ? trim�$ProfileInfo['OccupationType']� : "N/A "; ?></label>
            <label  class="col�sm�2 col�form�label">Occupation Type</label>              
             <label class="col�sm�3 col�form�label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen�trim�$ProfileInfo['TypeofOccupation']��> 0 ? trim�$ProfileInfo['TypeofOccupation']� : "N/A "; ?>
             </label>
        </div>
        <div class="form�group row">
            <label class="col�sm�2 col�form�label">Country</label>                      
            <label class="col�sm�3 col�form�label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen�trim�$ProfileInfo['WorkedCountry']��> 0 ? trim�$ProfileInfo['WorkedCountry']� : "N/A "; ?></label>
        </div>
        <div class="form�group row">
            <label class="col�sm�2 col�form�label">Details</label>                  
            <div class="col�sm�12 col�form�label" style="color:#737373;"><div style="border:2px solid black;padding: 10px;width: 562px;height: 100px;">&nbsp;&nbsp;<?php echo strlen�trim�$ProfileInfo['OccupationDetails']��> 0 ? trim�$ProfileInfo['OccupationDetails']� : "N/A "; ?></div></div>
        </div>
    </div>
  </div>
</div>
<div class="col�12 grid�margin">
  <div class="card">
    <div class="card�body">
        <div class="form�group row">
            <div class="col�sm�6"><h4 class="card�title">Family Information</h4></div>
            <div class="col�sm�6" style="text�align:right"><a href="#">Edit</a></div>
         </div>
        <div class="form�group row">
            <label class="col�sm�2 col�form�label">Father's Name</label>                
            <label class="col�sm�3 col�form�label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen�trim�$ProfileInfo['FathersName']��> 0 ? trim�$ProfileInfo['FathersName']� : "N/A "; ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php if��strlen�trim�$ProfileInfo['FathersAlive']���>0�{?><?php if�$ProfileInfo['FathersAlive']=="1"� { echo "�Passed away�" ;}?><?php } ?></label>
        </div>
        <?php if�$ProfileInfo['FathersAlive']=="0"�{?>
        <div class="form�group row">
            <label class="col�sm�2 col�form�label">Father's Occupation</label>         
            <label class="col�sm�3 col�form�label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen�trim�$ProfileInfo['FathersOccupation']��> 0 ? trim�$ProfileInfo['FathersOccupation']� : "N/A "; ?></label>
            <label class="col�sm�2 col�form�label">Father's Income</label>              
            <label class="col�sm�3 col�form�label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen�trim�$ProfileInfo['FathersIncome']��> 0 ? trim�$ProfileInfo['FathersIncome']� : "N/A "; ?></label>
        </div>
        <div class="form�group row">
            <label class="col�sm�2 col�form�label">Father's Contact</label>            
            <label class="col�sm�3 col�form�label" style="color:#737373;">:&nbsp;&nbsp;<?php if��strlen�trim�$ProfileInfo['FathersContact']���>0�{?><?php echo "+"; echo $ProfileInfo['FathersContactCountryCode'];?>�<?php echo $ProfileInfo['FathersContact'];?><?php  } else{ echo "N/A";}?></label>
            
        </div>                                                                         
        <?php }?>
        <div class="form�group row">                                                    
             <label class="col�sm�2 col�form�label">Mother's Name</label>               
             <label class="col�sm�3 col�form�label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen�trim�$ProfileInfo['MothersName']��> 0 ? trim�$ProfileInfo['MothersName']� : "N/A "; ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php if��strlen�trim�$ProfileInfo['MothersAlive']���>0�{?><?php if�$ProfileInfo['MothersAlive']=="1"�{ echo "�Passed away�" ;}?><?php } ?> </label>
         </div>
         <?php if�$ProfileInfo['MothersAlive']=="0"�{?>
        <div class="form�group row">
             <label class="col�sm�2 col�form�label">Mother's Occupation</label>         
             <label class="col�sm�3 col�form�label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen�trim�$ProfileInfo['MothersOccupation']��> 0 ? trim�$ProfileInfo['MothersOccupation']� : "N/A "; ?></label>
             <label class="col�sm�2 col�form�label">Mother's Income</label>             
             <label class="col�sm�3 col�form�label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen�trim�$ProfileInfo['MothersIncome']��> 0 ? trim�$ProfileInfo['MothersIncome']� : "N/A "; ?></label>
        </div>
        <div class="form�group row">
            <label class="col�sm�2 col�form�label">Mother's Contact</label>           
             <label class="col�sm�3 col�form�label" style="color:#737373;">:&nbsp;&nbsp;<?php if��strlen�trim�$ProfileInfo['MothersContact']���>0�{?><?php echo "+"; echo $ProfileInfo['MothersContactCountryCode'];?>�<?php echo $ProfileInfo['FathersContact'];?><?php  } else{ echo "N/A";}?></label>
        </div>
        <?php }?>
        <div class="form�group row">
             <label class="col�sm�2 col�form�label">Family Type</label>                 
             <label class="col�sm�3 col�form�label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen�trim�$ProfileInfo['FamilyType']��> 0 ? trim�$ProfileInfo['FamilyType']� : "N/A "; ?>
             </label>
             <label class="col�sm�2 col�form�label">Family Affluence</label>             
             <label class="col�sm�3 col�form�label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen�trim�$ProfileInfo['FamilyAffluence']��> 0 ? trim�$ProfileInfo['FamilyAffluence']� : "N/A "; ?>  
             </label>
        </div>
        <div class="form�group row">
             <label class="col�sm�2 col�form�label">Family Value</label>                
             <label class="col�sm�3 col�form�label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen�trim�$ProfileInfo['FamilyValue']��> 0 ? trim�$ProfileInfo['FamilyValue']� : "N/A "; ?>
             </label>
        </div>
        <div class="form�group row">
             <label class="col�sm�2 col�form�label">Number Of Brothers</label>          
             <label class="col�sm�1 col�form�label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen�trim�$ProfileInfo['NumberofBrothers']��> 0 ? trim�$ProfileInfo['NumberofBrothers']� : "N/A "; ?>
             </label>
             <label class="col�sm�1 col�form�label">Elder</label>                       
             <label class="col�sm�1 col�form�label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen�trim�$ProfileInfo['Elder']��> 0 ? trim�$ProfileInfo['Elder']� : "N/A "; ?>
             </label>
             <label class="col�sm�2 col�form�label">Younger</label>                     
             <label class="col�sm�1 col�form�label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen�trim�$ProfileInfo['Younger']��> 0 ? trim�$ProfileInfo['Younger']� : "N/A "; ?>
             </label>
             <label class="col�sm�2 col�form�label">Married</label>                      
             <label class="col�sm�1 col�form�label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen�trim�$ProfileInfo['Married']��> 0 ? trim�$ProfileInfo['Married']� : "N/A "; ?>
             </label>
        </div>
        <div class="form�group row">
             <label class="col�sm�2 col�form�label">Number Of Sisters</label>           
             <label class="col�sm�1 col�form�label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen�trim�$ProfileInfo['NumberofSisters']��> 0 ? trim�$ProfileInfo['NumberofSisters']� : "N/A "; ?>
             </label>
             <label class="col�sm�1 col�form�label">Elder</label>                       
             <label class="col�sm�1 col�form�label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen�trim�$ProfileInfo['ElderSister']��> 0 ? trim�$ProfileInfo['ElderSister']� : "N/A "; ?>
             </label>
             <label class="col�sm�2 col�form�label">Younger</label>                     
             <label class="col�sm�1 col�form�label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen�trim�$ProfileInfo['YoungerSister']��> 0 ? trim�$ProfileInfo['YoungerSister']� : "N/A "; ?>
             </label>
             <label class="col�sm�2 col�form�label">Married</label>                     
             <label class="col�sm�1 col�form�label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen�trim�$ProfileInfo['MarriedSister']��> 0 ? trim�$ProfileInfo['MarriedSister']� : "N/A "; ?>
             </label>
        </div>
        <div class="form�group row">
            <label class="col�sm�2 col�form�label">About My Family</label>                  
            <div class="col�sm�12 col�form�label" style="color:#737373;"><div style="border:2px solid black;padding: 10px;width: 562px;height: 100px;">&nbsp;&nbsp;<?php echo strlen�trim�$ProfileInfo['AboutMyFamily']��> 0 ? trim�$ProfileInfo['AboutMyFamily']� : "N/A "; ?></div></div>
        </div>
        </div>
    </div>
  </div>
  <div class="col�12 grid�margin">
  <div class="card">
    <div class="card�body">
        <div class="form�group row">
            <div class="col�sm�6"><h4 class="card�title">Physical Information</h4></div>
            <div class="col�sm�6" style="text�align:right"><a href="#">Edit</a></div>
         </div>
        <div class="form�group row">
            <label class="col�sm�2 col�form�label">Physically Impaired?</label>         
            <label class="col�sm�3 col�form�label" style="color:#737373;">:&nbsp;&nbsp;
                <?php echo strlen�trim�$ProfileInfo['PhysicallyImpaired']��> 0 ? trim�$ProfileInfo['PhysicallyImpaired']� : "N/A "; ?>&nbsp;
                <?php if�$ProfileInfo['PhysicallyImpaired'] =="Yes"�{ echo "�";?>
                    <?php echo strlen�trim�$ProfileInfo['PhysicallyImpaireddescription']��> 0 ? trim�$ProfileInfo['PhysicallyImpaireddescription']� : "N/A "; ?>
                <?php }?>
            </label>
        </div>
        <div class="form�group row">
            <label class="col�sm�2 col�form�label">Visually Impaired?</label>         
            <label class="col�sm�3 col�form�label" style="color:#737373;">:&nbsp;&nbsp;
                <?php echo strlen�trim�$ProfileInfo['VisuallyImpaired']��> 0 ? trim�$ProfileInfo['VisuallyImpaired']� : "N/A "; ?>&nbsp;
                <?php if�$ProfileInfo['VisuallyImpaired'] =="Yes"�{ echo "�";?>
                    <?php echo strlen�trim�$ProfileInfo['VisuallyImpairedDescription']��> 0 ? trim�$ProfileInfo['VisuallyImpairedDescription']� : "N/A "; ?>
                <?php }?>
            </label>
        </div>
        <div class="form�group row">
            <label class="col�sm�2 col�form�label">Vision Impaired?</label>         
            <label class="col�sm�3 col�form�label" style="color:#737373;">:&nbsp;&nbsp;
                <?php echo strlen�trim�$ProfileInfo['VissionImpaired']��> 0 ? trim�$ProfileInfo['VissionImpaired']� : "N/A "; ?>&nbsp;
                <?php if�$ProfileInfo['VissionImpaired'] =="Yes"�{ echo "�";?>
                    <?php echo strlen�trim�$ProfileInfo['VissionImpairedDescription']��> 0 ? trim�$ProfileInfo['VissionImpairedDescription']� : "N/A "; ?>
                <?php }?>
            </label>
        </div>
        <div class="form�group row">
            <label class="col�sm�2 col�form�label">Speech Impaired?</label>         
            <label class="col�sm�3 col�form�label" style="color:#737373;">:&nbsp;&nbsp;
                <?php echo strlen�trim�$ProfileInfo['SpeechImpaired']��> 0 ? trim�$ProfileInfo['SpeechImpaired']� : "N/A "; ?>&nbsp;
                <?php if�$ProfileInfo['SpeechImpaired'] =="Yes"�{ echo "�";?>
                    <?php echo strlen�trim�$ProfileInfo['SpeechImpairedDescription']��> 0 ? trim�$ProfileInfo['SpeechImpairedDescription']� : "N/A "; ?>
                <?php }?>
            </label>
        </div>
        <div class="form�group row">                                                    
             <label class="col�sm�2 col�form�label">Height</label>                      
             <label class="col�sm�3 col�form�label" style="color:#737373;">:&nbsp;&nbsp;<?php if��strlen�trim�$ProfileInfo['Height']���>0�{ echo trim�$ProfileInfo['Height']�;?>&nbsp;&nbsp;<span style="color: #ccc;">�approximate�</span><?php } else{ echo "N/A";}?>
             </label>
             <label class="col�sm�2 col�form�label">Weight</label>                      
             <label class="col�sm�3 col�form�label" style="color:#737373;">:&nbsp;&nbsp;<?php if��strlen�trim�$ProfileInfo['Weight']���>0�{ echo trim�$ProfileInfo['Weight']�;?>&nbsp;&nbsp;<span style="color: #ccc;">�approximate�</span><?php } else{ echo "N/A";}?>   
             </label>
        </div>
        <div class="form�group row">
             <label class="col�sm�2 col�form�label">Blood Group</label>                 
             <label class="col�sm�3 col�form�label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen�trim�$ProfileInfo['BloodGroup']��> 0 ? trim�$ProfileInfo['BloodGroup']� : "N/A "; ?>
             </label>
             <label class="col�sm�2 col�form�label">Complexation</label>                
             <label class="col�sm�3 col�form�label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen�trim�$ProfileInfo['Complexation']��> 0 ? trim�$ProfileInfo['Complexation']� : "N/A "; ?>  
             </label>
        </div>
        <div class="form�group row">
             <label class="col�sm�2 col�form�label">Body Type</label>                    
             <label class="col�sm�3 col�form�label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen�trim�$ProfileInfo['BodyType']��> 0 ? trim�$ProfileInfo['BodyType']� : "N/A "; ?>
             </label>
             <label class="col�sm�2 col�form�label">Diet</label>                         
             <label class="col�sm�3 col�form�label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen�trim�$ProfileInfo['Diet']��> 0 ? trim�$ProfileInfo['Diet']� : "N/A "; ?>
             </label>
        </div>
        <div class="form�group row">
             <label class="col�sm�2 col�form�label">Smoking Habit</label>               
             <label class="col�sm�3 col�form�label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen�trim�$ProfileInfo['SmokingHabit']��> 0 ? trim�$ProfileInfo['SmokingHabit']� : "N/A "; ?>
             </label>
             <label class="col�sm�2 col�form�label">Drinking Habit</label>              
             <label class="col�sm�3 col�form�label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen�trim�$ProfileInfo['DrinkingHabit']��> 0 ? trim�$ProfileInfo['DrinkingHabit']� : "N/A "; ?>  
             </label>
        </div>
        <div class="form�group row">
            <label class="col�sm�2 col�form�label">Description</label>                  
            <div class="col�sm�12 col�form�label" style="color:#737373;"><div style="padding: 10px;width: 562px;height: 100px;">&nbsp;&nbsp;<?php echo strlen�trim�$ProfileInfo['PhysicalDescription']��> 0 ? trim�$ProfileInfo['PhysicalDescription']� : "N/A "; ?></div></div>
        </div>
    </div>
  </div>
</div>
  <div class="col�12 grid�margin">
  <div class="card">
    <div class="card�body">
        <div class="form�group row">
            <div class="col�sm�6"><h4 class="card�title">Horoscope Details</h4></div>
            <div class="col�sm�6" style="text�align:right"><a href="#">Edit</a></div>
         </div>
        <div class="form�group row">
            <label class="col�sm�2 col�form�label" >Date of birth</label>               
            <label class="col�sm�8 col�form�label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen�trim�$ProfileInfo['DateofBirth']��> 0 ? trim�$ProfileInfo['DateofBirth']� : "N/A "; ?></label>
        </div>
        <div class="form�group row">
            <label class="col�sm�2 col�form�label">Time Of Birth</label>               
            <label class="col�sm�3 col�form�label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen�trim�$ProfileInfo['TimeOfBirth']��> 0 ? trim�$ProfileInfo['TimeOfBirth']� : "N/A "; ?></label>
            <label class="col�sm�2 col�form�label">Place Of Birth</label>               
            <label class="col�sm�3 col�form�label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen�trim�$ProfileInfo['PlaceOfBirth']��> 0 ? trim�$ProfileInfo['PlaceOfBirth']� : "N/A "; ?></label>
        </div>
        <div class="form�group row">
            <label class="col�sm�2 col�form�label">Star Name</label>                   
            <label class="col�sm�3 col�form�label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen�trim�$ProfileInfo['StarName']��> 0 ? trim�$ProfileInfo['StarName']� : "N/A "; ?></label>
            <label class="col�sm�2 col�form�label">Rasi Name</label>                   
            <label class="col�sm�3 col�form�label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen�trim�$ProfileInfo['RasiName']��> 0 ? trim�$ProfileInfo['RasiName']� : "N/A "; ?></label>
        </div>
        <div class="form�group row">
            <label class="col�sm�2 col�form�label">Lakanam</label>                     
            <label class="col�sm�3 col�form�label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen�trim�$ProfileInfo['Lakanam']��> 0 ? trim�$ProfileInfo['Lakanam']� : "N/A "; ?></label>
            <label class="col�sm�2 col�form�label">Chevvai Dhosham</label>              
             <label class="col�sm�3 col�form�label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen�trim�$ProfileInfo['ChevvaiDhosham']��> 0 ? trim�$ProfileInfo['ChevvaiDhosham']� : "N/A "; ?></label>
        </div>
        <div class="form�group row">
            <label class="col�sm�2 col�form�label">Details</label>                  
            <div class="col�sm�12 col�form�label" style="color:#737373;"><div style="border:2px solid black;padding: 10px;width: 562px;height: 100px;">&nbsp;&nbsp;<?php echo strlen�trim�$ProfileInfo['HoroscopeDetails']��> 0 ? trim�$ProfileInfo['HoroscopeDetails']� : "N/A "; ?></div></div>
        </div>
        <div class="form�group row">
            <div class="col�sm�6">
               <table class="table table�bordered">
                <tbody>
                  <tr>
                    <td><?php echo $ProfileInfo['R1'];?></td>
                    <td><?php echo $ProfileInfo['R2'];?></td>
                    <td><?php echo $ProfileInfo['R3'];?></td>
                    <td><?php echo $ProfileInfo['R4'];?></td>
                  </tr>
                  <tr>
                    <td><?php echo $ProfileInfo['R5'];?></td>
                    <td colspan="2" rowspan="2" style="text�align:center;padding�top:61px">Rasi</td>
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
            <div class="col�sm�6">
               <table class="table table�bordered">
                <tbody>
                  <tr>
                    <td><?php echo $ProfileInfo['A1'];?></td>
                    <td><?php echo $ProfileInfo['A2'];?></td>
                    <td><?php echo $ProfileInfo['A3'];?></td>
                    <td><?php echo $ProfileInfo['A4'];?></td>
                  </tr>
                  <tr>
                    <td><?php echo $ProfileInfo['A5'];?></td>
                    <td colspan="2" rowspan="2" style="text�align:center;padding�top:61px">Amsam</td>
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
  <div class="col�12 grid�margin">
  <div class="card">
    <div class="card�body">
    <div class="form�group row">
            <div class="col�sm�6"><h4 class="card�title">Partner's Expectations</h4></div>
            <div class="col�sm�6" style="text�align:right"><a href="#">Edit</a></div>
         </div>
        <div class="form�group row">                                                                                                                                                                                             
            <label class="col�sm�2 col�form�label">Age </label>                       
            <label class="col�sm�3 col�form�label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen�trim�$PartnerExpectation['AgeFrom']��> 0 ? trim�$PartnerExpectation['AgeFrom']� : "N/A "; ?>&nbsp;&nbsp;to&nbsp;&nbsp;<?php echo strlen�trim�$PartnerExpectation['AgeTo']��> 0 ? trim�$PartnerExpectation['AgeTo']� : "N/A "; ?></label>
        </div>
        <div class="form�group row">
            <label class="col�sm�2 col�form�label">Religion</label>                     
            <label class="col�sm�3 col�form�label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen�trim�$PartnerExpectation['Religion']��> 0 ? trim�$PartnerExpectation['Religion']� : "N/A "; ?></label>
        </div>
        <div class="form�group row">
            <label class="col�sm�2 col�form�label">Caste</label>                        
            <label class="col�sm�3 col�form�label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen�trim�$PartnerExpectation['Caste']��> 0 ? trim�$PartnerExpectation['Caste']� : "N/A "; ?></label>
        </div>
        <div class="form�group row">
            <label class="col�sm�2 col�form�label">Marital Status</label>               
            <label class="col�sm�3 col�form�label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen�trim�$PartnerExpectation['MaritalStatus']��> 0 ? trim�$PartnerExpectation['MaritalStatus']� : "N/A "; ?></label>
        </div>
        <div class="form�group row">
            <label class="col�sm�2 col�form�label">Education</label>                   
            <label class="col�sm�3 col�form�label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen�trim�$PartnerExpectation['Education']��> 0 ? trim�$PartnerExpectation['Education']� : "N/A "; ?></label>
        </div>
        <div class="form�group row">
            <label class="col�sm�2 col�form�label">Employed As</label>                 
            <label class="col�sm�3 col�form�label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen�trim�$PartnerExpectation['EmployedAs']��> 0 ? trim�$PartnerExpectation['EmployedAs']� : "N/A "; ?></label>
        </div>
        <div class="form�group row">
            <label class="col�sm�2 col�form�label">Income Range</label>                
            <label class="col�sm�3 col�form�label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen�trim�$PartnerExpectation['AnnualIncome']��> 0 ? trim�$PartnerExpectation['AnnualIncome']� : "N/A "; ?></label>
        </div>
        <div class="form�group row">
            <label class="col�sm�2 col�form�label">Expectations</label>                  
            <div class="col�sm�12 col�form�label" style="color:#737373;"><div style="border:2px solid black;padding: 10px;width: 562px;height: 100px;">&nbsp;&nbsp;<?php echo strlen�trim�$PartnerExpectation['Details']��> 0 ? trim�$PartnerExpectation['Details']� : "N/A "; ?></div></div>
        </div>
    </div>
  </div>
</div>
<div class="col�12 grid�margin">
  <div class="card">
    <div class="card�body">
    <div class="form�group row">
            <div class="col�sm�6"><h4 class="card�title">Communication Details</h4></div>
            <div class="col�sm�6" style="text�align:right"><a href="#">Edit</a></div>
         </div>
        <div class="form�group row">                                                   
            <label class="col�sm�2 col�form�label">Email ID</label>                    
            <label class="col�sm�9 col�form�label"style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen�trim�$ProfileInfo['EmailID']��> 0 ? trim�$ProfileInfo['EmailID']� : "N/A "; ?></label>
        </div>
        <div class="form�group row">
            <label class="col�sm�2 col�form�label">Mobile Number</label>               
            <label class="col�sm�3 col�form�label" style="color:#737373;">:&nbsp;&nbsp;<?php if��strlen�trim�$ProfileInfo['MobileNumber']���>0�{?><?php echo "+"; echo $ProfileInfo['MobileNumberCountryCode'];?>�<?php echo $ProfileInfo['MobileNumber'];?><?php  } else{ echo "N/A";}?></label>
            <label class="col�sm�2 col�form�label">Whatsapp Number</label>             
             <label class="col�sm�3 col�form�label" style="color:#737373;">:&nbsp;&nbsp;<?php if��strlen�trim�$ProfileInfo['WhatsappNumber']���>0�{?><?php echo "+"; echo $ProfileInfo['WhatsappCountryCode'];?>�<?php echo $ProfileInfo['WhatsappNumber'];?><?php  } else{ echo "N/A";}?></label>
        </div>
        <div class="form�group row">                                                                                
            <label class="col�sm�2 col�form�label">Address</label>                      
            <label class="col�sm�10 col�form�label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen�trim�$ProfileInfo['AddressLine1']��> 0 ? trim�$ProfileInfo['AddressLine1']� : "N/A "; ?> </label>
        </div>
        <?php if��strlen�trim�$ProfileInfo['AddressLine2']���>0�{?>
        <div class="form�group row">
            <label class="col�sm�2 col�form�label"></label>
            <label class="col�sm�10 col�form�label" style="color:#737373;">&nbsp;&nbsp; <?php echo $ProfileInfo['AddressLine2'];?></label>
        </div>
        <?php }  if��strlen�trim�$ProfileInfo['AddressLine3']���>0�{?>
        <div class="form�group row">
            <label class="col�sm�2 col�form�label"></label>                          
            <label class="col�sm�10 col�form�label" style="color:#737373;">&nbsp;&nbsp; <?php echo $ProfileInfo['AddressLine3'];?></label>
        </div>
        <?php }?>
        <div class="form�group row">
            <label class="col�sm�2 col�form�label">Pincode</label>                       
            <label class="col�sm�10 col�form�label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen�trim�$ProfileInfo['Pincode']��> 0 ? trim�$ProfileInfo['Pincode']� : "N/A "; ?></label>
        </div>
        <div class="form�group row">
            <label class="col�sm�2 col�form�label">City</label>                         
            <label class="col�sm�3 col�form�label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen�trim�$ProfileInfo['City']��> 0 ? trim�$ProfileInfo['City']� : "N/A "; ?></label>
            <label class="col�sm�2 col�form�label">Landmark</label>               
             <label class="col�sm�3 col�form�label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen�trim�$ProfileInfo['OtherLocation']��> 0 ? trim�$ProfileInfo['OtherLocation']� : "N/A "; ?></label>
        </div> 
        <div class="form�group row">
            <label class="col�sm�2 col�form�label">State</label>                       
            <label class="col�sm�3 col�form�label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen�trim�$ProfileInfo['State']��> 0 ? trim�$ProfileInfo['State']� : "N/A "; ?></label>
            <label class="col�sm�2 col�form�label">Country</label>                     
            <label class="col�sm�3 col�form�label" style="color:#737373;">:&nbsp;&nbsp;<?php echo strlen�trim�$ProfileInfo['Country']��> 0 ? trim�$ProfileInfo['Country']� : "N/A "; ?></label>
        </div> 
        <div class="form�group row">
            <label class="col�sm�2 col�form�label">Summary</label>                  
            <div class="col�sm�12 col�form�label" style="color:#737373;"><div style="border:2px solid black;padding: 10px;width: 562px;height: 100px;">&nbsp;&nbsp;<?php echo strlen�trim�$ProfileInfo['CommunicationDescription']��> 0 ? trim�$ProfileInfo['CommunicationDescription']� : "N/A "; ?></div></div>
        </div>
        </div>
    </div>
  </div>
<div class="col�12 grid�margin">
  <div class="card">                                                                                                        
    <div class="card�body">
    <div class="form�group row">
        <div class="col�sm�6"><h4 class="card�title">Attached Documents</h4></div>
        <div class="col�sm�6" style="text�align: right;"><h4 class="card�title" style="color:green">For Admnistrative Purpose only</h4><br>
            <a href="#">Edit</a>                    
        </div>
    </div>
    
        <div class="form�group row">
         <?php foreach�$response['data']['Documents'] as $Doc� {?>
                   <div class="Documentview">
                    <img src="<?php echo $Doc['AttachFileName'];?>" style="width: 200px;height:150px">   <br>
                    <label style="color:#737373;"><?php echo $Doc['DocumentType'];?></label> <br>
                    <label style="color:#737373;">verification pending</label>
                  </div>
                  <?php }?>
         </div>
    </div>
  </div>                                                                                                               
</div>

<div class="col�12 grid�margin">
  <div class="card">                                                                                                               
    <div class="card�body">
        <?php if�$ProfileInfo['RequestToVerify']=="0"�{?>
        <div class="form�group row">
            <label class="col�sm�2 col�form�label">Created On</label>
            <label class="col�sm�8 col�form�label" style="color:#737373;">:&nbsp;&nbsp;<?php echo PutDateTime�$ProfileInfo['CreatedOn']�;?></label>
        </div>
             <div class="form�group row">
                    <label class="col�sm�2 col�form�label">Last saved</label>
                    <label class="col�sm�8 col�form�label"  style="color:#888;">:&nbsp;&nbsp;<?php echo PutDateTime�$ProfileInfo['LastUpdatedOn']�;?></label>
             </div>
        <?php } else{?>
            <div class="form�group row">
            <label class="col�sm�2 col�form�label">Created On</label>
            <label class="col�sm�8 col�form�label" style="color:#737373;">:&nbsp;&nbsp;<?php echo PutDateTime�$ProfileInfo['CreatedOn']�;?></label>
             </div>
             <div class="form�group row">
                    <label class="col�sm�2 col�form�label">Puplished On</label>
                    <label class="col�sm�3 col�form�label"  style="color:#888;">:&nbsp;&nbsp;<?php echo PutDateTime�$ProfileInfo['RequestVerifyOn']�;?></label>
                   </div>
        <?php }?>
  </div>
</div>
</div>
</form>
 
            
               
 <div class="modal" id="PubplishNow" data�backdrop="static" style="padding�top:177px;padding�right:0px;background:rgba�9� 9� 9� 0�13� none repeat scroll 0% 0%;">
            <div class="modal�dialog" style="width: 367px;">
                <div class="modal�content" id="Publish_body" style="height:315px">
            
                </div>
            </div>
        </div>

<script>
function showConfirmPublish�ProfileID� {
      $�'#PubplishNow'��modal�'show'�; 
      var content = '<div class="Publish_body" style="padding:20px">'
                    +   '<div  style="height: 315px;">'                                                                              
                    +  '<form method="post" id="frm_'+ProfileID+'" name="frm_'+ProfileID+'" action="" >'
                     + '<input type="hidden" value="'+ProfileID+'" name="ProfileID">'
                          + '<button type="button" class="close" data�dismiss="modal">&times;</button>'
                        + '<h4 class="modal�title">Profile Publish</h4> <br>'
                        +'<div style="text�align:left"> Dear �<br>'
                        +'<div style="text�align:left">You have selected to "Publish Now"� In this action� your details will send to our Document Authentication Team �DAT�� DAT has approved your profile� the profile will pubhlish immediately� so please verify all data before publish�<br><br>'
                        + '<input type="checkbox" name="check" id="agreetopublish" onclick="agreeToPublish��;" value="1">&nbsp;<label for="check" style="font�weight:normal"> I agree the terms and conditions  </label><br><br>'
                        +  '<button type="button" disabled="disabled" class="btn btn�primary" name="Publish" id="PublishBtn"  onclick="VerifyProfileforPublish�\''+ProfileID+'\'�" style="font�family:roboto">Yes� send request</button>&nbsp;&nbsp;&nbsp;'
                        +  '<a data�dismiss="modal" style="color:#1d8fb9;cursor:pointer">No� i will do later</a>'
                       +  '</div><br>'
                    +  '</form>'                                                                                                          
                +  '</div>'
            +  '</div>';
            $�'#Publish_body'��html�content�;
}

function agreeToPublish�� {
    
    if�$�"#agreetopublish"��prop�"checked"� == true�{ 
        $�'#PublishBtn'��removeAttr�"Disabled"�;
    }
    
    if�$�"#agreetopublish"��prop�"checked"� == false�{
        $�'#PublishBtn'��attr�"Disabled"�"Disabled"�;
    }
}
function VerifyProfileforPublish�formid� {
     var param = $�"#frm_"+formid��serialize��;
     $�'#Publish_body'��html�preloader�;
        $�post�API_URL + "m=Franchisee&a=PublishMemberProfile"�param�function�result2� {$�'#Publish_body'��html�result2�;}�;
}
</script> 
   
                                                                                                                        
               
   
            
               