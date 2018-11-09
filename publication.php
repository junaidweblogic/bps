<?php
include('common/config.php');
include('common/app_function.php');

$sel_category=sprintf("SELECT * FROM ".$tblpref."category WHERE cat_type='Publication' Order by  cat_id ASc");
if(!($res_category = mysqli_query($connection,$sel_category))){echo $sel_category.mysqli_connect_errno();exit;}
$num_category = mysqli_num_rows($res_category);


$title = "Publications";
index_header($title,$rewritepath,$tblpref,$db,$row_admin, $siteuploadpath);
?>
<main>
	<div class="main">
    
    <section class="innerbg">
    	<div class="container">
        	
            <h1 class="header">Publications</h1>
            
            <section class="title-section">
                <ol class="breadcrumb">
                  <li><a href="<?php echo $rewritepath; ?>index.php/home/">Home</a></li>
                  <li class="active">Publications</li>
                </ol> 
            </section>
            
        </div>
    </section>
    
    <section>
    	<div class="container">

        <div class="row">
        <div class="col-md-9 col-sm-8">
        
<!--start-->	
            
      <div class="panel-group" id="accordion">
     <?php 
		$cnt=0;
		while($row_category = mysqli_fetch_array($res_category)){
		$cnt++; 
			
			$sel_pub = sprintf("SELECT * FROM ".$tblpref."content_master WHERE cms_subtype='%d' AND cms_type='Publication'",$row_category[cat_id]);
			if(!($res_pub=mysqli_query($connection,$sel_pub))) { $sel_pub."<br>Error: ".mysqli_connect_errno()."<br>File: ".__FILE__."<br>Line: ".__LINE__;	; exit(); }
			$num_pub = mysqli_num_rows($res_pub);
	?>   
   <div class="panel panel-default public">
      <div class="panel-heading">
      <a data-toggle="collapse" data-parent="#accordion" href="#collapse0<?php echo $row_category[cat_id]; ?>">
         <h3><?php echo stripslashes($row_category[cat_title]); ?></h3>
      </a>
      </div>
      <div id="collapse0<?php echo $row_category[cat_id]; ?>" class="panel-collapse collapse <?php if($cnt==1) { echo "in"; } ?>">
         <div class="panel-body">
         	<?php
				if($num_pub>0)
					{                  

					while($row_pub = mysqli_fetch_array($res_pub))
					{ 
						if($row_pub[cms_file1]!="")
						{ 
							$srcfp = $siteuploadpath.$row_pub[cms_file1];?>
							<div class="frt">
								<p class="down-btn">
								<a href="<?php echo $srcfp; ?>" target="_blank" class="btn btn-default">Download</a>
									<!-- <a class="btn btn-default" href="<?php echo $srcfp; ?>" target="_blank">Download</a> -->
								</p>
							</div>
				<?php	} ?>
						<div class="downloadblock">
							<h4 class="title"><?php echo stripslashes($row_pub[cms_title]); ?></h4>
							<p><?php echo stripslashes($row_pub[cms_desc]); ?></p>
						</div>
					<?php 
					} 
				}
				else
				{?>
					<div class="alert-block alert-text">
						<div class="alert alert-danger" role="alert">No Publication For <?php echo stripslashes($row_category[cat_title]); ?></div>
					</div>
				<?php } ?>
          

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