<?php 
include("../../common/cploconfig.php");
include("../../common/app_function.php");

$content=addslashes($linkcontect);
$pub_name=addslashes($pub_name);

$curdate=date("Y-m-d");

if($mode=="del") {
	$qchk2=sprintf("SELECT * FROM ".$tblpref."content_master WHERE cms_id='%d'", $puid);
	if(!($resqchk2=mysqli_query($connection,$qchk2))){ echo "FOR QUERY: $qchk2<BR>".mysqli_errno($connection); exit;}
	$row2=mysqli_fetch_array($resqchk2);
	$title = stripslashes($row2[cms_title]);

	log_entry("Ploce Station",$title,"Deleted", $tblpref,  $db, $row_admin[admin_id],$ip);


	$query="Delete from ".$tblpref."content_master where cms_id='$puid'";
	if(!($result=mysqli_query($connection,$query))){echo mysqli_error($query); exit;}
	header("Location:index.php?flag=del");
	exit;
}

if($puid=="") {      
	$qchk="SELECT * FROM ".$tblpref."content_master WHERE cms_title='".$pub_name."' AND cms_type='police'";
	if(!($resqchk=mysqli_query($connection,$qchk))){ echo "FOR QUERY: $qchk<BR>".mysqli_errno($connection); exit;}
	$rowcount=mysqli_num_rows($resqchk);
	
	if($rowcount>0) {
		header("location:pub_add.php?flag=exists&mode=add");
		exit;
	}
	else{
		$qadd="INSERT INTO ".$tblpref."content_master set 
			cms_title='$pub_name',
			cms_page_title ='$pub_city',
			cms_type='police',
			cms_date='$curdate',
			cms_subtype ='$cmsarea',
			cms_desc ='$linkcontect',
			cms_sitelink='$googlecode'";	
		if(!($res=mysqli_query($connection,$qadd))){echo $qadd.mysqli_errno($connection); exit;}
		log_entry("Ploce Station",$pub_name,"Added", $tblpref,  $db, $row_admin[admin_id],$ip);
		header("Location:index.php?flag=add");
		exit;
	}
}


if($puid!="") {       
	$qselect="SELECT * FROM ".$tblpref."content_master WHERE cms_id='$puid'";
	if(!($resqsel=mysqli_query($connection, $qselect))){echo  $qselect.mysqli_errno($connection); exit;}
	$row=mysqli_fetch_array($resqsel);		  

	$qchk="SELECT * FROM ".$tblpref."content_master WHERE cms_title!='$row[cms_title]' AND cms_title='$pub_name' ";
	if(!($resqchk=mysqli_query($connection,$qchk))){ echo "FOR QUERY: $query<BR>".mysqli_errno($connection); exit;}
	$rowcount=mysqli_num_rows($resqchk);

	if($rowcount>0) {
		header("location:pub_add.php?flag=exists&puid=$puid");
		exit;
	}
	else{
		$query_update="UPDATE ".$tblpref."content_master set 
			cms_title='$pub_name',
			cms_page_title ='$pub_city',
			cms_type='police',
			cms_date='$curdate',
			cms_desc ='$linkcontect',
			cms_subtype ='$cmsarea',
			cms_sitelink='$googlecode'
			WHERE cms_id='$puid'";
		if(!($result=mysqli_query($connection,$query_update))){echo $query_update.mysqli_errno($connection); exit;}
		log_entry("Ploce Station",$pub_name,"Edited", $tblpref,  $db, $row_admin[admin_id],$ip);
		header("Location:index.php?flag=edit");
		exit;
	}
}
?>