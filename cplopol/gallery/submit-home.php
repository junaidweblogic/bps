<?php  
@session_start();
include("../../common/app_function.php");
include("../../common/config.php");
if($_SESSION[username]=="")
{
	displayerror("Login Error.","","For security of your account,we have expired your session.<br>&nbsp;Please login to your account again.", "Login,../index.php", 0);
	exit();
}
$mode = $_REQUEST[mode];
$fid = $_REQUEST[fid];
$fn = $_REQUEST[fn];
$photographer=addslashes($_POST[photographer]);
$location=addslashes($_POST[location]);
$event=addslashes($_POST[event]);
$date=dateformate($_POST[date]);
$newsid=$_POST[newsid];
/************************************/



if($_FILES["the_file"]["name"]!="")
{
		$id = $_POST[newsid];
		$_FILES['the_file']["name"];
		$type = $_FILES["the_file"]["type"];
		
		$type = explode("/",$type);
		$size = $_FILES["the_file"]["size"];
		//$size = explode("/",$size);

		if($type[0]!='image')
		{
			header("Location:home.php?flag=type&id=$id");
			exit;
		}
		if($size>'2097152')
		{
			header("Location:home.php?flag=size&id=$id");
			exit;
		}
	

}

/***********************************/
if($mode == "del")
{
	$id = $_GET[id];
	$selque=sprintf("SELECT * FROM ".$tblpref."gallery WHERE image_id='%d'",$id);
	if(!($selresult=mysqli_query($connection,$selque))){echo mysqli_error($selque); exit;}
	$sel_row=mysqli_fetch_array($selresult);
	$rec_title=$sel_row[image_name];
	log_entry("Gallery",$rec_title,"Picture Deleted", $tblpref,  $db, $row_admin[admin_id],$ip);

	$strdel = sprintf("DELETE FROM ".$tblpref."gallery WHERE image_id = '%d'", $fid);
	if(!($result=mysqli_query($connection,$strdel)))	{echo $strdel.mysqli_errno($connection);	exit;}
		////////////// dele file /////////////////
		$filepath = "../../possbpser/".$fn;
		@unlink($filepath);
	header("location:home.php?flag=del&id=$id");
	exit;

}
else
{
	$imgcap = addslashes($_POST[imgcap]);
	/*$imgcap = addslashes($_POST[imgcap]);
	$category = $_POST[category]; 
	$qchk=sprintf("SELECT * FROM ".$tblpref."gallery WHERE image_name='%s'", $imgcap);
	if(!($resqchk=mysqli_query($connection,$qchk))){ echo "FOR QUERY: $query<BR>".mysqli_errno($connection); exit;}
	$rowcount=mysqli_num_rows($resqchk);
    if($rowcount>0)
	{
	      header("location:home.php?flag=exists&id=".$newsid);
	       exit;
	}
	else
	{*/
		if($_FILES["the_file"]["name"]!="") 
		{
						$date=dateformate($_POST[date]);			
						
						$query = sprintf("INSERT INTO ".$tblpref."gallery SET image_name='%s',img_album_id='%d'", $imgcap, $newsid);
						
						//echo "</br>";
						if(!($result = mysqli_query($connection,$query))){echo $query.mysqli_errno($connection);exit;}
						$id = mysqli_insert_id($connection);
						log_entry("Picture Management",$imgcap,"Picture Added", $tblpref,  $db, $row_admin[admin_id],$ip);
						
						
						$sel_que=sprintf("SELECT * FROM ".$tblpref."category WHERE cat_id='%d'", $newsid);
						if(!($resque=mysqli_query($connection,$sel_que))){ echo "FOR QUERY: $query<BR>".mysqli_error($sel_que); exit;}
						$rowsel=mysqli_fetch_array($resque);

						$fileload = $_FILES["the_file"]["name"];
						$file_ext = explode(".",$fileload);
						$ext= count($file_ext);
						
						//$heading =dateformate($rowsel[cms_news_modi_date])." ".strtolower($rowsel[cms_title])." ". time()."_".$id."-".$i.".".$file_ext[$ext-1];
						$heading =time()."-".$id."-".$i.".".$file_ext[$ext-1];
						$heading = preg_replace('/\s\s+/', ' ', trim($heading));
						$myattach = str_replace(" ","-",$heading);
						$destpath="../../possbpser/".$myattach;
						copy($_FILES["the_file"]["tmp_name"],$destpath) or die("Unable to upload image");
		
						$updatecategory=sprintf("UPDATE ".$tblpref."gallery SET image_path = '%s' WHERE image_id='%d'", $myattach, $id);
						if(!($result = mysqli_query($connection,$updatecategory))){echo $updatecategory.mysqli_errno($connection);exit;}
				
			//$myattach=dateformate($rowsel[cms_news_modi_date])."-".stripslashes($rowsel[cms_title])."-".$imgcap.".".$file_ext[$ext-1];
		//}
	}
	header("location:home.php?flag=add&id=".$newsid);
	exit;
}
?>