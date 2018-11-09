<?php
$get_url = $_SERVER["REQUEST_URI"];
//echo basename($_SERVER['REQUEST_URI']);
$url_parameters = explode('/',$get_url);
$para=2;
$function_is = $url_parameters[$para] ; //$url_parameters[1] 
for ($i=$para;$i<count($url_parameters);$i++)
{
	$key = $url_parameters[$i+1];
	$val = $url_parameters[$i+2];
	if(	$key  != "" && $val != "" )
	{
		$pos = strpos($val,"?");
		if ($pos!==false && $pos==0)
		{
			$get_arr = explode("&",substr($val, 1));     
			for($j=0;$j<count($get_arr);$j++)
			{
				$each_arr = explode("=",$get_arr[$j]);
				$key = $each_arr [0];
				$val = $each_arr [1];

				$_GET[$key] = $val; //$_GET['id']=$id;
			}
		}
		else
		{
			$_GET[$key] = $val; //$_GET['id']=$id;
		}
	}
	$i++;
}

switch ($function_is) 
{
	case "":
		$new_redir_url = "";
		break;
	case "home":
		$new_redir_url = "";
		break;
	case "bps-content":
		$new_redir_url = "content.php";
		break;
	case "bps-gallery":
		$new_redir_url = "gallery.php";
		break;
	case "bps-gallery-details":
		$new_redir_url = "gallery-details.php";
		break;
	case "bps-publication":
		$new_redir_url = "publication.php";
		break;
	case "bps-news":
		$new_redir_url = "news.php";
		break;
	case "bps-news-details":
		$new_redir_url = "news-details.php";
		break;
	case "bps-events":
		$new_redir_url = "events.php";
		break;
	case "bps-events-details":
		$new_redir_url = "events-details.php";
		break;
	case "bps-property":
		$new_redir_url = "property.php";
		break;
	case "bps-property-details":
		$new_redir_url = "property-details.php";
		break;
	case "bps-feedback-misconduct":
		$new_redir_url = "feedback-misconduct.php";
		break;
	case "submit-feedback-misconduct":
		$new_redir_url = "submit-feedback-misconduct.php";
		break;
	case "bps-police-misconduct":
		$new_redir_url = "police-misconduct.php";
		break;
	case "submit-police-misconduct":
		$new_redir_url = "submit-police-misconduct.php";
		break;
	case "bps-customer-satisfaction":
		$new_redir_url = "customer-satisfaction.php";
		break;
	case "submit-customer-satisfaction":
		$new_redir_url = "submit-customer-satisfaction.php";
		break;
	case "bps-contacts":
		$new_redir_url = "contacts.php";
		break;
	case "submit":
		$new_redir_url = "submit.php";
		break;
	case "success":
		$new_redir_url = "success.php";
		break;
	case "bps-faq":
		$new_redir_url = "faq.php";
		break;
	case "bps-police-stations":
		$new_redir_url = "police-stations.php";
		break;
	case "bps-police-stations-detail":
		$new_redir_url = "police-stations-detail.php";
		break;
	case "bps-nearest-police":
		$new_redir_url = "nearest-police.php";
		break;
	case "submit-nearest":
		$new_redir_url = "submit-nearest.php";
		break;
	case "site-search":
		$new_redir_url = "site-search.php";
		break;
	case "submit-search":
		$new_redir_url = "submit-search.php";
		break;
	default:
		$new_redir_url = "error.php"; 
		break;
	}
//echo $new_redir_url; exit;
if ($new_redir_url != "")
{
	require($new_redir_url);
	exit;
}

?>