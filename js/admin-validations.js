// JavaScript Document
numvalid = function(id) {
	var value = document.getElementById(id).value;
	var numericExpression = /^[0-9---+().,]+$/;
	if (!(value.match(numericExpression)))
	{	//alert("right end");			
		document.getElementById(id).style.padding = "2px 3px";
		document.getElementById(id).style.border  = "1px solid #ff0000";
		//document.getElementById(id).style.backgroundColor  = "#ff0000";
		document.getElementById(id).focus();
		return false;
	}	
	else {//alert("wrong end");
		document.getElementById(id).style.padding = "2px 3px";
		document.getElementById(id).style.border = "1px solid #A5ACB2";
		return true;
	}	
}

alphanumvalid = function(id) {
	var value1 = document.getElementById(id).value;
	var numericExpression1 = /^[a-zA-Z 0-9---+(),.\s']+$/; 
	if (!(value1.match(numericExpression1)))
	{				
		document.getElementById(id).style.padding = "2px 3px";
		document.getElementById(id).style.border  = "1px solid #ff0000";
		//document.getElementById(id).style.backgroundColor  = "#ff0000";		
		//document.getElementById(id).focus();
		return false;
	}	
	else {
		document.getElementById(id).style.padding = "2px 3px";
		document.getElementById(id).style.border = "1px solid #A5ACB2";
		return true;
	}	
}
 

text = function (id) {
	var result = document.getElementById(id).value;
	var alphaExp = /^[a-z A-Z\s,']+$/;
	// /^[a-z A-Z._-']+$/;
	if(!(result.match(alphaExp)))	{
		//alert("right end");
		document.getElementById(id).style.padding = "2px 3px";
		document.getElementById(id).style.border  = "1px solid #ff0000";
		//document.getElementById(id).style.backgroundColor  = "#ff0000";
		return false;
	}
	else {
		//alert("wrong end");
		document.getElementById(id).style.padding = "2px 3px";
		document.getElementById(id).style.border  = "1px solid #A5ACB2";
		return true;
	}
}
 
notnull = function (id) {
	var result = document.getElementById(id).value;
	if(result == "") {
		document.getElementById(id).style.padding = "2px 3px";
		document.getElementById(id).style.border  = "1px solid #ff0000";
		//document.getElementById(id).style.backgroundColor  = "#ff0000";
		return false;
	}
	else {
		document.getElementById(id).style.padding = "2px 3px";
		document.getElementById(id).style.border  = "1px solid #A5ACB2";
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
			document.getElementById(id).style.padding = "2px 3px";
			document.getElementById(id).style.border  = "1px solid #ff0000";
			alert("Please enter numeric value only");
			window.setTimeout(function () { document.getElementById(id).focus();}, 0);
			return false;
		}
		else if(value.length < 7) 
		{
			document.getElementById(id).style.padding = "2px 3px";
			document.getElementById(id).style.border  = "1px solid #ff0000";
			alert("Cell Number should be minimum of 7 digit");
	 		window.setTimeout(function () { document.getElementById(id).focus();}, 0);
			return false;
		}
		else if(value.length > 12) 
		{
			document.getElementById(id).style.padding = "2px 3px";
			document.getElementById(id).style.border  = "1px solid #ff0000";
			alert("Cell Number should be maximum of 12 digit");
	 		window.setTimeout(function () { document.getElementById(id).focus();}, 0);
			return false;
		}
		else {
		document.getElementById(id).style.padding = "2px 3px";
		document.getElementById(id).style.border = "1px solid #A5ACB2";
		return true;
		}	
	}
	else
	{
		document.getElementById(id).style.padding = "2px 3px";
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
			document.getElementById(id).style.padding = "2px 3px";
			document.getElementById(id).style.border  = "1px solid #ff0000";
			alert("Please enter numeric value only");
			window.setTimeout(function () { document.getElementById(id).focus();}, 0);
			return false;
		}
		else if(value.length < 7) 
		{
			document.getElementById(id).style.padding = "2px 3px";
			document.getElementById(id).style.border  = "1px solid #ff0000";
			alert("Contact Number should be minimum of 7 digit");
	 		window.setTimeout(function () { document.getElementById(id).focus();}, 0);
			return false;
		}
		else if(value.length > 14) 
		{
			document.getElementById(id).style.padding = "2px 3px";
			document.getElementById(id).style.border  = "1px solid #ff0000";
			alert("Contact Number should be maximum of 14 digit");
	 		window.setTimeout(function () { document.getElementById(id).focus();}, 0);
			return false;
		}
		else {
		document.getElementById(id).style.padding = "2px 3px";
		document.getElementById(id).style.border = "1px solid #A5ACB2";
		return true;
		}	
	}
	else
	{
		document.getElementById(id).style.padding = "2px 3px";
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
			document.getElementById(id).style.padding = "2px 3px";
			document.getElementById(id).style.border  = "1px solid #ff0000";
			alert("Please enter numeric value only");
			window.setTimeout(function () { document.getElementById(id).focus();}, 0);
			return false;
		}
		else if(value.length < 7) 
		{
			document.getElementById(id).style.padding = "2px 3px";
			document.getElementById(id).style.border  = "1px solid #ff0000";
			alert("Fax Number should be minimum of 7 digit");
	 		window.setTimeout(function () { document.getElementById(id).focus();}, 0);
			return false;
		}
		else if(value.length > 14) 
		{
			document.getElementById(id).style.padding = "2px 3px";
			document.getElementById(id).style.border  = "1px solid #ff0000";
			alert("Fax Number should be maximum of 14 digit");
	 		window.setTimeout(function () { document.getElementById(id).focus();}, 0);
			return false;
		}
		else {
		document.getElementById(id).style.padding = "2px 3px";
		document.getElementById(id).style.border = "1px solid #A5ACB2";
		return true;
		}	
	}	
}
function dateValidate(dateid)
{		
	var dob = document.getElementById(dateid).value;
	if (dob == "") { 
		document.getElementById(dateid).style.border="1px solid #FF0000";
		//document.getElementById(id).style.backgroundColor  = "#ff0000";
		document.getElementById(dateid).focus();
		return false;
	}
	
	if(dob!="") {	
		if ( dob.match(/^(\d{1,2})\-(\d{1,2})\-(\d{4})$/) )  {	
			var dd = RegExp.$1;   
			var mm = RegExp.$2;   
			var yy = RegExp.$3; 
			
			 // try to create the same date using Date Object   
			var dt = new Date(parseFloat(yy), parseFloat(mm)-1, parseFloat(dd), 0, 0, 0, 0);
			// invalid day           
			if ((parseFloat(dd) != dt.getDate()) && (parseFloat(mm)-1 != dt.getMonth()) && (parseFloat(yy) != dt.getFullYear()))  { return false; }           
			else {
				document.getElementById(dateid).style.border="1px solid #7B9EBD";
				return true;   
			}	
		} else {   
			document.getElementById(dateid).style.border="1px solid #FF0000";
			//document.getElementById(id).style.backgroundColor  = "#ff0000";
			document.getElementById(dateid).focus();
			return false;   
			}   
	}
	else {
		document.getElementById(dateid).style.border="1px solid #FF0000";
		//document.getElementById(id).style.backgroundColor  = "#ff0000";
		document.getElementById(dateid).focus();
		return false;
	}
}


validEmail = function(id) {
	var email = document.getElementById(id).value;
	if(email == "") {
		document.getElementById(id).style.border="1px solid #FF0000";	
		//document.getElementById(id).style.backgroundColor  = "#ff0000";
		//document.getElementById(id).focus();
		return false;
	}
	
	if(email != "") { 
	
		var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
		if(!(email.match(emailExp)))
		{
			document.getElementById(id).style.border="1px solid #FF0000";	
			//document.getElementById(id).style.backgroundColor  = "#ff0000";
			//document.getElementById(id).focus();
			return false;
		}
		else
		{
			document.getElementById(id).style.border="1px solid #A5ACB2";
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
		document.getElementById(eid).style.border  = "1px solid #7B9EBD";
		//document.getElementById(eid).style.backgroundColor="#FFFFFF";
		return true;  
	}
}

getModel = function(cid) {
	$.post("getmodel.php", {makeid: cid},
	function(data) {
		$("#model").fadeOut('slow',function() {
				$("#model").html(data);
		});
		$("#model").fadeIn('slow');
	});	
}
function selectmodel(model) 
{
	//alert(model);
	document.getElementById('txthmodel').value = model;
}
/***************Admin Panel Start*****************/




admninfo = function () {
	var result = new Array();
	result[0] = notnull('username');
	//result[1] = notnull('password');
	result[1] = validEmail('emailid');
	result[2] = notnull('name');


	var count = 0;
	while(count < 3) {
		if(result[count++] == false) {
			return false;
			break;
		}
	}
	return true;	
}

cms = function () {
	var result = new Array();
	result[0] = notnull('name');
	result[1] = notnull('wtitle');	
	
	var count = 0;
	while(count < 2) {
		if(result[count++] == false) {
			return false;
			break;
		}
	}
	return true;
	
}
picgallery = function () {
	var result = new Array();
	var counter=0;
	result[counter++] = notnull('the_file');
	
	var count = 0;
	while(count < counter) {
		if(result[count++] == false) {
			return false;
			break;
		}
	}
	return true;	
}

banner = function () {
	var result = new Array();
	var counter=0;
	result[counter++] = alphanumvalid('name');
	result[counter++] = notnull('ban_img');
		
	var count = 0;
	while(count < counter) {
		if(result[count++] == false) {
			return false;
			break;
		}
	}
	return true;	
}

video = function () {
	var result = new Array();
	var counter=0;
	result[counter++] = notnull('videotitle');
	result[counter++] = notnull('vcode');
		
	var count = 0;
	while(count < counter) {
		if(result[count++] == false) {
			return false;
			break;
		}
	}
	return true;	
}

faq = function () {
	var result = new Array();
	var counter=0;
	result[counter++] = notnull('faqtitle');
			
	var count = 0;
	while(count < counter) {
		if(result[count++] == false) {
			return false;
			break;
		}
	}
	return true;	
}

franchise = function () {
	var result = new Array();
	result[0] = alphanumvalid('fr_name');
	result[1] = dropdown('cnt_name');
	result[2] = telephone('fr_cntct_no');
	result[3] = validEmail('fr_email');
	result[4] = numvalid('fr_fees');
	result[5] = numvalid('cur_name_h');
	
	
	var count = 0;
	while(count < 6) {
		if(result[count++] == false) {
			return false;
			break;
		}
	}
	return true;
	
}
brand = function () {
	var result = new Array();
	result[0] = alphanumvalid('m_name');	
	
	var count = 0;
	while(count < 1) {
		if(result[count++] == false) {
			return false;
			break;
		}
	}
	return true;
	
}
model = function () {
	var result = new Array();
	result[0] = dropdown('dropbox');
	result[1] = alphanumvalid('txtmodel');
		

	var count = 0;
	while(count < 2) {
		if(result[count++] == false) {
			return false;
			break;
		}
	}
	return true;	
}
vlink = function () {
	var result = new Array();
	result[0] = notnull('name');
	result[1] = notnull('link');
		

	var count = 0;
	while(count < 2) {
		if(result[count++] == false) {
			return false;
			break;
		}
	}
	return true;	
}

expertp = function () {
	var result = new Array();
	result[0] = dropdown('cnt_name');
	result[1] = dropdown('dropbox');
	result[2] = dropdown('txthmodel');
	result[3] = alphanumvalid('ep_title');
	result[4] = dropdown('ep_yr_manu');
	result[5] = dropdown('ep_trans');
	result[6] = alphanumvalid('ep_price');
	result[7] = alphanumvalid('ep_mlg');
	result[8] = alphanumvalid('ep_colour');
	result[9] = alphanumvalid('ep_eng_cap');
	result[10] = dropdown('ep_fuel');
	result[11] = dropdown('ep_cond');
	result[12] = notnull('ep_desc');
		

	var count = 0;
	while(count < 13) {
		if(result[count++] == false) {
			return false;
			break;
		}
	}
	return true;	
}


/***************Admin Panel End*****************/
/***************Site Panel Start*****************/
basic = function () {
	var result = new Array();
	result[0] = text('cus_name');
	result[1] = dropdown('cus_dest_cnt_name');
	result[2] = dropdown('cus_src_cnt_name');


	var count = 0;
	while(count < 3) {
		if(result[count++] == false) {
			return false;
			break;
		}
	}
	return true;	
}

senquiry = function () {
	var result = new Array();
	result[0] = telephone('tel');
	result[1] = validEmail('email');
	result[2] = alphanumvalid('city');
	result[3] = notnull('add1');


	var count = 0;
	while(count < 4) {
		if(result[count++] == false) {
			return false;
			break;
		}
	}
	return true;	
}

dash = function () {
	var result = new Array();
	var counter=0;
	result[counter++] = notnull('linktitle');
	result[counter++] = numvalid('pos');
		
	var count = 0;
	while(count < counter) {
		if(result[count++] == false) {
			return false;
			break;
		}
	}
	return true;	
}

/***************Site Panel End*****************/