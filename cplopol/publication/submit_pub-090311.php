<?php 
include("../../common/cploconfig.php");
include("../../common/app_function.php");

$content=addslashes($linkcontect);
$pub_name=addslashes($pub_name);
$author=addslashes($author);
$curdate=date("Y-m-d");

if($mode=="del")
	{
		$query="Delete from ".$tblpref."content_master where cms_id='$puid'";
		if(!($result=mysqli_query($connection,$query))){echo $query.mysqli_errno($connection); exit;}
		$filepath = "../../possbpser/". $fn;
		@unlink($filepath);
		$filepath1 = "../../possbpser/". $fn1;
		@unlink($filepath1);
		
		header("Location:index.php?flag=del");
		exit;
	}

if($puid=="")
	{      
			$qchk="SELECT * FROM ".$tblpref."content_master WHERE cms_title='".$pub_name."' AND cms_type='publication'";
			if(!($resqchk=mysqli_query($connection,$qchk))){ echo "FOR QUERY: $qchk<BR>".mysqli_errno($connection); exit;}
			$rowcount=mysqli_num_rows($resqchk);
		   if($rowcount>0)
	   {
	   

	       header("location:pub_add.php?flag=exists&mode=add");
	       exit;
	   }else{
	   
			$qadd="INSERT INTO ".$tblpref."content_master set 
			cms_title='$pub_name',
			cms_subtype ='$pub_cat',
			cms_type='publication',
			cms_date='$curdate',
			cms_desc ='$linkcontect',
			cms_page_title 	='$author'";	

			if(!($res=mysqli_query($connection,$qadd))){echo $qadd.mysqli_errno($connection); exit;}
			$id = mysqli_insert_id($connection);
			
			if($_FILES["upload"]["name"]!="") 
			{
				 $fileload = $_FILES["upload"]["name"];
				 $file_ext = explode(".",$fileload);
				 $myattach="publication_".$id.".".$file_ext[1];
				 $destpath="../../tmposs/".$myattach;
				 
				 copy($_FILES["upload"]["tmp_name"],$destpath) or die("Unable to upload doc file");
			
				 $updatepicture = "UPDATE ".$tblpref."content_master SET cms_file ='".$myattach."' WHERE cms_id =".$id;
				
				 if(!($result = mysqli_query($connection,$updatepicture))){echo $updatepicture.mysqli_errno($connection);exit;}
				
			}
			if($_FILES["upload1"]["name"]!="") 
			{
				$fileload = $_FILES["upload1"]["name"];
				 $file_ext = explode(".",$fileload);
				 $myattach="publication_doc_".$id.".".$file_ext[1];
				 if ($file_ext[1] =="pdf" )
						{
			 $destpath="../../tmposs/".$myattach;
				 
				 copy($_FILES["upload1"]["tmp_name"],$destpath) or die("Unable to upload doc file");
			
				 $updatepicture="UPDATE ".$tblpref."content_master SET cms_file1 ='".$myattach."' WHERE cms_id =".$id; 
				 if(!($result = mysqli_query($connection,$updatepicture))){echo $updatepicture.mysqli_errno($connection);exit;}}
				 else{
					header("Location:pub_add.php?flag=type");
			        exit;

				    }
			}
			header("Location:index.php?flag=add");
			exit;}
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
			cms_type='publication',
			cms_date='$curdate',
			cms_page_title 	='$author'
			WHERE cms_id='$puid'";
		
			if(!($result=mysqli_query($connection,$query_update))){echo $query_update.mysqli_errno($connection); exit;}
		
			if($_FILES["upload"]["name"]!="") 
			{
				 $fileload = $_FILES["upload"]["name"]; 
				 $file_ext = explode(".",$fileload);
				 $myattach="publication_".$puid.".".$file_ext[1];
				 $destpath="../../tmposs/".$myattach;
				 
				 copy($_FILES["upload"]["tmp_name"],$destpath) or die("Unable to upload doc file");
			
				 $updatepicture="UPDATE ".$tblpref."content_master SET cms_file ='".$myattach."' WHERE cms_id =".$puid; 
				 if(!($result = mysqli_query($connection,$updatepicture))){echo $updatepicture.mysqli_errno($connection);exit;}
			}
			if($_FILES["upload1"]["name"]!="") 
			{
				 	 $fileload = $_FILES["upload1"]["name"];
				$file_ext = explode(".",$fileload);
				$myattach="publication_doc_".$puid.".".$file_ext[1];
				 if ($file_ext[1] == "pdf" )
						{
				$destpath="../../tmposs/".$myattach;
				 
				 copy($_FILES["upload1"]["tmp_name"],$destpath) or die("Unable to upload doc file");
			
				 $updatepicture="UPDATE ".$tblpref."content_master SET cms_file1 ='".$myattach."' WHERE cms_id =".$puid; 
				 if(!($result = mysqli_query($connection,$updatepicture))){echo $updatepicture.mysqli_errno($connection);exit;}
				 }
				 else{
					header("Location:pub_add.php?flag=type&puid=$puid");
			        exit;

				    }
			}
			header("Location:index.php?flag=edit");
			exit;}
	}?>