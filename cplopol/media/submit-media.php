<?php 
session_start();

include("../../common/cploconfig.php");
include("../../common/app_function.php");
$media=$_REQUEST[med_type];
$maxsize=15*1024*1024;

if($_FILES["produ_image"]["name"]!="")
{	
	$fname=$_FILES["produ_image"]["name"];
	
	$filext = strrchr($fname, '.'); 
	$filext=explode(".",$filext);
	$ext=$filext[1];
	
	if($media=="p") {  //JPEG, JPG, PNG, GIF, PDF
	    if($ext=='jpeg' || $ext=='jpg' || $ext=='png' || $ext=='gif' || $ext=='pdf' || $ext=='doc' || $ext=='docx' || $ext=='xls' || $ext=='xlsx') {
		 // echo list($width, $height) =  getimagesize($fname);exit;
	    }
		else {
		  header("Location:media-add.php?flag=print");
		  exit;
	  }
  }

  if($media=='a') { //WMA & WAV 
 
	 if($ext=='wma'||$ext=='wav'||$ext=='mp3') {

	
	 	if($_FILES["produ_image"]["size"]> $maxsize) {
			header("Location:media-add.php?flag=filesize");
			exit;
	     }
	 }
	  else{
		  header("Location:media-add.php?flag=audio");
		  exit;

	  }
  }
  if($media=='v')
	{
	  //MPEG , MPG, AVI
	
	  if($ext=='mpeg'||$ext=='mpg'||$ext=='avi')
		{    
	     if($_FILES["produ_image"]["size"]> $maxsize)
	     {
			header("Location:media-add.php?flag=filesize");
			exit;
	     }}
		 else{
		  header("Location:media-add.php?flag=video");
		  exit;

	  }
  }
 
  if($media=='n')
	{
	  //PDF, DOC
	  if($ext=='pdf'||$ext=='doc'||$ext=='docx')
	{  
	     if($_FILES["produ_image"]["size"]> $maxsize)
	     {
			header("Location:media-add.php?flag=filesize");
			exit;
	     }}
		 else{
		  header("Location:media-add.php?flag=newsletter");
		  exit;

	  }
  }} 

$today = date("y-m-d");

$brand = $_REQUEST[txtbrand];  
$product = $_REQUEST[txtproduct]; 

$today = date("y-m-d");

 $mid = $_POST[medid]; 


//$ten_type = addslashes($_POST[ten_type]);
$med_name= addslashes($_POST[med_name]);
$dou = dateformate($_POST[datepicker]);
$desc =addslashes($_POST[comment]);

if($chkarchieve!=""){$chkarc="yes";}else{$chkarc="no";}

	if ($mode == 'delete')
	{
			$del_id = $_GET[del_id];
			$qdel = "delete from ".$tblpref."content_master  where cms_id = $del_id";
			if(!($res=mysqli_query($connection,$qdel))){echo $qdel.mysqli_errno($connection); exit;}
			$filepath = "../../possbpser/".$fn;
		    @unlink($filepath);
			header("Location:index.php?flag=delete");
			exit();
	}
	
	if($mid=="") {        
			$qchk="SELECT * FROM ".$tblpref."content_master WHERE cms_title='".$med_name."' AND cms_type='media'";
			if(!($resqchk=mysqli_query($connection,$qchk))){ echo "FOR QUERY: $query<BR>".mysqli_errno($connection); exit;}
			$rowcount=mysqli_num_rows($resqchk);
		    if($rowcount>0)  {
			   header("location:media-add.php?flag=exists&mode=add");
			   exit;
			   }else{
					$qadd="INSERT INTO ".$tblpref."content_master set 
					cms_title='$med_name',
					cms_desc='$desc',
					cms_date='$dou',
					cms_type='media',
					cms_featured='$chkshow',
					cms_subtype ='$tencat'"; 
		
					if(!($res=mysqli_query($connection,$qadd))){echo $qadd.mysqli_errno($connection); exit;}
		
					$ins_id=mysqli_insert_id($connection);
		
					if ($_FILES["produ_image"]["name"]!="")
					{
						$fileload = $_FILES["produ_image"]["name"];
						
		
						
						$file_ext = explode(".",$fileload);//----------with txtprod_f option/ we get extension.jpg --
						$file_ext = $file_ext[1];
						
						$newfilename = "mediac-".$med_name.".".$file_ext;
						$destpath="../../possbpser/".$newfilename;
						copy($_FILES["produ_image"] ["tmp_name"],$destpath) or die("Unable to upload file");
					  $updateproduct="UPDATE ".$tblpref."content_master  SET
											cms_file ='$newfilename'
										 WHERE cms_id  ='$ins_id'"; 
						if(!($result = mysqli_query($connection,$updateproduct))){echo $InsertCategory.mysqli_errno($connection);exit;}
						
					}
				 
					header("Location:index.php?flag=add");
					exit;
		}
	}

	if($mid!="" && $mode != 'delete')
	{
		   $qselect="SELECT * FROM ".$tblpref."content_master WHERE cms_id='$mid'";
		 if(!($resqsel=mysqli_query($connection, $qselect))){echo  $qselect.mysqli_errno($connection); exit;}
		 $row=mysqli_fetch_array($resqsel);		  
		 $qchk="SELECT * FROM ".$tblpref."content_master WHERE cms_title!='$row[cms_title]'AND cms_title='$med_name' ";
			if(!($resqchk=mysqli_query($connection,$qchk))){ echo "FOR QUERY: $query<BR>".mysqli_errno($connection); exit;}
			$rowcount=mysqli_num_rows($resqchk);
		   if($rowcount>0)
	   {
	       header("location:media-add.php?flag=exists&mid=$mid");
	       exit;
	   }else{

			$qedit="UPDATE ".$tblpref."content_master  SET 
			cms_title='$med_name',
			cms_desc='$desc',
			cms_date='$dou',
			cms_type='media',
			cms_featured='$chkshow',
			cms_subtype ='$tencat'
			WHERE cms_id = '$mid'"; 
			if(!($res=mysqli_query($connection,$qedit))){echo $qedit.mysqli_errno($connection); exit;}


			if ($_FILES["produ_image"]["name"]!="")
			{
				$fileload = $_FILES["produ_image"]["name"];
				$file_ext = explode(".",$fileload);//----------with txtprod_f option/ we get extension.jpg --
				$file_ext = $file_ext[1];
				
				$newfilename = "mediac-".$med_name.".".$file_ext;
				$destpath="../../possbpser/".$newfilename;
				copy($_FILES["produ_image"] ["tmp_name"],$destpath) or die("Unable to upload file");

				 $updateproduct="UPDATE ".$tblpref."content_master  SET
								cms_file  ='$newfilename'
								 WHERE cms_id  ='$mid'";
				if(!($result = mysqli_query($connection,$updateproduct))){echo $InsertCategory.mysqli_errno($connection);exit;}
				
			}
		
			header("Location:index.php?flag=update");
			exit;}
	}?>