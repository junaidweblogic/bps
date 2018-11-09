<?
session_start();
include("../../common/cploconfig.php");
include("../../common/app_function.php");


	$today = date("Y-m-d");

	$poll_quest = addslashes($poll_quest);
	$poll_option1 = addslashes($poll_option1);
	$poll_option2 = addslashes($poll_option2);
	$poll_option3 = addslashes($poll_option3);

	$poll_sdate = dateformate($poll_sdate);
	$poll_edate = dateformate($poll_edate);

	$qadd="Update ".$tblpref."poll_option set 
	poll_que='$poll_quest',
	poll_opt1='$poll_option1',
	poll_opt2 ='$poll_option2',
	poll_opt3='$poll_option3',
	poll_sdate='$poll_sdate',
	poll_edate='$poll_edate',
	poll_date='$today'
	where id='1'";
	if(!($res=mysqli_query($connection,$qadd))){echo $qadd.mysqli_errno($connection); exit;}


	log_entry("Poll",$title,"Updated", $tblpref,  $db, $row_admin[admin_id],$ip); 

	header("Location:index.php?flag=update");
	exit;
		
?>
