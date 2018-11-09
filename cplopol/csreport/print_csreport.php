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
		 $query=sprintf("select * from ".$tblpref."cust_satisfaction where cs_id='%d'",$_GET[id]);
		if(!($result=mysqli_query($connection,$query))){ echo " QUERY - ".$query." <br /> ERROR - ".mysqli_errno($connection); exit;}
		$row=mysqli_fetch_array($result);
?>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2"><p align="left"><b>Customer Satisfaction Report </b></p></td>
    </tr>
    <tr>
      <td colspan="2"><p class="text2" align="center" style="border-bottom:2px solid #d42329; display:block;"></p></td>
    </tr>
    
	<tr>
	<td colspan="2">
	 <table width="100%" cellspacing="0" cellpadding="0" border="0" align="left">
<tbody><tr>
	<td>
        <div><h3>NATURE OF YOUR VISIT AND QUALITY OF RECEPTION</h3>
            <p><strong>1. What was the nature of your visit?  (Please use a tick mark to indicate the nature of your visit.)</strong></p>
        </div>
	</td>
</tr>

<tr>
	<td>
    	<table width="63%" cellpadding="0" border="1" align="right" class="black1" style="text-align: left; border-collapse:collapse;" bordercolor="#2888BB" >
        <thead>
        <tr>
            <th>Victim</th>
            <th>Complainant</th>
            <th>Witness</th>
            <th>Accused/Suspect</th>
            <th>Other</th>
        </tr>
        </thead>
        <tbody><tr class="white">
            <td align="center">
			<? if($row[cs_nature_visit ]=="Victim") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
			<td  align="center">
            <? if($row[cs_nature_visit ]=="Complainant") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
			<td  align="center">
            <? if($row[cs_nature_visit ]=="Witness") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
			<td  align="center">
            <? if($row[cs_nature_visit ]=="Accused/Suspect") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
			<td  align="center">
            <? if($row[cs_nature_visit ]=="Other") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
        </tr>
        </tbody></table>
    </td>
</tr>
<tr>
	<td>
        <div>
            <p><strong>2. How satisfied were you with:   (Please use a tick mark to indicate your rating)</strong></p>
        </div>
	</td>
</tr>

<tr>
	<td>
    	<table width="100%"  border="1" align="right" class="black1" style="text-align: left; border-collapse:collapse;" bordercolor="#2888BB" >
        <thead>
        <tr>
            <th>&nbsp;</th>
            <th>Very satisfied</th>
            <th>Satisfied</th>
            <th>Dissatisfied</th>
            <th>Very dissatisfied</th>
        </tr>
        </thead>
        <tbody><tr class="white">
            <td>Directions to the relevant office</td>
            <td align="center"><? if($row[cs_sat_direct_rel]=="Very satisfied") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td align="center"><? if($row[cs_sat_direct_rel]=="Satisfied") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td align="center"><? if($row[cs_sat_direct_rel]=="Dissatisfied") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td align="center"><? if($row[cs_sat_direct_rel]=="Very dissatisfied") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
        </tr>
        <tr class="white">
            <td>Office cleanliness</td>
           <td align="center"><? if($row[cs_sat_off_clean]=="Very satisfied") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td align="center"><? if($row[cs_sat_off_clean]=="Satisfied") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td align="center"><? if($row[cs_sat_off_clean]=="Dissatisfied") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td align="center"><? if($row[cs_sat_off_clean]=="Very dissatisfied") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
        </tr>
        <tr class="white">
            <td>Reception upon arrival</td>
           <td align="center"><? if($row[cs_sat_recept]=="Very satisfied") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td align="center"><? if($row[cs_sat_recept]=="Satisfied") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td align="center"><? if($row[cs_sat_recept]=="Dissatisfied") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td align="center"><? if($row[cs_sat_recept]=="Very dissatisfied") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
        </tr>
        <tr class="white">
            <td>Waiting time</td>
            <td align="center"><? if($row[cs_sat_wait_time]=="Very satisfied") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td align="center"><? if($row[cs_sat_wait_time]=="Satisfied") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td align="center"><? if($row[cs_sat_wait_time]=="Dissatisfied") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td align="center"><? if($row[cs_sat_wait_time]=="Very dissatisfied") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
        </tr>
        </tbody></table>
    </td>
</tr>
<tr>
	<td>
        <div><h3>TREATMENT BY POLICE STAFF</h3>
            <p><strong>3. Please think about how you were treated by the police officers and other staff who dealt with you and give an overall impression of how you were treated. Did they: (Please use a tick mark to indicate your rating)</strong></p>
        </div>
	</td>
</tr>
<tr>
	<td>
    	<table width="100%" cellspacing="1" cellpadding="0"  border="1" align="right" class="black1" style="text-align: left; border-collapse:collapse;" bordercolor="#2888BB" >
        <thead>
        <tr>
            <th>&nbsp;</th>
            <th>Excellent</th>
            <th>Good</th>
            <th>Fair</th>
            <th>Poor</th>
            <th>Very Poor</th>
        </tr>
        </thead>
        <tbody><tr class="white">
            <td>Listen to what you had to say?</td>
            <td align="center"><? if($row[cs_treat_listen]=="Excellent") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td align="center"><? if($row[cs_treat_listen]=="Good") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td align="center"><? if($row[cs_treat_listen]=="Fair") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td align="center"><? if($row[cs_treat_listen]=="Poor") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td align="center"><? if($row[cs_treat_listen]=="Very Poor") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
        </tr>
        <tr class="white">
            <td>Treat you courteously?</td>
             <td align="center"><? if($row[cs_treat_courteously]=="Excellent") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td align="center"><? if($row[cs_treat_courteously]=="Good") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td align="center"><? if($row[cs_treat_courteously]=="Fair") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td align="center"><? if($row[cs_treat_courteously]=="Poor") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td align="center"><? if($row[cs_treat_courteously]=="Very Poor") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
        </tr>
        <tr class="white">
            <td>Appreciate the need for confidentiality?</td>
             <td align="center"><? if($row[cs_treat_appre]=="Excellent") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td align="center"><? if($row[cs_treat_appre]=="Good") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td align="center"><? if($row[cs_treat_appre]=="Fair") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td align="center"><? if($row[cs_treat_appre]=="Poor") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td align="center"><? if($row[cs_treat_appre]=="Very Poor") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
        </tr>
        <tr class="white">
            <td>Display knowledge of the product?</td>
             <td align="center"><? if($row[cs_treat_know_prod]=="Excellent") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td align="center"><? if($row[cs_treat_know_prod]=="Good") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td align="center"><? if($row[cs_treat_know_prod]=="Fair") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td align="center"><? if($row[cs_treat_know_prod]=="Poor") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td align="center"><? if($row[cs_treat_know_prod]=="Very Poor") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
        </tr>
        </tbody></table>
    </td>
</tr>
<tr>
	<td>
        <div><h3>POLICE ACTIONS TO DEAL WITH THE INCIDENT</h3>
            <p><strong>4. Please think about the actions taken by the police officers and staff who dealt with your incident once they had been given the initial details. Did they: (Please use a tick mark to indicate your rating)</strong></p>
        </div>
	</td>
</tr>

<tr>
	<td>
    	<table width="100%" cellspacing="1" cellpadding="0"  border="1" align="right" class="black1" style="text-align: left; border-collapse:collapse;" bordercolor="#2888BB" >
        <thead>
        <tr>
            <th>&nbsp;</th>
            <th>Yes</th>
            <th>No</th>
            <th>N/A</th>
        </tr>
        </thead>
        <tbody><tr class="white">
            <td >Try to discourage you from reporting the incident</td>
            <td  align="center"><? if($row[cs_incid_discourage]=="Yes") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td  align="center"><? if($row[cs_incid_discourage]=="No") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td  align="center"><? if($row[cs_incid_discourage]=="N/A") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
        </tr>
        <tr class="white">
            <td>Explain what was going to happen?</td>
            <td  align="center"><? if($row[cs_incid_happen]=="Yes") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td  align="center"><? if($row[cs_incid_happen]=="No") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td  align="center"><? if($row[cs_incid_happen]=="N/A") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
        </tr>
        <tr class="white">
            <td>Offer to give you feedback within a reasonable time?</td>
            <td  align="center"><? if($row[cs_incid_offer]=="Yes") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td align="center"><? if($row[cs_incid_offer]=="No") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td align="center"><? if($row[cs_incid_offer]=="N/A") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
        </tr>
        <tr class="white">
            <td>Provide you with contact details for someone dealing with your case?</td>
             <td align="center"><? if($row[cs_incid_contact]=="Yes") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td align="center"><? if($row[cs_incid_contact]=="No") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td align="center"><? if($row[cs_incid_contact]=="N/A") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
        </tr>
        </tbody></table>
    </td>
</tr>

<tr>
	<td>
        <div>
            <p><strong>5. Overall, how satisfied were you with the service: (Please use a tick mark to indicate your rating)</strong></p>
        </div>
	</td>
</tr>
<tr>
	<td>
    	<table width="63%" cellspacing="1" cellpadding="0" border="1" align="right" class="black1" style="text-align: left; border-collapse:collapse;" bordercolor="#2888BB" >
        <thead>
        <tr>
            <th>Very satisfied</th>
            <th>Satisfied</th>
            <th>Dissatisfied</th>
            <th>Very dissatisfied</th>
        </tr>
        </thead>
        <tbody><tr class="white">
            <td align="center"><? if($row[cs_service_sat]=="Very satisfied") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td align="center"><? if($row[cs_service_sat]=="Satisfied") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td align="center"><? if($row[cs_service_sat]=="Dissatisfied") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td align="center"><? if($row[cs_service_sat]=="Very dissatisfied") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
        </tr>
        </tbody></table>
    </td>
</tr>

<tr>
	<td>
    	<table width="100%" cellspacing="0" cellpadding="0" border="0" 0="">
        <tbody><tr>
        	<td><p><strong>6. How can we improve police services in the future?</strong></p></td>
        </tr>
        <tr>
        	<td><?=$row[cs_improve_ser]?></td>
        </tr>
        </tbody></table>
    </td>
</tr>

<tr>
    <td>
    	<table width="100%" cellspacing="1" cellpadding="0" border="0">
        <tbody><tr>
        <td colspan="2">
        <h3>QUESTIONS ABOUT YOU</h3>
        <p><strong>The following details enable us to monitor any differences in satisfaction between groups of people.</strong></p>
	</td>
    </tr>
        <tr>
        	<td>1.	Are you ?   <strong><?=$row[cs_gender]?></strong></td>
            <td></td>
        </tr>
        <tr>
        <td colspan="2">
        	<p><strong>2. What is your age group?</strong></p>
		</td>
        </tr>
		<tr>
		
        <tr>
            <td colspan="2">
			<table width="100%" cellspacing="1" cellpadding="0" border="1" align="right" class="black1" style="text-align: left; border-collapse:collapse;" bordercolor="#2888BB" >
			<thead>
				<tr>
					<th>Under 16</th>
					<th>16-24</th>
					<th>25-34</th>
					<th>35-44</th>
					<th>45-54</th>
					<th>55-64</th>
					<th>65-74</th>
					<th>75 and over</th>
				</tr>
			</thead>
			<tr>
                <td  align="center"><? if($row[cs_age_grp]=="Under 16") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
                <td  align="center"><? if($row[cs_age_grp]=="16-24") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
				<td align="center"><? if($row[cs_age_grp]=="25-34") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
				<td align="center"><? if($row[cs_age_grp]=="35-44") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
				<td align="center"><? if($row[cs_age_grp]=="45-54") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
				<td align="center"><? if($row[cs_age_grp]=="55-64") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
				<td align="center"><? if($row[cs_age_grp]=="65-74") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
				<td align="center"><? if($row[cs_age_grp]=="75 and over") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
			</tr>
			</table>
            </td>
        </tr>

        <tr>
            <td colspan="2">
            	<table width="100%" cellspacing="0" cellpadding="0" border="0">
                <tbody><tr>
                	<td style="width: 50%; text-align: left; padding: 4px 0pt;">3. What is your nationality?<font color="#ff0000">*</font></td>
            		<td align="left"><?=$row[cs_nationality]?></td>
                </tr>
                <tr>
                	<td style="width: 50%; text-align: left; padding: 4px 0pt;">4. What is your Name?<font color="#ff0000">*</font></td>
            		<td align="left"><?=$row[cs_name]?></td>
                </tr>
                <tr>
                	<td style="width: 50%; text-align: left; padding: 4px 0pt;">5. What is your Email Id?<font color="#ff0000">*</font></td>
            		<td align="left"><?=$row[cs_email]?></td>
                </tr>
                <tr>
                	<td style="width: 50%; text-align: left; padding: 4px 0pt;">6. What is your contact phone number?<font color="#ff0000">*</font></td>
            		<td align="left"><?=$row[cs_tel]?></td>
                </tr>
				<tr><td>&nbsp;</td></tr>
                </tbody></table>
            </td>
        </tr>
        
        </tbody></table>
    </td>
</tr>

</tbody></table>
  </TD>
  
  </TR>
  
  <tr>
    <td>&nbsp;</td>
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
</table>
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