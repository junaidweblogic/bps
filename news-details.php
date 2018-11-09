<?php
include('common/config.php');
include('common/app_function.php');

$nid = preg_chk($_GET[nid]);

$query_news=sprintf("SELECT * FROM ".$tblpref."content_master WHERE cms_id='%d'",$nid);
if(!($result_news=mysqli_query($connection,$query_news))) { $query_news."<br>Error: ".mysqli_errno($connection)."<br>File: ".__FILE__."<br>Line: ".__LINE__;	; exit(); }
$row_news=mysqli_fetch_array($result_news);

if($row_news[cms_file]!="")
{
	$news_img = $siteuploadpath.$row_news[cms_file];
}
else
{
	$news_img = $rewritepath."images/no-img.jpg";
}

$title = stripslashes($row_news[cms_title]);

index_header($title,$rewritepath,$tblpref,$db,$row_admin, $siteuploadpath);
?>

<main>
	<div class="main">
    
    <section class="innerbg">
    	<div class="container">
        	
            <h1 class="header"><?php echo ucfirst(stripslashes($row_news[cms_title]));?></h1>
            
            <section class="title-section">
                <ol class="breadcrumb">
                  <li><a href="<?php echo $rewritepath; ?>index.php/home/">Home</a></li>
                  <li><a href="<?php echo $rewritepath; ?>index.php/bps-news/">News</a></li>
                  <li class="active"><?php echo ucfirst(stripslashes($row_news[cms_title]));?></li>
                </ol> 
            </section>
            
        </div>
    </section>
    
    <section>
    	<div class="container">
<!--start-->	
            
      
      <h2><?php echo ucfirst(stripslashes($row_news[cms_title]));?></h2>
      
      
      <div class="blockdetail">
      <ul class="thumb">
        <li><a href="<?php echo $news_img; ?>"  class="fancybox" data-fancybox-group="gallery"><img src="<?php echo $news_img; ?>" alt=""></a></li>
      </ul>
          
          <p class="date"><?php echo @date("d M,Y",strtotime($row_news[cms_date])); ?></p>
          <div class="clr-rt"></div>
          <?php echo stripslashes($row_news[cms_desc]);?>
        </div>
      

            
            
<!--end-->
        <div class="clr"></div>    
        </div>
    </section>
    
    
   
    </div>
</main>

<?php
index_footer($rewritepath,$tblpref,$db,$row_admin,$connection);
?>