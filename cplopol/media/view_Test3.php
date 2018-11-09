<?php include("../../common/cploconfig.php");
 
	$category=$_GET[drop1];
	if($category != "") {
		$query1="SELECT * FROM  ".$tblpref."content_master WHERE cms_subtype  ='$category' AND cms_type='media'"; 
		if (!($result = mysqli_query($connection,$query1))) { echo "FOR QUERY: $query1<BR>".mysqli_errno($connection); 	exit;}

?>
<select NAME="media" id="media" class="inpt" onchange="display(this.value);">
				<option value="" >Please Select</option>			
				<?php while($row=mysqli_fetch_array($result)){?>
				<option value="<?php  echo $row[cms_title]?>" ><?php  echo $row[cms_title]?> </option>
                <?php }
				 mysqli_free_result($result);
				 ?> 
				</select>
<?php } else { ?>
<select NAME="media" class="inpt"id="media" >
<option value="" >Please Select</option>			
</select>
<?php } ?>