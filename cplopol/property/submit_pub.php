<?php 
include("../../common/cploconfig.php");
include("../../common/app_function.php");

$content=addslashes($linkcontect);
$pub_name=addslashes($pub_name);

$curdate=date("Y-m-d");

$datepicker = dateformate($datepicker);

if($mode=="del")
	{
		$qchk2=sprintf("SELECT * FROM ".$tblpref."content_master WHERE cms_id='%d'", $puid);
	if(!($resqchk2=mysqli_query($connection,$qchk2))){ echo "FOR QUERY: $qchk2<BR>".mysqli_errno($connection); exit;}
	$row2=mysqli_fetch_array($resqchk2);
	$title = stripslashes($row2[cms_title]);

	log_entry("Property",$title,"Deleted", $tblpref,  $db, $row_admin[admin_id],$ip);

		$query="Delete from ".$tblpref."content_master where cms_id='$puid'";
		if(!($result=mysqli_query($connection,$query))){echo mysqli_error($query); exit;}
		$filepath = "../../possbpser/". $fn;
		@unlink($filepath);
		$filepath1 = "../../possbpser/". $fn1;
		@unlink($filepath1);
		
		header("Location:index.php?flag=del");
		exit;
	}

if($puid=="")
	{      
			$qchk="SELECT * FROM ".$tblpref."content_master WHERE cms_title='".$pub_name."' AND cms_type='property'";
			if(!($resqchk=mysqli_query($connection,$qchk))){ echo "FOR QUERY: $qchk<BR>".mysqli_errno($connection); exit;}
			$rowcount=mysqli_num_rows($resqchk);
		   if($rowcount>0)
		   {
		   

			   header("location:pub_add.php?flag=exists&mode=add");
			   exit;
		   }
		   else{
	   
			$qadd="INSERT INTO ".$tblpref."content_master set 
			cms_title='$pub_name',
			cms_subtype ='$pub_cat',
			cms_type='property',
			cms_date='$curdate',
			cms_desc ='$linkcontect',
			cms_subdate	='$datepicker'";	

			if(!($res=mysqli_query($connection,$qadd))){echo $qadd.mysqli_errno($connection); exit;}
			$id = mysqli_insert_id($connection);
			
			if($_FILES["upload"]["name"]!="") 
			{
				 $fileload = $_FILES["upload"]["name"];
				 $file_ext = explode(".",$fileload);
				 $myattach="sub_".$id.".".$file_ext[1];
				 $destpath="../../possbpser/".$myattach;
				 
				 copy($_FILES["upload"]["tmp_name"],$destpath) or die("Unable to upload doc file");
			
				 $updatepicture = "UPDATE ".$tblpref."content_master SET cms_file ='".$myattach."' WHERE cms_id =".$id;
				
				 if(!($result = mysqli_query($connection,$updatepicture))){echo $updatepicture.mysqli_errno($connection);exit;}
				
			}
			
			log_entry("Property",$title,"Added", $tblpref,  $db, $row_admin[admin_id],$ip);

			header("Location:index.php?flag=add");
			exit;
		   }
	}


if($puid!="")
	{       
		$qselect="SELECT * FROM ".$tblpref."content_master WHERE cms_id='$puid'";
		 if(!($resqsel=mysqli_query($connection, $qselect))){echo  $qselect.mysqli_errno($connection); exit;}
		 $row=mysqli_fetch_array($resqsel);		  
		 $qchk="SELECT * FROM ".$tblpref."content_master WHERE cms_title!='$row[cms_title]'AND cms_title='$pub_name' ";
			if(!($resqchk=mysqli_query($connection,$qchk))){ echo "FOR QUERY: $query<BR>".mysqli_errno($connection); exit;}
			$rowcount=mysqli_num_rows($resqchk);
		   if($rowcount>0)
	   {
	       header("location:pub_add.php?flag=exists&puid=$puid");
	       exit;
	   }else{

			$query_update="UPDATE ".$tblpref."content_master set 
			cms_title='$pub_name',
			cms_subtype ='$pub_cat',
			cms_desc ='$linkcontect',
			cms_type='property',
			cms_date='$curdate',
			cms_subdate	='$datepicker'
			WHERE cms_id='$puid'";
		
			if(!($result=mysqli_query($connection,$query_update))){echo $query_update.mysqli_errno($connection); exit;}
		
			if($_FILES["upload"]["name"]!="") 
			{
				 $fileload = $_FILES["upload"]["name"]; 
				 $file_ext = explode(".",$fileload);
				 $myattach="sub_".$puid.".".$file_ext[1];
				 $destpath="../../possbpser/".$myattach;
				 
				 copy($_FILES["upload"]["tmp_name"],$destpath) or die("Unable to upload doc file");
			
				 $updatepicture="UPDATE ".$tblpref."content_master SET cms_file ='".$myattach."' WHERE cms_id =".$puid; 
				 if(!($result = mysqli_query($connection,$updatepicture))){echo $updatepicture.mysqli_errno($connection);exit;}
			}
			
			log_entry("Property",$title,"Edited", $tblpref,  $db, $row_admin[admin_id],$ip);

			header("Location:index.php?flag=edit");
			exit;}
	}?>