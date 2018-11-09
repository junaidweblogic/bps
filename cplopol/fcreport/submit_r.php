<?
include("../../common/cploconfig.php");
include("../../common/app_function.php");

//$sendresponse = 'yes';
	if($sendresponse != NULL || $sendresponse != "") {
		$query = "SELECT * FROM " . $tblpref . "autoresponders WHERE a_id = '2'";
		if(!($result=mysqli_query($connection,$query))){echo $query.mysqli_errno($connection); exit;}
		$row_autoresp = mysqli_fetch_array($result);
		if($row_autoresp['a_default']!=$row_autoresp['a_email1'])
		{
			$cc1 = $row_autoresp['a_email1'];
		}
		if($row_autoresp['a_default']!=$row_autoresp['a_email2'])
		{
			$cc2 = $row_autoresp['a_email2'];
		}
		if($row_autoresp['a_default']!=$row_autoresp['a_email3'])
		{
			$cc3 = $row_autoresp['a_email3'];
		}
		if($cc1!="" && $cc2!="")
		{
			$cc=$cc1.",".$cc2;
		}
		if($cc1!="" && $cc3!="")
		{
			$cc=$cc1.",".$cc3;
		}
		if($cc2!="" && $cc3!="")
		{
			$cc=$cc2.",".$cc3;
		}
		//echo $cc;
		//exit;
		$response = addslashes($_POST[linkcontect]);
		
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

		
		$mesheader =  "From: ".$row_autoresp[a_default]."\n" . "Cc: ". $cc . "\r\n";
		$mesheader .=  "Reply-To: ". $row_autoresp[a_default] ."\r\n";
		$mesheader .= "MIME-Version: 1.0\n";
		$mesheader .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";

		@mail($row[fc_email],"BPS : Feedback & Commendation Report : From: $row_autoresp[a_default] ",$msg,$mesheader);

		log_entry("Feedback & Commendation ",$row[fc_reporter],"Response Sent", $tblpref,  $db, $row_admin[admin_id],$ip);
		header("Location:index.php?flag=send");
		exit;
	}
?>