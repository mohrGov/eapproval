<?php
require ("_common/conn.php");
require ("_common/session.php");
require ("_common/global.php");

$Submit_btn = (isset($_POST['Submit_btn'])) ? mysql_real_escape_string(trim($_POST['Submit_btn'])) : '';
$myname = (isset($_POST['myname'])) ? mysql_real_escape_string(trim($_POST['myname'])) : '';
$rolebaru = (isset($_POST['rolebaru'])) ? mysql_real_escape_string(trim($_POST['rolebaru'])) : '';

if ($Submit_btn)
{
	//update flag dulu
	$query6 = "Update intrayusers set role = '$rolebaru' where userid='$myname'";
	$result6 = mysql_query($query6);
		if (!$result6)
		{exit("Error in SQL 6");}
}	
?>
<script>
alert("Maklumat telah dikemaskini.");
window.location="usermgmt.php";
</script>
