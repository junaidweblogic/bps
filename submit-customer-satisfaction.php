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
$radnature = preg_chk($_POST['radnature']);
$radrel= preg_chk($_POST['radrel']);
$radclean = preg_chk($_POST['radclean']);
$radrecep = preg_chk($_POST['radrecep']);
$radwaittime = preg_chk($_POST['radwaittime']);
 $radlisten = $_POST['radlisten'];
  $radtreat = $_POST['radtreat'];
  $radconfident = $_POST['radconfident'];
  $radknow = $_POST['radknow'];
 $radreport = preg_chk($_POST['radreport']);
 $radexplhap = preg_chk($_POST['radexplhap']);
$radfdreatime = preg_chk($_POST['radfdreatime']);
$radcase = preg_chk($_POST['radcase']);
$radservice = preg_chk($_POST['radservice']);
$imppolservice = preg_chk($_POST['imppolservice']);
$radgender = preg_chk($_POST['radgender']);
$radagegrp = preg_chk($_POST['radagegrp']);
$nationality = preg_chk($_POST['nationality']);
$txtname = preg_chk($_POST['txtname']);
$txtemail = preg_chk($_POST['txtemail']);
$tel = preg_chk($_POST['tel']);
$curdate = @date("Y-m-d H:i:s");

 if($_POST["g-recaptcha-response"]=="")
{
	?>
	<body onload="document.frm.submit();">
		<form name="frm" method="POST" action="<?php echo $rewritepath;?>index.php/bps-customer-satisfaction/">
			<input type="hidden" name="flag" value="wrong">
			<input type="hidden" name="radnature" id="radnature" value="<?php echo $radnature?>">
			<input type="hidden" id="radrel" name="radrel" value="<?php echo $radrel?>">
			<input type="hidden" id="radclean" name="radclean" value="<?php echo $radclean?>">
			<input type="hidden" id="radrecep" name="radrecep" value="<?php echo $radrecep?>">
			<input type="hidden" id="radwaittime" name="radwaittime" value="<?php echo $radwaittime; ?>">
			<input type="hidden" id="radlisten" name="radlisten" value="<?php echo $radlisten?>">
			<input type="hidden" id="radtreat" name="radtreat" value="<?php echo $radtreat?>">
			<input type="hidden" id="radconfident" name="radconfident" value="<?php echo $radconfident?>">
			<input type="hidden" id="radknow" name="radknow" value="<?php echo $radknow?>">
			<input type="hidden" id="radreport" name="radreport" value="<?php echo $radreport?>">
			<input type="hidden" id="radexplhap" name="radexplhap" value="<?php echo $radexplhap?>">
			<input type="hidden" id="radfdreatime" name="radfdreatime" value="<?php echo $radfdreatime?>">
			<input type="hidden" id="radcase" name="radcase" value="<?php echo $radcase?>">
			<input type="hidden" id="radservice" name="radservice" value="<?php echo $radservice?>">
			<input type="hidden" id="radgender" name="radgender" value="<?php echo $radgender?>">
			<input type="hidden" id="radagegrp" name="radagegrp" value="<?php echo $radagegrp?>">
			<input type="hidden" id="nationality" name="nationality" value="<?php echo $nationality?>">
			<input type="hidden" id="txtname" name="txtname" value="<?php echo $txtname?>">
			<input type="hidden" id="txtemail" name="txtemail" value="<?php echo $txtemail?>">
			<input type="hidden" id="tel" name="tel" value="<?php echo $tel?>">
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
		<form name="frm" method="POST" action="<?php echo $rewritepath;?>index.php/bps-customer-satisfaction//">
			<input type="hidden" name="flag" value="<?php echo $red_flag; ?>">
		</form>
	</body>
	<?php
		exit();
 }



 $userval = preg_chk($_POST['userval']);
	if($userval!="" && $_SESSION['userval']!="")
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
				
				$addfc ="INSERT INTO ".$tblpref."cust_satisfaction SET
				cs_nature_visit ='$radnature',
				cs_sat_direct_rel ='$radrel',
				cs_sat_off_clean ='$radclean',
				cs_sat_recept ='$radrecep',
				cs_sat_wait_time ='$radwaittime',
				cs_treat_listen ='$radlisten',
				cs_treat_courteously ='$radtreat',
				cs_treat_appre ='$radconfident',
				cs_treat_know_prod ='$radknow',
				cs_incid_discourage ='$radreport',
				cs_incid_happen ='$radexplhap',
				cs_incid_offer ='$radfdreatime',
				cs_incid_contact ='$radcase',
				cs_service_sat ='$radservice',
				cs_improve_ser ='$imppolservice',
				cs_gender ='$radgender',
				cs_age_grp ='$radagegrp',
				cs_nationality ='$nationality',
				cs_name ='$txtname',
				cs_email ='$txtemail',
				cs_tel ='$tel',
				cs_date ='$curdate',
				cs_ip = '$_SERVER[REMOTE_ADDR]',
				cs_status ='New'";
				if(!($result = mysqli_query($connection,$addfc))){echo $addfc.mysqli_connect_errno();  exit;}

				$query = "SELECT * FROM " . $tblpref . "admin WHERE admin_id = '1'";
				if(!($result=mysqli_query($connection,$query))){echo $query.mysqli_connect_errno(); exit;}
				$row_autoresp = mysqli_fetch_array($result);

				$msg = "Dear <strong>Administrator</strong>, <br /> Please check the notification for Customer Satisfaction Report. <br /><br />";
				$msg .= "The nature of your visit - <strong>" . $_POST[radnature]."</strong><br><br>";
				$msg .= "<strong>How satisfied were you with : </strong><br>";
				$msg .= "Directions to the relevant office : <strong>" . $_POST[radrel]."</strong><br>";
				$msg .= "Office cleanliness :<strong>" . $_POST[radtreat]."</strong><br>";
				$msg .= "Reception upon arrival :<strong>" . $_POST[radrecep]."</strong><br>";
				$msg .= "Waiting time :<strong>" . $_POST[radwaittime]."</strong><br>";
				$msg .= "Waiting time :<strong>" . $_POST[radwaittime]."</strong><br><br>";

				$msg .= "<strong>TREATMENT BY POLICE STAFF : </strong><br>";
				$msg .= "Listen to what you had to say? : <strong>" . $_POST[radlisten]."</strong><br>";
				$msg .= "Treat you courteously? :<strong>" . $_POST[radclean]."</strong><br>";
				$msg .= "Appreciate the need for confidentiality? :<strong>" . $_POST[radconfident]."</strong><br>";
				$msg .= "Display knowledge of the product? :<strong>" . $_POST[radknow]."</strong><br><br>";	

				$msg .= "<strong>POLICE ACTIONS TO DEAL WITH THE INCIDENT : </strong><br>";
				$msg .= "Try to discourage you from reporting the incident : <strong>" . $_POST[radreport]."</strong><br>";
				$msg .= "Explain what was going to happen? :<strong>" . $_POST[radexplhap]."</strong><br>";
				$msg .= "Offer to give you feedback within a reasonable time? :<strong>" . $_POST[radfdreatime]."</strong><br>";
				$msg .= "Provide you with contact details for someone dealing with your case? :<strong>" . $_POST[radcase]."</strong><br><br>";

				$msg .= "Overall, how satisfied were you with the service :<strong>" . $_POST[radservice]."</strong><br>";

				$msg .= "How can we improve police services in the future? :<strong>" . $_POST[imppolservice]."</strong><br><br>";

				$msg .= "<strong>About Reporter : </strong><br>";

				$msg .= "Gender :<strong>" . $_POST[imppolservice]."</strong><br>";
				$msg .= "Nationality :<strong>" . $_POST[nationality]."</strong><br>";
				$msg .= "Name :<strong>" . $_POST[txtname]."</strong><br>";
				$msg .= "Email :<strong>" . $_POST[txtemail]."</strong><br>";
				$msg .= "Tel :<strong>" . $_POST[tel]."</strong><br>";

				$msg .= "<br /><br /><br />Regards - <br />Reporter - ".$_POST[txtname];

				if($_POST[txtemail]=="")
				{
					$mesheader =  "From: ".$_POST[txtemail]."\n" . "Reply-To: ". $_POST[txtemail] . "\r\n";
				}
				else
				{
					$mesheader =  "From: ".$row_autoresp[admin_email]."\n" . "Reply-To: ". $row_autoresp[admin_email] . "\r\n";
				}

				$mesheader .= "MIME-Version: 1.0\n";
				$mesheader .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
				$subject = "BPS : Customer Satisfaction Report : from ".$_POST[txtname];
				
				@mail($row_autoresp[admin_email],$subject,$msg,$mesheader);
				
				
				//header("Location:bps-customer-satisfaction.php?flag=add");
				?>
					   <body onload="document.frm.submit();">
						   <form method="POST" action="<?php echo $rewritepath;?>index.php/bps-customer-satisfaction/" name="frm">
							<input type="hidden" name="flag" value="add">
							</form>
						</body>
					<?php
				exit;
			}
			else
			{ ?>
					   <body onload="document.frm.submit();">
							<form method="POST" action="<?php echo $rewritepath;?>index.php/bps-customer-satisfaction/" name="frm">
								<input type="hidden" name="flag" value="hash">
								<input type="hidden" name="flag" value="wrong">
								<input type="hidden" name="radnature" id="radnature" value="<?php echo $radnature?>">
								<input type="hidden" id="radrel" name="radrel" value="<?php echo $radrel?>">
								<input type="hidden" id="radclean" name="radclean" value="<?php echo $radclean?>">
								<input type="hidden" id="radrecep" name="radrecep" value="<?php echo $radrecep?>">
								<input type="hidden" id="radwaittime" name="radwaittime" value="<?php echo $radwaittime; ?>">
								<input type="hidden" id="radlisten" name="radlisten" value="<?php echo $radlisten?>">
								<input type="hidden" id="radtreat" name="radtreat" value="<?php echo $radtreat?>">
								<input type="hidden" id="radconfident" name="radconfident" value="<?php echo $radconfident?>">
								<input type="hidden" id="radknow" name="radknow" value="<?php echo $radknow?>">
								<input type="hidden" id="radreport" name="radreport" value="<?php echo $radreport?>">
								<input type="hidden" id="radexplhap" name="radexplhap" value="<?php echo $radexplhap?>">
								<input type="hidden" id="radfdreatime" name="radfdreatime" value="<?php echo $radfdreatime?>">
								<input type="hidden" id="radcase" name="radcase" value="<?php echo $radcase?>">
								<input type="hidden" id="radservice" name="radservice" value="<?php echo $radservice?>">
								<input type="hidden" id="radgender" name="radgender" value="<?php echo $radgender?>">
								<input type="hidden" id="radagegrp" name="radagegrp" value="<?php echo $radagegrp?>">
								<input type="hidden" id="nationality" name="nationality" value="<?php echo $nationality?>">
								<input type="hidden" id="txtname" name="txtname" value="<?php echo $txtname?>">
								<input type="hidden" id="txtemail" name="txtemail" value="<?php echo $txtemail?>">
								<input type="hidden" id="tel" name="tel" value="<?php echo $tel?>">
							</form>
						</body>
					<?php
					exit();
			}
		}
		else
		{ ?>
				   <body onload="document.frm.submit();">
							<form method="POST" action="<?php echo $rewritepath;?>index.php/bps-customer-satisfaction/" name="frm">
								<input type="hidden" name="flag" value="direct">
								<input type="hidden" name="flag" value="wrong">
								<input type="hidden" name="radnature" id="radnature" value="<?php echo $radnature?>">
								<input type="hidden" id="radrel" name="radrel" value="<?php echo $radrel?>">
								<input type="hidden" id="radclean" name="radclean" value="<?php echo $radclean?>">
								<input type="hidden" id="radrecep" name="radrecep" value="<?php echo $radrecep?>">
								<input type="hidden" id="radwaittime" name="radwaittime" value="<?php echo $radwaittime; ?>">
								<input type="hidden" id="radlisten" name="radlisten" value="<?php echo $radlisten?>">
								<input type="hidden" id="radtreat" name="radtreat" value="<?php echo $radtreat?>">
								<input type="hidden" id="radconfident" name="radconfident" value="<?php echo $radconfident?>">
								<input type="hidden" id="radknow" name="radknow" value="<?php echo $radknow?>">
								<input type="hidden" id="radreport" name="radreport" value="<?php echo $radreport?>">
								<input type="hidden" id="radexplhap" name="radexplhap" value="<?php echo $radexplhap?>">
								<input type="hidden" id="radfdreatime" name="radfdreatime" value="<?php echo $radfdreatime?>">
								<input type="hidden" id="radcase" name="radcase" value="<?php echo $radcase?>">
								<input type="hidden" id="radservice" name="radservice" value="<?php echo $radservice?>">
								<input type="hidden" id="radgender" name="radgender" value="<?php echo $radgender?>">
								<input type="hidden" id="radagegrp" name="radagegrp" value="<?php echo $radagegrp?>">
								<input type="hidden" id="nationality" name="nationality" value="<?php echo $nationality?>">
								<input type="hidden" id="txtname" name="txtname" value="<?php echo $txtname?>">
								<input type="hidden" id="txtemail" name="txtemail" value="<?php echo $txtemail?>">
								<input type="hidden" id="tel" name="tel" value="<?php echo $tel?>">
							</form>
						</body>
				<?php
				exit();
		}
	}
	else
	{ ?>
			   <body onload="document.frm.submit();">
							<form method="POST" action="<?php echo $rewritepath;?>index.php/bps-customer-satisfaction/" name="frm">
								<input type="hidden" name="flag" value="direct">
								<input type="hidden" name="flag" value="wrong">
								<input type="hidden" name="radnature" id="radnature" value="<?php echo $radnature?>">
								<input type="hidden" id="radrel" name="radrel" value="<?php echo $radrel?>">
								<input type="hidden" id="radclean" name="radclean" value="<?php echo $radclean?>">
								<input type="hidden" id="radrecep" name="radrecep" value="<?php echo $radrecep?>">
								<input type="hidden" id="radwaittime" name="radwaittime" value="<?php echo $radwaittime; ?>">
								<input type="hidden" id="radlisten" name="radlisten" value="<?php echo $radlisten?>">
								<input type="hidden" id="radtreat" name="radtreat" value="<?php echo $radtreat?>">
								<input type="hidden" id="radconfident" name="radconfident" value="<?php echo $radconfident?>">
								<input type="hidden" id="radknow" name="radknow" value="<?php echo $radknow?>">
								<input type="hidden" id="radreport" name="radreport" value="<?php echo $radreport?>">
								<input type="hidden" id="radexplhap" name="radexplhap" value="<?php echo $radexplhap?>">
								<input type="hidden" id="radfdreatime" name="radfdreatime" value="<?php echo $radfdreatime?>">
								<input type="hidden" id="radcase" name="radcase" value="<?php echo $radcase?>">
								<input type="hidden" id="radservice" name="radservice" value="<?php echo $radservice?>">
								<input type="hidden" id="radgender" name="radgender" value="<?php echo $radgender?>">
								<input type="hidden" id="radagegrp" name="radagegrp" value="<?php echo $radagegrp?>">
								<input type="hidden" id="nationality" name="nationality" value="<?php echo $nationality?>">
								<input type="hidden" id="txtname" name="txtname" value="<?php echo $txtname?>">
								<input type="hidden" id="txtemail" name="txtemail" value="<?php echo $txtemail?>">
								<input type="hidden" id="tel" name="tel" value="<?php echo $tel?>">
							</form>
						</body>
			<?php
			exit();
	}
?>