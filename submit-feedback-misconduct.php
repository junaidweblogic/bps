<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
@session_start();
include("common/app_function.php");
include("common/config.php");
require_once "common/recaptchalib.php";
//print_r($_POST);

 if($_POST["g-recaptcha-response"]=="")
{
	?>
	<body onload="document.frm.submit();">
		<form name="frm" method="POST" action="<?php echo $rewritepath;?>index.php/bps-feedback-misconduct/">
			<input type="hidden" name="flag" value="wrong">
			<input type="hidden" name="txtname" id="txtname" value="<?php echo preg_chk($_POST['txtname'])?>">
			<input type="hidden" id="tel" name="tel" value="<?php echo preg_chk($_POST['tel'])?>">
			<input type="hidden" id="email" name="email" value="<?php echo preg_chk($_POST['email'])?>">
			<input type="hidden" id="txttype" name="txttype" value="<?php echo preg_chk($_POST['txtype'])?>">
			<input type="hidden" id="reporting" name="reporting" value="<?php echo preg_chk($_POST['reporting'])?>">
			<input type="hidden" id="txtdate" name="txtdate" value="<?php echo $_POST['txtdate']?>">
			<input type="hidden" id="hourtime" name="hourtime" value="<?php echo preg_chk($_POST['hourtime'])?>">
			<input type="hidden" id="mintime" name="mintime" value="<?php echo preg_chk($_POST['mintime'])?>">
			<input type="hidden" id="txttime" name="txttime" value="<?php echo preg_chk($_POST['txttime'])?>">
			<input type="hidden" id="location" name="location" value="<?php echo preg_chk($_POST['location'])?>">
			<input type="hidden" id="txtemp" name="txtemp" value="<?php echo preg_chk($_POST['txtemp'])?>">
			<input type="hidden" id="report" name="report" value="<?php echo preg_chk($_POST['report'])?>">
		</form>
	</body>
	<?php
	exit;
}


$response = null;
$recaptcha = new ReCaptcha($recaptcha_secret);
if ($_POST["g-recaptcha-response"]) {
	
    $response = $recaptcha->verifyResponse(
        $_SERVER["REMOTE_ADDR"],
        $_POST["g-recaptcha-response"]
    );
}
 if ($response->success!=1) {
	 
	?>
	<body onload="document.frm.submit();">
		<form name="frm" method="POST" action="<?php echo $rewritepath;?>index.php/bps-feedback-misconduct/">
			<input type="hidden" name="flag" value="embed">
		</form>
	</body>
	<?php
		exit();
 }



 $userval = preg_chk($_POST['userval']);

if($userval!="" && preg_chk($_SESSION['userval'])!="")
{	
	if($userval==$_SESSION['userval'])
		{ 
		$query_hash = sprintf("SELECT * FROM ".$tblpref."userval WHERE session_val='%s'", $_SESSION['userval']);
		if(!$result_hash = mysqli_query($connection,$query_hash))
		{  
			echo $query_hash.mysqli_connect_errno();
			exit;
		}
		 $row_hash = mysqli_fetch_array($result_hash);
		 $hash_userval = md5($userval);
		 if($row_hash[hash_val] == $hash_userval)
		{     
			$txtdate= $_POST['txtdate'];
			$date1= @date("Y-m-d",strtotime($txtdate));
			$time1 = preg_chk($_POST['hourtime']);
			$mintime = preg_chk($_POST['mintime']);
			$datetime = $date1." ".$time1.":".$mintime.":00";
			$chkresponse = $_POST['chkresponse'];
			$txttime = preg_chk($_POST['txttime']);
			$location = preg_chk($_POST['location']);
			$txtemp = preg_chk($_POST['txtemp']);
			$other = preg_chk($_POST['other']);
			$report = preg_chk($_POST['report']);

			$txtname = preg_chk($_POST['txtname']);
			$tel = preg_chk($_POST['tel']);
			$email = preg_chk($_POST['email']);
			$txttype = preg_chk($_POST['txttype']);
			$reporting = preg_chk($_POST['reporting']);
			$categoryfrm = preg_chk($_POST['categoryfrm']);

			$addfc ="INSERT INTO ".$tblpref."feedback_commend SET
			fc_category='$categoryfrm',
			fc_name ='$txtname',
			fc_contact_no ='$tel',
			fc_email ='$email',
			fc_report_type ='$txttype',
			fc_reporting_on ='$reporting',
			fc_date ='$datetime',
			fc_timeset ='$txttime',
			fc_loc_contact='$location',
			fc_emp='$txtemp',
			fc_other='$other',
			fc_report='$report',
			fc_status ='New',
			fc_ip='$_SERVER[REMOTE_ADDR]'";
	if(!($result = mysqli_query($connection,$addfc))){echo $addfc.mysqli_connect_errno();  exit;}
	 $id = mysqli_insert_id();
	 
	for($i=0;$i<count($chkresponse);$i++)
	{
		$addfcintial ="INSERT INTO ".$tblpref."intiat_contact SET
		int_fc_id ='$id',
		int_answer ='".$chkresponse[$i]."'";
		if(!($resultint = mysqli_query($connection,$addfcintial))){echo $addfcintial.mysqli_connect_errno();  exit;}
	}

	if($_POST[txttype]!="")
	{
	$query = "SELECT * FROM " . $tblpref . "autoresponders WHERE a_id = '2'";
	}
	else
	{
		$query = "SELECT * FROM " . $tblpref . "autoresponders WHERE a_id = '4'";
	}
	if(!($result=mysqli_query($connection,$query))){echo $query.mysqli_connect_errno(); exit;}
	$row_autoresp = mysqli_fetch_array($result);

	$msg = "Dear Administrator, <br /> please check the notification for Feedback and Commendation. <br /><br />";
	$msg .= "Name - <strong>" . $_POST[txtname]."</strong>";
	$msg .= "<br />Email - <strong>" . $_POST[email]."</strong>";
	$msg .= "<br />Tel - <strong>" . $_POST[tel]."</strong>";
	if($_POST[txttype]!="")
	{
		$msg .= "<br />Report Type - <strong>" . $_POST[type]."</strong>";
	}
	
	$msg .= "<br />Reporting on - <strong>" . $_POST[reporting]."</strong>";
	
	
	$msg .= "<br />Date of Incident - <strong>" . $date1."</strong>";
	$msg .= "<br />Time of Incident - <strong>" . $time1.":".$mintime.":00".$txttime."</strong>";
	$msg .= "<br />Location of Incident  - <strong>" . $_POST[location]."</strong>";
	

	$msg .= "<br />Name (Employee / Station or leader of group) - <strong>" . $_POST[txtemp]."</strong>";
	$msg .= "<br />Location of contact - <strong>" . $_POST[location]."</strong>";
	$msg .= "<br />Initiated His/Her contact - <strong>";
	for($i=0;$i<count($chkresponse);$i++)
	{
		$msg .= $chkresponse[$i];
	}
	$msg .= "</strong><br />Other :" . $_POST[other]."</strong>";
	$msg .= "</strong><br />Report :" . $_POST[report]."</strong>";

	$msg .= "<br /><br /><br />Regards - <br />Reporter - ".$_POST[txtname];

	if($_POST[txtemail]!="")
	{
		$mesheader =  "From: ".$_POST[txtemail]."\n" . "Reply-To: ". $_POST[txtemail] . "\r\n";
	}
	else
	{
		$mesheader =  "From: ".$row_autoresp[a_default]."\n" . "Reply-To: ". $row_autoresp[a_default] . "\r\n";
	}
	$mesheader .= "MIME-Version: 1.0\n";
	$mesheader .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
	$subject = "BPS : Feedback and Commendation : from ".$_POST[txtname];	

	@mail($row_autoresp[a_email1],$subject,$msg,$mesheader);
	@mail($row_autoresp[a_email2],$subject,$msg,$mesheader);
	@mail($row_autoresp[a_email3],$subject,$msg,$mesheader);

	
	//header("Location:bps-feedback-misconduct.php?flag=add");
	?>
	   <body onload="document.frm.submit();">
			<form method="POST" action="<?php echo $rewritepath;?>index.php/bps-feedback-misconduct/" name="frm">
			<input type="hidden" name="flag" value="add">
			</form>
		</body>
	<?php
	exit;

	}
		else
				{
						//header("Location:".$rewritepath."contact/");
						?>
						<body onload="document.frm.submit();">
							<form method="POST" action="<?php echo $rewritepath;?>index.php/bps-feedback-misconduct/" name="frm">
								<input type="hidden" name="flag" value="hash">
								<input type="hidden" name="flag" value="wrong">
								<input type="hidden" name="txtname" id="txtname" value="<?php echo preg_chk($_POST['txtname'])?>">
								<input type="hidden" id="tel" name="tel" value="<?php echo preg_chk($_POST['tel'])?>">
								<input type="hidden" id="email" name="email" value="<?php echo preg_chk($_POST['email'])?>">
								<input type="hidden" id="txttype" name="txttype" value="<?php echo preg_chk($_POST['txtype'])?>">
								<input type="hidden" id="reporting" name="reporting" value="<?php echo preg_chk($_POST['reporting'])?>">
								<input type="hidden" id="txtdate" name="txtdate" value="<?php echo $_POST['txtdate']?>">
								<input type="hidden" id="hourtime" name="hourtime" value="<?php echo preg_chk($_POST['hourtime'])?>">
								<input type="hidden" id="mintime" name="mintime" value="<?php echo preg_chk($_POST['mintime'])?>">
								<input type="hidden" id="txttime" name="txttime" value="<?php echo preg_chk($_POST['txttime'])?>">
								<input type="hidden" id="location" name="location" value="<?php echo preg_chk($_POST['location'])?>">
								<input type="hidden" id="txtemp" name="txtemp" value="<?php echo preg_chk($_POST['txtemp'])?>">
								<input type="hidden" id="report" name="report" value="<?php echo preg_chk($_POST['report'])?>">
							</form>
						</body>
						<?php
						exit();
				}
			}
		else
		{  
			//header("location:".$rewritepath."error/");
			?>
						<body onload="document.frm.submit();">
							<form method="POST" action="<?php echo $rewritepath;?>index.php/bps-feedback-misconduct/" name="frm">
								<input type="hidden" name="flag" value="direct">
								<input type="hidden" name="flag" value="wrong">
								<input type="hidden" name="txtname" id="txtname" value="<?php echo preg_chk($_POST['txtname'])?>">
								<input type="hidden" id="tel" name="tel" value="<?php echo preg_chk($_POST['tel'])?>">
								<input type="hidden" id="email" name="email" value="<?php echo preg_chk($_POST['email'])?>">
								<input type="hidden" id="txttype" name="txttype" value="<?php echo preg_chk($_POST['txtype'])?>">
								<input type="hidden" id="reporting" name="reporting" value="<?php echo preg_chk($_POST['reporting'])?>">
								<input type="hidden" id="txtdate" name="txtdate" value="<?php echo $_POST['txtdate']?>">
								<input type="hidden" id="hourtime" name="hourtime" value="<?php echo preg_chk($_POST['hourtime'])?>">
								<input type="hidden" id="mintime" name="mintime" value="<?php echo preg_chk($_POST['mintime'])?>">
								<input type="hidden" id="txttime" name="txttime" value="<?php echo preg_chk($_POST['txttime'])?>">
								<input type="hidden" id="location" name="location" value="<?php echo preg_chk($_POST['location'])?>">
								<input type="hidden" id="txtemp" name="txtemp" value="<?php echo preg_chk($_POST['txtemp'])?>">
								<input type="hidden" id="report" name="report" value="<?php echo preg_chk($_POST['report'])?>">
							</form>
						</body>
						<?php
						exit();
		}
    }
	

else
{
	//header("location:".$rewritepath."error/");?>

				<body onload="document.frm.submit();">
					<form method="POST" action="<?php echo $rewritepath;?>index.php/bps-feedback-misconduct/" name="frm">
						<input type="hidden" name="flag" value="direct">
						<input type="hidden" name="flag" value="wrong">
						<input type="hidden" name="txtname" id="txtname" value="<?php echo preg_chk($_POST['txtname'])?>">
						<input type="hidden" id="tel" name="tel" value="<?php echo preg_chk($_POST['tel'])?>">
						<input type="hidden" id="email" name="email" value="<?php echo preg_chk($_POST['email'])?>">
						<input type="hidden" id="txttype" name="txttype" value="<?php echo preg_chk($_POST['txtype'])?>">
						<input type="hidden" id="reporting" name="reporting" value="<?php echo preg_chk($_POST['reporting'])?>">
						<input type="hidden" id="txtdate" name="txtdate" value="<?php echo $_POST['txtdate']?>">
						<input type="hidden" id="hourtime" name="hourtime" value="<?php echo preg_chk($_POST['hourtime'])?>">
						<input type="hidden" id="mintime" name="mintime" value="<?php echo preg_chk($_POST['mintime'])?>">
						<input type="hidden" id="txttime" name="txttime" value="<?php echo preg_chk($_POST['txttime'])?>">
						<input type="hidden" id="location" name="location" value="<?php echo preg_chk($_POST['location'])?>">
						<input type="hidden" id="txtemp" name="txtemp" value="<?php echo preg_chk($_POST['txtemp'])?>">
						<input type="hidden" id="report" name="report" value="<?php echo preg_chk($_POST['report'])?>">
					</form>
				</body>
			<?php
		exit();

	}
?>