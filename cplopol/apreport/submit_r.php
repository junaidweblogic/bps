<?
include("../../common/cploconfig.php");
include("../../common/app_function.php");

$linkcontect=$_POST["linkcontect"];
$rid=$_POST["rid"];
	if($sendresponse != NULL || $sendresponse != "") {
		$query = "SELECT * FROM " . $tblpref . "autoresponders WHERE a_id = '3'";
		if(!($result=mysqli_query($connection,$query))){echo $query.mysqli_connect_errno(); exit;}
		$row_autoresp = mysqli_fetch_array($result);
		
		$response = addslashes($linkcontect);
		
		$query="UPDATE ".$tblpref."askpolice set 
		ap_response	= '$response' where ap_id='$rid'";
		if(!($result=mysqli_query($connection,$query))){echo $query.mysqli_connect_errno(); exit;}
		$query = "SELECT * FROM " . $tblpref . "askpolice WHERE ap_id='$rid'";
		if(!($result=mysqli_query($connection,$query))){echo $query.mysqli_connect_errno(); exit;}
		$row = mysqli_fetch_array($result);
		
		$msg = "Dear $row[ap_name], <br /> ";
		$msg .= $linkcontect;
		$msg .= "<br /> You had wrote the report on : <br /> $row[ap_askpolice]";
		$msg .= "<br /><br /><br />Regards - <br />Administrator <br/> $sitename";
		
		$mesheader =  "From: ".$row_autoresp[a_default]."\n" . "Reply-To: ". $row_autoresp[a_default] . "\r\n";
		$mesheader .= "MIME-Version: 1.0\n";
		$mesheader .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";

		@mail($row[ap_email],"BPS : Ask the Police : From: $row_autoresp[a_default]",$msg,$mesheader);

		log_entry("Ask the Police ",$row[ap_name],"Receponce Sent", $tblpref,  $db, $row_admin[admin_id],$ip);

		header("Location:index.php?flag=send");
		exit;
	}
?>