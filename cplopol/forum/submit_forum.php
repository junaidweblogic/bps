<?
include("../../common/cploconfig.php");
   
   if($status=="")
   {
		if($mode=="del")
		{
					   
			$query="Delete from ".$tblpref."forum  where f_id ='$id'";
			if(!($result=mysqli_query($connection,$query))){echo $query.mysqli_errno($connection); exit;}
			header("Location:index.php?flag=del");
			exit;
		}

		if($id!="")
		{
			$qadd="update ".$tblpref."forum set
			f_name='$name',
			f_post='$pname'
			where f_id='$id' ";
			if(!($res=mysqli_query($connection,$qadd))){echo $qadd.mysqli_errno($connection); exit;}

			header("Location:index.php?flag=edit");
			exit;
		}
   }

	if($status=="Inactive" || $status=="New")
	{
		$qadd="update ".$tblpref."forum set
		f_status='Active'
		where f_id='$id' ";
		if(!($res=mysqli_query($connection,$qadd))){echo $qadd.mysqli_errno($connection); exit;}

		header("Location:index.php?flag=edit");
		exit;
	}
	else
	{
		$qadd="update ".$tblpref."forum set
		f_status='Inactive'
		where f_id='$id' ";
		if(!($res=mysqli_query($connection,$qadd))){echo $qadd.mysqli_errno($connection); exit;}

		header("Location:index.php?flag=edit");
		exit;
	}
?>