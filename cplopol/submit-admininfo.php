<?php 
include("../common/cploconfig.php");
	$username=addslashes($_POST[username]);
	$emailid=addslashes($_POST[emailid]);
	$name=addslashes($_POST[name]);
	$id=$_POST[aid];
		
	$query_update=sprintf("UPDATE ".$tblpref."admin set 
			username='%s',
			admin_email='%s',
			admin_name='%s'
			where admin_id='%d'", $username, $emailid, $name, $id); 
		
if(!($result=mysqli_query($connection,$query_update))){echo $query_update.mysqli_connect_errno(); exit;}
header("Location:admin-info.php?flag=edit");
exit;
?>