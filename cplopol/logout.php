<?php 
include("../common/cploconfig.php");
	 	
$_SESSION[username] = "";
$_SESSION[user_type] = "";
$_SESSION[admin_name] = "";

unset($_SESSION[username]);
unset($_SESSION[user_type]);
unset($_SESSION[admin_name]);

@session_destroy();
header("location:index.php?flag=logout");
exit;

?>