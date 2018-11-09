<?php 

$name=addslashes($_POST[txtname]);
$checkbox1 = $_POST['checkbox1'];
//echo "<pre>";print_r($checkbox1);echo "</pre>";exit;
$chksuper = $_POST[chksuper];

if($chksuper=="1")
{
	$type="subadmin";
}
else if($chksuper=="2")
{
	$type="approver";
}
else
{
	$type="moderator";
}

if($_GET[mode]=="del")
{
	include("../../common/cploconfig.php");		   
	echo $query="Delete from ".$tblpref."admin where admin_id ='$_GET[id]'"; 
	if(!($result=mysqli_query($connection,$query))){echo mysqli_error($query); exit;}
	header("Location:index.php?flag=del");
	exit;
}
//print_r($checkbox1);
$mgmts =  implode(",", $checkbox1);
//echo $mgmts;exit;
include("../../common/cploconfig.php");
if($_POST[id]=="")
	{
		$query="select * from ".$tblpref."admin where username='$name'";
		if(!($result=mysqli_query($connection,$query))){echo $query.mysqli_errno($connection); exit;}
		$rowcount=mysqli_num_rows($result);
			if($rowcount!=0)
			{
				header("Location:index.php?flag=exist");
				exit;
			}
    		else
			{
				$qadd="INSERT INTO ".$tblpref."admin set 
				admin_name='$adminname',
				username='$txtname',
				password='$txtpassword',
				user_type='$type',
				admin_mgmts = '$mgmts'";
				if(!($res=mysqli_query($connection,$qadd))){echo $qadd.mysqli_errno($connection); exit;}
			}

			//$cnt_checkbox=count($checkbox);
			
			/*for($i=0;$i<=$cnt_checkbox-1;$i++)
			{
				$del_id = $checkbox[$i];					 
				$query="INSERT INTO ".$tblpref."admin_manage set admin_manage_adminname='$adminname',manage_name='$del_id'";
				if(!($ans=mysqli_query($connection,$query))){echo $query.mysqli_errno($connection); exit;}
			}*/
			
			/*if($cnt_checkbox > 0)
			{
				for($i=0;$i<=$cnt_checkbox-1;$i++)
				{
					if($cnt_checkbox==1)
					{
						$del_id = $checkbox[$i];					 
					}
					else
					{
						if($i!=$cnt_checkbox-1)
						{
							$del_id = $checkbox[$i].",";
						}
						else
						{
							$del_id = $checkbox[$i];
						}
					}
				}
				$query="UPDATE ".$tblpref."admin set admin_mgmts='$del_id' where username='$name' and admin_name='$adminname'";
				if(!($ans=mysqli_query($connection,$query))){echo $query.mysqli_errno($connection); exit;}
				
			}*/
			header("Location:index.php?flag=add");
			exit;
	}


if($id!="")
	{
			$query_update="UPDATE ".$tblpref."admin set 
			admin_name='$adminname',
			username='$txtname',
			password='$txtpassword',
			user_type='$type',
			admin_mgmts = '$mgmts'
			where admin_id='$id'";
		
			if(!($result=mysqli_query($connection,$query_update))){echo $query_update.mysqli_errno($connection); exit;}
			
			/*$query2="SELECT * FROM ".$tblpref."admin_manage WHERE admin_manage_adminname='$adminname'";
			if(!($result2=mysqli_query($connection,$query2))){ echo $query2.mysqli_errno($connection); exit;}
			while($row2=mysqli_fetch_array($result2))
			{										
				$query3="Delete from ".$tblpref."admin_manage where admin_manage_adminname='$adminname'";
				if(!($result3=mysqli_query($connection,$query3))){echo mysqli_error($query3); exit;}
							
			}*/
			$cnt_checkbox=count($checkbox);
			/*for($i=0;$i<=$cnt_checkbox-1;$i++)
			{
				$del_id = $checkbox[$i];					 
				$query="INSERT INTO ".$tblpref."admin_manage set admin_manage_adminname='$adminname',manage_name='$del_id'";
				if(!($ans=mysqli_query($connection,$query))){echo $query.mysqli_errno($connection); exit;}	
					
			}*/
			
			
			/*if($cnt_checkbox > 0)
			{
				for($i=0;$i<=$cnt_checkbox-1;$i++)
				{
					if($cnt_checkbox==1)
					{
						$del_id = $checkbox[$i];					 
					}
					else
					{
						if($i!=$cnt_checkbox-1)
						{
							$del_id = $checkbox[$i].",";
						}
						else
						{
							$del_id = $checkbox[$i];
						}
					}
				}
				$query="UPDATE ".$tblpref."admin set admin_mgmts='$del_id' where username='$name' and admin_name='$adminname'";
				if(!($ans=mysqli_query($connection,$query))){echo $query.mysqli_errno($connection); exit;}
				
			}*/
			header("Location:index.php?flag=edit");
			exit;
		
	}

?>