<?php 
@session_start();
include("../common/cploconfig.php");

$query_update="UPDATE ".$tblpref."admin set 
			password='$password',
			admin_email='$email'
			where admin_id='$id'";
		
if(!($result=mysqli_query($connection,$query_update))){echo $query_update.mysqli_connect_errno(); exit;}
header("Location:admin_info.php?flag=edit");
exit;
?>