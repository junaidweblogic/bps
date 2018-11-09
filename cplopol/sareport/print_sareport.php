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
		 $query=sprintf("select * from ".$tblpref."susp_alleg where sa_id='%d'",$_GET[id]);
		if(!($result=mysqli_query($connection,$query))){ echo " QUERY - ".$query." <br /> ERROR - ".mysqli_errno($connection); exit;}
		$row=mysqli_fetch_array($result);
?>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2"><p align="left"><b>Crime/ Incident </b></p></td>
    </tr>
    <tr>
      <td colspan="2"><p class="text2" align="center" style="border-bottom:2px solid #d42329; display:block;"></p></td>
    </tr>
    <tr>
      <td align="left" valign="top">Reporter Name  :</td>
      <td align="left"><?php echo stripslashes($row[sa_name]);?></td>
    </tr>
    <tr>
      <td colspan="2" valign="top" style="border-bottom:1px dotted #000000;"></td>
    </tr>
	 <tr>
      <td align="left" valign="top">Reporter Address  :</td>
      <td align="left"><?php echo stripslashes($row[sa_address]);?></td>
    </tr>
	<tr>
      <td colspan="2" valign="top" style="border-bottom:1px dotted #000000;"></td>
    </tr>
	<tr>
      <td align="left" valign="top">Tel No :</td>
      <td align="left"><?=$row[sa_tel]?></td>
    </tr>
	<tr>
      <td colspan="2" valign="top" style="border-bottom:1px dotted #000000;"></td>
    </tr>
	<tr>
      <td align="left" valign="top">Email Id :</td>
      <td align="left"><?=stripslashes($row[sa_email])?></td>
    </tr>
	<tr>
      <td colspan="2" valign="top" style="border-bottom:1px dotted #000000;"></td>
    </tr>
	<tr>
      <td align="left" valign="top">Date of Report/Incident :</td>
       <TD align="left" style="padding-left:5px;"><? 
		  $date1 = explode(" ",$row[sa_datetime]); 
		  echo dateformate($date1[0]);
		  ?></TD>
    </tr>
	<tr>
      <td colspan="2" valign="top" style="border-bottom:1px dotted #000000;"></td>
    </tr>

	<tr>
      <td align="left" valign="top">Time of Report Crime/ Incident :</td>
        <TD align="left" style="padding-left:5px;"><? echo $date1[1]." ".$row[sa_timeset];?></TD>
    </tr>
	<tr>
      <td colspan="2" valign="top" style="border-bottom:1px dotted #000000;"></td>
    </tr>
	<tr>
      <TD align="left" valign="top" >Type of Report Crime/ Incident :</TD>
          <TD align="left" style="padding-left:5px;"><? echo $row[sa_typecrime];?></TD>
    </tr>
	<tr>
      <td colspan="2" valign="top" style="border-bottom:1px dotted #000000;"></td>
    </tr>
	<tr>
      <TD align="left" valign="top" >Location of Report Crime/ Incident :</TD>
          <TD align="left" style="padding-left:5px;"><? echo $row[sa_location];?></TD>
    </tr>
	<tr>
      <td colspan="2" valign="top" style="border-bottom:1px dotted #000000;"></td>
    </tr>
	<tr>
	      <TD align="left" valign="top">Report Crime/ Incident :</TD>
          <TD align="left" style="padding-left:5px;"><? echo $row[sa_crimedet];?></TD>
    </tr>
	<tr>
      <td colspan="2" valign="top" style="border-bottom:1px dotted #000000;"></td>
    </tr>
	<tr>
          <TD align="left" valign="top">Person IP Address :</FONT></TD>
          <TD align="left" style="padding-left:5px;"><?php echo stripslashes($row[sa_ip]);?></td>
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