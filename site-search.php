<?php
include("common/config.php");
include("common/app_function.php");

$search = urldecode(preg_chk($_GET[search]));
$title="Site Search";
index_header($title,$rewritepath,$tblpref,$db,$row_admin, $siteuploadpath);

// cms pages
$sel_search_cms = sprintf("SELECT * FROM ".$tblpref."content_master WHERE cms_type='mcms' AND (cms_title LIKE '%s%s%s' OR cms_desc LIKE '%s%s%s') ",'%',$search,'%','%',$search,'%');
if(!($res_search_cms = mysqli_query($connection,$sel_search_cms))) { echo $sel_search_cms.mysqli_connect_errno(); exit(); }
$num_search_cms = mysqli_num_rows($res_search_cms);

//News 
$sel_news = sprintf("SELECT * FROM ".$tblpref."content_master WHERE cms_type='news' AND cms_archived='no' AND (cms_title LIKE '%s%s%s' OR cms_desc LIKE '%s%s%s') ORDER BY cms_date,cms_id DESC",'%',$search,'%','%',$search,'%');
if(!($res_news = mysqli_query($connection,$sel_news))){echo $sel_news.mysqli_connect_errno();exit;}
$num_news = mysqli_num_rows($res_news);

//Events 
$sel_event = sprintf("SELECT * FROM ".$tblpref."content_master WHERE cms_type='event' AND (cms_title LIKE '%s%s%s' OR cms_desc LIKE '%s%s%s') ORDER BY cms_subdate ASC,cms_id DESC",'%',$search,'%','%',$search,'%');
if(!($res_event = mysqli_query($connection,$sel_event))){echo $sel_event.mysqli_connect_errno();exit;}
$num_event = mysqli_num_rows($res_event);

//Publicatons 
$sel_doc = sprintf("SELECT * FROM ".$tblpref."content_master WHERE cms_type='publication' AND (cms_title LIKE '%s%s%s' OR cms_desc LIKE '%s%s%s') ORDER BY cms_date DESC,cms_id DESC",'%',$search,'%','%',$search,'%');
if(!($res_doc = mysqli_query($connection,$sel_doc))){echo $sel_doc.mysqli_connect_errno();exit;}
$num_doc = mysqli_num_rows($res_doc);

?>
<main>
	<div class="main">
    	<div class="container">
        
        <section class="title-section">
            <ol class="breadcrumb">
                <li><a href="<?php echo $rewritepath; ?>index.php/home/">Home</a></li>
                <li class="active">Search : <?php echo $search; ?></li>
              </ol>
            </section>
	
			<h1 class="heading">Search : <?php echo $search; ?> </h1>
			<?php
				if($num_search_cms>0 || $num_news>0 || $num_event>0 || $num_doc>0  || $num_img_alb>0)
				{
					if($num_search_cms>0)
					{ 
						while($row_cont = mysqli_fetch_array($res_search_cms))
						{ ?>
							<h3><strong><?php echo htmlentities(stripslashes($row_cont[cms_title]));?></strong></h3>
						<?php
							$desc= $row_cont[cms_desc];
							$pos=0;$getstr="";
							$strings=strip_tags($desc);
							$pos=@strpos($strings, $search);
							if($pos!=0 && ($pos-30)>=0)
							{
								$posfirst=$pos-30;
							}
							else
							{
								$posfirst=$pos;
							}
							$posend=300;
							$getstr=substr($strings,$posfirst,$posend);
							echo stripslashes(str_replace($search,"<b>$search</b>",strtolower($getstr)));
							$link = $rewritepath."index.php/bps-content/cid/".$row_cont[cms_id]."/".str_replace(" ","-",preg_replace('/\s\s+/', ' ', strtolower(trim(stripslashes($row_cont[cms_title])))))."/"; ?>
								<p><a href="<?php echo $link; ?>" class="btn btn-default">Read More</a></p>
							<?php
						} ?>
						<div class="clear"></div>
					<?php
					}
					if($num_news>0)
					{  ?>
						<div class="gap"></div>
						<hr/>
						<h2 class="heading">News</h2>       
						<div class="row">
					<?php
						while($row_news = mysqli_fetch_array($res_news))
						{
							if($row_news[cms_file]!="")
							{
								$news_img = $siteuploadpath.$row_news[cms_file];
							}
							else
							{
								$news_img = $rewritepath."images/no-img.jpg";
							}?>
							<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
								<div class="news-box">
									<div class="thumb"><a href="<?php echo $rewritepath;?>index.php/bps-news-details/nid/<?php echo $row_news['cms_id'];?>/<?php echo str_replace(" ","-",preg_replace('/\s\s+/', ' ', strtolower(trim(stripslashes($row_news[cms_title])))));?>/"><img src="<?php echo $news_img; ?>" alt="News Image" class="img-responsive"></a></div>
									<p class="title"><?php echo ucfirst(stripslashes($row_news[cms_title]));?></p>
									<p class="date"><?php echo @date("d M,Y",strtotime($row_news[cms_date])); ?></p>
									<div class="limitbox">
										<?php echo stripslashes($row_news[cms_desc]);?>
									</div>
									<p><a href="<?php echo $rewritepath;?>index.php/bps-news-details/nid/<?php echo $row_news['cms_id'];?>/<?php echo str_replace(" ","-",preg_replace('/\s\s+/', ' ', strtolower(trim(stripslashes($row_news[cms_title])))));?>/" class="more">Read more</a></p>
								</div>
							</div>
					<?php
						} ?>
						</div>
						<div class="clear"></div>
						<?php
					}
					if($num_event>0)
					{ ?>
						<div class="gap"></div>
						<hr/>
						<h2 class="heading">Events</h2>
						<div class="row">
					<?php
						while($row_event = mysqli_fetch_array($res_event))
						{ 
						if($row_event[cms_file]!="")
							{
								$events_img = $siteuploadpath.$row_event[cms_file];
							}
							else
							{
								$events_img = $rewritepath."images/no-img.jpg";
							}
						?>
							<div class="col-md-6 col-sm-6">
								<div class="row flex">
									<div class="col-md-4">
										<div class="evthumb"><a href="<?php echo $rewritepath;?>index.php/bps-events-details/eid/<?php echo $row_event['cms_id'];?>/<?php echo str_replace(" ","-",preg_replace('/\s\s+/', ' ', strtolower(trim(stripslashes($row_event[cms_title])))));?>/"><img src="<?php echo $events_img ; ?>" alt="Events" class="img-responsive center-block"></a></div>
									</div>
									<div class="col-md-8 ypan">
										<p class="date"> <?php echo @date("d M,Y",strtotime($row_event[cms_subdate])); ?></p>
										<p class="title"><?php echo stripslashes($row_event[cms_title]); ?></p>
										<div class="limitbox">
											<?php echo stripslashes($row_event[cms_desc]); ?>
										</div>
										<p><a href="<?php echo $rewritepath;?>index.php/bps-events-details/eid/<?php echo $row_event['cms_id'];?>/<?php echo str_replace(" ","-",preg_replace('/\s\s+/', ' ', strtolower(trim(stripslashes($row_event[cms_title])))));?>/" class="more">Read more</a></p>
									</div>
								</div>
							</div>
							
						<?php
						} ?>
						</div>
						<div class="clear"></div>
						<?php
					} 
					 ?>
					<div class="clear"></div>
					
					<div class="clear"></div>
					
					
					<?php
				}
				else
				{ ?>
					<div class="alert alert-warning" role="alert">No Result Found. </div>
				<?php
				}
			?>
        </div><!--/wrap-->
        
        
	</div><!--/container-->
</main> 

 <?php
index_footer($rewritepath,$tblpref,$db,$row_admin,$connection);
?>