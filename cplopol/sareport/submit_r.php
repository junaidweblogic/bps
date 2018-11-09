<?
include("../../common/cploconfig.php");
$sendresponse = $_POST[sendresponse];
$rid = $_POST[rid];
	if($sendresponse != NULL || $sendresponse != "") {
		$query = "SELECT * FROM " . $tblpref . "autoresponders WHERE a_id = '5'";
		if(!($result=mysqli_query($connection,$query))){echo $query.mysqli_errno($connection); exit;}
		$row_autoresp = mysqli_fetch_array($result);
		
		$response = addslashes($linkcontect);
		
		$query = "SELECT * FROM " . $tblpref . "susp_alleg WHERE sa_id='$rid'";
		if(!($result=mysqli_query($connection,$query))){echo $query.mysqli_errno($connection); exit;}
		$row = mysqli_fetch_array($result);
		
		$msg = "Dear $row[sa_name], <br /> ";
		$msg .= $linkcontect;
		$msg .= "<br /> You had wrote the Crime Report/Incident on : <br /> $row[sa_crimedet]";
		$msg .= "<br /><br /><br />Regards - <br />Administrator <br/> $sitename";
		
		$mesheader =  "From: ".$row_autoresp[a_default]."\n" . "Reply-To: ". $row_autoresp[a_default] . "\r\n";
		$mesheader .= "MIME-Version: 1.0\n";
		$mesheader .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";

		@mail($row[sa_email],"Re: BPS : Crime Report/Incident : From $row_autoresp[a_default]",$msg,$mesheader);
		header("Location:index.php?flag=send");
		exit;
	}
?>