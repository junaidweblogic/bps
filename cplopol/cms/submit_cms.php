<?php 
	include("../../common/app_function.php");
	include("../../common/cploconfig.php");
	
	$content=addslashes($_REQUEST[linkcontect]);
	$curdate=date("Y-m-d");
	$curtime=date("H:i:s");
	$cmscat = $_REQUEST[cmscat];
	$cid = $_REQUEST[cid];
	$name = $_REQUEST[name];
	$wtitle = $_REQUEST[wtitle];
	$metatag = $_REQUEST[metatag];
	$metakeyword = $_REQUEST[metakeyword];
	//echo $date=dateformate($curdate);exit;
	
	if($_REQUEST[mode]=="del") 	{

		$qchk2=sprintf("SELECT * FROM ".$tblpref."content_master WHERE cms_id='%d'", $id);
	if(!($resqchk2=mysqli_query($connection,$qchk2))){ echo "FOR QUERY: $qchk2<BR>".mysqli_errno($connection); exit;}
	$row2=mysqli_fetch_array($resqchk2);
	$title = stripslashes($row2[cms_title]);

		log_entry("CMS",$title,"Deleted", $tblpref,  $db, $row_admin[admin_id],$ip);


		$query="Delete from ".$tblpref."content_master where cms_id='$cid'";
		if(!($result=mysqli_query($connection,$query))){echo mysqli_error($query); exit;}
		
		$qversion="Delete from ".$tblpref."content_master where cms_count='$cid'";
		if(!($resversion=mysqli_query($connection,$qversion))){echo mysqli_error($qversion); exit;}

		header("Location:index.php?flag=del");
		exit;
	}

	if($cmscat == "Parent")
		$type = "Main Pages";
	else
		$type = $cmscat;


	if($cid=="")
	{       
		/*$qchk="SELECT * FROM ".$tblpref."content_master WHERE cms_title='".$name."' AND cms_type='mcms'";
		if(!($resqchk=mysqli_query($connection,$qchk))){ echo "FOR QUERY: $query<BR>".mysqli_errno($connection); exit;}
		$rowcount=mysqli_num_rows($resqchk);
		if($rowcount>0) 
		{
	       header("location:cms_add.php?flag=exists");
	       exit;
	   	}
	   	else
		{ */
		 	
			$content1 = str_replace("\\r\\n",'',$content);
			$qadd="INSERT INTO ".$tblpref."content_master set 
			cms_title='$name',
			cms_desc='$content1',
			cms_type='mcms',
			cms_subtype ='$type',
			cms_featured ='Active',
			cms_page_title='$wtitle',
			cms_time='$curtime',
			cms_date='$curdate',
			meta_tags='$metatag',
			meta_key_word='$metakeyword'";
			if(!($res=mysqli_query($connection,$qadd))){echo $qadd.mysqli_errno($connection); exit;}
			$id = mysqli_insert_id($connection);
			$update="UPDATE ".$tblpref."content_master set
			cms_sitelink='bps-content.php?cid=$id' where cms_id= '$id'";
			if(!($resup=mysqli_query($connection,$update))){echo $update.mysqli_errno($connection); exit;}

			$qry_admn = "select * from ".$tblpref."admin where user_type='superadmin'";
			if(!($res_admn = mysqli_query($connection,$qry_admn))){echo $qry_admn.mysqli_errno($connection);exit;}
			$row_admn = mysqli_fetch_assoc($res_admn);

			$qry_admn1 = "select * from ".$tblpref."admin where username='$_SESSION[username]'";
			if(!($res_admn1 = mysqli_query($connection,$qry_admn1))){echo $qry_admn1.mysqli_errno($connection);exit;}
			$row_admn1 = mysqli_fetch_assoc($res_admn1);

			$to = $row_admn['admin_email'];
			$from = $row_admn1['admin_email'];
			$sub = "CMS Management:Notification for addition of New CMS Page";

			$mesheader =  "From: ".$from."\n" . "Reply-To: ". $from . "\r\n";
			$mesheader .= "MIME-Version: 1.0\n";
			$mesheader .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
			
			$msg = "Hello Administrator, <br /> ";
			$msg .= "<br />This mail is to inform you that ".$_SESSION[username]."(".$_SESSION[user_type].") added the new page from admin panel into CMS Management. <br /> ";
			$msg .= "<br /><br /><br />Regards - Botswana Police Service<br />";

			@mail($to,$sub,$msg,$mesheader);

			log_entry("CMS",$name,"Added", $tblpref,  $db, $row_admin[admin_id],$ip);

			header("Location:index.php?flag=add");
			exit;
		//}
	}

	if($cid!="")
	{
		 	$qselect="SELECT * FROM ".$tblpref."content_master WHERE cms_id='$cid'";
		 	if(!($resqsel=mysqli_query($connection, $qselect))){echo  $qselect.mysqli_errno($connection); exit;}
		 	$row=mysqli_fetch_array($resqsel);		  
		 	$qchk="SELECT * FROM ".$tblpref."content_master WHERE cms_title!='$row[cms_title]' AND cms_title='$name' ";
			if(!($resqchk=mysqli_query($connection,$qchk))){ echo "FOR QUERY: $query<BR>".mysqli_errno($connection); exit;}
			$rowcount=mysqli_num_rows($resqchk);
		   	if($rowcount>0)
	   		{
	       		header("location:cms_add.php?flag=exists&cid=$cid");
	       		exit;
	   		}
			else
			{
				if($row[cms_count] != 0)
					$count = $row[cms_count];
				else
					$count = $cid;
					
				$content = str_replace("\\r\\n",'',$content);
				$query_update="INSERT INTO ".$tblpref."content_master set 
				cms_title='$name',
				cms_desc='$content',
				cms_type='mcms',
				cms_subtype ='$type',
				cms_page_title='$wtitle',
				cms_date='$curdate',
				cms_time='$curtime',
				cms_count='$count',
				meta_tags='$metatag',
				meta_key_word='$metakeyword'";

				//$query_update = str_replace("\r\n",'',$query_update);
				
				if(!($result=mysqli_query($connection,$query_update))){echo $query_update.mysqli_errno($connection); exit;}
				$id = mysqli_insert_id($connection);
				$update="UPDATE ".$tblpref."content_master set
				cms_sitelink='bps-content.php?cid=$id' where cms_id= '$id'"; 
				if(!($resup=mysqli_query($connection,$update))){echo $update.mysqli_errno($connection); exit;}

				log_entry("CMS",$name,"Eddited", $tblpref,  $db, $row_admin[admin_id],$ip);

				header("Location:index.php?flag=edit");
				exit;
			}
		
	}
?>