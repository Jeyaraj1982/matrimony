<?php

class CodeMaster {
        
        function GetGender() {
            global $mysql;
            $Sexs = $mysql->select("select * from _tbl_master_codemaster Where HardCode='SEX'") ;
            return $Sexs;
        }
        function GetProfileFor() {
            global $mysql;
            $ProfileFors = $mysql->select("select * from _tbl_master_codemaster Where HardCode='PROFILESIGNIN'") ;
            return $ProfileFors;
        }
        function GetMaritalStatus() {
            global $mysql;
            $MaritalStatuss = $mysql->select("select * from _tbl_master_codemaster Where HardCode='MARTIALSTATUS'") ;
            return $MaritalStatuss;
        }
        function GetLanguage() {
            global $mysql;
            $Languages = $mysql->select("select * from _tbl_master_codemaster Where HardCode='LANGUAGENAMES'") ;
            return $Languages;
        }
        function GetReligion() {
            global $mysql;
            $Religions = $mysql->select("select * from _tbl_master_codemaster Where HardCode='RELINAMES'") ;
            return $Religions;
        }
        function GetCaste() {
            global $mysql;
            $Castes = $mysql->select("select * from _tbl_master_codemaster Where HardCode='CASTNAMES'") ;
            return $Castes;
        }
        function GetCommunity() {
            global $mysql;
            $Communitys = $mysql->select("select * from _tbl_master_codemaster Where HardCode='COMMUNITY'") ;
            return $Communitys;
        }
        function GetNationality() {
            global $mysql;
            $Nationalitys = $mysql->select("select * from _tbl_master_codemaster Where HardCode='NATIONALNAMES'") ;
            return $Nationalitys;
        }
        function GetHeight() {
            global $mysql;
            $Heights = $mysql->select("select * from _tbl_master_codemaster Where HardCode='HEIGHTS'") ;
            return $Heights;
        }
        function GetDiet() {
            global $mysql;
            $Diets = $mysql->select("select * from _tbl_master_codemaster Where HardCode='DIETS'") ;
            return $Diets;
        }
        function GetSmokingHabit() {
            global $mysql;
            $SmokingHabits = $mysql->select("select * from _tbl_master_codemaster Where HardCode='SMOKINGHABITS'") ;
            return $SmokingHabits;
        }
        function GetDrinkingHabit() {
            global $mysql;
            $DrinkingHabits = $mysql->select("select * from _tbl_master_codemaster Where HardCode='DRINKINGHABITS'") ;
            return $DrinkingHabits;
        }
        function GetSkinType() {
            global $mysql;
            $SkinTypes = $mysql->select("SELECT * FROM _tbl_master_codemaster WHERE HardCode='COMPLEXIONS'") ;
            return $SkinTypes;
        }
        function GetBodyType() {
            global $mysql;
            $BodyTypes = $mysql->select("select * from _tbl_master_codemaster Where HardCode='BODYTYPES'") ;
            return $BodyTypes;
        }
        function GetCountryName() {
            global $mysql;
            $Countrys = $mysql->select("select * from _tbl_master_codemaster Where HardCode='CONTNAMES'") ;
            return $Countrys;
        }
        function GetStateName() {
            global $mysql;
            $StateNames = $mysql->select("select * from _tbl_master_codemaster Where HardCode='STATNAMES'") ;
            return $StateNames;
        }
        function GetDistrictName() {
            global $mysql;
            $DistrictNames = $mysql->select("select * from _tbl_master_codemaster Where HardCode='DISTNAMES'") ;
            return $DistrictNames;
        }
        function GetAvailableBankName() {
            global $mysql;
            $BankNames = $mysql->select("select * from _tbl_master_codemaster Where HardCode='BANKNAMES'") ;
            return $BankNames;
        }
        function GetAccountType() {
            global $mysql;
            $AccountTypes = $mysql->select("select * from _tbl_master_codemaster Where HardCode='ACCOUNTTYPE'") ;
            return $AccountTypes;
        }
        
        
    }
?>