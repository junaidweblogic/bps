<?php 
	include("common/config.php");
	include("common/diffrence.php");
	include("common/app_function.php");
	
	if($_GET['news'] != "") {
       $title = "Archived News & Announcements";
	   $query = sprintf("SELECT * FROM " . $tblpref . "content_master WHERE cms_type='news' AND cms_archived = 'yes' ORDER BY cms_date DESC, cms_id DESC");
	}
	else {
 		$title = "News & Announcements";
		$query = sprintf("SELECT * FROM " . $tblpref . "content_master WHERE cms_type='news' AND cms_archived = 'no' ORDER BY cms_date DESC, cms_id DESC");
	}

	if(!($result = mysqli_query($connection,$query))) { echo "Query :- " . $query . "<br />Error : " . mysqli_errno($connection); exit(); }
	$num = mysqli_num_rows($result);

index_header($title,$rewritepath,$tblpref,$db,$row_admin, $siteuploadpath);
	
?>
<main>
	<div class="main">
    
    <section class="innerbg">
    	<div class="container">
        	
            <h1 class="header">News</h1>
            
            <section class="title-section">
                <ol class="breadcrumb">
                  <li><a href="<?php echo $rewritepath; ?>index.php/home/">Home</a></li>
                  <li class="active">
				  <?php 
				  if($_GET['news'] != "") { echo "Archived News & Announcements";} 
				  else { echo "News & Announcements"; } ?></li>
                </ol> 
            </section>
            
        </div>
    </section>
    
    <section>
	 
    	<div class="container">
<!--start-->	
			<div class="frt">
				<p class="down-btn">
				<?php 
				if($_GET['news'] != "") { ?>
					<a class="btn btn-default" href="<?php echo $rewritepath; ?>index.php/bps-news/" ><i class="fa fa-arrow-left" aria-hidden="true"></i>
Back To News &amp; Announcements</a>
				<?php } else { ?>
					<a class="btn btn-default" href="<?php echo $rewritepath; ?>index.php/bps-news/news/arch/" >Archieved News &amp; Announcements</a>
				<?php } ?>
				</p>
			</div> 
			<div class="clear"></div>
      
      <div class="row multi-columns-row">
      <?php 
		while($row_news = mysqli_fetch_array($result)) { 
		if($row_news[cms_file]!="")
		{
			$news_img = $siteuploadpath.$row_news[cms_file];
		}
		else
		{
			$news_img = $rewritepath."images/no-img.jpg";
		}
	  ?>
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
		<?php } ?>
                
        
      </div><!--/-->
      

            
            
<!--end-->
        <div class="clr"></div>    
        </div>
    </section>
    
    
   
    </div>
</main>

<?php
index_footer($rewritepath,$tblpref,$db,$row_admin,$connection);
?>