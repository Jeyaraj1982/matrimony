<?php
     class Matches {
         
         function BasicSearchProfile() {
                global $mysql,$loginInfo;
             
             $result = array();
             
             $myprofile = $mysql->select("select * from _tbl_profiles where MemberID='".$loginInfo[0]['MemberID']."'");
             if (sizeof($myprofile)==0) {
                return Response::returnSuccess("success",$result); 
             }
             
             $sexcode="";
             if ($myprofile[0]['SexCode']=="SX001") {
                $sexcode="SX002";  
             }
             
             if ($myprofile[0]['SexCode']=="SX002") {
                $sexcode="SX001";  
             }
             
             $Profiles = $mysql->select("select * from _tbl_profiles where `SexCode`='".$sexcode."'");
             
             foreach($Profiles as $p) {
                $result[]=Profiles::getProfileInfo($p['ProfileCode'],1); 
             }
             
             return Response::returnSuccess("success",$result);
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
             
             $myprofile = $mysql->select("select * from _tbl_draft_profiles where MemberID='".$loginInfo[0]['MemberID']."'");
             if (sizeof($myprofile)==0) {
                return Response::returnError("you must create a profile",array("param"=>"profile"));   
             }
             
             /* validate active profiles */  
             $Profiles = $mysql->select("select * from _tbl_profiles where `SexCode`='".(($myprofile[0]['SexCode']=="SX001") ? "SX002" : "SX002")."'");
             foreach($Profiles as $p) {
                $result[]=Profiles::getProfileInfo($p['ProfileCode'],1); 
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
                return Response::returnError("you must create a profile",array("param"=>"profile"));   
             }
             
             /* validate active profiles */  
             $Profiles = $mysql->select("select * from _tbl_profiles where `SexCode`='".(($myprofile[0]['SexCode']=="SX001") ? "SX002" : "SX002")."'");
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
                return Response::returnError("you must create a profile",array("param"=>"profile"));   
             }
             
             /* validate active profiles */  
             $Profiles = $mysql->select("select * from _tbl_profiles where `SexCode`='".(($myprofile[0]['SexCode']=="SX001") ? "SX002" : "SX002")."'");
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
                return Response::returnError("you must create a profile",array("param"=>"profile"));   
             }
             
             /* validate active profiles */  
             $Profiles = $mysql->select("select * from _tbl_profiles where `SexCode`='".(($myprofile[0]['SexCode']=="SX001") ? "SX002" : "SX002")."'");
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
                return Response::returnError("you must create a profile",array("param"=>"profile"));   
             }
             
             /* validate active profiles */  
             $Profiles = $mysql->select("select * from _tbl_profiles where `SexCode`='".(($myprofile[0]['SexCode']=="SX001") ? "SX002" : "SX002")."'");
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
                return Response::returnError("you must create a profile",array("param"=>"profile"));   
             }
             
             /* validate active profiles */  
             $Profiles = $mysql->select("select * from _tbl_profiles where `SexCode`='".(($myprofile[0]['SexCode']=="SX001") ? "SX002" : "SX002")."'");
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
                return Response::returnError("you must create a profile",array("param"=>"profile"));   
             }
             
             /* validate active profiles */  
             $Profiles = $mysql->select("select * from _tbl_profiles where `SexCode`='".(($myprofile[0]['SexCode']=="SX001") ? "SX002" : "SX002")."'");
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
                return Response::returnError("you must create a profile",array("param"=>"profile"));   
             }
             
             /* validate active profiles */  
             $Profiles = $mysql->select("select * from _tbl_profiles where `SexCode`='".(($myprofile[0]['SexCode']=="SX001") ? "SX002" : "SX002")."'");
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
                return Response::returnError("you must create a profile",array("param"=>"profile"));   
             }
             
             /* validate active profiles */  
             $Profiles = $mysql->select("select * from _tbl_profiles where `SexCode`='".(($myprofile[0]['SexCode']=="SX001") ? "SX002" : "SX002")."'");
             foreach($Profiles as $p) {
                $result[]=Profiles::getProfileInfo($p['ProfileCode'],1); 
             }
             
             return Response::returnSuccess("success",$result);
         }
     }
?>