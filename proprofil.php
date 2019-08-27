<?php
require ("_common/global.php");
require ("_common/conn.php");
require ("_common/session.php");
require ("_common/timeout.php");


//insert data
//$simpan_btn = (isset($_POST['simpan_btn'])) ? trim($_POST['simpan_btn']) : '';
$userid = (isset($_POST['userid'])) ? trim($_POST['userid']) : '';
$namapeg = (isset($_POST['nama_pgw'])) ? trim($_POST['nama_pgw']) : '';
$namapeg = addslashes($nama_pgw);
$nokp= (isset($_POST['nokp'])) ? trim($_POST['nokp']) : '';
$namabank= (isset($_POST['namabank'])) ? trim($_POST['namabank']) : '';
$noakaun= (isset($_POST['noakaun'])) ? trim($_POST['noakaun'])) : '';
/*$gaji = (isset($_POST['gaji'])) ? mysql_real_escape_string(trim($_POST['gaji'])) : '';
$elaun = (isset($_POST['elaun'])) ? mysql_real_escape_string(trim($_POST['elaun'])) : '';
$jumgaji = (isset($_POST['jumgaji'])) ? mysql_real_escape_string(trim($_POST['jumgaji'])) : '';
$jnskenderaan = (isset($_POST['jnskenderaan'])) ? mysql_real_escape_string(trim($_POST['jnskenderaan'])) : '';
$nokenderaan = (isset($_POST['nokenderaan'])) ? mysql_real_escape_string(trim($_POST['nokenderaan'])) : '';
$cckenderaan = (isset($_POST['cckenderaan'])) ? mysql_real_escape_string(trim($_POST['cckenderaan'])) : '';
$kelastuntutan = (isset($_POST['kelastuntutan'])) ? mysql_real_escape_string(trim($_POST['kelastuntutan'])) : '';
$kodjbtn = (isset($_POST['kodjbtn'])) ? mysql_real_escape_string(trim($_POST['kodjbtn'])) : '';
$almtpej1 = $data['almt_pej1'];
$almtpej2 = $data['almt_pej2'];
$almtpej3 = $data['almt_pej3'];
$poskodpej = $data['poskod_pej'];
$kodbandarpej = $data['kodbandar_pej'];
$kodnegpej = $data['kodneg_pej'];
$almt1 = $data['almt_rumah1'];
$almt2 = $data['almt_rumah2'];
$almt3 = $data['almt_rumah3'];
$poskod = $data['poskod_rumah'];
$kodbandar = $data['kodbandar_rumah'];
$kodneg = $data['kodneg_rumah'];*/


// update profile
if(isset($_POST['simpan_btn']))
{
$queryUpdate = "Update profil set namapegawai='$namapeg',nokp='$nokp', namabank='$namabank', noakaun='$noakaun' where userid='$userid'";
$resultUpdate = mysql_query($queryUpdate);

if (!$resultUpdate)
{
echo "Error in SQL Update";
exit();
} 

?>

<script type="text/javascript">
<!--
alert("Maklumat telah disimpan ");
window.location='profil.php';
//-->
</script>

<?php 
	 }
	else
  {
 // echo "Invalid file";
  ?>
<?php 
  } 
?>

