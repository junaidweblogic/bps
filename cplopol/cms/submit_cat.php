<?php 
include("../../common/cploconfig.php");
   
if($mode=="del")
	{
				   
		$query="Delete from ".$tblpref."category  where cat_id ='$id'";
		if(!($result=mysqli_query($connection,$query))){echo mysqli_error($query); exit;}
		header("Location:cms_cat.php?flag=del");
		exit;

	}

if($id=="")
	{

		$query_add="insert into ".$tblpref."category set
		cat_title='$docname',
		cat_type='cms'";
				
		if(!($result_add=mysqli_query($connection,$query_add))){echo $query_add.mysqli_error(); exit;}

		header("Location:cms_cat.php?flag=add");
		exit;

	}

	if($id!="")
		{
			$qadd="update ".$tblpref."category set
			cat_title='$docname'
			where cat_id='$id'
			";
			if(!($res=mysqli_query($connection,$qadd))){echo $qadd.mysqli_error(); exit;}

			header("Location:cms_cat.php?flag=edit");
			exit;

	}
?>