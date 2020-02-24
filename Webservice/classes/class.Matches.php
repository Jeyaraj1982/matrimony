<?php
     class Matches {
         
         function BasicSearchProfile() {
             
             global $mysql,$loginInfo;
             
             $search_param = $mysql->select("select * from `_tbl_member_basic_search` where `SearchID`='".$_POST['Code']."'");
             $myprofile = $mysql->select("select * from _tbl_profiles where MemberID='".$loginInfo[0]['MemberID']."'");
           
             $sexcode="";
             if ($myprofile[0]['SexCode']=="SX001") {
                $sexcode="SX002";  
             }
             
             if ($myprofile[0]['SexCode']=="SX002") {
                $sexcode="SX001";  
             }
             $MatrialStatusCode=array();
             foreach(explode(",",$search_param[0]['MaritalStatusCode']) as $ms) {
               $MatrialStatusCode[] = "'".trim($ms)."'";
             }
             $ReligionCode=array();
             foreach(explode(",",$search_param[0]['ReligionCode']) as $rc) {
               $ReligionCode[] = "'".trim($rc)."'";
             }
             $CasteCode=array();
             foreach(explode(",",$search_param[0]['CasteCode']) as $cc) {
               $CasteCode[] = "'".trim($cc)."'";
             }
             
             $SearchResults = $mysql->select("select * from _tbl_profiles where `SexCode`='".$sexcode."' and `MaritalStatusCode` in (".implode(",",$MatrialStatusCode).") and `ReligionCode` in (".implode(",",$ReligionCode).") and `CasteCode` in (".implode(",",$CasteCode).") ");
             if (sizeof($SearchResults)==0) {
                return Response::returnSuccess("success",array()); 
             }
             
             $result = array();
             foreach($SearchResults as $p) {
                $result[]=Profiles::getProfileInfo($p['ProfileCode'],1); 
             }
             
             return Response::returnSuccess("success",$result);
         }
         function AdvanceSearchProfile() {
             
             global $mysql,$loginInfo;
             
             $search_param = $mysql->select("select * from `_tbl_member_advance_search` where `SearchID`='".$_POST['Code']."'");
             $myprofile = $mysql->select("select * from _tbl_profiles where MemberID='".$loginInfo[0]['MemberID']."'");
           
             $sexcode="";
             if ($myprofile[0]['SexCode']=="SX001") {
                $sexcode="SX002";  
             }
             
             if ($myprofile[0]['SexCode']=="SX002") {
                $sexcode="SX001";  
             }
             $MatrialStatusCode=array();
             foreach(explode(",",$search_param[0]['MaritalStatusCode']) as $ms) {
               $MatrialStatusCode[] = "'".trim($ms)."'";
             }
             $ReligionCode=array();
             foreach(explode(",",$search_param[0]['ReligionCode']) as $rc) {
               $ReligionCode[] = "'".trim($rc)."'";
             }
             $CasteCode=array();
             foreach(explode(",",$search_param[0]['CasteCode']) as $cc) {
               $CasteCode[] = "'".trim($cc)."'";
             }
             $IncomeRangeCode=array();
             foreach(explode(",",$search_param[0]['IncomeRangeCode']) as $IR) {
               $IncomeRangeCode[] = "'".trim($IR)."'";
             }
             $OccupationCode=array();
             foreach(explode(",",$search_param[0]['OccupationCode']) as $ON) {
               $OccupationCode[] = "'".trim($ON)."'";
             }
             $FamilyTypeCode=array();
             foreach(explode(",",$search_param[0]['FamilyTypeCode']) as $FT) {
               $FamilyTypeCode[] = "'".trim($FT)."'";
             }
             $WorkingPlaceCode=array();
             foreach(explode(",",$search_param[0]['WorkingPlaceCode']) as $WP) {
               $WorkingPlaceCode[] = "'".trim($WP)."'";
             }
             $DietCode=array();
             foreach(explode(",",$search_param[0]['DietCode']) as $dtc) {
               $DietCode[] = "'".trim($dtc)."'";
             }
             $SmokeCode=array();
             foreach(explode(",",$search_param[0]['SmokeCode']) as $skc) {
               $SmokeCode[] = "'".trim($skc)."'";
             }
             $DrinkCode=array();
             foreach(explode(",",$search_param[0]['DrinkCode']) as $dkc) {
               $DrinkCode[] = "'".trim($dkc)."'";
             }
             $BodyTypeCode=array();
             foreach(explode(",",$search_param[0]['BodyTypeCode']) as $btc) {
               $BodyTypeCode[] = "'".trim($btc)."'";
             }
             $ComplexionCode=array();
             foreach(explode(",",$search_param[0]['ComplexionCode']) as $cmc) {
               $ComplexionCode[] = "'".trim($cmc)."'";
             }
             
             $SearchResults = $mysql->select("select * from _tbl_profiles where `SexCode`='".$sexcode."' and `MaritalStatusCode` in (".implode(",",$MatrialStatusCode).") and `ReligionCode` in (".implode(",",$ReligionCode).") and `CasteCode` in (".implode(",",$CasteCode).") and `AnnualIncomeCode` in (".implode(",",$IncomeRangeCode).") and `OccupationTypeCode` in (".implode(",",$OccupationCode).") and `FamilyTypeCode` in (".implode(",",$FamilyTypeCode).") and `WorkedCountryCode` in (".implode(",",$WorkingPlaceCode).") and `DietCode` in (".implode(",",$DietCode).") and `SmokeCode` in (".implode(",",$SmokeCode).") and `DrinkCode` in (".implode(",",$DrinkCode).") and `BodyTypeCode` in (".implode(",",$BodyTypeCode).") and `ComplexionCode` in (".implode(",",$ComplexionCode).") ");
             if (sizeof($SearchResults)==0) {
                return Response::returnSuccess("success",array()); 
             }
             
             $result = array();
             foreach($SearchResults as $p) {
                $result[]=Profiles::getProfileInfo($p['ProfileCode'],1); 
             }
             
             return Response::returnSuccess("success",$result);
         }
         function SearchByProfileID() {
             
             global $mysql,$loginInfo;
             
             $search_param = $mysql->select("select * from `_tbl_member_search_by_profileid` where `SearchID`='".$_POST['Code']."'");
             $myprofile = $mysql->select("select * from _tbl_profiles where MemberID='".$loginInfo[0]['MemberID']."'");
           
             $sexcode="";
             if ($myprofile[0]['SexCode']=="SX001") {
                $sexcode="SX002";  
             }
             
             if ($myprofile[0]['SexCode']=="SX002") {
                $sexcode="SX001";  
             }
             
             $SearchResults = $mysql->select("select * from _tbl_profiles where `SexCode`='".$sexcode."' and `ProfileCode`='".$search_param[0]['ProfileID']."'");
             if (sizeof($SearchResults)==0) {
                return Response::returnSuccess("success",array()); 
             }
             
             $result = array();
             foreach($SearchResults as $p) {
                $result[]=Profiles::getProfileInfo($p['ProfileCode'],1); 
             }
             
             return Response::returnSuccess("success",$result);
         }
         function GetWhoMyFavoritedProfile($ProfileCode) {
             
            global $mysql;
            $result = $mysql->select("select * from `_tbl_profiles_favourites` where `IsVisible`='1' and `IsFavorite` ='1' and `VisterProfileCode`='".$ProfileCode."'");       
            return $result;
            }
            function GetMyRecentlyViewedProfile($ProfileCode) {
             
            global $mysql;
                                    
            $result = $mysql->select("select ProfileCode from `_tbl_profiles_lastseen` where `VisterProfileCode` = '".$ProfileCode."' AND MemberID>0 AND ProfileID>0  group by `ProfileCode`"); 
            return $result;
    }
         function MatchedMyExpectation() {
             
             global $mysql,$loginInfo;
                                                                                 
             $result = array();
             
             $checkverification = $mysql->select("select * from _tbl_members where MemberID='".$loginInfo[0]['MemberID']."'");
             
             if($checkverification[0]['IsMobileVerified']==0) {
                 return Response::returnError("you must verify your mobile number",array("param"=>"mobile"));   
             }
             
             if($checkverification[0]['IsEmailVerified']==0) {
                 return Response::returnError("you must verify your email id",array("param"=>"email"));   
             }
             
             $myprofile = $mysql->select("select * from _tbl_profiles where MemberID='".$loginInfo[0]['MemberID']."'");
             if (sizeof($myprofile)==0) {
                return Response::returnError("You must create a profile",array("param"=>"profile"));   
             }
             
             /* validate active profiles */  
             $Profiles = $mysql->select("select * from _tbl_profiles where `SexCode`='".(($myprofile[0]['SexCode']=="SX001") ? "SX002" : "SX001")."'");
             foreach($Profiles as $p) {
                $result[]=Profiles::getProfileInfo($p['ProfileCode'],1); 
               // $result['MyFavoritedCount']= sizeof($this->GetWhoMyFavoritedProfile($p['ProfileCode']));
               // $result['MyRecentlyViewedCount']= sizeof($this->GetMyRecentlyViewedProfile($p['ProfileCode']));
               // $result['MyShortListedcount']= Shortlist::MyShortlisted($p['ProfileCode']);
             }
             
             return Response::returnSuccess("success",$result);
         }
         
         function MatchesNearByMe() {
             global $mysql,$loginInfo;
                                                                                                                                
             $result = array();
             
             $checkverification = $mysql->select("select * from _tbl_members where MemberID='".$loginInfo[0]['MemberID']."'");
             
             if($checkverification[0]['IsMobileVerified']==0) {
                 return Response::returnError("you must verify your mobile number",array("param"=>"mobile"));   
             }
             
             if($checkverification[0]['IsEmailVerified']==0) {
                 return Response::returnError("you must verify your email id",array("param"=>"email"));   
             }
             
             $myprofile = $mysql->select("select * from _tbl_draft_profiles where MemberID='".$loginInfo[0]['MemberID']."'");
             if (sizeof($myprofile)==0) {
                return Response::returnError("You must create a profile",array("param"=>"profile"));   
             }
             
             /* validate active profiles */  
             $Profiles = $mysql->select("select * from _tbl_profiles where `SexCode`='".(($myprofile[0]['SexCode']=="SX001") ? "SX002" : "SX001")."'");
             foreach($Profiles as $p) {
                $result[]=Profiles::getProfileInfo($p['ProfileCode'],1); 
             }
             
             return Response::returnSuccess("success",$result);
             
         }
         
         function MatchesRecentlyAdded() {
              global $mysql,$loginInfo;
                                                                                 
             $result = array();
             
             $checkverification = $mysql->select("select * from _tbl_members where MemberID='".$loginInfo[0]['MemberID']."'");
             
             if($checkverification[0]['IsMobileVerified']==0) {
                 return Response::returnError("you must verify your mobile number",array("param"=>"mobile"));   
             }
             
             if($checkverification[0]['IsEmailVerified']==0) {
                 return Response::returnError("you must verify your email id",array("param"=>"email"));   
             }
             
             $myprofile = $mysql->select("select * from _tbl_draft_profiles where MemberID='".$loginInfo[0]['MemberID']."'");
             if (sizeof($myprofile)==0) {
                return Response::returnError("You must create a profile",array("param"=>"profile"));   
             }
             
             /* validate active profiles */  
             $Profiles = $mysql->select("select * from _tbl_profiles where `SexCode`='".(($myprofile[0]['SexCode']=="SX001") ? "SX002" : "SX001")."' order by `ProfileID` DESC");
             foreach($Profiles as $p) {
                $result[]=Profiles::getProfileInfo($p['ProfileCode'],1); 
             }
             
             return Response::returnSuccess("success",$result);
         }
         
         function MatchesMostPopular() {
              global $mysql,$loginInfo;
                                                                                 
             $result = array();
             
             $checkverification = $mysql->select("select * from _tbl_members where MemberID='".$loginInfo[0]['MemberID']."'");
             
             if($checkverification[0]['IsMobileVerified']==0) {
                 return Response::returnError("you must verify your mobile number",array("param"=>"mobile"));   
             }
             
             if($checkverification[0]['IsEmailVerified']==0) {
                 return Response::returnError("you must verify your email id",array("param"=>"email"));   
             }
             
             $myprofile = $mysql->select("select * from _tbl_draft_profiles where MemberID='".$loginInfo[0]['MemberID']."'");
             if (sizeof($myprofile)==0) {
                return Response::returnError("You must create a profile",array("param"=>"profile"));   
             }
             
             /* validate active profiles */  
             $Profiles = $mysql->select("select * from _tbl_profiles where `SexCode`='".(($myprofile[0]['SexCode']=="SX001") ? "SX002" : "SX001")."'");
             $Profiles = $mysql->select("
                                    SELECT t1.ProfileID,t1.viewed,t2.SexCode, t2.ProfileCode
                                        FROM (SELECT ProfileID, COUNT(*) AS viewed FROM _tbl_profiles_lastseen GROUP BY ProfileID ORDER BY viewed DESC) AS t1
                                    LEFT JOIN _tbl_profiles AS t2
                                        ON t1.ProfileID = t2.ProfileID 
                                    WHERE t2.SexCode='".(($myprofile[0]['SexCode']=="SX001") ? "SX002" : "SX001")."'");
             foreach($Profiles as $p) {
                $result[]=Profiles::getProfileInfo($p['ProfileCode'],1); 
             }
             
             return Response::returnSuccess("success",$result);
         }
         function MatchesFeaturedProfiles() {
              global $mysql,$loginInfo;
                                                                                 
             $result = array();
             
             $checkverification = $mysql->select("select * from _tbl_members where MemberID='".$loginInfo[0]['MemberID']."'");
             
             if($checkverification[0]['IsMobileVerified']==0) {
                 return Response::returnError("you must verify your mobile number",array("param"=>"mobile"));   
             }
             
             if($checkverification[0]['IsEmailVerified']==0) {
                 return Response::returnError("you must verify your email id",array("param"=>"email"));   
             }
             
             $myprofile = $mysql->select("select * from _tbl_draft_profiles where MemberID='".$loginInfo[0]['MemberID']."'");
             if (sizeof($myprofile)==0) {
                return Response::returnError("You must create a profile",array("param"=>"profile"));   
             }
             
             /* validate active profiles */  
            // $Profiles = $mysql->select("select * from _tbl_profiles where `SexCode`='".(($myprofile[0]['SexCode']=="SX001") ? "SX002" : "SX001")."'");
             $Profiles = $mysql->select("select ProfileCode from _tbl_profiles where SexCode='".(($myprofile[0]['SexCode']=="SX001") ? "SX002" : "SX001")."' and  ProfileCode in (select ProfileCode from `_tbl_landingpage_profiles` where Date(`DateTo`)>=Date('".date("Y-m-d")."') and `IsShow`='1')");
             
             foreach($Profiles as $p) {
                $result[]=Profiles::getProfileInfo($p['ProfileCode'],1); 
             }
             
             return Response::returnSuccess("success",$result);
         }
         function MatchesMostLiked() {
              global $mysql,$loginInfo;
                                                                                 
             $result = array();
             
             $checkverification = $mysql->select("select * from _tbl_members where MemberID='".$loginInfo[0]['MemberID']."'");
             
             if($checkverification[0]['IsMobileVerified']==0) {
                 return Response::returnError("you must verify your mobile number",array("param"=>"mobile"));   
             }
             
             if($checkverification[0]['IsEmailVerified']==0) {
                 return Response::returnError("you must verify your email id",array("param"=>"email"));   
             }
             
             $myprofile = $mysql->select("select * from _tbl_draft_profiles where MemberID='".$loginInfo[0]['MemberID']."'");
             if (sizeof($myprofile)==0) {
                return Response::returnError("You must create a profile",array("param"=>"profile"));   
             }
             
             /* validate active profiles */  
             $Profiles = $mysql->select("select * from _tbl_profiles where `SexCode`='".(($myprofile[0]['SexCode']=="SX001") ? "SX002" : "SX001")."'");
             $Profiles = $mysql->select("
                                    SELECT t1.ProfileID,t1.viewed,t2.SexCode, t2.ProfileCode
                                        FROM (SELECT ProfileID, COUNT(*) AS viewed FROM _tbl_profiles_favourites GROUP BY ProfileID ORDER BY viewed DESC) AS t1
                                    LEFT JOIN _tbl_profiles AS t2
                                        ON t1.ProfileID = t2.ProfileID 
                                    WHERE t2.SexCode='".(($myprofile[0]['SexCode']=="SX001") ? "SX002" : "SX001")."'");
             foreach($Profiles as $p) {
                $result[]=Profiles::getProfileInfo($p['ProfileCode'],1); 
             }
             
             return Response::returnSuccess("success",$result);
         }
         
         function MatchesReligion() {
              global $mysql,$loginInfo;
                                                                                 
             $result = array();
             
             $checkverification = $mysql->select("select * from _tbl_members where MemberID='".$loginInfo[0]['MemberID']."'");
             
             if($checkverification[0]['IsMobileVerified']==0) {
                 return Response::returnError("you must verify your mobile number",array("param"=>"mobile"));   
             }
             
             if($checkverification[0]['IsEmailVerified']==0) {
                 return Response::returnError("you must verify your email id",array("param"=>"email"));   
             }
             
             $myprofile = $mysql->select("select * from _tbl_draft_profiles where MemberID='".$loginInfo[0]['MemberID']."'");
             if (sizeof($myprofile)==0) {
                return Response::returnError("You must create a profile",array("param"=>"profile"));   
             }
             
             /* validate active profiles */  
             $Profiles = $mysql->select("select * from _tbl_profiles where `SexCode`='".(($myprofile[0]['SexCode']=="SX001") ? "SX002" : "SX001")."'");
             foreach($Profiles as $p) {
                $result[]=Profiles::getProfileInfo($p['ProfileCode'],1); 
             }
             
             return Response::returnSuccess("success",$result);
         }
         
         function MatchesIncome() {
              global $mysql,$loginInfo;
                                                                                 
             $result = array();
             
             $checkverification = $mysql->select("select * from _tbl_members where MemberID='".$loginInfo[0]['MemberID']."'");
             
             if($checkverification[0]['IsMobileVerified']==0) {
                 return Response::returnError("you must verify your mobile number",array("param"=>"mobile"));   
             }
             
             if($checkverification[0]['IsEmailVerified']==0) {
                 return Response::returnError("you must verify your email id",array("param"=>"email"));   
             }
             
             $myprofile = $mysql->select("select * from _tbl_draft_profiles where MemberID='".$loginInfo[0]['MemberID']."'");
             if (sizeof($myprofile)==0) {
                return Response::returnError("You must create a profile",array("param"=>"profile"));   
             }
             
             /* validate active profiles */  
             $Profiles = $mysql->select("select * from _tbl_profiles where `SexCode`='".(($myprofile[0]['SexCode']=="SX001") ? "SX002" : "SX001")."'");
             foreach($Profiles as $p) {
                $result[]=Profiles::getProfileInfo($p['ProfileCode'],1); 
             }
             
             return Response::returnSuccess("success",$result);
         }
         
         function MatchesEducation() {
              global $mysql,$loginInfo;
                                                                                 
             $result = array();
             
             $checkverification = $mysql->select("select * from _tbl_members where MemberID='".$loginInfo[0]['MemberID']."'");
             
             if($checkverification[0]['IsMobileVerified']==0) {
                 return Response::returnError("you must verify your mobile number",array("param"=>"mobile"));   
             }
             
             if($checkverification[0]['IsEmailVerified']==0) {
                 return Response::returnError("you must verify your email id",array("param"=>"email"));   
             }
             
             $myprofile = $mysql->select("select * from _tbl_draft_profiles where MemberID='".$loginInfo[0]['MemberID']."'");
             if (sizeof($myprofile)==0) {
                return Response::returnError("You must create a profile",array("param"=>"profile"));   
             }
             
             /* validate active profiles */  
             $Profiles = $mysql->select("select * from _tbl_profiles where `SexCode`='".(($myprofile[0]['SexCode']=="SX001") ? "SX002" : "SX001")."'");
             foreach($Profiles as $p) {
                $result[]=Profiles::getProfileInfo($p['ProfileCode'],1); 
             }
             
             return Response::returnSuccess("success",$result);
         }
         
         function MatchesOccupation() {
              global $mysql,$loginInfo;
                                                                                 
             $result = array();
             
             $checkverification = $mysql->select("select * from _tbl_members where MemberID='".$loginInfo[0]['MemberID']."'");
             
             if($checkverification[0]['IsMobileVerified']==0) {
                 return Response::returnError("you must verify your mobile number",array("param"=>"mobile"));   
             }
             
             if($checkverification[0]['IsEmailVerified']==0) {
                 return Response::returnError("you must verify your email id",array("param"=>"email"));   
             }
             
             $myprofile = $mysql->select("select * from _tbl_draft_profiles where MemberID='".$loginInfo[0]['MemberID']."'");
             if (sizeof($myprofile)==0) {
                return Response::returnError("You must create a profile",array("param"=>"profile"));   
             }
             
             /* validate active profiles */  
             $Profiles = $mysql->select("select * from _tbl_profiles where `SexCode`='".(($myprofile[0]['SexCode']=="SX001") ? "SX002" : "SX001")."'");
             foreach($Profiles as $p) {
                $result[]=Profiles::getProfileInfo($p['ProfileCode'],1); 
             }
             
             return Response::returnSuccess("success",$result);
         }
         
         function MatchesOthers() {
             global $mysql,$loginInfo;
                                                                                 
             $result = array();
             
             $checkverification = $mysql->select("select * from _tbl_members where MemberID='".$loginInfo[0]['MemberID']."'");
             
             if($checkverification[0]['IsMobileVerified']==0) {
                 return Response::returnError("you must verify your mobile number",array("param"=>"mobile"));   
             }
             
             if($checkverification[0]['IsEmailVerified']==0) {
                 return Response::returnError("you must verify your email id",array("param"=>"email"));   
             }
             
             $myprofile = $mysql->select("select * from _tbl_draft_profiles where MemberID='".$loginInfo[0]['MemberID']."'");
             if (sizeof($myprofile)==0) {
                return Response::returnError("You must create a profile",array("param"=>"profile"));   
             }
             
             /* validate active profiles */  
             $Profiles = $mysql->select("select * from _tbl_profiles where `SexCode`='".(($myprofile[0]['SexCode']=="SX001") ? "SX002" : "SX001")."'");
             foreach($Profiles as $p) {
                $result[]=Profiles::getProfileInfo($p['ProfileCode'],1); 
             }
             
             return Response::returnSuccess("success",$result);
         }
         function FranchiseeBasicSearchProfile() {
             
             global $mysql,$loginInfo;
             
             $search_param = $mysql->select("select * from `_tbl_member_basic_search` where `SearchID`='".$_POST['Code']."'");
            // $myprofile = $mysql->select("select * from _tbl_profiles where MemberID='".$loginInfo[0]['MemberID']."'");
             $myprofile = $mysql->select("select * from _tbl_franchisees_staffs where FranchiseeID='".$loginInfo[0]['FranchiseeID']."'");
           
             $sexcode="";
             if ($myprofile[0]['Sex']=="Male") {
                $sexcode="Female";  
             }
             
             if ($myprofile[0]['SexCode']=="Female") {
                $sexcode="Male";  
             }
             $MatrialStatusCode=array();
             foreach(explode(",",$search_param[0]['MaritalStatusCode']) as $ms) {
               $MatrialStatusCode[] = "'".trim($ms)."'";
             }
             $ReligionCode=array();
             foreach(explode(",",$search_param[0]['ReligionCode']) as $rc) {
               $ReligionCode[] = "'".trim($rc)."'";
             }
             $CasteCode=array();
             foreach(explode(",",$search_param[0]['CasteCode']) as $cc) {
               $CasteCode[] = "'".trim($cc)."'";
             }
             
             $SearchResults = $mysql->select("select * from _tbl_profiles where `Sex`='".$sexcode."' and `MaritalStatusCode` in (".implode(",",$MatrialStatusCode).") and `ReligionCode` in (".implode(",",$ReligionCode).") and `CasteCode` in (".implode(",",$CasteCode).") ");
             if (sizeof($SearchResults)==0) {
                return Response::returnSuccess("success",array()); 
             }
             
             $result = array();
             foreach($SearchResults as $p) {
                $result[]=Profiles::getProfileInfo($p['ProfileCode'],1); 
             }
             
             return Response::returnSuccess("success",$result);
         }
         function FranchiseeAdvanceSearchProfile() {
             
             global $mysql,$loginInfo;
             
             $search_param = $mysql->select("select * from `_tbl_member_advance_search` where `SearchID`='".$_POST['Code']."'");
            // $myprofile = $mysql->select("select * from _tbl_profiles where MemberID='".$loginInfo[0]['MemberID']."'");
             $myprofile = $mysql->select("select * from _tbl_franchisees_staffs where FranchiseeID='".$loginInfo[0]['FranchiseeID']."'");
           
             $sexcode="";
             if ($myprofile[0]['SexCode']=="Male") {
                $sexcode="Female";  
             }
             
             if ($myprofile[0]['SexCode']=="Female") {
                $sexcode="Male";  
             }
             $MatrialStatusCode=array();
             foreach(explode(",",$search_param[0]['MaritalStatusCode']) as $ms) {
               $MatrialStatusCode[] = "'".trim($ms)."'";
             }
             $ReligionCode=array();
             foreach(explode(",",$search_param[0]['ReligionCode']) as $rc) {
               $ReligionCode[] = "'".trim($rc)."'";
             }
             $CasteCode=array();
             foreach(explode(",",$search_param[0]['CasteCode']) as $cc) {
               $CasteCode[] = "'".trim($cc)."'";
             }
             $IncomeRangeCode=array();
             foreach(explode(",",$search_param[0]['IncomeRangeCode']) as $IR) {
               $IncomeRangeCode[] = "'".trim($IR)."'";
             }
             $OccupationCode=array();
             foreach(explode(",",$search_param[0]['OccupationCode']) as $ON) {
               $OccupationCode[] = "'".trim($ON)."'";
             }
             $FamilyTypeCode=array();
             foreach(explode(",",$search_param[0]['FamilyTypeCode']) as $FT) {
               $FamilyTypeCode[] = "'".trim($FT)."'";
             }
             $WorkingPlaceCode=array();
             foreach(explode(",",$search_param[0]['WorkingPlaceCode']) as $WP) {
               $WorkingPlaceCode[] = "'".trim($WP)."'";
             }
             $DietCode=array();
             foreach(explode(",",$search_param[0]['DietCode']) as $dtc) {
               $DietCode[] = "'".trim($dtc)."'";
             }
             $SmokeCode=array();
             foreach(explode(",",$search_param[0]['SmokeCode']) as $skc) {
               $SmokeCode[] = "'".trim($skc)."'";
             }
             $DrinkCode=array();
             foreach(explode(",",$search_param[0]['DrinkCode']) as $dkc) {
               $DrinkCode[] = "'".trim($dkc)."'";
             }
             $BodyTypeCode=array();
             foreach(explode(",",$search_param[0]['BodyTypeCode']) as $btc) {
               $BodyTypeCode[] = "'".trim($btc)."'";
             }
             $ComplexionCode=array();
             foreach(explode(",",$search_param[0]['ComplexionCode']) as $cmc) {
               $ComplexionCode[] = "'".trim($cmc)."'";
             }
             
             $SearchResults = $mysql->select("select * from _tbl_profiles where `Sex`='".$sexcode."' and `MaritalStatusCode` in (".implode(",",$MatrialStatusCode).") and `ReligionCode` in (".implode(",",$ReligionCode).") and `CasteCode` in (".implode(",",$CasteCode).") and `AnnualIncomeCode` in (".implode(",",$IncomeRangeCode).") and `OccupationTypeCode` in (".implode(",",$OccupationCode).") and `FamilyTypeCode` in (".implode(",",$FamilyTypeCode).") and `WorkedCountryCode` in (".implode(",",$WorkingPlaceCode).") and `DietCode` in (".implode(",",$DietCode).") and `SmokeCode` in (".implode(",",$SmokeCode).") and `DrinkCode` in (".implode(",",$DrinkCode).") and `BodyTypeCode` in (".implode(",",$BodyTypeCode).") and `ComplexionCode` in (".implode(",",$ComplexionCode).") ");
             if (sizeof($SearchResults)==0) {
                return Response::returnSuccess("success",array()); 
             }
             
             $result = array();
             foreach($SearchResults as $p) {
                $result[]=Profiles::getProfileInfo($p['ProfileCode'],1); 
             }
             
             return Response::returnSuccess("success",$result);
         }
         function FranchiseeSearchByProfileID() {
             
             global $mysql,$loginInfo;
             
             $search_param = $mysql->select("select * from `_tbl_member_search_by_profileid` where `SearchID`='".$_POST['Code']."'");
           //  $myprofile = $mysql->select("select * from _tbl_profiles where MemberID='".$loginInfo[0]['MemberID']."'");
              $myprofile = $mysql->select("select * from _tbl_franchisees_staffs where FranchiseeID='".$loginInfo[0]['FranchiseeID']."'");
           
             $sexcode="";
             if ($myprofile[0]['SexCode']=="Male") {
                $sexcode="Female";  
             }
             
             if ($myprofile[0]['SexCode']=="Female") {
                $sexcode="Male";  
             }
             
             $SearchResults = $mysql->select("select * from _tbl_profiles where `ProfileCode`='".$search_param[0]['ProfileID']."'");
             if (sizeof($SearchResults)==0) {
                return Response::returnSuccess("success",array()); 
             }
             
             $result = array();
             foreach($SearchResults as $p) {
                $result[]=Profiles::getProfileInfo($p['ProfileCode'],1); 
             }
             
             return Response::returnSuccess("success",$result);
         }
     }
?>