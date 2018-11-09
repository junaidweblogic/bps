<?php
include("common/config.php");
include("url_redirect.php");
include("common/app_function.php");
//home page content
$sel_home = sprintf("SELECT * FROM ".$tblpref."content_master WHERE cms_id='1' and cms_type='mcms'");
if(!($res_home = mysqli_query($connection, $sel_home))){echo $sel_home.mysqli_connect_errno(); exit();}
$row_home=mysqli_fetch_array($res_home);

if($row_home[cms_type]=='mcms' && $row_home[cms_featured ]=='Active')
{
	$home_cms_desc = stripslashes($row_home[cms_desc]);
}
else
{
		$sel_help_vir =sprintf("SELECT * FROM ".$tblpref."content_master WHERE cms_count ='%d' AND cms_featured = 'Active'",$row_home[cms_id]);
		if(!($res_help_vir=mysqli_query($connection, $sel_help_vir)))
		{ 
				echo "FOR QUERY: $sel_help_vir<BR>".mysqli_connect_errno(); exit;
		}
		$row_help_vir=mysqli_fetch_array($res_help_vir);
		$home_cms_desc = stripslashes($row_help_vir[cms_desc]);
}

$sel_commisioner= sprintf("SELECT * FROM ".$tblpref."content_master WHERE cms_id='2' and cms_type='mcms'");
if(!($res_commisioner = mysqli_query($connection, $sel_commisioner))){echo $sel_commisioner.mysqli_connect_errno(); exit();}
$row_commisioner=mysqli_fetch_array($res_commisioner);

if($row_commisioner[cms_type]=='mcms' && $row_commisioner[cms_featured ]=='Active')
{
	$comm_cont = stripslashes($row_commisioner[cms_desc]);
}
else
{
		$sel_help_vir =sprintf("SELECT * FROM ".$tblpref."content_master WHERE cms_count ='%d' AND cms_featured = 'Active'",$row_commisioner[cms_id]);
		if(!($res_help_vir=mysqli_query($connection, $sel_help_vir)))
		{ 
				echo "FOR QUERY: $sel_help_vir<BR>".mysqli_connect_errno(); exit;
		}
		$row_help_vir=mysqli_fetch_array($res_help_vir);
		$comm_cont = stripslashes($row_help_vir[cms_desc]);
}

$userval = preg_chk($_SESSION['userval']);
index_header($title,$rewritepath,$tblpref,$db,$row_admin, $siteuploadpath); 
?>
<section>
	<div class="container">
    	<div class="row">
        <div class="col-md-9">
    	<div class="banner">
            <div id="wowslider-container1">
            <div class="ws_images">
				<ul>
					<?php 
						$query = "SELECT * FROM " . $tblpref . "banner WHERE bn_parentid = '1' ORDER BY bn_id DESC";
						if(!($result = mysqli_query($connection, $query))) { echo "Query :- " . $query . "<br />Error :- " . mysqli_connect_errno(); exit; }
						while($row = mysqli_fetch_array($result)) 
					{ ?>
						<li><img src="<?php echo $rewritepath ; ?>possbpser/<?echo $row[bn_image];?>" alt="banner01" title="botswana police service" id="wows1_0"/></li>
				<?php } ?>
				 </ul>
			</div>
            </div>	
        </div>
        </div>
        <div class="col-md-3">
        	<div class="breakpanel">
            <div class="breakbg"><img src="<?php echo $rewritepath ; ?>images/breakingbg.png" alt="" class="img-responsive"></div>
            <div class="breakcontent">
            	
           
      	 <marquee  behavior="scroll" direction="up" height="auto" scrollamount="2" onMouseOver="this.setAttribute('scrollamount', 0, 0); this.stop();" OnMouseOut="this.setAttribute('scrollamount', 2, 0); this.start();">
            	
                <ul class="list">
					<?php 

					$query_news = "select * from ".$tblpref."content_master where cms_type='breakingnews' ORDER BY cms_id DESC LIMIT 0,3";
					if(!($result_news = mysqli_query($connection, $query_news))) :
					echo $query_news.mysqli_connect_errno();
					exit();
					endif;
					while($row_news = mysqli_fetch_assoc($result_news))
					{
					
					?>
				    <li>
					<h3><?php echo ucfirst(stripslashes($row_news['cms_title']));?></h3>
					   <?php echo strip_tags(wordwrap(substr(stripslashes($row_news['cms_desc']),0,1000)));?>
                    </li>
                    <?php } ?>
                    
                </ul>
                
                </marquee>
          
          
                
            </div><!--/breakcontent-->
            <div class="breakbgbot"><img src="<?php echo $rewritepath ; ?>images/breakbgbot.png" alt="" class="img-responsive"></div>
            </div>
            
        </div>
        </div><!--/-->
        
    </div>
</section>


<main>
	<div class="main">
    
    <section class="graybg">
    	<div class="container">
        	<div class="row flex">
            	<div class="col-md-7 vision">
                    
                	<?php echo $comm_cont; ?>
                    
                </div><!--/vision-->
                <div class="col-md-5 welcomebg">
                    	<h1>Welcome to <br>
						Botswana Police Service </h1>
                        <div class="welcometxt">
							<?php echo $home_cms_desc; ?>
                        </div>
						<?php
							//welcom
							$sel_welcom = sprintf("SELECT * FROM ".$tblpref."content_master WHERE cms_id='3' and cms_type='mcms'");
							if(!($res_welcom = mysqli_query($connection, $sel_welcom))){echo $sel_welcom.mysqli_connect_errno(); exit();}
							$row_welcom=mysqli_fetch_array($res_welcom);

							if($row_welcom[cms_type]=='mcms' && $row_welcom[cms_featured ]=='Active')
							{
								$id_welcom = $row_welcom[cms_id];
								$page_name_welcom = str_replace(" ","-",preg_replace('/\s\s+/', ' ', strtolower(trim(stripslashes($row_welcom[cms_title])))));
							}
							else
							{
									$sel_welcom_vir =sprintf("SELECT * FROM ".$tblpref."content_master WHERE cms_count ='%d' AND cms_featured = 'Active'",$row_welcom[cms_id]);
									if(!($res_welcom_vir=mysqli_query($connection, $sel_welcom_vir)))
									{ 
											echo "FOR QUERY: $sel_welcom_vir<BR>".mysqli_connect_errno(); exit;
									}
									$row_welcom_vir=mysqli_fetch_array($res_welcom_vir);
									$id_welcom = $row_welcom_vir[cms_id];
									$page_name_welcom = str_replace(" ","-",preg_replace('/\s\s+/', ' ', strtolower(trim(stripslashes($row_welcom_vir[cms_title])))));
							}
						?>
                        <p><a href="<?php echo $rewritepath;?>index.php/bps-content/cid/<?php echo $id_welcom; ?>/<?php echo $page_name_welcom; ?>/" class="more">Learn more</a></p>
                </div><!--/welcomebg-->
            </div><!--/-->
        </div>
    </section>
    
    <section>
    	<div class="container">
        	<h2 class="header">News &amp; Announcements</h2>
            <div class="row">
				<div id="owl-news" class="owl-carousel">
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
						<div class="thumb"><a href="<?php echo $rewritepath;?>index.php/bps-news-details/nid/<?php echo $row_news['cms_id'];?>/<?php echo str_replace(" ","-",preg_replace('/\s\s+/', ' ', strtolower(trim(stripslashes($row_news[cms_title])))));?>/"><img src="<?php echo $news_img ; ?>" alt="" class="img-responsive"></a></div>
							<p class="title"><?php echo ucfirst(stripslashes($row_news[cms_title])); ?></p>
							<p class="date"><?php echo @date("d M,Y",strtotime($row_news[cms_date])); ?></p>
						<div class="limitbox">
							<?php echo ucfirst(stripslashes($row_news[cms_desc])); ?>
						</div>
							<p><a href="<?php echo $rewritepath;?>index.php/bps-news-details/nid/<?php echo $row_news['cms_id'];?>/<?php echo str_replace(" ","-",preg_replace('/\s\s+/', ' ', strtolower(trim(stripslashes($row_news[cms_title])))));?>/" class="more">Read more</a></p>
					</div>
				<?php } ?>
                
				</div>
				<hr/>
				<p class="text-center"><a href="<?php echo $rewritepath; ?>index.php/bps-news/" class="btn btn-default">View More News</a></p>
            </div>
            
        </div>
    </section>
    
    <section class="bluebg">
    	<div class="container">
        	<div class="row">
            	<div class="col-md-8 col-sm-6">
<!--tab-->        
        <ul class="nav nav-tabs responsive" id="myTab">
            <li class="test-class active"><a href="#tab01" data-toggle="tab">Missing Persons</a></li>
            <li class="test-class"><a href="#tab02">Wanted Persons</a></li>
            <li><a href="#tab03">Lost &amp; Found</a></li>
          </ul>

      <div class="tab-content responsive">
        <div class="tab-pane active" id="tab01">
        
        <div id="owl-missing" class="owl-carousel">
		<?php 
			$query_miss = "SELECT * FROM c_banner WHERE bn_parentid='3' AND bn_exdate >= CURDATE() ORDER BY bn_name LIMIT 0,5";
		//$query = "SELECT * FROM c_banner WHERE bn_parentid='3' ORDER BY bn_name";
			if (!($result_miss = mysqli_query($connection, $query_miss))){  echo $query_miss.mysqli_connect_errno();  exit(); }
			if(0<mysqli_num_rows($result_miss))
			{
			while($row_miss=mysqli_fetch_array($result_miss)) {
				if($row_miss[bn_image]!="")
      			{
      				$missing_img = $siteuploadpath.$row_miss[bn_image];
      			}
      			else
      			{
      				 $missing_img = $rewritepath."images/no-img.jpg";
      			}
		?>
          <div class="wantedblock">
          	<div class="thumb"><img src="<?php  echo $missing_img; ?>" alt="Missing"></div>
            <div class="textblock">
            	<p class="title"><?php echo ucfirst(stripslashes($row_miss[bn_name])); ?></p>
                <?php echo ucfirst(stripslashes($row_miss[bn_desc])); ?>
            </div>
          </div>
		<?php } } ?>
       </div>
          
        </div><!--tab01-->
        
        <div class="tab-pane" id="tab02">
        
          <div id="owl-wanted" class="owl-carousel">
		  <?php 
			$query_wanted = "SELECT * FROM c_banner WHERE bn_parentid='2' AND bn_exdate >= CURDATE() ORDER BY bn_name LIMIT 0,5";
		//$query = "SELECT * FROM c_banner WHERE bn_parentid='3' ORDER BY bn_name";
			if (!($result_wanted = mysqli_query($connection, $query_wanted))){  echo $query_wanted.mysqli_connect_errno();  exit(); }
			if(0<mysqli_num_rows($result_wanted))
			{
			while($row_wanted=mysqli_fetch_array($result_wanted)) {
				if($row_wanted[bn_image]!="")
      			{
      				  $wanted_img = $siteuploadpath.$row_wanted[bn_image];
      			}
      			else
      			{
      				  $wanted_img = $rewritepath."images/no-img.jpg";
      			}
		?>
              <div class="wantedblock">
                <div class="thumb"><img src="<?php  echo $wanted_img; ?>" alt="Wanted"></div>
                <div class="textblock">
                    <p class="title"><?php echo ucfirst(stripslashes($row_wanted[bn_name])); ?></p>
                    <?php echo ucfirst(stripslashes($row_wanted[bn_desc])); ?>
                </div>
              </div>
             <?php } }?>
           </div>
        
        </div><!--/tab02-->
        
        <div class="tab-pane" id="tab03">
           
           <h4>Lost and Found Properties</h4>
           <!--<ul class="listing">
              <li>Members of the public are urged to report any  lost and found property to the nearest police station.</li>
              <li>Lost and found property should be handed to any  police station for safe keeping and identification by rightful owners.</li>
            </ul>-->
            
            <div class="row">
			<?php
				$query_property = "SELECT * FROM " . $tblpref . "category WHERE cat_type = 'property' ORDER BY cat_id";
				if(!($result_property=mysqli_query($connection, $query_property))){echo mysqli_error($query_property); exit;}
				while($row_property = mysqli_fetch_array($result_property)){
			?>
              <div class="col-sm-6">
                <div class="well well-sm">
                    <a href="<?php echo $rewritepath; ?>index.php/bps-property-details/rid/<?php echo $row_property[cat_id]; ?>/<?php echo str_replace(" ","-",preg_replace('/\s\s+/', ' ', strtolower(trim(stripslashes($row_property[cat_title])))));?>/"><h4><?php echo ucfirst(stripslashes($row_property[cat_title])); ?></h4></a>
                </div>
              </div>
			  <?php } ?>
              
           </div><!--/-->
           
           
        </div><!--/tab03-->
      </div>
<!--/tab-->	                
                </div>
                <div class="col-md-4 col-sm-6">
                	<div class="searchbox">
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
                </div>
            </div>
        </div>
    </section>
    
    <section>
    	<div class="container">
        	<div class="row">
            	<div class="col-md-8 col-sm-6">
              		<h2 class="header">Upcoming Events</h2>
                    
                    <div id="owl-events" class="owl-carousel">
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
							<div class="col-md-4">
								<div class="evthumb"><a href="<?php echo $rewritepath;?>index.php/bps-events-details/eid/<?php echo $rowevent['cms_id'];?>/<?php echo str_replace(" ","-",preg_replace('/\s\s+/', ' ', strtolower(trim(stripslashes($rowevent[cms_title])))));?>/"><img src="<?php echo $events_img ; ?>" alt="Events" class="img-responsive center-block"></a></div>
							</div>
							<div class="col-md-8 ypan">
								<p class="date"><?php echo @date("d M,Y",strtotime($rowevent[cms_subdate])); ?></p>
								<p class="title"><?php echo ucfirst(stripslashes($rowevent[cms_title]));?></p>
               
								<div class="limitbox">
								<?php echo stripslashes($rowevent[cms_desc]);?>
								</div>
								<p><a href="<?php echo $rewritepath;?>index.php/bps-events-details/eid/<?php echo $rowevent['cms_id'];?>/<?php echo str_replace(" ","-",preg_replace('/\s\s+/', ' ', strtolower(trim(stripslashes($rowevent[cms_title])))));?>/" class="more">Read more</a></p>
							</div>
						</div>
					<?php } ?>
                                      
                    </div><!--/-->
                    
                    
                </div>
                <div class="col-md-4 col-sm-6">
              		<h2 class="header">Useful Links</h2>
                      <div class="list-group bluelist">
                        <!--<a href="#" class="list-group-item">Turn Back Crime</a>-->
						<?php 
							$query_link = "select * from ".$tblpref."content_master where cms_type='link' ORDER BY cms_id DESC limit 0,5";
							if(!($result_link = mysqli_query($connection, $query_link))) {
								echo $query_link.mysqli_connect_errno();
								exit();
							}
						while($row_link = mysqli_fetch_assoc($result_link)){		   
						?>
						

                        <a target='_BLANK' href="<?php echo  "http://".$row_link['cms_sitelink'];?>" class="list-group-item"><?php echo htmlentities(ucfirst(stripslashes($row_link[cms_title])))?></a>
						<?php } ?>
                     </div>
                     
                </div>
            </div><!--/-->
        </div>
    </section>
    
    <div class="gap"></div>
    
    <section>
    	<div class="container">
        	<div class="row">
            	<div class="col-sm-6">
                	<div class="opprotunity">
                    	<div class="thumb"><img src="<?php echo $rewritepath ; ?>images/job.jpg" alt="Job Opprotunities"></div>
                        <div class="panel">
                        	<h3 class="header">Job Opportunities</h3>
                            <div class="gap"></div>
							<?php
								//home jo page
								$sel_home = sprintf("SELECT * FROM ".$tblpref."content_master WHERE cms_id='136' and cms_type='mcms'");
								if(!($res_home = mysqli_query($connection, $sel_home))){echo $sel_home.mysqli_connect_errno(); exit();}
								$row_home=mysqli_fetch_array($res_home);

								if($row_home[cms_type]=='mcms' && $row_home[cms_featured ]=='Active')
								{
									$id = $row_home[cms_id];
									$page_name = str_replace(" ","-",preg_replace('/\s\s+/', ' ', strtolower(trim(stripslashes($row_home[cms_title])))));
								}
								else
								{
										$sel_help_vir =sprintf("SELECT * FROM ".$tblpref."content_master WHERE cms_count ='%d' AND cms_featured = 'Active'",$row_home[cms_id]);
										if(!($res_help_vir=mysqli_query($connection, $sel_help_vir)))
										{ 
												echo "FOR QUERY: $sel_help_vir<BR>".mysqli_connect_errno(); exit;
										}
										$row_help_vir=mysqli_fetch_array($res_help_vir);
										$id = $row_help_vir[cms_id];
										$page_name = str_replace(" ","-",preg_replace('/\s\s+/', ' ', strtolower(trim(stripslashes($row_help_vir[cms_title])))));
								}
							?>
                            <!-- <p class="text-center"><a href="http://www.gov.bw/en/Ministries--Authorities/Ministries/State-President/Botswana-Police-Service-/Tools-and-Services/Job-Vacancies/?FromPageID=1590&FromPageType=1&pid=1&ClearSearch=true" class="more" target="_blank">Click here</a></p> -->
							<p class="text-center"><a href="<?php echo $rewritepath; ?>index.php/bps-content/cid/<?php echo $id; ?>/<?php echo $page_name ; ?>/" class="more">Click here</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                	<div class="opprotunity">
                    	<div class="thumb"><img src="<?php echo $rewritepath ; ?>images/tender.jpg" alt="Tenders"></div>
                        <div class="panel">
                        	<h3 class="header">Tenders</h3>
                            <div class="gap"></div>
							<?php
								//home jo page
								$sel_home = sprintf("SELECT * FROM ".$tblpref."content_master WHERE cms_id='137' and cms_type='mcms'");
								if(!($res_home = mysqli_query($connection, $sel_home))){echo $sel_home.mysqli_connect_errno(); exit();}
								$row_home=mysqli_fetch_array($res_home);

								if($row_home[cms_type]=='mcms' && $row_home[cms_featured ]=='Active')
								{
									$id = $row_home[cms_id];
									$page_name = str_replace(" ","-",preg_replace('/\s\s+/', ' ', strtolower(trim(stripslashes($row_home[cms_title])))));
								}
								else
								{
										$sel_help_vir =sprintf("SELECT * FROM ".$tblpref."content_master WHERE cms_count ='%d' AND cms_featured = 'Active'",$row_home[cms_id]);
										if(!($res_help_vir=mysqli_query($connection, $sel_help_vir)))
										{ 
												echo "FOR QUERY: $sel_help_vir<BR>".mysqli_connect_errno(); exit;
										}
										$row_help_vir=mysqli_fetch_array($res_help_vir);
										$id = $row_help_vir[cms_id];
										$page_name = str_replace(" ","-",preg_replace('/\s\s+/', ' ', strtolower(trim(stripslashes($row_help_vir[cms_title])))));
								}
							?>
                            <!-- <p class="text-center"><a href="http://www.gov.bw/en/Ministries--Authorities/Ministries/State-President/Botswana-Police-Service-/Tools-and-Services/Job-Vacancies/?FromPageID=1590&FromPageType=1&pid=1&ClearSearch=true" class="more" target="_blank">Click here</a></p> -->
							<p class="text-center"><a href="<?php echo $rewritepath; ?>index.php/bps-content/cid/<?php echo $id; ?>/<?php echo $page_name ; ?>/" class="more">Click here</a></p>
                        </div>
                    </div>
                </div>
            </div><!--/-->
        </div>
    </section>
    
   
    </div>
</main>

<?php 
	index_footer($rewritepath,$tblpref,$db,$row_admin,$connection); 
?>