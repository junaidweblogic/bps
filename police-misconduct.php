<?php
include('common/config.php');
include('common/app_function.php');

$id = preg_chk($_GET[cid]);
$userval= preg_chk($_SESSION[userval]);

//print_r($row_home);
$title = "Police Misconduct";
index_header($title,$rewritepath,$tblpref,$db,$row_admin, $siteuploadpath);
?>

<main>
	<div class="main">
    
    <section class="innerbg">
    	<div class="container">
        	
            <h1 class="header">Report Police Misconduct</h1>
            
            <section class="title-section">
                <ol class="breadcrumb">
                  <li><a href="<?php echo $rewritepath; ?>index.php/home/">Home</a></li>
                  <li class="active">Report Police Misconduct</li>
                </ol> 
            </section>
            
        </div>
    </section>
    
    <section>
    	<div class="container">

        <div class="row">
        <div class="col-md-9 col-sm-8">
        
<!--start-->	
            
      

	<h2>Report Police Misconduct</h2>
    
    
    <?php
	
			if(preg_chk($_POST[flag])=="wrong")
			{?>
				<div class="alert alert-danger" role="alert">Please Enter The Correct Given Code. </div>
			<?php
			}
			if(preg_chk($_POST[flag])=="blank")
			{?>
				<div class="alert alert-danger" role="alert">Some of the required parameters are blank. </div>
			<?php
			}
			if(preg_chk($_POST[flag])=="hash")
			{?>
				<div class="alert alert-danger" role="alert">Token didn't match. </div>
			<?php
			}
			if(preg_chk($_POST[flag])=="embed")
			{?>
				<div class="alert alert-danger" role="alert">Invalid Tokens. </div>
			<?php
			}
			if(preg_chk($_POST[flag])=="direct")
			{?>
				<div class="alert alert-danger" role="alert">You cannot use this page directly. </div>
			<?php
			}
			if(preg_chk($_POST[flag])=="add")
			{?>
				<div class="alert alert-success" role="alert">You have successfully submitted the Feedback and Commendation. </div>
			<?php
			}?>
    <form action="<?php echo $rewritepath; ?>index.php/submit-police-misconduct/" method="POST" name="frmfc" onsubmit="return validate();">
    <div class="row">
        <div class="col-md-6 col-sm-6">
            <div class="form-group">
                <label>Name:</label>
                <input type="text" placeholder="Name" id="txtname" class="form-control" name="txtname" id="txtname" value="<?php echo preg_chk($_POST['txtname'])?>">
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="form-group">
                <label>Tel No.:</label>
                <input type="text" placeholder="Telephone" id="" class="form-control" name="tel" id="tel" value="<?php echo preg_chk($_POST['tel'])?>">
            </div>
        </div>
        
        <div class="col-md-6 col-sm-6">
            <div class="form-group">
                <label>Email ID:</label>
               <input type="email" placeholder="Email ID" id="" class="form-control" name="email" id="email" value="<?php echo preg_chk($_POST['email'])?>">
            </div>
        </div>
        
        <div class="col-md-6 col-sm-6">
            <div class="form-group">
                <label>Reporting on :</label>
                <select class="form-control" name="reporting" id="reporting" required>
                  	<option value="" selected>Please Select</option>
                    <option value="Individual Officer" <?php if(preg_chk($_POST['reporting']) == 'Individual Officer'){ ?> selected <?php } ?>>Individual Officer</option>
                    <option value="Station" <?php if(preg_chk($_POST['reporting']) == 'Station'){ ?> selected <?php } ?>>Station</option>
                    <option value="Group of Officers" <?php if(preg_chk($_POST['reporting']) == 'Group of Officers'){ ?> selected <?php } ?>>Group of Officers</option>
                    <option value="Whole Organisation" <?php if(preg_chk($_POST['reporting']) == 'Whole Organisation'){ ?> selected <?php } ?>>Whole Organisation</option>
                </select>
            </div>
        </div>
        
        <div class="col-md-6 col-sm-6">
            <div class="form-group">
                <label>Date of Misconduct :</label>
                <input type="text" placeholder="Date of Incident" id="" class="form-control datetimepicker" name="txtdate" id="txtdate" value="<?php echo $_POST['txtdate'];?>" required>
            </div>
        </div>
        
         <div class="col-md-6 col-sm-6">
            <div class="form-group">
                <label>Time of Misconduct :</label>
                <div class="row">
                <div class="col-sm-3 col-xs-4">
                <select name="hourtime" id="hourtime" class="form-control">
		    	<? 
					$hr=1; 
					while($hr <= 12){ ?>
					<option value="<?php echo $hr; ?>"><?php echo $hr; ?></option>
					<? $hr++; } ?>
				</select>
                </div>
                <div class="col-sm-3 col-xs-4">
                <select name="mintime" id="mintime" class="form-control">
					<?
					$min=1;
					while($min <= 60){ ?>
					<option value="<?php echo $min; ?>"><?php echo $min; ?></option>
					<? $min++; } ?>
				</select>
                </div>
                <div class="col-sm-6 col-xs-4">
                <label class="radio-inline"><input name="txttime" type="radio" value="AM" <?php if(preg_chk($_POST['txttime']) == 'AM'){ ?> checked <?php } ?>>AM</label>
					<label class="radio-inline"><input name="txttime" type="radio" value="PM" <?php if(preg_chk($_POST['txttime']) == 'PM'){ ?> checked <?php } ?>>PM</label>
                </div>
                </div><!--/-->
                
            </div>
        </div>
        
    </div>
    
    <div class="row">  
        <div class="col-md-6 col-sm-6">
            <div class="form-group">
                <label>Location of Misconduct :</label>
                <textarea class="form-control" rows="5"  name="location" id="location" required><?php echo preg_chk($_POST['location'])?></textarea>
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="form-group">
                <label>Name (Employee / Station or leader of group) :</label>
                <textarea class="form-control" rows="5" name="txtemp" id="txtemp" required><?php echo preg_chk($_POST['txtemp'])?></textarea>
            </div>
        </div>
        
    </div>
    
    <div class="row">
    	<div class="col-md-12 col-sm-12">
    <div class="form-group">
    <label>What initiated your contact with the Police ?</label>
    	
    <div class="column2">
        
    	<div class="checkbox">
          <label><input value="Police response to your call" type="checkbox"name="chkresponse[]">Police response to your call</label>
        </div>
        <div class="checkbox">
          <label><input value="Traffic stop" type="checkbox" name="chkresponse[]">Traffic stop</label>
        </div>
        <div class="checkbox">
          <label><input value="Traffic collision" type="checkbox" name="chkresponse[]">Traffic collision</label>
        </div>
        <div class="checkbox">
          <label><input value="Made a report at a police station" type="checkbox" name="chkresponse[]">Made a report at a police station</label>
        </div>
        <div class="checkbox">
          <label><input value="Pick up property" type="checkbox" name="chkresponse[]">Pick up property</label>
        </div>
        <div class="checkbox">
          <label><input value="Visit a detective" type="checkbox" name="chkresponse[]">Visit a detective</label>
        </div>
        <div class="checkbox">
          <label><input value="Release a prisoner" type="checkbox" name="chkresponse[]">Release a prisoner</label>
        </div>
        <div class="checkbox">
          <label><input value="Witness at a police investigation" type="checkbox" name="chkresponse[]">Witness at a police investigation</label>
        </div>
        <div class="checkbox">
          <label><input value="Other" type="checkbox" name="other">Other :</label>
        </div>
        <input type="text" placeholder="Other" id="other" class="form-control" name="other">
   </div>
    
    </div>
    	</div>
        
    </div>
    
    <div class="row">
    	<div class="col-md-12">
        	<div class="form-group">
                <label>Report  :</label>
                <textarea class="form-control" rows="5" name="report" id="report" required><?php echo preg_chk($_POST['report'])?></textarea>
            </div>
        </div>
    </div><!--/-->
    
    <!-- <label>Solved it :</label>
    <div class="form-group clearfix">
        <label class="captcha"><img src="images/captcha.jpg" alt="Captcha"></label>
        <input class="form-control result" id="captcha" placeholder="Result" required="" type="text">
    </div> -->
	<script src='https://www.google.com/recaptcha/api.js'></script>
               			<div class="g-recaptcha" data-sitekey="<?php echo $recaptcha_site?>"></div>
               			<br/>
    
    <div class="form-group">
		<input type="hidden" name="categoryfrm" value="RPM">
		<input type="hidden" name="userval" id="userval" value="<?php echo $userval;?>">
       <input class="btn btn-default" value="Submit" type="submit">
    </div>
      
	</form>
            
            
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