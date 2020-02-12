<?php
include('DBconnection.php');
$fname=$_POST['txt_fname'];
$lname=$_POST['txt_lname'];
$password=$_POST['txt_password'];
$repassword=$_POST['txt_repassword'];
$email=$_POST['txt_email'];
$contactno=$_POST['txt_mobile'];
$fname_flag=0;
$lname_flag=0;
$pass_flag=0;
$repass_flag=0;
$email_flag=0;
$contactno_flag=0;
$form_validation=0;
$contactno_len=strlen($contactno);
$pass_len=strlen($password);
if(isset($_POST['btn_submit'])){

	if (!preg_match("/[a-z]/i", $fname))  //title
		{
			$fname_flag=0;
			echo " First name is false,";
	}
	else
	{ 
        $fname_flag=1;
		echo "First name is true,";
	}
	if (!preg_match("/[a-z]/i", $lname))  //title
		{
			$lname_flag=0;
			echo " Last name is false,";
	}
	else
	{ 
        $lname_flag=1;
		echo "Last name is true,";
	}
	if($password=="" && $pass_len<6)
	{
		$pass_flag=0;
		echo "Password is invalid,";
	}
	else
	{
		$pass_flag=1;
		echo "Password is valid,";
	}
	if($repassword==$password)
	{
		$repass_flag=1;
		echo "valid repass,";
	}
	else{
		$repass_flag=0;
		echo "invalid repass,";
	}
	if(!filter_var($email, FILTER_VALIDATE_EMAIL))
{
	$email_flag=0;
	echo "email is false,";

}
else
{
	$email_flag=1;
	echo "email is true,";
}

if(is_numeric($contactno) && ($contactno_len==10))
{
	$contactno_flag=1;
	echo "contactno is true,";
}
else
{
 $contactno_flag=0;
 echo "contactno is false,";
}
if($fname_flag==1 && $lname_flag==1 && $pass_flag==1 && $repass_flag==1 && $email_flag==1 && $contactno_flag==1)
{
$form_validation=1;
}
else{
	$form_validation=0;
}
if($form_validation==1)
{
$query="INSERT INTO `real_user` (`firstname`, `lastname`, `password`, `emailid`, `contactno`) VALUES ( '".$fname."','".$lname."','".$password."','".$email."','".$contactno."');";
$result=mysql_query($query);
if($result==1)
{
	echo "Rows  entered successfully";
}
}
else
{
	echo "failed";
}
}


 