<?php 
session_start();

if($_SESSION[username]=="")
{
	header("Location:../../index.php?flag=invalid");
	exit;
}

include("../../common/cploconfig.php");
include("../../common/app_function.php");

?>

<!-- <style>
body {
	background:url(../../images/admin-bg.gif);
	background-repeat:repeat-x;
	margin-top:0;
}
</style> -->
<link href="../../css/master.css" rel="stylesheet" type="text/css">
<body onload="window.print();">

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="background:url(../../images/admin-bg.gif); background-repeat:repeat-x;padding-left:10px;">

<div class="centertext">

<br />

	<table align='center' border="0" cellspacing="0" cellpadding="3" width="60%">

		<tr>
			<td align="left" valign="top">
				<img src="../../images/BPS-Logo.jpg" alt="logo" />
			</td>
			<td align="center" valign="middel" colspan="2" style="padding-right: 70px;">
				<h2>Botswana Poloce Service</h2>
			</td>
		</tr>
	
        <tr>
			<td align="left" valign="top" colspan="3">
          <div>
       

<?php
		 $query=sprintf("select * from ".$tblpref."feedback_commend where fc_id='%d'",$_GET[id]);
		if(!($result=mysqli_query($connection,$query))){ echo " QUERY - ".$query." <br /> ERROR - ".mysqli_errno($connection); exit;}
		$row=mysqli_fetch_array($result);
?>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2"><p align="left"><b>Police Misconduct Report</b></p></td>
    </tr>
    <tr>
      <td colspan="2"><p class="text2" align="center" style="border-bottom:2px solid #d42329; display:block;"></p></td>
    </tr>
    <tr>
      <td align="left" valign="top">Reporter Name  :</td>
      <td align="left"><?php echo stripslashes($row[fc_name]);?></td>
    </tr>
    <tr>
      <td colspan="2" valign="top" style="border-bottom:1px dotted #000000;"></td>
    </tr>
	<tr>
      <td align="left" valign="top">Tel No :</td>
      <td align="left"><?=$row[fc_contact_no]?></td>
    </tr>
	<tr>
      <td colspan="2" valign="top" style="border-bottom:1px dotted #000000;"></td>
    </tr>
	<tr>
      <td align="left" valign="top">Email Id :</td>
      <td align="left"><?=stripslashes($row[fc_email])?></td>
    </tr>
	<tr>
      <td colspan="2" valign="top" style="border-bottom:1px dotted #000000;"></td>
    </tr>
	<tr>
      <td align="left" valign="top">Reporter IP Address :</td>
      <td align="left"><?=stripslashes($row[fc_ip])?></td>
    </tr>
	<tr>
      <td colspan="2" valign="top" style="border-bottom:1px dotted #000000;"></td>
    </tr>
	<tr>
      <td align="left" valign="top">Reporting on :</td>
      <td align="left"><?=stripslashes($row[fc_reporting_on])?></td>
    </tr>
	<tr>
      <td colspan="2" valign="top" style="border-bottom:1px dotted #000000;"></td>
    </tr>
	<tr>
      <td align="left" valign="top">Date of misconduct :</td>
      <td align="left"><?=stripslashes($row[fc_date])?></td>
    </tr>
	<tr>
      <td colspan="2" valign="top" style="border-bottom:1px dotted #000000;"></td>
    </tr>
	<tr>
      <td align="left" valign="top">Time of misconduct :</td>
      <td align="left"><? echo $date1[1]." ".$row[fc_timeset];?></td>
    </tr>
	<tr>
      <td colspan="2" valign="top" style="border-bottom:1px dotted #000000;"></td>
    </tr>
	<tr>
      <td align="left" valign="top">Location of misconduct :</td>
      <td align="left"><?=stripslashes($row[fc_loc_contact])?></td>
    </tr>
	<tr>
      <td colspan="2" valign="top" style="border-bottom:1px dotted #000000;"></td>
    </tr>
	<tr>
      <td align="left" valign="top">Name (Employee / Station or leader of group):</td>
      <td align="left"><?=stripslashes($row[fc_emp])?></td>
    </tr>
	<tr>
      <td colspan="2" valign="top" style="border-bottom:1px dotted #000000;"></td>
    </tr>
	<tr>
      <td align="left" valign="top">What initiated his/her contact with the Police ? :</td>
      <td align="left">
			<table width="100%" cellspacing="0" cellpadding="0">
			<? 
			$queryinit="select * from ".$tblpref."intiat_contact where int_fc_id='$_GET[id]'"; 
			if(!($resultinit=mysqli_query($connection,$queryinit))){ echo $queryinit.mysqli_errno($connection); exit;}
			while($rowinit=mysqli_fetch_array($resultinit)) 
			{ 
			?>
			<tr><td width="20px"><img src="../../images/tick.jpg" alt=""></td><td><?=$rowinit[int_answer]?></td></tr>
			<? } ?>
			</table>
			</td>
    </tr>
	<?if($row[fc_other]!=""){?>
	<tr>
      <td align="left" valign="top">Other :</td>
      <td align="left"><?=stripslashes($row[fc_other])?></td>
    </tr>
	<tr>
      <td colspan="2" valign="top" style="border-bottom:1px dotted #000000;"></td>
    </tr>
	<? } ?>
	<tr>
      <td align="left" valign="top">Report :</td>
      <td align="left"><?=stripslashes($row[fc_report])?></td>
    </tr>
	<tr>
      <td colspan="2" valign="top" style="border-bottom:1px dotted #000000;"></td>
    </tr>
	<tr>
      <td colspan="2" valign="top" style="border-bottom:1px dotted #000000;"></td>
    </tr>
	<tr>
      <td colspan="2" valign="top" style="border-bottom:1px dotted #000000;"></td>
    </tr>
	<tr>
          <TD align="left" valign="top" colspan="2">Received by ________________________________________________________________________</TD>
    </tr>
	<tr>
      <td colspan="2" valign="top" style="border-bottom:1px dotted #000000;"></td>
    </tr>
	<tr>
      <td colspan="2" valign="top" style="border-bottom:1px dotted #000000;"></td>
    </tr>
	<tr>
          <TD align="left" valign="top" colspan="2">Officer Making acknowledgement ________________________________________________________</TD>
    </tr>
	<tr>
      <td colspan="2" valign="top" style="border-bottom:1px dotted #000000;"></td>
    </tr>
	<tr>
      <td colspan="2" valign="top" style="border-bottom:1px dotted #000000;"></td>
    </tr>
	<tr>
          <TD align="left" valign="top" colspan="2">Date and Time Dispatched _____________________________________________________________</TD>
    </tr>
	<tr>
      <td colspan="2" valign="top" style="border-bottom:1px dotted #000000;"></td>
    </tr>
	<tr>
      <td colspan="2" valign="top" style="border-bottom:1px dotted #000000;"></td>
    </tr>
	<tr>
          <TD align="left" valign="top" colspan="2">Name and Contact of Officer assigned  ____________________________________________________</td>
	</tr>
	<tr>
      <td colspan="2" valign="top" style="border-bottom:1px dotted #000000;"></td>
    </tr>
	<tr>
		<td colspan="2"> __________________________________________________________________________________</TD>
    </tr>
	<tr>
      <td colspan="2" valign="top" style="border-bottom:1px dotted #000000;"></td>
    </tr>
	<tr>
      <td colspan="2" valign="top" style="border-bottom:1px dotted #000000;"></td>
    </tr>
	<tr>
          <TD align="left" valign="top" colspan="2">Date and Time Feedback given _________________________________________________________</TD>
    </tr>
	<tr>
      <td colspan="2" valign="top" style="border-bottom:1px dotted #000000;"></td>
    </tr>
	<tr>
      <td colspan="2" valign="top" style="border-bottom:1px dotted #000000;"></td>
    </tr>
	<tr>
          <TD align="left" valign="top" colspan="2">Person making feedback ______________________________________________________________</TD>
    </tr>
	<tr>
      <td colspan="2" valign="top" style="border-bottom:1px dotted #000000;"></td>
    </tr>
	
	


     <tr>
      <td colspan="2" align="right" height="60">&nbsp;
			<img src="../../images/printButton.jpg">
			<a class="red" href="#" onclick="window.print();">PRINT</a>

       </td>
	  </tr>

      </table></td>
    </tr>
     </table>
</form>
            </div>
           
            </td>
        </tr>
		<tr>
			<td align="center" valign="top" colspan="2">&nbsp;</td>
	  </tr>
		
	</table>
</div>

</td>
</tr>
</table>

</body>