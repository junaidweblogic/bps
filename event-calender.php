<?php
//include("common/app_function.php");
include("common/config.php");
@session_start();

if(isset($_GET['time']))
	$time = $_GET['time'];
else
	$time = @time();

$today = @date("Y/n/j", @time());
$current_month = @date("n", $time);
$current_year = @date("Y", $time);
$current_month_text = @date("F Y", $time);
$total_days_of_current_month = @date("t", $time);
$events = array();

 
$query1=sprintf("SELECT DATE_FORMAT(cms_subdate,'%s%s') AS day,cms_title,cms_id FROM " . $tblpref ."content_master WHERE cms_type = 'Event' AND cms_subdate BETWEEN  '%s/%s/01' AND '%s/%s/$total_days_of_current_month'", '%', 'd', $current_year, $current_month, $current_year, $current_month);

//$query1 = sprintf("SELECT DATE_FORMAT(cms_subdate,'%s%s') AS day,cms_title,cms_id,cms_date  FROM " . $tblpref ."content_master WHERE cms_type = 'event' AND (cms_subdate BETWEEN  '%s-%s-01' AND '%s-%s-$total_days_of_current_month') $cond ", '%', 'd', $current_year, $current_month, $current_year,  $current_month );
$result = mysqli_query($connection,$query1);
while($row_event = mysqli_fetch_object($result))
{	
	
		$events[intval($row_event->day)] .= ''.$dt.'<li style="height:100%"><span><a href="'.$rewritepath.'index.php/bps-events-details/eid/'. $row_event->cms_id .'/'. $row_event->cms_title .'" >'.htmlentities(stripslashes($row_event->cms_title)).'</a></span></li>';	
	

}

$first_day_of_month = @mktime(0,0,0,$current_month,1,$current_year);

//geting Numeric representation of the day of the week for first day of the month. 0 (for Sunday) through 6 (for Saturday).
$first_w_of_month = @date("w", $first_day_of_month);

//how many rows will be in the calendar to show the dates
$total_rows = ceil(($total_days_of_current_month + $first_w_of_month)/7);

//trick to show empty cell in the first row if the month doesn't start from Sunday
$day = -$first_w_of_month;


$next_month = @mktime(0,0,0,$current_month+1,1,$current_year);
$next_month_text = @date("F \'y", $next_month);

$previous_month = @mktime(0,0,0,$current_month-1,1,$current_year);
$previous_month_text = @date("F \'y", $previous_month);

$next_year = @mktime(0,0,0,$current_month,1,$current_year+1);
$next_year_text = @date("F \'y", $next_year);

$previous_year = @mktime(0,0,0,$current_month,1,$current_year-1);
$previous_year_text = @date("F \'y", $previous_year);
?>

<table width="100%" border="0" cellspacing="5" cellpadding="5" >
<!--<tr>
			<td  align="center" class="black"><?=$current_month_text?></td>
</tr>-->
<tr>
<td align="left" >
	<table cellspacing="3" id="cal" border="0" cellpadding="0"  class="maintable"> 
		<thead>
        <tr>		
			<th class="callastrow2">
				<a href="<?php echo $rewritepath;?>index.php/bps-events/time/<?=$previous_year?>/<?php echo $seturl ;?>"  title="<?=$previous_year_text?>">&laquo;&laquo;</a>
			</th>
			<th class="callastrow2">
				<a href="<?php echo $rewritepath;?>index.php/bps-events/time/<?=$previous_month?>/<?php echo $seturl ;?>"
				title="<?=$previous_month_text?>"><img src="<?php echo $rewritepath;?>images/larrow.png" alt="" /></a>
			</th>
			<th class="callastrow2" colspan="3"><?=$current_month_text?></th>
			<th class="callastrow2">
				<a href="<?php echo $rewritepath;?>index.php/bps-events/time/<?=$next_month?>/<?php echo $seturl ;?>"
				title="<?=$next_month_text?>"><img src="<?php echo $rewritepath;?>images/rarrow.png" alt="" /></a>
			</th>
			<th class="callastrow2">
				<a href="<?php echo $rewritepath;?>index.php/bps-events/time/<?=$next_year?>/<?php echo $seturl ;?>" title="<?=$next_year_text?>">&raquo;&raquo;</a>
			</th>		
		</tr>
		<tr>
			<th class="monthhight">S</th>
			<th class="monthhight">M</th>
			<th class="monthhight">T</th>
			<th class="monthhight">W</th>
			<th class="monthhight">T</th>
			<th class="monthhight">F</th>
			<th class="monthhight">S</th>
		</tr>
		</thead>
		<tr>
			<?
			for($i=0; $i< $total_rows; $i++)
			{
				for($j=0; $j<7;$j++)
				{
					$day++;					
					
					if($day>0 && $day<=$total_days_of_current_month)
					{
						//YYYY-MM-DD date format
						$date_form = "$current_year/$current_month/$day";
						
						echo '<td';
						
						//check if the date is today
						if(($date_form == $today) && (!array_key_exists($day,$events)))
						{							
							echo ' class="today"';
						}
						
						
						
						//check if any event stored for the date
						if(array_key_exists($day,$events)|| ($date_form == $today))
						{
							//adding the date_has_event class to the <td> and close it
							echo ' class="date_has_event"> '.$day;
							
							//adding the eventTitle and eventContent wrapped inside <span> & <li> to <ul></div>
							echo '<div class="events">
							
							<ul>'.$events[$day].'</ul></div>';
						}
						else 
						{
							//if there is not event on that date then just close the <td> tag
							echo '> '.$day;
						}
						echo "</td>";
					}
					else 
					{
						//showing empty cells in the first and last row
						echo '<td class="padding">&nbsp;</td>';
					}
				}
				echo "</tr>";
			}
			
			?>
		
	</table>
</td></tr></table>