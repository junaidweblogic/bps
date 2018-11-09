<?
include("../../common/cploconfig.php");

	if($sendresponse != NULL || $sendresponse != "") {
		$query = "SELECT * FROM " . $tblpref . "autoresponders WHERE a_id = '4'";
		if(!($result=mysqli_query($connection,$query))){echo $query.mysqli_errno($connection); exit;}
		$row_autoresp = mysqli_fetch_array($result);
		
		$response = addslashes($linkcontect);
		
		$query="UPDATE ".$tblpref."feedback_commend set 
				fc_response	= '$response' where fc_id='$rid'";
		if(!($result=mysqli_query($connection,$query))){echo $query.mysqli_errno($connection); exit;}
		
		$query = "SELECT * FROM " . $tblpref . "feedback_commend WHERE fc_id='$rid'";
		if(!($result=mysqli_query($connection,$query))){echo $query.mysqli_errno($connection); exit;}
		$row = mysqli_fetch_array($result);
		
		$msg = "Dear $row[fc_reporter], <br /> ";
		$msg .= $linkcontect;
		$msg .= "<br /> You had wrote the report as : <br /> $row[fc_report]";
		$msg .= "<br /><br /><br />Regards - <br />Administrator <br/> $sitename";
		
		$mesheader =  "From: ".$row_autoresp[a_default]."\n" . "Reply-To: ". $row_autoresp[a_default] . "\r\n";
		$mesheader .= "MIME-Version: 1.0\n";
		$mesheader .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";

		@mail($row[fc_email],"BPS : Police Misconduct Report : From $row_autoresp[a_default] ",$msg,$mesheader);
		header("Location:index.php?flag=send");
		exit;
	}
?>