<?php 
	include("../../common/cploconfig.php");
 	$city=$_GET[city];
	if($city != "") {
	$query1="SELECT * FROM  ".$tblpref."category WHERE cat_image ='$city'"; 
	if (!($result = mysqli_query($connection,$query1))) { echo "FOR QUERY: $query1<BR>".mysqli_errno($connection); 	exit;}
?>
<select NAME="cmsarea" id="cmsarea"  onchange="empty(this.id),display(this.value);" class="inpt">
	<option value="" >Please Select</option>			
	<?php while($row=mysqli_fetch_array($result)){?>
	<option value="<?php  echo $row[cat_title]?>" ><?php  echo $row[cat_title]?> </option>
	<?php }?> 
	</select>
<?php } else { ?>
<select NAME="txtname" style="width:300px" id="txtname" class="inpt">
	<option value="" >Please Select</option>			
</select>
<?php } ?>