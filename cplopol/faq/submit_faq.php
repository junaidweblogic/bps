<?php  
	session_start();
   include("../../common/cploconfig.php");
   include("../../common/app_function.php");

	$txtdate11=date("Y-m-d");
	$txtmode = $_POST[txtmode];
	$content=addslashes($_POST[linkcontect]);
	
	if($txtmode=="add")
	{
		//add new record txtmode  is a hidden text box in cms_add.php
		$name=addslashes($_POST[txtname]);
		
		$query="SELECT * FROM ".$tblpref."content_master WHERE cms_title='$txtname' AND cms_type='faq'";
		if(!($result=mysqli_query($connection,$query))){echo $query.mysqli_errno($connection); exit;}
		$row_count=mysqli_num_rows($result);
		if($row_count >0)
		{
			header("LOCATION:index.php?flag=exits");
			exit;
		}
		else
		{
			$qadd="INSERT INTO ".$tblpref."content_master (cms_title,cms_desc,cms_date,cms_type) VALUES('$name','$content','$txtdate11','faq')";
			if(!($res=mysqli_query($connection,$qadd))){echo $qadd.mysqli_errno($connection); exit;}
			log_entry("FAQ",$name,"Added", $tblpref,  $db, $row_admin[admin_id],$ip);
			$faq_id=mysqli_insert_id($connection);
		
			header("Location:index.php?flag=add&mode=$status");
			exit;
		}
	}

	if($txtmode=="edit")
	{
		//update record txtmode,$txtid  are hidden text boxes in cms_add.php
			$name=addslashes($_POST[txtname]);
			$name1=addslashes($txtname1);
			$name2=addslashes($txtname2);
			//$venue=trim($txtvenue);
			$qadd="UPDATE ".$tblpref."content_master SET 
			cms_title='$name',
			cms_desc='$content',
			cms_type='faq',
			cms_date='$txtdate11'
			WHERE cms_id='$_POST[txtid]'";
			if(!($res=mysqli_query($connection,$qadd))){echo $qadd.mysqli_errno($connection); exit;}
			
			log_entry("FAQ",$name,"Edited", $tblpref,  $db, $row_admin[admin_id],$ip);

			header("Location:index.php?flag=edit&mode=$status");
			exit;		
	}
	
	if($mode=="del")
	{
		$id= $_REQUEST[did];
	$qchk2=sprintf("SELECT * FROM ".$tblpref."content_master WHERE cms_id='%d'", $id);
	if(!($resqchk2=mysqli_query($connection,$qchk2))){ echo "FOR QUERY: $qchk2<BR>".mysqli_errno($connection); exit;}
	$row2=mysqli_fetch_array($resqchk2);
	$title = stripslashes($row2[cms_title]);

	log_entry("FAQ",$title,"Deleted", $tblpref,  $db, $row_admin[admin_id],$ip);

		$query="DELETE FROM ".$tblpref."content_master WHERE cms_id ='$did'";
		if(!($result=mysqli_query($connection,$query))){echo mysqli_error($query); exit;}
	
		header("Location:index.php?flag=del&mode=$status");
		exit;
	}
	?>
		