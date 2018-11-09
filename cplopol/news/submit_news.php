<?php 
include("../../common/app_function.php");
include("../../common/cploconfig.php");
$content=addslashes($linkcontect);
$name=addslashes($name);
$dou = dateformate($_POST[datepicker]);
$today = date("y-m-d ");
$time=date("H:i:s");
$id=$_REQUEST[id];


	if($_FILES["filenewsimage"]["name"]!="") {
		 $fileload = $_FILES["filenewsimage"]["name"];
		 $destpath="../../possbpser/".$fileload;
		 copy($_FILES["filenewsimage"]["tmp_name"],$destpath) or die("Unable to upload file1");
		 list($width, $height) = getimagesize("../../possbpser/".$fileload);
		 @unlink("../../possbpser/".$fileload);
		 
	}

	if($_FILES["filenewsimage"]["name"]!="")
	{
		if($_FILES["filenewsimage"]["size"]>"2097152")
		{
			header("Location:news_add.php?flag=filesize&nid=$nid");
			exit;
		}
	}
	
	if($chkshow=="on")
	{
		$chkshow1="yes";
	}
	else
	{
		$chkshow1="no";
	}
	if($chkarchieve=="1")
	{
		$chkarchieve1="yes";
	}
	else
	{
		$chkarchieve1="no";
	}

	if($mode=="del")
	{
		$qchk2=sprintf("SELECT * FROM ".$tblpref."content_master WHERE cms_id='%d'", $nid);
	if(!($resqchk2=mysqli_query($connection,$qchk2))){ echo "FOR QUERY: $qchk2<BR>".mysqli_errno($connection); exit;}
	$row2=mysqli_fetch_array($resqchk2);
	$title = stripslashes($row2[cms_title]);

	log_entry("News",$title,"Deleted", $tblpref,  $db, $row_admin[admin_id],$ip);


		$query="DELETE FROM ".$tblpref."content_master WHERE cms_id='$nid'";
		if(!($result=mysqli_query($connection,$query))){echo $query.mysqli_errno($connection); exit;}
		 $filepath = "../../possbpser/".$fn;
		@unlink($filepath);
		
		header("Location:index.php?flag=del");
		exit;
	}
	if($nid=="")
	{
			$qchk="SELECT * FROM ".$tblpref."content_master WHERE cms_title='".$name."' AND cms_type='news'";
			if(!($resqchk=mysqli_query($connection,$qchk))){ echo "FOR QUERY: $query<BR>".mysqli_errno($connection); exit;}
			$rowcount=mysqli_num_rows($resqchk);
		   if($rowcount>0)
	   {
	       header("location:news_add.php?flag=exists&mode=add");
	       exit;
	   }else{
			$qadd="INSERT INTO ".$tblpref."content_master SET 
			cms_title='$name',
			cms_archived='$chkarchieve1',
			cms_date='$today',
			cms_type='news',
			cms_time='$time',
			cms_desc='$content',
			cms_featured='$chkshow1'";
		
			if(!($res=mysqli_query($connection,$qadd))){echo $qadd.mysqli_errno($connection); exit;}
			$id = mysqli_insert_id($connection);
			if($_FILES["filenewsimage"]["name"]!="") 
			{
				 $fileload = $_FILES["filenewsimage"]["name"];
				 $file_ext = explode(".",$fileload);
				 $myattach="news_".$id.".".$file_ext[1];
				 $destpath="../../possbpser/".$myattach;
				 
				 copy($_FILES["filenewsimage"]["tmp_name"],$destpath) or die("Unable to upload doc file");
			
				 $updatecategory="UPDATE ".$tblpref."content_master SET cms_file ='".$myattach."' WHERE cms_id =".$id; 
				 if(!($result = mysqli_query($connection,$updatecategory))){echo $updatecategory.mysqli_errno($connection);exit;}
			}
			log_entry("News",$name,"Added", $tblpref,  $db, $row_admin[admin_id],$ip);
					
			header("Location:index.php?flag=add");
			exit;}	
	}
if($nid!="")
	{
		 $qselect="SELECT * FROM ".$tblpref."content_master WHERE cms_id='$nid'";
		 if(!($resqsel=mysqli_query($connection, $qselect))){echo  $qselect.mysqli_errno($connection); exit;}
		 $row=mysqli_fetch_array($resqsel);		  
		 $qchk="SELECT * FROM ".$tblpref."content_master WHERE cms_title!='$row[cms_title]'AND cms_title='$name' ";
			if(!($resqchk=mysqli_query($connection,$qchk))){ echo "FOR QUERY: $query<BR>".mysqli_errno($connection); exit;}
			$rowcount=mysqli_num_rows($resqchk);
		   if($rowcount>0)
	   {
	       header("location:news_add.php?flag=exists&nid=$nid");
	       exit;
	   }else{
          
			$query_update="UPDATE ".$tblpref."content_master SET 
			cms_title='$name',
			cms_archived='$chkarchieve1',
			cms_date='$today',
			cms_type='news',
			cms_desc='$content',
			cms_time='$time',
			cms_featured='$chkshow1'
			WHERE cms_id='$nid'";
			
			if(!($result=mysqli_query($connection,$query_update))){echo $query_update.mysqli_errno($connection); exit;}
			if($_FILES["filenewsimage"]["name"]!="") 
					{
						 $fileload = $_FILES["filenewsimage"]["name"];
						 $file_ext = explode(".",$fileload);
						 $myattach="news_".$nid.".".$file_ext[1];
						 $destpath="../../possbpser/".$myattach;
						 
						 copy($_FILES["filenewsimage"]["tmp_name"],$destpath) or die("Unable to upload doc file");
					
						 $updatecategory="UPDATE ".$tblpref."content_master SET cms_file ='".$myattach."' WHERE cms_id =".$nid; 
						 if(!($result = mysqli_query($connection,$updatecategory))){echo $updatecategory.mysqli_errno($connection);exit;}
					}
			log_entry("News",$name,"Edited", $tblpref,  $db, $row_admin[admin_id],$ip);
			header("Location:index.php?flag=edit");
			exit;	}
	}
?>