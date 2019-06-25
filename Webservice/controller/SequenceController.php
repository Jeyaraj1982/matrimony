<?php

  class SeqMaster {
        
        function GetNextMemberNumber() {
            
            global $mysql;
        
            $prefix = "MEM";
            $Rows = $mysql->select("select * from _tbl_members");
        
            $nextNumber = sizeof($Rows)+1; 
         
            if (sizeof($nextNumber)==1) {
                $prefix .= "000".$nextNumber; 
            }
        
            if (sizeof($nextNumber)==2) {
                $prefix .= "00".$nextNumber; 
            }
        
            if (sizeof($nextNumber)==3) {
                $prefix .= "0".$nextNumber; 
            }
        
            if (sizeof($nextNumber)==4) {   
                $prefix .= $nextNumber; 
            }
            
            return $prefix;
        }
        function GetNextFranchiseeStaffNumber() {
            
            global $mysql;
        
            $prefix = "FS";
            $Rows = $mysql->select("select * from _tbl_franchisees_staffs");
        
            $nextNumber = sizeof($Rows)+1; 
         
            if (sizeof($nextNumber)==1) {
                $prefix .= "000".$nextNumber; 
            }
        
            if (sizeof($nextNumber)==2) {
                $prefix .= "00".$nextNumber; 
            }
        
            if (sizeof($nextNumber)==3) {
                $prefix .= "0".$nextNumber; 
            }
        
            if (sizeof($nextNumber)==4) {   
                $prefix .= $nextNumber; 
            }
            
            return $prefix;
        }
        function GetNextFranchiseeNumber() {
            
            global $mysql,$_Franchisee;
        
            $prefix = "FR";
            $Rows = $mysql->select("select * from _tbl_franchisees");
        
            $nextNumber = sizeof($Rows)+1; 
         
            if (sizeof($nextNumber)==1) {
                $prefix .= "000".$nextNumber; 
            }
        
            if (sizeof($nextNumber)==2) {
                $prefix .= "00".$nextNumber; 
            }
        
            if (sizeof($nextNumber)==3) {
                $prefix .= "0".$nextNumber; 
            }
        
            if (sizeof($nextNumber)==4) {   
                $prefix .= $nextNumber; 
            }
            
            return $prefix;
        }
        function GetNextFranchiseePlanNumber() {
            
            global $mysql;
        
            $prefix = "PLN";
            $Rows = $mysql->select("select * from _tbl_franchisees_plans");
        
            $nextNumber = sizeof($Rows)+1; 
         
            if (sizeof($nextNumber)==1) {
                $prefix .= "000".$nextNumber; 
            }
        
            if (sizeof($nextNumber)==2) {
                $prefix .= "00".$nextNumber; 
            }
        
            if (sizeof($nextNumber)==3) {
                $prefix .= "0".$nextNumber; 
            }
        
            if (sizeof($nextNumber)==4) {   
                $prefix .= $nextNumber; 
            }
            
            return $prefix;
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