  <?php
include('common/config.php');
include('common/app_function.php');

$id = preg_chk($_GET[cid]);
$userval= preg_chk($_SESSION[userval]);

$sel_home = sprintf("SELECT * FROM ".$tblpref."content_master WHERE cms_id='%d' AND cms_type='mcms'",$id);
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
        	
            <h1 class="header">Customer Satisfaction</h1>
            
            <section class="title-section">
                <ol class="breadcrumb">
                   <li><a href="<?php echo $rewritepath;?>index.php/home/">Home</a></li>
                  <li class="active">Customer Satisfaction</li>
                </ol> 
            </section>
            
        </div>
    </section>
    
    <section>
    	<div class="container">

        <div class="row">
        <div class="col-md-9 col-sm-8">
        
<!--start-->	
            
      

	<h2>Customer Satisfaction</h2>
    <h3>NATURE OF YOUR VISIT AND QUALITY OF RECEPTION</h3>
    
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
				<div class="alert alert-success" role="alert">You have successfully submitted the Customer Satisfaction Feedback. </div>
			<?php
			}?>
    
    
    <form name="frmcustsat" action="<?php echo $rewritepath; ?>index.php/submit-customer-satisfaction/" method="POST" onsubmit="return val()">
    <div class="form-group">
    	<label>1. What was the nature of your visit? (Please use a tick mark to indicate the nature of your visit.)</label>
        <div class="column5">
		    <div class="col">
                <div class="radio">
                  <label><input type="radio" name="radnature" value="Victim" <?php if(preg_chk($_POST['radnature']) == 'Victim'){ ?> checked <?php } else { ?>checked <?php } ?>/> Victim </label>
                </div>
            </div>
            <div class="col">
                <div class="radio">
                  <label><input type="radio" name="radnature" value="Complainant" <?php if(preg_chk($_POST['radnature']) == 'Complainant'){ ?> checked <?php } ?>/>Complainant </label>
                </div>
            </div>
            <div class="col">
                <div class="radio">
                  <label><input type="radio" name="radnature" value="Witness"  <?php if(preg_chk($_POST['radnature']) == 'Witness'){ ?> checked <?php } ?>/> Witness </label>
                </div>
            </div>
            <div class="col">
                <div class="radio">
                  <label><input type="radio" name="radnature" value="Accused/Suspect"  <?php if(preg_chk($_POST['radnature']) == 'Accused/Suspect'){ ?> checked <?php } ?>/> Accused/Suspect </label>
                </div>
            </div>
            <div class="col">
                <div class="radio">
                  <label><input type="radio" name="radnature" value="Other" <?php if(preg_chk($_POST['radnature']) == 'Other'){ ?> checked <?php } ?>/> Other </label>
                </div>
            </div>
        </div>
    </div>
    
    <div class="form-group">
    	<label>2. How satisfied were you with: (Please use a tick mark to indicate your rating)</label>
        <!--<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered stbl">
          <tbody>
            <tr>
              <th scope="col">&nbsp;</th>
              <th>Very satisfied</th>
              <th>Satisfied</th>
              <th>Dissatisfied</th>
              <th>Very dissatisfied</th>
              </tr>
            <tr>
              <td>Directions to the relevant office</td>
              <td align="center" valign="middle"><input name="radrel" value="Very satisfied" checked="" type="radio"></td>
              <td align="center" valign="middle"><input name="radrel" value="Satisfied" type="radio"></td>
              <td align="center" valign="middle"><input name="radrel" value="Dissatisfied" type="radio"></td>
              <td align="center" valign="middle"><input name="radrel" value="Very dissatisfied" type="radio"></td>
            </tr>
            <tr>
              <td>Office cleanliness</td>
              <td align="center" valign="middle"><input name="radclean" value="Very satisfied" checked="" type="radio"></td>
              <td align="center" valign="middle"><input name="radclean" value="Satisfied" type="radio"></td>
              <td align="center" valign="middle"><input name="radclean" value="Dissatisfied" type="radio"></td>
              <td align="center" valign="middle"><input name="radclean" value="Very dissatisfied" type="radio"></td>
            </tr>
            <tr>
              <td>Reception upon arrival</td>
              <td align="center" valign="middle"><input name="radrecep" value="Very satisfied" checked="" type="radio"></td>
              <td align="center" valign="middle"><input name="radrecep" value="Satisfied" type="radio"></td>
              <td align="center" valign="middle"><input name="radrecep" value="Dissatisfied" type="radio"></td>
              <td align="center" valign="middle"><input name="radrecep" value="Very dissatisfied" type="radio"></td>
            </tr>
            <tr>
              <td>Waiting time</td>
              <td align="center" valign="middle"><input name="radwaittime" value="Very satisfied" checked="" type="radio"></td>
              <td align="center" valign="middle"><input name="radwaittime" value="Satisfied" type="radio"></td>
              <td align="center" valign="middle"><input name="radwaittime" value="Dissatisfied" type="radio"></td>
              <td align="center" valign="middle"><input name="radwaittime" value="Very dissatisfied" type="radio"></td>
            </tr>
          </tbody>
        </table>-->
        
        <div class="row dottedline">
        	<div class="col-sm-4">
    	<label>Directions to the relevant office</label>
        	</div>
            <div class="col-sm-8">
            	<div class="column4">
                    <div class="col">
                        <div class="radio">
                          <label><input name="radrel" value="Very satisfied"  type="radio" <?php if(preg_chk($_POST['radrel']) == 'Very satisfied'){ ?> checked <?php } else { ?> checked <?php } ?> > Very satisfied </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="radio">
                          <label><input name="radrel" value="Satisfied" type="radio" <?php if(preg_chk($_POST['radrel']) == 'Satisfied'){ ?> checked <?php } ?>> Satisfied </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="radio">
                          <label><input name="radrel" value="Dissatisfied" type="radio" <?php if(preg_chk($_POST['radrel']) == 'Dissatisfied'){ ?> checked <?php } ?>> Dissatisfied </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="radio">
                          <label><input name="radrel" value="Very dissatisfied" type="radio" <?php if(preg_chk($_POST['radrel']) == 'Very dissatisfied'){ ?> checked <?php } ?>> Very dissatisfied </label>
                        </div>
                    </div>
                    
            	</div>
            </div>
       </div><!--/-->
       <div class="row dottedline">
        	<div class="col-sm-4">
    	<label>Office cleanliness</label>
        	</div>
            <div class="col-sm-8">
            	<div class="column4">
                    <div class="col">
                        <div class="radio">
                          <label><input name="radclean" value="Very satisfied"  type="radio" <?php if(preg_chk($_POST['radclean']) == 'Very satisfied'){ ?> checked <?php } else { ?> checked <?php } ?>> Very satisfied </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="radio">
                          <label><input name="radclean" value="Satisfied" type="radio" <?php if(preg_chk($_POST['radclean']) == 'Satisfied'){ ?> checked <?php } ?>> Satisfied </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="radio">
                          <label><input name="radclean" value="Dissatisfied" type="radio" <?php if(preg_chk($_POST['radclean']) == 'Dissatisfied'){ ?> checked <?php } ?>> Dissatisfied </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="radio">
                          <label><input name="radclean" value="Very dissatisfied" type="radio" <?php if(preg_chk($_POST['radclean']) == 'Very dissatisfied'){ ?> checked <?php } ?>> Very dissatisfied </label>
                        </div>
                    </div>
                    
            	</div>
            </div>
       </div><!--/-->
		<div class="row dottedline">
        	<div class="col-sm-4">
    	<label>Reception upon arrival</label>
        	</div>
            <div class="col-sm-8">
            	<div class="column4">
                    <div class="col">
                        <div class="radio">
                          <label><input name="radrecep" value="Very satisfied" type="radio" <?php if(preg_chk($_POST['radrecep']) == 'Very satisfied'){ ?> checked <?php } else { ?> checked <?php } ?>> Very satisfied </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="radio">
                          <label><input name="radrecep" value="Satisfied" type="radio" <?php if(preg_chk($_POST['radrecep']) == 'satisfied'){ ?> checked <?php } ?>> Satisfied </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="radio">
                          <label><input name="radrecep" value="Dissatisfied" type="radio" <?php if(preg_chk($_POST['radrecep']) == 'Dissatisfied'){ ?> checked <?php } ?>> Dissatisfied </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="radio">
                          <label><input name="radrecep" value="Very dissatisfied" type="radio" <?php if(preg_chk($_POST['radrecep']) == 'Very dissatisfied'){ ?> checked <?php } ?>> Very dissatisfied </label>
                        </div>
                    </div>
                    
            	</div>
            </div>
       </div><!--/-->
       <div class="row dottedline">
        	<div class="col-sm-4">
    	<label>Waiting time</label>
        	</div>
            <div class="col-sm-8">
            	<div class="column4">
                    <div class="col">
                        <div class="radio">
                          <label><input name="radwaittime" value="Very satisfied"  type="radio" <?php if(preg_chk($_POST['radwaittime']) == 'Very satisfied'){ ?> checked <?php } else { ?> checked <?php } ?>> Very satisfied </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="radio">
                          <label><input name="radwaittime" value="Satisfied" type="radio" <?php if(preg_chk($_POST['radwaittime']) == 'satisfied'){ ?> checked <?php } ?>> Satisfied </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="radio">
                          <label><input name="radwaittime" value="Dissatisfied" type="radio" <?php if(preg_chk($_POST['radwaittime']) == 'Dissatisfied'){ ?> checked <?php } ?>> Dissatisfied </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="radio">
                          <label><input name="radwaittime" value="Very dissatisfied" type="radio" <?php if(preg_chk($_POST['radwaittime']) == 'Very dissatisfied'){ ?> checked <?php } ?>> Very dissatisfied </label>
                        </div>
                    </div>
                    
            	</div>
            </div>
       </div><!--/-->
    </div>
    
    <h3>TREATMENT BY POLICE STAFF</h3>
    
    <div class="form-group">
    	<label>3. Please think about how you were treated by the police officers and other staff who dealt with you and give an overall impression of how you were treated. Did they: (Please use a tick mark to indicate your rating) </label>
        
        <div class="row dottedline">
        	<div class="col-sm-4">
    	<label>Listen to what you had to say?</label>
        	</div>
            <div class="col-sm-8">
            	<div class="column5">
                    <div class="col">
                        <div class="radio">
                          <label><input name="radlisten" value="Excellent" type="radio" <?php if($_POST['radlisten'] == 'Excellent'){ ?> checked <?php } else { ?> checked <?php } ?>> Excellent </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="radio">
                          <label><input name="radlisten" value="Good" type="radio" <?php if($_POST['radlisten'] == 'Good'){ ?> checked <?php }  ?>> Good </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="radio">
                          <label><input name="radlisten" value="Fair" type="radio" <?php if($_POST['radlisten'] == 'Fair'){ ?> checked <?php }  ?>> Fair </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="radio">
                          <label><input name="radlisten" value="Poor" type="radio" <?php if($_POST['radlisten'] == 'Poor'){ ?> checked <?php }  ?>> Poor </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="radio">
                          <label><input name="radlisten" value="Very Poor" type="radio" <?php if($_POST['radlisten'] == 'Very Poor'){ ?> checked <?php }  ?>> Very Poor </label>
                        </div>
                    </div>
                    
            	</div>
            </div>
       </div><!--/-->
       <div class="row dottedline">
        	<div class="col-sm-4">
    	<label>Treat you courteously?</label>
        	</div>
            <div class="col-sm-8">
            	<div class="column5">
                    <div class="col">
                        <div class="radio">
                          <label><input name="radtreat" value="Excellent" checked="" type="radio" <?php if($_POST['radtreat'] == 'Excellent'){ ?> checked <?php } else { ?> CHECKED <?php } ?>> Excellent </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="radio">
                          <label><input name="radtreat" value="Good" type="radio" <?php if($_POST['radtreat'] == 'Good'){ ?> checked <?php }  ?>> Good </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="radio">
                          <label><input name="radtreat" value="Fair" type="radio" <?php if($_POST['radtreat'] == 'Fair'){ ?> checked <?php }  ?>> Fair </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="radio">
                          <label><input name="radtreat" value="Poor" type="radio" <?php if($_POST['radtreat'] == 'Poor'){ ?> checked <?php }  ?>> Poor </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="radio">
                          <label><input name="radtreat" value="Very Poor" type="radio" <?php if($_POST['radtreat'] == 'Very Poor'){ ?> checked <?php }  ?>> Very Poor </label>
                        </div>
                    </div>
                    
            	</div>
            </div>
       </div><!--/-->
       <div class="row dottedline">
        	<div class="col-sm-4">
    	<label>Appreciate the need for confidentiality?</label>
        	</div>
            <div class="col-sm-8">
            	<div class="column5">
                    <div class="col">
                        <div class="radio">
                          <label><input name="radconfident" value="Excellent"  type="radio" <?php if($_POST['radconfident'] == 'Excellent'){ ?> checked <?php } else { ?> CHECKED <?php } ?>> Excellent </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="radio">
                          <label><input name="radconfident" value="Good" type="radio" <?php if($_POST['radconfident'] == 'Good'){ ?> checked <?php } ?>> Good </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="radio">
                          <label><input name="radconfident" value="Fair" type="radio" <?php if($_POST['radconfident'] == 'Fair'){ ?> checked <?php } ?>> Fair </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="radio">
                          <label><input name="radconfident" value="Poor" type="radio" <?php if($_POST['radconfident'] == 'Poor'){ ?> checked <?php } ?>> Poor </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="radio">
                          <label><input name="radconfident" value="Very Poor" type="radio" <?php if($_POST['radconfident'] == 'Very Poor'){ ?> checked <?php } ?>> Very Poor </label>
                        </div>
                    </div>
                    
            	</div>
            </div>
       </div><!--/-->
       <div class="row dottedline">
        	<div class="col-sm-4">
    	<label>Display knowledge of the product?</label>
        	</div>
            <div class="col-sm-8">
            	<div class="column5">
                    <div class="col">
                        <div class="radio">
                          <label><input name="radknow" value="Excellent" type="radio" <?php if($_POST['radknow'] == 'Excellent'){ ?> checked <?php } else { ?> CHECKED <?php } ?>> Excellent </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="radio">
                          <label><input name="radknow" value="Good" type="radio" <?php if($_POST['radknow'] == 'Good'){ ?> checked <?php } ?>> Good </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="radio">
                          <label><input name="radknow" value="Fair" type="radio" <?php if($_POST['radknow'] == 'Fair'){ ?> checked <?php } ?>> Fair </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="radio">
                          <label><input name="radknow" value="Poor" type="radio" <?php if($_POST['radknow'] == 'Poor'){ ?> checked <?php } ?>> Poor </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="radio">
                          <label><input name="radknow" value="Very Poor" type="radio" <?php if($_POST['radknow'] == 'Very Poor'){ ?> checked <?php } ?>> Very Poor </label>
                        </div>
                    </div>
                    
            	</div>
            </div>
       </div><!--/-->
       
       <h3>POLICE ACTIONS TO DEAL WITH THE INCIDENT</h3>
       <div class="form-group">
    	<label>4. Please think about the actions taken by the police officers and staff who dealt with your incident once they had been given the initial details. Did they: (Please use a tick mark to indicate your rating)</label>
        
        <div class="row dottedline">
        	<div class="col-sm-4">
    	<label>Try to discourage you from reporting the incident</label>
        	</div>
            <div class="col-sm-8">
            	<div class="column4">
                    <div class="col">
                        <div class="radio">
                          <label><input name="radreport" value="Yes"  type="radio" <?php if(preg_chk($_POST['radreport']) == 'Yes'){ ?> checked <?php } else { ?> checked <?php } ?>> Yes </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="radio">
                          <label><input name="radreport" value="No" type="radio" <?php if(preg_chk($_POST['radreport']) == 'No'){ ?> checked <?php } ?>> No </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="radio">
                          <label><input name="radreport" value="N/A" type="radio" <?php if(preg_chk($_POST['radreport']) == 'N/A'){ ?> checked <?php } ?>> N/A </label>
                        </div>
                    </div>
            	</div>
            </div>
       </div><!--/-->
       <div class="row dottedline">
        	<div class="col-sm-4">
    	<label>Explain what was going to happen?</label>
        	</div>
            <div class="col-sm-8">
            	<div class="column4">
				<div class="col">
                        <div class="radio">
                          <label><input name="radexplhap" value="Yes"  type="radio" <?php if(preg_chk($_POST['radexplhap']) == 'Yes'){ ?> checked <?php } else { ?> checked <?php } ?>> Yes </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="radio">
                          <label><input name="radexplhap" value="No" type="radio" <?php if(preg_chk($_POST['radexplhap']) == 'No'){ ?> checked <?php } ?>> No </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="radio">
                          <label><input name="radexplhap" value="N/A" type="radio" <?php if(preg_chk($_POST['radexplhap']) == 'N/A'){ ?> checked <?php } ?>> N/A </label>
                        </div>
                    </div>
                  </div>
            </div>
       </div><!--/-->
       <div class="row dottedline">
        	<div class="col-sm-4">
    	<label>Offer to give you feedback within a reasonable time?</label>
        	</div>
            <div class="col-sm-8">
            	<div class="column4">
				
                    <div class="col">
                        <div class="radio">
                          <label><input name="radfdreatime" value="Yes"  type="radio" <?php if(preg_chk($_POST['radfdreatime']) == 'Yes'){ ?> checked <?php } else { ?> checked <?php } ?>> Yes </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="radio">
                          <label><input name="radfdreatime" value="No" type="radio" <?php if(preg_chk($_POST['radfdreatime']) == 'No'){ ?> checked <?php } ?>> No </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="radio">
                          <label><input name="radfdreatime" value="N/A" type="radio" <?php if(preg_chk($_POST['radfdreatime']) == 'N/A'){ ?> checked <?php } ?>> N/A </label>
                        </div>
                    </div>
            	</div>
            </div>
       </div><!--/-->
        <div class="row dottedline">
        	<div class="col-sm-4">
    	<label>Provide you with contact details for someone dealing with your case?</label>
        	</div>
            <div class="col-sm-8">
            	<div class="column4">
                    <div class="col">
                        <div class="radio">
                          <label><input name="radcase" value="Yes"  type="radio" <?php if(preg_chk($_POST['radcase']) == 'Yes'){ ?> checked <?php } else { ?> checked <?php } ?>> Yes </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="radio">
                          <label><input name="radcase" value="No" type="radio" <?php if(preg_chk($_POST['radcase']) == 'No'){ ?> checked <?php } ?>> No </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="radio">
                          <label><input name="radcase" value="N/A" type="radio" <?php if(preg_chk($_POST['radcase']) == 'N/A'){ ?> checked <?php } ?>> N/A </label>
                        </div>
                    </div>
            	</div>
            </div>
       </div><!--/-->
       
    </div>
    
    <div class="form-group">
    	<label>5. Overall, how satisfied were you with the service: (Please use a tick mark to indicate your rating)</label>
        <div class="column4">
		<div class="col">
                        <div class="radio">
                          <label><input name="radservice" value="Very satisfied" type="radio" <?php if(preg_chk($_POST['radservice']) == 'Very satisfied'){ ?> checked <?php } else { ?> checked <?php } ?>> Very satisfied </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="radio">
                          <label><input name="radservice" value="Satisfied" type="radio" <?php if(preg_chk($_POST['radservice']) == 'satisfied'){ ?> checked <?php } ?>> Satisfied </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="radio">
                          <label><input name="radservice" value="Dissatisfied" type="radio" <?php if(preg_chk($_POST['radservice']) == 'Dissatisfied'){ ?> checked <?php } ?>> Dissatisfied </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="radio">
                          <label><input name="radservice" value="Very dissatisfied" type="radio" <?php if(preg_chk($_POST['radservice']) == 'Very dissatisfied'){ ?> checked <?php } ?>> Very dissatisfied </label>
                        </div>
                    </div>
            
        </div>
    </div>
    
    <div class="row">
    <div class="col-md-8">
        <div class="form-group">
            <label>6. How can we improve police services in the future?</label>
            <textarea class="form-control" rows="5" id="comment" name="imppolservice" id="imppolservice" required><?php echo preg_chk($_POST['imppolservice']); ?></textarea>
        </div>
	</div>
    </div>
        
    <div class="gap"></div>
    
    <h3>QUESTIONS ABOUT YOU</h3>
    <p><strong>The following details enable us to monitor any differences in satisfaction between groups of people.</strong></p>
	
    <div class="form-group row">
        	<label class="control-label col-sm-4">1. Are you ?</label>
            <div class="col-sm-8">
            	<label class="radio-inline"><input name="radgender" type="radio" value="Male"  <?php if(preg_chk($_POST['radgender']) == 'Male'){ ?> checked <?php } ?>>Male</label>
                <label class="radio-inline"><input name="radgender" type="radio" value="Female" <?php if(preg_chk($_POST['radgender']) == 'Female'){ ?> checked <?php } ?>>Female</label>
            </div>
    </div>
    
    <div class="form-group row">
        	<label class="control-label col-sm-4">2. What is your age group?</label>
            <div class="col-sm-12">
             <label class="radio-inline"><input name="radagegrp" checked="" type="radio"  <?php if(preg_chk($_POST['radagegrp']) == 'Under 16'){ ?> checked <?php } else { ?> checked <?php } ?>> Under 16 </label>
             <label class="radio-inline"><input name="radagegrp" value="16-24" type="radio"  <?php if(preg_chk($_POST['radagegrp']) == '16-24'){ ?> checked <?php } ?>> 16-24 </label>
             <label class="radio-inline"><input name="radagegrp" value="25-34" type="radio"  <?php if(preg_chk($_POST['radagegrp']) == '25-34'){ ?> checked <?php } ?>> 25-34 </label>
             <label class="radio-inline"><input name="radagegrp" value="35-44" type="radio"  <?php if(preg_chk($_POST['radagegrp']) == '35-44'){ ?> checked <?php } ?>> 35-44</label>
             <label class="radio-inline"><input name="radagegrp" value="45-54" type="radio"  <?php if(preg_chk($_POST['radagegrp']) == '45-54'){ ?> checked <?php } ?>> 45-54</label>
             <label class="radio-inline"><input name="radagegrp" value="55-64" type="radio"  <?php if(preg_chk($_POST['radagegrp']) == '55-64'){ ?> checked <?php } ?>> 55-64</label>
             <label class="radio-inline"><input name="radagegrp" value="65-74" type="radio"  <?php if(preg_chk($_POST['radagegrp']) == '65-74'){ ?> checked <?php } ?>> 65-74</label>
             <label class="radio-inline"><input name="radagegrp" value="75 and over" type="radio"  <?php if(preg_chk($_POST['radagegrp']) == '75 and above'){ ?> checked <?php } ?>> 75 and above</label>
            </div>
     </div>
    
    	<div class="form-group row">
      		<label class="control-label col-sm-4" >3. What is your nationality? </label>
            <div class="col-md-4 col-sm-8">
        		<input class="form-control" placeholder="Your Nationality" name="nationality" id="nationality" type="text" required value="<?php echo preg_chk($_POST['nationality']); ?>">
        	</div>
        </div>
        <div class="form-group row">
      		<label class="control-label col-sm-4" >4. What is your Name?</label>
            <div class="col-md-4 col-sm-8">
        		<input class="form-control" placeholder="Your Name" name="txtname" id="txtname" type="text" required value="<?php echo preg_chk($_POST['txtname']); ?>">
        	</div>
        </div>
    	<div class="form-group row">
      		<label class="control-label col-sm-4" >5. What is your Email Id?</label>
            <div class="col-md-4 col-sm-8">
        		<input class="form-control" placeholder="Your E-mail ID" name="txtemail" id="txtemail" type="email" required value="<?php echo preg_chk($_POST['txtemail']); ?>">
        	</div>
        </div>
        <div class="form-group row">
      		<label class="control-label col-sm-4" >6. What is your contact phone number?</label>
            <div class="col-md-4 col-sm-8">
        		<input class="form-control" placeholder="Your Contact No." name="tel" id="tel" type="text" required value="<?php echo preg_chk($_POST['tel']); ?>">
        	</div>
        </div>

    </div>
    
    <!-- <label>Solved it :</label>
    <div class="form-group clearfix">
        <label class="captcha"><img src="images/captcha.jpg" alt="Captcha"></label>
        <input class="form-control result" id="captcha" placeholder="Result" required="" type="text">
    </div> -->
	<script src='https://www.google.com/recaptcha/api.js'></script>
               			<div class="g-recaptcha" data-sitekey="<?php echo $recaptcha_site?>"></div>
               			<br/>
    
    <div class="form-group">
		<input type="hidden" name="userval" id="userval" value="<?php echo $userval;?>">
       <input class="btn btn-default" value="Submit" type="submit">
    </div>
    
    
    </form>

    <h4 class="text-center">THANK YOU FOR YOUR TIME.</h4>
    
    
            
            
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