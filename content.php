<?php
include('common/config.php');
include('common/app_function.php');

$cid = preg_chk($_GET[cid]);

$sel_home = sprintf("SELECT * FROM ".$tblpref."content_master WHERE cms_id='%d' AND cms_type='mcms'",$cid);
if(!($res_home = mysqli_query($connection,$sel_home))){echo $sel_home.mysqli_connect_errno();exit;}
$num_home = mysqli_num_rows($res_home);
$row_home = mysqli_fetch_array($res_home);
//print_r($row_home);
$title = $row_home[cms_title];

index_header($title,$rewritepath,$tblpref,$db,$row_admin, $siteuploadpath);
?>
<main>
	<div class="main">
    
    <section class="innerbg">
    	<div class="container">
        	
            <h1 class="header"><?php echo ucwords(stripslashes($row_home[cms_title])); ?></h1>
            
            <section class="title-section">
                <ol class="breadcrumb">
                  <?php 
					if($row_home[cms_subtype]!="Main Pages")
					{
					$query2=sprintf("select * from ".$tblpref."content_master where cms_id='%d'",$row_home[cms_subtype]);
					if(!($result2=mysqli_query($connection,$query2))) {echo mysqli_connect_errno(); exit();}
					$row2=mysqli_fetch_array($result2);
					?>
						<li><a href="<?php echo $rewritepath;?>index.php/home/">Home</a></li>
					<?php
					$query3=sprintf("select * from ".$tblpref."content_master where cms_id='%d'",$row_home[cms_subtype]);
					if(!($result3=mysqli_query($connection,$query3))) {echo mysqli_connect_errno(); exit();}
					$row3=mysqli_fetch_array($result3);
					$row3[cms_subtype];
					if($row3[cms_subtype]!="Main Pages")
					{
					$query4=sprintf("select * from ".$tblpref."content_master where cms_id='%d'",$row3[cms_subtype]);
					if(!($result4=mysqli_query($connection,$query4))) {echo mysqli_connect_errno(); exit();}
					$row4=mysqli_fetch_array($result4);
					?>
						<!-- <li><a href="<?php echo $rewritepath;?>index.php/bps-content/cid/<?php echo $row4['cms_id'];?>/<?php echo str_replace(" ","-",preg_replace('/ss+/', ' ', trim(stripslashes($row4['cms_title']))));?>/"><?php echo stripslashes($row4['cms_title']); ?></a></li> -->
						<li><a href="<?php if($row4['cms_id']== '3' || $row4['cms_id']== '4' || $row4['cms_id']== '31' || $row4['cms_id']== '29'){ echo "#"; } else { echo $rewritepath."index.php/bps-content/cid/".$row4['cms_id']; ?>/<?php echo str_replace(" ","-",preg_replace('/ss+/', ' ', trim(stripslashes($row4['cms_title'])))); } ?> /"><?php echo stripslashes($row4['cms_title']); ?></a></li>
					<?php
					}
						
					?>
						<li><a href="<?php if($row2['cms_id']== '4' || $row2['cms_id']== '3' || $row2['cms_id']== '29' || $row2['cms_id']== '15' || $row2['cms_id']== '31'|| $row2['cms_id']== '37' ){ echo "#"; } else { echo $rewritepath."index.php/bps-content/cid/".$row2['cms_id']; ?>/<?php echo str_replace(" ","-",preg_replace('/ss+/', ' ', trim(stripslashes($row2['cms_title'])))); } ?> /"><?php echo stripslashes($row2['cms_title']); ?></a></li>
						<li class="active"><?php echo $row_home['cms_title']; ?></li>
						<!-- <li><a href="<?php echo $rewritepath;?>index.php/bps-content/cid/<?php echo $row2['cms_id'];?>/<?php echo str_replace(" ","-",preg_replace('/ss+/', ' ', trim(stripslashes($row2['cms_title']))));?>/"><?php echo stripslashes($row2['cms_title']); ?></a></li>
						<li class="active"><?php echo $row_home['cms_title']; ?></li> -->
					<?php
					}
					else 
					{ ?>
						<li><a href="<?php echo $rewritepath;?>index.php/home/">Home</a></li>
						<li class="active"><?php echo stripslashes($row_home['cms_title']);?></li>
					<?php
					} ?>
                </ol> 
            </section>
            
        </div>
    </section>
    
    <section>
    	<div class="container">

        <div class="row">
        <div class="col-md-9 col-sm-8">
        
<!--start-->	
            
      <h2><?php echo ucwords(stripslashes($row_home[cms_title])); ?></h2>
        
            
            
            <?php echo stripslashes($row_home[cms_desc]); ?>
            
          <div class="gap"></div>  
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