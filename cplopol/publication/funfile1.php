<script  type = "text/javascript">   
		
		
//drop down code is written below ------------------------------------------------
		function xmlReply()
		{	
				
			if (window.XMLHttpRequest) 
			{
				xmlHttp = new XMLHttpRequest();
			}
			else
			{
				xmlHttp = new ActiveXObject("MSXML2.XMLHTTP");
			}
			var element;
			element=document.getElementById("cmscat").value
			var url =  "./view_Test2.php?drop1=" + element ;
			xmlHttp.onreadystatechange=onXmlReply;
			xmlHttp.open("GET",url, true);
			xmlHttp.send(null);
		}

		function onXmlReply()
		{
			if(xmlHttp.readyState == 4)
			{
				if(xmlHttp.status == 200)
				{
					document.getElementById('corpname').innerHTML = xmlHttp.responseText;
				}
			}
		}
		
		function display(txtid)
		{			
			document.getElementById('txtid').value=txtid;
		}
		</script>