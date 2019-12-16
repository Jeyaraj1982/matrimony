<?php


     class MySql
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
         
        $this->qry = $sql;
        $this->link->exec($sql);
        $last_id = $this->link->lastInsertId();
        return $last_id;
    }

    public function execute($sql)
    {
        return $this->link->exec($sql);
    }

    public function __destruct()
    {
        $this->link = null;
    }
}
?>