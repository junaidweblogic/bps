<?php
	include("common/config.php");
	include("common/app_function.php");
	
	$query = "SELECT * FROM ".$tblpref."content_master WHERE cms_type = 'faq' ORDER BY cms_date DESC";
	if(!($result = mysqli_query($connection,$query))) { echo "Query :- " . $query . "<br />Error :- " . mysqli_connect_errno(); exit; }
	
$title = "FAQ's";
index_header($title,$rewritepath,$tblpref,$db,$row_admin, $siteuploadpath);
?>

<main>
	<div class="main">
    
    <section class="innerbg">
    	<div class="container">
        	
            <h1 class="header">FAQs</h1>
            
            <section class="title-section">
                <ol class="breadcrumb">
                  <li><a href="<?php echo $rewritepath ; ?>index.php/home/">Home</a></li>
                  <li class="active">FAQs</li>
                </ol> 
            </section>
            
        </div>
    </section>
    
    <section>
    	<div class="container">

        <div class="row">
        <div class="col-md-9 col-sm-8">
        
<!--start-->	
            
      <h2>FAQs</h2> 
      
      <div class="panel-group accordionfaq" id="accordion">
				<?php 
				$cnt=0;
				while($row_faq = mysqli_fetch_array($result)){ 
					$cnt++; 
				?> 
                    <div class="panel panel-primary">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $row_faq[cms_id]; ?>">
                      <div class="panel-heading que title">
                        <?php  echo htmlentities(stripslashes($row_faq[cms_title]))?>
                      </div>
                      </a>
                      <div id="collapse<?php echo $row_faq[cms_id]; ?>" class="panel-collapse collapse <?php if($cnt==1) { echo "in"; } ?>">
                        <div class="panel-body">
                        	<p><?php  echo stripslashes($row_faq[cms_desc])?></p>
                        </div>
                      </div>
                    </div>
					<?php } ?>
                    
                    
                    
           </div>
            
            
<!--end-->

	</div><!--/left side-->
    <?php
			right_panel($rewritepath,$tblpref,$db,$row_admin,$connection,$id);
		?>
    </div><!--/-->
     
        <div class="clr"></div>    
        </div>
    </section>
    
    
   
    </div>
</main>

<?php
index_footer($rewritepath,$tblpref,$db,$row_admin,$connection);
?>