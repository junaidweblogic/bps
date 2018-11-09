<?php 
function expiredTime($expdate){
       $temp1=explode(" ",$expdate);
       $temp=explode("-",$temp1[0]);
       $year = $temp[0];
       $month= $temp[1];
       $day = $temp[2];
       $hour = '00';
       $minute = '00';
       $second = '00';
       list($dl,$hl,$ml,$sl) = countdown($year, $month, $day, $hour,$minute, $second);
       return $dl."days ". $hl."hr ".$ml."min ".$sl."sec";
}

 function countdown($year, $month, $day, $hour, $minute, $second)
               {
                 global $return;
                 global $countdown_date;
                 $countdown_date = mktime($hour, $minute, $second, $month, $day, $year);
                $today = time();
				//$today = date("Y-m-d H:i:s");
                $diff = $countdown_date - $today;
                 if ($diff < 0)$diff = 0;
                 $dl = floor($diff/60/60/24);
                 $hl = floor(($diff - $dl*60*60*24)/60/60);
                 $ml = floor(($diff - $dl*60*60*24 - $hl*60*60)/60);
                 $sl = floor(($diff - $dl*60*60*24 - $hl*60*60 - $ml*60));
               // OUTPUT
               $return = array($dl, $hl, $ml, $sl);
               return $return;
               }

  function dateTimeDiff($data_ref){

$current_date	= date('Y-m-d H:i:s');

// Extract $current_date
$current_year		= substr($current_date,0,4);	
$current_month		= substr($current_date,5,2);
$current_day		= substr($current_date,8,2);

// Extract $data_ref
$ref_year		= substr($data_ref,0,4);	
$ref_month		= substr($data_ref,5,2);
$ref_day		= substr($data_ref,8,2);

// create a string like 20071021
$tempMaxDate		=	$current_year . $current_month .  $current_day;
$tempDataRef		=	$ref_year . $ref_month . $ref_day;

$tempDifference		= 	$tempMaxDate-$tempDataRef;

if($tempDifference >= 10){
	echo $data_ref;
	} else {
	// Extract $current_date H:m:ss
	$current_hour		= substr($current_date,11,2);
	$current_min		= substr($current_date,14,2);
	$current_seconds	= substr($current_date,17,2);
	// Extract $data_ref Date H:m:ss
	$ref_hour			= substr($data_ref,11,2);
	$ref_min			= substr($data_ref,14,2);
	$ref_seconds		= substr($data_ref,17,2);
	
	$dDf		=	$current_day-$ref_day;
	$hDf		=	$current_hour-$ref_hour;
	$mDf		=	$current_min-$ref_min;
	$sDf		=	$current_seconds-$ref_seconds;
			
	if($dDf<1){
		// Hours
		if($hDf>0){
			if($mDf<0){
				$mDf	=	60 + $mDf;
				$hDf	= $hDf -1;
				//echo $hDf. ' hr ' . $mDf . ' min ago';
			} else {
				//echo $mDf .' min ago';
			}
		} else {
			if($mDf>0){
				//echo $mDf . ' min ' . $sDf . ' sec ago';
			} else {
				//echo $sDf . ' sec ago';
			}
		}
	} else {
		echo $dDf . ' days ago';
	}
	}
}

function differencedate($expdate) {
	
	 $temp1=explode(" ",$expdate);
	 $temp=explode("-",$temp1[0]);
	 $year = $temp[0];
	 $month= $temp[1];
	 $day = $temp[2];
	 $temp = explode(":",$temp1[1]);
	 $hour = $temp[0];
	 $minute = $temp[1];
	 $second = $temp[2];

	$century = mktime($hour, $minute, $second, $month, $day, $year); //this is for previous time
	$today = time(); //this is for current time
	$difference = $today - $century;
	//echo 'This century started';
	echo floor($difference / 84600);
	$difference -= 84600 * floor($difference / 84600);
	echo ' Days ';
	echo floor($difference / 3600);
	$difference -= 3600 * floor($difference / 3600);
	echo ' Hours ';
	echo floor($difference / 60);
	//$difference -= 60 * floor($difference / 60);
	echo " Minutes Old.";
}

function differencedate1($expdate) {
	
	 $temp1=explode(" ",$expdate);
	 $temp=explode("-",$temp1[0]);
	 $year = $temp[0];
	 $month= $temp[1];
	 $day = $temp[2];
	 $temp = explode(":",$temp1[1]);
	 $hour = $temp[0];
	 $minute = $temp[1];
	 $second = $temp[2];

	$century = mktime($hour, $minute, $second, $month, $day, $year); //this is for previous time
	$today = time(); //this is for current time
	$difference = $today - $century;
	//echo 'This century started';
	$days = floor($difference / 84600);
	//$difference -= 84600 * floor($difference / 84600);
	if($days == 0 || $days == "0")
		echo "Today ";
	else 
		echo $days . ' day(s) ago ';
	//echo floor($difference / 3600);
	//$difference -= 3600 * floor($difference / 3600);
	//echo ' hours, ';
	//echo floor($difference / 60);
	//$difference -= 60 * floor($difference / 60);
	//echo " minutes and $difference seconds ago.";
}
?>
