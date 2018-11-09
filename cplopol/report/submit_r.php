<?
include("../../common/cploconfig.php");

	if($sendresponse == NULL || $sendresponse == "") {
		$content=	addslashes($_POST[linkcontect]);
		$cname 	=	$_POST[cname];	
		$rname	=	$_POST[rname];
		$remail	=	$_POST[remail];
		$today=date("Y-m-d");
		
		if($mode=="del")
		{
			$query="Delete from ".$tblpref."report where r_id='$rid'";
			if(!($result=mysqli_query($connection,$query))){echo $query.mysqli_errno($connection); exit;}
			header("Location:index.php?flag=del");
			exit;
		}
		
		if($rid=="")
		{
				$qadd="INSERT INTO ".$tblpref."report set 
				r_name 	=	'$cname',
				r_email	=	'$remail',
				r_details=	'$content',
				r_reporter= '$rname',
				r_app	= '$rtel',
				r_date	= '$today'";
					
				if(!($res=mysqli_query($connection,$qadd))){echo $qadd.mysqli_errno($connection); exit;}
				header("Location:index.php?flag=add");
				exit;
		}
		
		if($rid!="")
		{
				$query_update="UPDATE ".$tblpref."report set 
				r_name 	=	'$cname',
				r_email	=	'$remail',
				r_app	= '$rtel',
				r_details=	'$content',
				r_reporter= '$rname' where r_id='$rid'";
				if(!($result=mysqli_query($connection,$query_update))){echo $query_update.mysqli_errno($connection); exit;}
				header("Location:index.php?flag=edit");
				exit;
		}
	}
	else {
		$query = "SELECT * FROM " . $tblpref . "autoresponders WHERE a_id = '1'";
		if(!($result=mysqli_query($connection,$query))){echo $query.mysqli_errno($connection); exit;}
		$row_autoresp = mysqli_fetch_array($result);
		
		$response = addslashes($linkcontect);
		
		$query="UPDATE ".$tblpref."report set 
				r_response 	=	'$response' where r_id='$rid'";
		if(!($result=mysqli_query($connection,$query))){echo $query.mysqli_errno($connection); exit;}
		
		$query = "SELECT * FROM " . $tblpref . "report WHERE r_id='$rid'";
		if(!($result=mysqli_query($connection,$query))){echo $query.mysqli_errno($connection); exit;}
		$row = mysqli_fetch_array($result);
		
		$msg = "Dear $row[r_reporter], <br /> ";
		$msg .= $linkcontect;
		$msg .= "<br /> You wrote : <br /> $row[r_details]";
		$msg .= "<br /><br /><br />Regards - <br />Administrator <br/> $sitename";
		
		$mesheader =  "From: ".$row_autoresp[a_default]."\n" . "Reply-To: ". $row_autoresp[a_default] . "\r\n";
		$mesheader .= "MIME-Version: 1.0\n";
		$mesheader .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
		@mail($row[r_email],"BPS : Crime Report : From $row_autoresp[a_default]",$msg,$mesheader);
		header("Location:index.php?flag=send");
		exit;
	}
?>