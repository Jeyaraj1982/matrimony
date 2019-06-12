<?php
   class MySqlController {
        
        var $link; 
        var $dbHost = "";
        var $dbUser = "";
        var $dbPass = "";
        var $dbName = "";
        
        var $qry = "";
        
        function MySqlController($dbHost,$dbUser,$dbPass,$dbName) {
            $this->dbHost = $dbHost;
            $this->dbName = $dbName;
            $this->dbUser = $dbUser;
            $this->dbPass = $dbPass;
            $this->link = new PDO("mysql:host=".$this->dbHost.";dbname=".$this->dbName, $this->dbUser, $this->dbPass,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $this->link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        
        function select($sql) {
            
            $resultData= array();
            
            $stmt = $this->link->prepare($sql);
            $stmt->execute();
            
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            
            return $stmt->fetchAll();
            
            foreach($result as $row){
                $resultData[]=$row;
            }
            
            return $resultData; 
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
            
            $this->qry=$sql;  
            $this->link->exec($sql);
            $last_id = $this->link->lastInsertId();
            return $last_id;
        }
        
         function execute($sql) {
           $this->link->exec($sql);
        }
    }
?> 