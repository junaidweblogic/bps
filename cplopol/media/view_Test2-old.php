<?php 
	include("../../common/cploconfig.php");
 
	$msg=$_GET[drop1];
	if($msg=='p'){
	?>
	 <label class="warning">Please upload any of JPEG/ JPG/ PNG/ GIF/ PDF/ DOC/ XLS</label>
    <?php  } if($msg=='a'){ ?>
	<label class="warning">Please upload any of WMA / WAV Audio / MP3 max 10MB</label>
    <?php  } if($msg=='v'){?>
	<label class="warning">Please upload any of MPEG /MPG/ AVI Video max 10MB</label>
    <?php  } if($msg=='n'){?>
	<label class="warning">Please upload any of pdf /doc/ docx Document max 10MB </label>
  <?php  } ?>
 
