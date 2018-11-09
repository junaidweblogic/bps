<?php
include("common/config.php");
include("common/app_function.php");
include("common/diffrence.php");
$id = $_GET[id];
//TODAY
$querynews=sprintf("select * from ".$tblpref."content_master where cms_type='Event' AND cms_subdate= CURDATE()"); 
if(!($resultnews=mysqli_query($connection,$querynews))){ echo $querynews.mysqli_connect_errno(); exit;}
$num_rows=mysqli_num_rows($resultnews);

//UPCOMING
$queryevent=sprintf("select * from ".$tblpref."content_master where cms_type='Event' AND cms_subdate > CURDATE()"); 
if(!($resultevent=mysqli_query($connection,$queryevent))){ echo $queryevent.mysqli_connect_errno(); exit;}
$num_rows_event=mysqli_num_rows($resultevent);

index_header(":"." "."EVENTS",$rewritepath,$tblpref,$db,$row_admin, $siteuploadpath);
?> 

<main>
	<div class="main">
    
    <section class="innerbg">
    	<div class="container">
        	
            <h1 class="header">Events</h1>
            
            <section class="title-section">
                <ol class="breadcrumb">
                  <li><a href="<?php echo $rewritepath; ?>index.php/home/">Home</a></li>
                  <li class="active">Events</li>
                </ol> 
            </section>
            
        </div>
    </section>
    
    <section>
    	<div class="container">
<!--start-->	
      
      <div class="row">
      	<div class="col-md-6 col-md-offset-3">
        	<div class="text-center">
				<?php include("event-calender.php"); ?>
			</div>
        </div>
      </div><!--/-->
      <div class="gap"></div>
      
      <p>&nbsp;</p>
      <?php if($num_rows>0){?>
      	  <h2 class="text-center">Today Events</h2>
      	  <div class="row">
      <?php
      		    while($row_news=mysqli_fetch_array($resultnews))
      		    {
      			//$date = dateformate1($row_event['cms_date']);
      			if($row_news[cms_file]!="")
      			{
      			$news_img = $siteuploadpath.$row_news[cms_file];
      			}
      			else
      			{
      			 $news_img = $rewritepath."images/no-img.jpg";
      			}
      			?>
      	<div class="col-md-6 col-sm-6">
        	<div class="row flex">
                <div class="col-md-4">
                    <div class="evthumb"><a href="<?php echo $rewritepath;?>index.php/bps-events-details/eid/<?php echo $row_news['cms_id'];?>/<?php echo str_replace(" ","-",preg_replace('/\s\s+/', ' ', strtolower(trim(stripslashes($row_news[cms_title])))));?>/"><img src="<?php echo $news_img ; ?>" alt="Events" class="img-responsive center-block"></a></div>
                </div>
                <div class="col-md-8 ypan">
                    <p class="date"> <?php echo @date("d M,Y",strtotime($row_news[cms_subdate])); ?></p>
                    <p class="title"><?php echo stripslashes($row_news[cms_title]); ?></p>
                    <div class="limitbox">
						<?php echo stripslashes($row_news[cms_desc]); ?> 
                    </div>
                    <p><a href="<?php echo $rewritepath;?>index.php/bps-events-details/eid/<?php echo $row_news['cms_id'];?>/<?php echo str_replace(" ","-",preg_replace('/\s\s+/', ' ', strtolower(trim(stripslashes($row_news[cms_title])))));?>/" class="more">Read more</a></p>
                </div>
            </div>
        </div>
        <?php } 
      			?>
      	   </div>
      	   <?php }  ?>
        
      <?php if($num_rows_event>0){?>
	  <h2 class="text-center">Upcoming Events</h2>
	  <div class="row">
      <?php
		    while($row_events=mysqli_fetch_array($resultevent))
		    {
			//$date = dateformate1($row_event['cms_date']);
			if($row_events[cms_file]!="")
			{
			$event_img = $siteuploadpath.$row_events[cms_file];
			}
			else
			{
			 $event_img = $rewritepath."images/no-img.jpg";
			}
			?>
      	<div class="col-md-6 col-sm-6">
        	<div class="row flex">
                <div class="col-md-4">
                    <div class="evthumb"><a href="<?php echo $rewritepath;?>index.php/bps-events-details/eid/<?php echo $row_events['cms_id'];?>/<?php echo str_replace(" ","-",preg_replace('/\s\s+/', ' ', strtolower(trim(stripslashes($row_events[cms_title])))));?>/"><img src="<?php echo $event_img ; ?>" alt="Events" class="img-responsive center-block"></a></div>
                </div>
                <div class="col-md-8 ypan">
                    <p class="date"> <?php echo @date("d M,Y",strtotime($row_events[cms_subdate])); ?></p>
                    <p class="title"><?php echo stripslashes($row_events[cms_title]); ?></p>
                    <div class="limitbox">
						<?php echo stripslashes($row_events[cms_desc]); ?>
                    </div>
                    <p><a href="<?php echo $rewritepath;?>index.php/bps-events-details/eid/<?php echo $row_events['cms_id'];?>/<?php echo str_replace(" ","-",preg_replace('/\s\s+/', ' ', strtolower(trim(stripslashes($row_events[cms_title])))));?>/" class="more">Read more</a></p>
                </div>
            </div>
        </div>
        <?php } 
			?>
	   </div><!--/-->
	   <?php }  ?>
     

            
            
<!--end-->
        <div class="clr"></div>    
        </div>
    </section>
    
    
   
    </div>
</main>

<?php
index_footer($rewritepath,$tblpref,$db,$row_admin,$connection);
?>