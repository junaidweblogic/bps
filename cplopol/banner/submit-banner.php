<?php 

session_start();
$txtid=$_POST[txtid];
include("../../common/cploconfig.php");
include("../../common/app_function.php");

$bnname = $_REQUEST['bnname'];
$widthval = $_REQUEST[widthval];
$heightval = $_REQUEST[heightval];

$bnurl = urlencode($_REQUEST[bnurl]);
/*
if($_FILES["bnimage"]["name"]!="") {
	 $fileload = $_FILES["bnimage"]["name"];
	 $destpath="../../possbpser/".$fileload;
	 copy($_FILES["bnimage"]["tmp_name"],$destpath) or die("Unable to upload file1");
	 list($width, $height) = getimagesize("../../possbpser/".$fileload);
	 @unlink("../../possbpser/".$fileload);
	 if($widthval < $width && $heightval < $height) {
	 	header("Location:banner-edit.php?bnid1=".$_REQUEST[txtid]."&flag=width");
		exit;
	 }
}
*/

$exdate=dateformate($exdate);
$today=date("Y-m-d");
if($_FILES["bnimage"]["name"]!="") 
{
$var = $_FILES["bnimage"]["type"]; 
$var = explode("/",$var);
$var = $var[0];
if($var != "image")
{
if($txtid!="")
	{ $a=$txtid;}else{$a=$txtbnid;}
header("Location:banner-edit.php?flag=filetype&bnid=$a"); 
exit; 
} }
$bnurl = $_REQUEST['bnurl'];
	if(strstr($bnurl, "http://")) 
		$bnurl = $bnurl;
	else
		$bnurl = "http://".$bnurl;

if ($flag=="del")
		{
			$query = sprintf("delete from c_banner  WHERE bn_id = %d", $bnid1);
			if (!($result = mysqli_query($connection,$query))){  echo $query.mysqli_connect_errno();  exit();  
			}
			$redirect = "location:bannerlist.php?bnid=$bnid&nomatch=1&msg=del";
			header($redirect);
			exit();
		}

if ($txtid !="")
{
	$array = array($exyear,$exmonth,$exdate);
	$ex_date = implode("-", $array);
	if($bn_parentid==1){
	$query = sprintf("UPDATE c_banner SET bn_name='%s', bn_exdate='$today', bn_url='%s', bn_height='%d',bn_type ='banner', bn_width='100', bn_numberofcount='%d', bn_parentid='%d' WHERE bn_id='%d'",$bnname, $bnurl, $height, $bn_countnumber, $bn_parentid, $txtid); }
				else{
				$query = sprintf("UPDATE c_banner SET bn_name='$today', bn_exdate='%s', bn_url='%s', bn_height='%d', bn_type ='banner', bn_width='100', bn_numberofcount='%d', bn_parentid='%d' WHERE bn_id='%d'", $bnname, $bnurl, $height, $bn_countnumber, $bn_parentid, $txtid) ; }
				
	if (!($result = mysqli_query($connection,$query))) { echo $query.mysqli_connect_errno();  exit;  }

	if($_FILES["bnimage"]["name"]!="") 
	
	{
			 $fileload = $_FILES["bnimage"]["name"];
			 $file_ext = explode(".",$fileload);
			 $myattach="banner_image".$txtid.".".$file_ext[1];
			$destpath="../../possbpser/".$myattach;
			 
			 copy($_FILES["bnimage"]["tmp_name"],$destpath) or die("Unable to upload file1");
			 
			 $updatecategory=sprintf("UPDATE c_banner SET  bn_image = '%s' WHERE  bn_id  ='%d'", $myattach, $txtid); 
			 if(!($result = mysqli_query($connection,$updatecategory))){echo $updatecategory.mysqli_connect_errno();exit;}
	}

	$redirect = "location:bannerlist.php?bnid=$txtbnid&nomatch=1&msg=edit";
	header($redirect);
	exit;
}
else
{
	$array = array($exyear,$exmonth,$exdate);
	$ex_date = implode("-", $array);

	$query1="SELECT * FROM c_banner WHERE bn_parentid='$txtbnid' ORDER BY bn_dispcount";
	if(!$result11=mysqli_query($connection,$query1)){echo $query1.mysqli_connect_errno(); exit;}
	$rowbnct=mysqli_fetch_array($result11);
	$bncount=$rowbnct[bn_dispcount];
	if($txtbnid==1){
	$query = sprintf("INSERT INTO c_banner SET	bn_name='%s', bn_url='%s', bn_height='%d',  bn_width='100', bn_exdate='$today', bn_dispcount='%s', bn_type ='banner', bn_numberofcount ='%d',	bn_parentid='%d'", $bnname, $bnurl, $height, $bncount, $bn_countnumber, $txtbnid);}
				else{
				$query = sprintf("INSERT INTO c_banner SET	bn_name='%s', bn_url='%s', bn_height='%d', bn_width='100', bn_exdate='$today', bn_dispcount='%s', bn_type ='banner', bn_numberofcount ='%d', bn_parentid='%d'",$bnname, $bnurl, $height, $bncount, $bn_countnumber, $txtbnid);}
	if (!($result = mysqli_query($connection,$query))) { echo $query.mysqli_connect_errno();  exit;}
	$txtid=mysqli_insert_id($connection);	

	if($_FILES["bnimage"]["name"]!="") 
	{
		 
			 $fileload = $_FILES["bnimage"]["name"];
			 $file_ext = explode(".",$fileload);
			 $myattach="banner_image".$txtid.".".$file_ext[1];
			 $destpath="../../possbpser/".$myattach;
			 
			 copy($_FILES["bnimage"]["tmp_name"],$destpath) or die("Unable to upload file1");

			 $updatecategory=sprintf("UPDATE c_banner SET  bn_image = '%s' WHERE  bn_id  = %d", $myattach, $txtid); 
			 if(!($result = mysqli_query($connection,$updatecategory))){echo $updatecategory.mysqli_connect_errno();exit;} 
	}
	$redirect = "location:bannerlist.php?nomatch=1&bnid=$txtbnid&msg=add";
	header("$redirect");
	exit;
}
?>