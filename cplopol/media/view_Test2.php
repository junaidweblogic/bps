<?php 
	include("../../common/cploconfig.php");
	
	$query = "SELECT * FROM " . $tblpref . "media WHERE med_id = '$_REQUEST[media]'";
	if(!($result=mysqli_query($connection,$query))){echo $query.mysqli_errno($connection); exit;}
	$row = mysqli_fetch_array($result);
	
	switch($row[med_type]) {
		case "Print Media" 	: echo "p"; break;
		case "Video media" 	: echo "v"; break;
		case "Newsletter" 	: echo "n"; break;
		case "Audio Media" 	: echo "a"; break;
	}
?>