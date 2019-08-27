<?php
require ("_common/conn.php");
require ("_common/global.php");
require ("_common/session.php");
include "convertdate.php";
include "current_date.php";

$nama_pgw = (isset($_POST['nama_pgw'])) ? trim($_POST['nama_pgw']) : '';
$nama_pgw = addslashes($nama_pgw);
$nokp = (isset($_POST['nokp'])) ? trim($_POST['nokp']) : '';
$tel = (isset($_POST['tel'])) ? trim($_POST['tel']) : '';
$jwtn = (isset($_POST['jwtn'])) ? trim($_POST['jwtn']) : '';
$gred = (isset($_POST['gred'])) ? trim($_POST['gred']) : '';
$jabatan = (isset($_POST['jbtn'])) ? trim($_POST['jbtn']) : '';
$email = (isset($_POST['email'])) ? trim($_POST['email']) : '';
$add_submit = (isset($_POST['Submit'])) ? trim($_POST['Submit']) : '';
$add_pilih = (isset($_POST['Hantar'])) ? trim($_POST['Hantar']) : '';
$date_lantikan = (isset($_POST['tkh_lantikan'])) ? trim($_POST['tkh_lantikan']) : '';
$date_lantik=convertdate_back($date_lantikan);
//$tkh_lantik_psgn=convertdate_back($tkh_lantik_psgn);
$nama_psgn = (isset($_POST['nama_psgn'])) ? trim($_POST['nama_psgn']) : '';
$jwtn_psgn = (isset($_POST['jwtn_psgn'])) ? trim($_POST['jwtn_psgn']) : '';
$jbtn_psgn = (isset($_POST['jbtn_psgn'])) ? trim($_POST['jbtn_psgn']) : '';
$tanggungan = (isset($_POST['bil_anak'])) ? trim($_POST['bil_anak']) : '';
$s_kahwin = (isset($_POST['s_kahwin'])) ? trim($_POST['s_kahwin']) : '';
$rm = (isset($_POST['rm'])) ? trim($_POST['rm']) : '';
$sen = (isset($_POST['sen'])) ? trim($_POST['sen']) : '';
$gaji_skrg = $rm.'.'.$sen;

if ($add_submit)
{
/////////////////semak data dah ada ke tidak///////////////////////

// cari dulu ader ke tidak
				
		$query = "select * from intrayprofile where userid = '$userid'";
		//echo $query;
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
$queryupdate = "update intrayprofile set nama_pgw = '$nama_pgw', nokp='$nokp', jawatan='$jwtn',jabatan='$jabatan', gaji_skrg='$gaji_skrg',tkh_lantikan='$date_lantik', 
			status_perkahwinan='$s_kahwin',nama_psgn='$nama_psgn',jwtn_psgn='$jwtn_psgn',jbtn_psgn='$jbtn_psgn',tarikh_lantikan='$tkh_lantik_psgn',tanggungan='$tanggungan',email='$email', notel = '$tel', gred_jwtn='$gred' where userid='$userid'";
$resultupdate = mysql_query($queryupdate);

	if(!$resultupdate) 
	{
	echo "Error update:";
	exit();
	}
} 
else 
{
$query = ("INSERT INTO intrayprofile (userid,nama_pgw,nokp,jawatan,jabatan,gaji_skrg,email,tel,tkh_lantikan,status_perkahwinan,nama_psgn,jwtn_psgn,jbtn_psgn,tarikh_lantikan,tanggungan,gred_jwtn) values
('$userid','$nama_pgw','$nokp','$jwtn','$jabatan','$gaji_skrg','$email','$date_lantik','$s_kahwin','$nama_psgn','$jwtn_psgn','$jbtn_psgn','$tkh_lantik_psgn','$tanggungan','$gred')" );
$result = mysql_query($query);
		if(!$result) 
		{
		echo "Error insert profile:";
		exit();
		}
} 
############################################################################################################################################################
?>
<script>
alert("Maklumat telah dikemaskini");
window.location.href="oversea_personal.php";
</script>
<?php
}
else
{

?>

<script>
window.location.href="oversea.php";
</script>
<?php
}
?>
