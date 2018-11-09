<?php
include('common/config.php');
include('common/app_function.php');

//$id = preg_chk($_GET[cid]);
$userval= preg_chk($_SESSION[userval]);
 $pstnsrch = preg_chk($_GET[pstnsrch]);
//print_r($row_home);
$title = "Nearest Police Stations";
index_header($title,$rewritepath,$tblpref,$db,$row_admin, $siteuploadpath);
		
		$query="SELECT * FROM ".$tblpref."content_master where cms_type='police' ";
		if(!($result=mysqli_query($connection,$query))){ echo $query.mysqli_errno($connection); exit;}
		
		if($pstnsrch!="")
		{
			$condition[]="(cms_title like '%$pstnsrch%' OR cms_desc like '%$pstnsrch%' OR cms_page_title like '%$pstnsrch%' OR cms_subtype like '%$pstnsrch%')";
		}

		$condition[]="cms_type='police'";
		
		if(is_array($condition))
		{
			$condition=" WHERE " . implode(" AND ",$condition);
		}

		$que="SELECT * FROM ".$tblpref."content_master $condition $condition2"; 
		$curr_query="sorton=".$_GET[sorton]."&sortby=".$_GET[sortby];
		
		$pagesize=20;
		$the_query  = pagination($que,$page,null,$curr_query,$pagesize);	
		$real_string     = explode("~" , $the_query);
		$que= $que.$cstr." LIMIT ". $real_string[0];
		$show_status     = $real_string[2];
		$show_pagination = $real_string[1];
		if (!($page_res = mysqli_query($connection,$que))) 
		{ echo "FOR QUERY: $strsql<BR>".mysqli_errno($connection); 	exit;}
		$rowCount = mysqli_num_rows($page_res);
		$srnum=$real_string[0][0];
		$srnum= $real_string[0];//--this is used to the next page no so that the srno at page comes  								in sequence
		$srnum=explode(",",$srnum);
		$count=$srnum[0];
?>

<main>
	<div class="main">
    
    <section class="innerbg">
    	<div class="container">
        	
            <h1 class="header">Search for Nearest Police</h1>
            
            <section class="title-section">
                <ol class="breadcrumb">
                  <li><a href="<?php echo $rewritepath; ?>index.php/home/">Home</a></li>
                  <li class="active">Search for Nearest Police</li>
                </ol> 
            </section>
            
        </div>
    </section>
    
    <section>
    	<div class="container">

        <div class="row">
        <div class="col-md-9 col-sm-8">
        
<!--start-->	
	
    <h2>Search for Nearest Police</h2>
    
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table stbl">
      <tbody>
        <tr>
          <th scope="col">Police Station Name</th>
          <th scope="col">Area</th>
          <th scope="col">City</th>
          <th scope="col">View Detail</th>
        </tr>
		<?php 
		if($rowCount > 0){
			while($row_category=mysqli_fetch_array($page_res)){ 
			$count ++;
		?>
        <tr>
          <td><?php  echo htmlentities(stripslashes($row_category[cms_title]));?></td>
          <td><?php  echo htmlentities(stripslashes($row_category[cms_subtype]));?></td>
          <td><?php  echo htmlentities(stripslashes($row_category[cms_page_title]));?></td>
          <td align="center"><a href="<?php echo $rewritepath; ?>index.php/bps-police-stations-detail/cid/<? echo $row_category[cms_id];?>/" class="btn btn-default">View</a></td>
        </tr>
		<?php } } else { ?>

		<tr> <td colspan="4"><h3><font color="red">No Police station Search...</font></h3></td></tr>
		<?php } ?>
       
      </tbody>
    </table> 
      
         
            
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