<?php
@session_start();
include("common/config.php");
include("common/app_function.php");

$userval = preg_chk($_POST['userval']);
$search = preg_chk($_POST['search']);
if($userval!="" && preg_chk($_SESSION['userval'])!="")
{	
	if($userval==$_SESSION['userval'])
	{ 
		$query_hash = sprintf("SELECT * FROM ".$tblpref."userval WHERE session_val='%s'", $_SESSION['userval']);
		if(!$result_hash = mysqli_query($connection,$query_hash))
		{  
			echo $query_hash.mysqli_connect_errno();
			exit;
		}
		$row_hash = mysqli_fetch_array($result_hash);
		$hash_userval = md5($userval);
		if($row_hash[hash_val] == $hash_userval)
		{   
			$url = $rewritepath."index.php/site-search/search/".$search."/";
			?>
			<body onload="document.frm.submit();">
				<form method="get" action="<?php echo $url;?>" name="frm">
				</form>
			</body>
			<?php
			exit();
		}
		else
		{ ?>
			<body onload="document.frm.submit();">
				<form method="POST" action="<?php echo $rewritepath;?>index.php/error/" name="frm">
				</form>
			</body>
			<?php
			exit();
		}
	}
	else
	{ ?>
		<body onload="document.frm.submit();">
			<form method="POST" action="<?php echo $rewritepath;?>index.php/error/" name="frm">
			</form>
		</body>
		<?php
		exit();
	}
}
else
{ ?>
	<body onload="document.frm.submit();">
		<form method="POST" action="<?php echo $rewritepath;?>index.php/error/" name="frm">
		</form>
	</body>
	<?php
	exit();
}
$get_url = $_SERVER["REQUEST_URI"];
$ch=array( "=" , "&");
$get_url = str_replace( $ch , "/", $get_url);
$get_url = str_replace( "?" , "", $get_url);
$get_url = $get_url."/";
$get_url = str_replace( "submit-search" , "site-search", urldecode($get_url));

header("Location: ".$get_url);
exit;
?>