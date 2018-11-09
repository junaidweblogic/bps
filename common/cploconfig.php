<?php 
	error_reporting(~E_ALL);
	#ini_set("session.cookie_secure", 0);
	ini_set("session.cookie_httponly", 1);
	@session_set_cookie_params(0, NULL, NULL, NULL, TRUE);
	
	foreach ($_POST as $key => $value) {
	$_POST[$key] = addslashes(stripslashes(str_replace('\r\n','',$value)));
	}

	foreach ($_GET as $key => $value) {
	$_GET[$key] = addslashes(stripslashes(str_replace('\r\n','',$value)));
	}

	foreach ($_REQUEST as $key => $value) {
	$_REQUEST[$key] = addslashes(stripslashes(str_replace('\r\n','',$value)));
	}

/*
	foreach ($_SESSION as $key => $value) {
	$_SESSION[$key] = addslashes(stripslashes(str_replace('\r\n','',$value)));
	}

	foreach ($_COOKIE as $key => $value) {
	$_COOKIE[$key] = addslashes(stripslashes(str_replace('\r\n','',$value)));
	}
*/


	@reset ($_GET); 
	while (list ($key, $val) = @each ($_GET)) $$key=$val; 

	@reset ($_POST); 
	while (list ($key, $val) = @each ($_POST)) $$key=$val; 

	@reset ($_SESSION); 
	while (list ($key, $val) = @each ($_SESSION)) $$key=$val; 

	@reset ($_COOKIE); 
	while (list ($key, $val) = @each ($_COOKIE)) $$key=$val;

	$data = array_keys($_FILES); 
	$blacklist = array(".php", ".phtml", ".php3", ".php4", ".js", ".shtml", ".pl" ,".py","php","phtml","php3","php4","inc","tcl","cpp","py","cgi","pl"); 

	foreach ($data as $filename)
	{
		foreach ($blacklist as $file) 
		{	
			if(preg_match("/$file\$/i", $_FILES[$filename]['name'])) 
			{ 
				echo "ERROR: Uploading executable files Not Allowed\n"; 
				exit; 
			} 
		} 
	}

//database connections LOCAL

/*$hostname="localhost";
$serveruser="root";
$serverpass="gyro";
$databasename="botswana_police7";*/

/*$hostname="localhost";
$serveruser="";
$serverpass="";
$databasename="";*/


//database connections Remote
$hostname="<DB HOST>";
$serveruser="<SERVER NAME>";
$serverpass="<DB PASSWORD>";
$databasename="<DB NAME>";


$tblpref="c_";
//email
//$webmasteremail="admin@cebet.com";

$curlanguage="english"; // eg:- "norvegian", "french"
$curlanguageadmin="english"; // eg:- "norvegian", "french"
$curlanguagesuper="english";
$curlanguageapp="english";

$path1="<SITE URL>";
$ckpath="/common";



$pagesize=10;

if(!$connection = mysqli_connect($hostname, $serveruser, $serverpass, $databasename))
	echo mysqli_connect_errno();

	   $createdatabase ="CREATE DATABASE IF NOT EXISTS ". $databasename;
		if (!($resadmin = mysqli_query($connection, $createdatabase))) { echo "FOR QUERY: $createdatabase<BR>".mysqli_connect_errno(); 	exit;}
/*
if(!$connection = mysql_connect($hostname, $serveruser, $serverpass))
	echo mysql_error();
if(!$db = mysql_select_db($databasename)) 
	echo mysql_error();*/

global $siteName,$siteShortName,$sitefont;
$sitename="http://www.bps.co.bw";
$siteShortName="BPS";
$sitefont="Arial";
$sitefontweight="2";

$curlanguage="common/". $curlanguage. ".php";
$path="http://demo.weblogic.co.bw/local/botswana-police7/";
//$path="http://www.police.gov.bw/";
//$path1="http://183.177.124.157/local/bots-police/";
//$csvfpath="/var/www/html/local/caab/tempx/";// local path 
//$csvfpath="/var/www/web181/web/tempex/";// live path

if($_SESSION['username']!="")
{
	$username = $_SESSION['username'];
	$query_admin = sprintf("select * from ".$tblpref."admin where username='%s'", $username);
	if(!($result_admin = mysqli_query($connection,$query_admin))) {  echo $query_admin.mysqli_connect_errno();   exit(); }
	$row_admin = mysqli_fetch_array($result_admin);

}

?>