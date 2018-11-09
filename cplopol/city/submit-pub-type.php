<?php 
include("../../common/cploconfig.php");
include("../../common/app_function.php");
 
$mode = $_REQUEST[mode];
$pid = $_REQUEST[pid];
$docname = $_REQUEST['docname'];
$city = $_REQUEST[city];

if($mode=="del")
	{
		$qcat="SELECT * FROM ".$tblpref."category WHERE cat_id='".$pid."'";
		if(!($rescat = mysqli_query($connection,$qcat))){ echo "FOR QUERY: $qcat<BR>".mysqli_connect_errno(); exit;}
		$rowcat = mysqli_fetch_array($rescat);


		log_entry("City",$rowcat[cat_title],"Deleted", $tblpref,  $db, $row_admin[admin_id],$ip);


		$query="Delete from ".$tblpref."category  where cat_image = '$rowcat[cat_title]'";
		if(!($result=mysqli_query($connection,$query))){echo mysqli_error($query); exit;}

		$query="Delete from ".$tblpref."category  where cat_id ='$pid'";
		if(!($result=mysqli_query($connection,$query))){echo mysqli_error($query); exit;}

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
		cat_type = 'city'";
				
		if(!($result_add=mysqli_query($connection,$query_add))){echo $query_add.mysqli_connect_errno(); exit;}
		log_entry("City",$docname,"Added", $tblpref,  $db, $row_admin[admin_id],$ip);

			header("Location:index.php?flag=add");
			exit;
		}

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
			cat_type = 'city'
			where cat_id= '$pid'";
			
			if(!($res=mysqli_query($connection,$qadd))){echo $qadd.mysqli_connect_errno(); exit;}
			log_entry("City",$docname,"Edited", $tblpref,  $db, $row_admin[admin_id],$ip);

			header("Location:index.php?flag=edit");
			exit;
			}

	}
?>