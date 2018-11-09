<?php 
include("../../common/cploconfig.php");

$docname = $_REQUEST['docname'];  
$mode = $_REQUEST[mode];
$pid = $_REQUEST[pid];

if($mode=="del")
	{
				   
		$query="Delete from ".$tblpref."category  where cat_id ='$pid'";
		if(!($result=mysqli_query($connection,$query))){echo $query.mysqli_errno($connection); exit;}
		
		$quedel="DELETE FROM ".$tblpref."content_master WHERE cms_subtype='$pid' AND cms_type='property'";
		if(!($res=mysqli_query($connection,$quedel))){echo $quedel.mysqli_errno($connection); exit;}

		header("Location:pub-type.php?flag=del");
		exit;


	}

if($pid=="")
	{
          $qchk="SELECT * FROM ".$tblpref."category WHERE cat_title='".$docname."' AND cat_type='property'";
			if(!($resqchk=mysqli_query($connection,$qchk))){ echo "FOR QUERY: $query<BR>".mysqli_errno($connection); exit;}
			$rowcount=mysqli_num_rows($resqchk);
		   if($rowcount>0)
	   {
	       header("location:pub-type-add.php?flag=exists");
	       exit;
	   }else{
           
		$query_add="INSERT INTO ".$tblpref."category SET
		cat_title='$docname',
		cat_type = 'property'
		";
				
		if(!($result_add=mysqli_query($connection,$query_add))){echo $query_add.mysqli_errno($connection); exit;}

		header("Location:pub-type.php?flag=add");
		exit;}

	}

	if($pid!="")
		{      
			$qselect="SELECT * FROM ".$tblpref."category WHERE cat_id='$pid'";
		 if(!($resqsel=mysqli_query($connection, $qselect))){echo  $qselect.mysqli_errno($connection); exit;}
		 $row=mysqli_fetch_array($resqsel);		  
		 $qchk="SELECT * FROM ".$tblpref."category WHERE cat_title!='$row[cat_title]'AND cat_title='$docname' ";
			if(!($resqchk=mysqli_query($connection,$qchk))){ echo "FOR QUERY: $query<BR>".mysqli_errno($connection); exit;}
			$rowcount=mysqli_num_rows($resqchk);
		   if($rowcount>0)
	   {
	       header("location:pub-type-add.php?flag=exists&pid=$pid");
	       exit;
	   }else{
			$qadd="UPDATE ".$tblpref."category set
			cat_title='$docname',
			cat_type = 'property'
			where cat_id= '$pid'";
			
			if(!($res=mysqli_query($connection,$qadd))){echo $qadd.mysqli_errno($connection); exit;}

			header("Location:pub-type.php?flag=edit");
			exit;}

	}
?>