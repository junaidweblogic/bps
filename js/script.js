// JavaScript Document
assign = function(award, tid) {
	//document.getElementById('temp').value = tid;
	var url;
	url = "test.php?tid="+tid+"&award="+award;
	var xmlHttp;
	try
	{  
	// Firefox, Opera 8.0+, Safari 
		 xmlHttp=new XMLHttpRequest();  
	}
	catch (e)
	{ 
	 // Internet Explorer  
		try
		{    
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");    
		}
		catch (e)
		{    
			try
			{     	
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");      
			}
			 catch (e)
			 {      
				  alert("Your browser does not support AJAX!");
				  return false;  
			 }
		}
	  }
	  xmlHttp.onreadystatechange=function()
	  {
		if(xmlHttp.readyState==4)
		{
			xx=xmlHttp.responseText;
			//document.getElementById('publicationDetails').innerHTML = xx;
			//jQuery.prompt.getStateContent('state1').find('#intmonthlypayment').text(xx);		
			//jQuery.prompt.goToState('state1');
		}
	  }
	  xmlHttp.open("Get",url,true);
	  xmlHttp.send(null);	
	
}


fetchPublication = function(pub, id) {

	if(olda == 0) {
		olda = id;
		document.getElementById("a_" + olda).className = "left_corner1";
		document.getElementById("s_" + olda).className = "right_corner";
	}
	else {
		//Change Class from Gray to Blue to Old Tab
		document.getElementById("a_" + olda).className = "left_cornerb";
		document.getElementById("s_" + olda).className = "right_cornerb";

		//Change Class from Blue to Gray to New Tab
		olda = id;
		document.getElementById("a_" + olda).className = "left_corner1";
		document.getElementById("s_" + olda).className = "right_corner";
	}
	
	//document.getElementById('temp').value = tid;
	var url;
	url="bps-fetchpublications.php?pub="+pub;

	var xmlHttp;
	try
	{  
	// Firefox, Opera 8.0+, Safari 
		 xmlHttp=new XMLHttpRequest();  
	}
	catch (e)
	{ 
	 // Internet Explorer  
		try
		{    
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");    
		}
		catch (e)
		{    
			try
			{     	
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");      
			}
			 catch (e)
			 {      
				  alert("Your browser does not support AJAX!");
				  return false;  
			 }
		}
	  }
	  xmlHttp.onreadystatechange=function()
	  {
		if(xmlHttp.readyState==4)
		{
			xx=xmlHttp.responseText;
			document.getElementById('publicationDetails').innerHTML = xx;
			//jQuery.prompt.getStateContent('state1').find('#intmonthlypayment').text(xx);		
			//jQuery.prompt.goToState('state1');
		}
	  }
	  xmlHttp.open("Get",url,true);
	  xmlHttp.send(null);	
	
}


fetchProperty = function(pub, id) {

	if(olda == 0) {
		olda = id;
		document.getElementById("a_" + olda).className = "left_corner1";
		document.getElementById("s_" + olda).className = "right_corner";
	}
	else {
		//Change Class from Gray to Blue to Old Tab
		document.getElementById("a_" + olda).className = "left_cornerb";
		document.getElementById("s_" + olda).className = "right_cornerb";

		//Change Class from Blue to Gray to New Tab
		olda = id;
		document.getElementById("a_" + olda).className = "left_corner1";
		document.getElementById("s_" + olda).className = "right_corner";
	}
	
	//document.getElementById('temp').value = tid;
	var url;
	url="bps-fetchproperty.php?pub="+pub;

	var xmlHttp;
	try
	{  
	// Firefox, Opera 8.0+, Safari 
		 xmlHttp=new XMLHttpRequest();  
	}
	catch (e)
	{ 
	 // Internet Explorer  
		try
		{    
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");    
		}
		catch (e)
		{    
			try
			{     	
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");      
			}
			 catch (e)
			 {      
				  alert("Your browser does not support AJAX!");
				  return false;  
			 }
		}
	  }
	  xmlHttp.onreadystatechange=function()
	  {
		if(xmlHttp.readyState==4)
		{
			xx=xmlHttp.responseText;
			document.getElementById('publicationDetails').innerHTML = xx;
			//jQuery.prompt.getStateContent('state1').find('#intmonthlypayment').text(xx);		
			//jQuery.prompt.goToState('state1');
		}
	  }
	  xmlHttp.open("Get",url,true);
	  xmlHttp.send(null);	
	
}


///////................function for application form...........///////
application = function() {
	var name 	= $('#fname').val();
	var tel 	= $('#tel').val();
	var email 	= $('#email').val();
	var nation  =$('#nation').val();
	var captcha =$('#captcha').val();
	
	if(name == "") {
		document.getElementById('fname').style.borderColor = "#ff0000";
		document.getElementById('fname').focus();
		return false;
	}
	
	if(name != "")
		{ 
			var alphaExp = /^[a-z A-Z]+$/;
			if(!(name.match(alphaExp)))
			{
				document.getElementById('fname').style.borderColor = "#ff0000";
				document.getElementById('fname').focus();
					return false;
			}
			else
			{document.getElementById('fname').style.borderColor = "#00FF00";
				
					
				}
		}
		
	
	
		if (tel == "") 
		{
			document.getElementById('tel').style.borderColor = "#ff0000";
			document.getElementById('tel').focus();
				return false;
			
		}

		if(tel != "")
		{				
			var numericExpression = /^[0-9---+]+$/;
			var len=document.getElementById('tel').value;
			var limit=len.length;
			if (!(tel.match(numericExpression)))
		    {				
				document.getElementById('tel').style.borderColor = "#ff0000";
				document.getElementById('tel').focus();
					return false;
			}	
			else{
		if(( limit > 5 ) && ( limit < 15 ))	
			{ 
			document.getElementById('tel').style.borderColor = "#00FF00";
				
			}
			else
			{
				document.getElementById('tel').style.borderColor = "#ff0000";
				document.getElementById('tel').focus();
					return false;
			}}
		}
		if (email == "")
		{
			document.getElementById('email').style.borderColor = "#ff0000";
			document.getElementById('email').focus();
				return false;
		}
		
		if(email!="")
		{	
			var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
			if(!(email.match(emailExp)))
			{
				document.getElementById('email').style.borderColor = "#ff0000";
				document.getElementById('email').focus();
					return false;
			}
			else
			{
				document.getElementById('email').style.borderColor = "#00FF00";
				}
	
		}
if(nation == "") {
		document.getElementById('nation').style.borderColor = "#ff0000";
		return false;
	}
		
		if(captcha == "") {
		document.getElementById('captcha').style.borderColor = "#ff0000";
		document.getElementById('captcha').focus();
		return false;
	}	
	/* else{
		var url="caab-apply-post.php?captcha="+captcha+"&val=val";
		var xmlHttp;
		try {  
		// Firefox, Opera 8.0+, Safari 
			 xmlHttp=new XMLHttpRequest();  
		}
		catch (e) { 
		 // Internet Explorer  
			try {    
				xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");    
			}
			catch (e) {    
				try {     	
					xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");      
				}
				catch (e) {      
					  alert("Your browser does not support AJAX!");
					  return false;  
				}
			}
		}
		xmlHttp.onreadystatechange=function()
		{
			if(xmlHttp.readyState==4){
				x=xmlHttp.responseText;
				result = x.indexOf(".");
				if (result > 1) {
					//$('.form').fadeOut('slow');					
					//show the success message
					//$('.done').fadeIn('slow');
				}
				else
				{
					document.getElementById('captcha').style.borderColor = "#ff0000";
		        	document.getElementById('captcha').focus();
					return false;
				}
		
			}
		  }
		  xmlHttp.open("Get",url,true);
		  xmlHttp.send(null);	
		
	} */

	
}
//end of application form
//...............................empty function for application................//
empty1 = function(id)
{	

	var obj = document.getElementById(id).value;

	if (id == 'fname')
	{		
		if (obj == "")
		{
			document.getElementById('fname').style.borderColor = "#ff0000";
			
		}
		else if(obj != "")
		{
			var alphaExp = /^[a-z A-Z]+$/;
			if(!(document.getElementById('fname').value.match(alphaExp)))
			{
				document.getElementById('fname').style.borderColor = "#ff0000";
				
			}
			else
			{
				document.getElementById('fname').style.borderColor = "#00FF00";
				
			}
		}
	}



	if(id == 'tel')
	{		
		if(obj == "")
		{
			document.getElementById('tel').style.borderColor = "#ff0000";
			
		}
		else if(obj != "")
		{
			var numericExpression = /^[0-9]+$/;
			var len1=document.getElementById('tel').value;
			var limit1=len1.length;
			if (!(document.getElementById('tel').value.match(numericExpression)))
		     {
				document.getElementById('tel').style.borderColor = "#ff0000";
			   }
			else{	 
			if(( limit1 > 5 ) && ( limit1 < 15 ))	
			  { 
			document.getElementById('tel').style.borderColor = "#00FF00";
				
			  }
			else
			{
				document.getElementById('tel').style.borderColor = "#ff0000";
			}}
		}
	}
	
	
	if(id == 'email')
	{		
		if (obj == "")
		{
			document.getElementById('email').style.borderColor = "#ff0000";
		}
		else if(obj != "")
		{
			var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;

			if(!(document.getElementById('email').value.match(emailExp)))
			{
				document.getElementById('email').style.borderColor = "#ff0000";
			}
			else
			{
				document.getElementById('email').style.borderColor = "#00FF00";
			}
		}
	}
	
	if (id == 'nation')
	{		
		if (obj == "")
		{
			document.getElementById('nation').style.borderColor = "#ff0000";
		}
		else if(obj != "")
		{
			var alphaExp = /^[a-zA-Z]+$/;
			if(!(document.getElementById('nation').value.match(alphaExp)))
			{
				document.getElementById('nation').style.borderColor = "#ff0000";
			}
			else
			{
				document.getElementById('nation').style.borderColor = "#00FF00";
			}
		}
	}
	
	
	if(id == 'captcha')
	{
		if(obj == "")
		{
			document.getElementById('captcha').style.borderColor = "#ff0000";
			}
	}
	}
	

//end of empty

//............................... function  for feedback .....................//
feedback = function() {
	var name 	= $('#sname').val();
	var cname 	= $('#cname').val();
	var tel 	= $('#tel').val();
	var fax 	= $('#fax').val();
	var email 	= $('#email').val();
	var sbmail  =$('#sbmail').val();
	var msg =$('#msg').val();
	var captcha	= $('#captcha').val();

if(name == "") {
		document.getElementById('sname').style.borderColor = "#ff0000";
		document.getElementById('sname').focus();
		return false;
	}
	
if(name != "")
		{ 
			var alphaExp = /^[a-z A-Z]+$/;
			if(!(name.match(alphaExp)))
			{
				document.getElementById('sname').style.borderColor = "#ff0000";
				document.getElementById('sname').focus();
					return false;
			}
			else
			{
				document.getElementById('sname').style.borderColor = "#00FF00";	
			}
		}
if (tel == "") 
		{
			document.getElementById('tel').style.borderColor = "#ff0000";
			document.getElementById('tel').focus();
				return false;
			
		}

if(tel != "")
		{			
			var numericExpression = /^[0-9---+]+$/;
			var len=document.getElementById('tel').value;
			var limit=len.length;
			if (!(tel.match(numericExpression)))
		    {				
				document.getElementById('tel').style.borderColor = "#ff0000";
				document.getElementById('tel').focus();
					return false;
			  }
				else{
		if(( limit > 5 ) && ( limit < 15 ))	
			{ 
			document.getElementById('tel').style.borderColor = "#00FF00";
				
			}
			else
			{
				document.getElementById('tel').style.borderColor = "#ff0000";
				document.getElementById('tel').focus();
					return false;
			}}
		}	
if (fax == "") 
		{
			document.getElementById('fax').style.borderColor = "#ff0000";
			document.getElementById('fax').focus();
				return false;
			
		}

if(fax != "")
		{				
			var numericExpression = /^[0-9---+]+$/;
			var len1=document.getElementById('fax').value;
			var limit1=len1.length;
			if (!(fax.match(numericExpression)))
		    {				
				document.getElementById('fax').style.borderColor = "#ff0000";
				document.getElementById('fax').focus();
					return false;
			}else{	
			if(( limit1 > 5 ) && ( limit1 < 15 ))	
			{ 
			document.getElementById('fax').style.borderColor = "#00FF00";
				
			}
			else
			{
				document.getElementById('fax').style.borderColor = "#ff0000";
				document.getElementById('fax').focus();
					return false;
			}}
		}		
if (email == "")
		{
			document.getElementById('email').style.borderColor = "#ff0000";
			document.getElementById('email').focus();
				return false;
		}
		
if(email!="")
		{	
			var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
			if(!(email.match(emailExp)))
			{
				document.getElementById('email').style.borderColor = "#ff0000";
				document.getElementById('email').focus();
					return false;
			}
			else
			{
				document.getElementById('email').style.borderColor = "#00FF00";
				
					
				}
			
		}	
if(sbmail == "") {
		document.getElementById('sbmail').style.borderColor = "#ff0000";
		document.getElementById('sbmail').focus();
		return false;
	}
	
if(sbmail != "")
		{ 
			var alphaExp = /^[a-z A-Z]+$/;
			if(!(sbmail.match(alphaExp)))
			{
				document.getElementById('sbmail').style.borderColor = "#ff0000";
				document.getElementById('sbmail').focus();
					return false;
			}
			else
			{document.getElementById('sbmail').style.borderColor = "#00FF00";
				
			}
		}		
if(msg == "") {
		document.getElementById('msg').style.borderColor = "#ff0000";
		document.getElementById('msg').focus();
		return false;
	}
	
if(msg != "")
		{ 
			var alphaExp = /^[a-z A-Z]+$/;
			if(!(msg.match(alphaExp)))
			{
				document.getElementById('msg').style.borderColor = "#ff0000";
				document.getElementById('msg').focus();
				return false;
			}
			else
			{
				document.getElementById('msg').style.borderColor = "#00FF00";
				
			}
		}	
	
if(captcha == "") {
		document.getElementById('captcha').style.borderColor = "#ff0000";
		document.getElementById('captcha').focus();
		return false;
	}	else{document.getElementById('captcha').style.borderColor = "#00FF00";}
	

var data = 'sname=' + name + '&cname=' + cname + '&tel=' + tel +'&email=' + email +'&fax=' + fax + '&sbmail=' + sbmail + '&message=' + msg + '&captcha='+ captcha;
			
			//show the loading sign
			

				var xmlHttp;
					try
					{  
					// Firefox, Opera 8.0+, Safari 
						 xmlHttp=new XMLHttpRequest();  
					}
					catch (e)
					{ 
					 // Internet Explorer  
						try
						{    
							xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");    
						}
						catch (e)
						{    
							try
							{     	
								xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");      
							}
							 catch (e)
							 {      
								  alert("Your browser does not support AJAX!");
								  return flase;
							 }
						}
					  }
						
				var url="caab-contactus-submit.php?"+data;
				xmlHttp.onreadystatechange=function()
				{	
					if(xmlHttp.readyState==4)
					{
						x=xmlHttp.responseText;
						result = x.indexOf(".");
						if (result > 1) {
							$('#listing').fadeOut('slow');					
							//show the success message
							$('#success').fadeIn('slow');
						}
						else
						{
							document.getElementById('captcha').style.borderColor = "#ff0000";
		           			document.getElementById('captcha').focus();
						}
					}
				}
				xmlHttp.open("GET",url,true);
				xmlHttp.send(null);
				return false;
			
	
	}

//end of feedbk function
//...................empty function..................//
empty = function(id)
{	

	var obj = document.getElementById(id).value;

	if (id == 'sname')
	{		
		if (obj == "")
		{
			document.getElementById('sname').style.borderColor = "#ff0000";
			
		}
		else if(obj != "")
		{
			var alphaExp = /^[a-zA-Z]+$/;
			if(!(document.getElementById('sname').value.match(alphaExp)))
			{
				document.getElementById('sname').style.borderColor = "#ff0000";
				
			}
			else
			{
				document.getElementById('sname').style.borderColor = "#00FF00";
				
			}
		}
	}



	if(id == 'tel')
	{		
		if(obj == "")
		{
			document.getElementById('tel').style.borderColor = "#ff0000";
			
		}
		else if(obj != "")
		{
			var numericExpression = /^[0-9]+$/;
			var len1=document.getElementById('tel').value;
			var limit1=len1.length;
			if (!(document.getElementById('tel').value.match(numericExpression)))
		     {
				document.getElementById('tel').style.borderColor = "#ff0000";
			   }
			else{	 
			if(( limit1 > 5 ) && ( limit1 < 15 ))	
			  { 
			document.getElementById('tel').style.borderColor = "#00FF00";
				
			  }
			else
			{
				document.getElementById('tel').style.borderColor = "#ff0000";
			}}
		}
	}
	
	if(id == 'fax')
	{		
		if(obj == "")
		{
			document.getElementById('fax').style.borderColor = "#ff0000";
			
		}
		else if(obj != "")
		{
			var numericExpression = /^[0-9]+$/;
			var len2=document.getElementById('fax').value;
			var limit2=len2.length;
			if (!(document.getElementById('fax').value.match(numericExpression)))
		    {
				document.getElementById('fax').style.borderColor = "#ff0000";
			}else{
			if(( limit2 > 5 ) && ( limit2 < 15 ))	
			  { 
			document.getElementById('fax').style.borderColor = "#00FF00";
				
			  }
			else
			{
				document.getElementById('fax').style.borderColor = "#ff0000";
			}}
		}
	}

	if(id == 'email')
	{		
		if (obj == "")
		{
			document.getElementById('email').style.borderColor = "#ff0000";
		}
		else if(obj != "")
		{
			var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;

			if(!(document.getElementById('email').value.match(emailExp)))
			{
				document.getElementById('email').style.borderColor = "#ff0000";
			}
			else
			{
				document.getElementById('email').style.borderColor = "#00FF00";
			}
		}
	}
	if (id == 'sbmail')
	{		
		if (obj == "")
		{
			document.getElementById('sbmail').style.borderColor = "#ff0000";
		}
		else if(obj != "")
		{
			var alphaExp = /^[a-zA-Z]+$/;
			if(!(document.getElementById('sbmail').value.match(alphaExp)))
			{
				document.getElementById('sbmail').style.borderColor = "#ff0000";
			}
			else
			{
				document.getElementById('sbmail').style.borderColor = "#00FF00";
			}
		}
	}
	if (id == 'msg')
	{		
		if (obj == "")
		{
			document.getElementById('msg').style.borderColor = "#ff0000";
		}
		else if(obj != "")
		{
			var alphaExp = /^[a-zA-Z]+$/;
			if(!(document.getElementById('msg').value.match(alphaExp)))
			{
				document.getElementById('msg').style.borderColor = "#ff0000";
			}
			else
			{
				document.getElementById('msg').style.borderColor = "#00FF00";
			}
		}
	}
	if(id == 'captcha')
	{
		if(obj == "")
		{
			document.getElementById('captcha').style.borderColor = "#ff0000";
		}
		else {
			document.getElementById('captcha').style.borderColor = "#00ff00";
		}
	}
}
	

//end of empty

//....................function for tender application................//

tenderapply = function() {
	var name 	= $('#fname').val();
	var cname 	= $('#cname').val();
	var tel 	= $('#tel').val();
	var fax 	= $('#fax').val();
	var email 	= $('#email').val();
	var cell  	= $('#cell').val();
	
	var captcha	= $('#captcha').val();
	if(name == "") {
		document.getElementById('fname').style.borderColor = "#ff0000";
		document.getElementById('fname').focus();
		return false;
	}
	
	if(name != "")	{ 
			var alphaExp = /^[a-z A-Z]+$/;
			if(!(name.match(alphaExp)))
			{
				document.getElementById('fname').style.borderColor = "#ff0000";
				document.getElementById('fname').focus();
					return false;
			}
			else
			{document.getElementById('fname').style.borderColor = "#00FF00";
				
			}
		}
		
		if(cname == "") {
		document.getElementById('cname').style.borderColor = "#ff0000";
		document.getElementById('cname').focus();
		return false;
	}
	
if(cname != "")
		{ 
			var alphaExp = /^[a-z A-Z]+$/;
			if(!(name.match(alphaExp)))
			{
				document.getElementById('cname').style.borderColor = "#ff0000";
				document.getElementById('cname').focus();
					return false;
			}
			else
			{document.getElementById('cname').style.borderColor = "#00FF00";
				
			}
		}
		
		
if (tel == "") 
		{
			document.getElementById('tel').style.borderColor = "#ff0000";
			document.getElementById('tel').focus();
				return false;
			
		}

if(tel != "")
		{			
			var numericExpression = /^[0-9---+]+$/;
			var len=document.getElementById('tel').value;
			var limit=len.length;
			if (!(tel.match(numericExpression)))
		    {				
				document.getElementById('tel').style.borderColor = "#ff0000";
				document.getElementById('tel').focus();
					return false;
			  }
				else{
		if(( limit > 5 ) && ( limit < 15 ))	
			{ 
			document.getElementById('tel').style.borderColor = "#00FF00";
				
			}
			else
			{
				document.getElementById('tel').style.borderColor = "#ff0000";
				document.getElementById('tel').focus();
					return false;
			}}
		}	
if (fax == "") 
		{
			document.getElementById('fax').style.borderColor = "#ff0000";
			document.getElementById('fax').focus();
				return false;
			
		}

if(fax != "")
		{				
			var numericExpression = /^[0-9---+]+$/;
			var len1=document.getElementById('fax').value;
			var limit1=len1.length;
			if (!(fax.match(numericExpression)))
		    {				
				document.getElementById('fax').style.borderColor = "#ff0000";
				document.getElementById('fax').focus();
					return false;
			}else{	
			if(( limit1 > 5 ) && ( limit1 < 15 ))	
			{ 
			document.getElementById('fax').style.borderColor = "#00FF00";
				
			}
			else
			{
				document.getElementById('fax').style.borderColor = "#ff0000";
				document.getElementById('fax').focus();
					return false;
			}}
		}		
if (email == "")
		{
			document.getElementById('email').style.borderColor = "#ff0000";
			document.getElementById('email').focus();
				return false;
		}
		
if(email!="")
		{	
			var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
			if(!(email.match(emailExp)))
			{
				document.getElementById('email').style.borderColor = "#ff0000";
				document.getElementById('email').focus();
					return false;
			}
			else
			{
				document.getElementById('email').style.borderColor = "#00FF00";
				
					
				}
			
		}	
if (tel == "") 
		{
			document.getElementById('tel').style.borderColor = "#ff0000";
			document.getElementById('tel').focus();
				return false;
			
		}

if(cell != "")
		{			
			var numericExpression = /^[0-9---+]+$/;
			var lenn=document.getElementById('cell').value;
			var limitt=lenn.length;
			if (!(tel.match(numericExpression)))
		    {				
				document.getElementById('cell').style.borderColor = "#ff0000";
				document.getElementById('cell').focus();
					return false;
			  }
				else{
		if(( limitt > 5 ) && ( limitt < 15 ))	
			{ 
			document.getElementById('cell').style.borderColor = "#00FF00";
				
			}
			else
			{
				document.getElementById('cell').style.borderColor = "#ff0000";
				document.getElementById('cell').focus();
					return false;
			}}
		}	
		
	if(captcha == "") {
		document.getElementById('captcha').style.borderColor = "#ff0000";
		document.getElementById('captcha').focus();
		return false;
	}	
	
	return true;
}

//end of tender application function
//empty function
empty2 = function(id)
{	
	
	var obj = document.getElementById(id).value;

	if (id == 'fname')
	{		
		if (obj == "")
		{
			document.getElementById('fname').style.borderColor = "#ff0000";
			
		}
		else if(obj != "")
		{
			var alphaExp = /^[a-z A-Z]+$/;
			if(!(document.getElementById('fname').value.match(alphaExp)))
			{
				document.getElementById('fname').style.borderColor = "#ff0000";
				
			}
			else
			{
				document.getElementById('fname').style.borderColor = "#00FF00";
				
			}
		}
	}

if (id == 'cname')
	{		
		if (obj == "")
		{
			document.getElementById('cname').style.borderColor = "#ff0000";
			
		}
		else if(obj != "")
		{
			var alphaExp = /^[a-zA-Z]+$/;
			if(!(document.getElementById('cname').value.match(alphaExp)))
			{
				document.getElementById('cname').style.borderColor = "#ff0000";
				
			}
			else
			{
				document.getElementById('cname').style.borderColor = "#00FF00";
				
			}
		}
	}

	if(id == 'tel')
	{		
		if(obj == "")
		{
			document.getElementById('tel').style.borderColor = "#ff0000";
			
		}
		else if(obj != "")
		{
			var numericExpression = /^[0-9]+$/;
			var len1=document.getElementById('tel').value;
			var limit1=len1.length;
			if (!(document.getElementById('tel').value.match(numericExpression)))
		     {
				document.getElementById('tel').style.borderColor = "#ff0000";
			   }
			else{	 
			if(( limit1 > 6	 ) && ( limit1 < 15 ))	
			  { 
			document.getElementById('tel').style.borderColor = "#00FF00";
				
			  }
			else
			{
				document.getElementById('tel').style.borderColor = "#ff0000";
			}}
		}
	}
	
	if(id == 'fax')
	{		
		if(obj == "")
		{
			document.getElementById('fax').style.borderColor = "#ff0000";
			
		}
		else if(obj != "")
		{
			var numericExpression = /^[0-9]+$/;
			var len2=document.getElementById('fax').value;
			var limit2=len2.length;
			if (!(document.getElementById('fax').value.match(numericExpression)))
		    {
				document.getElementById('fax').style.borderColor = "#ff0000";
			}else{
			if(( limit2 > 6 ) && ( limit2 < 15 ))	
			  { 
			document.getElementById('fax').style.borderColor = "#00FF00";
				
			  }
			else
			{
				document.getElementById('fax').style.borderColor = "#ff0000";
			}}
		}
	}

	if(id == 'email')
	{		
		if (obj == "")
		{
			document.getElementById('email').style.borderColor = "#ff0000";
		}
		else if(obj != "")
		{
			var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;

			if(!(document.getElementById('email').value.match(emailExp)))
			{
				document.getElementById('email').style.borderColor = "#ff0000";
			}
			else
			{
				document.getElementById('email').style.borderColor = "#00FF00";
			}
		}
	}
	
	if(id == 'cell')
	{		
		if(obj == "")
		{
			document.getElementById('cell').style.borderColor = "#ff0000";
		}
		else if(obj != "")
		{
			var numericExpression = /^[0-9]+$/;
			var lenn=document.getElementById('cell').value;
			var limitt=lenn.length;
			if (!(document.getElementById('cell').value.match(numericExpression)))
			{
				document.getElementById('cell').style.borderColor = "#ff0000";
			}
			else
			{	 
				if(( limitt > 6) && ( limitt < 15 ))	
			  	{ 
					document.getElementById('cell').style.borderColor = "#00FF00";
			  	}
				else
				{
					document.getElementById('cell').style.borderColor = "#ff0000";
				}
			}
		}
	}
	
	
	
	
	if(id == 'captcha')
	{
		if(obj == "")
		{
			document.getElementById('captcha').style.borderColor = "#ff0000";
			}
	}
	}
	

//end of empty

//....................function for tender application................//

tellfriend = function() {
	var uremail 	= $('#uremail').val();
	var urname 	= $('#urname').val();
	var frndemail 	= $('#frndemail').val();
	var frndname 	= $('#frndname').val();
	var url 	= $('#url').val();
	if (uremail == "")
		{
			document.getElementById('uremail').style.borderColor = "#ff0000";
			document.getElementById('uremail').focus();
				return false;
		}
		
if(uremail!="")
		{	
			var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
			if(!(uremail.match(emailExp)))
			{
				document.getElementById('uremail').style.borderColor = "#ff0000";
				document.getElementById('uremail').focus();
					return false;
			}
			else
			{
				document.getElementById('uremail').style.borderColor = "#00FF00";
				
					
				}
			
		}	
if(urname == "") {
		document.getElementById('urname').style.borderColor = "#ff0000";
		document.getElementById('urname').focus();
		return false;
	}
	
if(urname != "")
		{ 
			var alphaExp = /^[a-z A-Z]+$/;
			if(!(urname.match(alphaExp)))
			{
				document.getElementById('urname').style.borderColor = "#ff0000";
				document.getElementById('urname').focus();
					return false;
			}
			else
			{document.getElementById('urname').style.borderColor = "#00FF00";
				
			}
		}
		
		if (frndemail == "")
		{
			document.getElementById('frndemail').style.borderColor = "#ff0000";
			document.getElementById('frndemail').focus();
				return false;
		}
		
if(frndemail!="")
		{	
			var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
			if(!(frndemail.match(emailExp)))
			{
				document.getElementById('frndemail').style.borderColor = "#ff0000";
				document.getElementById('frndemail').focus();
					return false;
			}
			else
			{
				document.getElementById('frndemail').style.borderColor = "#00FF00";
				
					
				}
			
		}	
		if(frndname == "") {
		document.getElementById('frndname').style.borderColor = "#ff0000";
		document.getElementById('frndname').focus();
		return false;
	}
	
if(frndname != "")
		{ 
			var alphaExp = /^[a-z A-Z]+$/;
			if(!(frndname.match(alphaExp)))
			{
				document.getElementById('frndname').style.borderColor = "#ff0000";
				document.getElementById('frndname').focus();
					return false;
			}
			else
			{document.getElementById('frndname').style.borderColor = "#00FF00";
				
			}
		}
/*
if(msg == "") {
		document.getElementById('msg').style.borderColor = "#ff0000";
		document.getElementById('msg').focus();
		return false;
	}
	
if(msg != "")
		{ 
			var alphaExp = /^[a-z A-Z]+$/;
			if(!(msg.match(alphaExp)))
			{
				document.getElementById('msg').style.borderColor = "#ff0000";
				document.getElementById('msg').focus();
					return false;
			}
			else
			{document.getElementById('msg').style.borderColor = "#00FF00";
				
			}
		}

*/

	

var data = 'uremail=' + uremail + '&urname=' + urname + '&frndemail=' + frndemail +'&frndname=' + frndname +'&url=' + url ;
	
			
			//show the loading sign
			

				var xmlHttp;
					try
					{  
					// Firefox, Opera 8.0+, Safari 
						 xmlHttp=new XMLHttpRequest();  
					}
					catch (e)
					{ 
					 // Internet Explorer  
						try
						{    
							xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");    
						}
						catch (e)
						{    
							try
							{     	
								xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");      
							}
							 catch (e)
							 {      
								  alert("Your browser does not support AJAX!");
								  return flase;
							 }
						}
					  }
						
				var url="friend.php?"+data;
				xmlHttp.onreadystatechange=function()
				{	
					if(xmlHttp.readyState==4)
					{
						x=xmlHttp.responseText;
						result = x.indexOf(".");
						if (result > 1) {
							$('#listing').fadeOut('slow');					
							//show the success message
							$('.done').fadeIn('slow');
						}
						
					}
				}
				xmlHttp.open("GET",url,true);
				xmlHttp.send(null);
				return false;

	
	}

//end of tender application function
//empty function
empty3 = function(id)
{	

	var obj = document.getElementById(id).value;

	if (id == 'urname')
	{		
		if (obj == "")
		{
			document.getElementById('urname').style.borderColor = "#ff0000";
			
		}
		else if(obj != "")
		{
			var alphaExp = /^[a-zA-Z]+$/;
			if(!(document.getElementById('urname').value.match(alphaExp)))
			{
				document.getElementById('urname').style.borderColor = "#ff0000";
				
			}
			else
			{
				document.getElementById('urname').style.borderColor = "#00FF00";
				
			}
		}
	}

if (id == 'frndname')
	{		
		if (obj == "")
		{
			document.getElementById('frndname').style.borderColor = "#ff0000";
			
		}
		else if(obj != "")
		{
			var alphaExp = /^[a-zA-Z]+$/;
			if(!(document.getElementById('frndname').value.match(alphaExp)))
			{
				document.getElementById('frndname').style.borderColor = "#ff0000";
				
			}
			else
			{
				document.getElementById('frndname').style.borderColor = "#00FF00";
				
			}
		}
	}

	

	if(id == 'uremail')
	{		
		if (obj == "")
		{
			document.getElementById('uremail').style.borderColor = "#ff0000";
		}
		else if(obj != "")
		{
			var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;

			if(!(document.getElementById('uremail').value.match(emailExp)))
			{
				document.getElementById('uremail').style.borderColor = "#ff0000";
			}
			else
			{
				document.getElementById('uremail').style.borderColor = "#00FF00";
			}
		}
	}
	
	if(id == 'frndemail')
	{		
		if (obj == "")
		{
			document.getElementById('frndemail').style.borderColor = "#ff0000";
		}
		else if(obj != "")
		{
			var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;

			if(!(document.getElementById('frndemail').value.match(emailExp)))
			{
				document.getElementById('frndemail').style.borderColor = "#ff0000";
			}
			else
			{
				document.getElementById('frndemail').style.borderColor = "#00FF00";
			}
		}
	}
	if(id == 'msg')
	{		
		if (obj == "")
		{
			document.getElementById('msg').style.borderColor = "#ff0000";
		}
		else if(obj != "")
		{
			var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;

			if(!(document.getElementById('msg').value.match(emailExp)))
			{
				document.getElementById('msg').style.borderColor = "#ff0000";
			}
			else
			{
				document.getElementById('msg').style.borderColor = "#00FF00";
			}
		}
	}
	}
	

//end of empty


var olda = 0;

fetchProject = function(pro, id) {
	if(olda == 0) {
		olda = id;
		document.getElementById("a_" + olda).className = "left_corner1";
		document.getElementById("s_" + olda).className = "right_corner";
	}
	else {
		//Change Class from Gray to Blue to Old Tab
		document.getElementById("a_" + olda).className = "left_cornerb";
		document.getElementById("s_" + olda).className = "right_cornerb";

		//Change Class from Blue to Gray to New Tab
		olda = id;
		document.getElementById("a_" + olda).className = "left_corner1";
		document.getElementById("s_" + olda).className = "right_corner";
	}
	//document.getElementById('temp').value = tid;
	var url;
	url="caab-fetchprojects.php?pro="+pro;

	var xmlHttp;
	try
	{  
	// Firefox, Opera 8.0+, Safari 
		 xmlHttp=new XMLHttpRequest();  
	}
	catch (e)
	{ 
	 // Internet Explorer  
		try
		{    
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");    
		}
		catch (e)
		{    
			try
			{     	
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");      
			}
			 catch (e)
			 {      
				  alert("Your browser does not support AJAX!");
				  return false;  
			 }
		}
	  }
	  xmlHttp.onreadystatechange=function()
	  {
		if(xmlHttp.readyState==4)
		{
			xx=xmlHttp.responseText;
			document.getElementById('projectDetails').innerHTML = xx;
		}
	  }
	  xmlHttp.open("Get",url,true);
	  xmlHttp.send(null);	
}

imagegallery = function(img,txtname)
{

	var formstr='<div><div><h1>'+txtname+'</h1></div><div style="padding-top:10px; padding-left:10px;" align="center"><img src="possbpser/'+img+'" alt=""  width="200" /></div></div>'
	
		jqistates = {
		state0: {
			html: formstr,
			focus: 1,
			buttons: { Close: false },
			submit: function(v, m, f){
			var e = "";
			m.find('.errorBlock').hide('fast',function(){ jQuery(this).remove(); });
		
			if (v) {
				if (e == "") {	
				
				}
			else{
				jQuery('<div class="errorBlock" style="display: none;">'+ e +'</div>').prependTo(m).show('slow');
			}
			return false;
		}
		else return true;
	}
	},
	state1: {
		html: '<div id="response" style="text-align:center;"></div>',
		focus: 1,
		buttons: { Back: false, Done: true },
		submit: function(v,m,f){
		if(v)
			return true;
			
		jQuery.prompt.goToState('state0');
		return false;
			}
		}
	};
	$.prompt(jqistates);	
}