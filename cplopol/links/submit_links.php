<?php 
session_start();
include("../../common/cploconfig.php");

if($_FILES["produ_image"]["name"]!="")
{
	if($_FILES["produ_image"]["size"]>"2097152")
	{
		header("Location:add_links.php?flag=filesize");
		exit;
	}
}

include("../../common/app_function.php");

$today = date("y-m-d");

$brand = $_REQUEST['txtbrand'];  
$product = $_REQUEST['txtproduct']; 

$today = date("y-m-d");

$lid = $_POST['lid']; 
$mode = $_GET['mode'];

$ten_type = addslashes($_POST['ten_type']);
$ten_name= addslashes($_POST['ten_name']);
$dou = dateformate($_POST['datepicker']);
$dos = dateformate($_POST['datepicker_1']);
$desc =addslashes($_POST['linkcontect']);
$s_url = $_REQUEST['s_url'];


	if ($mode == 'delete')
	{
			$del_id = $_GET[del_id];

			$qchk2=sprintf("SELECT * FROM ".$tblpref."content_master WHERE cms_id='%d'", $del_id);
	if(!($resqchk2=mysqli_query($connection,$qchk2))){ echo "FOR QUERY: $qchk2<BR>".mysqli_errno($connection); exit;}
	$row2=mysqli_fetch_array($resqchk2);
	$title = stripslashes($row2[cms_title]);

	log_entry("Links",$title,"Deleted", $tblpref,  $db, $row_admin[admin_id],$ip);


			$qdel = sprintf("delete from ".$tblpref."content_master  where cms_id = '%d'", $del_id);
			if(!($res=mysqli_query($connection,$qdel))){echo $qdel.mysqli_errno($connection); exit;}
			$filepath = "../../possbpser/". $fn;
		    @unlink($filepath);
			header("Location:index.php?flag=delete");
			exit();
	}
	
	if($lid=="")
	{
		$qadd=sprintf("INSERT INTO ".$tblpref."content_master  set 
			cms_title='%s',
			cms_desc='%s',
			cms_type='link',
			cms_sitelink='%s'", $ten_name, $desc, $s_url);
			if(!($res=mysqli_query($connection,$qadd))){echo $qadd.mysqli_errno($connection); exit;}
			$ins_id=mysqli_insert_id($connection);

			if ($_FILES["produ_image"]["name"]!="")
			{
				$fileload = $_FILES["produ_image"]["name"];
				$file_ext = explode(".",$fileload);//----------with txtprod_f option/ we get extension.jpg --
				$file_ext = $file_ext[1];
				$newfilename = "link_".$ins_id.".".$file_ext;
				$destpath="../../possbpser/".$newfilename;
				copy($_FILES["produ_image"] ["tmp_name"],$destpath) or die("Unable to upload file");

				$updateproduct=sprintf("UPDATE ".$tblpref."content_master  SET
								cms_file1 ='%s'
								 WHERE cms_id  ='%d'", $newfilename, $ins_id);
				if(!($result = mysqli_query($connection,$updateproduct))){echo $InsertCategory.mysqli_errno($connection);exit;}

				$qry_admn = "select * from ".$tblpref."admin where user_type='superadmin'";
				if(!($res_admn = mysqli_query($connection,$qry_admn))){echo $qry_admn.mysqli_errno($connection);exit;}
				$row_admn = mysqli_fetch_assoc($res_admn);

				$qry_admn1 = "select * from ".$tblpref."admin where username='$_SESSION[username]'";
				if(!($res_admn1 = mysqli_query($connection,$qry_admn1))){echo $qry_admn1.mysqli_errno($connection);exit;}
				$row_admn1 = mysqli_fetch_assoc($res_admn1);

				$to = $row_admn['admin_email'];
				$from = $row_admn1['admin_email'];
				$sub = "Link Management:Notification for addition of New Link";

				$mesheader =  "From: ".$from."\n" . "Reply-To: ". $from . "\r\n";
				$mesheader .= "MIME-Version: 1.0\n";
				$mesheader .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
				
				$msg = "Hello Administrator, <br /> ";
				$msg .= "<br />This mail is to inform you that ".$_SESSION[username]."(".$_SESSION[user_type].") added the new link from admin panel into Useful Link Management. <br /> ";
				$msg .= "<br /><br /><br />Regards - Botswana Police Service<br />";

				@mail($to,$sub,$msg,$mesheader);
				
			}
			log_entry("Links",$ten_name,"Added", $tblpref,  $db, $row_admin[admin_id],$ip);
		
			header("Location:index.php?flag=add");
			exit;
	}

	if($lid!="" && $mode != 'delete')
	{
			$qedit=sprintf("update ".$tblpref."content_master  set 
			cms_title='%s',
			cms_desc='%s',
				cms_type='link',
			cms_sitelink='%s'
			where cms_id = '%d'", $ten_name, $desc, $s_url, $lid); 
			if(!($res=mysqli_query($connection,$qedit))){echo $qedit.mysqli_errno($connection); exit;}


			if ($_FILES["produ_image"]["name"]!="")
			{
				$fileload = $_FILES["produ_image"]["name"];
				$file_ext = explode(".",$fileload);//----------with txtprod_f option/ we get extension.jpg --
				$file_ext = $file_ext[1];
				$newfilename = "link_".$lid.".".$file_ext;
				$destpath="../../possbpser/".$newfilename;
				copy($_FILES["produ_image"] ["tmp_name"],$destpath) or die("Unable to upload file");

				$updateproduct=sprintf("UPDATE ".$tblpref."content_master  SET
								cms_file1 ='%s'
								 WHERE cms_id  ='%d'", $newfilename, $lid);
				if(!($result = mysqli_query($connection,$updateproduct))){echo $InsertCategory.mysqli_errno($connection);exit;}
				
			}
			log_entry("Links",$ten_name,"Eddited", $tblpref,  $db, $row_admin[admin_id],$ip);
			header("Location:index.php?flag=update");
			exit();
	}?>