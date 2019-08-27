<?php
require ("_common/conn.php");
require ("_common/global.php");
require ("_common/session.php");
include "convertdate.php";
include "current_date.php";

$submit = (isset($_POST['btnSubmit'])) ? trim($_POST['btnSubmit']) : '';
$password = (isset($_POST['password'])) ? trim($_POST['password']) : '';

if ($submit)
{
/////////////////semak data dah ada ke tidak///////////////////////

// cari dulu ader ke tidak
				
		$query = "select * from intrayprofile where userid = '$userid'";
		echo $query;
		$result = mysql_query($query);
		if(!$result) 
			{
				echo "Error:";
				exit();
			}
		$ada = mysql_num_rows($result);
		


############################################################################################################################################################
//////update/////////////
if ($ada > 0)
{
$queryupdate = "update intraytempuserluar set passwd = '$password' where userid='$userid'";
$resultupdate = mysql_query($queryupdate);

	if(!$resultupdate) 
	{
	echo "Error kemaskini katalaluan:";
	exit();
	}
} 
else 
{
	echo "Error 1:";
	exit();
} 
############################################################################################################################################################
?>
<script>
alert("Maklumat katalaluan telah dikemaskini");
window.location.href="inbox.php";
</script>
<?php
}
else
{

?>

<script>
window.location.href="inbox.php";
</script>
<?php
}
?>
