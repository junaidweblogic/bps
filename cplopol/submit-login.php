<?php 
session_start();
include("../common/cploconfig.php");

/*foreach ($_POST as $key => $value) {
$_POST[$key] = mysql_real_escape_string($value);
}

foreach ($_GET as $key => $value) {
$_GET[$key] = mysql_real_escape_string($value);
}*/
//print_r($_POST);
$imgsession= $_SESSION["security_code"];
$captcha = strtolower($_REQUEST['captcha']);
$username= mysqli_real_escape_string($connection,$_POST[username]);
$password= mysqli_real_escape_string($connection,$_POST[password]);
if($captcha == $imgsession) {

$query=sprintf("select * from ".$tblpref."admin where `username`='%s' AND `password` = '%s'",$username,$password);
if(!($result = mysqli_query($connection,$query))){ echo $query.mysqli_connect_errno();  exit; }
	  $rowcount = mysqli_num_rows($result);	
	  if($rowcount > 0)
		{
			$row = mysqli_fetch_array($result);
			if(($username!=$row[username]) || ($password!=$row[password]))
			{
				$select="select * from  ".$tblpref."admin";
				if(!($result_sel = mysqli_query($connection,$select))){ echo $select.mysqli_connect_errno();  exit; }
				$row_sel = mysqli_fetch_array($result_sel);
				$n=$row_sel[logincount];
				$n=$n+1;

				if($row_sel[logincount]< 2)
				{
					$update= "update ".$tblpref."admin set 
					logincount='$n' where admin_id ='1'";
					if(!($result_up = mysqli_query($connection,$update))){ echo $update.mysqli_connect_errno();  exit; }

					header("Location:index.php?flag=wrong");
					exit;
				}else
				{
					header("Location:failedlogin.php");
					exit;
				}		
			}
			else
			{
				$_SESSION[username]=stripslashes($row[username]);
				$_SESSION[user_type]=stripslashes($row[user_type]);
				$_SESSION[admin_name]=stripslashes($row[admin_name]);
				$_SESSION[admin_type]=stripslashes($row[admin_type]);


				$update="update ".$tblpref."admin set 
				logincount='0' where admin_id ='1'";
				if(!($result_up = mysqli_query($connection,$update))){ echo $update.mysqli_connect_errno();  exit; }

				header("Location:home.php?flag=right");
				exit;
			}
			
	}else{
				$select="select * from  ".$tblpref."admin";
				if(!($result_sel = mysqli_query($connection,$select))){ echo $select.mysqli_connect_errno();  exit; }
				$row_sel = mysqli_fetch_array($result_sel);
				$n=$row_sel[logincount];
				$n=$n+1;

				if($row_sel[logincount]< 2)
				{
					$update="update ".$tblpref."admin set 
					logincount='$n' where admin_id ='1'";
					if(!($result_up = mysqli_query($connection,$update))){ echo $update.mysqli_connect_errno();  exit; }

					header("Location:index.php?flag=wrong");
					exit;
				}
				else
				{
					header("Location:failedlogin.php");
					exit;
				}
}
}else{
				

				header("Location:index.php?flag=invalid&password=$password&username=$username");
				exit;
				
}
?>