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
    }
?>