<?php 
include("../../common/cploconfig.php");
include("../../common/app_function.php");

$content=addslashes($_REQUEST[linkcontect]);
$pub_name=addslashes($_REQUEST[pub_name]);
$author=addslashes($_REQUEST[author]);
$curdate=date("Y-m-d");
$puid = $_REQUEST['puid'];

if($_REQUEST[mode]=="del")
	{
		$qchk2=sprintf("SELECT * FROM ".$tblpref."content_master WHERE cms_id='%d'", $puid);
	if(!($resqchk2=mysqli_query($connection,$qchk2))){ echo "FOR QUERY: $qchk2<BR>".mysqli_errno($connection); exit;}
	$row2=mysqli_fetch_array($resqchk2);
	$title = stripslashes($row2[cms_title]);

		log_entry("Publication",$title,"Deleted", $tblpref,  $db, $row_admin[admin_id],$ip);

		$query="Delete from ".$tblpref."content_master where cms_id='$puid'";
		if(!($result=mysqli_query($connection,$query))){echo mysqli_error($query); exit;}
		$filepath = "../../possbpser/". $fn;
		@unlink($filepath);
		$filepath1 = "../../possbpser/". $fn1;
		@unlink($filepath1);
		
		header("Location:index.php?flag=del");
		exit;
	}
//echo $puid;
if($puid=="")
	{      
			$qchk="SELECT * FROM ".$tblpref."content_master WHERE cms_title='".$pub_name."' AND cms_type='publication'";
			if(!($resqchk=mysqli_query($connection,$qchk))){ echo "FOR QUERY: $qchk<BR>".mysqli_errno($connection); exit;}
			$rowcount=mysqli_num_rows($resqchk);
			if($rowcount>0)
			{
	   	       header("location:pub_add.php?flag=exists&mode=add");
			   exit;
			}
			else
			{

			   if($_FILES["upload"]["name"]=="" && $_FILES["upload1"]["name"]=="")
			   {
					$qadd="INSERT INTO ".$tblpref."content_master set 
					cms_title='$pub_name',
					cms_subtype ='$pub_cat',
					cms_type='publication',
					cms_date='$curdate',
					cms_desc ='$linkcontect',
					cms_page_title 	='$author'";	

					if(!($res=mysqli_query($connection,$qadd))){echo $qadd.mysqli_errno($connection); exit;}
					$id = mysqli_insert_id($connection);
					log_entry("Publication",$pub_name,"Added", $tblpref,  $db, $row_admin[admin_id],$ip);

					header("Location:index.php?flag=add");
					exit;
			   }
			   if($_FILES["upload"]["name"]!="" || $_FILES["upload1"]["name"]!="")
			   {
					

					
					
					if($_FILES["upload"]["name"]!="")
					{
						$fileload = $_FILES["upload"]["type"];
						$file_ext = explode("/",$fileload);
						if($file_ext[0]!="image")
						{?>
							<body onload="document.frm.submit();">
								<form name="frm" action="pub_add.php?flag=type" method="post">
									<input type="hidden" name="pub_name" value="<?=$pub_name?>">
									<input type="hidden" name="pub_cat" value="<?=$pub_cat?>">
									<input type="hidden" name="publication" value="publication">
									<input type="hidden" name="linkcontect" value="<?=$linkcontect?>">
									<input type="hidden" name="author" value="<?=$author?>">
								</form>
							</body>
							
					<?	}
					}

					if($_FILES["upload1"]["name"]!="")
					{
						$fileload1 = $_FILES["upload1"]["type"];
						$file_ext1 = explode("/",$fileload1);
						if($file_ext1[0]!="application")
						{
							?>
							<body onload="document.frm.submit();">
								<form name="frm" action="pub_add.php?flag=type" method="post">
									<input type="hidden" name="pub_name" value="<?=$pub_name?>">
									<input type="hidden" name="pub_cat" value="<?=$pub_cat?>">
									<input type="hidden" name="publication" value="publication">
									<input type="hidden" name="linkcontect" value="<?=$linkcontect?>">
									<input type="hidden" name="author" value="<?=$author?>">
								</form>
							</body>
							
					<?	}
					}
					if($file_ext[0]=="image" || $file_ext1[0]=="application")
					{
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
							$myattach="publication_".$id.".".$file_ext[1];
							$destpath="../../possbpser/".$myattach;
					 
							copy($_FILES["upload"]["tmp_name"],$destpath) or die("Unable to upload doc file");
				
							$updatepicture = "UPDATE ".$tblpref."content_master SET cms_file ='".$myattach."' WHERE cms_id =".$id;
					
							if(!($result = mysqli_query($connection,$updatepicture))){echo $updatepicture.mysqli_errno($connection);exit;}
						}
						
						if($_FILES["upload1"]["name"]!="")
						{
							$myattach1="publication_doc_".$id.".".$file_ext1[1];
							$destpath1="../../possbpser/".$myattach1;
					 
							copy($_FILES["upload1"]["tmp_name"],$destpath1) or die("Unable to upload doc file");
				
							$updatepicture1="UPDATE ".$tblpref."content_master SET cms_file1 ='".$myattach1."' WHERE cms_id =".$id; 
							if(!($result1 = mysqli_query($connection,$updatepicture1)))
							{
								echo $updatepicture1.mysqli_errno($connection);exit;
							}
						}
						log_entry("Publication",$pub_name,"Added", $tblpref,  $db, $row_admin[admin_id],$ip);
						header("Location:index.php?flag=add");
						exit;
					}
			   }
		   	   
	   
			/*$qadd="INSERT INTO ".$tblpref."content_master set 
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
			exit;*/
		}
	}


if($puid!="")
	{       
		
		$qselect="SELECT * FROM ".$tblpref."content_master WHERE cms_id='$puid'";
		if(!($resqsel=mysqli_query($connection, $qselect))){echo  $qselect.mysqli_errno($connection); exit;}
		$row=mysqli_fetch_array($resqsel);		  
		
		$qchk="SELECT * FROM ".$tblpref."content_master WHERE cms_title!='$row[cms_title]' AND cms_title='$pub_name' and cms_id!='$puid'";
		if(!($resqchk=mysqli_query($connection,$qchk))){ echo "FOR QUERY: $query<BR>".mysqli_errno($connection); exit;}
		$rowcount=mysqli_num_rows($resqchk);
		if($rowcount>0)
		{
			header("location:pub_add.php?flag=exists&puid=$puid");
			exit;
		}
		else
		{
			if($_FILES["upload"]["name"]=="" && $_FILES["upload1"]["name"]=="")
			{
				$query_update="UPDATE ".$tblpref."content_master set 
				cms_title='$pub_name',
				cms_subtype ='$pub_cat',
				cms_desc ='$linkcontect',
				cms_type='publication',
				cms_date='$curdate',
				cms_page_title 	='$author'
				WHERE cms_id='$puid'";
			
				log_entry("Publication",$pub_name,"Edited", $tblpref,  $db, $row_admin[admin_id],$ip);

				if(!($result=mysqli_query($connection,$query_update))){echo $query_update.mysqli_errno($connection); exit;}
				header("Location:index.php?flag=edit");
				exit;
			}
			if($_FILES["upload"]["name"]!="" || $_FILES["upload1"]["name"]!="")
			{
									
					
					if($_FILES["upload"]["name"]!="")
					{
						$fileload = $_FILES["upload"]["type"];
						$file_ext = explode("/",$fileload);
						//print_r($file_ext);
						//echo $file_ext[0];exit;
						if($file_ext[0]!="image")
						{?>
							<body onload="document.frm.submit();">
								<form name="frm" action="pub_add.php?flag=type" method="post">
									<input type="hidden" name="pub_name" value="<?=$pub_name?>">
									<input type="hidden" name="pub_cat" value="<?=$pub_cat?>">
									<input type="hidden" name="publication" value="publication">
									<input type="hidden" name="linkcontect" value="<?=$linkcontect?>">
									<input type="hidden" name="author" value="<?=$author?>">
								</form>
							</body>
							
					<?	}
					}

					if($_FILES["upload1"]["name"]!="")
					{
						 $fileload1 = $_FILES["upload1"]["type"];
						$file_ext1 = explode("/",$fileload1);
						//echo $file_ext1[0];exit;
						if($file_ext1[0]!="application")
						{
							?>
							<body onload="document.frm.submit();">
								<form name="frm" action="pub_add.php?flag=type" method="post">
									<input type="hidden" name="pub_name" value="<?=$pub_name?>">
									<input type="hidden" name="pub_cat" value="<?=$pub_cat?>">
									<input type="hidden" name="publication" value="publication">
									<input type="hidden" name="linkcontect" value="<?=$linkcontect?>">
									<input type="hidden" name="author" value="<?=$author?>">
								</form>
							</body>
							
					<?	}
					}
					if($file_ext[0]=="image" || $file_ext1[0]=="application")
					{
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
							$myattach="publication_".$puid.".".$file_ext[1];
							$destpath="../../possbpser/".$myattach;
				 
							copy($_FILES["upload"]["tmp_name"],$destpath) or die("Unable to upload doc file");
			
							$updatepicture="UPDATE ".$tblpref."content_master SET cms_file ='".$myattach."' WHERE cms_id =".$puid; 
							if(!($result = mysqli_query($connection,$updatepicture))){echo $updatepicture.mysqli_errno($connection);exit;}
						}
						if($_FILES["upload1"]["name"]!="")
						{
							$myattach1="publication_doc_".$puid.".".$file_ext1[1];
							$destpath1="../../possbpser/".$myattach1;
				 
							copy($_FILES["upload1"]["tmp_name"],$destpath1) or die("Unable to upload doc file");
			
							$updatepicture1="UPDATE ".$tblpref."content_master SET cms_file1 ='".$myattach1."' WHERE cms_id =".$puid; 
							if(!($result1 = mysqli_query($connection,$updatepicture1)))
							{
								echo $updatepicture1.mysqli_errno($connection);exit;
							}
						}
						
						log_entry("Publication",$pub_name,"Edited", $tblpref,  $db, $row_admin[admin_id],$ip);

						header("Location:index.php?flag=edit");
						exit;
					}
			   }
			/*if($_FILES["upload"]["name"]!="") 
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
			exit;*/
		}
	}?>