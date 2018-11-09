<?php
include('common/config.php');
include('common/app_function.php');

$id = preg_chk($_GET[cid]);
$userval= preg_chk($_SESSION[userval]);

//print_r($row_home);
$title = "Police Stations Details";
index_header($title,$rewritepath,$tblpref,$db,$row_admin, $siteuploadpath);
	
	$query = sprintf("SELECT * FROM ".$tblpref."content_master WHERE cms_id='%d' and cms_type='%s'", $id, 'police');
	if(!($result = mysqli_query($connection,$query))) { echo "Query :- " . $query . "<br />Error :- " . mysqli_errno($connection); exit; }
	$row = mysqli_fetch_array($result);
	
	$query = sprintf("SELECT * FROM " . $tblpref . "content_master WHERE cms_id = '%s'", $row[cms_subtype]);
	if(!($results = mysqli_query($connection,$query))) { echo "Query :- " . $query . "<br />Error :- " . mysqli_errno($connection); exit; }
	$rows = mysqli_fetch_array($results);
	$nums = mysqli_num_rows($results);
	
	$num = mysqli_num_rows($result);
?>
<main>
	<div class="main">
    
    <section class="innerbg">
    	<div class="container">
        	
            <h1 class="header">Full list of Police Stations</h1>
            
            <section class="title-section">
                <ol class="breadcrumb">
                   <li><a href="<?php echo $rewritepath;?>index.php/home/">Home</a></li>
                  <li class="active">Full list of Police Stations</li>
                </ol> 
            </section>
            
        </div>
    </section>
    
    <section>
    	<div class="container">

        <div class="row">
        <div class="col-md-9 col-sm-8">
        
<!--start-->	
	
    <h2><?php echo htmlentities($row['cms_title']); ?></h2>
    
    
	<P><?php echo stripslashes($row['cms_desc']);?></P> 
      
      <?php 
	if($row['cms_page_title']!="")
	{?>
    <div class="gap"></div>
	<!-- <div class="gap"></div>
	<div class="gap"></div>
	<div class="gap"></div> -->
    <p><strong>HOW TO LOCATE US</strong></p>
    <div class="map-content">
    	<figure>
    		<?php echo stripslashes(str_replace('\r\n','',$row['cms_sitelink']));?>
      </figure>
    </div>
	<?php 
	}?>
       
            
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