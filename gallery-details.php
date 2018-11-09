<?php
include("common/config.php");
include("common/app_function.php");
$id=$_GET[id];
$query_gallery=sprintf("SELECT * FROM ".$tblpref."category WHERE cat_id='%d'",$id);

if(!($result_gallery=mysqli_query($connection,$query_gallery)))
{
echo $query_gallery.".<br>Error.".mysqli_connect_errno().".<br>LINE.".__LINE__.".<br>FILE.".__FILE__;
}
$row_gal=mysqli_fetch_array($result_gallery);

$query_gallery_detail=sprintf("SELECT * FROM ".$tblpref."gallery WHERE img_album_id='%d'",$id);
if(!($result_gallery_detail=mysqli_query($connection,$query_gallery_detail)))
{
echo $query_gallery_detail.".<br>Error.".mysqli_connect_errno().".<br>LINE.".__LINE__.".<br>FILE.".__FILE__;
}
$title = $row_gal[cat_title];
index_header($title,$rewritepath,$tblpref,$db,$row_admin, $siteuploadpath);
?>

<main>
	<div class="main">
    
    <section class="innerbg">
    	<div class="container">
        	
            <h1 class="header"><?php echo stripslashes($row_gal[cat_title]); ?></h1>
            
            <section class="title-section">
                <ol class="breadcrumb">
                  <li><a href="<?php echo $rewritepath; ?>index.php/home/">Home</a></li>
                  <li><a href="<?php echo $rewritepath;?>index.php/bps-gallery/">Gallery</a></li>
                  <li class="active"><?php echo stripslashes($row_gal[cat_title]); ?></li>
                </ol> 
            </section>
            
        </div>
    </section>
    
    <section>
    	<div class="container">
<!--start-->	
            
      
      <div class="row multi-columns-row">
      <?php
			   while($row_sub=mysqli_fetch_array($result_gallery_detail))
			   {
			   if($row_sub[image_path]!='')
			   {
				 $image=$siteuploadpath.$row_sub[image_path];
			   }
			   else
			   {
				 $image = $rewritepath."images/no-img.jpg";
			   }
			   ?>
      	<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
        	<div class="gallery">
                <div class="galblock galblock_image">
   				<a data-fancybox-group="gallery" class="fancybox" href="<?php echo $image; ?>"><img class="img-responsive" alt="" src="<?php echo $image; ?>"></a>
                </div>
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