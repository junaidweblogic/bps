<?
session_start();
include("../../common/cploconfig.php");
include("../../common/app_function.php");

if($_SESSION[username]=="")
{
	DisplayError("Login Error.","","For security of your account,we have expired your session.<br>&nbsp;Please login to your account again.", "Home,../index.php", 0);
	exit();
}
$rid = $_GET[rid];

$query="select * from ".$tblpref."cust_satisfaction where cs_id='$rid'"; 
if(!($result=mysqli_query($connection,$query))){ echo $query.mysqli_errno($connection); exit;}
$row_add=mysqli_fetch_array($result);


if($row_add[cs_status]=="New")
{
		$query = "UPDATE " . $tblpref . "cust_satisfaction SET cs_status = 'View' WHERE cs_id = '$rid'";
		if(!($result=mysqli_query($connection,$query))){ echo $query.mysqli_errno($connection); exit;}

		if($row_add[cs_email]!="")
		{
		$queryau = "SELECT * FROM " . $tblpref . "admin WHERE admin_id = '1'";
		if(!($resultau=mysqli_query($connection,$queryau))){echo $queryau.mysqli_errno($connection); exit;}
		$row_autoresp = mysqli_fetch_array($resultau);
			
		$msg = "Dear $row_add[cs_name], <br /> ";
		$msg .= "we have received your Customer Satisfaction Report and we will get back to you as soon as possible<br />";
		$msg .= "<br /> You had wrote the Customer Satisfaction Report as : <br /> $row_add[cs_improve_ser]";

		$msg .= "<br /><br /><br />Regards - <br />Administrator <br/> $sitename";
		
		$mesheader =  "From: ".$row_autoresp[admin_email]."\n" . "Reply-To: ". $row_autoresp[admin_email] . "\r\n";
		$mesheader .= "MIME-Version: 1.0\n";
		$mesheader .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
		
		@mail($row_add[cs_email],"BPS : Customer Satisfaction Report : From: $row_autoresp[a_default]",$msg,$mesheader);

		}
}

admin_header('../../','Customer Satisfaction Report ',$tblpref,$db,$sitepath,$siteurl,$path1,$ckpath,$row_admin);
?>
<!--body start -->
<div class="adminbody">
<div class="flt"><a href="../home.php"><img src="../../images/dashboard.png" alt="Home"/></a></div>
<div class="frt" style="padding-right:5px;"><a href="index.php"><img src="../../images/back32.png" alt="Back" /></a></div>
<div class="gap"></div>
<?
$flag = $_REQUEST[flag];
if($flag=="exist"){?>
<p align="center" class="error">Record is already exist.</p>
<? } ?>	   

<div class="box">
    <div class="hdr">
	<h1 class="ico-view">Edit</h1>
	<div class="rtheading">
        <h1 class="ico-cnt">Customer Satisfaction Report </h1>
    </div>
    </div> 
<div class="padtb">
     <table width="100%" border="0" cellspacing="0" cellpadding="0">
     <tr class="even">
		<td>
			<div>
				<h3>NATURE OF YOUR VISIT AND QUALITY OF RECEPTION</h3>
				<p><strong>1. What was the nature of your visit?  (Please use a tick mark to indicate the nature of your visit.)</strong></p>
				</div>
		</td>
     </tr>
     <tr>
     <td>
		<table width="100%" cellpadding="0" border="1" align="right" class="black1" style="text-align: left; border-collapse:collapse;" bordercolor="#2888BB" >
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
			<? if($row_add[cs_nature_visit ]=="Victim") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
			<td  align="center">
            <? if($row_add[cs_nature_visit ]=="Complainant") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
			<td  align="center">
            <? if($row_add[cs_nature_visit ]=="Witness") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
			<td  align="center">
            <? if($row_add[cs_nature_visit ]=="Accused/Suspect") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
			<td  align="center">
            <? if($row_add[cs_nature_visit ]=="Other") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
        </tr>
        </tbody></table>
	 </td>
     </tr>
	 <tr class="even">
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
            <td align="center"><? if($row_add[cs_sat_direct_rel]=="Very satisfied") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td align="center"><? if($row_add[cs_sat_direct_rel]=="Satisfied") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td align="center"><? if($row_add[cs_sat_direct_rel]=="Dissatisfied") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td align="center"><? if($row_add[cs_sat_direct_rel]=="Very dissatisfied") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
        </tr>
        <tr class="white">
            <td>Office cleanliness</td>
           <td align="center"><? if($row_add[cs_sat_off_clean]=="Very satisfied") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td align="center"><? if($row_add[cs_sat_off_clean]=="Satisfied") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td align="center"><? if($row_add[cs_sat_off_clean]=="Dissatisfied") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td align="center"><? if($row_add[cs_sat_off_clean]=="Very dissatisfied") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
        </tr>
        <tr class="white">
            <td>Reception upon arrival</td>
           <td align="center"><? if($row_add[cs_sat_recept]=="Very satisfied") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td align="center"><? if($row_add[cs_sat_recept]=="Satisfied") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td align="center"><? if($row_add[cs_sat_recept]=="Dissatisfied") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td align="center"><? if($row_add[cs_sat_recept]=="Very dissatisfied") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
        </tr>
        <tr class="white">
            <td>Waiting time</td>
            <td align="center"><? if($row_add[cs_sat_wait_time]=="Very satisfied") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td align="center"><? if($row_add[cs_sat_wait_time]=="Satisfied") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td align="center"><? if($row_add[cs_sat_wait_time]=="Dissatisfied") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td align="center"><? if($row_add[cs_sat_wait_time]=="Very dissatisfied") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
        </tr>
        </tbody></table>
	</td>
     </tr>
	 <tr class="even">
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
            <td align="center"><? if($row_add[cs_treat_listen]=="Excellent") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td align="center"><? if($row_add[cs_treat_listen]=="Good") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td align="center"><? if($row_add[cs_treat_listen]=="Fair") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td align="center"><? if($row_add[cs_treat_listen]=="Poor") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td align="center"><? if($row_add[cs_treat_listen]=="Very Poor") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
        </tr>
        <tr class="white">
            <td>Treat you courteously?</td>
             <td align="center"><? if($row_add[cs_treat_courteously]=="Excellent") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td align="center"><? if($row_add[cs_treat_courteously]=="Good") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td align="center"><? if($row_add[cs_treat_courteously]=="Fair") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td align="center"><? if($row_add[cs_treat_courteously]=="Poor") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td align="center"><? if($row_add[cs_treat_courteously]=="Very Poor") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
        </tr>
        <tr class="white">
            <td>Appreciate the need for confidentiality?</td>
             <td align="center"><? if($row_add[cs_treat_appre]=="Excellent") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td align="center"><? if($row_add[cs_treat_appre]=="Good") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td align="center"><? if($row_add[cs_treat_appre]=="Fair") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td align="center"><? if($row_add[cs_treat_appre]=="Poor") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td align="center"><? if($row_add[cs_treat_appre]=="Very Poor") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
        </tr>
        <tr class="white">
            <td>Display knowledge of the product?</td>
             <td align="center"><? if($row_add[cs_treat_know_prod]=="Excellent") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td align="center"><? if($row_add[cs_treat_know_prod]=="Good") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td align="center"><? if($row_add[cs_treat_know_prod]=="Fair") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td align="center"><? if($row_add[cs_treat_know_prod]=="Poor") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td align="center"><? if($row_add[cs_treat_know_prod]=="Very Poor") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
        </tr>
        </tbody></table>
	</td>
     </tr>
	 <tr class="even">
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
            <td  align="center"><? if($row_add[cs_incid_discourage]=="Yes") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td  align="center"><? if($row_add[cs_incid_discourage]=="No") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td  align="center"><? if($row_add[cs_incid_discourage]=="N/A") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
        </tr>
        <tr class="white">
            <td>Explain what was going to happen?</td>
            <td  align="center"><? if($row_add[cs_incid_happen]=="Yes") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td  align="center"><? if($row_add[cs_incid_happen]=="No") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td  align="center"><? if($row_add[cs_incid_happen]=="N/A") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
        </tr>
        <tr class="white">
            <td>Offer to give you feedback within a reasonable time?</td>
            <td  align="center"><? if($row_add[cs_incid_offer]=="Yes") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td align="center"><? if($row_add[cs_incid_offer]=="No") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td align="center"><? if($row_add[cs_incid_offer]=="N/A") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
        </tr>
        <tr class="white">
            <td>Provide you with contact details for someone dealing with your case?</td>
             <td align="center"><? if($row_add[cs_incid_contact]=="Yes") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td align="center"><? if($row_add[cs_incid_contact]=="No") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td align="center"><? if($row_add[cs_incid_contact]=="N/A") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
        </tr>
        </tbody></table>
	</td>
     </tr>
	
	 <tr class="even">
		<td>
			 <div>
            <p><strong>5. Overall, how satisfied were you with the service: (Please use a tick mark to indicate your rating)</strong></p>
        </div>
		</td>
     </tr>
     <tr>
     <td>
		<table width="100%" cellspacing="1" cellpadding="0" border="1" align="right" class="black1" style="text-align: left; border-collapse:collapse;" bordercolor="#2888BB" >
        <thead>
        <tr>
            <th>Very satisfied</th>
            <th>Satisfied</th>
            <th>Dissatisfied</th>
            <th>Very dissatisfied</th>
        </tr>
        </thead>
        <tbody><tr class="white">
            <td align="center"><? if($row_add[cs_service_sat]=="Very satisfied") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td align="center"><? if($row_add[cs_service_sat]=="Satisfied") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td align="center"><? if($row_add[cs_service_sat]=="Dissatisfied") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
            <td align="center"><? if($row_add[cs_service_sat]=="Very dissatisfied") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
        </tr>
        </tbody></table>
	</td>
     </tr>
	  <tr class="even">
		<td>
			<p><strong>6. How can we improve police services in the future?</strong></p>
		</td>
     </tr>
     <tr>
     <td>
		<?=$row_add[cs_improve_ser]?>
	</td>
     </tr>
	 <tr class="even">
		<td>
			<h3>QUESTIONS ABOUT YOU</h3>
        <p><strong>The following details enable us to monitor any differences in satisfaction between groups of people.</strong></p>
		</td>
     </tr>
     <tr>
     <td>
		1.	Are you ?   <strong><?=$row_add[cs_gender]?></strong>
	</td>
     </tr>
	 <tr class="even">
		<td>
			<p><strong>2. What is your age group?</strong></p>
		</td>
     </tr>
     <tr>
     <td>
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
                <td  align="center"><? if($row_add[cs_age_grp]=="Under 16") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
                <td  align="center"><? if($row_add[cs_age_grp]=="16-24") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
				<td align="center"><? if($row_add[cs_age_grp]=="25-34") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
				<td align="center"><? if($row_add[cs_age_grp]=="35-44") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
				<td align="center"><? if($row_add[cs_age_grp]=="45-54") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
				<td align="center"><? if($row_add[cs_age_grp]=="55-64") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
				<td align="center"><? if($row_add[cs_age_grp]=="65-74") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
				<td align="center"><? if($row_add[cs_age_grp]=="75 and over") {?><img src="../../images/tick.jpg" alt=""><? } ?></td>
			</tr>
			</table>
	</td>
     </tr>
	 <tr class="even">
		<td>
			
		</td>
     </tr>
     <tr>
     <td>
		<table width="100%" cellspacing="0" cellpadding="0" border="0">
                <tbody><tr>
                	<td style="width: 50%; text-align: left; padding: 4px 0pt;">3. What is your nationality?<font color="#ff0000">*</font></td>
            		<td align="left"><?=$row_add[cs_nationality]?></td>
                </tr>
                <tr>
                	<td style="width: 50%; text-align: left; padding: 4px 0pt;">4. What is your Name?<font color="#ff0000">*</font></td>
            		<td align="left"><?=$row_add[cs_name]?></td>
                </tr>
                <tr>
                	<td style="width: 50%; text-align: left; padding: 4px 0pt;">5. What is your Email Id?<font color="#ff0000">*</font></td>
            		<td align="left"><?=$row_add[cs_email]?></td>
                </tr>
                <tr>
                	<td style="width: 50%; text-align: left; padding: 4px 0pt;">6. What is your contact phone number?<font color="#ff0000">*</font></td>
            		<td align="left"><?=$row_add[cs_tel]?></td>
                </tr>
				<tr><td>&nbsp;</td></tr>
                </tbody></table>
	</td>
     </tr>
	 <tr class="even">
		<td>&nbsp;</td>
	 </tr>     
     <tr >
     	<td>
        <input type="button" class="button" value="Back" name="Back" onclick="javascript:history.back()">
        </td>
     </tr>   
     </table>
     
     </form>
     
     
     <p>&nbsp;</p>
    
     
    <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>
</div>
<?admin_footer()?>