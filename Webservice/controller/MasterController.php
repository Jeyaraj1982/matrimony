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
            
            $quries = array("SEX"                => "select * from `_tbl_master_codemaster` Where `HardCode`='SEX'".$filter,
                            "MARTIALSTATUS"      => "select * from `_tbl_master_codemaster` Where `HardCode`='MARTIALSTATUS'".$filter,
                            "LANGUAGENAMES"      => "select * from `_tbl_master_codemaster` Where `HardCode`='LANGUAGENAMES'".$filter,
                            "RELINAMES"          => "select * from `_tbl_master_codemaster` Where `HardCode`='RELINAMES'".$filter,
                            "CASTNAMES"          => "select * from `_tbl_master_codemaster` Where `HardCode`='CASTNAMES'".$filter,
                            "COMMUNITY"          => "select * from `_tbl_master_codemaster` Where `HardCode`='COMMUNITY'".$filter,
                            "NATIONALNAMES"      => "select * from `_tbl_master_codemaster` Where `HardCode`='NATIONALNAMES'".$filter,
                            "TYPEOFOCCUPATIONS"  => "select * from `_tbl_master_codemaster` Where `HardCode`='TYPEOFOCCUPATIONS'".$filter,
                            "PROFILESIGNIN"      => "select * from `_tbl_master_codemaster` Where `HardCode`='PROFILESIGNIN'".$filter,
                            "INCOMERANGE"        => "select * from `_tbl_master_codemaster` Where `HardCode`='INCOMERANGE'".$filter,
                            "HEIGHTS"            => "select * from `_tbl_master_codemaster` Where `HardCode`='HEIGHTS'".$filter,
                            "DIETS"              => "select * from `_tbl_master_codemaster` Where `HardCode`='DIETS'".$filter,
                            "SMOKINGHABITS"      => "select * from `_tbl_master_codemaster` Where `HardCode`='SMOKINGHABITS'".$filter,
                            "WEIGHTS"            => "select * from `_tbl_master_codemaster` Where `HardCode`='WEIGHTS'".$filter,
                            "BLOODGROUPS"        => "select * from `_tbl_master_codemaster` Where `HardCode`='BLOODGROUPS'".$filter,
                            "DRINKINGHABITS"     => "select * from `_tbl_master_codemaster` Where `HardCode`='DRINKINGHABITS'".$filter,
                            "COMPLEXIONS"        => "select * from `_tbl_master_codemaster` WHERE `HardCode`='COMPLEXIONS'".$filter,
                            "BODYTYPES"          => "select * from `_tbl_master_codemaster` Where `HardCode`='BODYTYPES'".$filter,
                            "FAMILYTYPE"         => "select * from `_tbl_master_codemaster` Where `HardCode`='FAMILYTYPE'".$filter,
                            "FAMILYVALUE"        => "select * from `_tbl_master_codemaster` Where `HardCode`='FAMILYVALUE'".$filter,
                            "FAMILYAFFLUENCE"    => "select * from `_tbl_master_codemaster` Where `HardCode`='FAMILYAFFLUENCE'".$filter,
                            "NUMBEROFBROTHER"    => "select * from `_tbl_master_codemaster` Where `HardCode`='NUMBEROFBROTHER'".$filter,
                            "ELDER"              => "select * from `_tbl_master_codemaster` Where `HardCode`='ELDER'".$filter,
                            "YOUNGER"            => "select * from `_tbl_master_codemaster` Where `HardCode`='YOUNGER'".$filter,
                            "CONTNAMES"          => "select * from `_tbl_master_codemaster` Where `HardCode`='CONTNAMES'".$filter,
                            "STATNAMES"          => "select * from `_tbl_master_codemaster` Where `HardCode`='STATNAMES'".$filter,
                            "OCCUPATIONS"        => "select * from `_tbl_master_codemaster` Where `HardCode`='OCCUPATIONS'".$filter,
                            "MARRIED"            => "select * from `_tbl_master_codemaster` Where `HardCode`='MARRIED'".$filter,
                            "NOOFSISTER"         => "select * from `_tbl_master_codemaster` Where `HardCode`='NOOFSISTER'".$filter,
                            "ELDERSIS"           => "select * from `_tbl_master_codemaster` Where `HardCode`='ELDERSIS'".$filter,
                            "YOUNGERSIS"         => "select * from `_tbl_master_codemaster` Where `HardCode`='YOUNGERSIS'".$filter,
                            "MARRIEDSIS"         => "select * from `_tbl_master_codemaster` Where `HardCode`='MARRIEDSIS'".$filter,
                            "PHYSICALLYIMPAIRED" => "select * from `_tbl_master_codemaster` Where `HardCode`='PHYSICALLYIMPAIRED'".$filter,
                            "VISUALLYIMPAIRED"   => "select * from `_tbl_master_codemaster` Where `HardCode`='VISUALLYIMPAIRED'".$filter,
                            "VISSIONIMPAIRED"    => "select * from `_tbl_master_codemaster` Where `HardCode`='VISSIONIMPAIRED'".$filter,
                            "SPEECHIMPAIRED"     => "select * from `_tbl_master_codemaster` Where `HardCode`='SPEECHIMPAIRED'".$filter,
                            "DOCTYPES"           => "select * from `_tbl_master_codemaster` Where `HardCode`='DOCTYPES'".$filter,
                            "IDPROOF"            => "select * from `_tbl_master_codemaster` Where `HardCode`='IDPROOF'".$filter,
                            "ADDRESSPROOF"       => "select * from `_tbl_master_codemaster` Where `HardCode`='ADDRESSPROOF'".$filter,
                            "MODE"               => "select * from `_tbl_master_codemaster` Where `HardCode`='MODE'".$filter,
                            "STARNAMES"          => "select * from `_tbl_master_codemaster` Where `HardCode`='STARNAMES'".$filter,                          
                            "MONSIGNS"           => "select * from `_tbl_master_codemaster` Where `HardCode`='MONSIGNS'".$filter,
                            "LAKANAM"            => "select * from `_tbl_master_codemaster` Where `HardCode`='LAKANAM'".$filter,
                            "EDUCATETITLES"      => "select * from `_tbl_master_codemaster` Where `HardCode`='EDUCATETITLES'".$filter,
                            "DistrictName"       => "select * from `_tbl_master_codemaster` Where `HardCode`='DISTNAMES'".$filter,
                            "Occupation"         => "select * from `_tbl_master_codemaster` Where `HardCode`='OCCUPATIONTYPES'".$filter,
                            "EMPLOYEDAS"         => "select * from `_tbl_master_codemaster` Where `HardCode`='EMPLOYEDAS'".$filter,
                            "Secure"             => "select * from `_tbl_master_codemaster` Where `HardCode`='SECURE'".$filter,
                            "AccountType"        => "select * from `_tbl_master_codemaster` Where `HardCode`='ACCOUNTTYPE'".$filter,
                            "BANKNAMES"          => "select * from `_tbl_master_codemaster` Where `HardCode`='BANKNAMES'".$filter,
                            "SMSMETHOD"          => "select * from `_tbl_master_codemaster` Where `HardCode`='SMSMETHOD'".$filter,
                            "TIMEDOUT"           => "select * from `_tbl_master_codemaster` Where `HardCode`='TIMEDOUT'".$filter,
                            "MODEOFTRANSFER"     => "select * from `_tbl_master_codemaster` Where `HardCode`='MODEOFTRANSFER'".$filter,
                            "EDUCATIONDEGREES"   => "select * from `_tbl_master_codemaster` Where `HardCode`='EDUCATIONDEGREES'".$filter,
                            "PARENTSALIVE"       => "select * from `_tbl_master_codemaster` Where `HardCode`='PARENTSALIVE'".$filter,
                            "CHEVVAIDHOSHAM"     => "select * from `_tbl_master_codemaster` Where `HardCode`='CHEVVAIDHOSHAM'".$filter,
                            "DELETEREASON"       => "select * from `_tbl_master_codemaster` Where `HardCode`='DELETEREASON'".$filter,
                            "PRIMARYPRIORITY"    => "select * from `_tbl_master_codemaster` Where `HardCode`='PRIMARYPRIORITY'".$filter,
                            "TEAMNAMES"    		 => "select * from `_tbl_master_codemaster` Where `HardCode`='TEAMNAMES'".$filter,
                            "VENDORTYPE"    		 => "select * from `_tbl_master_codemaster` Where `HardCode`='VENDORTYPE'".$filter,
                            "PAYPALCURRENCY"    		 => "select * from `_tbl_master_codemaster` Where `HardCode`='PAYPALCURRENCY'".$filter,
                            "RegisterAllowedCountries" => "select *, CONCAT(CodeValue,' (+',ParamA,')') as str FROM `_tbl_master_codemaster`  WHERE `HardCode`='CONTNAMES' and ParamE='1'");
              return $mysql->select($quries[$Request]);
        }
    }
?>  