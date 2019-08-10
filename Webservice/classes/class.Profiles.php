<?php 
    class Profiles {
        
        public function getDraftProfileInformation($ProfileCode) {
            
            global $mysql,$loginInfo;  
                
            $Profiles = $mysql->select("select * from `_tbl_draft_profiles` where `MemberID`='".$loginInfo[0]['MemberID']."' and ProfileCode='".$ProfileCode."'");               
            
            $lastseen = $mysql->select("select * from `_tbl_draft_profiles_lastseen` where ProfileID='".$Profiles[0]['ProfileID']."' order by LastSeenID desc limit 0,1");
           
            
            
               $id = $mysql->insert("_tbl_draft_profiles_lastseen", array("LastSeen"     => date("Y-m-d H:i:s"),
                                                                      "LastSeenBy"   => $loginInfo[0]['MemberID'],
                                                                      "ProfileID"    => $Profiles[0]['ProfileID'],
                                                                      "MemberID"     => $loginInfo[0]['MemberID'],
                                                                      "FranchiseeID" => "0",
                                                                      "AdminID"      => "0"));
            
            $members = $mysql->select("select * from `_tbl_members` where `MemberID`='".$Profiles[0]['MemberID']."'");     
            $PartnersExpectations = $mysql->select("select * from `_tbl_draft_profiles_partnerexpectation` where `ProfileID`='".$Profiles[0]['ProfileID']."'");
            $Documents = $mysql->select("select concat('".AppPath."uploads/',AttachFileName) as AttachFileName,DocumentType as DocumentType from `_tbl_draft_profiles_verificationdocs` where `MemberID`='".$loginInfo[0]['MemberID']."' and `IsDelete`='0' and `Type`!='EducationDetails' and ProfileCode='".$ProfileCode."'");
            $Educationattachments = $mysql->select("select * from `_tbl_draft_profiles_education_details` where `MemberID`='".$loginInfo[0]['MemberID']."' and `IsDeleted`='0' and ProfileID='".$Profiles[0]['ProfileID']."'");            
            
            $ProfilePhotos = $mysql->select("select concat('".AppPath."uploads/',ProfilePhoto) as ProfilePhoto  from `_tbl_draft_profiles_photos` where  `ProfileCode`='".$ProfileCode."' and `MemberID`='".$loginInfo[0]['MemberID']."' and `IsDelete`='0' and `PriorityFirst`='0'");                                        
            if (sizeof($ProfilePhotos)<4) {
                for($i=sizeof($ProfilePhotos);$i<4;$i++) {
                    if ($Profiles[0]['SexCode']=="SX002"){
                        $ProfilePhotos[$i]['ProfilePhoto'] = AppPath."assets/images/noprofile_female.png";
                    } else {
                        $ProfilePhotos[$i]['ProfilePhoto'] = AppPath."assets/images/noprofile_male.png";
                    }
                }  
            }
            
            $ProfileThumb = $mysql->select("select concat('".AppPath."uploads/',ProfilePhoto) as ProfilePhoto from `_tbl_draft_profiles_photos` where   `ProfileCode`='".$ProfileCode."' and `MemberID`='".$loginInfo[0]['MemberID']."' and `IsDelete`='0' and `PriorityFirst`='1'");
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
                $Position = "Publish";
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
        
        
          public function getProfileInformation($ProfileCode) {
            
            global $mysql,$loginInfo;  
                
            $Profiles = $mysql->select("select * from `_tbl_profiles` where `MemberID`='".$loginInfo[0]['MemberID']."' and ProfileCode='".$ProfileCode."'");               
            
            $lastseen = $mysql->select("select * from `_tbl_profiles_lastseen` where ProfileID='".$Profiles[0]['ProfileID']."' order by LastSeenID desc limit 0,1");
           
            
            
               $id = $mysql->insert("_tbl_profiles_lastseen", array("LastSeen"     => date("Y-m-d H:i:s"),
                                                                      "LastSeenBy"   => $loginInfo[0]['MemberID'],
                                                                      "ProfileID"    => $Profiles[0]['ProfileID'],
                                                                      "MemberID"     => $loginInfo[0]['MemberID'],
                                                                      "FranchiseeID" => "0",
                                                                      "AdminID"      => "0"));
            
            $members = $mysql->select("select * from `_tbl_members` where `MemberID`='".$Profiles[0]['MemberID']."'");     
            $PartnersExpectations = $mysql->select("select * from `_tbl_profiles_partnerexpectation` where `ProfileID`='".$Profiles[0]['ProfileID']."'");
            $Documents = $mysql->select("select concat('".AppPath."uploads/',AttachFileName) as AttachFileName,DocumentType as DocumentType from `_tbl_profiles_verificationdocs` where `MemberID`='".$loginInfo[0]['MemberID']."' and `IsDelete`='0' and `Type`!='EducationDetails' and ProfileCode='".$ProfileCode."'");
            $Educationattachments = $mysql->select("select * from `_tbl_profiles_education_details` where `MemberID`='".$loginInfo[0]['MemberID']."' and ProfileID='".$Profiles[0]['ProfileID']."'");            
            
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
            /* `ProfileCode`='".$ProfileCode."'*/
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
            $Educationattachments = $mysql->select("select * from `_tbl_draft_profiles_education_details` where `MemberID`='".$Profiles[0]['MemberID']."' and `IsDeleted`='0' and ProfileID='".$Profiles[0]['ProfileID']."'");            
            
            $ProfilePhotos = $mysql->select("select concat('".AppPath."uploads/',ProfilePhoto) as ProfilePhoto  from `_tbl_draft_profiles_photos` where  `ProfileCode`='".$ProfileCode."' and `MemberID`='".$Profiles[0]['MemberID']."' and `IsDelete`='0' and `PriorityFirst`='0'");                                        
            if (sizeof($ProfilePhotos)<4) {
                for($i=sizeof($ProfilePhotos);$i<4;$i++) {
                    if ($Profiles[0]['SexCode']=="SX002"){
                        $ProfilePhotos[$i]['ProfilePhoto'] = AppPath."assets/images/noprofile_female.png";
                    } else {
                        $ProfilePhotos[$i]['ProfilePhoto'] = AppPath."assets/images/noprofile_male.png";
                    }
                }  
            }
            
            $ProfileThumb = $mysql->select("select concat('".AppPath."uploads/',ProfilePhoto) as ProfilePhoto from `_tbl_draft_profiles_photos` where `ProfileCode`='".$ProfileCode."' and `MemberID`='".$Profiles[0]['MemberID']."' and `IsDelete`='0' and `PriorityFirst`='1'");
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
                $Position = "Publish";
            }
            
            
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
            /* `ProfileCode`='".$ProfileCode."'*/
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
            /* `ProfileCode`='".$ProfileCode."'*/
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
          public function getProfileInfo($ProfileCode,$IsOther=0) {
            
            global $mysql,$loginInfo;  
                
            if ($IsOther==0)  {
                $Profiles = $mysql->select("select * from `_tbl_profiles` where `MemberID`='".$loginInfo[0]['MemberID']."' and ProfileCode='".$ProfileCode."'");               
                $PartnersExpectations = $mysql->select("select * from `_tbl_profiles_partnerexpectation` where `ProfileID`='".$Profiles[0]['ProfileID']."'");
                $Documents = $mysql->select("select concat('".AppPath."uploads/',AttachFileName) as AttachFileName,DocumentType as DocumentType from `_tbl_profiles_verificationdocs` where `MemberID`='".$loginInfo[0]['MemberID']."' and `IsDelete`='0' and `Type`!='EducationDetails' and ProfileCode='".$ProfileCode."'");
                $Educationattachments = $mysql->select("select * from `_tbl_profiles_education_details` where `MemberID`='".$loginInfo[0]['MemberID']."' and `IsDeleted`='0' ProfileID='".$Profiles[0]['ProfileID']."'");            
                $ProfileThumb = $mysql->select("select concat('".AppPath."uploads/',ProfilePhoto) as ProfilePhoto from `_tbl_profiles_photos` where   `ProfileCode`='".$ProfileCode."' and `IsDelete`='0' and `MemberID`='".$loginInfo[0]['MemberID']."' and `PriorityFirst`='1'");
                $ProfilePhotos = $mysql->select("select concat('".AppPath."uploads/',ProfilePhoto) as ProfilePhoto  from `_tbl_profiles_photos` where  `ProfileID`='".$Profiles[0]['ProfileID']."' and `MemberID`='".$loginInfo[0]['MemberID']."' and `IsDelete`='0' and `PriorityFirst`='0'");                                        
                   $lastseen = $mysql->select("select * from `_tbl_profiles_lastseen` where ProfileID='".$Profiles[0]['ProfileID']."' and VisterMemberID='".$loginInfo[0]['MemberID']."' order by LastSeenID desc limit 0,1");
            
         
            } else {
                $Profiles = $mysql->select("select * from `_tbl_profiles` where ProfileCode='".$ProfileCode."'");               
                $PartnersExpectations = $mysql->select("select * from `_tbl_profiles_partnerexpectation` where `ProfileCode`='".$ProfileCode."'");
                $Documents = $mysql->select("select concat('".AppPath."uploads/',AttachFileName) as AttachFileName,DocumentType as DocumentType from `_tbl_profiles_verificationdocs` where `IsDelete`='0' and `Type`!='EducationDetails' and ProfileCode='".$ProfileCode."'");
                $Educationattachments = $mysql->select("select * from `_tbl_profiles_education_details` where  ProfileCode='".$ProfileCode."' and `IsDeleted`='0'");            
                $ProfileThumb = $mysql->select("select concat('".AppPath."uploads/',ProfilePhoto) as ProfilePhoto from `_tbl_profiles_photos` where   `ProfileCode`='".$ProfileCode."' and `IsDelete`='0' and `PriorityFirst`='1'");
                $ProfilePhotos = $mysql->select("select concat('".AppPath."uploads/',ProfilePhoto) as ProfilePhoto  from `_tbl_profiles_photos` where  `ProfileID`='".$Profiles[0]['ProfileID']."' and `IsDelete`='0' and `PriorityFirst`='0'");                                        
                   $lastseen = $mysql->select("select * from `_tbl_profiles_lastseen` where VisterProfileID='".$Profiles[0]['ProfileID']."' and MemberID='".$loginInfo[0]['MemberID']."' order by LastSeenID desc limit 0,1");
            
         
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
            $Profiles[0]['LastSeen']=(isset($lastseen[0]['ViewedOn']) ? $lastseen[0]['ViewedOn'] : 0);
            $result = array("ProfileInfo"          => $Profiles[0],
                            "Position"             => $Position,
                            "EducationAttachments" => $Educationattachments,
                            "Documents"            => $Documents,
                            "PartnerExpectation"   => $PartnersExpectations[0],
                            "ProfilePhotos"        => $ProfilePhotos,  /*array*/
                            "ProfileThumb"         => $ProfileThumbnail,
                            "sql"         => "select * from `_tbl_profiles_lastseen` where ProfileID='".$Profiles[0]['ProfileID']."' and VisterMemberID='".$loginInfo[0]['MemberID']."' order by LastSeenID desc limit 0,1");
            return  $result;
                                                                                                           
        }
        
                   
} 
?>