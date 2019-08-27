<?php
require ("_common/conn.php");
require ("_common/global.php");
require ("_common/session.php");
///require ("_common/timeout.php");
include "convertdate.php";
include "current_date.php";
include "calculateDay.php";



$hapus_trasmi= mysql_real_escape_string($_POST['hapus_trasmi']);
$hapus_rasmi= mysql_real_escape_string($_POST['hapus_rasmi']);
$surat= mysql_real_escape_string($_POST['surat']);

$ref= mysql_real_escape_string($_POST['ref']);
$ref2= mysql_real_escape_string($_POST['ref2']);


if($hapus_trasmi)
{

$hapus_trasmi1= mysql_query("delete from intraystatussemasa  where idinfo = '$ref'") or die (mysql_error());



$hapus_trasmi2= mysql_query("delete from intrayinfo  where idinfo = '$ref' and jenispermohonan='F0000001'") or die (mysql_error());



$hapus_trasmi3= mysql_query("delete from intrayhistory  where idinfo = '$ref'") or die (mysql_error());



}
if($hapus_rasmi)
{

$hapus_rasmi1= mysql_query("delete from intraystatussemasa  where idinfo = '$ref2'") or die (mysql_error());




$hapus_rasmi2= mysql_query("delete from intrayinfo  where idinfo = '$ref2' and jenispermohonan='F0000002'") or die (mysql_error());



$hapus_rasmi3= mysql_query("delete from intrayhistory  where idinfo = '$ref2'") or die (mysql_error());



unlink("/var/www/html/eapproval/upload/".$userid."/".$surat);

}


?>
   		<script language="JavaScript">
		alert("Data anda telah kemaskini");
		window.location.href="inbox.php";
  		</script>
 <? 

