<?php
require ("_common/conn.php");
require ("_common/global.php");
require ("_common/session.php");
include "convertdate.php";
include "current_date.php";

$namapeg = (isset($_POST['namapeg'])) ? mysql_real_escape_string(trim($_POST['namapeg'])) : '';
$jabatan = (isset($_POST['jabatan'])) ? mysql_real_escape_string(trim($_POST['jabatan'])) : '';
$nama_seminar = (isset($_POST['nama'])) ? mysql_real_escape_string(trim($_POST['nama'])) : '';
$submit_btn = (isset($_POST['submit_btn'])) ? mysql_real_escape_string(trim($_POST['submit_btn'])) : '';
$tujuan = (isset($_POST['tujuan'])) ? mysql_real_escape_string(trim($_POST['tujuan'])) : '';
$tempat = (isset($_POST['tempat'])) ? mysql_real_escape_string(trim($_POST['tempat'])) : '';
$bil= (isset($_POST['bil'])) ? mysql_real_escape_string(trim($_POST['bil'])) : '';
//$bil=trim($bil);
$nama_ketua = (isset($_POST['nama_ketua'])) ? mysql_real_escape_string(trim($_POST['nama_ketua'])) : '';
$duta = (isset($_POST['duta'])) ? mysql_real_escape_string(trim($_POST['duta'])) : '';
$kekerapan = (isset($_POST['kekerapan'])) ? mysql_real_escape_string(trim($_POST['kekerapan'])) : '';
$belanja = (isset($_POST['belanja'])) ? mysql_real_escape_string(trim($_POST['belanja'])) : '';
$faedah = (isset($_POST['faedah'])) ? mysql_real_escape_string(trim($_POST['faedah'])) : '';
$kelulusan = (isset($_POST['kelulusan'])) ? mysql_real_escape_string(trim($_POST['kelulusan'])) : '';
$surat = (isset($_POST['surat'])) ? mysql_real_escape_string(trim($_POST['surat'])) : '';
$emailkp = (isset($_POST['email_kp'])) ? mysql_real_escape_string(trim($_POST['email_kp'])) : '';
$user = (isset($_POST['user'])) ? mysql_real_escape_string(trim($_POST['user'])) : '';
$dari = (isset($_POST['dari'])) ? mysql_real_escape_string(trim($_POST['dari'])) : '';
$dari=convertdate_back($dari);
$pulang = (isset($_POST['pulang'])) ? mysql_real_escape_string(trim($_POST['pulang'])) : '';
$pulang=convertdate_back($pulang);

if(!$namapeg || !$user || !$tujuan || !$jabatan || !$emailkp || !$nama_ketua || !$tempat){
	echo'<script language="JavaScript">
	alert("Sila lengkapkan semua maklumat");
	window.location="admin_daftarrasmi.php";
	</script>';
	exit;
}


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


	$query1 = mysql_query("select MAX(substr(idinfo, 2, 7)) as NOID from intrayinfo where substr(idinfo, 1, 1) = 'L'");
	$bil2 = mysql_fetch_array($query1);
	$nobarun = $bil2['NOID'];
	$ansj = tukarsequel($nobarun + 1);
	$nobaru = 'L'.$ansj;


	
//// create folder /////////
$pathinfo = pathinfo(basename($_FILES['surat']['name']));
$pathExt= $pathinfo['extension'];
$uploaddir = "upload/".$user."/";
$pathsurat = "surat-".$nobaru."-".$user.".".$pathinfo['extension'];
$uploadfile = $uploaddir.$pathsurat;




if ($submit_btn)
{
		if(!empty($_FILES['surat']['name'])) {
		
		if(!file_exists($user)){ 
		mkdir("upload/".$user,0777);
		}
		
		if (move_uploaded_file($_FILES['surat']['tmp_name'], $uploadfile)) {}
		}
		
		
$tarikhpermohonan=date("Y-m-d H:i:s");	
//kalau bukan kes khas

$queryinsert = "insert into intrayinfo
(idinfo,nama_seminar, tujuan,tempat,jenispermohonan,tarikhpergi,tarikhpulang,bil_peserta,nama_ketua,duta,kekerapan,belanja,faedah,lulus_kdn,surat,userid,tarikhpermohonan) 
values 
('$nobaru','$nama_seminar','$tujuan', '$tempat','F0000002','$dari', '$pulang','$bil','$nama_ketua','$duta','$kekerapan','$belanja','$faedah','$kelulusan','$pathsurat','$user','$tarikhpermohonan')";




		$resultinsert= mysql_query($queryinsert);
			if(!$resultinsert) 
			{
				echo "Error 2:";
				exit();
			}
//update status semasa
$query = "insert into intraystatussemasa (idinfo,kodstatus,updatedDate, updatedBy) values ('$nobaru','40','$datum','ksu')";
$result = mysql_query($query);
if(!$result) 
	{
		echo "Error 4:";
		exit();
	}	


$info = mysql_query("select * from intrayprofile where userid='$user'");
if(mysql_num_rows($info)<1){
$query = "insert into intrayprofile (userid,nama_pgw,jabatan) values ('$user','$namapeg','$jabatan')";
$result = mysql_query($query);
}	
else {
$query = "update intrayprofile set jabatan='$jabatan' where userid='$user'";
$result = mysql_query($query);

}	
?>
<script>
alert("Data telah dikemaskini");
window.location="admin_daftarrasmi.php";
</script>
<?php
}
?>