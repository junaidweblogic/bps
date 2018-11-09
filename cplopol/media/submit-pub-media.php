<?php 
include("../../common/cploconfig.php");
$mpub = addslashes($mpub);

	if($mode=="del")
	{
		$query="Delete from ".$tblpref."media  where med_id ='$mid'";
		if(!($result=mysqli_query($connection,$query))){echo $query.mysqli_errno($connection); exit;}

		$quedel="DELETE FROM ".$tblpref."content_master WHERE cms_subtype='$mid' AND cms_type='media'";
		if(!($res=mysqli_query($connection,$quedel))){echo $quedel.mysqli_errno($connection); exit;}
		
		
		header("Location:indexmain.php?flag=del");
		exit;

	}
	if($_FILES["upload"]["name"]!="")
	{
		$var=$_FILES["upload"]["type"];
		$var = explode("/",$var);
		$var = $var[0];
		if($var != "image")
		{
			header("Location:pub-add.php?flag=msg&mpub=$mpub&med_type=$med_type");
			exit;
		}
		else
		{
			if($_FILES["upload"]["size"]>"15728640")
			{
				header("Location:pub-add.php?flag=size&mpub=$mpub&med_type=$med_type");
				exit;
			}
			
		}
	}

	if($mid=="")
	{
          $qchk="SELECT * FROM ".$tblpref."category WHERE cat_title='".$mpub."' AND cat_type='media'";
			if(!($resqchk=mysqli_query($connection,$qchk))){ echo "FOR QUERY: $query<BR>".mysqli_errno($connection); exit;}
			$rowcount=mysqli_num_rows($resqchk);
		   if($rowcount>0)
	   {
	       header("location:pub-add.php?flag=exists&mode=add&mpub=$mpub&med_type=$med_type");
	       exit;
	   }else{
		$query_add="INSERT INTO ".$tblpref."media SET
		med_pub='$mpub',
		med_type='$med_type'";
		
				
		if(!($result_add=mysqli_query($connection,$query_add))){echo $query_add.mysqli_errno($connection); exit;}
		$id = mysqli_insert_id($connection);

		if($_FILES["upload"]["name"]!="") 
			{
				 $fileload = $_FILES["upload"]["name"];
				 $file_ext = explode(".",$fileload);
				 $myattach="medlogo_".$id.".".$file_ext[1];
				 $destpath="../../possbpser/".$myattach;
				 
				 copy($_FILES["upload"]["tmp_name"],$destpath) or die("Unable to upload doc file");
			
				   $updatepicture="UPDATE ".$tblpref."media SET med_pub_logo ='".$myattach."' WHERE med_id =".$id; 
				 if(!($result = mysqli_query($connection,$updatepicture))){echo $updatepicture.mysqli_errno($connection);exit;}
			}

		header("Location:indexmain.php?flag=add");
		exit;}

	}

	if($mid!="")
	{
             $qselect="SELECT * FROM ".$tblpref."category WHERE cat_id='$mid'";
		 if(!($resqsel=mysqli_query($connection, $qselect))){echo  $qselect.mysqli_errno($connection); exit;}
		 $row=mysqli_fetch_array($resqsel);		  
		 $qchk="SELECT * FROM ".$tblpref."category WHERE cat_title!='$row[cat_title]'AND cat_title='$mpub' ";
			if(!($resqchk=mysqli_query($connection,$qchk))){ echo "FOR QUERY: $query<BR>".mysqli_errno($connection); exit;}
			$rowcount=mysqli_num_rows($resqchk);
		   if($rowcount>0)
	   {
	       header("location:pub-add.php?flag=exists&mid=$mid");
	       exit;
	   }else {
			 $qadd="UPDATE ".$tblpref."media set
			med_pub='$mpub',
			med_type='$med_type'
			where med_id= '$mid'";
			
			if(!($res=mysqli_query($connection,$qadd))){echo $qadd.mysqli_errno($connection); exit;}
			if($_FILES["upload"]["name"]!="") 
			{
				 $fileload = $_FILES["upload"]["name"];
				 $file_ext = explode(".",$fileload);
				 $myattach="medlogo_".$mid.".".$file_ext[1];
				 $destpath="../../possbpser/".$myattach;
				 
				 copy($_FILES["upload"]["tmp_name"],$destpath) or die("Unable to upload doc file");
			
				 $updatepicture="UPDATE ".$tblpref."media SET med_pub_logo ='".$myattach."' WHERE med_id =".$mid; 
				 if(!($result = mysqli_query($connection,$updatepicture))){echo $updatepicture.mysqli_errno($connection);exit;}
			}

			header("Location:indexmain.php?flag=edit");
			exit;
			}

	  }
?>