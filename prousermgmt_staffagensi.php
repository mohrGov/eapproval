<?php
require ("_common/conn.php");
require ("_common/session.php");
require ("_common/global.php");

$Submit_btn = (isset($_POST['Submit_btn'])) ? mysql_real_escape_string(trim($_POST['Submit_btn'])) : '';
$myname = (isset($_POST['myname'])) ? mysql_real_escape_string(trim($_POST['myname'])) : '';
$flagbaru = (isset($_POST['flagbaru'])) ? mysql_real_escape_string(trim($_POST['flagbaru'])) : '';
//$jbtn = (isset($_POST['jabatan'])) ? mysql_real_escape_string(trim($_POST['jabatan'])) : '';

if ($Submit_btn)
{
	//update flag dulu
	$query6 = "Update intraytempuserluar set flagsah = '$flagbaru' where userid='$myname'";
	$result6 = mysql_query($query6);
		if (!$result6)
		{exit("Error in SQL 6");}
		echo $query6;
}	
?>
<script>
alert("Maklumat telah dikemaskini.");
window.location="usermgmt_staffagensi.php";
</script>
