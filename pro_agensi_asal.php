<?php
require ("_common/conn.php");
require ("_common/global.php");

if(isset($_POST['Submit']))
{
$userid = (isset($_POST['userid'])) ? mysql_real_escape_string(trim($_POST['userid'])) : '';
$password = (isset($_POST['nama'])) ? mysql_real_escape_string(trim($_POST['password'])) : '';
$nama = (isset($_POST['nama'])) ? mysql_real_escape_string(trim($_POST['nama'])) : '';
$nokp = (isset($_POST['nokp'])) ? mysql_real_escape_string(trim($_POST['nokp'])) : '';
$jwtn = (isset($_POST['jwtn'])) ? mysql_real_escape_string(trim($_POST['jwtn'])) : '';
$jbtn = (isset($_POST['jbtn'])) ? mysql_real_escape_string(trim($_POST['jbtn'])) : '';
$date = date("Y-m-d");

$query10 = "Select domain from intrayrefjabatan where kod_jbtn = '$jbtn'";
$result10 = mysql_query($query10);
	
	while ($data10 = mysql_fetch_array($result10))
	{
		$domain = $data10['domain'];
	}

if(!$userid || !$password || !$nama || !$nokp)
{
	echo'<script>
	alert("Sila lengkapkan semua maklumat yang diperlukan");
	window.location="pengguna_luar.php";
	</script>';
	exit;
}

$userguna = $userid."@".$domain;
$insert = "insert into intraytempuserluar (userid,passwd,nama,nokp,jabatan,jawatan,tarikhmohon) values ('$userguna','$password','$nama','$nokp','$jbtn','$jwtn','$date')";
$insert = mysql_query($insert);

echo'<script>
alert("Maklumat telah didaftarkan. Sila tunggu pengesahan dari admin untuk membuat permohonan.");
window.location="index.php";
</script>';
}
?>