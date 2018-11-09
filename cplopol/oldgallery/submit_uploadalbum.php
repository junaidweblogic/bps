<?php  session_start();
include("../../common/cploconfig.php");
if($mode == "del")
{
	$strdel = "DELETE FROM ".$tblpref."category WHERE cat_id = ".$fid;
	if(!($result=mysqli_query($connection,$strdel)))	{echo $strdel.mysqli_errno($connection);	exit;}
		////////////// dele file /////////////////
		$filepath = "../../possbpser/". $fn;
		@unlink($filepath);
	header("location:index-album.php?flag=del");
	exit;

}
else
{
	$qchk="SELECT * FROM ".$tblpref."category WHERE cat_type='album'  AND cat_title='".$imgcap."'";
	if(!($resqchk=mysqli_query($connection,$qchk))){ echo "FOR QUERY: $query<BR>".mysqli_errno($connection); exit;}
	$rowcount=mysqli_num_rows($resqchk);
   if($rowcount>0)
	   {
	       header("location:index-album.php?flag=exists");
	       exit;
	   }
	   else{
    if($_FILES["the_file"]["name"]!="") 
	{
         
		$query = "INSERT INTO ".$tblpref."category ( cat_title , cat_type ) VALUES ('".$imgcap."','album')  ";
		if(!($result=mysqli_query($connection,$query))){ echo "FOR QUERY: $query<BR>".mysqli_errno($connection); exit;}
		$id = mysqli_insert_id($connection);
			$fileload = $_FILES["the_file"]["name"];
			$file_ext = explode(".",$fileload);
			$myattach="gal-album".$id.".".$file_ext[1];
			$destpath="../../possbpser/".$myattach;
			 
			copy($_FILES["the_file"]["tmp_name"],$destpath) or die("Unable to upload image");
		
			$updatecategory="UPDATE ".$tblpref."category SET cat_image = '".$myattach."'WHERE  cat_id=".$id;
			if(!($result = mysqli_query($connection,$updatecategory))){echo $updatecategory.mysqli_errno($connection);exit;}
			
	}}

	header("location:index-album.php?flag=add");
	exit;
}


?>