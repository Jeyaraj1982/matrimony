<?php
    
    class MySql {
        
        var $link,$dbHost,$dbUser,$dbPass,$dbName,$qry;
        
        function MySql($dbHost,$dbUser,$dbPass,$dbName) {
            
            $this->dbHost = $dbHost;
            $this->dbName = $dbName;
            $this->dbUser = $dbUser;
            $this->dbPass = $dbPass;
            
            $this->link = mysql_connect($this->dbHost,$this->dbUser,$this->dbPass);
        }
        
        function select($sql) {
            mysql_select_db($this->dbName,$this->link);
             mysql_set_charset('utf8',$this->link);
            
            $result = mysql_query($sql,$this->link);
            $resultData= array();
            while ($row = mysql_fetch_assoc($result)){
                $resultData[]=$row;
            }
            return $resultData;
        }
        
        function execute($sql) {
            mysql_select_db($this->dbName,$this->link);
             mysql_set_charset('utf8',$this->link);  
            mysql_query($sql,$this->link);
            return mysql_affected_rows($this->link);
        }
        
        function insert($tableName,$rowData) {
            $r = "insert into `".$tableName."` (";
            $l = " values (";
            foreach($rowData as $key => $value) {
                $r.="`".$key."`,";
                if ($value=="Null") {
                    $l.="Null,";
                } else {
                    $l.="'".$value."',";    
                }
                
            }
            $r = substr($r,0,strlen($r)-1).")";
            $l = substr($l,0,strlen($l)-1).")";
            $sql = $r.$l;
            
            mysql_select_db($this->dbName,$this->link);
             mysql_set_charset('utf8',$this->link);
              
            $this->qry=$sql;  
            mysql_query($sql,$this->link);
          //  return $sql;
            return mysql_insert_id($this->link);
    
        }
        
        function insRow($sql) {
            mysql_select_db($this->dbName,$this->link);
             mysql_set_charset('utf8',$this->link);
             
            $this->qry=$sql;  
            mysql_query($sql,$this->link);
            if (mysql_affected_rows()==1) {
                return "1";
            } else {
                return "-1";
            }
        //  return mysql_affected_rows();
          //  return mysql_insert_id($this->link); 
        }
    }
?>