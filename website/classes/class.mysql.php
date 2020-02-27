<?php
    
    class MySqldb {
        
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
    
     class MySql
   {
        public $link  = "";
        public $qry   = "";
        public $error = "";                          

        public function __construct($dbHost, $dbUser, $dbPass, $dbName)
        {                                        
            $this->link = new PDO("mysql:host=" . $dbHost . ";dbname=" . $dbName.";charset=utf8", $dbUser, $dbPass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $this->link->exec('SET CHARACTER SET utf8');
            $this->link->query("SET NAMES utf8");
            $this->link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAME'utf8'");
            $this->writeSql("Started");
        }

        public function select($sql)
        {
            $this->writeSql($sql);
            try {
                $stmt = $this->link->prepare($sql);
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                return $stmt->fetchAll();
            } catch (PDOException $e) {
                $this->writeSql($e->getMessage());
                return array();
            }
        }

        public function insert($tableName, $rowData)
        {
            $r = "insert into `" . $tableName . "` (";
            $l = " values (";
            foreach ($rowData as $key => $value) {
                $r .= "`" . $key . "`,";
                $l .= ($value == "Null") ? "Null," : "'" . $value . "',";
            }
            $sql = substr($r, 0, strlen($r) - 1) . ")" . substr($l, 0, strlen($l) - 1) . ")";
            $this->writeSql($sql);
            $this->qry = $sql;
            try {
                $this->link->exec($sql);
                $last_id = $this->link->lastInsertId();
                return $last_id;
            } catch (PDOException $e) {
                $this->error = $e->getMessage();
                $this->writeSql($e->getMessage());
                return 0;
            }
        }

        public function execute($sql)
        {
            $this->writeSql($sql);
            try {
                return $this->link->exec($sql);
            } catch (PDOException $e) {
                $this->writeSql($e->getMessage());
                return 0;
            }
        }

        public function __destruct()
        {
            $this->link = null;
        }

        public function writeSql($text) {
            $myFile = "/home/nglproperty/public_html/".date("Y_m_d").".txt";
            $fh = fopen($myFile, 'a') or die ("can't open file");
            fwrite($fh, "[".date("Y-m-d H:i:s")."]\t".$text."\n");
            fclose($fh);
        }
}
?>