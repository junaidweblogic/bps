<?php
@session_start();
include("../../common/app_function.php");
include("../../common/cploconfig.php");
if($_SESSION[username]=="")
{
	displayerror("Login Error.","","For security of your account,we have expired your session.<br>&nbsp;Please login to your account again.", "Login,../index.php", 0);
	exit();
}

admin_header('../../','Database Backup',$tblpref,$db,$sitepath,$siteurl,$path1,$ckpath,$row_admin);
?>
<!-- <script type="text/javascript" src="../../cal_js/jquery-1.3.1.min.js"></script> -->
<script type="text/javascript" src="../../cal_js/jquery-ui-1.7.1.custom.min.js"></script>
<script type="text/javascript" src="../../cal_js/daterangepicker.jQuery.js"></script>
<link rel="stylesheet" href="../../css/ui.daterangepicker.css" type="text/css" />
<link rel="stylesheet" href="../../css/redmond/jquery-ui-1.7.1.custom.css" type="text/css" title="ui-theme" />

<div class="adminbody">
<?php
//backup_tables($hostname,$serveruser,$serverpass,$databasename);
?>
 
<?$flag=$_GET[flag];?>
<?if($flag=="back"){?>
<p align="center" class="error">Database has been successfully backed up.</p>
<? } ?>	
<?if($flag=="add"){?>
<p align="center" class="error">New Record is added successfully.</p>
<? } ?>	
<?if($flag=="del"){?>
<p align="center" class="error">Record is deleted Successfully.</p>
<? } ?>		
<?if($flag=="type2"){?>
<p align="center" class="error">Only Document File Allowed.</p>
<? } ?>
<?if($flag=="type"){?>
<p align="center" class="error">Only Image File Allowed.</p>
<? } ?>
<div class="gap"></div>
<div class="flt"><a href="../home.php"><img src="../../images/dashboard.png" alt="Home" title="Home"/></a></div>
<div class="frt"><a href="../home.php"><img src="../../images/back32.png" alt="Back" title="Back"/></a></div>
<div class="gap"></div>
<div class="box">
    <div class="hdr">
		<h1 class="ico"><img src="icon/icon.png" alt="">Database Backup</h1>
        <div class="addnew">
			<a href="add.php" class="add">Backup Database Now</a>			
		</div>
	</div>   
      
    <div class="padtb">
  <!--   <p align="right"></p> -->
	<p align="right"><?=$show_status?> </p>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
	<thead>
	  <tr>
		<th class="minth">Sr. No.</th>
		<th width="30%">Date </th>
		<th width="15%">Time</th>
		<th class="minth">Action</th>
	  </tr>
	</thead>
	<tbody>
	<?php
		$count = 1;

		$files = array();
$dir = new DirectoryIterator('.');
foreach ($dir as $fileinfo) {
   $files[$fileinfo->getMTime()] = $fileinfo->getFilename();
}

krsort($files);

			foreach ($files  as $file) 
			{
				 if ($file == "index.php" or $file == ".." or $file == "." or $file == "add.php" or $file == "submit.php" or $file == "icon" )
				{
				}
				else{
				$file_arr = explode('.',$file);
					$sql_file_arr = explode('-',$file);
						$rawdate = $sql_file_arr[2];
						$rawdate_arr = str_split($rawdate);
						$date = $rawdate_arr[4].$rawdate_arr[5].$rawdate_arr[6].$rawdate_arr[7]."-".$rawdate_arr[2].$rawdate_arr[3]."-".$rawdate_arr[0].$rawdate_arr[1];
						
						$rawtime = $sql_file_arr[3];
						$rawtime_arr = str_split($rawtime);
						$time = $rawtime_arr[0].$rawtime_arr[1].":".$rawtime_arr[2].$rawtime_arr[3].":".$rawtime_arr[4].$rawtime_arr[5];
			
					?>
					<tr>
					<td><?php echo $count; ?></td>
					<td><?php echo @date('d M l Y', @strtotime($date)); ?></td>
					<td><?php echo $time; ?></td>
					<td>
						<ul class="actions">
							

							<li><a download href="<?php echo $file; ?>"><img alt="Download" title="Download" src="../../images/download.png"></a></li>
							<li><a href="submit.php?file=<?php echo $file; ?>" onclick="if(confirm('Do You Want To Delete This ?')){return true;}else{return false;}"><img src="../../images/delete.png" alt="delete"></a></li>
						</ul>
					</td>
					</tr>
			<?php				
					$count++;
				}
			
			}
			?>
	
 </tbody>  
</table>
    <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>
</div>
<?admin_footer();?>