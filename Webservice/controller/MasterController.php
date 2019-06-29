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
        function GetStarName() {
            global $mysql;
            $StarNames = $mysql->select("select * from _tbl_master_codemaster Where HardCode='STARNAMES'") ;
            return $StarNames;
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
        function GetIncomeRange() {
            global $mysql;
            $IncomeRanges = $mysql->select("select * from _tbl_master_codemaster Where HardCode='INCOMERANGE'") ;
            return $IncomeRanges;
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
        function GetEmployedAs() {
            global $mysql;
            $EmployedAs = $mysql->select("select * from _tbl_master_codemaster Where HardCode='OCCUPATIONS'") ;
            return $EmployedAs;
        }
        function GetOccupation() {
            global $mysql;
            $Occupations = $mysql->select("select * from _tbl_master_codemaster Where HardCode='OCCUPATIONTYPES'") ;
            return $Occupations;
        }
        function GetOccupationTypes() {
            global $mysql;
            $OccupationTypes = $mysql->select("select * from _tbl_master_codemaster Where HardCode='TYPEOFOCCUPATIONS'") ;
            return $OccupationTypes;
        }
        function GetNumberOfBrother() {
            global $mysql;
            $NumberOfBrothers = $mysql->select("select * from _tbl_master_codemaster Where HardCode='NUMBEROFBROTHER'") ;
            return $NumberOfBrothers;
        }
        function GetNumberOfElderBrother() {
            global $mysql;
            $NumberOfElderBrothers = $mysql->select("select * from _tbl_master_codemaster Where HardCode='ELDER'") ;
            return $NumberOfElderBrothers;
        }
        function GetNumberOfYoungerBrother() {
            global $mysql;
            $NumberOfYoungerBrothers = $mysql->select("select * from _tbl_master_codemaster Where HardCode='YOUNGER'") ;
            return $NumberOfYoungerBrothers;
        }
        function GetNumberOfMarriedBrother() {
            global $mysql;
            $NumberOfMarrieBrothers = $mysql->select("select * from _tbl_master_codemaster Where HardCode='MARRIED'") ;
            return $NumberOfMarrieBrothers;
        }
        function GetNumberOfSisters() {
            global $mysql;
            $NumberOfSisters = $mysql->select("select * from _tbl_master_codemaster Where HardCode='NOOFSISTER'") ;
            return $NumberOfSisters;
        }
        function GetNumberOfElderSisters() {
            global $mysql;
            $NumberOfElderSisters = $mysql->select("select * from _tbl_master_codemaster Where HardCode='ELDERSIS'") ;
            return $NumberOfElderSisters;
        }
        function GetNumberOfYoungerSisters() {
            global $mysql;
            $NumberOfYoungerSisters = $mysql->select("select * from _tbl_master_codemaster Where HardCode='YOUNGERSIS'") ;
            return $NumberOfYoungerSisters;
        }
        function GetNumberOfMarriedSisters() {
            global $mysql;
            $NumberOfMarriedSisters = $mysql->select("select * from _tbl_master_codemaster Where HardCode='MARRIEDSIS'") ;
            return $NumberOfMarriedSisters;
        }
        function GetPhysicallyImpaired() {
            global $mysql;
            $PhysicallyImpaireds = $mysql->select("select * from _tbl_master_codemaster Where HardCode='PHYSICALLYIMPAIRED'") ;
            return $PhysicallyImpaireds;
        }
        function GetVisuallyImpaired() {
            global $mysql;
            $VisuallyImpaireds = $mysql->select("select * from _tbl_master_codemaster Where HardCode='VISUALLYIMPAIRED'") ;
            return $VisuallyImpaireds;
        }
        function GetVisionImpaired() {
            global $mysql;
            $VisionImpaireds = $mysql->select("select * from _tbl_master_codemaster Where HardCode='VISSIONIMPAIRED'") ;
            return $VisionImpaireds;
        }
        function GetSpeechImpaired() {
            global $mysql;
            $SpeechImpaireds = $mysql->select("select * from _tbl_master_codemaster Where HardCode='SPEECHIMPAIRED'") ;
            return $SpeechImpaireds;
        }
        function GetWeight() {
            global $mysql;
            $Weight = $mysql->select("select * from _tbl_master_codemaster Where HardCode='WEIGHTS'") ;
            return $Weight;
        }
        function GetBloodGroups() {
            global $mysql;
            $BloodGroups = $mysql->select("select * from _tbl_master_codemaster Where HardCode='BLOODGROUPS'") ;
            return $BloodGroups;
        }
       
        function GetDocumentType() {
            global $mysql;
            $DocumentTypes = $mysql->select("select * from _tbl_master_codemaster Where HardCode='DOCTYPES'") ;
            return $DocumentTypes;
        }
        function GetSecure() {
            global $mysql;
            $Securs = $mysql->select("select * from _tbl_master_codemaster Where HardCode='SECURE'") ;
            return $Securs;
        }
        function GetIDProof() {
            global $mysql;
            $IDProofs = $mysql->select("select * from _tbl_master_codemaster Where HardCode='IDPROOF'") ;
            return $IDProofs;
        }
        function GetAddressProof() {
            global $mysql;
            $AddressProofs = $mysql->select("select * from _tbl_master_codemaster Where HardCode='ADDRESSPROOF'") ;
            return $AddressProofs;
        }
        
        
    }
?>