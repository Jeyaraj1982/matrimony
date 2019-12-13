<?php       
     
     class Shortlist {
         
         function AddToShortList($visitorsDetails,$Profiles,&$successMessage,&$errorMessage) {
              
              global $mysql,$global;
              
              $ProfileThumb = $mysql->select("select concat('".AppPath."uploads/',ProfilePhoto) as ProfilePhoto from `_tbl_profiles_photos` where `ProfileCode`='".$visitorsDetails[0]['ProfileCode']."' and `IsDelete`='0' and `MemberID`='".$visitorsDetails[0]['MemberID']."' and `PriorityFirst`='1'");
              if (sizeof($ProfileThumb)==0) {
                  $ProfileThumbnail = ($Profiles[0]['SexCode']=="SX002") ? AppPath.AppConfig::THUMB_DEFAULT_PROFILE_MALE : AppPath.AppConfig::THUMB_DEFAULT_PROFILE_FEMALE;
              } else {
                  $ProfileThumbnail = getDataURI($ProfileThumb[0]['ProfilePhoto']); 
              }
              
              $member = $mysql->select("select `MemberName`,`MemberID`,`EmailID`,`MobileNumber` from `_tbl_members` where `MemberID`='".$Profiles[0]['MemberID']."'");
              $FirstTime = $mysql->select("select `VisterMemberID` from `_tbl_profiles_shortlists` where `VisterMemberID`='".$visitorsDetails[0]['MemberID']."' limit 0,1");
            
              if(sizeof($FirstTime)==0) {
                       
                  if (AppConfig::FIRST_TIME_ADD_SHORTLIST_EMAIL_TO_PARTNER) {
                      
                      $mContent = $mysql->select("select Content,Title from `mailcontent` where `Category`='AddToShortListProfile'");
                      $content  = str_replace("#MemberName#",$member[0]['MemberName'],$mContent[0]['Content']);
                      $content  = str_replace("#ProfileCode#",$Profiles[0]['ProfileCode'],$content);
                      $content  = str_replace("#PersonName#",$Profiles[0]['PersonName'],$content);

                      MailController::Send(array("MailTo"   => $member[0]['EmailID'],
                                                 "Category" => "AddToShortListProfile",
                                                 "MemberID" => $member[0]['MemberID'],
                                                 "Subject"  => $mContent[0]['Title'],
                                                 "Message"  => $content),$mailError);
                  }
                        
                  if (AppConfig::FIRST_TIME_ADD_SHORTLIST_SMS_TO_PARTNER) {
                      MobileSMSController::sendSMS($member[0]['MobileNumber']," Dear ".$member[0]['MemberName'].",Your Profile (".$Profiles[0]['PersonName'].") has short listed. Your Profile ID is ".$Profiles[0]['ProfileCode']);
                  }
                 
             } else {
                
                 if (AppConfig::EVERY_TIME_ADD_SHORTLIST_EMAIL_TO_PARTNER) {
            
                     $mContent = $mysql->select("select Content,Title from `mailcontent` where `Category`='AddToShortListProfile'");
                     $content  = str_replace("#MemberName#",$member[0]['MemberName'],$mContent[0]['Content']);
                     $content  = str_replace("#ProfileCode#",$Profiles[0]['ProfileCode'],$content);
                     $content  = str_replace("#PersonName#",$Profiles[0]['PersonName'],$content);
                     
                     MailController::Send(array("MailTo"   => $member[0]['EmailID'],
                                                "Category" => "AddToShortListProfile",
                                                "MemberID" => $member[0]['MemberID'],
                                                "Subject"  => $mContent[0]['Title'],
                                                "Message"  => $content),$mailError);
                 }
                 
                 if (AppConfig::EVERY_TIME_ADD_SHORTLIST_SMS_TO_PARTNER){
                     MobileSMSController::sendSMS($member[0]['MobileNumber']," Dear ".$member[0]['MemberName'].",Your Profile (".$Profiles[0]['PersonName'].") has short listed. Your Profile ID is ".$Profiles[0]['ProfileCode']);
                 } 
             }
             
             $id = $mysql->insert("_tbl_profiles_shortlists",array("MemberID"           => $Profiles[0]['MemberID'],
                                                                   "ProfileID"          => $Profiles[0]['ProfileID'],
                                                                   "ProfileCode"        => $Profiles[0]['ProfileCode'],
                                                                   "VisterMemberID"     => $visitorsDetails[0]['MemberID'],
                                                                   "VisterProfileID"    => $visitorsDetails[0]['ProfileID'],
                                                                   "VisterProfileCode"  => $visitorsDetails[0]['ProfileCode'],
                                                                   "ViewedOn"           => date("Y-m-d H:i:s"),
                                                                   "IsShortList"        => "1",
                                                                   "IsVisible"          => "1",
                                                                   "IsShortListOn"      => date("Y-m-d H:i:s")));
                                                                   
             $mysql->insert("_tbl_latest_updates",array("MemberID"           => $Profiles[0]['MemberID'],
                                                        "ProfileID"          => $Profiles[0]['ProfileID'],
                                                        "ProfileCode"        => $Profiles[0]['ProfileCode'],
                                                        "VisterMemberID"     => $visitorsDetails[0]['MemberID'],
                                                        "VisterProfileID"    => $visitorsDetails[0]['ProfileID'],
                                                        "VisterProfileCode"  => $visitorsDetails[0]['ProfileCode'],
                                                        "ProfilePhoto"       => $ProfileThumbnail,
                                                        "Subject"            => "has short list your profile",
                                                        "ViewedOn"           => date("Y-m-d H:i:s")));
             return true;
         }
         
         function RemoveFromShortListed($Profile,$PartnerProfile,&$successMessage,&$errorMessage) {
             
         }
         
         function RemovedFromShortListed($ProfileCode) {
             
         }
         
         function ShortlistedProfiles($ProfileCode) {
             
         }
         
         // $command => Count, Listall
         function WhoShortlisted($ProfileCode,$command="Count") {
             
             global $mysql;
             if ($command=="Count") {
                 $result = $mysql->select("select count(*) as cnt from `_tbl_profiles_shortlists` where `IsVisible`='1' and `IsShortList` ='1' and  `ProfileCode`='".$ProfileCode."'");       
                 return (isset($result[0]['cnt'])) ? $result[0]['cnt'] : 0;    
            }
            
            if ($command=="Listall") {
                $result = $mysql->select("select * from `_tbl_profiles_shortlists` where `IsVisible`='1' and `IsShortList` ='1' and `ProfileCode`='".$ProfileCode."'");       
                return $result;    
            }
         }
         
     }
     
     
 ?>  