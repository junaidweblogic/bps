<?php
include("common/config.php");
include("common/app_function.php");
$query_gallery=sprintf("SELECT * FROM ".$tblpref."category WHERE cat_type='album' ORDER BY cat_id DESC");
if(!($result_gallery=mysqli_query($connection,$query_gallery)))
{
echo $query_gallery.".<br>Error.".mysqli_connect_errno().".<br>LINE.".__LINE__.".<br>FILE.".__FILE__;
}
$title = "Gallery";
index_header($title,$rewritepath,$tblpref,$db,$row_admin, $siteuploadpath);
?>
<main>
	<div class="main">
    
    <section class="innerbg">
    	<div class="container">
        	
            <h1 class="header">Gallery</h1>
            
            <section class="title-section">
                <ol class="breadcrumb">
                  <li><a href="<?php echo $rewritepath; ?>index.php/home/">Home</a></li>
                  <li class="active">Picture Gallery</li>
                </ol> 
            </section>
            
        </div>
    </section>
    
    <section>
    	<div class="container">
<!--start-->	
            
      
      <div class="row multi-columns-row">
      <?php
				 while($row_gal=mysqli_fetch_array($result_gallery)){
				 $query_sub=sprintf("SELECT * FROM ".$tblpref."gallery WHERE img_status='active' AND img_album_id='%d'",$row_gal[cat_id]);
				 if(!($result_sub=mysqli_query($connection,$query_sub)))
				 {
				 echo $query_sub."<br>Error:-".mysqli_connect_errno()."<br>LINE".__LINE__."<br>FILE".__FILE__;
				 }
				 $num_sub=mysqli_num_rows($result_sub);
				 $row_sub=mysqli_fetch_array($result_sub);
				 
				 $image=$siteuploadpath.$row_sub[image_path];
				 
				 if( $num_sub != '0'){
				 ?>
      	<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
        	<div class="gallery">
                <div class="galblock galblock_image">
                    <a href="<?php echo $rewritepath;?>index.php/bps-gallery-details/id/<?php echo $row_gal[cat_id];?>/">
                    <img src="<?php echo $image;?>" alt="gallery">
                    <div class="overlay2"><h5 class="text-center"><?php echo stripslashes($row_gal[cat_title]);?></h5></div>
                    </a>
                </div>
            </div>
        </div>
		<?php } }?>
        
        
        
        
        
      </div><!--/-->
      

            
            
<!--end-->
        <div class="clr"></div>    
        </div>
    </section>
    
    
   
    </div>
</main>


<?php
index_footer($rewritepath, $tblpref, $db, $row_admin, $connection);
?>