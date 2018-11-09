<?
include("../../common/cploconfig.php");
   
if($mode=="del")
	{
				   
		$query="Delete from ".$tblpref."forum where f_id ='$id'";
		if(!($result=mysqli_query($connection,$query))){echo $query.mysqli_errno($connection); exit;}
		header("Location:index1.php?flag=del");
		exit;

	}

 	if($id!="")
		{
			$qadd="update ".$tblpref."forum set
			f_post='$comments' where f_id='$id' ";
			if(!($res=mysqli_query($connection,$qadd))){echo $qadd.mysqli_errno($connection); exit;}
			header("Location:index1.php?flag=edit");
			exit;

	} 
?>