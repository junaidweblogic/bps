<?php
include("common/config.php");
include("common/app_function.php");
include("common/diffrence.php");
$id = $_GET[id];
//TODAY
$query_property=sprintf("select * from ".$tblpref."category WHERE cat_type='property' ORDER BY cat_id ASC"); 
if(!($result_property=mysqli_query($connection,$query_property))){ echo $query_property.mysqli_connect_errno(); exit;}
$num_rows=mysqli_num_rows($result_property);

$title ="Lost Property";

index_header($title,$rewritepath,$tblpref,$db,$row_admin, $siteuploadpath);
?> 
<main>
	<div class="main">
    
    <section class="innerbg">
    	<div class="container">
        	
            <h1 class="header">Recovered Property</h1>
            
            <section class="title-section">
                <ol class="breadcrumb">
                  <li><a href="<?php echo $rewritepath; ?>index.php/home/">Home</a></li>
                  <li class="active">Recovered Property</li>
                </ol> 
            </section>
            
        </div>
    </section>
    
    <section>
    	<div class="container">
<!--start-->	
            
      
      <div class="row">
		<?php 
		while($rows_property=mysqli_fetch_array($result_property))
		{
		?>
		  <div class="col-sm-6">
			<div class="well well-sm">
				<a href="<?php echo $rewritepath; ?>index.php/bps-property-details/rid/<?php echo $rows_property[cat_id]; ?>/<?php echo str_replace(" ","-",preg_replace('/\s\s+/', ' ', strtolower(trim(stripslashes($rows_property[cat_title])))));?>/"><h4><?php echo stripslashes($rows_property[cat_title]); ?></h4></a>
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