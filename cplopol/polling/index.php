<?php
session_start();
include("../../common/cploconfig.php");
include("../../common/app_function.php");

if($_SESSION[username]=="")
{
	DisplayError("Login Error.","","For security of your account,we have expired your session.<br>&nbsp;Please login to your account again.", "Home,../index.php", 0);
	exit();
}

admin_header('../../','Survey',$tblpref,$db,$sitepath,$siteurl,$path1,$ckpath,$row_admin);
?>

<SCRIPT LANGUAGE="JavaScript">
//<!--

function formvalidate()
{

	if(document.polladd.poll_quest.value=="")
	{
		alert("Please Enter Question");
		document.polladd.poll_quest.focus();
		return false;
	}
return true;
}
//-->
</SCRIPT>


<?php

	if($_GET['flag'] == "clear") :
		$query = "TRUNCATE TABLE " . $tblpref . "poll_result";
		if(!($result_add=mysqli_query($connection,$query))) { echo $query.mysqli_errno($connection); exit;}
	endif;

	$query_add="select * from ".$tblpref."poll_option  where id='1'";
	if(!($result_add=mysqli_query($connection,$query_add))) { echo $query_add.mysqli_errno($connection); exit;}
	$row_add=mysqli_fetch_array($result_add);

?>
<script type="text/javascript" src="../../js/jquery-1.3.1.min.js"></script>
<script type="text/javascript" src="../../js/jquery-ui-1.7.1.custom.min.js"></script>
<script type="text/javascript" src="../../js/daterangepicker.jQuery.js"></script>
<link rel="stylesheet" href="../../css/ui.daterangepicker.css" type="text/css" />
<link rel="stylesheet" href="../../css/redmond/jquery-ui-1.7.1.custom.css" type="text/css" title="ui-theme" />

<script type="text/javascript"> 
$(function(){
  $('#poll_sdate').daterangepicker({
	posX:470,
	posY: 410
	  }); 
});
$(function(){
  $('#poll_edate').daterangepicker({
	posX:470,
	posY: 430
  }); 
});

</script>
<style type="text/css">
.ui-daterangepickercontain {
	top:220px;
	left:400px;
	position: absolute;
	z-index: 999;
}
</style>

<!--body start -->
<div class="adminbody">
<div class="flt"><a href="../home.php"><img src="../../images/dashboard.png" alt="Home" title="Home"/></a></div>
<div class="frt" style="padding-right:5px;"><a href="../home.php"><img src="../../images/back32.png" alt="Back" title="Back" /></a></div>
<div class="gap"></div>
<div class="box">
    <div class="hdr">
	<h1 class="ico-edit">Edit</h1>
	<div class="rtheading">
        <h1 class="ico"><img src="icon/icon.png" alt="">Survey</h1>
    </div>
    </div> 
	<div class="padtb">
     <form name="frmcmsadd" method="POST" onsubmit="return formvalidate();" action="submit.php?id=1">
     <table width="100%" border="0" cellspacing="0" cellpadding="0">
     <tr class="even">
		<td> Survey Question<font color="#ff0000">* </font> :     </td>
		<td> <INPUT TYPE="text" NAME="poll_quest" class="smlinput"  value="<?=stripslashes($row_add[poll_que])?>"></td>
     </tr>
     <tr>
     <td> Survey Option1 <font color="#ff0000">* </font> :     </td>
		<td>
			<INPUT TYPE="text" NAME="poll_option1" class="smlinput"value="<?=stripslashes($row_add[poll_opt1])?>">	
		</td>
     </tr>
	  <tr class="even">
		<td> Survey Option2 <font color="#ff0000">* </font> :     </td>
		<td> <INPUT TYPE="text" NAME="poll_option2" class="smlinput" value="<?=stripslashes($row_add[poll_opt2])?>">	</td>
     </tr>
     <tr>
     <td> Survey Option3 <font color="#ff0000">* </font> :     </td>
		<td>
			<INPUT TYPE="text" NAME="poll_option3" class="smlinput" value="<?=stripslashes($row_add[poll_opt3])?>">	
		</td>
     </tr>
	 <tr class="even">
		<td> Start Date<font color="#ff0000">* </font> :     </td>
		<td> <INPUT TYPE="text" NAME="poll_sdate" id="poll_sdate" class="smlinput" value="<?=dateformate($row_add[poll_sdate])?>">	</td>
     </tr>
     <tr>
     <td> End Date <font color="#ff0000">* </font> :     </td>
		<td>
			  <INPUT TYPE="text" NAME="poll_edate"  id="poll_edate" class="smlinput" value="<?=dateformate($row_add[poll_edate])?>">	
		</td>
     </tr>
	 <tr class="even">
		<td colspan="2">&nbsp;</td>
	 </tr>     
     <tr >
     	<td>
        <input type="submit" class="button" value="Submitt" name="submit">
        </td>
     </tr>   
	 </table>
	 </form>
	 <table width="100%" border="0" cellspacing="0" cellpadding="0">
	 <tr class="even">
		<td>&nbsp;</td>
	 </tr>     
	 <tr class="even">
		<td><h3>Survey RESULT</h3></td>
	 </tr>     
	 <tr class="even">
		<td><a href="index.php?flag=clear"><input type="button" class="button" value="Clear Result" name="submit"></a></td>
	 </tr>    
	  <?
 
 // select option of question 
 $select_option="select * from ".$tblpref."poll_option where id='1'";
 if(!($result_option=mysqli_query($connection,$select_option))) { echo $select_option.mysqli_errno($connection);exit;}
 $row_option=mysqli_fetch_array($result_option);
 

 // for total answer 

 $select_pollquest="select count(*) from ".$tblpref."poll_result";
 if(!($result_pollquest=mysqli_query($connection,$select_pollquest))) { echo $select_pollquest.mysqli_errno($connection);exit;}
 $total_ans=mysqli_fetch_array($result_pollquest);

   
 // result percentage for option1
 
 $select_pollquest1="select count(*) from ".$tblpref."poll_result where poll_ans='$row_option[poll_opt1]'";
 if(!($result_pollquest1=mysqli_query($connection,$select_pollquest1))) { echo $select_pollquest1.mysqli_errno($connection);exit;}
 $ans_option1=mysqli_fetch_row($result_pollquest1);
//echo$ans_option1[0];exit;

 if($ans_option1[0] > 0)
 {
	 $percent_option1=($ans_option1[0] * 100)/$total_ans[0];
	 $percent_option1=number_format($percent_option1,2);
 }
  else
	 {
	  $percent_option1=0;
	 }

 // result percentage for option2
 
  $select_pollquest2="select count(*) from ".$tblpref."poll_result where poll_ans='$row_option[poll_opt2]'";
 if(!($result_pollquest2=mysqli_query($connection,$select_pollquest2))) { echo $select_pollquest2.mysqli_errno($connection);exit;}
$ans_option2=mysqli_fetch_array($result_pollquest2);

 if($ans_option2[0] > 0)
 {
 $percent_option2=($ans_option2[0] * 100)/$total_ans[0];
 $percent_option2=number_format($percent_option2,2);
 }
  else
 {
  $percent_option2=0;
 }
 

 // result percentage option3

 $select_pollquest3="select count(*) from ".$tblpref."poll_result where poll_ans='$row_option[poll_opt3]'";
 if(!($result_pollquest3=mysqli_query($connection,$select_pollquest3))) { echo $select_pollquest3.mysqli_errno($connection);exit;}
 $ans_option3=mysqli_fetch_array($result_pollquest3);

 if($ans_option3[0] >0)
 {
 $percent_option3=($ans_option3[0] * 100)/$total_ans[0];
 $percent_option3=number_format($percent_option3,2);
 }
  else
 {
  $percent_option3=0;
 }
 
 
 ?>
	<tr class="even">
		<td>
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
            <td style="padding:1px" align="left" class="text1">
            <?=stripslashes(trim($row_option[poll_opt1]))?>
            
            </td>
            <td  align="left">
            <TABLE  border='0' cellpadding="0" cellspacing="0"  width="100%">
              <TR>
                <TD bgcolor="#00ff00" width="<?=$percent_option1?>%"><b><font size="2"><?if ( ($percent_option1)>49) echo ($percent_option1). "%";?></TD>
                <TD width="<?=(100-$percent_option1)?>%"><b><font size="2">
                  <?if ( ($percent_option1)<=49 ) echo ($percent_option1). "%";?>
                  </font></b></TD>
              </TR>
            </TABLE>
            </td>
          </tr>
          <tr>
            <td style="padding:1px" align="left" class="text1">
            <?=stripslashes(trim($row_option[poll_opt2]))?>
            
            </td>
            <td  align="left">
            <TABLE  border='0' cellpadding="0" cellspacing="0"  width="100%">
              <TR>
                <TD bgcolor="#FF0000" width="<?=$percent_option2?>%"><b><font size="2"><FONT COLOR="ffffff"><?if ( ($percent_option2)>49) echo ($percent_option2). "%";?></TD>
                <TD width="<?=(100-$percent_option2)?>%"><b><font size="2">
                  <?if ( ($percent_option2)<=49 ) echo ($percent_option2). "%";?>
                  </font></b></TD>
              </TR>
            </TABLE>
            </td>
          </tr>
          <tr>
            <td style="padding:1px" align="left" class="text1" width="33%">
            <?=stripslashes(trim($row_option[poll_opt3]))?>
            
            </td>
            <td  align="left">
            <TABLE  border='0' cellpadding="0" cellspacing="0"  width="100%">
              <TR>
                <TD bgcolor="#0000ff" width="<?=$percent_option3?>%"><b><font size="2"><FONT COLOR="ffffff"><?if ( ($percent_option3)>49) echo ($percent_option3). "%";?></FONT></TD>
                <TD width="<?=(100-$percent_option3)?>%"><b><font size="2">
                  <?if ( ($percent_option3)<=49 ) echo ($percent_option3). "%";?>
                  </font></b></TD>
              </TR>
            </TABLE>
            </td>
          </tr>
				</table>
		</td>
	 </tr>    
</table>
     
     <p>&nbsp;</p>
    
     
    <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>
</div>
<?admin_footer()?>
