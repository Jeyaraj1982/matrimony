<?php
  class SeqMaster {
      
        function GenerateCode($prefix,$numberlength,$number) { 
            for($i=1;$i<=$numberlength-strlen($number);$i++) {
                $prefix .= "0";    
            }
            return $prefix.$number;
        }
        
        function GetNextMemberNumber() {
            global $mysql;
            $prefix = "MEM";
            $length = 4;
            $Rows   = $mysql->select("select count(*) as rCount from `_tbl_members`");
            return SeqMaster::GenerateCode($prefix,$length,$Rows[0]['rCount']+1);
        }
        
        function GetNextFranchiseeStaffNumber() {
            global $mysql;
            $prefix = "FS";
            $length = 4;
            $Rows   = $mysql->select("select count(*) as rCount from `_tbl_franchisees_staffs`");
            return SeqMaster::GenerateCode($prefix,$length,$Rows[0]['rCount']+1);
        }
        
        function GetNextFranchiseeNumber() {
            global $mysql,$_Franchisee;
            $prefix = "FR";
            $length = 4;
            $Rows   = $mysql->select("select count(*) as rCount from `_tbl_franchisees`");
            return SeqMaster::GenerateCode($prefix,$length,$Rows[0]['rCount']+1);
             
        }
        function GetNextFranchiseePlanNumber() {
            global $mysql;
            $prefix = "FPLN";
            $length = 4;
            $Rows   = $mysql->select("select count(*) as rCount from `_tbl_franchisees_plans`");
            return SeqMaster::GenerateCode($prefix,$length,$Rows[0]['rCount']+1);
            
        }
        function GetNextEmailApiNumber() {
            global $mysql;
            $prefix = "EAPI";
            $length = 4;
            $Rows   = $mysql->select("select count(*) as rCount from `_tbl_settings_emailapi`");
            return SeqMaster::GenerateCode($prefix,$length,$Rows[0]['rCount']+1); 
        }
        function GetNextPaypalNumber() {
            global $mysql;
            $prefix = "PAL";
            $length = 4;
            $Rows   = $mysql->select("select count(*) as rCount from `_tbl_settings_paypal`");
            return SeqMaster::GenerateCode($prefix,$length,$Rows[0]['rCount']+1); 
        }
        function GetNextMobileApiNumber() {
            global $mysql;
            $prefix = "SMS"; 
            $length = 4;
            $Rows   = $mysql->select("select count(*) as rCount from `_tbl_settings_mobilesms`");
            return SeqMaster::GenerateCode($prefix,$length,$Rows[0]['rCount']+1); 
        }
        function GetNextDraftProfileCode() {
            global $mysql;
            $prefix = "DPID";
            $length = 6;
            $Rows   = $mysql->select("select count(*) as rCount from `_tbl_Profile_Draft`");
            return SeqMaster::GenerateCode($prefix,$length,$Rows[0]['rCount']+1); 
        }
        function GetNextProfileCode() {
            global $mysql;
            $prefix = "PID";
            $length = 6;
            $Rows   = $mysql->select("select count(*) as rCount from `_tbl_profiles`");
            return SeqMaster::GenerateCode($prefix,$length,$Rows[0]['rCount']+1); 
        } 
   
   /* Admin Master  */
    function GetNextCode($SoftCode) {
        
        global $mysql;
        
        $Table = $mysql->select("select * from _tbl_master_codemaster Where SoftCode='".$SoftCode."'");
        $no = $Table[0]['ParamA'];
        
        $Rows = $mysql->select("select * from _tbl_master_codemaster Where HardCode='".$SoftCode."'");
        $nextNumber = sizeof($Rows)+1;
         
        if ($Table[0]['ParamB']==1) {
            $no .= $nextNumber+1; 
        }
        
        if ($Table[0]['ParamB']==2) {
            
            if (strlen($nextNumber)==1) {
               $no .= "0".$nextNumber; 
            }
            if (strlen($nextNumber)==2) {
               $no .= $nextNumber; 
            }
        }
        
        if ($Table[0]['ParamB']==3) {
            
            if (strlen($nextNumber)==1) {
               $no .= "00".$nextNumber; 
            }
            if (strlen($nextNumber)==2) {
               $no .= "0".$nextNumber; 
            }
            if (strlen($nextNumber)==3) {
               $no .= $nextNumber; 
            }
        }
        
        if ($Table[0]['ParamB']==4) {
            
            if (strlen($nextNumber)==1) {
               $no .= "000".$nextNumber; 
            }
            if (strlen($nextNumber)==2) {
               $no .= "00".$nextNumber; 
            }
            if (strlen($nextNumber)==3) {
               $no .= "0".$nextNumber; 
            }
            if (strlen($nextNumber)==4) {
               $no .= $nextNumber; 
            }
        }
        return $no;
    }
          }
?>