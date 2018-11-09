<?php
include('common/config.php');
include('common/app_function.php');

$eid = preg_chk($_GET[eid]);

$query_event=sprintf("SELECT * FROM ".$tblpref."content_master WHERE cms_id='%d'",$eid);
if(!($result_event=mysqli_query($connection,$query_event))) { $query_event."<br>Error: ".mysqli_connect_errno()."<br>File: ".__FILE__."<br>Line: ".__LINE__;	; exit(); }
$row_event=mysqli_fetch_array($result_event);

if($row_event[cms_file]!="")
{
	$event_img = $siteuploadpath.$row_event[cms_file];
}
else
{
	$event_img = $rewritepath."images/no-img.jpg";
}

$title = stripslashes($row_event[cms_title]);

index_header($title,$rewritepath,$tblpref,$db,$row_admin, $siteuploadpath);
?>
<main>
	<div class="main">
    
    <section class="innerbg">
    	<div class="container">
        	
            <h1 class="header"><?php echo ucfirst(stripslashes($row_event[cms_title]));?></h1>
            
            <section class="title-section">
                <ol class="breadcrumb">
                  <li><a href="<?php echo $rewritepath; ?>index.php/home/">Home</a></li>
                  <li><a href="<?php echo $rewritepath; ?>index.php/bps-events/">Events</a></li>
                  <li class="active"><?php echo ucfirst(stripslashes($row_event[cms_title]));?></li>
                </ol> 
            </section>
            
        </div>
    </section>
    
    <section>
    	<div class="container">
<!--start-->	
            
      
      
      <h2><?php echo ucfirst(stripslashes($row_event[cms_title]));?></h2>
      
      
      <div class="blockdetail">
      <ul class="thumb">
        <li><a href="<?php echo $event_img; ?>"  class="fancybox" data-fancybox-group="gallery"><img src="<?php echo $event_img; ?>" alt=""></a></li>
      </ul>
      
      <!--<p class="frt"><a class="btn btn-default" href="images/demo.pdf" download=""><i class="fa fa-download"></i> Download</a></p>-->
      <p class="date"><?php echo @date("d M,Y",strtotime($row_event[cms_subdate])); ?></p>
          <div class="clr-rt"></div>
          <?php echo ucfirst(stripslashes($row_event[cms_desc]));?>
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