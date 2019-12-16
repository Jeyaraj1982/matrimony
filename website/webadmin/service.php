<?php 
session_start();
if($_SERVER['REQUEST_METHOD']=='POST'){
$file = $_FILES['__files']['tmp_name'][0];
$name = $_FILES['__files']['name'][0];
$path = 'uploads/';
if (move_uploaded_file($file,$path.$name) ) {
$_SESSION['filepath']=$path.$name;
echo "done";
} else {
echo "Not done";
}
}
?>