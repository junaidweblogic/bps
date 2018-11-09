<?php
include('common/config.php');
include('common/app_function.php');

$id = preg_chk($_GET[cid]);
$userval= preg_chk($_SESSION[userval]);

//print_r($row_home);
$title = "Police Stations";
index_header($title,$rewritepath,$tblpref,$db,$row_admin, $siteuploadpath);
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
	
    <h2>Full list of Police Stations</h2>
    
	<div class="row">
	<?php 
			if($_REQUEST['pstnsrch'] != "") 
			echo $query = "SELECT * FROM " . $tblpref . "category WHERE cat_type = 'city' and cat_title like '%".$pstnsrch."%' ORDER BY cat_title ASC";
			else
			$query = "SELECT * FROM " . $tblpref . "category WHERE cat_type = 'city' ORDER BY cat_title ASC";
			if(!($result = mysqli_query($connection,$query))) { echo "Query :- " . $query . "<br />Error :- " . mysqli_errno($connection); exit; }
			if( $num = mysqli_num_rows($result)) {	#if num of records exists then display names of city
			while($row = mysqli_fetch_object($result)) { 
	?>
		<div class="col-md-6 col-sm-6">
			<div class="panel panel-default posta">
				<div class="panel-heading">
					<h3 class="panel-title"><?php 
					echo htmlentities(stripslashes($row->cat_title)); ?></h3>
				</div>
				<div class="panel-body">
				<?php
						if($_REQUEST['pstnsrch'] != "") 
						$query = "SELECT * FROM " . $tblpref . "category WHERE cat_type = 'area' and cat_title like '%".$pstnsrch."%' ORDER BY cat_title ASC";
						else
						$query = "SELECT * FROM " . $tblpref . "category WHERE cat_image = '$row->cat_title' ORDER BY cat_title ASC";
						if(!($results = mysqli_query($connection,$query))) { echo "Query :- " . $query . "<br />Error :- " . mysqli_errno($connection); exit; }
						if( $nums = mysqli_num_rows($results)) {	#if num of records exists then display names of city
						 while($rows = mysqli_fetch_object($results)) {  
				?>
					<p><?php echo htmlentities(stripslashes($rows->cat_title)); ?></p>
				
					<ul class="listing">
							<?php
								if($_REQUEST['pstnsrch'] != "") 
								$query = "SELECT * FROM " . $tblpref . "category WHERE cms_type = 'police' and cms_page_title like '%".$pstnsrch."%' ORDER BY cms_title ASC";
								else
								 $query = "SELECT * FROM " . $tblpref . "content_master WHERE cms_type = 'police' AND cms_page_title = '$row->cat_title' AND cms_subtype = '$rows->cat_title' ORDER BY cms_title ASC";
								if(!($resultp = mysqli_query($connection,$query))) { echo "Query :- " . $query . "<br />Error :- " . mysqli_errno($connection); exit; }
								if( $nump = mysqli_num_rows($resultp)) {	#if num of records exists then display names of city
								while($rowp = mysqli_fetch_object($resultp)) { 
								?>
						<li><a href="<?php echo $rewritepath; ?>index.php/bps-police-stations-detail/cid/<?php echo $rowp->cms_id?>/"><?php echo htmlentities(stripslashes($rowp->cms_title));?></a></li>
						<?php } } ?>
						
					</ul>
				<?php } } ?>
				</div>
			</div>
		</div>
	<?php } } ?>
	</div><!--/-->  
      
         
            
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