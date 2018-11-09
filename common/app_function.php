<?php
error_reporting(~E_ALL);
@session_start();
function index_header($title,$rewritepath,$tblpref,$db,$row_admin, $uploadpath)
{
	@session_start();
	include("config.php");
	 if(basename($_SERVER[PHP_SELF]) != "error.php")
	{
		 //check if javascript is enabled or not
		//include("checkjs.php");
	}	
	//generate rendom value
	$str = str_rand();
	if(isset($_SESSION['userval']))
	{
		$userval = preg_chk($_SESSION['userval']);
		$query = sprintf("SELECT * FROM ".$tblpref."userval WHERE session_val = '%s'", $userval);
		if(!($result = mysqli_query($connection, $query)))
		{
			echo $query.mysqli_connect_errno();
			exit();
		}
		mysqli_num_rows($result);
		if(mysqli_num_rows($result) < 1)
		{
			$hashval = md5($userval);
			$query_ins = sprintf("INSERT INTO ".$tblpref."userval SET session_val = '%s', session_date = CURDATE(), hash_val='%s'", $userval, $hashval);
			if(!($result_ins = mysqli_query($connection, $query_ins)))
			{
				echo $query_ins.mysqli_connect_errno();
				exit();
			}
		}
	}
	else
	{
		$_SESSION['userval'] = $str;
		$userval = $_SESSION['userval'];
		$hashval = md5($userval);
		$query = sprintf("INSERT INTO ".$tblpref."userval SET session_val = '%s', session_date = CURDATE(), hash_val='%s'", $userval, $hashval);
		if(!($result = mysqli_query($connection, $query)))
		{
			echo $query.mysqli_connect_errno();
			exit();
		}
	}
	//Delete Old Tokens
	$qry_chk = "DELETE FROM ".$tblpref."userval WHERE session_date < CURDATE() OR session_date='0000-00-00'";

	if(!($res_chk = mysqli_query($connection, $qry_chk)))
	{
		echo $qry_chk.mysqli_connect_errno();
		exit();
	}
	$get_url = $_SERVER["REQUEST_URI"];
	$url_parameters = explode('/',$get_url);
	$para=2;
	$function_is = $url_parameters[$para] ;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php if($title!=""){ echo $title;}else { ?>Botswana Police Service<?php } ?></title>
<link rel="shortcut icon" href="<?php echo $rewritepath; ?>images/favicon.png">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Oswald:400,700' rel='stylesheet' type='text/css'>
<link href="https://fonts.googleapis.com/css?family=Maven+Pro:400,500,700,900" rel="stylesheet"> 

<!-- Style CSS -->
<link href="<?php echo $rewritepath; ?>css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo $rewritepath; ?>font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $rewritepath; ?>css/animate.min.css" rel="stylesheet">
<link href="<?php echo $rewritepath; ?>css/multi-columns-row.css" rel="stylesheet"><!-- used class multi-columns-row -->
<link rel="stylesheet" type="text/css" href="<?php echo $rewritepath; ?>source/jquery.fancybox.css?v=2.1.5" media="screen" /><!-- Fancy Box Popup -->
<link rel="stylesheet" type="text/css" href="<?php echo $rewritepath; ?>css/responsiveslides.css" />

<link rel="stylesheet" href="<?php echo $rewritepath; ?>eventcal/css/master.css" type="text/css" media="screen" charset="utf-8" />
<!--Fade Gallery-->
<link rel="stylesheet" href="<?php echo $rewritepath; ?>css/menu-styles.css"><!--Navigation Menu-->
<link rel="stylesheet" href="<?php echo $rewritepath; ?>css/other-menu.css"><!--Other Menu-->
<link rel="stylesheet" href="<?php echo $rewritepath; ?>css/othermenu-styles.css"><!--Navigation Menu-->
<link rel="stylesheet" type="text/css" href="<?php echo $rewritepath; ?>css/wow-style.css" />
<link href="<?php echo $rewritepath; ?>css/owl.carousel.css" rel="stylesheet"><!--owl slider-->
<link href="<?php echo $rewritepath; ?>css/owl.theme.css" rel="stylesheet"><!--owl slider-->
<link rel="stylesheet" href="<?php echo $rewritepath; ?>css/datepicker.css">
<link href="<?php echo $rewritepath; ?>css/style-main.css" rel="stylesheet">


<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body>
<header id="top">
<div id="wrapper">
	<div class="top-bar">
    	<div class="container">
<!--Navigation-->
            <div id='cssmenu' class="navigation">            
            <ul>
               <li <?php if($function_is=="" || $function_is=="home"){?>class="active"<?php } ?>><a href='<?php echo $rewritepath; ?>index.php/home/'>Home</a></li>
              <!-- <li><a href='#'>About Us</a></li>-->
			  <li>
			  <?php
					$sel_pag ="SELECT * FROM ".$tblpref."content_master WHERE cms_id='3'";
					if(!($res_pag=mysqli_query($connection, $sel_pag)))
					{ 
							echo "FOR QUERY: $sel_pag<BR>".mysqli_connect_errno(); exit;
					}
					$row_page=mysqli_fetch_array($res_pag);
					?>
					<a href="#"  rel="about">
					<?php					
					echo stripslashes($row_page[cms_title]);?></a>
					<ul>
					<?php
						$sel_pag ="SELECT * FROM ".$tblpref."content_master WHERE cms_type='mcms' AND cms_count='0' AND cms_subtype='3'";
						if(!($res_pag=mysqli_query($connection, $sel_pag))) {  echo "FOR QUERY: $sel_pag<BR>".mysqli_connect_errno(); exit; }
						$cnt_lm = mysqli_num_rows($res_pag);
						if($cnt_lm >0)
						{
							while($row_page2=mysqli_fetch_array($res_pag))
							{ ?>
								<li>
									<?php
										if($row_page2[cms_type]=='mcms' && $row_page2[cms_featured ]=='Active')
										{ 
											if($row_page2[cms_id]=="15")
											{
												$url_link = "#";
											}
											else
											{
												$url_link = $rewritepath."index.php/bps-content/cid/".$row_page2[cms_id]."/".str_replace(" ","-",preg_replace('/\s\s+/', ' ', strtolower(trim(stripslashes($row_page2[cms_title])))))."/";
											}
											?>
											<a href='<?php echo $url_link; ?>/'>
												<?=stripslashes($row_page2[cms_title])?>
											</a>
											<?php						
										}
										else
										{
											$sel_vir =sprintf("SELECT * FROM ".$tblpref."content_master WHERE cms_count ='%d' AND cms_featured = 'Active' ",$row_page2[cms_id]);
											if(!($res_vir=mysqli_query($connection, $sel_vir))) {  echo "FOR QUERY: $sel_pag<BR>".mysqli_connect_errno(); exit; }
											$cnt_lm = mysqli_num_rows($res_vir);
											if($cnt_lm >0)
											{
												if($row_page2[cms_id]=="15")
												{
													$url_link = "#";
												}
												else
												{
													$row_ver2=mysqli_fetch_array($res_vir);
													$url_link = $rewritepath."index.php/bps-content/cid/".$row_ver2[cms_id]."/".str_replace(" ","-",preg_replace('/\s\s+/', ' ', strtolower(trim(stripslashes($row_ver2[cms_title])))))."/";
												}
												?>
												<a href="<?php echo $url_link; ?>"><?=$row_ver2[cms_title]?></a>
												<?php	
											}
										}
									
										$sel_pag_sub =sprintf("SELECT * FROM ".$tblpref."content_master WHERE cms_type='mcms' AND cms_count='0' AND cms_subtype='%d'",$row_page2[cms_id]);
										if(!($res_pag_sub=mysqli_query($connection, $sel_pag_sub)))
										{ 
												echo "FOR QUERY: $sel_pag_sub<BR>".mysqli_connect_errno(); exit;
										}
										$cnt_lm_sub = mysqli_num_rows($res_pag_sub);
										if($cnt_lm_sub >0)
										{ ?>
											<ul>
												<?php
												while($row_page_sub=mysqli_fetch_array($res_pag_sub))
												{?>
													<li>
														<?php
															if($row_page_sub[cms_type]=='mcms' && $row_page_sub[cms_featured]=='Active')
															{ ?>
																<a href='<?php echo $rewritepath; ?>index.php/bps-content/cid/<?php echo $row_page_sub[cms_id]; ?>/<?php echo str_replace(" ","-",preg_replace('/\s\s+/', ' ', strtolower(trim(stripslashes($row_page_sub[cms_title]))))); ?>/' rel="<?=stripslashes($row_page_sub[cms_title])?>"><?=stripslashes($row_page_sub[cms_title])?></a>
																<?php						
															}
															else
															{
																$sel_vir_sub =sprintf("SELECT * FROM ".$tblpref."content_master WHERE cms_count ='%d' AND cms_featured = 'Active'",$row_page_sub[cms_id]);
																if(!($res_vir_sub=mysqli_query($connection, $sel_vir_sub)))
																{ 
																	echo "FOR QUERY: $sel_pag<BR>".mysqli_connect_errno(); exit;
																}
																$cnt_lm_sub = mysqli_num_rows($res_vir_sub);
																if($cnt_lm_sub >0)
																{
																	$row_ver_sub=mysqli_fetch_array($res_vir_sub);?>
																	<a href="<?php echo $rewritepath; ?>index.php/bps-content/cid/<?php echo $row_ver_sub[cms_id]; ?>/<?php echo str_replace(" ","-",preg_replace('/\s\s+/', ' ', strtolower(trim(stripslashes($row_ver_sub[cms_title]))))); ?>/">
																		<?=$row_ver_sub[cms_title]?></a>
																<?php
																}
															}
														} ?>
														</ul>
														<?
													}?>
											</li><? 
										}
						} ?>
					</ul>
				</li>

				<li>
			  <?php
					$sel_pag ="SELECT * FROM ".$tblpref."content_master WHERE cms_id='4'";
					if(!($res_pag=mysqli_query($connection, $sel_pag)))
					{ 
							echo "FOR QUERY: $sel_pag<BR>".mysqli_connect_errno(); exit;
					}
					$row_page=mysqli_fetch_array($res_pag);
					?>
					<a href="#"  rel="about">
					<?php					
					echo stripslashes($row_page[cms_title]);?></a>
					<ul>
					<?php
						$sel_pag ="SELECT * FROM ".$tblpref."content_master WHERE cms_type='mcms' AND cms_count='0' AND cms_subtype='4'";
						if(!($res_pag=mysqli_query($connection, $sel_pag))) {  echo "FOR QUERY: $sel_pag<BR>".mysqli_connect_errno(); exit; }
						$cnt_lm = mysqli_num_rows($res_pag);
						if($cnt_lm >0)
						{
							while($row_page2=mysqli_fetch_array($res_pag))
							{ ?>
								<li>
									<?php
										if($row_page2[cms_type]=='mcms' && $row_page2[cms_featured ]=='Active')
										{ 
											$url_link = $rewritepath."index.php/bps-content/cid/".$row_page2[cms_id]."/".str_replace(" ","-",preg_replace('/\s\s+/', ' ', strtolower(trim(stripslashes($row_page2[cms_title])))))."/";
											?>
											<a href='<?php echo $url_link; ?>/'>
												<?=stripslashes($row_page2[cms_title])?>
											</a>
											<?php						
										}
										else
										{
											$sel_vir =sprintf("SELECT * FROM ".$tblpref."content_master WHERE cms_count ='%d' AND cms_featured = 'Active' ",$row_page2[cms_id]);
											if(!($res_vir=mysqli_query($connection, $sel_vir))) {  echo "FOR QUERY: $sel_pag<BR>".mysqli_connect_errno(); exit; }
											$cnt_lm = mysqli_num_rows($res_vir);
											if($cnt_lm >0)
											{
												$row_ver2=mysqli_fetch_array($res_vir);
												
													$url_link = $rewritepath."index.php/bps-content/cid/".$row_ver2[cms_id]."/".str_replace(" ","-",preg_replace('/\s\s+/', ' ', strtolower(trim(stripslashes($row_ver2[cms_title])))))."/";
												
												?>
												<a href="<?php echo $url_link; ?>"><?=$row_ver2[cms_title]?></a>
												<?php	
											}
										}
									
										$sel_pag_sub =sprintf("SELECT * FROM ".$tblpref."content_master WHERE cms_type='mcms' AND cms_count='0' AND cms_subtype='%d'",$row_page2[cms_id]);
										if(!($res_pag_sub=mysqli_query($connection, $sel_pag_sub)))
										{ 
												echo "FOR QUERY: $sel_pag_sub<BR>".mysqli_connect_errno(); exit;
										}
										$cnt_lm_sub = mysqli_num_rows($res_pag_sub);
										if($cnt_lm_sub >0)
										{ ?>
											<ul>
												<?php
												while($row_page_sub=mysqli_fetch_array($res_pag_sub))
												{?>
													<li>
														<?php
															if($row_page_sub[cms_type]=='mcms' && $row_page_sub[cms_featured]=='Active')
															{ ?>
																<a href='<?php echo $rewritepath; ?>index.php/bps-content/cid/<?php echo $row_page_sub[cms_id]; ?>/<?php echo str_replace(" ","-",preg_replace('/\s\s+/', ' ', strtolower(trim(stripslashes($row_page_sub[cms_title]))))); ?>/' rel="<?=stripslashes($row_page_sub[cms_title])?>"><?=stripslashes($row_page_sub[cms_title])?></a>
																<?php						
															}
															else
															{
																$sel_vir_sub =sprintf("SELECT * FROM ".$tblpref."content_master WHERE cms_count ='%d' AND cms_featured = 'Active'",$row_page_sub[cms_id]);
																if(!($res_vir_sub=mysqli_query($connection, $sel_vir_sub)))
																{ 
																	echo "FOR QUERY: $sel_pag<BR>".mysqli_connect_errno(); exit;
																}
																$cnt_lm_sub = mysqli_num_rows($res_vir_sub);
																if($cnt_lm_sub >0)
																{
																	$row_ver_sub=mysqli_fetch_array($res_vir_sub);?>
																	<a href="<?php echo $rewritepath; ?>index.php/bps-content/cid/<?php echo $row_ver_sub[cms_id]; ?>/<?php echo str_replace(" ","-",preg_replace('/\s\s+/', ' ', strtolower(trim(stripslashes($row_ver_sub[cms_title]))))); ?>/">
																		<?=$row_ver_sub[cms_title]?></a>
																<?php
																}
															}
														} ?>
														</ul>
														<?
													}?>
											</li><? 
										}
						} ?>
					</ul>
				</li>

				 <?php 
				
				$query = "SELECT * FROM " . $tblpref . "content_master WHERE cms_type = 'mcms' AND cms_subtype = 'Main Pages' AND cms_count = '0' AND cms_id = '4' ORDER BY cms_id ASC ";
				if(!($result = mysqli_query($connection, $query))) { echo "Query :- " . $query . "<br />Error :- " . mysqli_connect_errno(); exit; }
				$num = mysqli_num_rows($result);	#fetching num of rows 
				$count = 1;	//Counter for CLASS (CSS) for last ITEM
				while($row = mysqli_fetch_object($result)) 
				{
						$query = "SELECT * FROM " . $tblpref . "content_master WHERE cms_type = 'mcms' AND cms_featured = 'Active' AND cms_subtype='$row->cms_id' ORDER BY cms_id ASC"; 
						if(!($subresult = mysqli_query($connection, $query))) { echo "Query :- " . $query . "<br />Error :- " . mysqli_connect_errno(); exit; }
						$subnum = mysqli_num_rows($subresult);
				?>
		  <li >

		   <!-- <a <?php if($subnum == 0) {?>href="bps-content.php?cid=<?php echo $row->cms_id;?>"<?php } else { ?> href="#" <?php } if($subnum > 0) : //if submenu exist then make submenus?> rel="submenu<?php echo $row->cms_id;?>"  <?php endif; ?>><?php echo stripslashes($row->cms_title);?></a> -->

			<?php if($row->cms_featured=="Active") { ?>
			<a <?php if($subnum == 0){ if($row->cms_id=="141"){?>href="http://www.gov.bw/en/Ministries--Authorities/Ministries/State-President/Botswana-Police-Service-/Tools-and-Services/Services--Forms/How-to-Report-a-Crime-/"<?} else{ ?>href="<?php echo $rewritepath; ?>index.php/bps-content/cid/<?php echo $row->cms_id;?><?php echo str_replace(" ","-",preg_replace('/\s\s+/', ' ', strtolower(trim(stripslashes($row->cms_title)))))?>/"<?php }} else { ?> href="#" <?php } if($subnum > 0) : //if submenu exist then make submenus?> rel="submenu<?php echo $row->cms_id;?>"  <?php endif; ?>><?php echo stripslashes($row->cms_title);?></a>
			<?php } else { 
					$query = "SELECT * FROM " . $tblpref . "content_master WHERE cms_featured = 'Active' AND cms_count = '$row->cms_id'";
					if(!($activeresult = mysqli_query($connection, $query))) { echo "Query :- " . $query . "<br />Error :- " . mysqli_connect_errno(); exit; }
					$activerow = mysqli_fetch_object($activeresult);
				?>
			<!-- <a <?php if($subnum == 0) {?>href="bps-content.php?cid=<?php echo $activerow->cms_id;?>"<?php } else { ?> href="#" <?php } if($subnum > 0) : //if submenu exist then make submenus?> rel="submenu<?php echo $row->cms_id;?>"  <?php endif; ?>><?php echo stripslashes($activerow->cms_title);?></a> -->

			<a <?php if($subnum == 0) { if($activerow->cms_id){?>href="http://www.gov.bw/en/Ministries--Authorities/Ministries/State-President/Botswana-Police-Service-/Tools-and-Services/Services--Forms/How-to-Report-a-Crime-/"<?} else{?>href="<?php echo $rewritepath; ?>index.php/bps-content/cid/<?php echo $activerow->cms_id;?>/<?php echo str_replace(" ","-",preg_replace('/\s\s+/', ' ', strtolower(trim(stripslashes($activerow->cms_title)))))?>/"<?php }} else { ?> href="#" <?php } if($subnum > 0) : //if submenu exist then make submenus?> rel="submenu<?php echo $row->cms_id;?>"  <?php endif; ?>><?php echo stripslashes($activerow->cms_title);?></a>

			<? } ?>
			<?php if($subnum > 0) : //if submenu exist then make submenus?>
			<ul id="submenu<?php echo $row->cms_id;?>" class="ddsubmenustyle blackwhite">
			  <?php 
					while($subrows = mysqli_fetch_object($subresult)) 
					{
					$query = "SELECT * FROM " . $tblpref . "content_master WHERE cms_type = 'mcms' AND cms_featured = 'Active' AND cms_subtype='$subrows->cms_id' ORDER BY cms_id ASC"; 
					if(!($subresult2 = mysqli_query($connection, $query))) { echo "Query :- " . $query . "<br />Error :- " . mysqli_connect_errno(); exit; }
					$subnum2 = mysqli_num_rows($subresult2);
				?>
			  <li>
				<?php if($subrows->cms_featured=="Active") { ?>
				<!-- <a <?php if($subnum2 == 0) { ?> href="bps-content.php?cid=<?php echo $subrows->cms_id;?>" <?php } else { ?> href="#" <?php } if($subnum2 > 0) : //if submenu exist then make submenus?> rel="submenu<?php echo $subrows->cms_id;?>"  <?php endif; ?>><?php echo stripslashes($subrows->cms_title);?></a> -->

				<a <?php if($subnum2 == 0) { if($subrows->cms_id=="141"){ ?>href="http://www.gov.bw/en/Ministries--Authorities/Ministries/State-President/Botswana-Police-Service-/Tools-and-Services/Services--Forms/How-to-Report-a-Crime-/"<?} else{?> href="<?php echo $rewritepath; ?>index.php/bps-content/cid/<?php echo $subrows->cms_id;?>/<?php echo str_replace(" ","-",preg_replace('/\s\s+/', ' ', strtolower(trim(stripslashes($subrows->cms_title)))))?>/" <?php }} else { ?> href="#" <?php } if($subnum2 > 0) : //if submenu exist then make submenus?> rel="submenu<?php echo $subrows->cms_id;?>"  <?php endif; ?>><?php echo stripslashes($subrows->cms_title);?></a>


				<?php } else { 
					$query = "SELECT * FROM " . $tblpref . "content_master WHERE cms_featured = 'Active' AND cms_count = '$subrows->cms_id'";
					if(!($activeresult = mysqli_query($connection, $query))) { echo "Query :- " . $query . "<br />Error :- " . mysqli_connect_errno(); exit; }
					$activerow = mysqli_fetch_object($activeresult);
				?>
				<!-- <a <?php if($subnum2 == 0) { ?> href="bps-content.php?cid=<?php echo $activerow->cms_id;?>" <?php } else { ?> href="#" <?php } if($subnum2 > 0) : //if submenu exist then make submenus?> rel="submenu<?php echo $subrows->cms_id;?>"  <?php endif; ?>><?php echo stripslashes($activerow->cms_title);?></a> -->

				<a <?php if($subnum2 == 0) { if($activerow->cms_id=="141"){?>href="http://www.gov.bw/en/Ministries--Authorities/Ministries/State-President/Botswana-Police-Service-/Tools-and-Services/Services--Forms/How-to-Report-a-Crime-/"<?}else{?> href="<?php echo $rewritepath; ?>index.php/bps-content/cid/<?php echo $activerow->cms_id;?>/<?php echo str_replace(" ","-",preg_replace('/\s\s+/', ' ', strtolower(trim(stripslashes($activerow->cms_title)))))?>/" <?php }} else { ?> href="#" <?php } if($subnum2 > 0) : //if submenu exist then make submenus?> rel="submenu<?php echo $subrows->cms_id;?>"  <?php endif; ?>><?php echo stripslashes($activerow->cms_title);?></a>


				<? } ?>
				<?php if($subnum2 > 0) : //if submenu exist then make submenus?>
				<ul id="submenu<?php echo $subrows->cms_id;?>" class="ddsubmenustyle blackwhite">
				  <?php while($subsubrow = mysqli_fetch_object($subresult2)) 
						{
						$query = "SELECT * FROM " . $tblpref . "content_master WHERE cms_type = 'mcms' AND cms_featured = 'Active' AND cms_subtype='$subsubrow->cms_id' ORDER BY cms_id ASC"; 
						if(!($subresult3 = mysqli_query($connection, $query))) { echo "Query :- " . $query . "<br />Error :- " . mysqli_connect_errno(); exit; }
						$subnum3 = mysqli_num_rows($subresult3);
					?>
				  <li>
					<?php if($subsubrow->cms_featured=="Active") { ?>
					<a <?php if($subnum3 == 0) { ?> href="<?php echo $rewritepath; ?>index.php/bps-content/cid/<?php echo $subsubrow->cms_id;?>/<?php echo str_replace(" ","-",preg_replace('/\s\s+/', ' ', strtolower(trim(stripslashes($subsubrow->cms_title)))))?>/" <?php } else { ?> href="#" <?php } if($subnum3 > 0) : //if submenu exist then make submenus?> rel="submenu<?php echo $subsubrow->cms_id;?>"  <?php endif; ?>><?php echo stripslashes($subsubrow->cms_title);?></a>
					<?php } else { 
						$query = "SELECT * FROM " . $tblpref . "content_master WHERE cms_featured = 'Active' AND cms_count = '$subsubrow->cms_id'";
						if(!($activeresult = mysqli_query($connection, $query))) { echo "Query :- " . $query . "<br />Error :- " . mysqli_connect_errno(); exit; }
						$activerow = mysqli_fetch_object($activeresult);
					?>
					<a <?php if($subnum3 == 0) { ?> href="<?php echo $rewritepath; ?>bps-content/cid/<?php echo $activerow->cms_id;?>/<?php echo str_replace(" ","-",preg_replace('/\s\s+/', ' ', strtolower(trim(stripslashes($activerow->cms_title)))))?>/" <?php } else { ?> href="#" <?php } if($subnum3 > 0) : //if submenu exist then make submenus?> rel="submenu<?php echo $subsubrow->cms_id;?>"  <?php endif; ?>><?php echo stripslashes($activerow->cms_title);?></a>
					<? } ?>
					<?php if($subnum3 > 0) : //if submenu exist then make submenus?>
					<ul id="submenu<?php echo $subsubrow->cms_id;?>" class="ddsubmenustyle blackwhite">
					  <?php while($subsubrows = mysqli_fetch_object($subresult3)) 
							{ ?>
					  <li>
						<?php if($subsubrows->cms_featured=="Active") { ?>
						<a href="<?php echo $rewritepath; ?>index.php/bps-content/cid/<?php echo $subsubrows->cms_id;?>" ><?php echo stripslashes($subsubrows->cms_title);?></a>
						<?php } else { 
							$query = "SELECT * FROM " . $tblpref . "content_master WHERE cms_featured = 'Active' AND cms_count = '$subsubrows->cms_id'";
							if(!($activeresult = mysqli_query($connection, $query))) { echo "Query :- " . $query . "<br />Error :- " . mysqli_connect_errno(); exit; }
							$activerow = mysqli_fetch_object($activeresult);
						?>
						<a href="<?php echo $rewritepath; ?>bps-content/cid/<?php echo $activerow->cms_id;?>/<?php echo str_replace(" ","-",preg_replace('/\s\s+/', ' ', strtolower(trim(stripslashes($activerow->cms_title)))))?>/" ><?php echo stripslashes($activerow->cms_title);?></a>
						<? } ?>
						<?php } ?>
					</ul>
					<?php endif; ?>
				  </li>
				  <?php } ?>
				</ul>
				<?php endif;?>
			  </li>
			  <?php }?>
			</ul>
			<?php endif; ?>
		  </li>
		  <?php } ?>

			   
		   <li <?php if($function_is=='bps-publication'){?>class="active" <?php } ?>><a href='<?php echo $rewritepath; ?>index.php/bps-publication/'>Publications</a></li>

		  <!--  <li><a href="gallery.html">Gallery</a></li> -->
		  <li <?php if($function_is=='bps-gallery'){?>class="active" <?php } ?>><a href='<?php echo $rewritepath; ?>index.php/bps-gallery/'>Gallery</a></li>
				
			
		   <li <?php if($function_is=='bps-faq'){?>class="active" <?php } ?>><a href='<?php echo $rewritepath; ?>index.php/bps-faq/'>FAQs</a></li>
		   <li><a href='#'>Feedback</a>
				<ul>
					<li><a href="<?php echo $rewritepath; ?>index.php/bps-feedback-misconduct/">Commendation</a></li>
					<li><a href="<?php echo $rewritepath; ?>index.php/bps-customer-satisfaction/">Customer Satisfaction</a></li>
					<li><a href="<?php echo $rewritepath; ?>index.php/bps-police-misconduct/">Report Police Misconduct</a></li>
				</ul>
		   </li>
		   <li><a href='<?php echo $rewritepath; ?>index.php/bps-contacts/'>Contact Us</a></li>
		</ul>
   </div>
<!--/Navigation-->
         
        </div>
    </div><!--/top-bar-->
    <div class="mid-bar">
    	<div class="container">
<div class="overlay"></div> 

<!-- Sidebar -->
<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()"> &times;</a>
<div id='cssmenu02'>
<ul> 
	<?php
	$sel_commisioner= sprintf("SELECT * FROM ".$tblpref."content_master WHERE cms_id='38' and cms_type='mcms'");
	if(!($res_commisioner = mysqli_query($connection, $sel_commisioner))){echo $sel_commisioner.mysqli_connect_errno(); exit();}
	$row_commisioner=mysqli_fetch_array($res_commisioner);

	if($row_commisioner[cms_type]=='mcms' && $row_commisioner[cms_featured ]=='Active')
	{
		$id = $row_commisioner[cms_id];
		$page_name = str_replace(" ","-",preg_replace('/\s\s+/', ' ', strtolower(trim(stripslashes($row_commisioner[cms_title])))));
	}
	else
	{
			$sel_help_vir =sprintf("SELECT * FROM ".$tblpref."content_master WHERE cms_count ='%d' AND cms_featured = 'Active'",$row_commisioner[cms_id]);
			if(!($res_help_vir=mysqli_query($connection, $sel_help_vir)))
			{ 
					echo "FOR QUERY: $sel_help_vir<BR>".mysqli_connect_errno(); exit;
			}
			$row_help_vir=mysqli_fetch_array($res_help_vir);

			$id = $row_help_vir[cms_id];
			$page_name = str_replace(" ","-",preg_replace('/\s\s+/', ' ', strtolower(trim(stripslashes($row_help_vir[cms_title])))));
	} ?>
	<!--<li><a href="<?php echo $rewritepath; ?>index.php/bps-content/cid/<?php echo $id; ?>/<?php echo $page_name ; ?>/">Speeches</a></li>-->
    <!--<li><a href="fines.html">Fines and Payments</a></li>-->
	<?php
	$sel_commisioner= sprintf("SELECT * FROM ".$tblpref."content_master WHERE cms_id='67' and cms_type='mcms'");
	if(!($res_commisioner = mysqli_query($connection, $sel_commisioner))){echo $sel_commisioner.mysqli_connect_errno(); exit();}
	$row_commisioner=mysqli_fetch_array($res_commisioner);

	if($row_commisioner[cms_type]=='mcms' && $row_commisioner[cms_featured ]=='Active')
	{
		$id = $row_commisioner[cms_id];
		$page_name = str_replace(" ","-",preg_replace('/\s\s+/', ' ', strtolower(trim(stripslashes($row_commisioner[cms_title])))));
	}
	else
	{
			$sel_help_vir =sprintf("SELECT * FROM ".$tblpref."content_master WHERE cms_count ='%d' AND cms_featured = 'Active'",$row_commisioner[cms_id]);
			if(!($res_help_vir=mysqli_query($connection, $sel_help_vir)))
			{ 
					echo "FOR QUERY: $sel_help_vir<BR>".mysqli_connect_errno(); exit;
			}
			$row_help_vir=mysqli_fetch_array($res_help_vir);

			$id = $row_help_vir[cms_id];
			$page_name = str_replace(" ","-",preg_replace('/\s\s+/', ' ', strtolower(trim(stripslashes($row_help_vir[cms_title])))));
	} ?>

    <li><a href="<?php echo $rewritepath; ?>index.php/bps-content/cid/<?php echo $id; ?>/<?php echo $page_name; ?>/">Cooperate Social Responsibility</a></li>
    <!-- <li><a href="<?php echo $rewritepath; ?>index.php/bps-faq/ ">FAQs</a></li> -->
	<!--<li><a href="https://www.facebook.com/Botswana-Police-Service-254898011338526/" target="_blank">FAQs</a></li>-->
    
</ul>
<div class="gap"></div>
<!-- <div class="calendar"><img src="<?php echo $rewritepath; ?>images/calendar.png" alt="calendar" class="img-responsive"></div> -->
<!-- <h4>Event Calender</h4> -->
<?php include("event-calender.php"); ?>

</div>
  
</div>
<!-- /Sidebar -->

    <div class="row">
        <div class="col-md-3 col-sm-4"><div id="logo"><img src="<?php echo $rewritepath; ?>images/logo.png" alt="Botswana Police Service logo" class="img-responsive center-block"></div></div>
        <div class="col-md-9 col-sm-8">
            <h1 class="logotxt">BOTSWANA POLICE SERVICE</h1>
            <!--<div class="othermenu"><a href="#" class="btn btn-menu">Other Menus <i class="fa fa-bars" aria-hidden="true"></i></a></div>-->
            <div class="text-center">
            <div class="othermenu">
            <span onclick="toggleNav()"><strong>Other Menus</strong> <i class="fa fa-bars" aria-hidden="true"></i></span>
            </div>
            </div>
            
            
        </div>
        <div class="col-md-6 col-sm-8">
            <div class="calltxt"><span>For Emergency Call</span> <i class="fa fa-phone-square" aria-hidden="true"></i> <strong>999</strong></div>
            
            <ul class="socialmedia">
                <li><a href="https://www.facebook.com/Botswana-Police-Service-254898011338526/" target="_blank"><img src="<?php echo $rewritepath; ?>images/fb.png" alt="facebook"></a></li>
                <li><a href="#" target="_blank"><img src="<?php echo $rewritepath; ?>images/tw.png" alt="twitter"></a></li>
                <li><a href="#" target="_blank"><img src="<?php echo $rewritepath; ?>images/yt.png" alt="youtube"></a></li>
            </ul>
            <div class="clr"></div>
        </div>
        <div class="col-md-3 col-sm-12">
            <form class="searchpanel" role="search" action="<?php echo $rewritepath; ?>index.php/submit-search/" method="POST">
            <div class="input-group ">
               <input type="text" class="form-control" placeholder="Search" name="search" id="srch-term">
				<input type="hidden" name="userval" value="<?php echo $userval; ?>">
                       <div class="input-group-btn">
               <div class="input-group-btn">
                    <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                </div>
            </div>
            </form>
        </div>
    </div><!--/-->
    
        </div>
    </div>

</div>    
</header>

<?php
}
function right_panel($rewritepath,$tblpref,$db,$row_admin,$connection)
{
	include("config.php"); 
	$userval = preg_chk($_SESSION['userval']);
	//news 
	?>
	<div class="col-md-3 col-sm-4 hidden-xs">
    	<div class="searchbox rtpanel">
                <h3>Search for Nearest<br>
                <span>Police Station</span></h3>
                
                <form class="searchpanel" role="search" method="GET" action="<?php echo $rewritepath; ?>index.php/submit-nearest/">
                <div class="input-group ">
                   <input type="text" class="form-control" placeholder="Search Keyword" name="pstnsrch" id="srch-station">
				   <input type="hidden"  name="useval"  value="<?php echo $userval ; ?>">
                   <div class="input-group-btn">
                        <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                    </div>
                </div>
                </form>
                
                <div class="btn-group srbtn">
                  <a class="btn btn-danger" href="<?php echo $rewritepath; ?>index.php/bps-police-stations/">Full list of<br>Police Stations</a>
				  <?php
					//Crime state
					$sel_crimestate = sprintf("SELECT * FROM ".$tblpref."content_master WHERE cms_id='80' and cms_type='mcms'");
					if(!($res_crimestate = mysqli_query($connection, $sel_crimestate))){echo $sel_crimestate.mysqli_connect_errno(); exit();}
					$row_crimestate=mysqli_fetch_array($res_crimestate);

					if($row_crimestate[cms_type]=='mcms' && $row_crimestate[cms_featured ]=='Active')
					{
						$id_crimestate = $row_crimestate[cms_id];
						$page_name_crimestate = str_replace(" ","-",preg_replace('/\s\s+/', ' ', strtolower(trim(stripslashes($row_crimestate[cms_title])))));
					}
					else
					{
							$row_crimestate_vir =sprintf("SELECT * FROM ".$tblpref."content_master WHERE cms_count ='%d' AND cms_featured = 'Active'",$row_crimestate[cms_id]);
							if(!($res_crimestate_vir=mysqli_query($connection, $row_crimestate_vir)))
							{ 
									echo "FOR QUERY: $row_crimestate_vir<BR>".mysqli_connect_errno(); exit;
							}
							$row_crimestate_vir=mysqli_fetch_array($res_crimestate_vir);
							$id_crimestate = $row_crimestate_vir[cms_id];
							$page_name_crimestate = str_replace(" ","-",preg_replace('/\s\s+/', ' ', strtolower(trim(stripslashes($row_crimestate_vir[cms_title])))));
					}
				?>
                  <a class="btn btn-danger" href="<?php echo $rewritepath; ?>index.php/bps-content/cid/<?php echo $id_crimestate; ?>/<?php echo $page_name_crimestate; ?>/">Crime  <br>Statistics</a>
                </div>
          </div>
          
          <h3>News &amp; Announcements</h3>
          <div id="owl-news-inner" class="owl-carousel">
		     <?php 
				$query_news = "select * from ".$tblpref."content_master where cms_type='news' and cms_featured='yes' ORDER BY cms_date DESC LIMIT 0,5";
				if(!($result_news = mysqli_query($connection, $query_news))) :
				echo $query_news.mysqli_connect_errno();
				exit();
				endif;
				while($row_news = mysqli_fetch_assoc($result_news))
				{
					if($row_news[cms_file]!="")
					{
						$news_img = $siteuploadpath.$row_news[cms_file];
					}
					else
					{
						$news_img = $rewritepath."images/no-img.jpg";
					}
				?>
                <div class="news-box">
                    <div class="thumb"><a href="<?php echo $rewritepath;?>index.php/bps-news-details/nid/<?php echo $row_news['cms_id'];?>/<?php echo str_replace(" ","-",preg_replace('/\s\s+/', ' ', strtolower(trim(stripslashes($row_news[cms_title])))));?>/"><img src="<?php echo $news_img; ?>" alt="" class="img-responsive"></a></div>
                    <p class="title limit"><?php echo stripslashes($row_news[cms_title]); ?></p>
                    <p class="date"><?php echo @date("d M,Y",strtotime($row_news[cms_date])); ?></p>
                    <div class="limitbox">
						<?php echo stripslashes($row_news[cms_desc]); ?>
                    </div>
                    <p><a href="<?php echo $rewritepath;?>index.php/bps-news-details/nid/<?php echo $row_news['cms_id'];?>/<?php echo str_replace(" ","-",preg_replace('/\s\s+/', ' ', strtolower(trim(stripslashes($row_news[cms_title])))));?>/" class="more">Read more</a></p>
                </div>
				<?php } ?>
                
           </div>
            
            <h3>Upcoming Events</h3>
            <div id="owl-events-inner" class="owl-carousel">
				<?
					$queryevent=sprintf("select * from ".$tblpref."content_master where cms_type='Event' AND cms_subdate > CURDATE() LIMIT 5"); 
					if(!($resultevent=mysqli_query($connection, $queryevent))){ echo $queryevent.mysqli_connect_errno();	exit;}
					while($rowevent=mysqli_fetch_array($resultevent))
					{
						if($rowevent[cms_file]!="")
						{
							$events_img = $siteuploadpath.$rowevent[cms_file];
						}
						else
						{
							$events_img = $rewritepath."images/no-img.jpg";
						}
				?>
                <div class="row flex">
                    <div class="col-md-12">
                        <div class="evthumb"><a href="<?php echo $rewritepath;?>index.php/bps-events-details/eid/<?php echo $rowevent['cms_id'];?>/<?php echo str_replace(" ","-",preg_replace('/\s\s+/', ' ', strtolower(trim(stripslashes($rowevent[cms_title])))));?>/"><img src="<?php echo $events_img; ?>" alt="Events" class="img-responsive center-block"></a></div>
                    </div>
                    <div class="col-md-12 ypan">
                        <p class="date"><?php echo @date("d M,Y",strtotime($rowevent[cms_subdate])); ?></p>
                        <p class="title limit"><?php echo stripslashes($rowevent[cms_title]); ?></p>
                        <div class="limitbox">
                        <p><?php echo stripslashes($rowevent[cms_desc]); ?> </p>
                        </div>
                        <p><a href="<?php echo $rewritepath;?>index.php/bps-events-details/eid/<?php echo $rowevent['cms_id'];?>/<?php echo str_replace(" ","-",preg_replace('/\s\s+/', ' ', strtolower(trim(stripslashes($rowevent[cms_title])))));?>/" class="more">Read more</a></p>
                    </div>
                </div>
				<?php } ?>
            </div><!--/-->
          
    </div><!--/right side-->
<?php
}
function index_footer($rewritepath, $tblpref, $db, $row_admin, $connection)
{ 
?>
<footer>
	<div class="container">
    	<div class="footer">
    		<div class="footlt">Copyright&copy;2017. All Right Reserved</div>
            <div class="footrt"><a href="http://www.weblogic.co.bw/" target="_blank">Designed &amp; Developed by Weblogic</a></div>
            <div class="gap"></div>
        </div>
    </div>
</footer>

<div id="back-top"><a href="#top"><span></span></a> </div>

<!-- JavaScript plugins -->    
<script src="<?php echo $rewritepath; ?>js/jquery-2.2.4.min.js"></script>
<script src="<?php echo $rewritepath; ?>js/bootstrap.min.js"></script>
<script src="<?php echo $rewritepath; ?>js/topscroll.js"></script>
<script type="text/javascript" src="<?php echo $rewritepath; ?>js/jquery.mousewheel-3.0.6.pack.js"></script>
<script type="text/javascript" src="<?php echo $rewritepath; ?>source/jquery.fancybox.js?v=2.1.5"></script>
<script type="text/javascript" src="<?php echo $rewritepath; ?>js/responsiveslides.js"></script>
<script src="<?php echo $rewritepath; ?>js/owl.carousel.min.js"></script>
<script src="<?php echo $rewritepath; ?>js/responsive-tabs.js"></script>
<script type="text/javascript" src="<?php echo $rewritepath; ?>eventcal/js/coda.js"></script><!-- For event calender -->

<script src="<?php echo $rewritepath; ?>js/menu-script.js"></script><!--Navigation Menu-->
<script src="<?php echo $rewritepath; ?>js/menu-script2.js"></script><!--Other Menu-->

<script type="text/javascript" src="<?php echo $rewritepath; ?>js/wowslider.js"></script>
<script type="text/javascript" src="<?php echo $rewritepath; ?>js/wow-script.js"></script>


<script src="<?php echo $rewritepath; ?>js/bootstrap-datepicker.js"></script>


<script src="<?php echo $rewritepath; ?>js/main.js"></script>
<script src="<?php echo $rewritepath; ?>js/wow.min.js"></script>

<script>
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
	}
	
	function closeNav() {
		document.getElementById("mySidenav").style.width = "0";
	}
	
	function toggleNav() {
		var el = document.getElementById("mySidenav");
		if(el.style.width == "250px"){
			el.style.width = "0px";
		} else {
			el.style.width = "250px";
		}
	}
</script>


    <script type="text/javascript">

    </script>

</body>
</html>
<?php
}
function admin_header($path2,$title,$tblpref,$db,$sitepath,$siteurl,$path1,$ckpath,$row_admin)
{
	@session_start();
	include("config.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome To Admin Panel :: <?=$title?></title>
<link href="<?=$path2?>images/favicon.png" type="image/x-icon" rel="shortcut icon" />
<!-- <script type="text/javascript" src="<?=$path2?>cal_js/jquery-1.3.1.min.js"></script> -->
<link href="<?=$path2?>css/admin.css" rel="stylesheet" type="text/css" />


<!-- <script type="text/javascript" src="<?=$path2?>js/curvy.js"></script> -->
<script type="text/javascript" src="<?=$path2?>js/admin-validations.js"></script>
</head>
<body>
<div class="header">
<?if($_SESSION[username]==""){?>
	<img src="<?=$path2?>images/BPS-Logo.jpg" alt="Site Logo" />
<?}
else
{?>
<img src="<?=$path2?>images/BPS-Logo.jpg" alt="Site Logo" />
    <div class="logout">
    	<div class="admin">
        <div class="admnimg"><a href="<?=$path2.'cplopol/'?>admin-info.php"><img src="<?=$path2?>images/admin.png" alt="Edit Info" title="Edit Info"/></a> </div>
		<?=stripslashes(ucfirst($_SESSION[user_type]));?><br/>
        <p class="nameAdm"><a href="<?=$path2.'cplopol/'?>admin-info.php" alt="Edit Info" title="Edit Info"><?=stripslashes(ucfirst($row_admin[admin_name]))?></a></p>
    </div>
    <a href="<?=$path2.'cplopol/'?>changepassword.php"><img src="<?=$path2?>images/lock.png" alt="change password" title="change password" /></a>     
    <a href="<?=$path2.'cplopol/'?>home.php"><img src="<?=$path2?>images/gohome.png" alt="Home" title="Home" /></a>
    <a href="<?=$path2.'cplopol/'?>logout.php" onclick='if(confirm("Do You Really Want To Logoff ?")){return true;}else{return false;}'><img src="<?=$path2?>images/exit.png" alt="Logout" title="Logout" /></a> 
	<!-- <a href="<?=$path2?>help/index.html" target="_blank"><img src="<?=$path2?>images/help.png" alt="Help" title="Help" /></a>  -->
    <p class="welcome">Welcome to the Admin Section of <br/><?=$path1."cplopol/"?></p>
    </div>
    <div class="clear"></div>
<?php }?>
</div>
<?php }
	function admin_footer()
{?>
		<div class="footer">
	<p class="flt">Copyright &copy; <?php echo @date('Y');?>. All Rights Reserved </p>
	<p class="frt" style="padding-right:25px;"><a href="http://www.weblogic.co.bw/">Designed &amp; Developed by Weblogic</a></p>
    <div class="clear"></div>
</div>    
</body>
</html>
<?php
}
function admin_nav($path='')
{
	include($path.'common/config.php');
	session_start();
	 $usertype=$_SESSION[user_type];
	 $vaus=$_SESSION["username"];
		$que ="SELECT * from ".$tblpref."admin  where username='$vaus'"; 
        if(!($result=mysqli_query($connection, $que))){ echo $que.mysqli_connect_errno(); exit;}
		$row_add=mysqli_fetch_array($result);
		$res=$row_add['admin_mgmts']; 
		$resu=explode(',',$res);
	?>
            <td width="198"  align="left" valign="top"  bgcolor="#2888bb">
				<table  height="100%" border="0" cellspacing="0" cellpadding="0" width="100%"  >
					<tr>
						<td width="22%" height="375" align="left" valign="top" bgcolor="#2888bb">
							<table width="100%"  border="0" align="left" cellpadding="0" cellspacing="0">
								<tr>
									<td >
										<table width="100%"  border="0" cellspacing="0" cellpadding="3">
											<tr>
												<td width="9%" align="center">
													<img src="<?php echo $path?>images/arrow.gif" width="10" height="7">
												</td>
												<td width="91%" class="navlinks">
													<a href="<?php echo $path?>cplo/home.php" class="navlinks">Home</a>
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td>
										<table width="100%"  border="0" cellspacing="0" cellpadding="3">
											<tr>
												<td width="9%" align="center">
													<img src="<?php  echo $path?>images/arrow.gif" width="10" height="7">
												</td>
												<td width="91%" class="navlinks">
													<a href="<?php  echo $path?>cplo/admin_info.php" class="navlinks">Admin Info </a>
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<?//if($usertype=='superadmin')
								if (in_array('subadmin', $resu))
								{?>
								<tr>
									<td>
										<table width="100%"  border="0" cellspacing="0" cellpadding="3">
											<tr>
												<td width="9%" align="center">
													<img src="<?php  echo $path?>images/arrow.gif" width="10" height="7">
												</td>
												<td width="91%" class="navlinks">
													<a href="<?php  echo $path?>cplo/user/" class="navlinks">Sub Admin</a>
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<?}?>
								
								<tr>
									<td height="5" ></td>
								</tr>
								<tr>
									<td height="1" bgcolor="#FFFFFF" ></td>
								</tr>
								<tr>
									<td height="5" ></td>
								</tr>
								<tr>
									<td >
										<table width="100%"  border="0" cellspacing="0" cellpadding="0">
											<tr>
												<td colspan="2" class="text4" align="center" >
													<h2>Management</h2>
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td height="5" ></td>
								</tr>
								<tr>
									<td height="1" bgcolor="#FFFFFF" ></td>
								</tr>
								<tr>
									<td height="5" ></td>
								</tr>
								<?php
									if (in_array('cms', $resu) || $usertype=='moderator')
									{
								?>
										<tr>
											<td>
												<table width="100%"  border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td width="9%" align="center">
															<img src="<?php  echo $path?>images/arrow.gif" width="10" height="7">
														</td>
														<td width="91%" class="text4">
															<strong>CMS Management</strong>
														</td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td>
												<table width="100%"  border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td width="91%" align="right" class="nav" height="30">
															<table width="93%"  border="0" cellspacing="2" cellpadding="0">
																<tr>
																	<td width="9%" align="center">
																		<img src="<?php  echo $path?>images/arrow.gif" >
																	</td>
																	<td width="91%" class="navlinks" align="left">
																		<a href="<?php  echo $path?>cplo/cms/index.php" class="navlinks"> CMS </a>
																	</td>
																</tr>
																<tr>
																	<td height="5" ></td>
																</tr>
															</table>
														</td>
													</tr>
												</table>
											</td>
										</tr>
										<?}?>
										
										<?if($usertype=='superadmin' || $usertype=='approver')
										{?>
										<tr>
											<td>
												<table width="100%"  border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td width="91%" align="right" class="nav" height="30">
															<table width="93%"  border="0" cellspacing="2" cellpadding="0">
																<tr>
																	<td width="9%" align="center">
																		<img src="<?php  echo $path?>images/arrow.gif" >
																	</td>
																	<td width="91%" class="navlinks" align="left">
																		<a href="<?php  echo $path?>cplo/versions/" class="navlinks"> Select Versions </a>
																	</td>
																</tr>
																<tr>
																	<td height="5" ></td>
																</tr>
															</table>
														</td>
													</tr>
												</table>
											</td>
										</tr>
										<?}
									?>
							<tr>
								<td height="5" ></td>
							</tr>
							<tr>
								<td height="1" bgcolor="#FFFFFF" ></td>
							</tr>
							<tr>
								<td height="5" ></td>
							</tr>
							<?php 
							if (in_array('police', $resu))
									{
									?>
									<tr>
                      <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="9%" align="center"><img src="<?php  echo $path?>images/arrow.gif" width="10" height="7"></td>
                            <td width="91%" class="text4"><strong>Police Station Management</strong> </td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr>
                      <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="91%" align="right" class="nav" height="30"><table width="93%"  border="0" cellspacing="2" cellpadding="0">
                                <tr>
                                  <td width="9%" align="center"><img src="<?php  echo $path?>images/arrow.gif" ></td>
                                  <td width="91%" class="navlinks" align="left"><a href="<?php  echo $path?>cplo/city/" class="navlinks">City</a></td>
                                </tr>
                              </table></td>
                          </tr>
						<tr>
                            <td width="91%" align="right" class="nav" height="30"><table width="93%"  border="0" cellspacing="2" cellpadding="0">
                                <tr>
                                  <td width="9%" align="center"><img src="<?php  echo $path?>images/arrow.gif" ></td>
                                  <td width="91%" class="navlinks" align="left"><a href="<?php  echo $path?>cplo/area/" class="navlinks">Area</a></td>
                                </tr>
                              </table></td>
                          </tr>
                          
                          
                          <tr>
                            <td width="91%" align="right" class="nav" height="30"><table width="93%"  border="0" cellspacing="2" cellpadding="0">
                                <tr>
                                  <td width="9%" align="center"><img src="<?php  echo $path?>images/arrow.gif" ></td>
                                  <td width="91%" class="navlinks" align="left"><a href="<?php  echo $path?>cplo/police/" class="navlinks">Police Station</a></td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>
									<?php
									}
							?>
							
                    <!-- Usefull link management -->
<?php 
if (in_array('gallery', $resu))
									{
		?>
                    <tr>
                      <td height="5" ></td>
                    </tr>
                    <tr>
                      <td height="1" bgcolor="#FFFFFF" ></td>
                    </tr>
                    <tr>
                      <td height="5" ></td>
                    </tr>
                    <tr>
                      <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="9%" align="center"><img src="<?php  echo $path?>images/arrow.gif" width="10" height="7"></td>
                            <td width="91%" class="text4"><strong>Picture Gallery Management</strong> </td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr>
                      <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="91%" align="right" class="nav" height="30"><table width="93%"  border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="9%" align="center"><img src="<?php  echo $path?>images/arrow.gif" ></td>
                                  <td width="91%" class="navlinks" align="left"><a href="<?php  echo $path?>cplo/gallery/indexmain.php" class="navlinks">Album Management</a></td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>
       <?php } ?>

<?php 
if (in_array('link', $resu))
									{
	?>
                    <tr>
                      <td height="5" ></td>
                    </tr>
                    <tr>
                      <td height="1" bgcolor="#FFFFFF" ></td>
                    </tr>
                    <tr>
                      <td height="5" ></td>
                    </tr>
                    <tr>
                      <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="9%" align="center"><img src="<?php  echo $path?>images/arrow.gif" width="10" height="7"></td>
                            <td width="91%" class="text4"><strong>Usefull link Management</strong> </td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr>
                      <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="91%" align="right" class="nav" height="30"><table width="93%"  border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="9%" align="center"><img src="<?php  echo $path?>images/arrow.gif" ></td>
                                  <td width="91%" class="navlinks" align="left"><a href="<?php  echo $path?>cplo/links/index.php" class="navlinks">Links </a></td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>
<?php  } ?>
 
                    <!-- publication management starts here -->
<?php 
	if (in_array('publication', $resu))
									{
	?>
       
                    <tr>
                      <td height="5" ></td>
                    </tr>
                    <tr>
                      <td height="1" bgcolor="#FFFFFF" ></td>
                    </tr>
                    <tr>
                      <td height="5" ></td>
                    </tr>
                    <tr>
                      <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="9%" align="center"><img src="<?php  echo $path?>images/arrow.gif" width="10" height="7"></td>
                            <td width="91%" class="text4"><strong>Publication Management</strong> </td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr>
                      <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="91%" align="right" class="nav" height="30"><table width="93%"  border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="9%" align="center"><img src="<?php  echo $path?>images/arrow.gif" ></td>
                                  <td width="91%" class="navlinks" align="left"><a href="<?php  echo $path?>cplo/publication/pub-type.php" class="navlinks"> Category </a></td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr>
                      <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="91%" align="right" class="nav" height="30"><table width="93%"  border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="9%" align="center"><img src="<?php  echo $path?>images/arrow.gif" ></td>
                                  <td width="91%" class="navlinks" align="left"><a href="<?php  echo $path?>cplo/publication/index.php" class="navlinks"> Publications </a></td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>
<?php }?>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    <?php 
if (in_array('property', $resu))
									{
	?>
       
                    <tr>
                      <td height="5" ></td>
                    </tr>
                    <tr>
                      <td height="1" bgcolor="#FFFFFF" ></td>
                    </tr>
                    <tr>
                      <td height="5" ></td>
                    </tr>
                    <tr>
                      <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="9%" align="center"><img src="<?php  echo $path?>images/arrow.gif" width="10" height="7"></td>
                            <td width="91%" class="text4"><strong>Recovered Property Mgmt</strong> </td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr>
                      <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="91%" align="right" class="nav" height="30"><table width="93%"  border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="9%" align="center"><img src="<?php  echo $path?>images/arrow.gif" ></td>
                                  <td width="91%" class="navlinks" align="left"><a href="<?php  echo $path?>cplo/property/pub-type.php" class="navlinks"> Category </a></td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr>
                      <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="91%" align="right" class="nav" height="30"><table width="93%"  border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="9%" align="center"><img src="<?php  echo $path?>images/arrow.gif" ></td>
                                  <td width="91%" class="navlinks" align="left"><a href="<?php  echo $path?>cplo/property/" class="navlinks"> Recovered Property </a></td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>
<?php } ?>
    
    
    <?php 
	if (in_array('form', $resu))
									{
	?>
                    <tr>
                      <td height="5" ></td>
                    </tr>
                    <tr>
                      <td height="1" bgcolor="#FFFFFF" ></td>
                    </tr>
                    <tr>
                      <td height="5" ></td>
                    </tr>
                    <tr>
                      <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="9%" align="center"><img src="<?php  echo $path?>images/arrow.gif" width="10" height="7"></td>
                            <td width="91%" class="text4"><strong>Online Forms Management</strong> </td>
                          </tr>
                        </table></td>
                    </tr>
					<tr>
                      <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="91%" align="right" class="nav" height="30"><table width="93%"  border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="9%" align="center"><img src="<?php  echo $path?>images/arrow.gif" ></td>
                                  <td width="91%" class="navlinks" align="left"><a href="<?php  echo $path?>cplo/crime-type/pub-type.php" class="navlinks"> Crime Type Mgmt </a></td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr>
                      <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="91%" align="right" class="nav" height="30"><table width="93%"  border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="9%" align="center"><img src="<?php  echo $path?>images/arrow.gif" ></td>
                                  <td width="91%" class="navlinks" align="left"><a href="<?php  echo $path?>cplo/sareport/" class="navlinks"> Report Crime/ Incident </a></td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>

					<tr>
                      <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="91%" align="right" class="nav" height="30"><table width="93%"  border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="9%" align="center"><img src="<?php  echo $path?>images/arrow.gif" ></td>
                                  <td width="91%" class="navlinks" align="left"><a href="<?php  echo $path?>cplo/fcreport/" class="navlinks"> Feedback & Commendation </a></td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>

					<tr>
                      <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="91%" align="right" class="nav" height="30"><table width="93%"  border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="9%" align="center"><img src="<?php  echo $path?>images/arrow.gif" ></td>
                                  <td width="91%" class="navlinks" align="left"><a href="<?php  echo $path?>cplo/apreport/" class="navlinks"> Ask the Police </a></td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>


					<tr>
                      <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="91%" align="right" class="nav" height="30"><table width="93%"  border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="9%" align="center"><img src="<?php  echo $path?>images/arrow.gif" ></td>
                                  <td width="91%" class="navlinks" align="left"><a href="<?php  echo $path?>cplo/pmreport/" class="navlinks"> Police Misconduct </a></td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>

					
					<tr>
                      <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="91%" align="right" class="nav" height="30"><table width="93%"  border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="9%" align="center"><img src="<?php  echo $path?>images/arrow.gif" ></td>
                                  <td width="91%" class="navlinks" align="left"><a href="<?php  echo $path?>cplo/csreport/" class="navlinks"> Customer Satisfaction </a></td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>

				<!-- 	<tr>
                      <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="91%" align="right" class="nav" height="30"><table width="93%"  border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="9%" align="center"><img src="<?php  echo $path?>images/arrow.gif" ></td>
                                  <td width="91%" class="navlinks" align="left"><a href="<?php  echo $path?>cplo/sareport/" class="navlinks"> Suspicion or Allegation </a></td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr> -->
                
<?php  } ?>
 
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
                    <!-- -->
<?php 
	if (in_array('banner', $resu))
									{
	?>
                    <tr>
                      <td height="5" ></td>
                    </tr>
                    <tr>
                      <td height="1" bgcolor="#FFFFFF" ></td>
                    </tr>
                    <tr>
                      <td height="5" ></td>
                    </tr>
                    <tr>
                      <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="9%" align="center"><img src="<?php  echo $path?>images/arrow.gif" width="10" height="7"></td>
                            <td width="91%" class="text4"><strong>Banner Management</strong> </td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr>
                      <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="91%" align="right" class="nav" height="30"><table width="93%"  border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="9%" align="center"><img src="<?php  echo $path?>images/arrow.gif" ></td>
                                  <td width="91%" class="navlinks" align="left"><a href="<?php  echo $path?>cplo/banner/index.php" class="navlinks">Banners </a></td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>
<?php } ?>
    
    
    
    
    
    
    
    
    
    
    
    
    <?php 
	if (in_array('missing', $resu))
									{
	?>
                    <tr>
                      <td height="5" ></td>
                    </tr>
                    <tr>
                      <td height="1" bgcolor="#FFFFFF" ></td>
                    </tr>
                    <tr>
                      <td height="5" ></td>
                    </tr>
                    <tr>
                      <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="9%" align="center"><img src="<?php  echo $path?>images/arrow.gif" width="10" height="7"></td>
                            <td width="91%" class="text4"><strong>Missing Persons Management</strong> </td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr>
                      <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="91%" align="right" class="nav" height="30"><table width="93%"  border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="9%" align="center"><img src="<?php  echo $path?>images/arrow.gif" ></td>
                                  <td width="91%" class="navlinks" align="left"><a href="<?php  echo $path?>cplo/missing/" class="navlinks">Missing Persons</a></td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>
<?php } ?>
    
    
    
    
    
    
    
    
    
    
    
    
    <?php 
	if (in_array('wanted', $resu))
									{
	?>
                    <tr>
                      <td height="5" ></td>
                    </tr>
                    <tr>
                      <td height="1" bgcolor="#FFFFFF" ></td>
                    </tr>
                    <tr>
                      <td height="5" ></td>
                    </tr>
                    <tr>
                      <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="9%" align="center"><img src="<?php  echo $path?>images/arrow.gif" width="10" height="7"></td>
                            <td width="91%" class="text4"><strong>Wanted Persons Management</strong> </td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr>
                      <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="91%" align="right" class="nav" height="30"><table width="93%"  border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="9%" align="center"><img src="<?php  echo $path?>images/arrow.gif" ></td>
                                  <td width="91%" class="navlinks" align="left"><a href="<?php  echo $path?>cplo/wanted/" class="navlinks">Wanted Persons</a></td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>
<?php }  ?>
    
    
    
    
    
    
                    <!-- Media Center management starts here -->
<?php 
	if (in_array('media', $resu))
									{
	?>
                    <tr>
                      <td height="5" ></td>
                    </tr>
                    <tr>
                      <td height="1" bgcolor="#FFFFFF" ></td>
                    </tr>
                    <tr>
                      <td height="5" ></td>
                    </tr>
                    <tr>
                      <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="9%" align="center"><img src="<?php  echo $path?>images/arrow.gif" width="10" height="7"></td>
                            <td width="91%" class="text4"><strong>Media Center Management </strong></td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr>
                      <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="91%" align="right" class="nav" height="30"><table width="93%"  border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="9%" align="center"><img src="<?php  echo $path?>images/arrow.gif" ></td>
                                  <td width="91%" class="navlinks" align="left"><a href="<?php  echo $path?>cplo/media/indexmain.php" class="navlinks"> Publishers </a></td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr>
                      <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="91%" align="right" class="nav" height="30"><table width="93%"  border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="9%" align="center"><img src="<?php  echo $path?>images/arrow.gif" ></td>
                                  <td width="91%" class="navlinks" align="left"><a href="<?php  echo $path?>cplo/media/index.php" class="navlinks"> Media Releases </a></td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>
<?php  } ?>

	  
  <?php 
	if (in_array('news', $resu))
									{
	?>
                    <tr>
                      <td height="5" ></td>
                    </tr>
                    <tr>
                      <td height="1" bgcolor="#FFFFFF" ></td>
                    </tr>
                    <tr>
                      <td height="5" ></td>
                    </tr>
                    <tr>
                      <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="9%" align="center"><img src="<?php  echo $path?>images/arrow.gif" width="10" height="7"></td>
                            <td width="91%" class="text4"><strong>News Management</strong> </td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr>
                      <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="91%" align="right" class="nav" height="30"><table width="93%"  border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="9%" align="center"><img src="<?php  echo $path?>images/arrow.gif" ></td>
                                  <td width="91%" class="navlinks" align="left"><a href="<?php  echo $path?>cplo/news/index.php" class="navlinks">News</a></td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>
  <?php } ?>
   
<?php 
if (in_array('polling', $resu))
									{	
	?>
                    <tr>
                      <td height="5" ></td>
                    </tr>
                    <tr>
                      <td height="1" bgcolor="#FFFFFF" ></td>
                    </tr>
                    <tr>
                      <td height="5" ></td>
                    </tr>
                    <tr>
                      <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="9%" align="center"><img src="<?php  echo $path?>images/arrow.gif" width="10" height="7"></td>
                            <td width="91%" class="text4"><strong>Survey Management</strong> </td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr>
                      <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="91%" align="right" class="nav" height="30"><table width="93%"  border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="9%" align="center"><img src="<?php  echo $path?>images/arrow.gif" ></td>
                                  <td width="91%" class="navlinks" align="left"><a href="<?php  echo $path?>cplo/polling/" class="navlinks">Survey</a></td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>
  <?php } ?>
     

<?php 
	if (in_array('events', $resu))
									{
	?>
                    <tr>
                      <td height="5" ></td>
                    </tr>
                    <tr>
                      <td height="1" bgcolor="#FFFFFF" ></td>
                    </tr>
                    <tr>
                      <td height="5" ></td>
                    </tr>
                    <tr>
                      <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="9%" align="center"><img src="<?php  echo $path?>images/arrow.gif" width="10" height="7"></td>
                            <td width="91%" class="text4"><strong>Events Management</strong> </td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr>
                      <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="91%" align="right" class="nav" height="30"><table width="93%"  border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="9%" align="center"><img src="<?php  echo $path?>images/arrow.gif" ></td>
                                  <td width="91%" class="navlinks" align="left"><a href="<?php  echo $path?>cplo/event/" class="navlinks">Events</a></td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>
  <?php }  ?>
    

                    <!--faq-->
<?php 
if (in_array('faq', $resu))
									{	
	?>
                    <tr>
                      <td height="5" ></td>
                    </tr>
                    <tr>
                      <td height="1" bgcolor="#FFFFFF" ></td>
                    </tr>
                    <tr>
                      <td height="5" ></td>
                    </tr>
                    <tr>
                      <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="9%" align="center"><img src="<?php  echo $path?>images/arrow.gif" width="10" height="7"></td>
                            <td width="91%" class="text4"><strong>FAQ Management</strong> </td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr>
                      <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="91%" align="right" class="nav" height="30"><table width="93%"  border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="9%" align="center"><img src="<?php  echo $path?>images/arrow.gif" ></td>
                                  <td width="91%" class="navlinks" align="left"><a href="<?php  echo $path?>cplo/faq/index.php" class="navlinks">FAQ </a></td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>

					  <?php }  ?>
<?php 
if (in_array('forum', $resu))
									{	
	?>
					   <tr>
                      <td height="5" ></td>
                    </tr>
                    <tr>
                      <td height="1" bgcolor="#FFFFFF" ></td>
                    </tr>
                    <tr>
                      <td height="5" ></td>
                    </tr>
                    <tr>
                      <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="9%" align="center"><img src="<?php  echo $path?>images/arrow.gif" width="10" height="7"></td>
                            <td width="91%" class="text4"><strong>Forum Management</strong> </td>
                          </tr>
                        </table></td>
                    </tr>
					<tr>
                      <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="91%" align="right" class="nav" height="30"><table width="93%"  border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="9%" align="center"><img src="<?php  echo $path?>images/arrow.gif" ></td>
                                  <td width="91%" class="navlinks" align="left"><a href="<?php  echo $path?>cplo/forum/user/index.php" class="navlinks">Forum User Management</a></td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr>
                      <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="91%" align="right" class="nav" height="30"><table width="93%"  border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="9%" align="center"><img src="<?php  echo $path?>images/arrow.gif" ></td>
                                  <td width="91%" class="navlinks" align="left"><a href="<?php  echo $path?>cplo/forum/index.php" class="navlinks">Forum Management</a></td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>
	<? } ?>				    
                    <tr>
                      <td height="5" ></td>
                    </tr>
                    <tr>
                      <td height="1" bgcolor="#FFFFFF" ></td>
                    </tr>
                    <tr>
                      <td height="5" ></td>
                    </tr>
                    <tr>
                      <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="9%" align="center"><img src="<?php  echo $path?>images/arrow.gif" width="10" height="7"></td>
                            <td width="91%" class="navlinks"><a href="<?php  echo $path?>cplo/logout.php" class="navlinks">Logout</a></td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                  </table></td>
                </tr>
                
              </table></td>
            <td width="799" align="left" valign="top"><?php 
}
function pagination($strsql_pag, $current_page=0, $link_pag=null, $more_querystr=null, $page_size=0)
{
		global $sitefont,$sitefontweight, $connection ;
	if (($page_size+0)==0)
		$page_size=10;
	if ($link_pag == null or $link_pag == "")
		$link_pag=$PHP_SELF ;
	if ($more_querystr != null or $more_querystr != "")
		$more_querystr="&" . $more_querystr ;
	// COUNT
	if (!($result_pag = mysqli_query($connection, $strsql_pag))){echo "SQL: ".$strsql_pag."<br>ERROR: ".mysqli_connect_errno();exit;}
	$row_pag = mysqli_fetch_array($result_pag);
	$ex_count=mysqli_num_rows($result_pag);
	$no_page=ceil($ex_count/$page_size);
	if ($current_page>0)
		$show_from=($current_page-1)*$page_size;
	else
		$show_from=0;
	
	if( $ex_count>$page_size )
	{
		$diplay_string = "<TABLE cellPadding=0 cellspacing=0 width=50% size=0 align=center ><form Name='frmGotoPage'  id='frmGotoPage' method ='post' action ='". $link_pag ."?wew=qwq".$more_querystr ."' onsubmit='return validate();'><TR >";
		if(($current_page + 0)<=0)
			$current_page=1;
		else if (($current_page + 0)>$no_page)
			$current_page=$no_page + 0;
		else
			$current_page=ceil($current_page) + 0;
		if ($current_page  != 1 )
			$diplay_string = $diplay_string . "        <TD width='10%' align=middle bgcolor=>        <A title='Go to the first page' class=Link-TableHeader target=_self href='". "". $link_pag ."?page=1".$more_querystr ."'><b>First</b></A></TD>";
		else
			$diplay_string = $diplay_string . "        <TD width='10%' align=middle class=tab><b>First</b></TD>";

		if ($current_page  !=1 )
			$diplay_string = $diplay_string . "        <TD align=middle width='10%' bgcolor=>        <A title='Go to the previous page' target=_self href='". "". $link_pag ."?page=".($current_page -1).$more_querystr ."'><b>Prev</b></A></TD>";
		else
			$diplay_string = $diplay_string . "        <TD width='10%' align=middle bgcolor=><b>Prev</b></font></TD>";

		if ($no_page == $current_page)
			$diplay_string = $diplay_string . "	<TD width='10%' align=middle class='tab'><b>Next</b></TD>";
		else
			$diplay_string=$diplay_string. "<TD width='10%' align=middle bgcolor=>$no_pages	<A title='Go to the next page' target=_self href='". $link_pag ."?page=" .($current_page + 1) . $more_querystr. "'><b>Next</b></A></TD>";


		if ($no_page == $current_page)
			$diplay_string = $diplay_string . "	<TD width='10%' align=middle class='tab'><b>Last</b></TD>";
		else
			$diplay_string=$diplay_string. "<TD align=middle width='10%' bgcolor=> 	<A title='Go to the last page' target=_self href='". $link_pag ."?page=" .$no_page . $more_querystr. "'><b>Last</b></A></TD>";

		$diplay_string=$diplay_string . "	</TR></form></TABLE>	";

	}

	// make string eg. [1-20 OF 290]
	if ($ex_count > 0)
	{
		$last_record_no = $show_from + $page_size;
		if ($last_record_no > $ex_count)
			$last_record_no = $ex_count;

		$first_record_no = ($show_from+1);
	}
	else
	{
		$last_record_no = 0;
		$first_record_no = 0;
	}


	$return_this = $show_from .",". $page_size ."~". $diplay_string ."~ [ ". $first_record_no . "-". $last_record_no ." OF ". $ex_count ." ] ";

	return  $return_this;

}
//////END generation of pageing code

////// start function to display error
function displayerror($title,$errorno,$errordesc,$links,$reporterror)
{
		global $sitefont ,$sitefontweight;

    //Dim arrlinks 'Array to stores hyperlink text and Url
    //Dim intI 'Counter for For loop
    print "<body>";
    print "<center>";
    print "<table border=1 cellspacing=0 cellpadding=1 width=90%> ";
    print "  <tr bgcolor=#70b4eb>";
    print "    <td><font color=#FFFFFF face='$sitefont' ><b>".$title."</b></font></td>";
    print "  </tr>";
    print "  <tr>";
    print "    <td><br>";
    print "<font face='$sitefont' size='$sitefontweight' ><b> &nbsp;An error occurred during this process.</b></font><br><br>";
    print "<font face='$sitefont' size='$sitefontweight' >".$errorno."&nbsp;"."</font>";
    print "<font face='$sitefont' size='$sitefontweight' >".$errordesc."</font>";
    //$err.$clear;

    $arrlinks=explode(",",$links);
    //echo "<br>".$arrlinks[0]."<p>".$arrlinks[1]."<p>".$arrlinks[2]."<p>".$arrlinks[3];//exit;

    print "<ul>";

    //Loop to show all hyperlinks
    for ($intI=0; ($intI<=count($arrlinks)-1);$intI=$intI+2){
      print "<li><font face=$sitefont size=$sitefontweight><b><a href='".$arrlinks[$intI+1]."'>".$arrlinks[$intI]."</a></font></li>";
    }


    //Condition checks if reporterror is one then show "Report This error" hyperlink
    //if cint(reporterror) = 1 then
    //        Response.Write "<li><a href='#'>Report This error</a></li>"
    //end if
    print "</ul>";
    print "</td>";
    print "</tr>";
    print "</table>";
    print "</center>";
}//end sub

function dateformate($datefor='')
{
$date=$datefor;
$date1=explode("-",$date);
$txtdate=$date1[2]."-".$date1[1]."-".$date1[0];
return $txtdate;
}



function dateformate1($datefor='')
{
$date=$datefor;
$date1=explode("-",$date);
if($date1[1]=="01"){$date1[1]="January";}
if($date1[1]=="02"){$date1[1]="February";}
if($date1[1]=="03"){$date1[1]="March";}
if($date1[1]=="04"){$date1[1]="April";}
if($date1[1]=="05"){$date1[1]="May";}
if($date1[1]=="06"){$date1[1]="June";}
if($date1[1]=="07"){$date1[1]="July";}
if($date1[1]=="08"){$date1[1]="August";}
if($date1[1]=="09"){$date1[1]="September";}
if($date1[1]=="10"){$date1[1]="October";}
if($date1[1]=="11"){$date1[1]="November";}
if($date1[1]=="12"){$date1[1]="December";}
$txtdate=$date1[1]." ".$date1[2].", ".$date1[0];
return $txtdate;
}

function dateDiff($start, $end) {

$start_ts = strtotime($start);

$end_ts = strtotime($end);

$diff = $end_ts - $start_ts;

return round($diff / 86400);

}
return dateDiff("2006-04-05", "2006-04-01");






function imageresize($width, $height, $target) 
{ 
	//takes the larger size of the width and height and applies the  
	//formula accordingly...this is so this script will work  
	//dynamically with any size image 

	if ( ($width < $target) && ($height < $target) ) { 
		$percentage = 1; 
	} else if ($width > $height) { 
		$percentage = ($target / $width); 
	} else { 
		$percentage = ($target / $height); 
	} 

	//gets the new value and applies the percentage, then rounds the value 
	$width = round($width * $percentage); 
	$height = round($height * $percentage); 

	//returns the new sizes in html image tag format...this is so you 
	//can plug this function inside an image tag and just get the 
	return "width=\"$width\" height=\"$height\""; 
}	
/*
function query($query)
{
	if(!($result = mysqli_query($connection, $query)))  { echo "Query :- " . $query . "<br>Error :- " . mysqli_connect_errno(); exit; }
	return $result;
	
}
*/
function query($query)
{
	if(!($result = mysqli_query($connection, $query)))  { echo "Query :- " . $query . "<br>Error :- " . mysqli_connect_errno(); exit; }
	return $result;
	
}
function str_rand($length = 8, $seeds = 'alphanum')
{
    // Possible seeds
    $seedings['alpha'] = 'abcdefghijklmnopqrstuvwqyz';
    $seedings['numeric'] = '0123456789';
    $seedings['alphanum'] = 'abcdefghijklmnopqrstuvwqyz0123456789';
    $seedings['hexidec'] = '0123456789abcdef';
    // Choose seed
    if (isset($seedings[$seeds]))
    {
        $seeds = $seedings[$seeds];
    }
    // Seed generator
    list($usec, $sec) = explode(' ', microtime());
    $seed = (float) $sec + ((float) $usec * 100000);
    mt_srand($seed);
    
    // Generate
    $str = '';
    $seeds_count = strlen($seeds);
    
    for ($i = 0; $length > $i; $i++)
    {
        $str .= $seeds{mt_rand(0, $seeds_count - 1)};
    }
    return $str;
}

function preg_chk($data)
{
	$original_data=$data;

// 	$data = sprintf("%s", $data);
	$data_arr = @explode('\\',$data);
		for($i="0";$i<count($data_arr);$i++)
		{
			$data_val_arr[] = stristr($data_arr[$i], 'x');
		}
		for($j="0";$j<count($data_val_arr);$j++)
		{
			$ser = "/".$data_val_arr[$j]."/i";
			 $data =  preg_replace($ser , '', $data);
		}
		
	// Fix &entity\n;
$data = str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $data);
$data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
$data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
$data = @html_entity_decode($data, ENT_COMPAT, 'UTF-8');

// Remove any attribute starting with "on" or xmlns
$data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '', $data);

// Remove javascript: and vbscript: protocols
$data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$2nojavascript...', $data);
$data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$2novbscript...', $data);
$data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$2nomozbinding...', $data);

// Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '', $data);
$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '', $data);
$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '', $data);

// Remove namespaced elements (we do not need them)
		$data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);
		$data = preg_replace('/javascript/i', '', $data);
		$data = preg_replace('/onload/i', '', $data);	
		$data = preg_replace('/onerror/i', '', $data);
		$data = preg_replace('/alert/i', '', $data);
		$data = preg_replace('/onmouseover/i', '', $data);
		$data = preg_replace('/onmouserover/i', '', $data);
		$data = preg_replace('/select/i', '', $data);
		$data = preg_replace('/char\(/i', '', $data);
		$data = preg_replace('/concat\(/i', '', $data);
		$data = preg_replace('/<a/i', '', $data);
		$data = preg_replace('/</i', '', $data);
		$data = preg_replace('/>/i', '', $data);
		$data = preg_replace('/href="/i', '', $data);
		$data = str_replace("/'/i", '', $data);
		$data = preg_replace("/%27/i", '', $data);
		$data = preg_replace("/%22/i", '', $data);

		$data = preg_replace("/x27/i", '', $data);
		$data = preg_replace("/x22/i", '', $data);
		$data = preg_replace("/x20/i", '', $data);
		$data = preg_replace("/x3e/i", '', $data);
		$data = preg_replace("/x3csfi000076v795107/i", '', $data);
		$data = preg_replace("/x3csfi000342v460198/i", '', $data);

		$data = str_replace('/"/i', '', $data);
		$data = preg_replace('/FSCommand/i', '', $data);
		$data = preg_replace('/onAbort/i', '', $data);
		$data = preg_replace('/onActivate/i', '', $data);
		$data = preg_replace('/onAfterPrint/i', '', $data);
		$data = preg_replace('/onAfterUpdate/i', '', $data);
		$data = preg_replace('/onBeforeActivate/i', '', $data);
		$data = preg_replace('/onBeforeCopy/i', '', $data);
		$data = preg_replace('/onBeforeCut/i', '', $data);
		$data = preg_replace('/onBeforeDeactivate/i', '', $data);
		$data = preg_replace('/onBeforeEditFocus/i', '', $data);
		$data = preg_replace('/onBeforePaste/i', '', $data);
		$data = preg_replace('/onBeforePrint/i', '', $data);
		$data = preg_replace('/onBeforeUnload/i', '', $data);
		$data = preg_replace('/onBeforeUpdate/i', '', $data);
		$data = preg_replace('/onBegin/i', '', $data);
		$data = preg_replace('/onBlur/i', '', $data);
		$data = preg_replace('/onBounce/i', '', $data);
		$data = preg_replace('/onCellChange/i', '', $data);
		$data = preg_replace('/onChange/i', '', $data);
		$data = preg_replace('/onClick/i', '', $data);
		$data = preg_replace('/onContextMenu/i', '', $data);
		$data = preg_replace('/onControlSelect/i', '', $data);
		$data = preg_replace('/onCopy/i', '', $data);
		$data = preg_replace('/onCut/i', '', $data);
		$data = preg_replace('/onDataAvailable/i', '', $data);
		$data = preg_replace('/onDataSetChanged/i', '', $data);
		$data = preg_replace('/onDataSetComplete/i', '', $data);
		$data = preg_replace('/onDblClick/i', '', $data);
		$data = preg_replace('/onDeactivate/i', '', $data);
		$data = preg_replace('/onDrag/i', '', $data);
		$data = preg_replace('/onDragEnd/i', '', $data);
		$data = preg_replace('/onDragLeave/i', '', $data);
		$data = preg_replace('/onDragEnter/i', '', $data);
		$data = preg_replace('/onDragOver/i', '', $data);
		$data = preg_replace('/onDragDrop/i', '', $data);
		$data = preg_replace('/onDragStart/i', '', $data);
		$data = preg_replace('/onDrop/i', '', $data);
		$data = preg_replace('/onEnd/i', '', $data);
		$data = preg_replace('/onError/i', '', $data);
		$data = preg_replace('/onErrorUpdate/i', '', $data);
		$data = preg_replace('/onFilterChange/i', '', $data);
		$data = preg_replace('/onFinish/i', '', $data);
		$data = preg_replace('/onFocus/i', '', $data);
		$data = preg_replace('/onFocusIn/i', '', $data);
		$data = preg_replace('/onFocusOut/i', '', $data);
		$data = preg_replace('/onHashChange/i', '', $data);
		$data = preg_replace('/onHelp/i', '', $data);
		$data = preg_replace('/onInput/i', '', $data);
		$data = preg_replace('/onKeyDown/i', '', $data);
		$data = preg_replace('/onKeyPress/i', '', $data);
		$data = preg_replace('/onKeyUp/i', '', $data);
		$data = preg_replace('/onLayoutComplete/i', '', $data);
		$data = preg_replace('/onLoad/i', '', $data);
		$data = preg_replace('/onLoseCapture/i', '', $data);
		$data = preg_replace('/onMediaComplete/i', '', $data);
		$data = preg_replace('/onMediaError/i', '', $data);
		$data = preg_replace('/onMessage/i', '', $data);
		$data = preg_replace('/onMouseDown/i', '', $data);
		$data = preg_replace('/onMouseEnter/i', '', $data);
		$data = preg_replace('/onMouseLeave/i', '', $data);
		$data = preg_replace('/onMouseMove/i', '', $data);
		$data = preg_replace('/onMouseOut/i', '', $data);
		$data = preg_replace('/onMouseUp/i', '', $data);
		$data = preg_replace('/onMouseWheel/i', '', $data);
		$data = preg_replace('/onMove/i', '', $data);
		$data = preg_replace('/onMoveEnd/i', '', $data);
		$data = preg_replace('/onMoveStart/i', '', $data);
		$data = preg_replace('/onOffline/i', '', $data);
		$data = preg_replace('/onOnline/i', '', $data);
		$data = preg_replace('/onOutOfSync/i', '', $data);
		$data = preg_replace('/onPaste/i', '', $data);
		$data = preg_replace('/onPause/i', '', $data);
		$data = preg_replace('/onPopState/i', '', $data);
		$data = preg_replace('/onProgress/i', '', $data);
		$data = preg_replace('/onPropertyChange/i', '', $data);
		$data = preg_replace('/onReadyStateChange/i', '', $data);
		$data = preg_replace('/onRedo/i', '', $data);
		$data = preg_replace('/onRepeat/i', '', $data);
		$data = preg_replace('/onReset/i', '', $data);
		$data = preg_replace('/onResize/i', '', $data);
		$data = preg_replace('/onResizeEnd/i', '', $data);
		$data = preg_replace('/onResizeStart/i', '', $data);
		$data = preg_replace('/onResume/i', '', $data);
		$data = preg_replace('/onReverse/i', '', $data);
		$data = preg_replace('/onRowsEnter/i', '', $data);
		$data = preg_replace('/onRowExit/i', '', $data);
		$data = preg_replace('/onRowDelete/i', '', $data);
		$data = preg_replace('/onRowInserted/i', '', $data);
		$data = preg_replace('/onScroll/i', '', $data);
		$data = preg_replace('/onSeek/i', '', $data);
		$data = preg_replace('/onSelect/i', '', $data);
		$data = preg_replace('/onSelectionChange/i', '', $data);
		$data = preg_replace('/onSelectStart/i', '', $data);
		$data = preg_replace('/onStart/i', '', $data);
		$data = preg_replace('/onStop/i', '', $data);
		$data = preg_replace('/onStorage/i', '', $data);
		$data = preg_replace('/onStorage/i', '', $data);
		$data = preg_replace('/onSubmit/i', '', $data);
		$data = preg_replace('/onTimeError/i', '', $data);
		$data = preg_replace('/onTrackChange/i', '', $data);
		$data = preg_replace('/onUndo/i', '', $data);
		$data = preg_replace('/onUnload/i', '', $data);
		$data = preg_replace('/onURLFlip/i', '', $data);
		$data = preg_replace('/seekSegmentTime/i', '', $data);
		$data = str_replace('.../', '', $data);
		$data = str_replace('../', '', $data);
		$data = str_replace('./', '', $data);
		$data = preg_replace('/-/i', '', $data);
		$data = str_replace('...\\', '', $data);
		$data = str_replace('..\\', '', $data);
		$data = str_replace('.\\', '', $data);
		$data = str_replace('\\', '', $data);	
		$data = str_replace('_', '', $data);
		$data = str_replace(';', '', $data);
		$data = str_replace(';', '', $data);
		$data = str_replace('(', '', $data);
		$data = str_replace(')', '', $data);
do
{
	// Remove really unwanted tags
	$old_data = $data;
	$data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
}
while ($old_data !== $data);
// we are done...
if($original_data!=$data)
{
	//header("location:error.php");
	//exit;
}
return $data;
}
function log_entry($module,$modtitle,$action,$tblpref,$db,$adminid,$ip)
{
	@session_start();
	include("config.php");
	$perqury = sprintf("INSERT INTO ".$tblpref."log SET log_admin_id='%d', log_admin_module='%s',log_admin_rec_title='%s', log_admin_action='%s',log_admin_ip='%s',log_admin_date=CURDATE(), log_admin_time=CURTIME()",$adminid,$module,$modtitle,$action,$ip);
	if(!($perresult=mysqli_query($connection, $perqury)))
	{
		echo mysqli_connect_errno();
	}
}

function backup_tables($host,$user,$pass,$name,$tables = '*')
{
	
	$link = mysqli_connect($host,$user,$pass);
	mysqli_select_db($name,$link);
	
	//get all of the tables
	if($tables == '*')
	{
		$tables = array();
		$result = mysqli_query($connection, 'SHOW TABLES');
		while($row = mysqli_fetch_row($result))
		{
			$tables[] = $row[0];
		}
	}
	else
	{
		$tables = is_array($tables) ? $tables : explode(',',$tables);
	}
	
	//cycle through
	foreach($tables as $table)
	{
		$result = mysqli_query($connection, 'SELECT * FROM '.$table);
		$num_fields = mysqli_num_fields($result);
		
		$return.= 'DROP TABLE '.$table.';';
		$row2 = mysqli_fetch_row(mysqli_query($connection, 'SHOW CREATE TABLE '.$table));
		$return.= "\n\n".$row2[1].";\n\n";
		
		for ($i = 0; $i < $num_fields; $i++) 
		{
			while($row = mysqli_fetch_row($result))
			{
				$return.= 'INSERT INTO '.$table.' VALUES(';
				for($j=0; $j<$num_fields; $j++) 
				{
					$row[$j] = addslashes($row[$j]);
					$row[$j] = ereg_replace("\n","\\n",$row[$j]);
					if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
					if ($j<($num_fields-1)) { $return.= ','; }
				}
				$return.= ");\n";
			}
		}
		$return.="\n\n\n";
	}
	
	//save file
	$handle = fopen('db-backup-'.@date('dmy').'-'.@date('Gis').'-'.(md5(implode(',',$tables))).'.sql','w+');
	fwrite($handle,$return);
	fclose($handle);
}
function show_header_menu($parent,$connection,$db,$table, $cms_file)
{ 
	global $rewritepath, $connection, $db, $tblpref, $uploadpath;
		$querymenu=sprintf("SELECT * FROM ".$table." WHERE cms_id=%d AND cms_type='cms'  ORDER BY cms_id",$parent);
			if(!($resultmenu=mysqli_query($connection, $querymenu))){ echo $querymenu.mysqli_connect_errno(); exit;}
			$rowmenunum=mysqli_num_rows($resultmenu);
			while($row_menu = mysqli_fetch_array($resultmenu))
			{
				$querysubmenu=sprintf("SELECT * FROM ".$table." WHERE cms_parent='%d' ORDER BY cms_id ",$row_menu[cms_id]); 
				if(!($resultsubmenu=mysqli_query($connection, $querysubmenu))){ echo $querysubmenu.mysqli_connect_errno(); exit;}
				$rowsubmenunum=mysqli_num_rows($resultsubmenu);	
				
				if($row_menu[cms_id]!= 3000)
				{
					?>
					<li <?php if($rowsubmenunum > 0){?>class='has-sub <?php if($_GET[cid]==$row_menu[cms_id] || $_GET[cid]==$row_menu[cms_id]){?>active<?php }?>'<?php } ?>
					<?php if($_GET[cid]==$row_menu[cms_id] || $_GET[cid]==$row_menu[cms_id]){?>class="active"<?php }?>><a href="<?=$cms_file?>/cid/<?php echo $row_menu[cms_id]?>/<?php echo str_replace(" ","-",preg_replace('/\s\s+/', ' ', strtolower(trim(stripslashes($row_menu[cms_title])))))?>/"  ><?php echo $row_menu[cms_title]?></a>
<?php			
				}
				else
				{	
?>
					<li <?php if($_GET[cid]==$row_menu[cms_id] || $_GET[pid]==$row_menu[cms_id]){?>class="active"<?php }?> ><a href="#" <?php if($rowsubmenunum > 0){?>rel="submenu1<?=$row_menu[cms_id]?>"<?php } ?>><?php echo $row_menu[cms_title]?></a>
<?php			}
				if ($rowsubmenunum>0)
				{	
?>
					<ul id="submenu1<?=$row_menu[cms_id]?>" class="ddsubmenustyle">
<?php				while($row_menuchild = mysqli_fetch_array($resultsubmenu))						
					{
						show_header_menu($row_menuchild[cms_id],$connection,$db,$table, $cms_file);
					}
?>
					</ul>				
				</li>
<?
				}
} 

}
?>
