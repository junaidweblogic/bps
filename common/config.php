<?php 
@session_start();
ini_set('session.gc_maxlifetime', 3600);
//error_reporting(E_ALL);
#ini_set("session.cookie_secure", 0);
ini_set("session.cookie_httponly", 1);
session_set_cookie_params(0, NULL, NULL, NULL, TRUE);
$errorpage="http://192.168.0.101/local/botswana-police/error.php";

$data = array_keys($_FILES); 
$blacklist = array(".php", ".phtml", ".php3", ".php4", ".js", ".shtml", ".pl" ,".py",".inc",".tcl",".cpp",".cgi",".htaccess", ".exe"); 

foreach ($data as $filename)
{
	foreach ($blacklist as $file) 
	{	
		if(@preg_match("/$file\$/i", $_FILES[$filename][$j++])) 
		{ 
			echo "ERROR: Uploading executable files Not Allowed\n"; 
			exit; 
		} 
	} 
} 

$url = $_SERVER['REQUEST_URI'];
$cross_site_array = array("<img>", "onload", "%22", "<iframe>", "<body>", "onerror", "prompt(", "alert", "onmouseover", "onmouserover", "<script>", "</script>", "<style>", "select", "SELECT", "char(", "CHAR(", "concat(", "CONCAT(","%27");
$cnt_crs_sr = count($cross_site_array);
for($i=0;$i<$cnt_crs_sr; $i++)
{
	//echo '"'.$cross_site_array[$i].'"'."<br/>";
	$res_pos = strpos($url, $cross_site_array[$i]);
	if($res_pos > -1)
	{
		
		header("location:".$errorpage);
		exit();
	}
}

foreach ($_POST as $key => $value) {
	if (!is_array($_POST[$key]))
	{
		$_POST[$key] = str_replace('prompt(','',str_replace('\r','',$_POST[$key]));
		$_POST[$key] = str_replace('alert(','',str_replace('\r','',$_POST[$key]));
		$_POST[$key] = str_replace('onmouseover(','',str_replace('\r','',$_POST[$key]));
		$_POST[$key] = str_replace('<script>','',str_replace('\r','',$_POST[$key]));
		$_POST[$key] = str_replace('</script>','',str_replace('\r','',$_POST[$key]));
		$_POST[$key] = str_replace('.../','',str_replace('\r','',$_POST[$key]));
		$_POST[$key] = str_replace('../','',str_replace('\r','',$_POST[$key]));
		$_POST[$key] = str_replace('./','',str_replace('\r','',$_POST[$key]));
		$_POST[$key] = str_replace('...\\','',str_replace('\r','',$_POST[$key]));
		$_POST[$key] = str_replace('..\\','',str_replace('\r','',$_POST[$key]));
		$_POST[$key] = str_replace('.\\','',str_replace('\r','',$_POST[$key]));
		$_POST[$key] = str_replace('\r','',$_POST[$key]);
		$_POST[$key] = addslashes(stripslashes(str_replace('\n','',$_POST[$key])));
		$_POST[$key] = stripslashes($_POST[$key]);
	}
}

foreach ($_GET as $key => $value) {
	if (!is_array($_GET[$key]))
	{
		//$_GET[$key] = strip_tags(str_replace('\r','',$_GET[$key]));
		$_GET[$key] = strip_tags(str_replace('prompt(','',str_replace('\r','',$_GET[$key])));
		$_GET[$key] = strip_tags(str_replace('<script>','',str_replace('\r','',$_GET[$key])));
		$_GET[$key] = strip_tags(str_replace('</script>','',str_replace('\r','',$_GET[$key])));
		$_GET[$key] = strip_tags(str_replace('alert(','',str_replace('\r','',$_GET[$key])));
		$_GET[$key] = strip_tags(str_replace('.../','',str_replace('\r','',$_GET[$key])));
		$_GET[$key] = strip_tags(str_replace('../','',str_replace('\r','',$_GET[$key])));
		$_GET[$key] = strip_tags(str_replace('./','',str_replace('\r','',$_GET[$key])));
		$_GET[$key] = strip_tags(str_replace('...\\','',str_replace('\r','',$_GET[$key])));
		$_GET[$key] = strip_tags(str_replace('..\\','',str_replace('\r','',$_GET[$key])));
		$_GET[$key] = strip_tags(str_replace('.\\','',str_replace('\r','',$_GET[$key])));
		$_GET[$key] = strip_tags(str_replace('onmouseover','',str_replace('\r','',$_GET[$key])));
		$_GET[$key] = addslashes(stripslashes(str_replace('\n','',$_GET[$key])));
		$_GET[$key] = str_replace('"','',$_GET[$key]);
		$_GET[$key] = str_replace("'",'',$_GET[$key]);
		$_GET[$key] = stripslashes($_GET[$key]);
	}
}
foreach ($_REQUEST as $key => $value) {
	if (!is_array($_REQUEST[$key]))
	{
		$_REQUEST[$key] = strip_tags(str_replace('prompt(','',str_replace('\r','',$_REQUEST[$key])));
		$_REQUEST[$key] = strip_tags(str_replace('<script>','',str_replace('\r','',$_REQUEST[$key])));
		$_REQUEST[$key] = strip_tags(str_replace('</script>','',str_replace('\r','',$_REQUEST[$key])));
		$_REQUEST[$key] = strip_tags(str_replace('alert(','',str_replace('\r','',$_REQUEST[$key])));
		$_REQUEST[$key] = strip_tags(str_replace('.../','',str_replace('\r','',$_REQUEST[$key])));
		$_REQUEST[$key] = strip_tags(str_replace('../','',str_replace('\r','',$_REQUEST[$key])));
		$_REQUEST[$key] = strip_tags(str_replace('./','',str_replace('\r','',$_REQUEST[$key])));
		$_REQUEST[$key] = strip_tags(str_replace('...\\','',str_replace('\r','',$_REQUEST[$key])));
		$_REQUEST[$key] = strip_tags(str_replace('..\\','',str_replace('\r','',$_REQUEST[$key])));
		$_REQUEST[$key] = strip_tags(str_replace('.\\','',str_replace('\r','',$_REQUEST[$key])));
		$_REQUEST[$key] = strip_tags(str_replace('onmouseover','',str_replace('\r','',$_REQUEST[$key])));
		$_REQUEST[$key] = strip_tags(str_replace('\r','',$_REQUEST[$key]));
		$_REQUEST[$key] = addslashes(stripslashes(str_replace('\n','',$_REQUEST[$key])));
		$_REQUEST[$key] = str_replace('"','',$_REQUEST[$key]);
		$_REQUEST[$key] = str_replace("'",'',$_REQUEST[$key]);
		$_REQUEST[$key] = stripslashes($_REQUEST[$key]);
	}
}

$url =	basename($_SERVER["REQUEST_URI"]);
$scrip_name =	$_SERVER["SCRIPT_NAME"];
$php_self =	$_SERVER["PHP_SELF"];
if(strpos($url,'PUT') !== false) 
{
	header("location:".$errorpage);
	exit;
}
$hostname="<DB HOST>";
$serveruser="<SERVER NAME>";
$serverpass="<DB PASSWORD>";
$databasename="<DB NAME>";

$tblpref = "c_";
//$sponsoredprice="50";
$siteuploadpath = "/possbpser/";
$uploadpath = "../common_up/botswana-police/";
$databaseuploadpath = "../common_up/botswana-police/database/";
$sitefont="Arial";
$sitefontweight="2";
$sitepath="<SITE URL/>";
$siteurl="<SITE URL/>";
$path1="<SITE URL/>";
$ckpath="/common";
$cont_page = "bps-content.php";
$rewritepath = "/";
$ip = $_SERVER['REMOTE_ADDR'];

//Google no-captcha recaptcha verification KEY
$recaptcha_secret = "6LduGSEUAAAAAIubkSm9d9cmCB813NUNN369pcSE";
$recaptcha_site = "6LduGSEUAAAAAN5SqYdD2iGVAif7baGDBrwF3JUp";


if(!$connection = mysqli_connect($hostname, $serveruser, $serverpass, $databasename))
	echo mysqli_connect_errno();

	    $createdatabase ="CREATE DATABASE IF NOT EXISTS ". $databasename;
		if (!($resadmin = mysqli_query($connection, $createdatabase))) { echo "FOR QUERY: $createdatabase<BR>".mysqli_connect_errno(); 	exit;}
/*    
if(!$db = mysqli_select_db($databasename)) 
	echo mysqli_connect_errno();*/
//Admin Table
$createadminquery = "CREATE TABLE IF NOT EXISTS ".$tblpref."admin (
`admin_id` INT( 11 ) NOT NULL AUTO_INCREMENT ,
`username` VARCHAR( 255 ) DEFAULT NULL ,
`password` VARCHAR( 255 ) DEFAULT NULL ,
`admin_email` VARCHAR( 255 ) DEFAULT NULL ,
`admin_name` VARCHAR( 255 ) DEFAULT NULL ,
`admin_type` VARCHAR( 255 ) DEFAULT NULL ,
`user_type` VARCHAR( 255 ) DEFAULT NULL ,
`logincount` INT( 11 ) DEFAULT NULL ,
`a_date` DATE DEFAULT NULL ,
`admin_mgmts` LONGTEXT DEFAULT NULL ,
PRIMARY KEY ( `admin_id` )
) ENGINE = MYISAM ";

if (!($resadmin = mysqli_query($connection, $createadminquery))) 
{ echo "FOR QUERY: $createadminquery<BR>".mysqli_connect_errno(); 	exit;}

//Admin log
$createadlogtable = "CREATE TABLE IF NOT EXISTS ".$tblpref."login_log  (
`log_id`  int(11) NOT NULL AUTO_INCREMENT,
`log_uid`  int(11) DEFAULT NULL,
`log_date`  date DEFAULT NULL,
`log_time` time DEFAULT NULL,
 PRIMARY KEY (`log_id`)
) ENGINE = InnoDB DEFAULT CHARSET=latin1";

if (!($resadlogtable = mysqli_query($connection, $createadlogtable))) 
{ echo "FOR QUERY: $createadlogtable<BR>".mysqli_connect_errno(); 	exit;}


//admin access

$createadaccesstable="CREATE TABLE IF NOT EXISTS ".$tblpref."admin_access (
  `acc_id` int(11) NOT NULL AUTO_INCREMENT,
  `acc_user` int(11) DEFAULT NULL,
  `acc_moduel` int(11) DEFAULT NULL,
  `acc_per` int(11) DEFAULT NULL,
  PRIMARY KEY (`acc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

if (!($resadaccesstable = mysqli_query($connection, $createadaccesstable))) 
{ echo "FOR QUERY: $createadaccesstable<BR>".mysqli_connect_errno(); 	exit;}



//Dashboard Table
$createdashquery = "CREATE TABLE IF NOT EXISTS ".$tblpref."dashboard_panel (
`panel_id` int(11) NOT NULL AUTO_INCREMENT,
  `panel_title` varchar(225) DEFAULT NULL,
  `panel_pos` int(11) DEFAULT NULL,
  `panel_moduel` varchar(225) DEFAULT NULL,
  PRIMARY KEY (`panel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

if (!($resdashquery = mysqli_query($connection, $createdashquery))) 
{ echo "FOR QUERY: $createdashquery<BR>".mysqli_connect_errno(); 	exit;}

//Dashboard moduel
$createmoduwlquery = "CREATE TABLE IF NOT EXISTS ".$tblpref."moduel (
`mod_id` int(11) NOT NULL AUTO_INCREMENT,
  `mod_name` varchar(255) DEFAULT NULL,
  `mod_title` varchar(255) DEFAULT NULL,
  `mod_pos` int(11) DEFAULT '0',
  `mod_panel` int(11) DEFAULT NULL,
  PRIMARY KEY (`mod_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

if (!($resmoduwlquery = mysqli_query($connection, $createmoduwlquery))) 
{ echo "FOR QUERY: $createmoduwlquery<BR>".mysqli_connect_errno(); 	exit;}

//Log Table
$createlogtable = "CREATE TABLE IF NOT EXISTS ".$tblpref."log (
`log_id` INT( 11 ) NOT NULL AUTO_INCREMENT ,
`log_admin_id` int( 20) NOT NULL ,
`log_admin_module` VARCHAR( 255 ) NOT NULL ,
`log_admin_rec_title` VARCHAR( 255 ) NOT NULL ,
`log_admin_action` VARCHAR( 255 ) NOT NULL ,
`log_admin_ip` VARCHAR( 255 ) NOT NULL ,
`log_admin_date` VARCHAR( 255 ) NOT NULL ,
`log_admin_time` VARCHAR( 255 ) NOT NULL ,
PRIMARY KEY ( `log_id` )
) ENGINE = MYISAM ";

if (!($resadmin = mysqli_query($connection, $createlogtable))) 
{ echo "FOR QUERY: $createlogtable<BR>".mysqli_connect_errno(); 	exit;}

//Token Table
$createtokentable = "CREATE TABLE IF NOT EXISTS ".$tblpref."userval  (
`session_val` LONGTEXT,
`hash_val` LONGTEXT,
`session_date` date
) ENGINE = MYISAM ";

if (!($restoken = mysqli_query($connection, $createtokentable))) 
{ echo "FOR QUERY: $createtokentable<BR>".mysqli_connect_errno(); 	exit;}

$seladmin=sprintf("SELECT * FROM ".$tblpref."admin");
if(!($res_admin = mysqli_query($connection, $seladmin)))
{
		echo $seladmin."<br>Error: ".mysqli_connect_errno()."<br>File: ".__FILE__."<br>Line: ".__LINE__;	;
		exit();
}
$cnt_admin = mysqli_num_rows($res_admin);
if($cnt_admin<=0)
{
		$insquery=sprintf("INSERT INTO ".$tblpref."admin SET username='admin', password='90b9aa7e25f80cf4f64e990b78a9fc5ebd6cecad', admin_email='admin@weblogic.co.bw', admin_name='Site Administrator', admin_type='main', user_type='superadmin', logincount='0', admin_mgmts='',a_date=CURDATE()");
		if(!($res_admin_rec = mysqli_query($connection, $insquery)))
		{
				echo $insquery."<br>Error: ".mysqli_connect_errno()."<br>File: ".__FILE__."<br>Line: ".__LINE__;	;
				exit();
		}
}

if($_SESSION['username']!="")
{
	$username = $_SESSION['username'];
	$query_admin = sprintf("select * from ".$tblpref."admin where username='%s'", $username);
	if(!($result_admin = mysqli_query($connection, $query_admin))) {  echo $query_admin.mysqli_connect_errno();   exit(); }
	$row_admin = mysqli_fetch_array($result_admin);

}

?>