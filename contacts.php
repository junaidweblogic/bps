<?php
include("common/app_function.php");
include("common/config.php");
$query = "SELECT * FROM ".$tblpref."content_master WHERE cms_type='contact'";
if(!($result = mysqli_query($connection,$query))) { echo "Query :- " . $query . "<br />Error :- " . mysqli_connect_errno(); exit; }
$row=mysqli_fetch_array($result);

$desc=stripslashes(ucfirst($row[cms_desc]));
$userval = preg_chk($_SESSION['userval']);
$title = "Contact Us";
index_header($title,$rewritepath,$tblpref,$db,$row_admin, $siteuploadpath);

?>
<main>
	<div class="main">
    
    <section class="innerbg">
    	<div class="container">
        	
            <h1 class="header">Contact Us</h1>
            
            <section class="title-section">
                <ol class="breadcrumb">
                   <li><a href="<?php echo $rewritepath;?>index.php/home/">Home</a></li>
                  <li class="active">Contact Us</li>
                </ol> 
            </section>
            
        </div>
    </section>
    
    <section>
    	<div class="container">

        <div class="row">
        <div class="col-md-9 col-sm-8">
        
<!--start-->	
            
      <h2>Public Relations Unit</h2> 
      
      <h3>Postal Address</h3>
        <p>Public Relations Officer<br>
        P/Bag 0012, Gaborone</p>
        
        <h3>Physical Address</h3>
        <p>CBD, Gaborone<br>
        Zambezi Towers Floor 3</p>



<p>Tel : +267 399 3813 / 15 / 23 / 74 <br>
  Cell : +267 73110350<br>
  Fax : +267 397 2404<br>
  Email : police@gov.bw<br>
  Facebook : Botswana Police Service<br>
  Website : www.police.gov.bw</p>
  
  
  <p>&nbsp;</p>
<h2>Feedback Form</h2>
            <form class="feedback" action="<?php echo $rewritepath;?>index.php/submit/" method="POST"  name="regisfrm" onsubmit='return feedback();'>
			<?php
			echo $_POST[flag];
			if(preg_chk($_POST[flag])=="wrong")
			{?>
				<div class="alert alert-danger" role="alert">Please Enter The Correct Given Code. </div>
			<?php
			}
			if(preg_chk($_POST[flag])=="blank")
			{?>
				<div class="alert alert-danger" role="alert">Some of the required parameters are blank. </div>
			<?php
			}
			if(preg_chk($_POST[flag])=="hash")
			{?>
				<div class="alert alert-danger" role="alert">Token didn't match. </div>
			<?php
			}
			if(preg_chk($_POST[flag])=="embed")
			{?>
				<div class="alert alert-danger" role="alert">Invalid Tokens. </div>
			<?php
			}
			if(preg_chk($_POST[flag])=="direct")
			{?>
				<div class="alert alert-danger" role="alert">You cannot use this page directly. </div>
			<?php
			}?>
               <div class="row">
                    <div class="col-sm-4">
                    <div class="form-group">
                    <input type="name" class="form-control" name="name" id="name" placeholder="Name" value="<?php echo preg_chk($_POST[name]);?>" required>
                    </div>
                    </div>
                    <div class="col-sm-4 padnlt">
                    <div class="form-group">
                    <input type="email" class="form-control" name="email" id="email" placeholder="E-mail" value="<?php echo preg_chk($_POST[email]);?>" required>
                    </div>
                    </div>
                    <div class="col-sm-4 padnlt">
                    <div class="form-group">
                    <input type="tel" class="form-control" name="tel" id="tel" placeholder="Telephone" value="<?php echo preg_chk($_POST[tel]);?>" required onBlur="telephone(this.id)" >
                    </div>
                    </div>
                 </div>
              
               
               <div class="row">
                <div class="col-sm-12">
                <div class="form-group">
                     <textarea class="form-control" rows="5" id="comment" placeholder="Comments" required name="message" id="message"><?php echo preg_chk($_POST[message]);?></textarea>
                </div>
                </div>
               </div>
               
             <!-- <div class="row">
                <div class="col-sm-12">
                <div class="form-group clearfix">
                    <label class="captcha"><img src="images/captcha.jpg" alt="Captcha"></label>
                    <input type="text" class="form-control result" id="captcha" placeholder="Result" required>
                </div>
                </div>
             </div> -->
			 <script src='https://www.google.com/recaptcha/api.js'></script>
               			<div class="g-recaptcha" data-sitekey="<?php echo $recaptcha_site?>"></div>
               			<br/>
               
               <div class="form-group">
			   <input type="hidden" name="userval" id="userval" value="<?php echo $userval;?>">
               <input type="submit" class="btn btn-default" value="Submit">
               </div>
            </form>  
  
              
<!--end-->

	</div><!--/left side-->
     <?php
			right_panel($rewritepath,$tblpref,$db,$row_admin,$connection,$id);
		?>
    </div><!--/-->
     
        <div class="clr"></div>    
        </div>
    </section>
    
    
   
    </div>
</main>

<?php
index_footer($rewritepath,$tblpref,$db,$row_admin,$connection);
?>

<SCRIPT LANGUAGE="JavaScript">
numvalid = function(id) {
	var value = document.getElementById(id).value;
	var numericExpression = /^[0-9---+().,]+$/;
	if (!(value.match(numericExpression)))
	{	
		document.getElementById(id).style.border  = "1px solid #ff0000";
		document.getElementById(id).focus();
		return false;
	}	
	else 
	{
		document.getElementById(id).style.border = "1px solid #E5E5E5";
		return true;
	}	
}

alphanumvalid = function(id) {
	var value1 = document.getElementById(id).value;
	var numericExpression1 = /^[a-zA-Z 0-9---+(),.\s']+$/; 
	if (!(value1.match(numericExpression1)))
	{				
		document.getElementById(id).style.border  = "1px solid #ff0000";
		//document.getElementById(id).focus();
		return false;
	}	
	else 
	{
		document.getElementById(id).style.border = "1px solid #E5E5E5";
		return true;
	}	
}
 

text = function (id) {
	var result = document.getElementById(id).value;
	var alphaExp = /^[a-z A-Z\s,']+$/;
	// /^[a-z A-Z._-']+$/;
	if(!(result.match(alphaExp)))	
	{
		document.getElementById(id).style.border  = "1px solid #ff0000";
		//document.getElementById(id).style.backgroundColor  = "#ff0000";
		return false;
	}
	else 
	{
		document.getElementById(id).style.border  = "1px solid #E5E5E5";
		return true;
	}
}
 
notnull = function (id) {
	var result = document.getElementById(id).value;
	if(result == "") 
	{
		document.getElementById(id).style.border  = "1px solid #ff0000";
		return false;
	}
	else 
	{
		document.getElementById(id).style.border  = "1px solid #E5E5E5";
		return true;
	}
}
mobile = function(id)
{
	var value = document.getElementById(id).value;
	var numericExpression = /^[0-9]+$/;
	if(value!="")
	{
		if (!(value.match(numericExpression)))
		{				
			document.getElementById(id).style.border  = "1px solid #ff0000";
			alert("Please enter numeric value only");
			window.setTimeout(function () { document.getElementById(id).focus();}, 0);
			return false;
		}
		else if(value.length < 7) 
		{
			document.getElementById(id).style.border  = "1px solid #ff0000";
			alert("Cell Number should be minimum of 7 digit");
	 		window.setTimeout(function () { document.getElementById(id).focus();}, 0);
			return false;
		}
		else if(value.length > 12) 
		{
			document.getElementById(id).style.border  = "1px solid #ff0000";
			alert("Cell Number should be maximum of 12 digit");
	 		window.setTimeout(function () { document.getElementById(id).focus();}, 0);
			return false;
		}
		else 
		{
			document.getElementById(id).style.border = "1px solid #E5E5E5";
			return true;
		}	
	}
	else
	{
		document.getElementById(id).style.border  = "1px solid #ff0000";
		return false;
	}
} 
telephone = function(id)
{
	var value = document.getElementById(id).value;
	var numericExpression = /^[0-9]+$/;
	if(value!="")
	{
		if (!(value.match(numericExpression)))
		{				
			document.getElementById(id).style.border  = "1px solid #ff0000";
			alert("Please enter numeric value only");
			window.setTimeout(function () { document.getElementById(id).focus();}, 0);
			return false;
		}
		else if(value.length < 7) 
		{
			document.getElementById(id).style.border  = "1px solid #ff0000";
			alert("Contact Number should be minimum of 7 digit");
	 		window.setTimeout(function () { document.getElementById(id).focus();}, 0);
			return false;
		}
		else if(value.length > 14) 
		{
			document.getElementById(id).style.border  = "1px solid #ff0000";
			alert("Contact Number should be maximum of 14 digit");
	 		window.setTimeout(function () { document.getElementById(id).focus();}, 0);
			return false;
		}
		else 
		{
			document.getElementById(id).style.border = "1px solid #E5E5E5";
			return true;
		}	
	}
	else
	{
		document.getElementById(id).style.border  = "1px solid #ff0000";
		return false;
	}
}
fax = function(id)
{
	var value = document.getElementById(id).value;
	var numericExpression = /^[0-9]+$/;
	if(value!="")
	{
		if (!(value.match(numericExpression)))
		{				
			document.getElementById(id).style.border  = "1px solid #ff0000";
			alert("Please enter numeric value only");
			window.setTimeout(function () { document.getElementById(id).focus();}, 0);
			return false;
		}
		else if(value.length < 7) 
		{
			document.getElementById(id).style.border  = "1px solid #ff0000";
			alert("Fax Number should be minimum of 7 digit");
	 		window.setTimeout(function () { document.getElementById(id).focus();}, 0);
			return false;
		}
		else if(value.length > 14) 
		{
			document.getElementById(id).style.border  = "1px solid #ff0000";
			alert("Fax Number should be maximum of 14 digit");
	 		window.setTimeout(function () { document.getElementById(id).focus();}, 0);
			return false;
		}
		else 
		{
			document.getElementById(id).style.border = "1px solid #E5E5E5";
			return true;
		}	
	}	
}
function dateValidate(dateid)
{		
	var dob = document.getElementById(dateid).value;
	if (dob == "") 
	{ 
		document.getElementById(dateid).style.border="1px solid #FF0000";
		document.getElementById(dateid).focus();
		return false;
	}
	
	if(dob!="")
	{	
		if ( dob.match(/^(\d{1,2})\-(\d{1,2})\-(\d{4})$/) )  {	
			var dd = RegExp.$1;   
			var mm = RegExp.$2;   
			var yy = RegExp.$3; 
			
			 // try to create the same date using Date Object   
			var dt = new Date(parseFloat(yy), parseFloat(mm)-1, parseFloat(dd), 0, 0, 0, 0);
			// invalid day           
			if ((parseFloat(dd) != dt.getDate()) && (parseFloat(mm)-1 != dt.getMonth()) && (parseFloat(yy) != dt.getFullYear()))  { return false; }           
			else {
				document.getElementById(dateid).style.border="1px solid #E5E5E5";
				return true;   
			}	
		} else {   
			document.getElementById(dateid).style.border="1px solid #FF0000";
			document.getElementById(dateid).focus();
			return false;   
			}   
	}
	else {
		document.getElementById(dateid).style.border="1px solid #FF0000";
		document.getElementById(dateid).focus();
		return false;
	}
}


validEmail = function(id) {
	var email = document.getElementById(id).value;
	if(email == "") {
		document.getElementById(id).style.border="1px solid #FF0000";	
		//document.getElementById(id).focus();
		return false;
	}
	
	if(email != "") { 
	
		var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
		if(!(email.match(emailExp)))
		{
			document.getElementById(id).style.border="1px solid #FF0000";	
			//document.getElementById(id).focus();
			return false;
		}
		else
		{
			document.getElementById(id).style.border="1px solid #E5E5E5";
			return true;   
		}
	}
}

dropdown = function(eid) {
	var result = document.getElementById(eid).selectedIndex;
	if(result == 0) { 
		document.getElementById(eid).style.border  = "1px solid #ff0000";
		//document.getElementById(eid).style.backgroundColor  = "#ff0000";
		return false;
	}
	else {
		document.getElementById(eid).style.border  = "1px solid #E5E5E5";
		//document.getElementById(eid).style.backgroundColor="#FFFFFF";
		return true;  
	}
}
function feedback()
{
	var result = new Array();
	var counter = 0;
	result[counter++] = text('name'); 
	result[counter++] = telephone('tel'); 
	result[counter++] = validEmail('email'); 
	/*result[counter++] = alphanumvalid('sub');*/
	result[counter++] = alphanumvalid('message');
	result[counter++] = notnull('captcha');
	var count = 0;
	while(count < counter) 
		{
			if(result[count++] == false)
			{
				return false;
				break;
			}
	    }
	return true;	

}
</SCRIPT>