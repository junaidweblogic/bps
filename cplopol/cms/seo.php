<?php
include("common/cploconfig.php");
 $query1="UPDATE c_content_master SET cms_page_title='Botswana Crime watch |Botswana Neighbourhood watch | Neibourhood watch',
 meta_tags='Botsawna Police service BPS keeps an watch on crime ,suspacious Neighbourhood activity ,crime watch ,valuable properties and ensures safe and secure community.',meta_key_word='Botswana Crime watch, Botswana Neighbourhood watch, Neibourhood watch,Botswana crime watch services, crime botswana,botswana police,BPS' WHERE cms_id='426'";
if(!($res=mysqli_query($connection,$query1))){echo $query1.mysqli_error(); exit;}

 $query2="UPDATE c_content_master SET cms_page_title='Botswana Safer Bussiness|Safer Botswana Community|Botswana Police community',
 meta_tags='Botswana police community ensures the safer bussiness in Botswana by taking efforts in protecting various crimes that affect businesses',meta_key_word='Botswana Safer Bussiness,Safer Botswana Community,Botswana Police community, Botswana bussiness safety, safer bussiness community, Botswana safer community' WHERE cms_id='386'";
if(!($res=mysqli_query($connection,$query2))){echo $query2.mysqli_error(); exit;}

 $query3="UPDATE c_content_master SET cms_page_title='Botswana Crime Prevention| Crime Prevention Botswana| Crime Prevention services',
 meta_tags='Botswana Police service participated in Crime prevention botswana services which prevents life and property and make life in botswana more secure.',meta_key_word='Botswana Crime Prevention,Crime Prevention Botswana,Crime Prevention services,Botswana Police,Crime Prevention,police Botswana' WHERE cms_id='130'";
if(!($res=mysqli_query($connection,$query3))){echo $query3.mysqli_error(); exit;}
?>