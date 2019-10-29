<?php 
include_once("config.php");
header("Content-type: text/xml");
$data = $mysql->select("select * from _jsitemap order by sitemapid desc limit 0,1");
echo trim($data[0]['content']);
?>