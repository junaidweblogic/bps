<?php
//phpinfo();
@session_start();
include("../common/app_function.php");
include("../common/cploconfig.php");
if($_SESSION[username]=="")
{
	displayerror("Login Error.","","For security of your account,we have expired your session.<br>&nbsp;Please login to your account again.", "Login,index.php", 0);
	exit();
}

admin_header("../","Welcome Admin Panel",$tblpref,$db,$sitepath,$siteurl,$path1,$ckpath,$row_admin);
$res_admin=$row_admin['admin_mgmts'];
$resu=explode(',',$res_admin);
$usertype=$_SESSION[user_type];
?>


<!--body start -->
<div class="adminbody">
<div class="box">
		
		<div class="hdr"><h1 class="ico-dash">Dashboard</h1></div>
		<div class="pad">
			<ul class="view">
			<?
				if ((in_array('banner', $resu)) || $usertype=="superadmin")
				{ ?>
					<li>
					<table width="100%" border="0" cellspacing="0" cellpadding="0" class="boxtbl">
					  <tr>
						<td class="vicon"><a href="banner/index.php"><img src="banner/icon/icon.png" alt="Banner" /></a></td>
					  </tr>
					  <tr>
						<td class="clink"><a href="banner/index.php">Banners</a></td>
					  </tr>
					</table>
					</li>
				<?php
				} 
				if ((in_array('cms', $resu)) || $usertype=="superadmin")
				{ ?>
					<li>
					<table width="100%" border="0" cellspacing="0" cellpadding="0" class="boxtbl">
					  <tr>
						<td class="vicon"><a href="cms/index.php"><img src="cms/icon/icon.png" alt="Content" /></a></td>
					  </tr>
					  <tr>
						<td class="clink"><a href="cms/index.php">Content</a></td>
					  </tr>
					</table>
					</li>
				<?php
				}
				if ((in_array('versions', $resu)) || $usertype=="superadmin")
				{ ?>
					<li>
					<table width="100%" border="0" cellspacing="0" cellpadding="0" class="boxtbl">
					  <tr>
						<td class="vicon"><a href="versions/index.php"><img src="versions/icon/icon.png" alt="versions" /></a></td>
					  </tr>
					  <tr>
						<td class="clink"><a href="versions/index.php">Versions</a></td>
					  </tr>
					</table>
					</li>
				<?php
				}
				if ((in_array('database', $resu)) || $usertype=="superadmin")
				{ ?>
					<li>
					<table width="100%" border="0" cellspacing="0" cellpadding="0" class="boxtbl">
					  <tr>
						<td class="vicon"><a href="database/index.php"><img src="database/icon/icon.png" alt="database" /></a></td>
					  </tr>
					  <tr>
						<td class="clink"><a href="database/index.php">Database Backup</a></td>
					  </tr>
					</table>
					</li>
				<?php
				}
				if ((in_array('user', $resu)) || $usertype=="superadmin")
				{ ?>
					<li>
					<table width="100%" border="0" cellspacing="0" cellpadding="0" class="boxtbl">
					  <tr>
						<td class="vicon"><a href="user/index.php"><img src="user/icon/icon.png" alt="Admin User" /></a></td>
					  </tr>
					  <tr>
						<td class="clink"><a href="user/index.php">Admin User</a></td>
					  </tr>
					</table>
					</li>
				<?php
				}?>
			</ul>
    <div class="clear"></div>
	<?php
		if ((in_array('faq', $resu)) || (in_array('event', $resu)) || (in_array('news', $resu)) || (in_array('gallery', $resu))  || (in_array('media', $resu))  || (in_array('links', $resu))  || (in_array('polling', $resu))  || (in_array('missing', $resu))  || (in_array('wanted', $resu)) || (in_array('property', $resu)) || (in_array('publication', $resu)) || (in_array('area', $resu))  || (in_array('city', $resu))  || (in_array('crime-type', $resu))  || $usertype=="superadmin" )
		{ ?>
			<h3>Gallery</h3>
			
				<ul class="view">
				<?php
					if ((in_array('faq', $resu)) || $usertype=="superadmin")
					{ ?>
						<li>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="boxtbl">
						  <tr>
							<td class="vicon"><a href="faq/index.php"><img src="faq/icon/icon.png" alt="FAQ" /></a></td>
						  </tr>
						  <tr>
							<td class="clink"><a href="faq/index.php">FAQ</a></td>
						  </tr>
						</table>
						</li>
					<?php
					}
					if ((in_array('event', $resu)) || $usertype=="superadmin")
					{ ?>
						<li>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="boxtbl">
						  <tr>
							<td class="vicon"><a href="event/index.php"><img src="event/icon/icon.png" alt="Events" /></a></td>
						  </tr>
						  <tr>
							<td class="clink"><a href="event/index.php">Events</a></td>
						  </tr>
						</table>
						</li>
					<?php
					}
					if ((in_array('news', $resu)) || $usertype=="superadmin")
					{ ?>
						<li>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="boxtbl">
						  <tr>
							<td class="vicon"><a href="news/index.php"><img src="news/icon/icon.png" alt="News" /></a></td>
						  </tr>
						  <tr>
							<td class="clink"><a href="news/index.php">News</a></td>
						  </tr>
						</table>
						</li>
					<?php
					}
					if ((in_array('breaking-news', $resu)) || $usertype=="superadmin")
					{ ?>
						<li>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="boxtbl">
						  <tr>
							<td class="vicon"><a href="breaking-news/index.php"><img src="breaking-news/icon/icon.png" alt="Breaking News" /></a></td>
						  </tr>
						  <tr>
							<td class="clink"><a href="breaking-news/index.php">Breaking News</a></td>
						  </tr>
						</table>
						</li>
					<?php
					}
					if ((in_array('gallery', $resu)) || $usertype=="superadmin")
					{ ?>
						<li>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="boxtbl">
						  <tr>
							<td class="vicon"><a href="gallery/index.php"><img src="gallery/icon/icon.png" alt="Gallery" /></a></td>
						  </tr>
						  <tr>
							<td class="clink"><a href="gallery/index.php">Gallery</a></td>
						  </tr>
						</table>
						</li>
					<?php
					}
					if ((in_array('media', $resu)) || $usertype=="superadmin")
					{ ?>
						<li>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="boxtbl">
						  <tr>
							<td class="vicon"><a href="media/index.php"><img src="media/icon/icon.png" alt="Media Center" /></a></td>
						  </tr>
						  <tr>
							<td class="clink"><a href="media/index.php">Media Center</a></td>
						  </tr>
						</table>
						</li>
					<?php
					}
					if ((in_array('links', $resu)) || $usertype=="superadmin")
					{ ?>
						<li>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="boxtbl">
						  <tr>
							<td class="vicon"><a href="links/index.php"><img src="links/icon/icon.png" alt="Links" /></a></td>
						  </tr>
						  <tr>
							<td class="clink"><a href="links/index.php">Links</a></td>
						  </tr>
						</table>
						</li>
					<?php
					}
					if ((in_array('polling', $resu)) || $usertype=="superadmin")
					{ ?>
						<li>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="boxtbl">
						  <tr>
							<td class="vicon"><a href="polling/index.php"><img src="polling/icon/icon.png" alt="Polling" /></a></td>
						  </tr>
						  <tr>
							<td class="clink"><a href="polling/index.php">Polling</a></td>
						  </tr>
						</table>
						</li>
					<?php
					}
					if ((in_array('missing', $resu)) || $usertype=="superadmin")
					{ ?>
						<li>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="boxtbl">
						  <tr>
							<td class="vicon"><a href="missing/index.php"><img src="missing/icon/icon.png" alt="Missing Persons" /></a></td>
						  </tr>
						  <tr>
							<td class="clink"><a href="missing/index.php">Missing Persons</a></td>
						  </tr>
						</table>
						</li>
					<?php
					}
					if ((in_array('wanted', $resu)) || $usertype=="superadmin")
					{ ?>
						<li>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="boxtbl">
						  <tr>
							<td class="vicon"><a href="wanted/index.php"><img src="wanted/icon/icon.png" alt="Wanted Persons" /></a></td>
						  </tr>
						  <tr>
							<td class="clink"><a href="wanted/index.php">Wanted Persons</a></td>
						  </tr>
						</table>
						</li>
					<?php
					}
					if ((in_array('property', $resu)) || $usertype=="superadmin")
					{ ?>
						<li>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="boxtbl">
						  <tr>
							<td class="vicon"><a href="property-cat/index.php"><img src="property-cat/icon/icon.png" alt="Property Category" /></a></td>
						  </tr>
						  <tr>
							<td class="clink"><a href="property-cat/index.php">Property Category</a></td>
						  </tr>
						</table>
						</li>
						<li>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="boxtbl">
						  <tr>
							<td class="vicon"><a href="property/index.php"><img src="property/icon/icon.png" alt="property" /></a></td>
						  </tr>
						  <tr>
							<td class="clink"><a href="property/index.php">Property</a></td>
						  </tr>
						</table>
						</li>
					<?php
					}
					if ((in_array('publication', $resu)) || $usertype=="superadmin")
					{ ?>
						<li>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="boxtbl">
						  <tr>
							<td class="vicon"><a href="publication-cat/index.php"><img src="publication-cat/icon/icon.png" alt="Publication Category" /></a></td>
						  </tr>
						  <tr>
							<td class="clink"><a href="publication-cat/index.php">Publication Category</a></td>
						  </tr>
						</table>
						</li>
						<li>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="boxtbl">
						  <tr>
							<td class="vicon"><a href="publication/index.php"><img src="publication/icon/icon.png" alt="Publication" /></a></td>
						  </tr>
						  <tr>
							<td class="clink"><a href="publication/index.php">Publication</a></td>
						  </tr>
						</table>
						</li>
					<?php
					}
					if ((in_array('area', $resu)) || $usertype=="superadmin")
					{ ?>
						<li>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="boxtbl">
						  <tr>
							<td class="vicon"><a href="area/index.php"><img src="area/icon/icon.png" alt="Area" /></a></td>
						  </tr>
						  <tr>
							<td class="clink"><a href="area/index.php">Area</a></td>
						  </tr>
						</table>
						</li>
					<?php
					}
					if ((in_array('city', $resu)) || $usertype=="superadmin")
					{ ?>
						<li>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="boxtbl">
						  <tr>
							<td class="vicon"><a href="city/index.php"><img src="city/icon/icon.png" alt="City" /></a></td>
						  </tr>
						  <tr>
							<td class="clink"><a href="city/index.php">City</a></td>
						  </tr>
						</table>
						</li>
					<?php
					}
					if ((in_array('police', $resu)) || $usertype=="superadmin")
					{ ?>
						<li>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="boxtbl">
						  <tr>
							<td class="vicon"><a href="police/index.php"><img src="police/icon/icon.png" alt="Police" /></a></td>
						  </tr>
						  <tr>
							<td class="clink"><a href="police/index.php">Police</a></td>
						  </tr>
						</table>
						</li>
					<?php
					}
					if ((in_array('crime-type', $resu)) || $usertype=="superadmin")
					{ ?>
						<li>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="boxtbl">
						  <tr>
							<td class="vicon"><a href="crime-type/index.php"><img src="crime-type/icon/icon.png" alt="Crime Type" /></a></td>
						  </tr>
						  <tr>
							<td class="clink"><a href="crime-type/index.php">Crime Type</a></td>
						  </tr>
						</table>
						</li>
					<?php
					}
					
					?>
				</ul>
			<?php
		} ?>
<div class="clear"></div>
<?php
		if ((in_array('forum', $resu)) || $usertype=="superadmin" )
		{ ?>
			<h3>Forum</h3>
				<ul class="view">
				<?php
					if ((in_array('forum', $resu)) || $usertype=="superadmin")
					{ ?>
						<li>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="boxtbl">
						  <tr>
							<td class="vicon"><a href="forum-user/index.php"><img src="forum-user/icon/icon.png" alt="Forum User" /></a></td>
						  </tr>
						  <tr>
							<td class="clink"><a href="forum-user/index.php">Forum User</a></td>
						  </tr>
						</table>
						</li>

						<li>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="boxtbl">
						  <tr>
							<td class="vicon"><a href="forum/index.php"><img src="forum/icon/icon.png" alt="Forum" /></a></td>
						  </tr>
						  <tr>
							<td class="clink"><a href="forum/index.php">Forum</a></td>
						  </tr>
						</table>
						</li>
					<?php
					}
		}?>
					</ul>
					<div class="clear"></div>
<?php
		if ((in_array('apreport', $resu))  || (in_array('csreport', $resu)) || (in_array('fcreport', $resu)) || (in_array('pmreport', $resu)) ||  (in_array('report', $resu)) ||  (in_array('sareport', $resu)) || $usertype=="superadmin" )
		{ ?>
			<h3>Reports</h3>
				<ul class="view">
				<?php
					if ((in_array('apreport', $resu)) || $usertype=="superadmin")
					{ ?>
						<li>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="boxtbl">
						  <tr>
							<td class="vicon"><a href="apreport/index.php"><img src="apreport/icon/icon.png" alt="Ask the Police " /></a></td>
						  </tr>
						  <tr>
							<td class="clink"><a href="apreport/index.php">Ask the Police </a></td>
						  </tr>
						</table>
						</li>
						<?php
					}
					if ((in_array('csreport', $resu)) || $usertype=="superadmin")
					{ ?>
						<li>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="boxtbl">
						  <tr>
							<td class="vicon"><a href="csreport/index.php"><img src="csreport/icon/icon.png" alt="Customer Satisfaction " /></a></td>
						  </tr>
						  <tr>
							<td class="clink"><a href="csreport/index.php">Customer Satisfaction </a></td>
						  </tr>
						</table>
						</li>
						<?php
					}
						if ((in_array('fcreport', $resu)) || $usertype=="superadmin")
					{ ?>
						<li>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="boxtbl">
						  <tr>
							<td class="vicon"><a href="fcreport/index.php"><img src="fcreport/icon/icon.png" alt="Feedback & Commendation  " /></a></td>
						  </tr>
						  <tr>
							<td class="clink"><a href="fcreport/index.php">Feedback & Commendation </a></td>
						  </tr>
						</table>
						</li>
						<?php
					}
					if ((in_array('pmreport', $resu)) || $usertype=="superadmin")
					{ ?>
						<li>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="boxtbl">
						  <tr>
							<td class="vicon"><a href="pmreport/index.php"><img src="pmreport/icon/icon.png" alt="Police Misconduct" /></a></td>
						  </tr>
						  <tr>
							<td class="clink"><a href="pmreport/index.php">Police Misconduct </a></td>
						  </tr>
						</table>
						</li>
						<?php
					}
					if ((in_array('report', $resu)) || $usertype=="superadmin")
					{ ?>
						<li>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="boxtbl">
						  <tr>
							<td class="vicon"><a href="report/index.php"><img src="report/icon/icon.png" alt="Crime Report" /></a></td>
						  </tr>
						  <tr>
							<td class="clink"><a href="report/index.php">Crime Report</a></td>
						  </tr>
						</table>
						</li>
						<?php
					}
					if ((in_array('sareport', $resu)) || $usertype=="superadmin")
					{ ?>
						<li>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="boxtbl">
						  <tr>
							<td class="vicon"><a href="sareport/index.php"><img src="sareport/icon/icon.png" alt="Crime/ Incident List" /></a></td>
						  </tr>
						  <tr>
							<td class="clink"><a href="sareport/index.php">Crime/ Incident List</a></td>
						  </tr>
						</table>
						</li>
						<?php
					}?>
					</ul>
				<?php
		} ?>
    <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>
</div>
<?php admin_footer();?>