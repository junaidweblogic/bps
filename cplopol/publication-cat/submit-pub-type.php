<?php 
include("../../common/cploconfig.php");
include("../../common/app_function.php");
$docname = addslashes($_REQUEST['docname']);

$docname = $_REQUEST['docname'];  
$mode = $_REQUEST[mode];
$pid = $_REQUEST[pid];

if($mode=="del")
	{
			
		$qchk2=sprintf("SELECT * FROM ".$tblpref."category WHERE cat_id='%d'", $pid);
	if(!($resqchk2=mysqli_query($connection,$qchk2))){ echo "FOR QUERY: $qchk2<BR>".mysqli_errno($connection); exit;}
	$row2=mysqli_fetch_array($resqchk2);
	$title = stripslashes($row2[cat_title]);

	log_entry("Publication Category",$title,"Deleted", $tblpref,  $db, $row_admin[admin_id],$ip);

		$query="Delete from ".$tblpref."category  where cat_id ='$pid'";
		if(!($result=mysqli_query($connection,$query))){echo $query.mysqli_errno($connection); exit;}
		$quedel="DELETE FROM ".$tblpref."content_master WHERE cms_subtype='$pid' AND cms_type='publication'";
		if(!($res=mysqli_query($connection,$quedel))){echo $quedel.mysqli_errno($connection); exit;}
		header("Location:index.php?flag=del");
		exit;

	}

if($pid=="")
	{
          $qchk="SELECT * FROM ".$tblpref."category WHERE cat_title='".$docname."' AND cat_type='Publication'";
			if(!($resqchk=mysqli_query($connection,$qchk))){ echo "FOR QUERY: $query<BR>".mysqli_errno($connection); exit;}
			$rowcount=mysqli_num_rows($resqchk);
		   if($rowcount>0)
	   {
	       header("location:index-add.php?flag=exists");
	       exit;
	   }else{
           
		$query_add="INSERT INTO ".$tblpref."category SET
		cat_title='$docname',
		cat_type = 'Publication'
		";
				
		if(!($result_add=mysqli_query($connection,$query_add))){echo $query_add.mysqli_errno($connection); exit;}
		
		log_entry("Publication Category",$docname,"Added", $tblpref,  $db, $row_admin[admin_id],$ip);

		header("Location:index.php?flag=add");
		exit;}

	}

	if($pid!="")
		{      
			$qselect="SELECT * FROM ".$tblpref."category WHERE cat_id='$pid'";
		 if(!($resqsel=mysqli_query($connection, $qselect))){echo  $qselect.mysqli_errno($connection); exit;}
		 $row=mysqli_fetch_array($resqsel);		  
		 $qchk="SELECT * FROM ".$tblpref."category WHERE cat_title!='$row[cat_title]'AND cat_title='$docname' ";
			if(!($resqchk=mysqli_query($connection,$qchk))){ echo "FOR QUERY: $query<BR>".mysqli_errno($connection); exit;}
			$rowcount=mysqli_num_rows($resqchk);
		   if($rowcount>0)
	   {
	       header("location:pub-type-add.php?flag=exists&pid=$pid");
	       exit;
	   }else{
			$qadd="UPDATE ".$tblpref."category set
			cat_title='$docname',
			cat_type = 'Publication'
			where cat_id= '$pid'";
			
			if(!($res=mysqli_query($connection,$qadd))){echo $qadd.mysqli_errno($connection); exit;}
			
			log_entry("Publication Category",$docname,"Edited", $tblpref,  $db, $row_admin[admin_id],$ip);

			header("Location:index.php?flag=edit");
			exit;}

	}
?>