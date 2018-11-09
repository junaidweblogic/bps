<?php
	include("../../common/cploconfig.php");
	include("../../common/app_function.php");
	
		$query = "UPDATE " . $tblpref . "content_master SET 
		cms_title = '$_POST[name]' WHERE cms_id = '$_POST[txthide]'";
		if(!($result = mysqli_query($connection,$query))) { echo "Query - " . $query . "<br />Error - " . mysqli_errno($connection); exit; }

		log_entry("CMS Title",$_POST[name],"Updated", $tblpref,  $db, $row_admin[admin_id],$ip);

		header("Location:index.php?flag=title");
		exit;
?>