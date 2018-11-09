<?php
include("common/config.php");
$get_url = $_SERVER["REQUEST_URI"];
$ch=array( "=" , "&");
$get_url = str_replace( $ch , "/", $get_url);
$get_url = str_replace( "?" , "", $get_url);
$get_url = $get_url."/";
$get_url = str_replace( "submit-nearest" , "bps-nearest-police", $get_url);

header("Location: ".$get_url);
exit;
?>