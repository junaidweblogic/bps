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
		 $query=sprintf("select * from ".$tblpref."askpolice where ap_id='%d'",$_GET[id]);
		if(!($result=mysqli_query($connection,$query))){ echo " QUERY - ".$query." <br /> ERROR - ".mysqli_connect_errno(); exit;}
		$row=mysqli_fetch_array($result);
?>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2"><p align="left"><b>Police Report </b></p></td>
    </tr>
    <tr>
      <td colspan="2"><p class="text2" align="center" style="border-bottom:2px solid #d42329; display:block;"></p></td>
    </tr>
    <tr>
      <td align="left" valign="top">Reporter Name  :</td>
      <td align="left"><?php echo stripslashes($row[ap_name]);?></td>
    </tr>
    <tr>
      <td colspan="2" valign="top" style="border-bottom:1px dotted #000000;"></td>
    </tr>
	<tr>
      <td align="left" valign="top">Tel No :</td>
      <td align="left"><?=$row[ap_tel]?></td>
    </tr>
	<tr>
      <td colspan="2" valign="top" style="border-bottom:1px dotted #000000;"></td>
    </tr>
	<tr>
      <td align="left" valign="top">Email Id :</td>
      <td align="left"><?=stripslashes($row[ap_email])?></td>
    </tr>
	<tr>
      <td colspan="2" valign="top" style="border-bottom:1px dotted #000000;"></td>
    </tr>
	<tr>
      <td align="left" valign="top">Ask the Police :</td>
      <td align="left"><?=stripslashes($row[ap_askpolice])?></td>
    </tr>
	<tr>
      <td colspan="2" valign="top" style="border-bottom:1px dotted #000000;"></td>
    </tr>
	<tr>
      <td align="left" valign="top">Person IP Address :</td>
      <td align="left"><?=stripslashes($row[ap_ip])?></td>
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