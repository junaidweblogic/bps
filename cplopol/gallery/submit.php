<?php
@session_start();
include("../../common/app_function.php");
include("../../common/config.php");
if($_SESSION[username]=="")
{
	displayerror("Login Error.","","For security of your account,we have expired your session.<br>&nbsp;Please login to your account again.", "Login,../index.php", 0);
	exit();
}
$albtitle = addslashes($_POST[albtitle]);
$mode = $_REQUEST[mode];

if($mode=="del")
{
	$id= $_GET[id];	

	$qchk=sprintf("SELECT * FROM ".$tblpref."gallery WHERE img_album_id='%d'", $id);
	if(!($resqchk=mysqli_query($connection,$qchk))){ echo "FOR QUERY: $qchk<BR>".mysqli_errno($connection); exit;}
	$rowcount=mysqli_num_rows($resqchk);
	if($rowcount>0)
	{
		while($row=mysqli_fetch_array($resqchk))
		{
			if($row[image_path]!="")
			{
				@unlink("../../".$uploadpath.$row[image_path]);
			}
		}
	}
	$qchk1=sprintf("DELETE FROM ".$tblpref."gallery WHERE img_album_id='%d'", $id);
	if(!($resqchk1=mysqli_query($connection,$qchk1))){ echo "FOR QUERY: $qchk1<BR>".mysqli_errno($connection); exit;}

	$selque=sprintf("SELECT * FROM ".$tblpref."category WHERE cat_id='%d'",$id);
	if(!($selresult=mysqli_query($connection,$selque))){echo mysqli_error($selque); exit;}
	$sel_row=mysqli_fetch_array($selresult);
	$rec_title=$sel_row[cms_title];
	log_entry("Galley",$rec_title,"Delete", $tblpref,  $db, $row_admin[admin_id],$ip);
	$query=sprintf("DELETE FROM ".$tblpref."category WHERE cat_id='%d' AND cat_type='album'", $id);
	if(!($result=mysqli_query($connection,$query))){echo mysqli_error($query); exit;}
	header("Location:index.php?flag=del");
	exit;
}
$id= $_POST[id];	
if($id=="")
{
	$qchk=sprintf("SELECT * FROM ".$tblpref."category WHERE cat_title='%s' AND cat_type='album' ", $albtitle);
	if(!($resqchk=mysqli_query($connection,$qchk))){ echo "FOR QUERY: $query<BR>".mysqli_errno($connection); exit;}
	$rowcount=mysqli_num_rows($resqchk);
	if($rowcount>0)
	{
		header("location:add.php?flag=exists&mode=add");
	    exit;
	}
	else
	{		
		$qadd=sprintf("INSERT INTO ".$tblpref."category SET cat_title='%s',cat_type='album'",$albtitle);
		if(!($res=mysqli_query($connection,$qadd))){echo $qadd.mysqli_errno($connection); exit;}
		log_entry("Gallery",$albtitle,"Added", $tblpref,  $db, $row_admin[admin_id],$ip);
		header("Location:index.php?flag=add");
		exit;
	}
}

if($id!="")
{		
    	$query_update=sprintf("UPDATE ".$tblpref."category SET cat_title='%s' WHERE cat_id='%d'",  $albtitle, $id);			
		if(!($result=mysqli_query($connection,$query_update))){echo $query_update.mysqli_errno($connection); exit;}
		log_entry("Gallery",$albtitle,"Edited", $tblpref,  $db, $row_admin[admin_id],$ip);
		header("Location:index.php?flag=edit");
		exit;
}
?>