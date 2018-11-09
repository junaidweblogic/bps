<?php
include("common/app_function.php");
include("common/config.php");

$title = "Success";
index_header($title,$rewritepath,$tblpref,$db,$row_admin, $siteuploadpath);

?>
<main>
	<div class="main">
    	<div class="container">        
			<ol class="breadcrumb">
			  <li><a href="<?php echo $rewritepath; ?>index.php/home/">Home</a></li>
			  <li class="active">Feedback  Successfull</li>
			</ol>
            
            <h1 class="heading">Feedback Successfull</h1>
			<div class="alert alert-success" role="alert"><strong>Your Feedback sent successfully</br> 
			Our executive will contact you soon. </strong></div>  			
        </div>
    </div>
	 <div class="gap"></div>
	 <div class="gap"></div>
	 <div class="gap"></div>
	 <div class="gap"></div>
	 <div class="gap"></div>
	 <div class="gap"></div>
	 <div class="gap"></div>
	  <div class="gap"></div>    
</main>
 <?php
index_footer($rewritepath,$tblpref,$db,$row_admin,$connection);
?>
