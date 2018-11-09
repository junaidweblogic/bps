<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
//print_r($_POST);exit;
@session_start();
include("common/app_function.php");
include("common/config.php");
require_once "common/recaptchalib.php";

if($_POST["g-recaptcha-response"]=="")
{
	?>
	<body onload="document.frm.submit();">
		<form name="frm" method="POST" action="<?php echo $rewritepath;?>index.php/bps-contacts/">
			<input type="hidden" name="flag" value="wrong">
			<input type="hidden" name="name" id="name" value="<?php echo preg_chk($_POST['name'])?>">
			<input type="hidden" id="tel" name="tel" value="<?php echo preg_chk($_POST['tel'])?>">
			<input type="hidden" id="email" name="email" value="<?php echo preg_chk($_POST['email'])?>">
			<input type="hidden" id="message" name="message" value="<?php echo preg_chk($_POST['message'])?>">
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
		<form name="frm" method="POST" action="<?php echo $rewritepath;?>index.php/bps-contacts/">
			<input type="hidden" name="flag" value="<?php echo $red_flag; ?>">
		</form>
	</body>
	<?php
		exit();
 }
//$imgsession= preg_chk($_SESSION["security_code"]);
//$captcha = strtolower(preg_chk($_POST['captcha']));


$userval = preg_chk($_POST['userval']);
$subject = preg_chk($_POST[subject]);
/*$HTTP_REFERER_U = date_chk($_POST['HTTP_REFERER_U']);
if($HTTP_REFERER_U=="website-design-plans-pricing" || $HTTP_REFERER_U=="website-design-plans-pricing-int")
{
	$HTTP_REFERER_U = $HTTP_REFERER_U."/#enqform";
}*/

$description = preg_chk($_POST['description']);


if($userval!="" && preg_chk($_SESSION['userval'])!="")
{	
	if($userval==$_SESSION['userval'])
		{ 
		$query_hash = sprintf("SELECT * FROM ".$tblpref."userval WHERE session_val='%s'", $_SESSION['userval']);
		if(!$result_hash = mysqli_query($connection,$query_hash))
		{  
			echo $query_hash.mysqli_errno($connection);
			exit;
		}
		 $row_hash = mysqli_fetch_array($result_hash);
		 $hash_userval = md5($userval);
		 
		 if($row_hash[hash_val] == $hash_userval)
		{            
				 $name=preg_chk($_POST[name]);
				 $email=preg_chk($_POST[email]);
				 $tel=preg_chk($_POST[tel]);
				 $message=preg_chk($_POST[message]);
				$comment=preg_chk($_POST[comment]);
				if($name!="" && $email!="" && $tel!="" && $message!="")
				{   
									$addfc ="INSERT INTO ".$tblpref."askpolice SET
									ap_name ='$name',
									ap_tel ='$tel',
									ap_email ='$email',
									ap_askpolice ='$message',
									ap_date =CURDATE(),
									ap_ip='$_SERVER[REMOTE_ADDR]',
									ap_status='New'";
									if(!($result = mysqli_query($connection,$addfc))){echo $addfc.mysqli_errno($connection);  exit;}

									$query = "SELECT * FROM " . $tblpref . "autoresponders WHERE a_id = '3'";
									if(!($result=mysqli_query($connection,$query))){echo $query.mysqli_errno($connection); exit;}
									$row_autoresp = mysqli_fetch_array($result);

									$msg = "Dear Administrator, <br /> Please check the notification for Ask the Police. <br /><br />";
									$msg .= "Name - <strong>" . $_POST[txtname]."</strong>";
									$msg .= "<br />Email - <strong>" . $_POST[email]."</strong>";
									$msg .= "<br />Tel - <strong>" . $_POST[tel]."</strong>";
									$msg .= "<br />Asking For " . $_POST[message]."</strong>";

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
									$subject = "BPS : Ask the Police : from  ".$_POST[txtname];	

									//@mail($row_autoresp[a_email1],$subject,$msg,$mesheader);
									//@mail($row_autoresp[a_email2],$subject,$msg,$mesheader);
									//@mail($row_autoresp[a_email3],$subject,$msg,$mesheader);
								//@session_destroy('userval');
								$_SESSION['userval']=="";
								?>
							<body onload="document.frm.submit();">
							<form name="frm" method="POST" action="<?php echo $rewritepath;?>index.php/success/">
							<input type="hidden" name="flag" value="sent">
							</form>
							</body>
							<?php
								//header("Location:".$rewritepath."success/");
								exit();
								}
				
		}
		else
				{
						//header("Location:".$rewritepath."contact/");
						?>
						   <body onload="document.frm.submit();">
						   <form method="POST" action="<?php echo $rewritepath;?>index.php/bps-contacts/" name="frm">
							<input type="hidden" name="flag" value="hash">
							<input type="hidden" name="flag" value="wrong">
							<input type="hidden" name="name" id="name" value="<?php echo preg_chk($_POST['name'])?>">
							<input type="hidden" name="tel" id="tel" value="<?php echo preg_chk($_POST['tel'])?>">
							<input type="hidden" name="email" id="email" value="<?php echo preg_chk($_POST['email'])?>">
							<input type="hidden" name="message" id="message" value="<?php echo preg_chk($_POST['message'])?>">
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
						   <form method="POST" action="<?php echo $rewritepath;?>index.php/bps-contacts/" name="frm">
							<input type="hidden" name="flag" value="direct">
							<input type="hidden" name="flag" value="wrong">
							<input type="hidden" name="name" id="name" value="<?php echo preg_chk($_POST['name'])?>">
							<input type="hidden" name="tel" id="tel" value="<?php echo preg_chk($_POST['tel'])?>">
							<input type="hidden" name="email" id="email" value="<?php echo preg_chk($_POST['email'])?>">
							<input type="hidden" name="message" id="message" value="<?php echo preg_chk($_POST['message'])?>">
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
				    <form method="POST" action="<?php echo $rewritepath;?>index.php/bps-contacts/" name="frm">
					<input type="hidden" name="flag" value="direct">
					<input type="hidden" name="flag" value="wrong">
						<input type="hidden" name="name" id="name" value="<?php echo preg_chk($_POST['name'])?>">
						<input type="hidden" name="tel" id="tel" value="<?php echo preg_chk($_POST['tel'])?>">
						<input type="hidden" name="email" id="email" value="<?php echo preg_chk($_POST['email'])?>">
						<input type="hidden" name="message" id="message" value="<?php echo preg_chk($_POST['message'])?>">
					</form>
				</body>
			<?php
		exit();

	}
?>