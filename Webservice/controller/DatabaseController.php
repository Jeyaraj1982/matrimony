<?php

	class MySql {
        
        var $link; 
        var $dbName = "";
        var $qry    = "";
        
        public function __construct($dbHost,$dbUser,$dbPass,$dbName){
            $this->dbName = $dbName;
            $this->link = mysql_connect($dbHost,$dbUser,$dbPass) or die("Error");
        }
        
        public function select($sql,$ass=false) {
            
            mysql_select_db($this->dbName,$this->link);
            mysql_set_charset("utf8",$this->link);
            $resultData = array();
            $result     = mysql_query($sql,$this->link);
            
            if ($ass) {
                return mysql_fetch_assoc($result); 
            }
            
            if ($result) { 
                
                if (mysql_num_rows($result) > 0) {
                    while ($row = mysql_fetch_assoc($result)) {
                        $resultData[]=$row;
                    }
                    mysql_free_result($result);  
                }
            }
            
            return $resultData;
        }
        
        public function execute($sql) {
            
            $this->qry = $sql;
            mysql_select_db($this->dbName,$this->link);
            mysql_set_charset("utf8",$this->link);
            mysql_query($this->qry,$this->link);
            return mysql_affected_rows();
        }
        
        public function insert($tableName,$rowData) {
            
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

            $this->qry=$sql;  
            mysql_query($this->qry,$this->link) ;
            return mysql_insert_id($this->link);
        }
        
        public  function update($tableName,$rowData,$where) {
            
            $r = "update `".$tableName."` set ";
 
            foreach($rowData as $key => $value) {
                $r.="`".$key."`='".$value."',";
            }
            $r = substr($r,0,strlen($r)-1);
            $sql = $r." where ".$where;
            
            mysql_select_db($this->dbName,$this->link);
            mysql_set_charset("utf8",$this->link);
            $this->qry=$sql;  
            mysql_query($this->qry,$this->link);
            return mysql_affected_rows($this->link);
        }
        
        function dbClose() {
            mysql_close($this->link);
        }
        
        public function __destruct() {
            $this->link = null;
        }
    }
   

   class MySqlDb
{

    public $link = "";
    public $dbHost = "";
    public $dbUser = "";
    public $dbPass = "";
    public $dbName = "";
    public $qry = "";

    public function __construct($dbHost, $dbUser, $dbPass, $dbName)
    {
        $this->dbHost = $dbHost;
        $this->dbName = $dbName;
        $this->dbUser = $dbUser;
        $this->dbPass = $dbPass;
        $this->link = new PDO("mysql:host=" . $this->dbHost . ";dbname=" . $this->dbName, $this->dbUser, $this->dbPass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $this->link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function select($sql)
    {
        $this->writeSql($sql);
        $stmt = $this->link->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        return $stmt->fetchAll();
    }

    public function insert($tableName, $rowData)
    {

        $r = "insert into `" . $tableName . "` (";
        $l = " values (";
        foreach ($rowData as $key => $value) {
            $r .= "`" . $key . "`,";
            if ($value == "Null") {
                $l .= "Null,";
            } else {
                $l .= "'" . $value . "',";
            }
        }
        $r = substr($r, 0, strlen($r) - 1) . ")";
        $l = substr($l, 0, strlen($l) - 1) . ")";
        $sql = $r . $l;

        $this->writeSql($sql);
        $this->qry = $sql;
        $this->link->exec($sql);
        $last_id = $this->link->lastInsertId();
        return $last_id;
    }

    public function execute($sql)
    {
        $this->writeSql($sql);
        return $this->link->exec($sql);
    }

    public function __destruct()
    {
        $this->link = null;
    }
    
    public function writeSql($sql) {
        $myFile = date("Y_m_d").".txt";
        $fh = fopen($myFile, 'a') or die("can't open file");
        fwrite($fh, "[".date("Y-m-d H:i:s")."]\t".$sql."\n");
        fclose($fh);
    }

}
?>