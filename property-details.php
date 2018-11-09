<?php
include('common/config.php');
include('common/app_function.php');

$rid = preg_chk($_GET[rid]);

$query = sprintf("SELECT * FROM " . $tblpref . "category WHERE cat_id = '%d'", $rid);
if(!($result=mysqli_query($connection,$query))){echo $query.mysqli_connect_errno(); exit;}
$rows = mysqli_fetch_array($result);

$query_lost_property=sprintf("SELECT * FROM " . $tblpref . "content_master WHERE cms_subtype = '%d' AND cms_type='property' and cms_subdate >= CURDATE() ORDER BY cms_id", $rid);
if(!($result_lost_property=mysqli_query($connection,$query_lost_property))) { $query_lost_property."<br>Error: ".mysqli_connect_errno()."<br>File: ".__FILE__."<br>Line: ".__LINE__;	; exit(); }
$nums = mysqli_num_rows($result_lost_property);

$title = stripslashes($rows[cat_title]);

index_header($title,$rewritepath,$tblpref,$db,$row_admin, $siteuploadpath);
?>
<main>
	<div class="main">
    
    <section class="innerbg">
    	<div class="container">
        	
            <h1 class="header"><?php echo stripslashes($rows[cat_title]); ?></h1>
            
            <section class="title-section">
                <ol class="breadcrumb">
                  <li><a href="<?php echo $rewritepath; ?>index.php/home/">Home</a></li>
                  <li><a href="<?php echo $rewritepath; ?>index.php/bps-property/">Recovery Property</a></li>
                  <li class="active"><?php echo stripslashes($rows[cat_title]); ?></li>
                </ol> 
            </section>
            
        </div>
    </section>
    
    <section>
    	<div class="container">
<!--start-->	
        <?php 
		if( $nums > 0 ) {
			while($row_lost_property=mysqli_fetch_array($result_lost_property)){
			if($row_lost_property[cms_file]!="")
			{
				$lost_property_img = $siteuploadpath.$row_lost_property[cms_file];
			}
			else
			{
				$lost_property_img = $rewritepath."images/no-img.jpg";
			}
			 
		?>    
      
      <div class="mediablock">
            <div class="row">
                <div class="col-sm-9">
            <div class="smlthumb">
                <a href="<?php echo $lost_property_img; ?>"  class="fancybox" data-fancybox-group="gallery"><img src="<?php echo $lost_property_img; ?>" alt=""></a>
            </div>
            <h4><?php echo stripslashes($row_lost_property[cms_title]); ?></h4>
            <p><?php echo stripslashes($rows[cat_title]); ?></p>
                </div>
                <div class="col-sm-3">
                    <!--<div class="action"><a href="#" class="btn btn-default">View Details</a></div>-->
                </div>
            </div>
      </div>
      <?php } } else { ?>
	  <div class="gap"></div> 
	  <div class="gap"></div> 
	  <div class="gap"></div>
	  <div class="gap"></div>
		<h3> No item Found For Recovered Property Category <?php echo ucfirst(stripslashes($rows[cat_title])); ?> </h3>
	  <div class="gap"></div> 
	  <div class="gap"></div>
	  <div class="gap"></div>
	  <div class="gap"></div>
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