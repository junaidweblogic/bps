<?php 
include("../../common/cploconfig.php");
//$name=addslashes($name);
$id = $_REQUEST[id];
if($_REQUEST['mode']=="del")
{
			   
	$query="Delete from ".$tblpref."member where m_id =$id";
	if(!($result=mysqli_query($connection,$query))){echo mysqli_error($query); exit;}
	header("Location:index.php?flag=del");
	exit;
}

if($_REQUEST['mode']!="del")
	{
			$query = "select * from ".$tblpref."member where m_id=$id";
			if(!($result=mysqli_query($connection,$query))){echo $query.mysqli_errno($connection); exit;}
			$row = mysqli_fetch_assoc($result);
			if($row[m_status]=='ac')
			{
				$status='in';
				
			}
			else
			{
				$status='ac';
				$qry_admn = "select * from ".$tblpref."admin where user_type='superadmin'";
				if(!($res_admn = mysqli_query($connection,$qry_admn)))
				{
					echo $qry_admn.mysqli_errno($connection);
					exit();
				}
				$row_admn = mysqli_fetch_assoc($res_admn);
				if($row_admn['admin_name']!="")
				{
					$admin_name = $row_admn['admin_name'];
				}
				else
				{
					$admin_name = 'Super Administrator';
				} 
				$msg_admin="
							<html>
							<head>
							<meta http-equiv='Content-Language' content='nl'>

							<meta http-equiv='Content-Type' content='text/html; charset=windows-1252'>
							<title>Feedback</title>
							</head>

							<body >

							<table width='100%' cellspacing='0' cellpadding='0' style=' border-collapse:collapse; font-family:Arial' border=0 ><b> 
							<tr>
								<td width='15%' colspan=2 align='left'><font size='2'>Hello $row[m_name],</font></td>
							</tr>

							<tr>
							<td ><font size='2'><BR>. Thank you for registering with us, your account has been activated. you can post your comments on the links below.....<A HREF='$path'>$path</A></font></td>
							</tr>

							<tr>				
								<td  width='85%'><font size='2'><BR><BR>Regards</font></td>
							</tr>

							<tr>				
								<td  width='85%'><font size='2'>$admin_name</font></td>
							</tr>
							
							
							</table>			
							</body>
							</html>
					";
				$to_admn = $row[m_email];
				$email = $row_admn[admin_email];

				$sub_admn = "Account activation";
				$from_admn = "From: ".$email."\n";
				
				//$from_admn .= "\nmime-version: 1.0\ncontent-type: text/html";
				$from_admn .= "MIME-Version: 1.0\n";
				$from_admn .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";

				@mail($to_admn,$sub_admn,$msg_admin,$from_admn);
			}

			$query_update="UPDATE ".$tblpref."member set m_status = '$status' where m_id='$id'";
		
			if(!($result_update=mysqli_query($connection,$query_update))){echo $query_update.mysqli_errno($connection); exit;}
			
			header("Location:index.php?flag=edit");
			exit;
		
	}

?>