<?php
require ("_common/conn.php");
require ("_common/global.php");
require ("_common/session.php");
include "convertdate.php";
include "current_date.php";

$ref = (isset($_POST['ref'])) ? mysql_real_escape_string(trim($_POST['ref'])) : '';
$nama_seminar = (isset($_POST['nama'])) ? mysql_real_escape_string(trim($_POST['nama'])) : '';
$submit_btn = (isset($_POST['submit_btn'])) ? mysql_real_escape_string(trim($_POST['submit_btn'])) : '';
$tujuan = (isset($_POST['tujuan'])) ? mysql_real_escape_string(trim($_POST['tujuan'])) : '';
$tempat = (isset($_POST['tempat'])) ? mysql_real_escape_string(trim($_POST['tempat'])) : '';
$dari = (isset($_POST['dari'])) ? mysql_real_escape_string(trim($_POST['dari'])) : '';
$hingga = (isset($_POST['hingga'])) ? mysql_real_escape_string(trim($_POST['hingga'])) : '';
$bil= (isset($_POST['bil'])) ? mysql_real_escape_string(trim($_POST['bil'])) : '';
$nama_ketua = (isset($_POST['nama_ketua'])) ? mysql_real_escape_string(trim($_POST['nama_ketua'])) : '';
$duta = (isset($_POST['duta'])) ? mysql_real_escape_string(trim($_POST['duta'])) : '';
$kekerapan = (isset($_POST['kekerapan'])) ? mysql_real_escape_string(trim($_POST['kekerapan'])) : '';
$belanja = (isset($_POST['belanja'])) ? mysql_real_escape_string(trim($_POST['belanja'])) : '';
$faedah = (isset($_POST['faedah'])) ? mysql_real_escape_string(trim($_POST['faedah'])) : '';
$kelulusan = (isset($_POST['kelulusan'])) ? mysql_real_escape_string(trim($_POST['kelulusan'])) : '';
$surat = (isset($_POST['surat'])) ? mysql_real_escape_string(trim($_POST['surat'])) : '';
$nama_pgw = (isset($_POST['nama_pgw'])) ? mysql_real_escape_string(trim($_POST['nama_pgw'])) : '';
$nama_pgw = addslashes($nama_pgw);
$nokp = (isset($_POST['nokp'])) ? mysql_real_escape_string(trim($_POST['nokp'])) : '';
$jwtn = (isset($_POST['jwtn'])) ? mysql_real_escape_string(trim($_POST['jwtn'])) : '';
$jabatan = (isset($_POST['jbtn'])) ? mysql_real_escape_string(trim($_POST['jbtn'])) : '';
$email = (isset($_POST['email'])) ? mysql_real_escape_string(trim($_POST['email'])) : '';
$add_submit = (isset($_POST['Submit'])) ? mysql_real_escape_string(trim($_POST['Submit'])) : '';
$add_pilih = (isset($_POST['Hantar'])) ? mysql_real_escape_string(trim($_POST['Hantar'])) : '';
$date_lantikan = (isset($_POST['tkh_lantikan'])) ? mysql_real_escape_string(trim($_POST['tkh_lantikan'])): '';
$date_lantik=convertdate_back($date_lantikan);
$nama_psgn = (isset($_POST['nama_psgn'])) ? mysql_real_escape_string(trim($_POST['nama_psgn'])) : '';
$jwtn_psgn = (isset($_POST['jwtn_psgn'])) ? mysql_real_escape_string(trim($_POST['jwtn_psgn'])) : '';
$jbtn_psgn = (isset($_POST['jbtn_psgn'])) ? mysql_real_escape_string(trim($_POST['jbtn_psgn'])) : '';
$tanggungan = (isset($_POST['bil_anak'])) ? mysql_real_escape_string(trim($_POST['bil_anak'])) : '';
$s_kahwin = (isset($_POST['s_kahwin'])) ? mysql_real_escape_string(trim($_POST['s_kahwin'])) : '';
$rm = (isset($_POST['rm'])) ? mysql_real_escape_string(trim($_POST['rm'])) : '';
$sen = (isset($_POST['sen'])) ? mysql_real_escape_string(trim($_POST['sen'])) : '';
$gaji_skrg = $rm.'.'.$sen;

$dari=convertdate_back($dari);
$hingga=convertdate_back($hingga);



//// create folder /////////
$pathinfo = pathinfo(basename($_FILES['surat']['name']));
$pathExt= $pathinfo['extension'];
$uploaddir = "upload/".$userid."/";
$pathsurat = "surat-".$userid.".".$pathinfo['extension'];
$uploadfile = $uploaddir.$pathsurat;

if ($submit_btn)
{
		if(!empty($_FILES['surat']['name'])) {
		$queryinsert = mysql_query("update intrayinfo set surat='$pathsurat' where idinfo='$ref'");
		if (move_uploaded_file($_FILES['surat']['tmp_name'], $uploadfile)) {}
		}


$queryinsert = "update intrayinfo set nama_seminar='$nama_seminar',tujuan='$tujuan',tempat='$tempat',tarikhpergi='$dari',tarikhpulang='$hingga',bil_peserta='$bil',nama_ketua='$nama_ketua',duta='$duta',kekerapan='$kekerapan',belanja='$belanja',faedah='$faedah',lulus_kdn='$kelulusan' where idinfo='$ref'";

		$resultinsert= mysql_query($queryinsert);
			if(!$resultinsert) 
			{
				echo "Error 2:";
				exit();
			}
	
//updtae profile
$queryupdate = "update intrayprofile set nama_pgw = '$nama_pgw', nokp='$nokp', jawatan='$jwtn',jabatan='$jabatan', gaji_skrg='$gaji_skrg',tkh_lantikan='$date_lantik', 
status_perkahwinan='$s_kahwin',nama_psgn='$nama_psgn',jwtn_psgn='$jwtn_psgn',jbtn_psgn='$jbtn_psgn',tarikh_lantikan='$tkh_lantik_psgn',tanggungan='$tanggungan',email='$email' where userid='$userid'";
$resultupdate = mysql_query($queryupdate);

	if(!$resultupdate) 
	{
	echo "Error update:";
	exit();
	}
	
	//waiting for
	$nxrole = '03'; 
	$query3 = "select b.userid from intrayusers b where b.role = '$nxrole'";
	$result3 = mysql_query($query3);
	if(!$result3) 
	{
		echo "Error 6:";
		exit();
	}
	$data3 = mysql_fetch_array($result3);
	$mywaiting = $data3["userid"];
/////////////////////////////////////////////////////////////////////////////
$query = "update intraystatussemasa set waiting_for = '$mywaiting', keputusan = 'Y', updatedDate='$datum', updatedBy ='$userid' where idinfo='$ref'";
$result = mysql_query($query);
if(!$result) 
	{
		echo "Error 4:";
		exit();
	}
//update history
$query1 = "insert into intrayhistory (idinfo,kodstatus,lengkap, catatan, updateddate,updatedby) values ('$ref','30','Y', 'Telah dilengkapkan','$datum','$userid')";
$result1 = mysql_query($query1);
if(!$result1) 
	{
		echo "Error 1:";
		exit();
	}
?>
<script>
alert("Data telah dikemaskini");
window.location="inbox.php";
</script>
<?php
} // end submit
?>