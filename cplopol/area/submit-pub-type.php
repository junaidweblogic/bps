<?php 
include("../../common/cploconfig.php");
include("../../common/app_function.php");
 
$mode = $_REQUEST[mode];
$pid = $_REQUEST[pid];
$docname = $_REQUEST[docname];
$area = $_REQUEST[area];
$selcity = $_REQUEST[selcity];

if($mode=="del")
	{
		$qchk2=sprintf("SELECT * FROM ".$tblpref."category WHERE cat_id='%d'", $id);
		if(!($resqchk2=mysqli_query($connection,$qchk2))){ echo "FOR QUERY: $qchk2<BR>".mysqli_connect_errno(); exit;}
		$row2=mysqli_fetch_array($resqchk2);
		$title = stripslashes($row2[cat_title]);

				   
		$query="Delete from ".$tblpref."category where cat_id ='$pid'";
		if(!($result=mysqli_query($connection,$query))){echo mysqli_error($query); exit;}
		
		log_entry("Area",$title,"Deleted", $tblpref,  $db, $row_admin[admin_id],$ip);


		header("Location:index.php?flag=del");
		exit;
	}

if($pid=="")
	{
		$qchk="SELECT * FROM ".$tblpref."category WHERE cat_title='".$docname."'";
		if(!($resqchk=mysqli_query($connection,$qchk))){ echo "FOR QUERY: $query<BR>".mysqli_connect_errno(); exit;}
		$rowcount=mysqli_num_rows($resqchk);
		if($rowcount>0)
		{
			header("location:pub-type-add.php?flag=exists");
			exit;
		}else{
		$query_add="INSERT INTO ".$tblpref."category SET
		cat_title='$docname',
		cat_type = 'area',
		cat_image = '$selcity'";
				
		if(!($result_add=mysqli_query($connection,$query_add))){echo $query_add.mysqli_connect_errno(); exit;}
		
		log_entry("Area",$docname,"Added", $tblpref,  $db, $row_admin[admin_id],$ip);

		header("Location:index.php?flag=add");
		exit;}

	}

	if($pid!="")
		{      
			$qselect="SELECT * FROM ".$tblpref."category WHERE cat_id='$pid'";
		 if(!($resqsel=mysqli_query($connection, $qselect))){echo  $qselect.mysqli_connect_errno(); exit;}
		 $row=mysqli_fetch_array($resqsel);		  
		 $qchk="SELECT * FROM ".$tblpref."category WHERE cat_title!='$row[cat_title]'AND cat_title='$docname' ";
			if(!($resqchk=mysqli_query($connection,$qchk))){ echo "FOR QUERY: $query<BR>".mysqli_connect_errno(); exit;}
			$rowcount=mysqli_num_rows($resqchk);
		   if($rowcount>0)
	   {
	       header("location:pub-type-add.php?flag=exists&pid=$pid");
	       exit;
	   }else{
			$qadd="UPDATE ".$tblpref."category set
			cat_title='$docname',
			cat_type = 'area',
			cat_image = '$selcity'
			where cat_id= '$pid'";
			
			if(!($res=mysqli_query($connection,$qadd))){echo $qadd.mysqli_connect_errno(); exit;}
			log_entry("Area",$docname,"Eddited", $tblpref,  $db, $row_admin[admin_id],$ip);
			header("Location:index.php?flag=edit");
			exit;}

	}
?>