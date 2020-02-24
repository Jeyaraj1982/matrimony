<?php       
     
     class Interest {
         
         function SendToInterest($visitorsDetails,$Profiles,&$successMessage,&$errorMessage) {
              
              global $mysql,$global;
                                                                                                  
              $ProfileThumb = $mysql->select("select concat('".AppPath."uploads/profiles/".$visitorsDetails[0]['DraftProfileCode']."/thumb/',ProfilePhoto) as ProfilePhoto from `_tbl_profiles_photos` where `ProfileCode`='".$visitorsDetails[0]['ProfileCode']."' and `IsDelete`='0' and `MemberID`='".$visitorsDetails[0]['MemberID']."' and `PriorityFirst`='1'");
              if (sizeof($ProfileThumb)==0) {
                  $ProfileThumbnail = ($Profiles[0]['SexCode']=="SX002") ? AppPath.AppConfig::THUMB_DEFAULT_PROFILE_MALE : AppPath.AppConfig::THUMB_DEFAULT_PROFILE_FEMALE;
              } else {
                  $ProfileThumbnail = getDataURI($ProfileThumb[0]['ProfilePhoto']); 
              }
              $visitormember = $mysql->select("select `MemberName`,`MemberID`,`EmailID`,`MobileNumber` from `_tbl_members` where `MemberID`='".$visitorsDetails[0]['MemberID']."'");
              $member = $mysql->select("select `MemberName`,`MemberID`,`EmailID`,`MobileNumber` from `_tbl_members` where `MemberID`='".$Profiles[0]['MemberID']."'");
            
              $ProfilesD = $mysql->select("select * from `_tbl_profiles` where `MemberID`='".$visitormember[0]['MemberID']."'");
             /* foreach($ProfilesDs as $ProfilesD) {
                        $result = Profiles::getProfileInformation($ProfilesD['ProfileCode']);
                        $ProfilesD[]=$result; 
                     }         */
              $FirstTime = $mysql->select("select `VisterMemberID` from `_tbl_profiles_interests` where `VisterMemberID`='".$visitorsDetails[0]['MemberID']."' limit 0,1");

             $id = $mysql->insert("_tbl_profiles_interests",array("MemberID"           => $Profiles[0]['MemberID'],
                                                                   "ProfileID"          => $Profiles[0]['ProfileID'],
                                                                   "ProfileCode"        => $Profiles[0]['ProfileCode'],
                                                                   "VisterMemberID"     => $visitorsDetails[0]['MemberID'],
                                                                   "VisterProfileID"    => $visitorsDetails[0]['ProfileID'],                
                                                                   "VisterProfileCode"  => $visitorsDetails[0]['ProfileCode'],
                                                                   "ViewedOn"           => date("Y-m-d H:i:s"),
                                                                   "IsInterest"        => "1",
                                                                   "IsVisible"          => "1",
                                                                   "IsInterestOn"      => date("Y-m-d H:i:s")));
                                                                   
             $mysql->insert("_tbl_latest_updates",array("MemberID"           => $Profiles[0]['MemberID'],
                                                        "ProfileID"          => $Profiles[0]['ProfileID'],
                                                        "ProfileCode"        => $Profiles[0]['ProfileCode'],
                                                        "VisterMemberID"     => $visitorsDetails[0]['MemberID'],
                                                        "VisterProfileID"    => $visitorsDetails[0]['ProfileID'],
                                                        "VisterProfileCode"  => $visitorsDetails[0]['ProfileCode'],
                                                        "ProfilePhoto"       => $ProfileThumbnail,
                                                        "Subject"            => "has short list your profile",
                                                        "ViewedOn"           => date("Y-m-d H:i:s")));
             $mContent = $mysql->select("select * from `mailcontent` where `Category`='AddSentInterest'");
             $content  = str_replace("#MemberName#",$visitormember[0]['MemberName'],$mContent[0]['Content']);


             MailController::Send(array("MailTo"   => $visitormember[0]['EmailID'],
                                        "Category" => "AddSentInterest",
                                        "MemberID" => $visitormember[0]['MemberID'],
                                        "Subject"  => $mContent[0]['Title'],
                                        "Message"  => $content),$mailError);
             MobileSMSController::sendSMS($visitormember[0]['MobileNumber']," Dear ".$visitormember[0]['MemberName'].",<br>Your interest has been sent " ); 
            
             $mContent = $mysql->select("select * from `mailcontent` where `Category`='ReceiveInterest'");
             $content  = str_replace("#MemberName#",$member[0]['MemberName'],$mContent[0]['Content']);
             $content  = str_replace("#VisterMemberName#",$visitormember[0]['MemberName'],$content);
             
             $content .= '<div style="border:1px solid black">
                            <div style="border:1px solid red;">
                                <div style="background:yellow">
                                    <div style="border:1px solid blue">
                                        <div class="avatar avatar-xl">
                                            <img src="'.$ProfileThumbnail.'" alt="..." class="avatar-img rounded-circle">  <br><br><br>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="user-profile text-center">
                                        <div class="name">'.$ProfilesD[0]['ProfileName'].','.$ProfilesD[0]['Age'].' Yrs</div>
                                        <div class="job">'.$ProfilesD[0]['OccupationType'].'</div>
                                        <div class="desc">'.$ProfilesD[0]['AnnualIncome'].'</div>
                                        
                                        <div class="view-profile">
                                            <a href="'.AppPath.'ViewProfile/'.$ProfilesD[0]['ProfileCode'].'.htm?source=RecentlyWhoViewed" style="padding: .65rem 1.4rem;font-size: 14px;opacity: 1;border-radius: 3px;font-weight: 400;text-align: center;border: 1px solid transparent;transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;background:#6861CE !important;border-color:#6861CE !important;color:#fff;white-space: nowrap;">View Full Profile</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="row user-stats text-center">                                                   
                                        <div class="col">
                                            <div class="number">'.$response['data']['MyFavoritedCount'].'</div>
                                            <div class="title">Liked</div>
                                        </div>
                                        <div class="col">
                                            <div class="number">'.$response['data']['MyRecentlyViewedCount'].'</div>
                                            <div class="title">Viewed</div>
                                        </div>
                                        <div class="col">
                                            <div class="number">'.$response['data']['MyShortListedcount'].'</div>
                                            <div class="title">Short Listed</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>';

             MailController::Send(array("MailTo"   => $member[0]['EmailID'],
                                        "Category" => "ReceiveInterest",
                                        "MemberID" => $member[0]['MemberID'],
                                        "Subject"  => $mContent[0]['Title'],
                                        "Message"  => $content),$mailError);
            MobileSMSController::sendSMS($member[0]['MobileNumber']," Dear ".$member[0]['MemberName'].",<br>Receive interest from ".$visitormember[0]['MemberName']." " );  
             return true;
         }
         function ApproveInterest($visitorsDetails,$Profiles,&$successMessage,&$errorMessage) {
              
              global $mysql,$global;
              
              $mysql->execute("update `_tbl_profiles_interests` set `IsApproved`='1',`VerifiedOn` = '".date("Y-m-d H:i:s")."' where `VisterMemberID`='".$Profiles[0]['MemberID']."' and `MemberID`='".$visitorsDetails[0]['MemberID']."'");
             
             $visitormember = $mysql->select("select `MemberName`,`MemberID`,`EmailID`,`MobileNumber` from `_tbl_members` where `MemberID`='".$visitorsDetails[0]['MemberID']."'");
              $member = $mysql->select("select `MemberName`,`MemberID`,`EmailID`,`MobileNumber` from `_tbl_members` where `MemberID`='".$Profiles[0]['MemberID']."'");
             
             $mContent = $mysql->select("select * from `mailcontent` where `Category`='ApproveInterest'");
             $content  = str_replace("#MemberName#",$member[0]['MemberName'],$mContent[0]['Content']);
             $content  = str_replace("#ProfileCode#",$visitorsDetails[0]['ProfileCode'],$content);


             MailController::Send(array("MailTo"   => $member[0]['EmailID'],
                                        "Category" => "ApproveInterest",
                                        "MemberID" => $member[0]['MemberID'],
                                        "Subject"  => $mContent[0]['Title'],
                                        "Message"  => $content),$mailError);
             MobileSMSController::sendSMS($member[0]['MobileNumber']," Dear ".$member[0]['MemberName'].",<br>Your sent interest ".$visitorsDetails[0]['ProfileCode']." has been approved " ); 
             
             $mContent = $mysql->select("select * from `mailcontent` where `Category`='ApproveSentInterest'");
             $content  = str_replace("#MemberName#",$visitormember[0]['MemberName'],$mContent[0]['Content']);
             $content  = str_replace("#ProfileCode#",$Profiles[0]['ProfileCode'],$content);


             MailController::Send(array("MailTo"   => $visitormember[0]['EmailID'],
                                        "Category" => "ApproveSentInterest",
                                        "MemberID" => $visitormember[0]['MemberID'],
                                        "Subject"  => $mContent[0]['Title'],
                                        "Message"  => $content),$mailError);
             MobileSMSController::sendSMS($visitormember[0]['MobileNumber']," Dear ".$visitormember[0]['MemberName'].",<br>You approved receiving (".$Profiles[0]['ProfileCode']." ) interest " ); 
             return true;
         }
         function RejectInterest($visitorsDetails,$Profiles,&$successMessage,&$errorMessage) {
              
              global $mysql,$global;
              
              $mysql->execute("update `_tbl_profiles_interests` set `Isrejected`='1',`VerifiedOn` = '".date("Y-m-d H:i:s")."' where `VisterMemberID`='".$Profiles[0]['MemberID']."' and `MemberID`='".$visitorsDetails[0]['MemberID']."'");
           
              $visitormember = $mysql->select("select `MemberName`,`MemberID`,`EmailID`,`MobileNumber` from `_tbl_members` where `MemberID`='".$visitorsDetails[0]['MemberID']."'");
              $member = $mysql->select("select `MemberName`,`MemberID`,`EmailID`,`MobileNumber` from `_tbl_members` where `MemberID`='".$Profiles[0]['MemberID']."'");
             
             $mContent = $mysql->select("select * from `mailcontent` where `Category`='RejectInterest'");
             $content  = str_replace("#MemberName#",$member[0]['MemberName'],$mContent[0]['Content']);
             $content  = str_replace("#ProfileCode#",$visitorsDetails[0]['ProfileCode'],$content);


             MailController::Send(array("MailTo"   => $member[0]['EmailID'],
                                        "Category" => "RejectInterest",
                                        "MemberID" => $member[0]['MemberID'],
                                        "Subject"  => $mContent[0]['Title'],
                                        "Message"  => $content),$mailError);
             MobileSMSController::sendSMS($member[0]['MobileNumber']," Dear ".$member[0]['MemberName'].",<br>Your sent interest ".$visitorsDetails[0]['ProfileCode']." has been rejected " ); 
            
             $mContent = $mysql->select("select * from `mailcontent` where `Category`='RejectSentInterest'");
             $content  = str_replace("#MemberName#",$visitormember[0]['MemberName'],$mContent[0]['Content']);
             $content  = str_replace("#ProfileCode#",$Profiles[0]['ProfileCode'],$content);


             MailController::Send(array("MailTo"   => $visitormember[0]['EmailID'],
                                        "Category" => "RejectSentInterest",
                                        "MemberID" => $visitormember[0]['MemberID'],
                                        "Subject"  => $mContent[0]['Title'],
                                        "Message"  => $content),$mailError);
             MobileSMSController::sendSMS($visitormember[0]['MobileNumber']," Dear ".$visitormember[0]['MemberName'].",<br>You reject receiving (".$Profiles[0]['ProfileCode']." ) interest " ); 
          
             return true;
         }
     }
     
     
 ?>  