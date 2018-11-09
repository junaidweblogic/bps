<?php 
include("../../common/app_function.php");
include("../../common/cploconfig.php");

	$content=addslashes($linkcontect);
	$name=addslashes($_POST[event]);
	$dou = dateformate($_POST[datepicker]); 
	$today = date("Y-m-d");
	$time=date("H:i:s");
	$id=$_REQUEST[pid];
	
if($dou != $today && $dou < $today)
	//$dou = $today;
	
if($mode== "del")
{
	$id= $_REQUEST[id];
	$qchk2=sprintf("SELECT * FROM ".$tblpref."content_master WHERE cms_id='%d'", $pid);
	if(!($resqchk2=mysqli_query($connection,$qchk2))){ echo "FOR QUERY: $qchk2<BR>".mysqli_errno($connection); exit;}
	$row2=mysqli_fetch_array($resqchk2);
	$title = stripslashes($row2[cms_title]);

	log_entry("Event",$title,"Deleted", $tblpref,  $db, $row_admin[admin_id],$ip);


	$query=sprintf("DELETE FROM ".$tblpref."content_master WHERE cms_id='%d'", $pid);
	if(!($result=mysqli_query($connection,$query))){echo "Query:- " . $query . "<br />Error :- " . mysqli_errno($connection); exit;}
	 $filepath = "../../possbpser/".$fn;
	@unlink($filepath);
	
	header("Location:index.php?flag=del");
	exit;
}

if($_FILES["fileeventimage"]["name"]!=""){		
	$imgs=$_FILES["fileeventimage"]["type"];
	$imgs=explode("/", $imgs);
	$imgs=$imgs[0];
	if($imgs != "image")
	{
		header("Location:event_add.php?flag=noimg&pid=$_POST[pid]");
		exit;	
	}			
}

if($_FILES["fileeventdoc"]["name"]!="") {	
	$doc=$_FILES["fileeventdoc"]["type"];
	$doc=explode("/", $doc);
	$doc=$doc[0];
	
	if($doc != 'application')
	{
		//header("Location:event_add.php?flag=nodoc&pid=$_POST[pid]");
		exit;	
	}
}			
	if ($_POST[pid] != 0)
	{
$update=sprintf("update ".$tblpref."content_master set
	cms_title ='%s',
	cms_subdate='$dou',
	cms_desc  ='%s',
	cms_file1='%s',
	cms_date='$today',
	cms_time='$time',
	cms_type='Event'
	where cms_id='$_POST[pid]'", $name, $content, $imf);
	if(!($result=mysqli_query($connection,$update))){echo "Query:- " . $update . "<br />Error :- " . mysqli_errno($connection); exit;}

	log_entry("Event",$name,"Added", $tblpref,  $db, $row_admin[admin_id],$ip);

	if($_FILES["fileeventimage"]["name"]!="") 
	{
		 $fileload = $_FILES["fileeventimage"]["name"];
		 $file_ext = explode(".",$fileload);
		 $myattach="event_".$_POST[pid].".".$file_ext[1];
		 $destpath="../../possbpser/".$myattach;
		 
		 copy($_FILES["fileeventimage"]["tmp_name"],$destpath) or die("Unable to upload file");
	
		 $updatecategory=sprintf("UPDATE ".$tblpref."content_master SET cms_file ='%s' WHERE cms_id='%d'", $myattach, $_POST[pid]);
		 if(!($result = mysqli_query($connection,$updatecategory))){echo "Query:- " . $updatecategory . "<br />Error :- " . mysqli_errno($connection); exit;}
	}
	if($_FILES["fileeventdoc"]["name"]!="") 
	{
		 $fileload = $_FILES["fileeventdoc"]["name"];
		 $file_ext = explode(".",$fileload);
		 $myattach="event_".$_POST[pid].".".$file_ext[1];
		 $destpath="../../possbpser/".$myattach;
		 
		 copy($_FILES["fileeventdoc"]["tmp_name"],$destpath) or die("Unable to upload doc file");
	
		 $updatecategory=sprintf("UPDATE ".$tblpref."content_master SET cms_file1 ='%s' WHERE cms_id='%d'", $myattach, $_POST[pid]);
		 if(!($result = mysqli_query($connection,$updatecategory))){echo "Query:- " . $updatecategory . "<br />Error :- " . mysqli_errno($connection); exit;}
	}
			
		
			header("Location:index.php?flag=edit");
			exit;	
				
	}
	else 
	{
		 $add =sprintf("INSERT INTO ".$tblpref."content_master SET
		cms_title ='%s',
		cms_subdate='$dou',
		cms_desc  ='%s',
		cms_date='$today',
		cms_time='$time',
		cms_type='Event'", $name, $content);
		if(!($res=mysqli_query($connection,$add))){echo "Query:- " . $res . "<br />Error :- " . mysqli_errno($connection); exit;}
		
		log_entry("Event",$name,"Edited", $tblpref,  $db, $row_admin[admin_id],$ip);

		$id = mysqli_insert_id($connection);
		if($_FILES["fileeventimage"]["name"]!="") 
		{
			 $fileload = $_FILES["fileeventimage"]["name"];
			 $file_ext = explode(".",$fileload);
			 $myattach="event_".$id.".".$file_ext[1];
			 $destpath="../../possbpser/".$myattach;
			 copy($_FILES["fileeventimage"]["tmp_name"],$destpath) or die("Unable to upload doc file");
			 $updatecategory=sprintf("UPDATE ".$tblpref."content_master SET cms_file ='%s' WHERE cms_id ='%d'", $myattach, $id); 
			 if(!($result = mysqli_query($connection,$updatecategory))){echo $updatecategory.mysqli_errno($connection);exit;}
		}
		if($_FILES["fileeventdoc"]["name"]!="") 
		{
			 $fileload = $_FILES["fileeventdoc"]["name"];
			 $file_ext = explode(".",$fileload);
			 $myattach="event_".$id.".".$file_ext[1];
			 $destpath="../../possbpser/".$myattach;
			 copy($_FILES["fileeventimage"]["tmp_name"],$destpath) or die("Unable to upload doc file");
			 $updatecategory=sprintf("UPDATE ".$tblpref."content_master SET cms_file1 ='%s' WHERE cms_id ='%d'", $myattach, $id); 
			 if(!($result = mysqli_query($connection,$updatecategory))){echo $updatecategory.mysqli_errno($connection);exit;}
		}
		header("Location:index.php?flag=add");
	}   
?>			
					