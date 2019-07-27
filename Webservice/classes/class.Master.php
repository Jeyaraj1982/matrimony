<?php
class Master {
        
        /* Religion Name */
        public function GetManageActiveReligionNames() {
            global $mysql;    
            $ReligionNames = $mysql->select("select * from _tbl_master_codemaster Where HardCode='RELINAMES' and IsActive='1'");
            return Response::returnSuccess("success",$ReligionNames);
        }
        
        public function GetManageDeactiveReligionNames() {
            global $mysql;    
            $ReligionNames = $mysql->select("select * from _tbl_master_codemaster Where HardCode='RELINAMES' and IsActive='0'");
            return Response::returnSuccess("success",$ReligionNames);
        }
        
        public function CreateReligionName() {
            global $mysql;  
            $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='RELINAMES' and SoftCode='".trim($_POST['ReligionCode'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("Religion Code Already Exists");
            }
            $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='RELINAMES' and CodeValue='".trim($_POST['ReligionName'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("Religion Name Already Exists");
            }
            $id = $mysql->insert("_tbl_master_codemaster",array("HardCode"  => "RELINAMES",
                                                                "SoftCode"  => trim($_POST['ReligionCode']),
                                                                "CodeValue" => trim($_POST['ReligionName'])));
            return (sizeof($id)>0) ? Response::returnSuccess("success",array()) : 
                                     Response::returnError("Access denied. Please contact support");   
        }
        
        public function EditReligionName() {
            global $mysql;     
            $data = $mysql->select("select * from _tbl_master_codemaster where  CodeValue='".$_POST['ReligionName']."' and  HardCode='RELINAMES' and SoftCode<>'".$_POST['Code']."'");
            if (sizeof($data)>0) {
                return Response::returnError("Religion Name Already Exists");    
            }
            $mysql->execute("update _tbl_master_codemaster set CodeValue='".$_POST['ReligionName']."',IsActive='".$_POST['IsActive']."' where HardCode='RELINAMES' and SoftCode='".$_POST['Code']."'");
            return Response::returnSuccess("success",array());
        }
        /* End of Religion Name */
    
        /* Caste Name */
        public function CreateCasteName() {
            global $mysql;  
            $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='CASTNAMES' and SoftCode='".trim($_POST['CasteCode'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("Caste Code Already Exists");
            }
            $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='CASTNAMES' and CodeValue='".trim($_POST['CasteName'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("Caste Name Already Exists");
            }
            $id =  $mysql->insert("_tbl_master_codemaster",array("HardCode"   => "CASTNAMES",
                                                                 "SoftCode"   => trim($_POST['CasteCode']),
                                                                 "CodeValue"  => trim($_POST['CasteName'])));
            return (sizeof($id)>0) ? Response::returnSuccess("success",array()) : 
                                     Response::returnError("Access denied. Please contact support");   
        }
        
        public function EditCasteName() {
            global $mysql;
            $data = $mysql->select("select * from _tbl_master_codemaster where  CodeValue='".$_POST['CasteName']."' and  HardCode='CASTNAMES' and SoftCode<>'".$_POST['Code']."'");
            if (sizeof($data)>0) {
                return Response::returnError("Caste Name Already Exists");    
            }
            $mysql->execute("update _tbl_master_codemaster set CodeValue='".$_POST['CasteName']."',IsActive='".$_POST['IsActive']."' where HardCode='CASTNAMES' and  SoftCode='".$_POST['Code']."'");
            return Response::returnSuccess("success",array());
        }
        
        public function GetManageActiveCasteNames() {
            global $mysql;    
            $CasteNames = $mysql->select("select * from _tbl_master_codemaster Where HardCode='CASTNAMES' and IsActive='1'");
            return Response::returnSuccess("success",$CasteNames);
        }
        
        public function GetManageDeactiveCasteNames() {
            global $mysql;    
            $CasteNames = $mysql->select("select * from _tbl_master_codemaster Where HardCode='CASTNAMES' and IsActive='0'");
            return Response::returnSuccess("success",$CasteNames);
        }
        /* End of Caste Name */
    
        /* Star Name */
        public function GetManageActiveStarNames() {
            global $mysql;    
            $StarNames = $mysql->select("select * from _tbl_master_codemaster Where HardCode='STARNAMES' and IsActive='1'");
            return Response::returnSuccess("success",$StarNames);
        }
        
        public function GetManageDeactiveStarNames() {
            global $mysql;    
            $StarNames = $mysql->select("select * from _tbl_master_codemaster Where HardCode='STARNAMES' and IsActive='0'");
            return Response::returnSuccess("success",$StarNames);
        }
        
        public function CreateStarName() {
            global $mysql;  
            $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='STARNAMES' and SoftCode='".trim($_POST['StarCode'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("Star Code Already Exists");
            }
            $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='STARNAMES' and CodeValue='".trim($_POST['StarName'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("Star Name Already Exists");
            }
            $id =  $mysql->insert("_tbl_master_codemaster",array("HardCode"   => "STARNAMES",
                                                                 "SoftCode"   => trim($_POST['StarCode']),
                                                                 "CodeValue"  => trim($_POST['StarName'])));
          
            return (sizeof($id)>0) ? Response::returnSuccess("success",array()) :
                                     Response::returnError("Access denied. Please contact support");   
        }
        
        public function EditStarName() {
            global $mysql;
            $data = $mysql->select("select * from _tbl_master_codemaster where  CodeValue='".$_POST['StarName']."' and  HardCode='STARNAMES' and SoftCode<>'".$_POST['Code']."'");
            if (sizeof($data)>0) {
                return Response::returnError("Star Name Already Exists");    
            }
            $mysql->execute("update _tbl_master_codemaster set CodeValue='".$_POST['StarName']."',IsActive='".$_POST['IsActive']."' where HardCode='STARNAMES' and SoftCode='".$_POST['Code']."'");
            return Response::returnSuccess("success",array());
        }
        /* End of Star Name*/

        /* Nationality Name */
        public function GetManageActiveNationalityNames() {
            global $mysql;
            $NationalityNames = $mysql->select("select * from _tbl_master_codemaster Where HardCode='NATIONALNAMES' and IsActive='1'");
            return Response::returnSuccess("success",$NationalityNames);
        }
        
        public function GetManageDeactiveNationalityNames() {
            global $mysql;    
            $NationalityNames = $mysql->select("select * from _tbl_master_codemaster Where HardCode='NATIONALNAMES' and IsActive='0'");
            return Response::returnSuccess("success",$NationalityNames);
        }
        
        public function CreateNationalityName() {
            global $mysql;  
            $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='NATIONALNAMES' and SoftCode='".trim($_POST['NationalityCode'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("Nationality Code Already Exists");
            }
            $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='NATIONALNAMES' and CodeValue='".trim($_POST['NationalityName'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("Nationality Name Already Exists");
            }
            $id =  $mysql->insert("_tbl_master_codemaster",array("HardCode"  => "NATIONALNAMES",
                                                                 "SoftCode"  => trim($_POST['NationalityCode']),
                                                                 "CodeValue" => trim($_POST['NationalityName'])));
            return (sizeof($id)>0) ? Response::returnSuccess("success",array()) : 
                                     Response::returnError("Access denied. Please contact support");   
        }
        
        public function EditNationalityName(){
            global $mysql;     
            $data = $mysql->select("select * from _tbl_master_codemaster where  CodeValue='".$_POST['NationalityName']."' and  HardCode='NATIONALNAMES' and SoftCode<>'".$_POST['Code']."'");
            if (sizeof($data)>0) {
                return Response::returnError("Nationality Name Already Exists");    
            }
            $mysql->execute("update _tbl_master_codemaster set CodeValue='".$_POST['NationalityName']."',IsActive='".$_POST['IsActive']."' where HardCode='NATIONALNAMES' and SoftCode='".$_POST['Code']."'");
            return Response::returnSuccess("success",array());
        }
        /* End of Nationality Name*/
    
        /* Income Range */
        public function GetManageActiveIncomeRanges() {
            global $mysql;    
            $IncomeRanges = $mysql->select("select * from _tbl_master_codemaster Where HardCode='INCOMERANGE' and IsActive='1'");
            return Response::returnSuccess("success",$IncomeRanges);
        }
       
        public function GetManageDeactiveIncomeRanges() {
            global $mysql;    
            $IncomeRanges = $mysql->select("select * from _tbl_master_codemaster Where HardCode='INCOMERANGE' and IsActive='0'");
            return Response::returnSuccess("success",$IncomeRanges);
        }
        
        public function CreateIncomeRange() {
            global $mysql;  
            $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='INCOMERANGE' and SoftCode='".trim($_POST['IncomeRangeCode'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("Income Range Code Already Exists");
            }
            $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='INCOMERANGE' and CodeValue='".trim($_POST['IncomeRange'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("Income Range Already Exists");
            }
            $id = $mysql->insert("_tbl_master_codemaster",array("HardCode"  => "INCOMERANGE",
                                                                "SoftCode"  => trim($_POST['IncomeRangeCode']),
                                                                "CodeValue" => trim($_POST['IncomeRange'])));
            return (sizeof($id)>0) ? Response::returnSuccess("success",array()) : 
                                     Response::returnError("Access denied. Please contact support");   
        }
        
        public function EditIncomeRange(){  
        
              global $mysql;     
              
              $data = $mysql->select("select * from _tbl_master_codemaster where  CodeValue='".$_POST['IncomeRange']."' and  HardCode='INCOMERANGE' and  SoftCode<>'".$_POST['Code']."'");
              if (sizeof($data)>0) {
                    return Response::returnError("IncomeRange Already Exists");    
              }
              $mysql->execute("update _tbl_master_codemaster set CodeValue='".$_POST['IncomeRange']."',IsActive='".$_POST['IsActive']."' where HardCode='INCOMERANGE' and SoftCode='".$_POST['Code']."'");
              return Response::returnSuccess("success",array());
    }
        /* End of Income Range */

        /* Country Name*/
        public function GetManageActiveCountryNames() {
            global $mysql;    
            $CountryNames = $mysql->select("select * from _tbl_master_codemaster Where HardCode='CONTNAMES' and IsActive='1'");
            return Response::returnSuccess("success",$CountryNames);
        }
        
        public function GetManageDeactiveCountryNames() {
            global $mysql;    
            $CountryNames = $mysql->select("select * from _tbl_master_codemaster Where HardCode='CONTNAMES' and IsActive='0'");
            return Response::returnSuccess("success",$CountryNames);
        }
        
        public function CreateCountryName() {
            global $mysql;  
            $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='CONTNAMES' and SoftCode='".trim($_POST['CountryCode'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("Country Code Already Exists");
            }
            $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='CONTNAMES' and CodeValue='".trim($_POST['CountryName'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("Country Name Already Exists");
            }
            $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='CONTNAMES' and ParamA='".trim($_POST['STDCode'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("Country STD Code Already Exists");
            }
            $id = $mysql->insert("_tbl_master_codemaster",array("HardCode"  => "CONTNAMES",
                                                                "SoftCode"  => trim($_POST['CountryCode']),
                                                                "CodeValue" => trim($_POST['CountryName']),
                                                                "ParamA"    => trim($_POST['STDCode']),
                                                                "ParamB"    => trim($_POST['CurrencyString']),
                                                                "ParamC"    => trim($_POST['CurrencySubString']),
                                                                "ParamD"    => trim($_POST['CurrencyShortString'])));
            return (sizeof($id)>0) ? Response::returnSuccess("success",array()) :
                                     Response::returnError("Access denied. Please contact support");   
        } 
        
        public function EditCountryName() {
            global $mysql;
            $data = $mysql->select("select * from _tbl_master_codemaster where  CodeValue='".$_POST['CountryName']."' and  HardCode='CONTNAMES' and SoftCode<>'".$_POST['Code']."'");
            if (sizeof($data)>0) {
                return Response::returnError("Country Name Already Exists");    
            }
            $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='CONTNAMES' and ParamA='".$_POST['STDCode']."' and  HardCode='CONTNAMES' and SoftCode<>'".$_POST['Code']."'");
            if (sizeof($data)>0) {
                return Response::returnError("Country STD Code Already Exists");    
            }
            $mysql->execute("update _tbl_master_codemaster set CodeValue='".$_POST['CountryName']."',
                                                               IsActive='".$_POST['IsActive']."',
                                                               ParamA='".$_POST['STDCode']."',
                                                               ParamB='".$_POST['CurrencyString']."',
                                                               ParamC='".$_POST['CurrencySubString']."',
                                                               ParamD='".$_POST['CurrencyShortString']."' where HardCode='CONTNAMES' and SoftCode='".$_POST['Code']."'");
            $sql="update _tbl_master_codemaster set CodeValue='".$_POST['CountryName']."',
                                                    IsActive='".$_POST['IsActive']."',
                                                    ParamA='".$_POST['STDCode']."',
                                                    ParamB='".$_POST['CurrencyString']."',
                                                    ParamC='".$_POST['CurrencySubString']."',
                                                    ParamD='".$_POST['CurrencyShortString']."' where HardCode='CONTNAMES' and SoftCode='".$_POST['Code']."'";
            return Response::returnSuccess("success".$sql,array());
        }
        /* End of Country Name*/
    
        /*District Name*/
        public function GetManageActiveDistrictNames() {
            global $mysql;    
            $DistrictNames = $mysql->select("select * from _tbl_master_codemaster Where HardCode='DISTNAMES' and IsActive='1'");
            return Response::returnSuccess("success",$DistrictNames);
        }
        
        public function GetManageDeactiveDistrictNames() {
            global $mysql;    
            $DistrictNames = $mysql->select("select * from _tbl_master_codemaster Where HardCode='DISTNAMES' and IsActive='0'");
            return Response::returnSuccess("success",$DistrictNames);
        }
        
        public function CreateDistrictName() {
            global $mysql;
            $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='DISTNAMES' and SoftCode='".trim($_POST['DistrictCode'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("District Code Already Exists");
            }
            $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='DISTNAMES' and CodeValue='".trim($_POST['DistrictName'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("District Name Already Exists");
            }
            $id =  $mysql->insert("_tbl_master_codemaster",array("HardCode"  => "DISTNAMES",
                                                                 "SoftCode"  => trim($_POST['DistrictCode']),
                                                                 "CodeValue" => trim($_POST['DistrictName']),
                                                                 "ParamA"    => trim($_POST['StateName']),
                                                                 "ParamB"    => trim($_POST['CountryName'])));
            return (sizeof($id)>0) ? Response::returnSuccess("success",array()) : 
                                     Response::returnError("Access denied. Please contact support");   
        }
        
        public function EditDistrictName() {
            global $mysql;     
            $data = $mysql->select("select * from _tbl_master_codemaster where  CodeValue='".$_POST['DistrictName']."' and  HardCode='DISTNAMES' and SoftCode<>'".$_POST['Code']."'");
            if (sizeof($data)>0) {
                return Response::returnError("District Name Already Exists");    
            }
            $mysql->execute("update _tbl_master_codemaster set CodeValue='".$_POST['DistrictName']."',ParamA='".$_POST['StateName']."',ParamB='".$_POST['CountryName']."',IsActive='".$_POST['IsActive']."' where HardCode='DISTNAMES' and  SoftCode='".$_POST['Code']."'");
            return Response::returnSuccess("success",array());
        }
        /* End of District Name */
    
        /* State Names */
        public function GetManageActiveStateNames() {
            global $mysql;    
            $StateNames = $mysql->select("select * from _tbl_master_codemaster Where HardCode='STATNAMES' and IsActive='1'");
            return Response::returnSuccess("success",$StateNames);
        }
        
        public function GetManageDeactiveStateNames() {
            global $mysql;    
            $StateNames = $mysql->select("select * from _tbl_master_codemaster Where HardCode='STATNAMES' and IsActive='0'");
            return Response::returnSuccess("success",$StateNames);
        }
        
        public function CreateStateName() {
            global $mysql;  
            $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='STATNAMES' and SoftCode='".trim($_POST['StateCode'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("State Code Already Exists");
            }
            $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='STATNAMES' and CodeValue='".trim($_POST['StateName'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("State Name Already Exists");
            }
            $id = $mysql->insert("_tbl_master_codemaster",array("HardCode"  => "STATNAMES",
                                                                "SoftCode"  => trim($_POST['StateCode']),
                                                                "CodeValue" => trim($_POST['StateName']),
                                                                "ParamA"    => trim($_POST['CountryName'])));
            return (sizeof($id)>0) ? Response::returnSuccess("success",array()) :
                                     Response::returnError("Access denied. Please contact support");   
        }
        
        public function EditStateName() {
            global $mysql;
            $data = $mysql->select("select * from _tbl_master_codemaster where  CodeValue='".$_POST['StateName']."' and  HardCode='STATNAMES' and  SoftCode<>'".$_POST['Code']."'");
            if (sizeof($data)>0) {
                return Response::returnError("State Name Already Exists");    
            }
            $mysql->execute("update _tbl_master_codemaster set CodeValue='".$_POST['StateName']."',IsActive='".$_POST['IsActive']."' where HardCode='STATNAMES' and SoftCode='".$_POST['Code']."'");
            return Response::returnSuccess("success",array());
        }
        /* End of State Name */
    
        /* Profile SignIn For */
        public function GetManageActiveProfileSignInFors() {
            global $mysql;    
            $ProfileSignInFors = $mysql->select("select * from _tbl_master_codemaster Where HardCode='PROFILESIGNIN' and IsActive='1'");
            return Response::returnSuccess("success",$ProfileSignInFors);
        }
        
        public function GetManageDeactiveProfileSignInFors() {
            global $mysql;    
            $ProfileSignInFors = $mysql->select("select * from _tbl_master_codemaster Where HardCode='PROFILESIGNIN' and IsActive='0'");
            return Response::returnSuccess("success",$ProfileSignInFors);
        }
        
        public function CreateProfileSignInFor() {
            global $mysql;
            $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='PROFILESIGNIN' and SoftCode='".trim($_POST['ProfileSigninForCode'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("ProfileSigninFor Code Already Exists");
            }
            $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='PROFILESIGNIN' and CodeValue='".trim($_POST['ProfileSigninFor'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("ProfileSigninFor Already Exists");
            }
            $id = $mysql->insert("_tbl_master_codemaster",array("HardCode"  => "PROFILESIGNIN",
                                                                "SoftCode"  => trim($_POST['ProfileSigninForCode']),
                                                                "CodeValue" => trim($_POST['ProfileSigninFor'])));
          
            return (sizeof($id)>0) ? Response::returnSuccess("success",array()) :
                                     Response::returnError("Access denied. Please contact support");   
        }
        
        public function EditProfileSignInFor(){
            global $mysql;     
            $data = $mysql->select("select * from _tbl_master_codemaster where  CodeValue='".$_POST['ProfileSigninFor']."' and  HardCode='PROFILESIGNIN' and   SoftCode<>'".$_POST['Code']."'");
            if (sizeof($data)>0) {
                return Response::returnError("ProfileSigninFor Already Exists");    
            }
            $mysql->execute("update _tbl_master_codemaster set CodeValue='".$_POST['ProfileSigninFor']."',IsActive='".$_POST['IsActive']."' where HardCode='PROFILESIGNIN' and SoftCode='".$_POST['Code']."'");
            return Response::returnSuccess("success",array());
        }
        /* End of Profile SignIn For*/
        
        /* Language Name*/
        public function CreateLanguageName() {
            global $mysql;
            $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='LANGUAGENAMES' and SoftCode='".trim($_POST['LanguageNameCode'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("Language Code Code Alreay Exists");
            }
            $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='LANGUAGENAMES' and CodeValue='".trim($_POST['LanguageName'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("Language Name Alreay Exists");
            }
            $id = $mysql->insert("_tbl_master_codemaster",array("HardCode"  => "LANGUAGENAMES",
                                                                "SoftCode"  => trim($_POST['LanguageNameCode']),
                                                                "CodeValue" => trim($_POST['LanguageName'])));
            return (sizeof($id)>0) ? Response::returnSuccess("success",array()) :
                                     Response::returnError("Access denied. Please contact support");   
        }  
        
        public function EditLanguageName() {
            global $mysql;     
            $data = $mysql->select("select * from _tbl_master_codemaster where  CodeValue='".$_POST['LanguageName']."' and  HardCode='LANGUAGENAMES' and SoftCode<>'".$_POST['Code']."'");
            if (sizeof($data)>0) {
                return Response::returnError("Language Name already exists");    
            }
            $mysql->execute("update _tbl_master_codemaster set CodeValue='".$_POST['LanguageName']."',IsActive='".$_POST['IsActive']."' where HardCode='LANGUAGENAMES' and SoftCode='".$_POST['Code']."'");
            return Response::returnSuccess("success",array());
        }
        /* End of Language Name */
        
        /* Marital Status */
        public function CreateMaritalStatus() {
            global $mysql;
            $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='MARTIALSTATUS' and SoftCode='".trim($_POST['MartialStatusCode'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("Marital Status Code Alreay Exists");
            }
            $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='MARTIALSTATUS' and CodeValue='".trim($_POST['MartialStatus'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("Marital Status Alreay Exists");
            }
            $id = $mysql->insert("_tbl_master_codemaster",array("HardCode"  => "MARTIALSTATUS",
                                                                "SoftCode"  => trim($_POST['MartialStatusCode']),
                                                                "CodeValue" => trim($_POST['MartialStatus'])));
            return (sizeof($id)>0) ? Response::returnSuccess("success",array()) :
                                     Response::returnError("Access denied. Please contact support");   
        }
        public function EditMaritalStatus() {
            global $mysql;     
            $data = $mysql->select("select * from _tbl_master_codemaster where  CodeValue='".$_POST['MartialStatus']."' and  HardCode='MARTIALSTATUS' and SoftCode<>'".$_POST['Code']."'");
            if (sizeof($data)>0) {
                return Response::returnError("Marital Status already exists");    
            }
            $mysql->execute("update _tbl_master_codemaster set CodeValue='".$_POST['MartialStatus']."',IsActive='".$_POST['IsActive']."' where HardCode='MARTIALSTATUS' and SoftCode='".$_POST['Code']."'");
            return Response::returnSuccess("success",array());
        }
        /* End of Marital Status */
        
        /* BloodGroup */        
         public function CreateBloodGroup() {
            global $mysql;
            $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='BLOODGROUPS' and SoftCode='".trim($_POST['BloodGroupCode'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("Blood Group Code Alreay Exists");
            }
            $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='BLOODGROUPS' and CodeValue='".trim($_POST['BloodGroupName'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("Blood Group Name Alreay Exists");
            }
            $id = $mysql->insert("_tbl_master_codemaster",array("HardCode"  => "BLOODGROUPS",
                                                                "SoftCode"  => trim($_POST['BloodGroupCode']),
                                                                "CodeValue" => trim($_POST['BloodGroupName'])));
            return (sizeof($id)>0) ? Response::returnSuccess("success",array()) :
                                     Response::returnError("Access denied. Please contact support");   
        }
        public function EditBloodGroupName() {
            global $mysql;     
            $data = $mysql->select("select * from _tbl_master_codemaster where  CodeValue='".$_POST['BloodGroup']."' and  HardCode='BLOODGROUPS' and SoftCode<>'".$_POST['Code']."'");
            if (sizeof($data)>0) {
                return Response::returnError("Blood Group already exists");    
            }
            $mysql->execute("update _tbl_master_codemaster set CodeValue='".$_POST['BloodGroup']."',IsActive='".$_POST['IsActive']."' where HardCode='BLOODGROUPS' and SoftCode='".$_POST['Code']."'");
            return Response::returnSuccess("success",array());
        }
        /* End of Blood Group Name */
        
        /* Complexion */
         public function CreateComplexion() {
            global $mysql;
            $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='COMPLEXIONS' and SoftCode='".trim($_POST['ComplexionCode'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("Complexion Code Alreay Exists");
            }
            $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='COMPLEXIONS' and CodeValue='".trim($_POST['ComplexionName'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("Complexion Name Alreay Exists");
            }
            $id = $mysql->insert("_tbl_master_codemaster",array("HardCode"  => "COMPLEXIONS",
                                                                "SoftCode"  => trim($_POST['ComplexionCode']),
                                                                "CodeValue" => trim($_POST['ComplexionName'])));
            return (sizeof($id)>0) ? Response::returnSuccess("success",array()) :
                                     Response::returnError("Access denied. Please contact support");   
        }
        public function EditComplexion() {
            global $mysql;     
            $data = $mysql->select("select * from _tbl_master_codemaster where  CodeValue='".$_POST['Complexion']."' and  HardCode='COMPLEXIONS' and SoftCode<>'".$_POST['Code']."'");
            if (sizeof($data)>0) {
                return Response::returnError("Complexion already exists");    
            }
            $mysql->execute("update _tbl_master_codemaster set CodeValue='".$_POST['Complexion']."',IsActive='".$_POST['IsActive']."' where HardCode='COMPLEXIONS' and SoftCode='".$_POST['Code']."'");
            return Response::returnSuccess("success",array());
        }
        /* End of Complexion */
        
        /* BodyType */       
        public function CreateBodyType() {
            global $mysql;
            $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='BODYTYPES' and SoftCode='".trim($_POST['BodyTypesCode'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("Body Type Code Alreay Exists");
            }
            $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='BODYTYPES' and CodeValue='".trim($_POST['BodyType'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("Body Type Name Alreay Exists");
            }
            $id = $mysql->insert("_tbl_master_codemaster",array("HardCode"  => "BODYTYPES",
                                                                "SoftCode"  => trim($_POST['BodyTypesCode']),
                                                                "CodeValue" => trim($_POST['BodyType'])));
            return (sizeof($id)>0) ? Response::returnSuccess("success",array()) :
                                     Response::returnError("Access denied. Please contact support");   
        }
        public function EditBodyType() {
            global $mysql;     
            $data = $mysql->select("select * from _tbl_master_codemaster where  CodeValue='".$_POST['BodyType']."' and  HardCode='BODYTYPES' and SoftCode<>'".$_POST['Code']."'");
            if (sizeof($data)>0) {
                return Response::returnError("Body Type already exists");    
            }
            $mysql->execute("update _tbl_master_codemaster set CodeValue='".$_POST['BodyType']."',IsActive='".$_POST['IsActive']."' where HardCode='BODYTYPES' and SoftCode='".$_POST['Code']."'");
            return Response::returnSuccess("success",array());
        }
        /* End of BodyType */
        
        /* Diet  */
         public function CreateDiet() {
            global $mysql;
            $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='DIETS' and SoftCode='".trim($_POST['DietCode'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("Diet Code Alreay Exists");
            }
            $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='DIETS' and CodeValue='".trim($_POST['DietName'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("Diet Alreay Exists");
            }
            $id = $mysql->insert("_tbl_master_codemaster",array("HardCode"  => "DIETS",
                                                                "SoftCode"  => trim($_POST['DietCode']),
                                                                "CodeValue" => trim($_POST['DietName'])));
            return (sizeof($id)>0) ? Response::returnSuccess("success",array()) :
                                     Response::returnError("Access denied. Please contact support");   
        }
        public function EditDiet() {
            global $mysql;     
            $data = $mysql->select("select * from _tbl_master_codemaster where  CodeValue='".$_POST['Diet']."' and  HardCode='DIETS' and SoftCode<>'".$_POST['Code']."'");
            if (sizeof($data)>0) {
                return Response::returnError("Diet already exists");    
            }
            $mysql->execute("update _tbl_master_codemaster set CodeValue='".$_POST['Diet']."',IsActive='".$_POST['IsActive']."' where HardCode='DIETS' and SoftCode='".$_POST['Code']."'");
            return Response::returnSuccess("success",array());
        }
        /* End of Diet */
        
        /* Height  */
         public function CreateHeight() {
            global $mysql;
            $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='HEIGHTS' and SoftCode='".trim($_POST['HeightCode'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("Height Code Alreay Exists");
            }
            $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='HEIGHTS' and CodeValue='".trim($_POST['Height'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("Height Alreay Exists");
            }
            $id = $mysql->insert("_tbl_master_codemaster",array("HardCode"  => "HEIGHTS",
                                                                "SoftCode"  => trim($_POST['HeightCode']),
                                                                "CodeValue" => trim($_POST['Height'])));
            return (sizeof($id)>0) ? Response::returnSuccess("success",array()) :
                                     Response::returnError("Access denied. Please contact support");      
        }
        public function EditHeight() {
            global $mysql;     
            $data = $mysql->select("select * from _tbl_master_codemaster where  CodeValue='".$_POST['Height']."' and  HardCode='HEIGHTS' and SoftCode<>'".$_POST['Code']."'");
            if (sizeof($data)>0) {
                return Response::returnError("Height already exists");    
            }
            $mysql->execute("update _tbl_master_codemaster set CodeValue='".$_POST['Height']."',IsActive='".$_POST['IsActive']."' where HardCode='HEIGHTS' and SoftCode='".$_POST['Code']."'");
            return Response::returnSuccess("success",array());
        }
        /* End of Diet */
        
        /* Bank Name  */
         public function CreateBankName() {
            global $mysql;
            $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='BANKNAMES' and SoftCode='".trim($_POST['BankCode'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("Bank Code Alreay Exists");
            }
            $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='BANKNAMES' and CodeValue='".trim($_POST['BankName'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("Bank Name Already Exists");
            }
            $id = $mysql->insert("_tbl_master_codemaster",array("HardCode"  => "BANKNAMES",
                                                                "SoftCode"  => trim($_POST['BankCode']),
                                                                "CodeValue" => trim($_POST['BankName'])));
            return (sizeof($id)>0) ? Response::returnSuccess("success",array()) :
                                     Response::returnError("Access denied. Please contact support");      
        }
        public function EditBankName() {
            global $mysql;     
            $data = $mysql->select("select * from _tbl_master_codemaster where  CodeValue='".$_POST['BankName']."' and  HardCode='BANKNAMES' and SoftCode<>'".$_POST['Code']."'");
            if (sizeof($data)>0) {
                return Response::returnError("Bank Name already exists");    
            }
            $mysql->execute("update _tbl_master_codemaster set CodeValue='".$_POST['BankName']."',IsActive='".$_POST['IsActive']."' where HardCode='BANKNAMES' and SoftCode='".$_POST['Code']."'");
            return Response::returnSuccess("success",array());
        }
        
        public function CreateLakanam() {
            global $mysql;
            $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='LAKANAM' and SoftCode='".trim($_POST['LakanamCode'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("Lakanam Code Already Exists");
            }
            $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='LAKANAM' and CodeValue='".trim($_POST['Lakanam'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("Lakanam Already Exists");
            }
            $id = $mysql->insert("_tbl_master_codemaster",array("HardCode"  => "LAKANAM",
                                                                "SoftCode"  => trim($_POST['LakanamCode']),
                                                                "CodeValue" => trim($_POST['Lakanam'])));
            return (sizeof($id)>0) ? Response::returnSuccess("success",array()) :
                                     Response::returnError("Access denied. Please contact support");      
        }
        public function EditLakanam() {
            global $mysql;     
            $data = $mysql->select("select * from _tbl_master_codemaster where  CodeValue='".$_POST['Lakanam']."' and  HardCode='LAKANAM' and SoftCode<>'".$_POST['Code']."'");
            if (sizeof($data)>0) {
                return Response::returnError("Lakanam already exists");    
            }
            $mysql->execute("update _tbl_master_codemaster set CodeValue='".$_POST['Lakanam']."',IsActive='".$_POST['IsActive']."' where HardCode='LAKANAM' and SoftCode='".$_POST['Code']."'");
            return Response::returnSuccess("success",array());
        }
        
        public function CreateMonsign() {
            global $mysql;
            $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='MONSIGNS' and SoftCode='".trim($_POST['MonsignCode'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("Monsign Code Already Exists");
            }
            $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='MONSIGNS' and CodeValue='".trim($_POST['Monsign'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("Monsign Already Exists");
            }
            $id = $mysql->insert("_tbl_master_codemaster",array("HardCode"  => "MONSIGNS",
                                                                "SoftCode"  => trim($_POST['MonsignCode']),
                                                                "CodeValue" => trim($_POST['Monsign'])));
            return (sizeof($id)>0) ? Response::returnSuccess("success",array()) :
                                     Response::returnError("Access denied. Please contact support");      
        }
        public function EditMonsign() {
            global $mysql;     
            $data = $mysql->select("select * from _tbl_master_codemaster where  CodeValue='".$_POST['Monsign']."' and  HardCode='MONSIGNS' and SoftCode<>'".$_POST['Code']."'");
            if (sizeof($data)>0) {
                return Response::returnError("Monsign already exists");    
            }
            $mysql->execute("update _tbl_master_codemaster set CodeValue='".$_POST['Monsign']."',IsActive='".$_POST['IsActive']."' where HardCode='MONSIGNS' and SoftCode='".$_POST['Code']."'");
            return Response::returnSuccess("success",array());
        }          
        public function CreateEducationDegree() {
            global $mysql;
            $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='EDUCATIONDEGREES' and SoftCode='".trim($_POST['EducationDegreeCode'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("Education DegreeCode Already Exists");
            }
            $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='EDUCATIONDEGREES' and CodeValue='".trim($_POST['EducationDegree'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("Education Degree Already Exists");
            }
            $id = $mysql->insert("_tbl_master_codemaster",array("HardCode"  => "EDUCATIONDEGREES",
                                                                "SoftCode"  => trim($_POST['EducationDegreeCode']),
                                                                "CodeValue" => trim($_POST['EducationDegree'])));
            return (sizeof($id)>0) ? Response::returnSuccess("success",array()) :
                                     Response::returnError("Access denied. Please contact support");      
        }
        public function EditEducationDegree() {
            global $mysql;     
            $data = $mysql->select("select * from _tbl_master_codemaster where  CodeValue='".$_POST['EducationDegree']."' and  HardCode='EDUCATIONDEGREES' and SoftCode<>'".$_POST['Code']."'");
            if (sizeof($data)>0) {
                return Response::returnError("Education already exists");    
            }
            $mysql->execute("update _tbl_master_codemaster set CodeValue='".$_POST['EducationDegree']."',IsActive='".$_POST['IsActive']."' where HardCode='EDUCATIONDEGREES' and SoftCode='".$_POST['Code']."'");
            return Response::returnSuccess("success",array());
        } 
    public function CreateEducationTitle() {
            global $mysql;
            $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='EDUCATETITLES' and SoftCode='".trim($_POST['EducationTitleCode'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("Education Title Code Already Exists");
            }
            $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='EDUCATETITLES' and CodeValue='".trim($_POST['EducationTitle'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("Education Title Already Exists");
            }
            $id = $mysql->insert("_tbl_master_codemaster",array("HardCode"  => "EDUCATETITLES",
                                                                "SoftCode"  => trim($_POST['EducationTitleCode']),
                                                                "CodeValue" => trim($_POST['EducationTitle'])));
            return (sizeof($id)>0) ? Response::returnSuccess("success",array()) :
                                     Response::returnError("Access denied. Please contact support");      
        }
             
     public function EditEducationTitle() {
            global $mysql;     
            $data = $mysql->select("select * from _tbl_master_codemaster where  CodeValue='".$_POST['EducationTitle']."' and  HardCode='EDUCATETITLES' and SoftCode<>'".$_POST['Code']."'");
            if (sizeof($data)>0) {
                return Response::returnError("Education Title already exists");    
            }
            $mysql->execute("update _tbl_master_codemaster set CodeValue='".$_POST['EducationTitle']."',IsActive='".$_POST['IsActive']."' where HardCode='EDUCATETITLES' and SoftCode='".$_POST['Code']."'");
            return Response::returnSuccess("success",array());
        }
        public function CreateOccupationType() {
            global $mysql;
            $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='OCCUPATIONTYPES' and SoftCode='".trim($_POST['OccupationTypeCode'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("Occupation Type Code Already Exists");
            }
            $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='OCCUPATIONTYPES' and CodeValue='".trim($_POST['OccupationType'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("Occupation Type Already Exists");
            }
            $id = $mysql->insert("_tbl_master_codemaster",array("HardCode"  => "OCCUPATIONTYPES",
                                                                "SoftCode"  => trim($_POST['OccupationTypeCode']),
                                                                "CodeValue" => trim($_POST['OccupationType'])));
            return (sizeof($id)>0) ? Response::returnSuccess("success",array()) :
                                     Response::returnError("Access denied. Please contact support");      
        }
             
     public function EditOccupationType() {
            global $mysql;     
            $data = $mysql->select("select * from _tbl_master_codemaster where  CodeValue='".$_POST['OccupationType']."' and  HardCode='OCCUPATIONTYPES' and SoftCode<>'".$_POST['Code']."'");
            if (sizeof($data)>0) {
                return Response::returnError("Occupation Type already exists");    
            }
            $mysql->execute("update _tbl_master_codemaster set CodeValue='".$_POST['OccupationType']."',IsActive='".$_POST['IsActive']."' where HardCode='OCCUPATIONTYPES' and SoftCode='".$_POST['Code']."'");
            return Response::returnSuccess("success",array());
        } 
        public function CreateOccupation() {
            global $mysql;
            $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='OCCUPATIONS' and SoftCode='".trim($_POST['OccupationCode'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("Occupation Code Already Exists");
            }
            $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='OCCUPATIONS' and CodeValue='".trim($_POST['OccupationName'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("Occupation Name Already Exists");
            }
            $id = $mysql->insert("_tbl_master_codemaster",array("HardCode"  => "OCCUPATIONS",
                                                                "SoftCode"  => trim($_POST['OccupationCode']),
                                                                "CodeValue" => trim($_POST['OccupationName'])));
            return (sizeof($id)>0) ? Response::returnSuccess("success",array()) :
                                     Response::returnError("Access denied. Please contact support");      
        }
             
     public function EditOccupation() {
            global $mysql;     
            $data = $mysql->select("select * from _tbl_master_codemaster where  CodeValue='".$_POST['Occupation']."' and  HardCode='OCCUPATIONS' and SoftCode<>'".$_POST['Code']."'");
            if (sizeof($data)>0) {
                return Response::returnError("Occupation Name already exists");    
            }
            $mysql->execute("update _tbl_master_codemaster set CodeValue='".$_POST['Occupation']."',IsActive='".$_POST['IsActive']."' where HardCode='OCCUPATIONS' and SoftCode='".$_POST['Code']."'");
            return Response::returnSuccess("success",array());
        }
        
        public function CreateWeight() {
            global $mysql;
            $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='WEIGHTS' and SoftCode='".trim($_POST['WeightCode'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("Weight Code Already Exists");
            }
            $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='WEIGHTS' and CodeValue='".trim($_POST['Weight'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("Weight Already Exists");
            }
            $id = $mysql->insert("_tbl_master_codemaster",array("HardCode"  => "WEIGHTS",
                                                                "SoftCode"  => trim($_POST['WeightCode']),
                                                                "CodeValue" => trim($_POST['Weight'])));
            return (sizeof($id)>0) ? Response::returnSuccess("success",array()) :
                                     Response::returnError("Access denied. Please contact support");      
        }
             
     public function EditWeight() {
            global $mysql;     
            $data = $mysql->select("select * from _tbl_master_codemaster where  CodeValue='".$_POST['Weight']."' and  HardCode='WEIGHTS' and SoftCode<>'".$_POST['Code']."'");
            if (sizeof($data)>0) {
                return Response::returnError("Weight already exists");    
            }
            $mysql->execute("update _tbl_master_codemaster set CodeValue='".$_POST['Weight']."',IsActive='".$_POST['IsActive']."' where HardCode='WEIGHTS' and SoftCode='".$_POST['Code']."'");
            return Response::returnSuccess("success",array());
        }
        
        public function CreateFamilyType() {
            global $mysql;
            $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='FAMILYTYPE' and SoftCode='".trim($_POST['FamilyTypeCode'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("Family Type Code Already Exists");
            }
            $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='FAMILYTYPE' and CodeValue='".trim($_POST['FamilyType'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("Family Type Name Already Exists");
            }
            $id = $mysql->insert("_tbl_master_codemaster",array("HardCode"  => "FAMILYTYPE",
                                                                "SoftCode"  => trim($_POST['FamilyTypeCode']),
                                                                "CodeValue" => trim($_POST['FamilyType'])));
            return (sizeof($id)>0) ? Response::returnSuccess("success",array()) :
                                     Response::returnError("Access denied. Please contact support");      
        }                                                                                                              
             
     public function EditFamilyType() {
            global $mysql;     
            $data = $mysql->select("select * from _tbl_master_codemaster where  CodeValue='".$_POST['FamilyType']."' and  HardCode='FAMILYTYPE' and SoftCode<>'".$_POST['Code']."'");
            if (sizeof($data)>0) {
                return Response::returnError("Family Type already exists");    
            }
            $mysql->execute("update _tbl_master_codemaster set CodeValue='".$_POST['FamilyType']."',IsActive='".$_POST['IsActive']."' where HardCode='FAMILYTYPE' and SoftCode='".$_POST['Code']."'");
            return Response::returnSuccess("success",array());
        }
        
        public function CreateFamilyValue() {
            global $mysql;
            $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='FAMILYVALUE' and SoftCode='".trim($_POST['FamilyValueCode'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("Family Value Code Already Exists");
            }
            $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='FAMILYVALUE' and CodeValue='".trim($_POST['FamilyValue'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("Family Value Name Already Exists");
            }
            $id = $mysql->insert("_tbl_master_codemaster",array("HardCode"  => "FAMILYVALUE",
                                                                "SoftCode"  => trim($_POST['FamilyValueCode']),
                                                                "CodeValue" => trim($_POST['FamilyValue'])));
            return (sizeof($id)>0) ? Response::returnSuccess("success",array()) :
                                     Response::returnError("Access denied. Please contact support");      
        }                                                                                                              
             
     public function EditFamilyValue() {
            global $mysql;     
            $data = $mysql->select("select * from _tbl_master_codemaster where  CodeValue='".$_POST['FamilyValue']."' and  HardCode='FAMILYVALUE' and SoftCode<>'".$_POST['Code']."'");
            if (sizeof($data)>0) {
                return Response::returnError("Family Value already exists");    
            }
            $mysql->execute("update _tbl_master_codemaster set CodeValue='".$_POST['FamilyValue']."',IsActive='".$_POST['IsActive']."' where HardCode='FAMILYVALUE' and SoftCode='".$_POST['Code']."'");
            return Response::returnSuccess("success",array());
        }
        public function CreateFamilyAffluence() {
            global $mysql;
            $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='FAMILYAFFLUENCE' and SoftCode='".trim($_POST['FamilyAffluenceCode'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("Family Affluence Code Already Exists");
            }
            $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='FAMILYAFFLUENCE' and CodeValue='".trim($_POST['FamilyAffluence'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("Family Affluence Name Already Exists");
            }
            $id = $mysql->insert("_tbl_master_codemaster",array("HardCode"  => "FAMILYAFFLUENCE",
                                                                "SoftCode"  => trim($_POST['FamilyAffluenceCode']),
                                                                "CodeValue" => trim($_POST['FamilyAffluenceName'])));
            return (sizeof($id)>0) ? Response::returnSuccess("success",array()) :
                                     Response::returnError("Access denied. Please contact support");      
        }                                                                                                              
             
     public function EditFamilyAffluence() {
            global $mysql;     
            $data = $mysql->select("select * from _tbl_master_codemaster where  CodeValue='".$_POST['FamilyAffluence']."' and  HardCode='FAMILYAFFLUENCE' and SoftCode<>'".$_POST['Code']."'");
            if (sizeof($data)>0) {
                return Response::returnError("Family Affluence already exists");    
            }
            $mysql->execute("update _tbl_master_codemaster set CodeValue='".$_POST['FamilyAffluence']."',IsActive='".$_POST['IsActive']."' where HardCode='FAMILYAFFLUENCE' and SoftCode='".$_POST['Code']."'");
            return Response::returnSuccess("success",array());
        }
        
        public function GetMasterAllViewInfo(){
        
        global $mysql;
        
        $ViewInfo = $mysql->select("select * from _tbl_master_codemaster where SoftCode='".$_POST['Code']."'");
        return Response::returnSuccess("success",array("ViewInfo" => $ViewInfo[0]));
                                                            
    }
    }
?>