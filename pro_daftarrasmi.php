<?php
require ("_common/conn.php");
require ("_common/global.php");
require ("_common/session.php");
include "convertdate.php";
include "current_date.php";
$nxrole = '01';
$kodstatus = '10';

$nama_seminar = (isset($_POST['nama_seminar'])) ? mysql_real_escape_string(trim($_POST['nama_seminar'])) : '';
$submit_btn = (isset($_POST['submit_btn'])) ? mysql_real_escape_string(trim($_POST['submit_btn'])) : '';
$tujuan = (isset($_POST['tujuan'])) ? mysql_real_escape_string(trim($_POST['tujuan'])) : '';
$tempat = (isset($_POST['neg_lawat'])) ? mysql_real_escape_string(trim($_POST['neg_lawat'])) : '';
$bil= (isset($_POST['bil'])) ? mysql_real_escape_string(trim($_POST['bil'])) : '';
$nama_ketua = (isset($_POST['nama_ketua'])) ? mysql_real_escape_string(trim($_POST['nama_ketua'])) : '';
$duta = (isset($_POST['duta'])) ? mysql_real_escape_string(trim($_POST['duta'])) : '';
$belanja = (isset($_POST['belanja'])) ? mysql_real_escape_string(trim($_POST['belanja'])) : '';
$faedah = (isset($_POST['faedah'])) ? mysql_real_escape_string(trim($_POST['faedah'])) : '';
$surat = (isset($_FILES["surat"]["name"])) ? (isset($_FILES["surat"]["name"])) : NULL;

if ($nama_seminar == NULL)
{
?>
<script>
alert("Nama seminar adalah mandatori"); 
window.location="oversea_rasmi.php?nama_seminar=<?php echo $nama_seminar;?>&tujuan=<?php echo $tujuan;?>&tempat=<?php echo $tempat;?>&bil=<?php echo $bil;?>&nama_ketua=<?php echo $nama_ketua;?>&duta=<?php echo $duta;?>&kekerapan=<?php echo $kekerapan;?>&kelulusan=<?php echo kelulusan;?>
&belanja=<?php echo $belanja;?>&faedah=<?php echo $faedah;?>&surat=<?php echo $surat;?>&email_kp=<?php echo $emailkp;?>";
</script>
<?php
}
else if ($tujuan == NULL)
{
?>
<script>
alert("Tujuan Adalah Mandatori"); 
window.location="oversea_rasmi.php?nama_seminar=<?php echo $nama_seminar;?>&tujuan=<?php echo $tujuan;?>&tempat=<?php echo $tempat;?>&bil=<?php echo $bil;?>&nama_ketua=<?php echo $nama_ketua;?>&duta=<?php echo $duta;?>&kekerapan=<?php echo $kekerapan;?>&kelulusan=<?php echo $kelulusan;?>
&belanja=<?php echo $belanja;?>&faedah=<?php echo $faedah;?>&surat=<?php echo $surat;?>&email_kp=<?php echo $emailkp;?>";
</script>
<?php
}
else if ($tempat == NULL)
{
?>
<script>
alert("Tempat Adalah Mandatori");
window.location="oversea_rasmi.php?nama_seminar=<?php echo $nama_seminar;?>&tujuan=<?php echo $tujuan;?>&tempat=<?php echo $tempat;?>&bil=<?php echo $bil;?>&nama_ketua=<?php echo $nama_ketua;?>&duta=<?php echo $duta;?>&kekerapan=<?php echo $kekerapan;?>&kelulusan=<?php echo $kelulusan;?>
&belanja=<?php echo $belanja;?>&faedah=<?php echo $faedah;?>&surat=<?php echo $surat;?>&email_kp=<?php echo $emailkp;?>";
</script>
<?php
}
else if ($belanja  == NULL)
{
?>
<script>
alert("Maklumat Perbelanjaan  Adalah Mandatori");
window.location="oversea_rasmi.php?nama_seminar=<?php echo $nama_seminar;?>&tujuan=<?php echo $tujuan;?>&tempat=<?php echo $tempat;?>&bil=<?php echo $bil;?>&nama_ketua=<?php echo $nama_ketua;?>&duta=<?php echo $duta;?>&kekerapan=<?php echo $kekerapan;?>&kelulusan=<?php echo $kelulusan;?>
&belanja=<?php echo $belanja;?>&faedah=<?php echo $faedah;?>&surat=<?php echo $surat;?>&email_kp=<?php echo $emailkp;?>";
</script>
<?php
}

if ($surat  == NULL)
{
?>
<script>
alert("Proses Muat Naik Salinan Surat Kelulusan Adalah Mandatori");
window.location="oversea_rasmi.php?nama_seminar=<?php echo $nama_seminar;?>&tujuan=<?php echo $tujuan;?>&tempat=<?php echo $tempat;?>&bil=<?php echo $bil;?>&nama_ketua=<?php echo $nama_ketua;?>&duta=<?php echo $duta;?>&kekerapan=<?php echo duta;?>&kelulusan=<?php echo kelulusan;?>
&belanja=<?php echo $belanja;?>&faedah=<?php echo $faedah;?>&surat=<?php echo $surat;?>&email_kp=<?php echo $emailkp;?>";
</script>
<?php
}
else
{


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

	if ($khas)
	{ 
		$nobaru = $khas;
	}
	else
	{
	$query1 = mysql_query("select MAX(substr(idinfo, 2, 7)) as NOID from intrayinfo where substr(idinfo, 1, 1) = 'L'");
	$bil2 = mysql_fetch_array($query1);
	$nobarun = $bil2['NOID'];
	$ansj = tukarsequel($nobarun + 1);
	$nobaru = 'L'.$ansj;
	}
	
//// create folder /////////
$pathinfo = pathinfo(basename($_FILES['surat']['name']));
//kat sini kene control ext
$pathExt= $pathinfo['extension'];
$uploaddir = "upload/".$userid."/";
$pathsurat = "surat-".$nobaru.$userid.".".$pathinfo['extension'];
$uploadfile = $uploaddir.$pathsurat;

if ($submit_btn)
{
	if ($_FILES['surat']['size'] > 3145728) 
	{
        echo 'Exceeded filesize limit.';
		exit();
    }
	$types = array('image/jpeg', 'image/gif','application/pdf','image/png');  
	
	if (in_array($_FILES['surat']['type'], $types))
	{
	//ok
		if(!empty($_FILES['surat']['name'])) 
		{ // 5		
			if(!file_exists($userid))
			{ 
				mkdir("upload/".$userid,0777);
			}
		
			if (move_uploaded_file($_FILES['surat']['tmp_name'], $uploadfile)) 
			{
				echo "<input type='hidden' value='Fail ".  basename( $_FILES['surat']['name']). " telah diupload' />";
			} 
			else
			{
				echo "Ada masalah ketika upload.";
				exit();
			}
		} //5
	}
	else
	{ ?>
		<script>
alert("Muat naik Surat Tawaran perlu disertakan dan hanya format : pdf, jpeg,gif,png sahaja yang dibenarkan!");
window.location="oversea_rasmi.php?nama_seminar=<?php echo $nama_seminar;?>&tujuan=<?php echo $tujuan;?>&tempat=<?php echo $tempat;?>&bil=<?php echo $bil;?>&nama_ketua=<?php echo $nama_ketua;?>&duta=<?php echo $duta;?>&kekerapan=<?php echo duta;?>&kelulusan=<?php echo kelulusan;?>
&belanja=<?php echo $belanja;?>&faedah=<?php echo $faedah;?>&surat=<?php echo $surat;?>&email_kp=<?php echo $emailkp;?>";
</script>
	<?php } 
				
$tarikhpermohonan=date("Y-m-d H:i:s");	
//kalau bukan kes khas
if ($khas)
{ 
$queryinsert = "update intrayinfo set nama_seminar = '$nama_seminar', tujuan = '$tujuan',tempat = '$tempat',jenispermohonan = 'F0000002',tarikhpergi= '$dari', tarikhpulang = '$hingga', bil_peserta = '$bil', nama_ketua ='$nama_ketua' ,duta = '$duta', belanja = '$belanja', faedah = '$faedah', surat = '$pathsurat', tarikhpermohonan = '$tarikhpermohonan', flag_khas = 'N' where idinfo = '$nobaru'";
}
else
{
$queryinsert = "insert into intrayinfo
(idinfo,nama_seminar, tujuan,tempat,jenispermohonan,tarikhpergi,tarikhpulang,bil_peserta,nama_ketua,duta,belanja,faedah,surat,userid,tarikhpermohonan) 
values 
('$nobaru','$nama_seminar','$tujuan', '$tempat','F0000002','$dari', '$hingga','$bil','$nama_ketua','$duta','$belanja','$faedah','$pathsurat','$userid','$tarikhpermohonan')";
}

		$resultinsert= mysql_query($queryinsert);
		if(!$resultinsert) 
			{
				echo "Error 2:";
				exit();
			}

//update history
$query = "Insert into intrayhistory (idinfo,kodstatus,updateddate, updatedby) values ('$nobaru','$kodstatus','$datum','$userid')";
$result = mysql_query($query);
if(!$result) 
	{
		echo "Error 5:";
		exit();
	}
	

//emel start ********************************************************************************************************************
if ($rank == 'KJ') // ketua jabatan/ sub
{
	if ($up == 'O')  // kalau operasi
	{
	$profile = "select a.email, a.userid from intrayprofile a, intrayusers b where b.rank = 'T1' AND a.userid = b.userid";
	}
	else
	{
	$profile = "select a.email, a.userid from intrayprofile a, intrayusers b where b.rank = 'T2' AND a.userid = b.userid";
	}
}
else if ($rank == 'KA') // cth ciast
{
//tgk main jabatan
	$query55 = "select mainkod from intrayrefjabatan where kod_jbtn = '$offcode'";
	$result55 = mysql_query($query55);
	$existke = mysql_num_rows($result55);

	while ($data55 = mysql_fetch_array($result55))
	{
		$mainkod = $data55['mainkod'];
	}
	
	$profile = "select a.email, a.userid from intrayprofile a, intrayusers b where a.jabatan = '$mainkod' and b.rank = 'KJ' and a.userid = b.userid";
}
else if ($rank == 'T1'  || $rank == 'T2') // cth TKSU
{
	$profile = "select a.email, a.userid from intrayprofile a, intrayusers b where b.rank = 'SU' AND a.userid = b.userid";
}
else
{
	$profile = "select a.email, a.userid from intrayprofile a, intrayusers b where a.jabatan = '$offcode' and b.role = '$nxrole' and a.userid = b.userid";
}
	$result13 = mysql_query($profile);
	
	while ($row = mysql_fetch_array($result13))
	{
	$email1 = $row["email"];
	$waitingfor = $row['userid'];
	$headers = 'From: eApproval@mohr.gov.my' . "\r\n" .
	   'Reply-To: eApproval@mohr.gov.my' . "\r\n" .
	   'X-Mailer: PHP/' . phpversion();
	$subject1 = "eapproval : Kelulusan Keluar Negara test";
	$message1 = "Untuk makluman : \r\n Terdapat satu permohonan kelulusan keluar negara yang perlu disokong segera.\r\n Sila login : \r\n 1)sistem (http://myhos.mohr.gov.my/eapproval) atau \r\n 2) login melalui web (http://www.mohr.gov.my --> intranet) untuk membuat semakan tersebut"; 
	mail($email1, $subject1, $message1, $headers);
	
	$query66 = "Insert into intraystatussemasa (idinfo,kodstatus,updatedDate, updatedBy, waiting_for) values ('$nobaru','$kodstatus','$datum','$userid', '$waitingfor')";
	$result66 = mysql_query($query66);
	if(!$result66) 
		{
		continue;
		}
	} // end while
?>
<script>
alert("Data telah ditambah dan emel telah dihantar kepada Penyokong anda");
window.location="inbox.php";
</script>
<?php
} // end else
}
?>