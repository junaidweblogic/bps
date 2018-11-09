<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Shopping Cart</title>
<link href="../../css/bps-style.css" rel="stylesheet" type="text/css" />
	</head>
	<body style="border:#cccccc 1px solid;">
	<div style="margin:10px;">
<?
include("../../common/cploconfig.php");
$query = "SELECT * FROM " . $tblpref . "content_master WHERE cms_id='$_REQUEST[cmsid]'";
if(!($result = mysqli_query($connection,$query))) { echo "Query - " . $query . "<br />Error - " . mysqli_errno($connection); }
$row = mysqli_fetch_array($result);
?>
<h2><? echo $row[cms_title];?></h2>
<div>
<? echo $row[cms_desc];?>
</div>
</div>
</body>
</html>