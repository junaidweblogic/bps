<?
include("../../common/cploconfig.php");
include("../../common/app_function.php");

	if($sendresponse != NULL || $sendresponse != "") {
		$query = "SELECT * FROM " . $tblpref . "autoresponders WHERE a_id = '1'";
		if(!($result=mysqli_query($connection,$query))){echo $query.mysqli_errno($connection); exit;}
		$row_autoresp = mysqli_fetch_array($result);
		
		$response = addslashes($linkcontect);
		
		$query="UPDATE ".$tblpref."askpolice set 
		ap_response	= '$response' where ap_id='$rid'";
		if(!($result=mysqli_query($connection,$query))){echo $query.mysqli_errno($connection); exit;}
		$query = "SELECT * FROM " . $tblpref . "askpolice WHERE ap_id='$rid'";
		if(!($result=mysqli_query($connection,$query))){echo $query.mysqli_errno($connection); exit;}
		$row = mysqli_fetch_array($result);
		
		$msg = "Hello $row[ap_name], <br /> ";
		$msg .= $linkcontect;
		$msg .= "<br /> You had wrote the report on : <br /> $row[ap_askpolice]";
		$msg .= "<br /><br /><br />Regards - <br />Administrator <br/> $sitename";
		
		$mesheader =  "From: ".$row_autoresp[a_default]."\n" . "Reply-To: ". $row_autoresp[a_default] . "\r\n";
		$mesheader .= "MIME-Version: 1.0\n";
		$mesheader .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";

		@mail($row[r_email],"Re: Feedback & Commendation Report",$msg,$mesheader);

		log_entry("Feedback & Commendation ",$row[ap_name],"Responce Sent", $tblpref,  $db, $row_admin[admin_id],$ip);
		header("Location:index.php?flag=send");
		exit;
	}
?>