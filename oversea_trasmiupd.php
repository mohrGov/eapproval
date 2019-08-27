<?php
require ("_common/conn.php");
require ("_common/global.php");
require ("_common/session.php");
include "convertdate.php";
include "current_date.php";
include "calculateDay.php";

//personal
$nama_pgw = (isset($_POST['nama_pgw'])) ? trim($_POST['nama_pgw']) : '';
$nama_pgw = addslashes($nama_pgw);
$nokp = (isset($_POST['nokp'])) ? trim($_POST['nokp']) : '';
$tel = (isset($_POST['tel'])) ? trim($_POST['tel']) : '';
$jwtn = (isset($_POST['jwtn'])) ? trim($_POST['jwtn']) : '';
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

#########################################################################3

$neg_lawat = (isset($_POST['neg_lawat'])) ? mysql_real_escape_string(trim($_POST['neg_lawat'])) : '';
$tujuan = (isset($_POST['tujuan'])) ? mysql_real_escape_string(trim($_POST['tujuan'])) : '';
$insurans = (isset($_POST['insurans'])) ? mysql_real_escape_string(trim($_POST['insurans'])) : '';
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
$Submit = (isset($_POST['Submit'])) ? mysql_real_escape_string(trim($_POST['Submit'])) : '';
$dari = (isset($_POST['tarikh_mula'])) ? trim($_POST['tarikh_mula']) : '';
$hingga = (isset($_POST['tarikh_tmt'])) ? trim($_POST['tarikh_tmt']) : '';
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

	$dari=convertdate_back($dari);
	$hingga=convertdate_back($hingga);

// kene update status jadi - 20
if ($Submit)
{


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


//updtae profile
$queryupdate = "update intrayprofile set nama_pgw = '$nama_pgw', nokp='$nokp', jawatan='$jwtn',jabatan='$jabatan', gaji_skrg='$gaji_skrg',tkh_lantikan='$date_lantik', 
status_perkahwinan='$s_kahwin',nama_psgn='$nama_psgn',jwtn_psgn='$jwtn_psgn',jbtn_psgn='$jbtn_psgn',tarikh_lantikan='$tkh_lantik_psgn',tanggungan='$tanggungan',email='$email' where userid='$userid'";
$resultupdate = mysql_query($queryupdate);
//echo $queryupdate; die;
	if(!$resultupdate) 
	{
	echo "Error update:";
	exit();
	}
//updtae info
	$queryupdate = "update intrayinfo set tempat = '$neg_lawat', tujuan='$tujuan', tarikhpergi='$dari',tarikhpulang='$hingga',kos_lawatan='$koslawatan', biayai_oleh='$biayaioleh', ahli_rombongan='$ahli_rombongan',insurans='$pathsurat' where userid='$userid' and idinfo='$ref'";
	$resultupdate = mysql_query($queryupdate);
	
				if(!$resultupdate) 
				{
					echo "Error update:";
					exit();
				}
//update status semasa
// changes 15/6 - baca dari proses flow table
/*$query10 = "select nextrole, kodstatus from intrayflowperibadi where currentstatus = '$currentstatus'";
$result10 = mysql_query($query10);
	
	while ($data10 = mysql_fetch_array($result10))
	{
		$nxrole = $data10['nextrole'];
		$kodstatus = $data10['kodstatus'];
	}
*///awin ubh 4/4/2017
$nxrole = '03';
$kodstatus = '30';

$profile = "select a.userid from intrayprofile a, intrayusers b where b.role = '$nxrole' and a.userid = b.userid";
$result1 = mysql_query($profile);
$dataku = mysql_fetch_array($result1);
$waitingfor = $dataku['userid'];

/////////////////////////////////////////////////////////////////////////////
$query = "update intraystatussemasa set kodstatus = '$kodstatus', catatan = '', updatedDate='$datum', updatedBy ='$userid', waiting_for='$waitingfor', keputusan='' where idinfo='$ref'";
$result = mysql_query($query);
if(!$result) 
	{
		echo "Error 4:";
		exit();
	}
//update history
$query1 = "insert into intrayhistory (idinfo,kodstatus,catatan,cuti, lengkap, updateddate,updatedby) values ('$ref','$kodstatus','','$cuti','','$datum','$userid')";
$result1 = mysql_query($query1);
if(!$result1) 
	{
		echo "Error 1:";
		exit();
	}
///////send emel pada psm - telah lengkapkan ///////////
/*$profile = mysql_query("select userid from intrayusers where role = '$nxrole'");
while ($row = mysql_fetch_array($profile))
	{
	$emel_htr = $row["userid"];
	$addemel = $emel_htr . "@mohr.gov.my";
		
$headers2 = 'From:eApproval@mohr.gov.my' . "\r\n\n" .
//   'Reply-To: norazwin@mohr.gov.my' . "\r\n" .
'X-Mailer: PHP/' . phpversion();
//$sendto = "$email_supervisor";
// ok -- $sendto = "narina@mohr.gov.my" . ',' ."zurasita@mohr.gov.my";
$sendto2 =  $addemel;
$subject2 = "Permohonan Ke Luar Negara Bagi Urusan Persendirian : Kemaskini Maklumat";
$message2 = "Untuk makluman tuan/puan,\r\n\r\n kemaskini maklumat telah dilakukan oleh pemohon.\r\n\r\n
Sila layari http://myhos.mohr.gov.my/eapproval. Log masuk ke dalam perkhidmatan intranet untuk 'eApproval Application' .\r\n\r\n 

Sekian, Terima Kasih\r\n\r\n";

//hantar email
mail ($sendto2, $subject2, $message2, $headers2);	
}
*/
?>
<script>
alert("Data telah dikemaskini");
window.location="inbox.php";
</script>
<?php
}
?>