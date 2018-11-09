<?php  session_start();
   include("../../common/cploconfig.php");
    $gid=$_POST[gid]; 
	$mode=$_GET[mode];
	$imgcap = addslashes($_REQUEST['imgcap']);
	if($mode=='del')
	{
		 $query=sprintf("DELETE FROM ".$tblpref."category WHERE cat_id ='%d'", $aid);
		if(!($result=mysqli_query($connection,$query))){echo $query.mysqli_errno($connection); exit;}
		
	   $qsel=sprintf("SELECT * FROM ".$tblpref."gallery WHERE img_album_id ='%d'", $aid);
	   if(!($res1=mysqli_query($connection,$qsel))){echo $qsel.mysqli_errno($connection); exit;}
	   while($row=mysqli_fetch_array($res1)){
	   $filepath = "../../possbpser/". $row[image_path];
		@unlink($filepath);}
		$quegal=sprintf("DELETE FROM ".$tblpref."gallery WHERE img_album_id ='%d'", $aid);
	   if(!($res=mysqli_query($connection,$quegal))){echo $quegal.mysqli_errno($connection); exit;}
		header("Location:indexmain.php?flag=del");
		exit;
	}
	if($gid=="")
	{
			$qadd="INSERT INTO ".$tblpref."category (cat_title , cat_type ) VALUES('$imgcap','album' )";
			if(!($res=mysqli_query($connection,$qadd))){echo $qadd.mysqli_errno($connection); exit;}
			header("Location:indexmain.php?flag=add");
			exit;
	}

	if($gid!="")
	{
			 $qadd=sprintf("UPDATE ".$tblpref."category SET 
			cat_title='%s'
			WHERE cat_id='%d'", $imgcap, $gid);
			if(!($res=mysqli_query($connection,$qadd))){echo $qadd.mysqli_errno($connection); exit;}
		 
			header("Location:indexmain.php?flag=edit");
			exit;		
	}
	
	
	?>
		