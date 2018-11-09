<?php 
session_start();
$txtid=$_POST[txtid];
include("../../common/cploconfig.php");
include("../../common/app_function.php");
$datepicker = dateformate($datepicker);
$bnname = addslashes($bnname);
$content=addslashes($_REQUEST[linkcontect]);
$widthval = $_REQUEST[widthval];
$heightval = $_REQUEST[heightval];
$height= $heightval;

$height= $height+0;
$bn_countnumber = $bn_countnumber+0;


/*
if($_FILES["bnimage"]["name"]!="") {
	 $fileload = $_FILES["bnimage"]["name"];
	 $destpath="../../tmposs/".$fileload;
	 copy($_FILES["bnimage"]["tmp_name"],$destpath) or die("Unable to upload file1");
	 list($width, $height) = getimagesize("../../tmposs/".$fileload);
	 @unlink("../../tmposs/".$fileload);
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
/*$bnurl = $_REQUEST[bnurl];
	if(strstr($bnurl, "http://")) 
		$bnurl = $bnurl;
	else
		$bnurl = "http://".$bnurl;*/

if ($flag=="del")
		{
			$query = "delete from c_banner  WHERE bn_id =".$bnid1;
			if (!($result = mysqli_query($connection,$query))){  echo $query.mysqli_errno($connection);  exit();  
			}
			$redirect = "location:bannerlist.php?bnid=$bnid&nomatch=4&msg=del";
			header($redirect);
			exit();
		}

if ($txtid !="")
{
	$array = array($exyear,$exmonth,$exdate);
	$ex_date = implode("-", $array);
	if($bn_parentid==1){
	$query = "UPDATE c_banner SET 
				bn_name='$bnname',
				bn_exdate='$datepicker',
				bn_url='$bnurl',
				bn_height='$height',
				bn_type ='wanted',
				bn_width='100',
				bn_numberofcount='$bn_countnumber',
				bn_parentid='$bn_parentid' WHERE bn_id='$txtid'" ; 
				}
				else{
				$query = "UPDATE c_banner SET 
				bn_name='$bnname',
				bn_exdate='$datepicker',
				bn_url='$bnurl',
				bn_height='$height',
				bn_type ='wanted',
				bn_width='100',
				bn_numberofcount='$bn_countnumber',
				bn_parentid='$bn_parentid',
				bn_desc='$content' WHERE bn_id='$txtid'" ; 
				}
				
				
	if (!($result = mysqli_query($connection,$query))) { echo $query.mysqli_errno($connection);  exit;  }

	if($_FILES["bnimage"]["name"]!="") 
	
	{
			 $fileload = $_FILES["bnimage"]["name"];
			 $file_ext = explode(".",$fileload);
			 $myattach="bannerwanted_".$txtid.".".$file_ext[1];
			 $destpath="../../possbpser/".$myattach;
			 
			 copy($_FILES["bnimage"]["tmp_name"],$destpath) or die("Unable to upload file1");
			 
			 $updatecategory="UPDATE c_banner SET  bn_image = '".$myattach."' WHERE  bn_id  =".$txtid; 
			 if(!($result = mysqli_query($connection,$updatecategory))){echo $updatecategory.mysqli_errno($connection);exit;}
	}

	$redirect = "location:bannerlist.php?bnid=$txtbnid&nomatch=2&msg=edit";
	header($redirect);
	exit;
}
else
{
	$array = array($exyear,$exmonth,$exdate);
	$ex_date = implode("-", $array);

	$query1="SELECT * FROM c_banner WHERE bn_parentid='$txtbnid' ORDER BY bn_dispcount";
	if(!$result11=mysqli_query($connection,$query1)){echo $query1.mysqli_errno($connection); exit;}
	$rowbnct=mysqli_fetch_array($result11);
	$bncount=$rowbnct[bn_dispcount];
	if($txtbnid==1){
	$query = "INSERT INTO c_banner SET
				bn_name='$bnname',
				bn_url='$bnurl',
				bn_height='$height',
				bn_width='100',
				bn_exdate='$datepicker',
				bn_dispcount='$bncount',
				bn_type ='wanted',
				bn_numberofcount ='$bn_countnumber',
				bn_parentid='$txtbnid'";}
				else{
				$query = "INSERT INTO c_banner SET
				bn_name='$bnname',
				bn_url='$bnurl',
				bn_height='$height',
				bn_width='100',
				bn_exdate='$datepicker',
				bn_dispcount='$bncount',
				bn_type ='wanted',
				bn_numberofcount ='$bn_countnumber',
				bn_parentid='$txtbnid',
				bn_desc='$content'";}
	if (!($result = mysqli_query($connection,$query))) { echo $query.mysqli_errno($connection);  exit;}
	$txtid=mysqli_insert_id($connection);	

	if($_FILES["bnimage"]["name"]!="") 
	{
		 
			 $fileload = $_FILES["bnimage"]["name"];
			 $file_ext = explode(".",$fileload);
			 $myattach="bannerwanted_".$txtid.".".$file_ext[1];
			 $destpath="../../possbpser/".$myattach;
			 
			 copy($_FILES["bnimage"]["tmp_name"],$destpath) or die("Unable to upload file1");

			 $updatecategory="UPDATE c_banner SET  bn_image = '".$myattach."' WHERE  bn_id  =".$txtid; 
			 if(!($result = mysqli_query($connection,$updatecategory))){echo $updatecategory.mysqli_errno($connection);exit;} 
	}
	$redirect = "location:bannerlist.php?nomatch=2&bnid=$txtbnid&msg=add";
	header("$redirect");
	exit;
}
?>