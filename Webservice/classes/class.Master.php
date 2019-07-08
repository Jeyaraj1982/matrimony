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
                return Response::returnError("Language Name Code Alreay Exists");
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
        /* End of Language Name*/        

        public function GetMasterAllViewInfo(){
        
        global $mysql;
        
        $ViewInfo = $mysql->select("select * from _tbl_master_codemaster where SoftCode='".$_POST['Code']."'");
        return Response::returnSuccess("success",array("ViewInfo" => $ViewInfo[0]));
                                                            
    }
    }
?>