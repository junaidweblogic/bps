<?php
@session_start();
include("../../common/app_function.php");
include("../../common/cploconfig.php");
if($_SESSION[username]=="")
{
	displayerror("Login Error.","","For security of your account,we have expired your session.<br>&nbsp;Please login to your account again.", "Login,../index.php", 0);
	exit();
}
$file = $_GET['file'];

@unlink($file);
header("location:index.php?flag=del");
exit;


?>