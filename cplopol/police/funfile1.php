<script  type = "text/javascript">   
//drop down code is written below ------------------------------------------------
		function xmlReply(city)
		{	
				
			if (window.XMLHttpRequest) 
			{
				xmlHttp = new XMLHttpRequest();
			}
			else
			{
				xmlHttp = new ActiveXObject("MSXML2.XMLHTTP");
			}
			
			//var element;
			//element=document.getElementById("cmscat").value
			var url =  "./view.php?city="+city;
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
					document.getElementById('areas').innerHTML = xmlHttp.responseText;
				}
			}
		}
		
		function display(txtid)
		{			
			document.getElementById('hcmsarea').value=txtid;
		}
		</script>