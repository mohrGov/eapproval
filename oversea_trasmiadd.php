<?php
require ("_common/conn.php");
require ("_common/global.php");
require ("_common/session.php");
include "convertdate.php";
include "current_date.php";
include "calculateDay.php";
$nxrole = '01';
$kodstatus = '10';

/*if($offcode='CIAST')//utk staf biasa agensi
{
$kodstatus = '20';
}
else if ($rank == 'KA' && $offcode=='CIAST')
{
$kodstatus = '10';
}
else
{
$kodstatus = '10';
}*/

$neg_lawat = (isset($_POST['neg_lawat'])) ? mysql_real_escape_string(trim($_POST['neg_lawat'])) : '';
$tujuan = (isset($_POST['tujuan'])) ? mysql_real_escape_string(trim($_POST['tujuan'])) : '';
$add1 = (isset($_POST['add1'])) ? mysql_real_escape_string(trim($_POST['add1'])) : '';
$add2 = (isset($_POST['add2'])) ? mysql_real_escape_string(trim($_POST['add2'])) : '';
$add3 = (isset($_POST['add3'])) ? mysql_real_escape_string(trim($_POST['add3'])) : '';
$tkh_tugas = (isset($_POST['tkh_tugas'])) ? trim($_POST['tkh_tugas']) : '';
$tkh_tugas = convertdate_back($tkh_tugas);
$namasedara = (isset($_POST['namasedara'])) ? mysql_real_escape_string(trim($_POST['namasedara'])) : '';
$hubungansedara = (isset($_POST['hubungansedara'])) ? mysql_real_escape_string(trim($_POST['hubungansedara'])) : '';
$telsedara = (isset($_POST['telsedara'])) ? mysql_real_escape_string(trim($_POST['telsedara'])) : '';
$emelsedara = (isset($_POST['emelnsedara'])) ? mysql_real_escape_string(trim($_POST['emelsedara'])) : '';
$addsedara = (isset($_POST['addsedara'])) ? mysql_real_escape_string(trim($_POST['addsedara'])) : '';
$add2sedara = (isset($_POST['add2sedara'])) ? mysql_real_escape_string(trim($_POST['add2sedara'])) : '';
$add3sedara = (isset($_POST['add3sedara'])) ? mysql_real_escape_string(trim($_POST['add3sedara'])) : '';
$alasan = (isset($_POST['alasan'])) ? mysql_real_escape_string(trim($_POST['alasan'])) : '';
$insurans = (isset($_POST['insurans'])) ? trim($_POST['insurans']) : '';
$Submit = (isset($_POST['Submit'])) ? mysql_real_escape_string(trim($_POST['Submit'])) : '';
//count day************************************************************************************
$tkh_mula = (isset($_POST['tkh_mula'])) ? trim($_POST['tkh_mula']) : '';
$tkh_akhir = (isset($_POST['tkh_akhir'])) ? trim($_POST['tkh_akhir']) : '';
$tkh_mula = convertdate_back($tkh_mula);
$tkh_akhir= convertdate_back($tkh_akhir);
$tarikhmula = convertdate_mdy($tkh_mula);
$tarikhakhir = convertdate_mdy($tkh_akhir);
$date1 = strtotime($tarikhmula);
$date2 = strtotime($tarikhakhir);
$bil_cuti = count_days($date1,$date2);
$bil_cuti = $bil_cuti + 1;

############################################################tambah
$koslawatan = (isset($_POST['koslawatan'])) ? mysql_real_escape_string(trim($_POST['koslawatan'])) : '';
$biayaioleh = (isset($_POST['biayaioleh'])) ? mysql_real_escape_string(trim($_POST['biayaioleh'])) : '';
$ahli_rombongan = (isset($_POST['ahli_rombongan'])) ? mysql_real_escape_string(trim($_POST['ahli_rombongan'])) : '';
##########################################################################
//****************************************************************************************************************
if ($neg_lawat == NULL)
{ //1
?>
	<script>
	alert("Pilihan negara adalah mandatori");
	window.location="oversea_trasmi.php?neg_lawat=<?php echo $neg_lawat;?>&tujuan=<?php echo $tujuan;?>&add1=<?php echo $add1;?>&tkh_mula=<?php echo $tkh_mula;?>&tkh_akhir=<?php echo $tkh_akhir;?>&tkh_tugas=<?php echo $tkh_tugas;?>";
	</script>
<?php
} //1

else if ($tujuan  == NULL)
{
?>
<script>
alert("Maklumat tujuan adalah mandatori");
window.location="oversea_trasmi.php?neg_lawat=<?php echo $neg_lawat;?>&tujuan=<?php echo $tujuan;?>&add1=<?php echo $add1;?>&tkh_mula=<?php echo $tkh_mula;?>&tkh_akhir=<?php echo $tkh_akhir;?>&tkh_tugas=<?php echo $tkh_tugas;?>";
</script>
<?php
}
else if ($add1 == NULL)
{
?>
<script>
alert("Alamat adalah mandatori");
window.location="oversea_trasmi.php?neg_lawat=<?php echo $neg_lawat;?>&tujuan=<?php echo $tujuan;?>&add1=<?php echo $add1;?>&tkh_mula=<?php echo $tkh_mula;?>&tkh_akhir=<?php echo $tkh_akhir;?>&tkh_tugas=<?php echo $tkh_tugas;?>";
</script>
<?php
}
else if ($tkh_mula == NULL)
{
?>
<script>
alert("tarikh mula cuti adalah mandatori");
window.location="oversea_trasmi.php?neg_lawat=<?php echo $neg_lawat;?>&tujuan=<?php echo $tujuan;?>&add1=<?php echo $add1;?>&tkh_mula=<?php echo $tkh_mula;?>&tkh_akhir=<?php echo $tkh_akhir;?>&tkh_tugas=<?php echo $tkh_tugas;?>";
</script>
<?php
}
else if ($tkh_akhir == NULL)
{
?>
<script>
alert("tarikh akhir cuti adalah mandatori");
window.location="oversea_trasmi.php?neg_lawat=<?php echo $neg_lawat;?>&tujuan=<?php echo $tujuan;?>&add1=<?php echo $add1;?>&tkh_mula=<?php echo $tkh_mula;?>&tkh_akhir=<?php echo $tkh_akhir;?>&tkh_tugas=<?php echo $tkh_tugas;?>";
</script>
<?php
}
else if ($tkh_tugas == NULL)
{
?>
<script>
alert("tarikh kembali bertugas adalah mandatori");
window.location="oversea_trasmi.php?neg_lawat=<?php echo $neg_lawat;?>&tujuan=<?php echo $tujuan;?>&add1=<?php echo $add1;?>&tkh_mula=<?php echo $tkh_mula;?>&tkh_akhir=<?php echo $tkh_akhir;?>&tkh_tugas=<?php echo $tkh_tugas;?>";
</script>
<?php
}

else
{ //2

	function tukarsequel ($a)
	{ //3
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
	} //3

	if ($khas)
	{
		$nobaru = $khas; 
	}
	else
	{
		$query1 = mysql_query("select MAX(substr(idinfo, 2, 7)) as NOID from intrayinfo where substr(idinfo, 1, 1) = 'L'");
		$bil = mysql_fetch_array($query1);
		$nobarun = $bil['NOID'];
		$ansj = tukarsequel($nobarun + 1);
		$nobaru = 'L'.$ansj;
	}
	
	 // echo "<pre>";
	 // var_dump(strtoupper(substr($_FILES['insurans']['name'],-4)));die;
	
	///////////   upload sijil/////////////
		if(!(strtoupper(substr($_FILES['insurans']['name'],-4))==".JPG" || strtoupper(substr($_FILES['insurans']['name'],-4))==".PNG" || strtoupper(substr($_FILES['insurans']['name'],-5))==".JPEG"|| strtoupper(substr($_FILES['insurans']['name'],-4)) == ".GIF" || strtoupper(substr($_FILES['insurans']['name'],-4))==".PDF"))  
			{
			?>
				<script type="text/javascript">

				alert("wrong file type");
					window.history.go(-1); 
				
				</script>
			<?php
			die;
			}   
			else 
			{	
			// echo "<pre>";
			// var_dump($_POST);die;
			$pathinfo = pathinfo(basename($_FILES['insurans']['name']));
			$insurans = (isset($_POST['insurans'])) ? trim($_POST['insurans']) : '';
			$pathExt= $pathinfo['extension'];
			//$uploaddir ="/var/www/html/eapproval/insurans/".$userid."/";
			$uploaddir ="insurans/".$userid."/";
			$pathsurat = $userid."_".rand(1,1000).".".$pathExt;
			$uploadfile = $uploaddir.$pathsurat;

			// echo '<pre>';
			// var_dump($pathinfo);
			// echo '<br/>';
			// die();
			///
			if(empty($_FILES['insurans']['name']))
			{
				$namafail = $insurans;
			} 
			else
			{
				$namafail = $pathsurat;

			if(!file_exists($userid)){ 
				mkdir("insurans/".$userid,0777);
				}


			// echo $uploadfile;die;
			 if (move_uploaded_file($_FILES['insurans']['tmp_name'], $uploadfile)) {
		      // echo "File is valid, and was successfully uploaded.\n";
		    	} else 
		    		{
		       			echo "Upload failed"; 
		       			echo "<script>alert('Upload Failed');window.location='inboxperibadi.php';</script>";
		       			die; 
		    		}
			}
		///
				
		}	
		
		if(empty($_FILES['insurans']['name']))
		{
		$namafail = $insurans;
		}
		if(!empty($_FILES['insurans']['name']))
		{
		$namafail = $pathsurat;
		}
		
		if (move_uploaded_file($_FILES['insurans']['tmp_name'], $uploadfile)) {}
		//end upload 


	if ($khas)
	{ 
	$queryinsert = "update intrayinfo set tujuan = '$tujuan',tempat = '$neg_lawat',jenispermohonan = 'F0000001',tarikhpergi = '$dari',tarikhpulang = '$hingga', 
	tarikhpermohonan = '$datum',flag_khas = 'N', kos_lawatan = '$koslawatan', biayai_oleh = '$biayaioleh', ahli_rombongan = '$ahli_rombongan', insurans='$pathsurat' where idinfo = '$nobaru'"; 
	}
	else
	{
	$queryinsert = "insert into intrayinfo (idinfo, tujuan, tempat, jenispermohonan, tarikhpergi, tarikhpulang, userid, tarikhpermohonan, add1, add2, add3,
	tkh_mula, tkh_akhir, bil_cuti, tkh_tugas, nama_saudara, hubungan_saudara, tel_saudara, emel_saudara, add_saudara, add2_saudara, add3_saudara, flag_kerap, 
	alasan_kekerapan, kos_lawatan, biayai_oleh, ahli_rombongan, insurans) values ('$nobaru', '$tujuan', '$neg_lawat', 'F0000001', '$dari', '$hingga', '$userid', '$datum', '$add1', '$add2', '$add3', '$tkh_mula', 
	'$tkh_akhir', '$bil_cuti', '$tkh_tugas', '$namasedara', '$hubungansedara', '$telsedara', '$emelsedara', '$addsedara', '$add2sedara', '$add3sedara', '$kerap', '$alasan', '$koslawatan', '$biayaioleh', '$ahli_rombongan','$pathsurat')";
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
	$profile = "select DISTINCT a.userid, a.email from intrayprofile a, intrayusers b where b.rank = 'T1' AND a.userid = b.userid";
	}
	else
	{
	$profile = "select DISTINCT a.userid, a.email from intrayprofile a, intrayusers b where b.rank = 'T2' AND a.userid = b.userid";
	}
}
else if ($rank == 'KA') // cth ciast
{
//tgk main jabatan
	$query = "select mainkod from intrayrefjabatan where kod_jbtn = '$offcode'";
	$result = mysql_query($query);
	$existke = mysql_num_rows($result);

	while ($data = mysql_fetch_array($result))
	{
		$mainkod = $data['mainkod'];
	}
	
	$profile = "select DISTINCT a.userid, a.email from intrayprofile a, intrayusers b where a.jabatan = '$mainkod' and b.rank = 'KJ' and a.userid = b.userid";
}
else if ($rank == 'T1'  || $rank == 'T2') // cth TKSU
{
	$profile = "select DISTINCT a.userid, a.email from intrayprofile a, intrayusers b where b.rank = 'SU' AND a.userid = b.userid";
}
else
{
	$profile = "select DISTINCT a.userid, a.email from intrayprofile a, intrayusers b where a.jabatan = '$offcode' and b.role = '$nxrole' and a.userid = b.userid";
}	
	$result1 = mysql_query($profile);
	
	while ($row = mysql_fetch_array($result1))
	{
	$email1 = $row["email"];
	$waitingfor = $row['userid'];
	//hantar mail
	$headers = 'From: eApproval@mohr.gov.my' . "\r\n" .
	   'Reply-To: eApproval@mohr.gov.my' . "\r\n" .
	   'X-Mailer: PHP/' . phpversion();
	$subject1 = "eapproval : Kelulusan Keluar Negara";
	$message1 = "Untuk makluman : \r\n Terdapat satu permohonan kelulusan keluar negara yang perlu disokong segera.\r\n Sila login : \r\n 1)sistem (http://myhos.mohr.gov.my/eapproval) atau \r\n 2) login melalui web (http://www.mohr.gov.my --> intranet) untuk membuat semakan tersebut"; 
	mail($email1, $subject1, $message1, $headers);
	} // end while
	
	//update status semasa
	$query = "Insert into intraystatussemasa (idinfo,kodstatus,updatedDate, updatedBy,waiting_for) values ('$nobaru','$kodstatus','$datum','$userid', '$waitingfor')";
	$result = mysql_query($query);
		if(!$result) 
		{
			echo "Error 4:";
			exit();
		}

	
##############################################################
} // 2
?>
<script>
alert("Data telah ditambah dan emel telah dihantar kepada Penyokong anda");
window.location="inboxperibadi.php";
</script>