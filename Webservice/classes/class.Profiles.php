<?php 
    class Profiles {
        
        /* Need to check this function need or not */
        static public function getProfileInformation($ProfileCode) {
            
            global $mysql,$loginInfo;  
                
            $Profiles = $mysql->select("select * from `_tbl_profiles` where `MemberID`='".$loginInfo[0]['MemberID']."' and ProfileCode='".$ProfileCode."'");               
            if (sizeof($Profiles)==0) {
                return "Requested profile information not found";
            }
             if (sizeof($Profiles)>1) {
                return "Requested profile may be unauthorized.";
            }
            $lastseen = $mysql->select("select * from `_tbl_profiles_lastseen` where ProfileID='".$Profiles[0]['ProfileID']."' order by LastSeenID desc limit 0,1");
            
           /* 
           Need to be explain :
           $id = $mysql->insert("_tbl_profiles_lastseen", array("LastSeen"     => date("Y-m-d H:i:s"),
                                                                 "LastSeenBy"   => $loginInfo[0]['MemberID'],
                                                                 "ProfileID"    => $Profiles[0]['ProfileID'],
                                                                 "MemberID"     => $loginInfo[0]['MemberID'],
                                                                 "FranchiseeID" => "0",
                                                                 "AdminID"      => "0"));*/
            
            $members = $mysql->select("select * from `_tbl_members` where `MemberID`='".$Profiles[0]['MemberID']."'");     
            $PartnersExpectations = $mysql->select("select * from `_tbl_profiles_partnerexpectation` where `ProfileID`='".$Profiles[0]['ProfileID']."'");
            $Documents = $mysql->select("select concat('".AppPath."uploads/',AttachFileName) as AttachFileName,DocumentType as DocumentType from `_tbl_profiles_verificationdocs` where `MemberID`='".$loginInfo[0]['MemberID']."' and `IsDelete`='0' and `Type`!='EducationDetails' and ProfileCode='".$ProfileCode."'");
            $Educationattachments = $mysql->select("select * from `_tbl_profiles_education_details` where `MemberID`='".$loginInfo[0]['MemberID']."' and ProfileID='".$Profiles[0]['ProfileID']."' and `IsDeleted`='0'");            
            
            $ProfilePhotos = $mysql->select("select concat('".AppPath."uploads/',ProfilePhoto) as ProfilePhoto  from `_tbl_profiles_photos` where  `ProfileID`='".$Profiles[0]['ProfileID']."' and `MemberID`='".$loginInfo[0]['MemberID']."' and `IsDelete`='0' and `PriorityFirst`='0'");                                        
            if (sizeof($ProfilePhotos)<4) {
                for($i=sizeof($ProfilePhotos);$i<4;$i++) {                                                                                                                                       
                    if ($Profiles[0]['SexCode']=="SX002"){
                        $ProfilePhotos[$i]['ProfilePhoto'] = AppPath."assets/images/noprofile_female.png";
                    } else {
                        $ProfilePhotos[$i]['ProfilePhoto'] = AppPath."assets/images/noprofile_male.png";                                                                         
                    }
                }  
            }
            
            $ProfileThumb = $mysql->select("select concat('".AppPath."uploads/',ProfilePhoto) as ProfilePhoto from `_tbl_profiles_photos` where   `ProfileCode`='".$ProfileCode."' and `IsDelete`='0' and `MemberID`='".$loginInfo[0]['MemberID']."' and `PriorityFirst`='1'");
            if (sizeof($ProfileThumb)==0) {
                if ($Profiles[0]['SexCode']=="SX002"){
                    $ProfileThumbnail = AppPath."assets/images/noprofile_female.png";
                } else { 
                    $ProfileThumbnail = AppPath."assets/images/noprofile_male.png";
                }
            } else {
                 $ProfileThumbnail = $ProfileThumb[0]['ProfilePhoto'];                                              
            } 
            
            if ($Profiles[0]['RequestToVerify']==0) {
                $Position = "Drafted";
            }
            if ($Profiles[0]['RequestToVerify']==1) {
                $Position = "Posted Requested to verifiy";
            }
            if ($Profiles[0]['IsApproved']==1) {
                $Position = "Published";
            }
            $Profiles[0]['Age'] =  date("Y")-date("Y",strtotime($Profiles[0]['DateofBirth']));
             /* 
           Need to be explain :
             $id = $mysql->insert("_tbl_draft_profiles_lastseen", array("LastSeen"     => date("Y-m-d H:i:s"),
                                                                      "LastSeenBy"   => $loginInfo[0]['MemberID'],
                                                                      "ProfileID"    => $Profiles[0]['ProfileID'],
                                                                      "MemberID"     => $loginInfo[0]['MemberID'],
                                                                      "FranchiseeID" => "0",
                                                                      "AdminID"      => "0"));
            */                                                          
            return array("ProfileInfo"          => $Profiles[0],
                            "Position"             => $Position,
                            "LastSeen"             => (isset($lastseen[0]['LastSeen']) ? $lastseen[0]['LastSeen'] : 0),
                            "Members"              => $members[0],
                            "EducationAttachments" => $Educationattachments,
                            "Documents"            => $Documents,
                            "PartnerExpectation"   => $PartnersExpectations[0],
                            "ProfilePhotos"        => $ProfilePhotos,  /*array*/
                            "ProfileThumb"         => $ProfileThumbnail);
        }
        
        public function getDraftProfileInformationforAdmin($ProfileCode) {
            
            global $mysql,$loginInfo;  
                
            $Profiles = $mysql->select("select * from `_tbl_draft_profiles` where ProfileCode='".$ProfileCode."'");               
            $lastseen = $mysql->select("select * from `_tbl_draft_profiles_lastseen` where ProfileID='".$Profiles[0]['ProfileID']."' order by LastSeenID desc limit 0,1");
            
            $id = $mysql->insert("_tbl_draft_profiles_lastseen", array("LastSeen"     => date("Y-m-d H:i:s"),
                                                                       "LastSeenBy"   => $loginInfo[0]['AdminID'],
                                                                       "ProfileID"    => $Profiles[0]['ProfileID'],
                                                                       "MemberID"     => $Profiles[0]['MemberID'],
                                                                       "FranchiseeID" => "0",
                                                                       "AdminID"      => $loginInfo[0]['AdminID'] ));
            
            $members = $mysql->select("select * from `_tbl_members` where `MemberID`='".$Profiles[0]['MemberID']."'");     
            $PartnersExpectations = $mysql->select("select * from `_tbl_draft_profiles_partnerexpectation` where `ProfileID`='".$Profiles[0]['ProfileID']."'");
            $Documents = $mysql->select("select concat('".AppPath."uploads/',AttachFileName) as AttachFileName,DocumentType as DocumentType from `_tbl_draft_profiles_verificationdocs` where `MemberID`='".$Profiles[0]['MemberID']."' and `IsDelete`='0' and `Type`!='EducationDetails' and ProfileCode='".$ProfileCode."'");
            $Educationattachments = $mysql->select("select * from `_tbl_draft_profiles_education_details` where `MemberID`='".$Profiles[0]['MemberID']."' and `IsDelete`='0' and ProfileID='".$Profiles[0]['ProfileID']."'");            
            
            $ProfilePhotos = $mysql->select("select concat('".AppPath."uploads/',ProfilePhoto) as ProfilePhoto  from `_tbl_draft_profiles_photos` where  `ProfileCode`='".$ProfileCode."' and `MemberID`='".$Profiles[0]['MemberID']."' and `IsDelete`='0' and `PriorityFirst`='0'");                                        
            if (sizeof($ProfilePhotos)<4) {
                for($i=sizeof($ProfilePhotos);$i<4;$i++) {
                    $ProfilePhotos[$i]['ProfilePhoto'] = ($Profiles[0]['SexCode']=="SX002") ?  AppPath."assets/images/noprofile_female.png" : AppPath."assets/images/noprofile_male.png";
                }  
            }
            
            $ProfileThumb = $mysql->select("select concat('".AppPath."uploads/',ProfilePhoto) as ProfilePhoto from `_tbl_draft_profiles_photos` where `ProfileCode`='".$ProfileCode."' and `MemberID`='".$Profiles[0]['MemberID']."' and `IsDelete`='0' and `PriorityFirst`='1'");
            if (sizeof($ProfileThumb)==0) {
                $ProfileThumbnail = ($Profiles[0]['SexCode']=="SX002") ?  AppPath."assets/images/noprofile_female.png" :  AppPath."assets/images/noprofile_male.png";
            } else {
                 $ProfileThumbnail = $ProfileThumb[0]['ProfilePhoto'];                                              
            } 
            
            if ($Profiles[0]['RequestToVerify']==0) {
                $Position = "Drafted";
            }
            if ($Profiles[0]['RequestToVerify']==1) {
                $Position = "Posted Requested to verifiy";
            }
            if ($Profiles[0]['IsApproved']==1) {
                $Position = "Publish";
            }
            
             $Profiles[0]['Age'] =  date("Y")-date("Y",strtotime($Profiles[0]['DateofBirth']));
             $id = $mysql->insert("_tbl_draft_profiles_lastseen", array("LastSeen"     => date("Y-m-d H:i:s"),
                                                                        "LastSeenBy"   => $loginInfo[0]['AdminID'],
                                                                        "ProfileID"    => $Profiles[0]['ProfileID'],
                                                                        "MemberID"     => "0",
                                                                        "FranchiseeID" => "0",
                                                                        "AdminID"      => $loginInfo[0][AdminID]));
                                                                      
            $result = array("ProfileInfo"          => $Profiles[0],
                            "Position"             => $Position,
                            "LastSeen"             => (isset($lastseen[0]['LastSeen']) ? $lastseen[0]['LastSeen'] : 0),
                            "Members"              => $members[0],
                            "EducationAttachments" => $Educationattachments,
                            "Documents"            => $Documents,
                            "PartnerExpectation"   => $PartnersExpectations[0],
                            "ProfilePhotos"        => $ProfilePhotos,  /*array*/
                            "ProfileThumb"         => $ProfileThumbnail);
            return  $result;
        }
        
        public function getProfileInformationforAdmin($ProfileCode) {
            
            global $mysql,$loginInfo;  
                
            $Profiles = $mysql->select("select * from `_tbl_profiles` where ProfileCode='".$ProfileCode."'");               
            $lastseen = $mysql->select("select * from `_tbl_profiles_lastseen` where ProfileID='".$Profiles[0]['ProfileID']."' order by LastSeenID desc limit 0,1");
            
            $id = $mysql->insert("_tbl_profiles_lastseen", array("LastSeen"     => date("Y-m-d H:i:s"),
                                                                 "LastSeenBy"   => $loginInfo[0]['AdminID'],
                                                                 "ProfileID"    => $Profiles[0]['ProfileID'],
                                                                 "MemberID"     => "0",
                                                                 "FranchiseeID" => "0",
                                                                 "AdminID"      => $loginInfo[0]['AdminID']));
            
            $members = $mysql->select("select * from `_tbl_members` where `MemberID`='".$Profiles[0]['MemberID']."'");     
            $PartnersExpectations = $mysql->select("select * from `_tbl_profiles_partnerexpectation` where `ProfileID`='".$Profiles[0]['ProfileID']."'");
            $Documents = $mysql->select("select concat('".AppPath."uploads/',AttachFileName) as AttachFileName,DocumentType as DocumentType from `_tbl_profiles_verificationdocs` where `MemberID`='".$Profiles[0]['MemberID']."' and `IsDelete`='0' and `Type`!='EducationDetails' and ProfileCode='".$ProfileCode."'");
            $Educationattachments = $mysql->select("select * from `_tbl_profiles_education_details` where `MemberID`='".$Profiles[0]['MemberID']."' and ProfileID='".$Profiles[0]['ProfileID']."'");            
            
            $ProfilePhotos = $mysql->select("select concat('".AppPath."uploads/',ProfilePhoto) as ProfilePhoto  from `_tbl_profiles_photos` where  `ProfileID`='".$Profiles[0]['ProfileID']."' and `MemberID`='".$Profiles[0]['MemberID']."' and `PriorityFirst`='0'");                                        
            if (sizeof($ProfilePhotos)<4) {
                for($i=sizeof($ProfilePhotos);$i<4;$i++) {
                    if ($Profiles[0]['SexCode']=="SX002"){
                        $ProfilePhotos[$i]['ProfilePhoto'] = AppPath."assets/images/noprofile_female.png";
                    } else {
                        $ProfilePhotos[$i]['ProfilePhoto'] = AppPath."assets/images/noprofile_male.png";
                    }
                }  
            }
            $ProfileThumb = $mysql->select("select concat('".AppPath."uploads/',ProfilePhoto) as ProfilePhoto from `_tbl_profiles_photos` where   `ProfileCode`='".$ProfileCode."' and `MemberID`='".$Profiles[0]['MemberID']."' and `PriorityFirst`='1'");
            if (sizeof($ProfileThumb)==0) {
                if ($Profiles[0]['SexCode']=="SX002"){
                    $ProfileThumbnail = AppPath."assets/images/noprofile_female.png";
                } else { 
                    $ProfileThumbnail = AppPath."assets/images/noprofile_male.png";
                }
            } else {
                 $ProfileThumbnail = $ProfileThumb[0]['ProfilePhoto'];                                              
            } 
            
            if ($Profiles[0]['RequestToVerify']==0) {
                $Position = "Drafted";
            }
            if ($Profiles[0]['RequestToVerify']==1) {
                $Position = "Posted Requested to verifiy";
            }
            if ($Profiles[0]['IsApproved']==1) {
                $Position = "Published";
            }
            
             $id = $mysql->insert("_tbl_draft_profiles_lastseen", array("LastSeen"     => date("Y-m-d H:i:s"),
                                                                      "LastSeenBy"   => $loginInfo[0]['AdminID'],
                                                                      "ProfileID"    => $Profiles[0]['ProfileID'],
                                                                      "MemberID"     => "",
                                                                      "FranchiseeID" => "0",
                                                                      "AdminID"      => $loginInfo[0]['AdminID']));
                                                                      
            $result = array("ProfileInfo"          => $Profiles[0],
                            "Position"             => $Position,
                            "LastSeen"             => (isset($lastseen[0]['LastSeen']) ? $lastseen[0]['LastSeen'] : 0),
                            "Members"              => $members[0],
                            "EducationAttachments" => $Educationattachments,
                            "Documents"            => $Documents,
                            "PartnerExpectation"   => $PartnersExpectations[0],
                            "ProfilePhotos"        => $ProfilePhotos,  /*array*/
                            "ProfileThumb"         => $ProfileThumbnail);
            
            return  $result;
        }
        
        public function getDownloadProfileInformation($ProfileCode) {
            
            global $mysql,$loginInfo;  
                
            $Profiles = $mysql->select("select * from `_tbl_profiles` where ProfileCode='".$ProfileCode."'");               
            $lastseen = $mysql->select("select * from `_tbl_profiles_lastseen` where ProfileID='".$Profiles[0]['ProfileID']."' order by LastSeenID desc limit 0,1");
           
               $id = $mysql->insert("_tbl_profiles_lastseen", array("LastSeen"     => date("Y-m-d H:i:s"),
                                                                      "LastSeenBy"   => $loginInfo[0]['MemberID'],
                                                                      "ProfileID"    => $Profiles[0]['ProfileID'],
                                                                      "MemberID"     => $Profiles[0]['MemberID'],
                                                                      "FranchiseeID" => "0",
                                                                      "AdminID"      => "0"));
            
            $members = $mysql->select("select * from `_tbl_members` where `MemberID`='".$Profiles[0]['MemberID']."'");     
            $PartnersExpectations = $mysql->select("select * from `_tbl_profiles_partnerexpectation` where `ProfileID`='".$Profiles[0]['ProfileID']."'");
            $Documents = $mysql->select("select concat('".AppPath."uploads/',AttachFileName) as AttachFileName,DocumentType as DocumentType from `_tbl_profiles_verificationdocs` where `MemberID`='".$Profiles[0]['MemberID']."' and `IsDelete`='0' and `Type`!='EducationDetails' and ProfileCode='".$ProfileCode."'");
            $Educationattachments = $mysql->select("select * from `_tbl_profiles_education_details` where `MemberID`='".$Profiles[0]['MemberID']."' and `IsDeleted`='0' and ProfileCode='".$Profiles[0]['ProfileCode']."'");            
            
            $ProfilePhotos = $mysql->select("select concat('".AppPath."uploads/',ProfilePhoto) as ProfilePhoto  from `_tbl_profiles_photos` where  `ProfileID`='".$Profiles[0]['ProfileID']."' and `MemberID`='".$Profiles[0]['MemberID']."' and `IsDelete`='0' and `PriorityFirst`='0'");                                        
            if (sizeof($ProfilePhotos)<4) {
                for($i=sizeof($ProfilePhotos);$i<4;$i++) {
                    if ($Profiles[0]['SexCode']=="SX002"){
                        $ProfilePhotos[$i]['ProfilePhoto'] = AppPath."assets/images/noprofile_female.png";
                    } else {
                        $ProfilePhotos[$i]['ProfilePhoto'] = AppPath."assets/images/noprofile_male.png";
                    }
                }  
            }
            $ProfileThumb = $mysql->select("select concat('".AppPath."uploads/',ProfilePhoto) as ProfilePhoto from `_tbl_profiles_photos` where   `ProfileCode`='".$ProfileCode."' and `MemberID`='".$Profiles[0]['MemberID']."' and `IsDelete`='0' and `PriorityFirst`='1'");
            if (sizeof($ProfileThumb)==0) {
                if ($Profiles[0]['SexCode']=="SX002"){
                    $ProfileThumbnail = AppPath."assets/images/noprofile_female.png";
                } else { 
                    $ProfileThumbnail = AppPath."assets/images/noprofile_male.png";
                }
            } else {
                 $ProfileThumbnail = $ProfileThumb[0]['ProfilePhoto'];                                              
            } 
            
            if ($Profiles[0]['RequestToVerify']==0) {
                $Position = "Drafted";
            }
            if ($Profiles[0]['RequestToVerify']==1) {
                $Position = "Posted Requested to verifiy";
            }
            if ($Profiles[0]['IsApproved']==1) {
                $Position = "Published";
            }
            
             $id = $mysql->insert("_tbl_draft_profiles_lastseen", array("LastSeen"     => date("Y-m-d H:i:s"),
                                                                      "LastSeenBy"   => $loginInfo[0]['MemberID'],
                                                                      "ProfileID"    => $Profiles[0]['ProfileID'],
                                                                      "MemberID"     => $loginInfo[0]['MemberID'],
                                                                      "FranchiseeID" => "0",
                                                                      "AdminID"      => "0"));
                                                                      
            $result = array("ProfileInfo"          => $Profiles[0],
                            "Position"             => $Position,
                            "LastSeen"             => (isset($lastseen[0]['LastSeen']) ? $lastseen[0]['LastSeen'] : 0),
                            "Members"              => $members[0],
                            "EducationAttachments" => $Educationattachments,
                            "Documents"            => $Documents,
                            "PartnerExpectation"   => $PartnersExpectations[0],
                            "ProfilePhotos"        => $ProfilePhotos,  /*array*/
                            "ProfileThumb"         => $ProfileThumbnail);
            
            return  $result;
        }
        
        public function getRecentlyViewdProfileInformation($ProfileCode,$IsOther=0) {
            
            global $mysql,$loginInfo;  
                
            if ($IsOther==0)  {
                $Profiles = $mysql->select("select * from `_tbl_profiles` where `MemberID`='".$loginInfo[0]['MemberID']."' and ProfileCode='".$ProfileCode."'");               
                $PartnersExpectations = $mysql->select("select * from `_tbl_profiles_partnerexpectation` where `ProfileID`='".$Profiles[0]['ProfileID']."'");
                $Documents = $mysql->select("select concat('".AppPath."uploads/',AttachFileName) as AttachFileName,DocumentType as DocumentType from `_tbl_profiles_verificationdocs` where `MemberID`='".$loginInfo[0]['MemberID']."' and `IsDelete`='0' and `Type`!='EducationDetails' and ProfileCode='".$ProfileCode."'");
                $Educationattachments = $mysql->select("select * from `_tbl_profiles_education_details` where `MemberID`='".$loginInfo[0]['MemberID']."' and `IsDeleted`='0' ProfileID='".$Profiles[0]['ProfileID']."'");            
            } else {
                $Profiles = $mysql->select("select * from `_tbl_profiles` where ProfileCode='".$ProfileCode."'");               
                $PartnersExpectations = $mysql->select("select * from `_tbl_profiles_partnerexpectation` where `ProfileCode`='".$ProfileCode."'");
                $Documents = $mysql->select("select concat('".AppPath."uploads/',AttachFileName) as AttachFileName,DocumentType as DocumentType from `_tbl_profiles_verificationdocs` where `IsDelete`='0' and `Type`!='EducationDetails' and ProfileCode='".$ProfileCode."'");
                $Educationattachments = $mysql->select("select * from `_tbl_profiles_education_details` where  ProfileCode='".$ProfileCode."' and `IsDeleted`='0'");            
            }
            
            $lastseen = $mysql->select("select * from `_tbl_profiles_lastseen` where ProfileID='".$Profiles[0]['ProfileID']."' order by LastSeenID desc limit 0,1");
            $members = $mysql->select("select * from `_tbl_members` where `MemberID`='".$Profiles[0]['MemberID']."'");     
                 
            $ProfilePhotos = $mysql->select("select concat('".AppPath."uploads/',ProfilePhoto) as ProfilePhoto  from `_tbl_profiles_photos` where  `ProfileID`='".$Profiles[0]['ProfileID']."' and `MemberID`='".$loginInfo[0]['MemberID']."' and `IsDelete`='0' and `PriorityFirst`='0'");                                        
            if (sizeof($ProfilePhotos)<4) {
                for($i=sizeof($ProfilePhotos);$i<4;$i++) {
                    if ($Profiles[0]['SexCode']=="SX002"){
                        $ProfilePhotos[$i]['ProfilePhoto'] = AppPath."assets/images/noprofile_female.png";
                    } else {
                        $ProfilePhotos[$i]['ProfilePhoto'] = AppPath."assets/images/noprofile_male.png";
                    }
                }  
            }
             
            $ProfileThumb = $mysql->select("select concat('".AppPath."uploads/',ProfilePhoto) as ProfilePhoto from `_tbl_profiles_photos` where   `ProfileCode`='".$ProfileCode."' and `IsDelete`='0' and `MemberID`='".$loginInfo[0]['MemberID']."' and `PriorityFirst`='1'");
            if (sizeof($ProfileThumb)==0) {
                if ($Profiles[0]['SexCode']=="SX002"){
                    $ProfileThumbnail = AppPath."assets/images/noprofile_female.png";
                } else { 
                    $ProfileThumbnail = AppPath."assets/images/noprofile_male.png";
                }
            } else {
                 $ProfileThumbnail = $ProfileThumb[0]['ProfilePhoto'];                                              
            } 
            
            $Position = "Published";
            
            $result = array("ProfileInfo"          => $Profiles[0],
                            "Position"             => $Position,
                            "LastSeen"             => (isset($lastseen[0]['LastSeen']) ? $lastseen[0]['LastSeen'] : 0),
                            "Members"              => $members[0],
                            "EducationAttachments" => $Educationattachments,
                            "Documents"            => $Documents,
                            "PartnerExpectation"   => $PartnersExpectations[0],
                            "ProfilePhotos"        => $ProfilePhotos,  /*array*/
                            "ProfileThumb"         => $ProfileThumbnail);
            return  $result;
                                                                                                           
        }
        
        public function MyActiveProfile() {
              
              global $mysql,$loginInfo;  
              $Profiles = $mysql->select("select * from `_tbl_profiles` where `MemberID`='".$loginInfo[0]['MemberID']."'");               
              return $profiles[0];
              
          }
        
        /* fixed */
        //$IsOther => 0 member, 2 franchisee, 3 admin
        public function getDraftProfileInformation($ProfileCode,$IsOther=0) {
            
            global $mysql,$loginInfo;  
            if ($IsOther==0)  {
                $Profiles = $mysql->select("select * from `_tbl_draft_profiles` where `MemberID`='".$loginInfo[0]['MemberID']."' and ProfileCode='".$ProfileCode."'");               
                $PartnersExpectations = $mysql->select("select * from `_tbl_draft_profiles_partnerexpectation` where `ProfileID`='".$Profiles[0]['ProfileID']."'");
                $Documents = $mysql->select("select concat('".AppPath."uploads/',AttachFileName) as AttachFileName,DocumentType as DocumentType from `_tbl_draft_profiles_verificationdocs` where `MemberID`='".$loginInfo[0]['MemberID']."' and `IsDelete`='0' and `Type`!='EducationDetails' and ProfileCode='".$ProfileCode."'");
                $Educationattachments = $mysql->select("select * from `_tbl_draft_profiles_education_details` where `IsDelete`='0' and ProfileID='".$Profiles[0]['ProfileID']."'");            
                $ProfileThumb = $mysql->select("select concat('".AppPath."uploads/',ProfilePhoto) as ProfilePhoto from `_tbl_draft_profiles_photos` where   `ProfileCode`='".$ProfileCode."' and `IsDelete`='0' and `PriorityFirst`='1'");
                $ProfilePhotos = $mysql->select("select concat('".AppPath."uploads/',ProfilePhoto) as ProfilePhoto  from `_tbl_draft_profiles_photos` where  `ProfileCode`='".$ProfileCode."' and `MemberID`='".$loginInfo[0]['MemberID']."' and `IsDelete`='0' and `PriorityFirst`='0'");                                        
            } else {   
                $Profiles = $mysql->select("select * from `_tbl_draft_profiles` where ProfileCode='".$ProfileCode."'");               
                $PartnersExpectations = $mysql->select("select * from `_tbl_draft_profiles_partnerexpectation` where `ProfileCode`='".$ProfileCode."'");
                $Documents = $mysql->select("select concat('".AppPath."uploads/',AttachFileName) as AttachFileName,DocumentType as DocumentType from `_tbl_draft_profiles_verificationdocs` where `IsDelete`='0' and `Type`!='EducationDetails' and ProfileCode='".$ProfileCode."'");
                $Educationattachments = $mysql->select("select * from `_tbl_draft_profiles_education_details` where  ProfileCode='".$ProfileCode."' and `IsDelete`='0'");            
                $ProfileThumb = $mysql->select("select concat('".AppPath."uploads/',ProfilePhoto) as ProfilePhoto from `_tbl_draft_profiles_photos` where `ProfileCode`='".$ProfileCode."' and `IsDelete`='0' and `PriorityFirst`='1'");
                $ProfilePhotos = $mysql->select("select concat('".AppPath."uploads/',ProfilePhoto) as ProfilePhoto  from `_tbl_draft_profiles_photos` where  `ProfileID`='".$Profiles[0]['ProfileID']."' and `IsDelete`='0' and `PriorityFirst`='0'");                                        
            }
            
            if (sizeof($Profiles)==0) {
                return array();
            }
            
            if (sizeof($ProfilePhotos)<4) {
                for($i=sizeof($ProfilePhotos);$i<4;$i++) {
                    if ($Profiles[0]['SexCode']=="SX002"){
                        $ProfilePhotos[$i]['ProfilePhoto'] = AppPath."assets/images/noprofile_female.png";
                    } else {
                        $ProfilePhotos[$i]['ProfilePhoto'] = AppPath."assets/images/noprofile_male.png";
                    }
                }  
            }
            
            $ProfileThumb = $mysql->select("select concat('".AppPath."uploads/',ProfilePhoto) as ProfilePhoto from `_tbl_draft_profiles_photos` where `ProfileCode`='".$ProfileCode."' and `IsDelete`='0' and `PriorityFirst`='1'");
            if (sizeof($ProfileThumb)==0) {
                if ($Profiles[0]['SexCode']=="SX002"){
                    $ProfileThumbnail = AppPath."assets/images/noprofile_female.png";
                } else { 
                    $ProfileThumbnail = AppPath."assets/images/noprofile_male.png";
                }
            } else {
                 $ProfileThumbnail = getDataURI($ProfileThumb[0]['ProfilePhoto']);                                              
            } 
               
            if ($Profiles[0]['RequestToVerify']==0) {
                $Position = "Drafted";
            }
            if ($Profiles[0]['RequestToVerify']==1) {
                $Position = "Posted Requested to verifiy";
            }
            if ($Profiles[0]['IsApproved']==1) {
                $Position = "Publish";
            }
            
            $Profiles[0]['Age'] =  date("Y")-date("Y",strtotime($Profiles[0]['DateofBirth']));
             
            $result = array("ProfileInfo"          => $Profiles[0],
                            "Position"             => $Position,
                            "EducationAttachments" => $Educationattachments,
                            "Documents"            => $Documents,
                            "PartnerExpectation"   => isset($PartnersExpectations[0]) ? $PartnersExpectations[0] : array(),
                            "ProfilePhotos"        => $ProfilePhotos,  /*array*/
                            "ProfileThumb"         => $ProfileThumbnail);
            
            return  $result;
        }
        
        public function getProfileInfo($ProfileCode,$IsOther=0,$myrecentviewed=1) {
            
            global $mysql,$loginInfo;
            
            $lastseen    = array();
            $isFavourite = array();
            $isMutured   = array();  
                
            if ($IsOther==0)  {
                $Profiles = $mysql->select("select * from `_tbl_profiles` where `MemberID`='".$loginInfo[0]['MemberID']."' and ProfileCode='".$ProfileCode."'");               
                $PartnersExpectations = $mysql->select("select * from `_tbl_profiles_partnerexpectation` where `ProfileID`='".$Profiles[0]['ProfileID']."'");
                $Documents = $mysql->select("select concat('".AppPath."uploads/',AttachFileName) as AttachFileName,DocumentType as DocumentType from `_tbl_profiles_verificationdocs` where `MemberID`='".$loginInfo[0]['MemberID']."' and `IsDelete`='0' and `Type`!='EducationDetails' and ProfileCode='".$ProfileCode."'");
                $Educationattachments = $mysql->select("select * from `_tbl_profiles_education_details` where `MemberID`='".$loginInfo[0]['MemberID']."' and `IsDeleted`='0' ProfileID='".$Profiles[0]['ProfileID']."'");            
                $ProfileThumb = $mysql->select("select concat('".AppPath."uploads/',ProfilePhoto) as ProfilePhoto from `_tbl_profiles_photos` where   `ProfileCode`='".$ProfileCode."' and `IsDelete`='0' and `MemberID`='".$loginInfo[0]['MemberID']."' and `PriorityFirst`='1'");
                $ProfilePhotos = $mysql->select("select concat('".AppPath."uploads/',ProfilePhoto) as ProfilePhoto  from `_tbl_profiles_photos` where  `ProfileID`='".$Profiles[0]['ProfileID']."' and `MemberID`='".$loginInfo[0]['MemberID']."' and `IsDelete`='0' and `PriorityFirst`='0'");                                        
                $lastseen = $mysql->select("select * from `_tbl_profiles_lastseen` where ProfileID='".$Profiles[0]['ProfileID']."' and VisterMemberID='".$loginInfo[0]['MemberID']."' order by LastSeenID desc limit 0,1");
                $isFavourite = $mysql->select("select ViewedOn from `_tbl_profiles_favourites` where ProfileID='".$Profiles[0]['ProfileID']."' and VisterMemberID='".$loginInfo[0]['MemberID']."' and `IsFavorite`='1' and `IsVisible`='1' order by FavProfileID desc limit 0,1");
                $isMutured = $mysql->select("select ViewedOn from _tbl_profiles_favourites where `IsFavorite` ='1' and `IsVisible`='1' and VisterProfileCode='".$Profiles[0]['ProfileCode']."' and `VisterProfileCode` in (select `VisterProfileCode` from `_tbl_profiles_favourites` where `IsFavorite` ='1' and `IsVisible`='1'    and `MemberID` = '".$loginInfo[0]['MemberID']."' order by FavProfileID DESC)");
            } else {   
                $Profiles = $mysql->select("select * from `_tbl_profiles` where ProfileCode='".$ProfileCode."'");               
                $PartnersExpectations = $mysql->select("select * from `_tbl_profiles_partnerexpectation` where `ProfileCode`='".$ProfileCode."'");
                $Documents = $mysql->select("select concat('".AppPath."uploads/',AttachFileName) as AttachFileName,DocumentType as DocumentType from `_tbl_profiles_verificationdocs` where `IsDelete`='0' and `Type`!='EducationDetails' and ProfileCode='".$ProfileCode."'");
                $Educationattachments = $mysql->select("select * from `_tbl_profiles_education_details` where  ProfileCode='".$ProfileCode."' and `IsDeleted`='0'");            
                $ProfileThumb = $mysql->select("select concat('".AppPath."uploads/',ProfilePhoto) as ProfilePhoto from `_tbl_profiles_photos` where   `ProfileCode`='".$ProfileCode."' and `IsDelete`='0' and `PriorityFirst`='1'");
                $ProfilePhotos = isset($Profiles[0]['ProfileID']) ? $mysql->select("select concat('".AppPath."uploads/',ProfilePhoto) as ProfilePhoto  from `_tbl_profiles_photos` where  `ProfileID`='".$Profiles[0]['ProfileID']."' and `IsDelete`='0' and `PriorityFirst`='0'") : array();                                        
              
               $IsDownload = $mysql->select("select * from `_tbl_profile_download` where `MemberID`='".$loginInfo[0]['MemberID']."' and `PartnerProfileCode`='".$ProfileCode."'"); 
              
                if ($myrecentviewed==1) {
                    if (isset($Profiles[0]['ProfileID']) && isset($loginInfo[0]['MemberID'])) {
                        $lastseen = $mysql->select("select ViewedOn from `_tbl_profiles_lastseen` where ProfileID='".$Profiles[0]['ProfileID']."' and VisterMemberID='".$loginInfo[0]['MemberID']."' order by LastSeenID desc limit 0,1");
                        $isFavourite = $mysql->select("select ViewedOn from `_tbl_profiles_favourites` where ProfileID='".$Profiles[0]['ProfileID']."' and VisterMemberID='".$loginInfo[0]['MemberID']."' and `IsFavorite`='1' and `IsVisible`='1' order by FavProfileID desc limit 0,1");
                        //$isMutured = $mysql->select("select ViewedOn from _tbl_profiles_favourites where `IsFavorite` ='1' and `IsVisible`='1' and ProfileCode='".$Profiles[0]['ProfileCode']."' and `ProfileCode` in (select `VisterProfileCode` from `_tbl_profiles_favourites` where `IsFavorite` ='1' and `IsVisible`='1'    and `MemberID` = '".$loginInfo[0]['MemberID']."' order by FavProfileID DESC)");
                        $isMutured = $mysql->select("select ViewedOn from _tbl_profiles_favourites where `IsFavorite` ='1' and `IsVisible`='1' and VisterProfileCode='".$Profiles[0]['ProfileCode']."' and `VisterProfileCode` in (select `VisterProfileCode` from `_tbl_profiles_favourites` where `IsFavorite` ='1' and `IsVisible`='1'    and `MemberID` = '".$loginInfo[0]['MemberID']."' order by FavProfileID DESC)");
                    }
                } else {
                    $lastseen = $mysql->select("select * from `_tbl_profiles_lastseen` where VisterProfileID='".$Profiles[0]['ProfileID']."' and MemberID='".$loginInfo[0]['MemberID']."' order by LastSeenID desc limit 0,1");   
                }
                $LastLogin = isset($Profiles[0]['ProfileID'])  ? $mysql->select("select * from `_tbl_logs_logins` where `MemberID`='".$Profiles[0]['MemberID']."' ORDER BY `LoginID` DESC") : array();
            }
            $members = $mysql->select("select * from `_tbl_members` where `MemberID`='".$loginInfo[0]['MemberID']."'");   
            
            if (sizeof($ProfilePhotos)<4) {
                for($i=sizeof($ProfilePhotos);$i<4;$i++) {
                    if (isset($Profiles[0]['SexCode']) && $Profiles[0]['SexCode']=="SX002"){
                        $ProfilePhotos[$i]['ProfilePhoto'] = AppPath."assets/images/noprofile_female.png";
                    } else {
                        $ProfilePhotos[$i]['ProfilePhoto'] = AppPath."assets/images/noprofile_male.png";
                    }
                }  
            }
            
            if (sizeof($ProfileThumb)==0) {
                if (isset($Profiles[0]['SexCode']) && $Profiles[0]['SexCode']=="SX002"){
                    $ProfileThumbnail = AppPath."assets/images/noprofile_female.png";
                } else { 
                    $ProfileThumbnail = AppPath."assets/images/noprofile_male.png";
                }
            } else {
                 $ProfileThumbnail =  getDataURI($ProfileThumb[0]['ProfilePhoto']); //$ProfileThumb[0]['ProfilePhoto'];                                              
            } 
            
            $Position = "Published";                                             
            $Profiles[0]['LastLogin']    = (isset($LastLogin[0]['LoginOn']) ? $LastLogin[0]['LoginOn'] : 0);
            $Profiles[0]['LastSeen']     = (isset($lastseen[0]['ViewedOn']) ? $lastseen[0]['ViewedOn'] : 0);
            $Profiles[0]['isFavourited'] = (isset($isFavourite[0]['ViewedOn']) ? $isFavourite[0]['ViewedOn'] : 0);
            $Profiles[0]['isMutured']    = (isset($isMutured[0]['ViewedOn']) ? 1 : 0);
            $Profiles[0]['MuturedOn']    = (isset($isMutured[0]['ViewedOn']) ? $isMutured[0]['ViewedOn'] : "");
            $Profiles[0]['Age']          = isset($Profiles[0]['DateofBirth']) ? date("Y")-date("Y",strtotime($Profiles[0]['DateofBirth'])) : "0";   
             
            $result = array("ProfileInfo"          => $Profiles[0],
                            "Members"             => $members[0],
                            "IsDownload"           => $IsDownload,
                            "Position"             => $Position,
                            "EducationAttachments" => $Educationattachments,
                            "Documents"            => $Documents,
                            "PartnerExpectation"   => isset($PartnersExpectations[0]) ? $PartnersExpectations[0] : array(),
                            "ProfilePhotos"        => $ProfilePhotos,  
                            "ProfileThumb"         => $ProfileThumbnail);
            return  $result;
        }
        
    } 

    function getDataURI($image, $mime = '') {
        
        // Create Image From Existing File
        // $jpg_image = imagecreatefromjpeg($image);
        // Allocate A Color For The Text
        // $white = imagecolorallocate($jpg_image, 255, 255, 255);

        // Set Path to Font File
        //$font_path = 'font.TTF';
        
        // Set Text to Be Printed On Image
        // $text = "This is a sunset!";

        // Print Text On Image
        //imagettftext($jpg_image, 25, 0, 75, 300, $white, "", $text);

        // Send Image to Browser
        //imagejpeg($jpg_image);
        //$image=  $jpg_image;
        // Clear Memory
        // imagedestroy($jpg_image);
        //image/jpeg;
        //image/png
        $temp = explode(".",$image);
        $temp = trim(strtolower($temp[sizeof($temp)-1]));
        if ($temp=="jpeg"  || $temp=="jpg") {
            return 'data:image/jpeg;base64,'.base64_encode(file_get_contents(file_url($image)));   
        } else if ($temp=="png" ) {
            return 'data:image/png;base64,'.base64_encode(file_get_contents(file_url($image))); 
        }
        // return 'data: '.(function_exists('mime_content_type') ? mime_content_type($image) : $mime).';base64,'.base64_encode(file_get_contents($image));
    } 

    function file_url($url){
        $parts = parse_url($url);
        $path_parts = array_map('rawurldecode', explode('/', $parts['path']));
        return $parts['scheme'].'://'.$parts['host'].implode('/', array_map('rawurlencode', $path_parts));
    }
    //537
?>