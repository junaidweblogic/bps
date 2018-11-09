postopportunity = function()
{
	var formstr = '<form name="fmfrnd" id="fmfrnd" method="GET">'+'<div id="innerInfo"></div></form>';
	
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
		var url="bps-post-opportunity.php";
	xmlHttp.onreadystatechange=function()
	{
		if(xmlHttp.readyState==4)
		{
			document.getElementById('innerInfo').innerHTML=xmlHttp.responseText;
			
		}
	}
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
	
	jqistates = {
		state0: {
			html: formstr,
			focus: 1,
			buttons: { Send: true, Close: false },
			submit: function(v, m, f){
			var e = "";
			m.find('.errorBlock').hide('fast',function(){ jQuery(this).remove(); });
		
			if (v) {
				
				if(document.getElementById("sectors").value == "")
					e += "Please Select Sector! <br>";
				if(document.getElementById("company").value == "")
					e += "Please Select Company! ";

				if (e == "") {	
					jQuery.prompt.goToState('state1');
					$.ajax({   
						  type: "GET",   
						  url: "bps-opportunity-submit.php",   
						  data: $("#fmfrnd").serialize(),   
						  success: function() {   
							$('#response').html("<div id='message'></div>");   
							$('#message').html("<h2>Thank you for your details.</h2>")   
							.append("<p>your post will be listed after admin approval !</p>")   
						  }   
						}); 
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


/****************************************************************************************************************
****************************************************************************************************************

function 	: 	newsdesc 
parameter 	:	News Id

****************************************************************************************************************
****************************************************************************************************************/

newsdesc = function(nid)
{
	var formstr = '<form name="fmfrnd" id="fmfrnd" method="GET"><div class="title" style="text-align:center;"> News </div>'+'<div id="innerInfo" style="height:350px; width:750px; overflow:auto;"></div></form>';
	
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
	var url="bps-news_details.php?nid="+nid;
	xmlHttp.onreadystatechange=function()
	{
		if(xmlHttp.readyState==4)
		{
			document.getElementById('innerInfo').innerHTML=xmlHttp.responseText;
		}
	}
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
	
	jqistates = {
		state0: {
			html: formstr,
			focus: 1,
			buttons: { Close: false },
			submit: function(v, m, f){
			var e = "";
			m.find('.errorBlock').hide('fast',function(){ jQuery(this).remove(); });
		
			if (v) {
				
				if(document.getElementById("sectors").value == "")
					e += "Please Select Sector! <br>";
				if(document.getElementById("company").value == "")
					e += "Please Select Company! ";

				if (e == "") {	
					jQuery.prompt.goToState('state1');
					$.ajax({   
						  type: "GET",   
						  url: "bps-opportunity-submit.php",   
						  data: $("#fmfrnd").serialize(),   
						  success: function() {   
							$('#response').html("<div id='message'></div>");   
							$('#message').html("<h2>Request Submitted Successfully!</h2>")   
							.append("<p>We will be in touch soon.</p>")   
						  }   
						}); 
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

/****************************************************************************************************************
****************************************************************************************************************

function 	: 	cms details 
parameter 	:	Cms Id

****************************************************************************************************************
****************************************************************************************************************/

details = function(title,cid,subtitle)
{
	var formstr = '<form name="fmfrnd" id="fmfrnd" method="GET"><div class="title" style="text-align:center;"> '+ title +' - '+ subtitle +' </div>'+'<div id="innerInfo" style="height:350px; width:750px; overflow:auto;"></div></form>';
	
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
	var url="bps-cms-details.php?cid="+cid;
	xmlHttp.onreadystatechange=function()
	{
		if(xmlHttp.readyState==4)
		{
			document.getElementById('innerInfo').innerHTML=xmlHttp.responseText;
		}
	}
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
	
	jqistates = {
		state0: {
			html: formstr,
			focus: 1,
			buttons: { Close: false },
			submit: function(v, m, f){
			var e = "";
			m.find('.errorBlock').hide('fast',function(){ jQuery(this).remove(); });
		
			if (v) {
				
				if(document.getElementById("sectors").value == "")
					e += "Please Select Sector! <br>";
				if(document.getElementById("company").value == "")
					e += "Please Select Company! ";

				if (e == "") {	
					jQuery.prompt.goToState('state1');
					$.ajax({   
						  type: "GET",   
						  url: "bps-opportunity-submit.php",   
						  data: $("#fmfrnd").serialize(),   
						  success: function() {   
							$('#response').html("<div id='message'></div>");   
							$('#message').html("<h2>Request Submitted Successfully!</h2>")   
							.append("<p>We will be in touch soon.</p>")   
						  }   
						}); 
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

/****************************************************************************************************************
****************************************************************************************************************

function 	: 	postcomment 
parameter 	:	post id

****************************************************************************************************************
****************************************************************************************************************/

postcomment = function(pid)
{
	var formstr = '<form name="fmfrnd" id="fmfrnd" method="GET">'+'<div id="innerInfo" style=""></div></form>';
	
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
	var url="bps-fetch_comment.php?pid="+pid;
	xmlHttp.onreadystatechange=function()
	{
		if(xmlHttp.readyState==4)
		{
			document.getElementById('innerInfo').innerHTML=xmlHttp.responseText;
		}
	}
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
	
	jqistates = {
		state0: {
			html: formstr,
			focus: 1,
			buttons: { Post: true, Close: false },
			submit: function(v, m, f){
			var e = "";
			m.find('.errorBlock').hide('fast',function(){ jQuery(this).remove(); });
		
			if (v) {
				if (e == "") {	
					jQuery.prompt.goToState('state1');
					$.ajax({   
						  type: "POST",   
						  url: "bps-comment-submit.php",   
						  data: $("#fmfrnd").serialize(),   
						  success: function() {   
							$('#response').html("<div id='message'></div>");   
							$('#message').html("<h2>Your Comment Posted Successfully And your posting is pending for approval!</h2>")   
						  }   
						}); 
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
			 window.location = "bps-forum.php"; 
			
		jQuery.prompt.goToState('state0');
		return false;
			}
		}
	};
	$.prompt(jqistates);
}


/****************************************************************************************************************
****************************************************************************************************************

function 	: 	posttopic 
parameter 	:	No Parameter

****************************************************************************************************************
****************************************************************************************************************/

posttopic = function(pid)
{
	var formstr = '<form name="fmfrnd" id="fmfrnd" method="GET">'+'<div id="innerInfo"></div></form>';
	
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
	var url="bps-fetch_comment.php?topic=top";
	xmlHttp.onreadystatechange=function()
	{
		if(xmlHttp.readyState==4)
		{
			document.getElementById('innerInfo').innerHTML=xmlHttp.responseText;
		}
	}
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
	
	jqistates = {
		state0: {
			html: formstr,
			focus: 1,
			buttons: { Post: true, Close: false },
			submit: function(v, m, f){
			var e = "";
			m.find('.errorBlock').hide('fast',function(){ jQuery(this).remove(); });
		
			if (v) {
				if (e == "") {	
					jQuery.prompt.goToState('state1');
					$.ajax({   
						  type: "POST",   
						  url: "bps-comment-submit.php",   
						  data: $("#fmfrnd").serialize(),   
						  success: function() {   
							$('#response').html("<div id='message'></div>");   
							$('#message').html("<h2>Your Post Submitted Successfully and your posting is pending for approval!</h2>")   
						  }   
						}); 
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
			  window.location = "bps-forum.php"; 
			
		jQuery.prompt.goToState('state0');
		return false;
			}
		}
	};
	$.prompt(jqistates);
}




/****************************************************************************************************************
****************************************************************************************************************

function 	: 	displayimage 
parameter 	:	post id

****************************************************************************************************************
****************************************************************************************************************/
displayimage = function(pid)
{
	var formstr = '<form name="fmfrnd" id="fmfrnd" method="GET">'+'<div id="innerInfo"></div></form>';
	
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
	var url="boccim-fetch_gallery.php?pid="+pid;
	xmlHttp.onreadystatechange=function()
	{
		if(xmlHttp.readyState==4)
		{
			document.getElementById('innerInfo').innerHTML=xmlHttp.responseText;
		}
	}
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
	
	jqistates = {
		state0: {
			html: formstr,
			focus: 1,
			buttons: {Close: false },
			submit: function(v, m, f){
			var e = "";
			m.find('.errorBlock').hide('fast',function(){ jQuery(this).remove(); });
		
			if (v) {
				if (e == "") {	
					/*jQuery.prompt.goToState('state1');
					$.ajax({   
						  type: "POST",   
						  url: "boccim-comment-submit.php",   
						  data: $("#fmfrnd").serialize(),   
						  success: function() {   
							$('#response').html("<div id='message'></div>");   
							$('#message').html("<h2>Your Comment Posted Successfully!</h2>")   
						  }   
						}); */
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


/****************************************************************************************************************
****************************************************************************************************************

function 	: 	login 
parameter 	:	NO Parameter


****************************************************************************************************************
****************************************************************************************************************/
function login(val){
			
		if(!val)
			val = "Forum";

		var txt = '<p align="center" class="head_o">' + val + ' Login</p>'+
		'<div align="center"><div class="field"><label for="uname">User Name </label><input type="text" name="urname" id="urname" value="" style="width:180px;"></div>'+
		'<div class="field"><label for="upass">Password </label><input type="password" name="pass" id="pass" value="" style="align:left; width:180px;"></div></div>';			
			

		function mycallbackform(v,m,f){
					var e = "";
					if(v == "Hello") {
				    		 if(f.urname=="")
									e += "Please enter user name<br />";
								
								if(f.pass=="")
									e += "Please enter password.<br />";
							
								if (e == "") 
								{
										
												var url;
												url="loginsubmit.php";
												url=url+"?username="+f.urname+"&password="+f.pass;
											
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

														result = xx.indexOf(".");
														
														if (result > 1)
														{
															window.location.href="bps-my-bps.php?fg=mem";
														}
														else
														{
															$.prompt(xx);
														}
														//jQuery.prompt.getStateContent('state1').find('#intmonthlypayment').text(xx);		
														//jQuery.prompt.goToState('state1');
													}
												  }
												  xmlHttp.open("Get",url,true);
												  xmlHttp.send(null);	
								}
								else
								{
										if(f.urname == "" && f.pass == "")
											$.prompt("Enter Login Details!");	
										else if(f.urname == "")
											$.prompt("Enter User Name!");	
										else if(f.pass == "")
											$.prompt("Enter Password!");	
										
										
											
								}
						 
					}
					else if (v == "Testing") {
							location.href="bps-prof-reg.php";
					}
					else if (v == "Bye") 
					{
							if(f.urname=="")
								e = "Please enter user name<br />";

							if (e == "") 
							{
										
								var url;
								url="submit_forgotpass.php";
								url=url+"?uname="+f.urname;
							
								var xmlHttp;
								try	{  
								// Firefox, Opera 8.0+, Safari 
									 xmlHttp=new XMLHttpRequest();  
								}
								catch (e){ 
								 // Internet Explorer  
									try	{    
										xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");    
									}
									catch (e){    
										try	{     	
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
									if(xmlHttp.readyState==4)
									{
										$.prompt(xmlHttp.responseText);
									}
									//jQuery.prompt.getStateContent('state1').find('#intmonthlypayment').text(xx);		
										//jQuery.prompt.goToState('state1');
								  }
								  xmlHttp.open("Get",url,true);
								 xmlHttp.send(null);	
							}
							else
							{
									var txt = '<p align="center" class="head_o">Forgot Password </p>'+
									'<div align="center"><div class="field"><label for="uname">User Name </label><input type="text" name="furname" id="furname" value="" style="width:180px;"></div></div>';			
									
									$.prompt(txt,{
										  callback: mycallbackform1,
									  buttons: { "Send Password": 'Hello', "Close": 'Bye'}
									});			
			
							}
							
					}
		}

		$.prompt(txt,{
		      callback: mycallbackform,
	      //buttons: { "Login": 'Hello', "Registration": 'Testing'}
		  buttons: { "Login": 'Hello', "Forgot Password" : 'Bye',"Register": 'Testing', Close:false}
		});			
			
		
		function mycallbackform1(v,m,f){
					var e = "";
					if (v == "Hello") 
					{
							if(f.urname=="")
								e = "Please enter user name<br />";

							if (e == "") 
							{
										
								var url;
								url="submit_forgotpass.php";
								url=url+"?uname="+f.furname;
							
								var xmlHttp;
								try	{  
								// Firefox, Opera 8.0+, Safari 
									 xmlHttp=new XMLHttpRequest();  
								}
								catch (e){ 
								 // Internet Explorer  
									try	{    
										xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");    
									}
									catch (e){    
										try	{     	
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
									if(xmlHttp.readyState==4)
									{
										$.prompt(xmlHttp.responseText);
									}
									//jQuery.prompt.getStateContent('state1').find('#intmonthlypayment').text(xx);		
										//jQuery.prompt.goToState('state1');
								  }
								  xmlHttp.open("Get",url,true);
								 xmlHttp.send(null);	
							}
							else
							{
								$.prompt("Please Enter User Name!");
							}
							
					}
		}

/*		$.prompt(txt,{
		      callback: mycallbackform,
	      buttons: { Login: 'Hello', Forgot_Password: 'Bye', Registration: 'Testing' }
		});		
*/			
}



/****************************************************************************************************************
****************************************************************************************************************

function 	: 	allcomments 
parameter 	:	post id


****************************************************************************************************************
****************************************************************************************************************/

allcomments = function(pid)
{
	var formstr = '<form name="fmfrnd" id="fmfrnd" method="GET">'+'<div id="innerInfo" style="width:780px;"></div></form>';
	
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
	var url="bps-fetch-comments.php?pid="+pid;
	xmlHttp.onreadystatechange=function()
	{
		if(xmlHttp.readyState==4)
		{
			document.getElementById('innerInfo').innerHTML=xmlHttp.responseText;
		}
	}
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
	
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
					/*jQuery.prompt.goToState('state1');
					$.ajax({   
						  type: "POST",   
						  url: "boccim-comment-submit.php",   
						  data: $("#fmfrnd").serialize(),   
						  success: function() {   
							$('#response').html("<div id='message'></div>");   
							$('#message').html("<h2>Your Comment Posted Successfully!</h2>")   
						  }   
						}); */
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

/****************************************************************************************************************
****************************************************************************************************************

function 	: 	viewprofile 
parameter 	:	post id


****************************************************************************************************************
****************************************************************************************************************/

profile = function(cid,cnm)
{
	var formstr = '<form name="fmfrnd" id="fmfrnd" method="GET"><div class="title" style="text-align:center;"> '+ cnm +'- Profile</div>'+'<div id="innerInfo" style="height:350px; width:750px; overflow:auto;"></div></form>';
	
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
	var url="boccim-viewprofile.php?cid="+cid;
	xmlHttp.onreadystatechange=function()
	{
		if(xmlHttp.readyState==4)
		{
			document.getElementById('innerInfo').innerHTML=xmlHttp.responseText;
		}
	}
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
	
	jqistates = {
		state0: {
			html: formstr,
			focus: 1,
			buttons: { Close: false },
			submit: function(v, m, f){
			var e = "";
			m.find('.errorBlock').hide('fast',function(){ jQuery(this).remove(); });
		
			if (v) {
				
				if(document.getElementById("sectors").value == "")
					e += "Please Select Sector! <br>";
				if(document.getElementById("company").value == "")
					e += "Please Select Company! ";

				if (e == "") {	
					jQuery.prompt.goToState('state1');
					$.ajax({   
						  type: "GET",   
						  url: "boccim-opportunity-submit.php",   
						  data: $("#fmfrnd").serialize(),   
						  success: function() {   
							$('#response').html("<div id='message'></div>");   
							$('#message').html("<h2>Request Submitted Successfully!</h2>")   
							.append("<p>We will be in touch soon.</p>")   
						  }   
						}); 
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

/****************************************************************************************************************
****************************************************************************************************************

function 	: 	viewbussopp
parameter 	:	post id


****************************************************************************************************************
****************************************************************************************************************/

bussopp = function(cid,cnm)
{
	var formstr = '<form name="fmfrnd" id="fmfrnd" method="GET"><div class="title" style="text-align:center;"> '+ cnm +' - Business Opportunity</div>'+'<div id="innerInfo" style="height:350px; width:750px; overflow:auto;"></div></form>';
	
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
	var url="boccim-viewprofile.php?type=opp&cid="+cid;
	xmlHttp.onreadystatechange=function()
	{
		if(xmlHttp.readyState==4)
		{
			document.getElementById('innerInfo').innerHTML=xmlHttp.responseText;
		}
	}
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
	
	jqistates = {
		state0: {
			html: formstr,
			focus: 1,
			buttons: { Close: false },
			submit: function(v, m, f){
			var e = "";
			m.find('.errorBlock').hide('fast',function(){ jQuery(this).remove(); });
		
			if (v) {
				
				if(document.getElementById("sectors").value == "")
					e += "Please Select Sector! <br>";
				if(document.getElementById("company").value == "")
					e += "Please Select Company! ";

				if (e == "") {	
					jQuery.prompt.goToState('state1');
					$.ajax({   
						  type: "GET",   
						  url: "boccim-opportunity-submit.php",   
						  data: $("#fmfrnd").serialize(),   
						  success: function() {   
							$('#response').html("<div id='message'></div>");   
							$('#message').html("<h2>Request Submitted Successfully!</h2>")   
							.append("<p>We will be in touch soon.</p>")   
						  }   
						}); 
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

/****************************************************************************************************************
****************************************************************************************************************

function 	: 	Forgot Password 
parameter 	:	


****************************************************************************************************************
****************************************************************************************************************/

forgot = function()
{
	var txt = '<p align="center" class="head_o">Forgot Password </p>'+
									'<div align="center"><div class="field"><label for="uname">User Name </label><input type="text" name="furname" id="furname" value="" style="width:180px;"></div></div>';			
									
			
		function mycallbackform(v,f){
					var e = "";
					if(v == "Hello") {
				    		 if(f.urname=="")
									e += "Please enter user name<br />";
								
							
								if (e == "") 
								{
										
												var url;
												url="submit_forgotpass.php";
												url=url+"?uname="+f.urname;
											
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

														result = xx.indexOf(".");
														
														if (result > 1)
														{
															window.location.href="boccim-forum.php";
														}
														else
														{
															$.prompt(xx);
														}
														//jQuery.prompt.getStateContent('state1').find('#intmonthlypayment').text(xx);		
														//jQuery.prompt.goToState('state1');
													}
												  }
												  xmlHttp.open("Get",url,true);
												  xmlHttp.send(null);	
								}
								else
								{
										if(f.urname == "" && f.pass == "")
											$.prompt("Enter Login Details!");	
										else if(f.urname == "")
											$.prompt("Enter User Name!");	
										else if(f.pass == "")
											$.prompt("Enter Password!");	
										
										
											
								}
						 
					}
					else if (v == "Testing") {
							location.href="form.php";
					}
					else if (v == "Bye") 
					{
							if(f.urname=="")
								e = "Please enter user name<br />";

							if (e == "") 
							{
										
								var url;
								url="submit_forgotpass.php";
								url=url+"?uname="+f.urname;
							
								var xmlHttp;
								try	{  
								// Firefox, Opera 8.0+, Safari 
									 xmlHttp=new XMLHttpRequest();  
								}
								catch (e){ 
								 // Internet Explorer  
									try	{    
										xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");    
									}
									catch (e){    
										try	{     	
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
									if(xmlHttp.readyState==4)
									{
										$.prompt(xmlHttp.responseText);
									}
									//jQuery.prompt.getStateContent('state1').find('#intmonthlypayment').text(xx);		
										//jQuery.prompt.goToState('state1');
								  }
								  xmlHttp.open("Get",url,true);
								 xmlHttp.send(null);	
							}
							
					}
		}

		$.prompt(txt,{
			  callback: mycallbackform1,
		  buttons: { "Send Password": 'Hello', "Close": 'Bye'}
		});	
		
		function mycallbackform1(v,m,f){
					var e = "";
					if (v == "Hello") 
					{
							if(f.urname=="")
								e = "Please enter user name<br />";

							if (e == "") 
							{
										
								var url;
								url="submit_forgotpass.php";
								url=url+"?uname="+f.furname;
							
								var xmlHttp;
								try	{  
								// Firefox, Opera 8.0+, Safari 
									 xmlHttp=new XMLHttpRequest();  
								}
								catch (e){ 
								 // Internet Explorer  
									try	{    
										xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");    
									}
									catch (e){    
										try	{     	
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
									if(xmlHttp.readyState==4)
									{
										$.prompt(xmlHttp.responseText);
									}
									//jQuery.prompt.getStateContent('state1').find('#intmonthlypayment').text(xx);		
										//jQuery.prompt.goToState('state1');
								  }
								  xmlHttp.open("Get",url,true);
								 xmlHttp.send(null);	
							}
							else
							{
								$.prompt("Please Enter User Name!");
							}
							
					}
		}

/*		$.prompt(txt,{
		      callback: mycallbackform,
	      buttons: { Login: 'Hello', Forgot_Password: 'Bye', Registration: 'Testing' }
		});		
*/			
}


function changecomp (val)
{
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
		var url="boccim-find-company.php?val="+val;
	xmlHttp.onreadystatechange=function()
	{
		if(xmlHttp.readyState==4)
		{
			document.getElementById('changecompanyaccordingsector').innerHTML="";
			document.getElementById('changecompanyaccordingsector').innerHTML=xmlHttp.responseText;
			
		}
	}
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
}

/****************************************************************************************************************
****************************************************************************************************************

function 	: 	Bulletin Details 
parameter 	:	


****************************************************************************************************************
****************************************************************************************************************/

function bltndetails(desc, mdesc)
{ 	
		var formstr = '<div class="title" style="text-align:center;">Bulletin Details </div>'+'<div align="left" style="height:400px; overflow:auto; text-align:justify;">'  + desc + mdesc + '</div>';

				jqistates = {
						state0: {
						html: formstr,
						focus: 1,				
						buttons: { Close: false },
						submit: function(v, m, f){
							var e = "";
							m.find('.errorBlock').hide('fast',function(){ jQuery(this).remove(); });

							if (v) {
								if (e == "") 
								{
									document.fmfrnd.submit();
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
						html: 'Monthly Payment: $<span id="intmonthlypayment"></span>',
						focus: 1,
						buttons: { Back: false, Done: true },
						submit: function(v,m,f){
							if(v)
								return true;
							jQuery.ImpromptuGoToState('state0');
							return false;
						}
					}
				};
				
				$.prompt(jqistates);
}


imagegallery = function(img,txtname)
{

	var formstr='<div><div><h1>'+txtname+'</h1></div><div style="padding-top:10px; padding-left:10px;" align="center"><img src="possbpser/'+img+'" alt=""  width="400" /></div></div>'
	
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
