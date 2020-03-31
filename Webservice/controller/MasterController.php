<?php
    class CodeMaster {
       
		static public function getActiveData($Request) {
			return CodeMaster::getData($Request,array("IsActive"=>"1"));
		}
        static public function getData($Request,$filter=null) {  
            
            global $mysql;
            if (is_array($filter)) {
                $array_data = "";
				$array_index_isnumber=0;
                
				foreach($filter as $k=>$v ) {
					//if (intval($k)) {
                        if (is_int($k)) {
					 	$array_index_isnumber++;
					} else {
                    $array_data .= " and `".$k."` = '".$v."' ";
					}
                }
				
				if ($array_index_isnumber>0) {
					$new_filter = array();
					foreach($filter as $f) {
						$new_filter[] = "'".$f."'";  
					}
					$array_data = " and `SoftCode` in (".implode($new_filter,",").") ";	
				}
				
				$filter=$array_data;
            } else {
                $filter = ($filter!=null) ?  " and SoftCode='".trim($filter)."'" : "";
            }   
            
            $quries = array("SEX"                => "select * from `_tbl_master_codemaster` Where `HardCode`='SEX'".$filter." order by `CodeValue` ASC ",
                            "MARTIALSTATUS"      => "select * from `_tbl_master_codemaster` Where `HardCode`='MARTIALSTATUS'".$filter." order by `CodeValue` ASC" ,
                            "LANGUAGENAMES"      => "select * from `_tbl_master_codemaster` Where `HardCode`='LANGUAGENAMES'".$filter." order by `CodeValue` ASC",
                            "RELINAMES"          => "select * from `_tbl_master_codemaster` Where `HardCode`='RELINAMES'".$filter." order by `CodeValue` ASC",
                            "CASTNAMES"          => "select * from `_tbl_master_codemaster` Where `HardCode`='CASTNAMES'".$filter." order by `CodeValue` ASC",
                            "COMMUNITY"          => "select * from `_tbl_master_codemaster` Where `HardCode`='COMMUNITY'".$filter." order by `CodeValue` ASC",
                            "NATIONALNAMES"      => "select * from `_tbl_master_codemaster` Where `HardCode`='NATIONALNAMES'".$filter." order by `CodeValue` ASC",
                            "TYPEOFOCCUPATIONS"  => "select * from `_tbl_master_codemaster` Where `HardCode`='TYPEOFOCCUPATIONS'".$filter." order by `CodeValue` ASC",
                            "PROFILESIGNIN"      => "select * from `_tbl_master_codemaster` Where `HardCode`='PROFILESIGNIN'".$filter." order by `CodeValue` ASC",
                            "INCOMERANGE"        => "select * from `_tbl_master_codemaster` Where `HardCode`='INCOMERANGE'".$filter." order by `CodeValue` ASC",
                            "HEIGHTS"            => "select * from `_tbl_master_codemaster` Where `HardCode`='HEIGHTS'".$filter." order by `CodeValue` ASC",
                            "DIETS"              => "select * from `_tbl_master_codemaster` Where `HardCode`='DIETS'".$filter." order by `CodeValue` ASC",
                            "SMOKINGHABITS"      => "select * from `_tbl_master_codemaster` Where `HardCode`='SMOKINGHABITS'".$filter." order by `CodeValue` ASC",
                            "WEIGHTS"            => "select * from `_tbl_master_codemaster` Where `HardCode`='WEIGHTS'".$filter." order by `CodeValue` ASC",
                            "BLOODGROUPS"        => "select * from `_tbl_master_codemaster` Where `HardCode`='BLOODGROUPS'".$filter." order by `CodeValue` ASC",
                            "DRINKINGHABITS"     => "select * from `_tbl_master_codemaster` Where `HardCode`='DRINKINGHABITS'".$filter." order by `CodeValue` ASC",
                            "COMPLEXIONS"        => "select * from `_tbl_master_codemaster` WHERE `HardCode`='COMPLEXIONS'".$filter." order by `CodeValue` ASC",
                            "BODYTYPES"          => "select * from `_tbl_master_codemaster` Where `HardCode`='BODYTYPES'".$filter." order by `CodeValue` ASC",
                            "FAMILYTYPE"         => "select * from `_tbl_master_codemaster` Where `HardCode`='FAMILYTYPE'".$filter." order by `CodeValue` ASC",
                            "FAMILYVALUE"        => "select * from `_tbl_master_codemaster` Where `HardCode`='FAMILYVALUE'".$filter." order by `CodeValue` ASC",
                            "FAMILYAFFLUENCE"    => "select * from `_tbl_master_codemaster` Where `HardCode`='FAMILYAFFLUENCE'".$filter." order by `CodeValue` ASC",
                            "NUMBEROFBROTHER"    => "select * from `_tbl_master_codemaster` Where `HardCode`='NUMBEROFBROTHER'".$filter." order by `CodeValue` ASC",
                            "ELDER"              => "select * from `_tbl_master_codemaster` Where `HardCode`='ELDER'".$filter." order by `CodeValue` ASC",
                            "YOUNGER"            => "select * from `_tbl_master_codemaster` Where `HardCode`='YOUNGER'".$filter." order by `CodeValue` ASC",
                            "CONTNAMES"          => "select * from `_tbl_master_codemaster` Where `HardCode`='CONTNAMES'".$filter." order by `CodeValue` ASC",
                            "STATNAMES"          => "select * from `_tbl_master_codemaster` Where `HardCode`='STATNAMES'".$filter." order by `CodeValue` ASC",
                            "OCCUPATIONS"        => "select * from `_tbl_master_codemaster` Where `HardCode`='OCCUPATIONS'".$filter." order by `CodeValue` ASC",
                            "MARRIED"            => "select * from `_tbl_master_codemaster` Where `HardCode`='MARRIED'".$filter." order by `CodeValue` ASC",
                            "NOOFSISTER"         => "select * from `_tbl_master_codemaster` Where `HardCode`='NOOFSISTER'".$filter." order by `CodeValue` ASC",
                            "ELDERSIS"           => "select * from `_tbl_master_codemaster` Where `HardCode`='ELDERSIS'".$filter." order by `CodeValue` ASC",
                            "YOUNGERSIS"         => "select * from `_tbl_master_codemaster` Where `HardCode`='YOUNGERSIS'".$filter." order by `CodeValue` ASC",
                            "MARRIEDSIS"         => "select * from `_tbl_master_codemaster` Where `HardCode`='MARRIEDSIS'".$filter." order by `CodeValue` ASC",
                            "PHYSICALLYIMPAIRED" => "select * from `_tbl_master_codemaster` Where `HardCode`='PHYSICALLYIMPAIRED'".$filter." order by `CodeValue` ASC",
                            "VISUALLYIMPAIRED"   => "select * from `_tbl_master_codemaster` Where `HardCode`='VISUALLYIMPAIRED'".$filter." order by `CodeValue` ASC",
                            "VISSIONIMPAIRED"    => "select * from `_tbl_master_codemaster` Where `HardCode`='VISSIONIMPAIRED'".$filter." order by `CodeValue` ASC",
                            "SPEECHIMPAIRED"     => "select * from `_tbl_master_codemaster` Where `HardCode`='SPEECHIMPAIRED'".$filter." order by `CodeValue` ASC",
                            "DOCTYPES"           => "select * from `_tbl_master_codemaster` Where `HardCode`='DOCTYPES'".$filter." order by `CodeValue` ASC",
                            "IDPROOF"            => "select * from `_tbl_master_codemaster` Where `HardCode`='IDPROOF'".$filter." order by `CodeValue` ASC",
                            "ADDRESSPROOF"       => "select * from `_tbl_master_codemaster` Where `HardCode`='ADDRESSPROOF'".$filter." order by `CodeValue` ASC",
                            "MODE"               => "select * from `_tbl_master_codemaster` Where `HardCode`='MODE'".$filter." order by `CodeValue` ASC",
                            "STARNAMES"          => "select * from `_tbl_master_codemaster` Where `HardCode`='STARNAMES'".$filter." order by `CodeValue` ASC",                          
                            "MONSIGNS"           => "select * from `_tbl_master_codemaster` Where `HardCode`='MONSIGNS'".$filter." order by `CodeValue` ASC",
                            "LAKANAM"            => "select * from `_tbl_master_codemaster` Where `HardCode`='LAKANAM'".$filter." order by `CodeValue` ASC",
                            "EDUCATETITLES"      => "select * from `_tbl_master_codemaster` Where `HardCode`='EDUCATETITLES'".$filter." order by `CodeValue` ASC",
                            "DistrictName"       => "select * from `_tbl_master_codemaster` Where `HardCode`='DISTNAMES'".$filter." order by `CodeValue` ASC",
                            "Occupation"         => "select * from `_tbl_master_codemaster` Where `HardCode`='OCCUPATIONTYPES'".$filter." order by `CodeValue` ASC",
                            "EMPLOYEDAS"         => "select * from `_tbl_master_codemaster` Where `HardCode`='EMPLOYEDAS'".$filter." order by `CodeValue` ASC",
                            "Secure"             => "select * from `_tbl_master_codemaster` Where `HardCode`='SECURE'".$filter." order by `CodeValue` ASC",
                            "AccountType"        => "select * from `_tbl_master_codemaster` Where `HardCode`='ACCOUNTTYPE'".$filter." order by `CodeValue` ASC",
                            "BANKNAMES"          => "select * from `_tbl_master_codemaster` Where `HardCode`='BANKNAMES'".$filter." order by `CodeValue` ASC",
                            "SMSMETHOD"          => "select * from `_tbl_master_codemaster` Where `HardCode`='SMSMETHOD'".$filter." order by `CodeValue` ASC",
                            "TIMEDOUT"           => "select * from `_tbl_master_codemaster` Where `HardCode`='TIMEDOUT'".$filter." order by `CodeValue` ASC",
                            "MODEOFTRANSFER"     => "select * from `_tbl_master_codemaster` Where `HardCode`='MODEOFTRANSFER'".$filter." order by `CodeValue` ASC",
                            "EDUCATIONDEGREES"   => "select * from `_tbl_master_codemaster` Where `HardCode`='EDUCATIONDEGREES'".$filter." order by `CodeValue` ASC",
                            "PARENTSALIVE"       => "select * from `_tbl_master_codemaster` Where `HardCode`='PARENTSALIVE'".$filter." order by `CodeValue` ASC",
                            "CHEVVAIDHOSHAM"     => "select * from `_tbl_master_codemaster` Where `HardCode`='CHEVVAIDHOSHAM'".$filter." order by `CodeValue` ASC",
                            "DELETEREASON"       => "select * from `_tbl_master_codemaster` Where `HardCode`='DELETEREASON'".$filter." order by `CodeValue` ASC",
                            "PRIMARYPRIORITY"    => "select * from `_tbl_master_codemaster` Where `HardCode`='PRIMARYPRIORITY'".$filter." order by `CodeValue` ASC",
                            "TEAMNAMES"    		 => "select * from `_tbl_master_codemaster` Where `HardCode`='TEAMNAMES'".$filter." order by `CodeValue` ASC",
                            "VENDORTYPE"    		 => "select * from `_tbl_master_codemaster` Where `HardCode`='VENDORTYPE'".$filter." order by `CodeValue` ASC",
                            "PAYPALCURRENCY"             => "select * from `_tbl_master_codemaster` Where `HardCode`='PAYPALCURRENCY'".$filter." order by `CodeValue` ASC",
                            "TIMEZONE"             => "select * from `_tbl_master_codemaster` Where `HardCode`='TIMEZONE'".$filter." order by `CodeValue` ASC",
                            "CURRENCY"             => "select * from `_tbl_master_codemaster` Where `HardCode`='CURRENCY'".$filter." order by `CodeValue` ASC",
                            "DOCTYPES"             => "select * from `_tbl_master_codemaster` Where `HardCode`='DOCTYPES'".$filter." order by `CodeValue` ASC",
                            "SERVICEREQUESTFOR"             => "select * from `_tbl_master_codemaster` Where `HardCode`='SERVICEREQUESTFOR'".$filter." order by `CodeValue` ASC",
                            "APPSETTINGS"    		 => "select * from `_tbl_master_codemaster` Where `HardCode`='APPSETTINGS'".$filter." order by `CodeValue` ASC",
                            "RegisterAllowedCountries" => "select *, CONCAT(CodeValue,' (+',ParamA,')') as str FROM `_tbl_master_codemaster`  WHERE `HardCode`='CONTNAMES' and ParamE='1' order by `CodeValue` ASC");
              return $mysql->select($quries[$Request]);
        }
    }
?>  