<?php
     class Matches {
         
         function BasicSearchProfile() {
                global $mysql,$loginInfo;

                  $Profiles = $mysql->select("select * from _tbl_profiles");
                  $result = array();
                  foreach($Profiles as $p) {
                      $p['profileImage']= $p['SexCode']=="SX002" ? "assets/images/noprofile_female.png" : "assets/images/noprofile_male.png";
                     $result[]=$p; 
                  }
                return Response::returnSuccess("success",$result);
         }
         
         function MatchedMyExpectation() {
                global $mysql,$loginInfo;

                  $Profiles = $mysql->select("select * from _tbl_profiles");
                  $result = array();
                  foreach($Profiles as $p) {
                      $p['profileImage']= $p['SexCode']=="SX002" ? "assets/images/noprofile_female.png" : "assets/images/noprofile_male.png";
                     $result[]=$p; 
                  }
                return Response::returnSuccess("success",$result);
         }
         
         function MatchesNearByMe() {
                global $mysql,$loginInfo;

                  $Profiles = $mysql->select("select * from _tbl_profiles");
                  $result = array();
                  foreach($Profiles as $p) {
                      $p['profileImage']= $p['SexCode']=="SX002" ? "assets/images/noprofile_female.png" : "assets/images/noprofile_male.png";
                     $result[]=$p; 
                  }
                return Response::returnSuccess("success",$result);
         }
         
         function MatchesRecentlyAdded() {
                global $mysql,$loginInfo;

                  $Profiles = $mysql->select("select * from _tbl_profiles");
                  $result = array();
                  foreach($Profiles as $p) {
                      $p['profileImage']= $p['SexCode']=="SX002" ? "assets/images/noprofile_female.png" : "assets/images/noprofile_male.png";
                     $result[]=$p; 
                  }
                return Response::returnSuccess("success",$result);
         }
         
         function MatchesMostPopular() {
                global $mysql,$loginInfo;

                  $Profiles = $mysql->select("select * from _tbl_profiles");
                  $result = array();
                  foreach($Profiles as $p) {
                      $p['profileImage']= $p['SexCode']=="SX002" ? "assets/images/noprofile_female.png" : "assets/images/noprofile_male.png";
                     $result[]=$p; 
                  }
                return Response::returnSuccess("success",$result);
         }
         
         function MatchesReligion() {
                global $mysql,$loginInfo;

                  $Profiles = $mysql->select("select * from _tbl_profiles");
                  $result = array();
                  foreach($Profiles as $p) {
                      $p['profileImage']= $p['SexCode']=="SX002" ? "assets/images/noprofile_female.png" : "assets/images/noprofile_male.png";
                     $result[]=$p; 
                  }
                return Response::returnSuccess("success",$result);
         }
         
         function MatchesIncome() {
                global $mysql,$loginInfo;

                  $Profiles = $mysql->select("select * from _tbl_profiles");
                  $result = array();
                  foreach($Profiles as $p) {
                      $p['profileImage']= $p['SexCode']=="SX002" ? "assets/images/noprofile_female.png" : "assets/images/noprofile_male.png";
                     $result[]=$p; 
                  }
                return Response::returnSuccess("success",$result);
         }
         
         function MatchesEducation() {
                global $mysql,$loginInfo;

                  $Profiles = $mysql->select("select * from _tbl_profiles");
                  $result = array();
                  foreach($Profiles as $p) {
                      $p['profileImage']= $p['SexCode']=="SX002" ? "assets/images/noprofile_female.png" : "assets/images/noprofile_male.png";
                     $result[]=$p; 
                  }
                return Response::returnSuccess("success",$result);
         }
         
         function MatchesOccupation() {
                global $mysql,$loginInfo;

                  $Profiles = $mysql->select("select * from _tbl_profiles");
                  $result = array();
                  foreach($Profiles as $p) {
                      $p['profileImage']= $p['SexCode']=="SX002" ? "assets/images/noprofile_female.png" : "assets/images/noprofile_male.png";
                     $result[]=$p; 
                  }
                return Response::returnSuccess("success",$result);
         }
         
         function MatchesOthers() {
                global $mysql,$loginInfo;

                  $Profiles = $mysql->select("select * from _tbl_profiles");
                  $result = array();
                  foreach($Profiles as $p) {
                      $p['profileImage']= $p['SexCode']=="SX002" ? "assets/images/noprofile_female.png" : "assets/images/noprofile_male.png";
                     $result[]=$p; 
                  }
                return Response::returnSuccess("success",$result);
         }
     }
?>