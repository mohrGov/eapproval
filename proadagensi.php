<?php
require ("_common/conn.php");
require ("_common/session.php");
require ("_common/global.php");

if(isset($_POST['Submit_btn']))
{
	$userid = (isset($_POST['userid'])) ? mysql_real_escape_string(trim($_POST['userid'])) : '';
	$passwrd = (isset($_POST['passwrd'])) ? mysql_real_escape_string(trim($_POST['passwrd'])) : '';
	$nama = (isset($_POST['nama'])) ? mysql_real_escape_string(trim($_POST['nama'])) : '';
	$nokp = (isset($_POST['nokp'])) ? mysql_real_escape_string(trim($_POST['nokp'])) : '';
	$jwtn = (isset($_POST['jwtn'])) ? mysql_real_escape_string(trim($_POST['jwtn'])): '';
	$jbtn = (isset($_POST['jbtn'])) ?mysql_real_escape_string( trim($_POST['jbtn'])): '';

$query10 = "Select domain from intrayrefjabatan where kod_jbtn = '$jbtn'";
$result10 = mysql_query($query10);
	
	while ($data10 = mysql_fetch_array($result10))
	{
		$domain = $data10['domain'];
	}

if(!$userid || !$passwrd || !$nama || !$nokp)
{
	echo'<script>
	alert("Sila lengkapkan semua maklumat yang diperlukan");
	window.location="addagensi.php";
	</script>';
	exit;
}

$userguna = $userid."@".$domain;
//insert dalam profile
$query = "insert into intrayprofile (userid, nokp, nama_pgw, jawatan, jabatan) values ('$userguna', '$nokp', '$nama','$jwtn', '$jbtn')";
	$result = mysql_query($query);
	if(!$result) 
	{
		echo "Error 1:";
		exit();
	}
//insert dalam intrayuser
	$query2 = "insert into intrayusers(userid,rank,role) values ('$userguna','AG','09')";
	$result2 = mysql_query($query2);
	if(!$result2) 
	{
		echo "Error 2:";
		exit();
	}

echo'<script>
alert("Maklumat telah didaftarkan");
window.location="addagensi.php";
</script>';
}
?>