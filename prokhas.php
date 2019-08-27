<?php
require ("_common/conn.php");
require ("_common/session.php");
require ("_common/global.php");
include "convertdate.php";
include "current_date.php";

$useridkhas = (isset($_POST['useridkhas'])) ? mysql_real_escape_string(trim($_POST['useridkhas'])) : '';
$catatankhas = (isset($_POST['catatankhas'])) ? mysql_real_escape_string(trim($_POST['catatankhas'])) : '';
$khas = (isset($_POST['khas'])) ? mysql_real_escape_string(trim($_POST['khas'])) : '';
$offcode = (isset($_POST['offcode'])) ? mysql_real_escape_string(trim($_POST['offcode'])) : '';
$Submit_btn= (isset($_POST['Submit_btn'])) ? mysql_real_escape_string(trim($_POST['Submit_btn'])) : '';

function tukarsequel ($a)
	{
	if ($a < 10 && $a > 0)
	{$ans = '000000'.$a;}
	else if ($a >=10 && $a<100 )
	{$ans = '00000'.$a;}
	else if ($a >=100 && $a<1000 )
	{$ans = '0000'.$a;}
	else if ($a >=1000 && $a<10000 )
	{$ans = '000'.$a;}
	else if ($a >=10000 && $a<100000 )
	{$ans = '00'.$a;}
	else if ($a >=100000 && $a<1000000 )
	{$ans = '0'.$a;}
	return $ans;
}


if ($Submit_btn)
{
	//running number
	$query1 = mysql_query("select MAX(substr(idinfo, 2, 7)) as NOKHAS from intrayinfo where substr(idinfo, 1, 1) = 'H'");
	$bil = mysql_fetch_array($query1);
	$nobaru = $bil['NOKHAS'];
	$ansj = tukarsequel($nobaru + 1);
	$nokhasbaru = 'H'.$ansj;

$query = "insert into intrayinfo (idinfo,userid, catatan_khas, flag_khas, offcode) values ('$nokhasbaru','$useridkhas','$catatankhas', '$khas','$offcode')";
$result = mysql_query($query);
if(!$result) 
	{
		echo "Error 1:";
		exit();
	}

?>
<script>
alert("Maklumat khas telah dimasukkan");
window.location="khas.php";
</script>
<?php
}
?>

