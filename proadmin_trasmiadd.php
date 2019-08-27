<?php
require ("_common/conn.php");
require ("_common/global.php");
require ("_common/session.php");
include "convertdate.php";
include "current_date.php";
include "calculateDay.php";

$namapeg = (isset($_POST['namapeg'])) ? mysql_real_escape_string(trim($_POST['namapeg'])) : '';
$jabatan = (isset($_POST['jabatan'])) ? mysql_real_escape_string(trim($_POST['jabatan'])) : '';
$user = (isset($_POST['user'])) ? mysql_real_escape_string(trim($_POST['user'])) : '';
$neg_lawat = (isset($_POST['neg_lawat'])) ? mysql_real_escape_string(trim($_POST['neg_lawat'])) : '';
$tujuan = (isset($_POST['tujuan'])) ? mysql_real_escape_string(trim($_POST['tujuan'])) : '';
$rm_dijangka = (isset($_POST['rm_dijangka'])) ? mysql_real_escape_string(trim($_POST['rm_dijangka'])) : '';
$punca = (isset($_POST['punca'])) ? mysql_real_escape_string(trim($_POST['punca'])) : '';
$klykn_cuti = (isset($_POST['klykn_cuti'])) ? mysql_real_escape_string(trim($_POST['klykn_cuti'])) : '';
$Submit = (isset($_POST['Submit'])) ? mysql_real_escape_string(trim($_POST['Submit'])) : '';
$emailkp = (isset($_POST['email_kp'])) ? mysql_real_escape_string(trim($_POST['email_kp'])) : '';
$dari = (isset($_POST['dari'])) ? mysql_real_escape_string(trim($_POST['dari'])) : '';
$dari=convertdate_back($dari);
$pulang = (isset($_POST['pulang'])) ? mysql_real_escape_string(trim($_POST['pulang'])) : '';
$pulang=convertdate_back($pulang);


if(!$namapeg || !$user || !$tujuan || !$jabatan || !$emailkp || !$neg_lawat){
	echo'<script language="JavaScript">
	alert("Sila lengkapkan semua maklumat");
	window.location="admin_transmi.php";
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
		$bil = mysql_fetch_array($query1);
		$nobarun = $bil['NOID'];
		$ansj = tukarsequel($nobarun + 1);
		$nobaru = 'L'.$ansj;
	



if ($Submit)
{

	$queryinsert = "insert into intrayinfo (idinfo, tujuan,tempat,jenispermohonan,tarikhpergi,tarikhpulang,belanja,nilai_perbelanjaan,kelayakan_cuti,userid,tarikhpermohonan) 
values 
('$nobaru','$tujuan', '$neg_lawat','F0000001','$dari', '$pulang','$punca','$rm_dijangka','$klykn_cuti','$user','$datum')";
	
	
		$resultinsert= mysql_query($queryinsert);
			if(!$resultinsert) 
			{
				echo "Error 2:";
				exit();
			}
//update status semasa
$query = "Insert into intraystatussemasa (idinfo,kodstatus,updatedDate, updatedBy) values ('$nobaru','40','$datum','ksu')";
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
alert("Data telah ditambah");
window.location="admin_trasmi.php";
</script>
<?php
}
?>