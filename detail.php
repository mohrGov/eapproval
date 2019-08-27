<?php
require ("_common/conn.php");
require ("_common/session.php");
require ("_common/global.php");
include "convertdate.php";
include "current_date.php";
include "calculateDay.php";

$ref = (isset($_POST['ref'])) ? mysql_real_escape_string(trim($_POST['ref'])) : '';
$view_btn = (isset($_POST['view_btn'])) ? mysql_real_escape_string(trim($_POST['view_btn'])) : '';
$view2_btn = (isset($_POST['view2_btn'])) ? mysql_real_escape_string(trim($_POST['view2_btn'])) : '';

$_SESSION["ref"] = "$ref";
$_SESSION["currentstatus"] = "";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
</head>
<title><?php echo SYSTEM_TITLE ?></title>
<link rel="stylesheet" href="css/main.css" type="text/css">
<form action="sokong.php" method="post" name="mof">
<body>
<!-- table besar -->
<table width="850" border="0" align="center" cellpadding="0"  cellspacing="0" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0">
<?php include "header.php";?>
<?php include "menumenu.php";?>
<tr><td width="1033"><br /></td></tr>
<tr>
<td>
<!-- table tab -->
<?php
$queryp = "select jabatan from intrayprofile where userid = '$userid'";
//echo $query;
$resultp = mysql_query($queryp);

while ($datap = mysql_fetch_array($resultp))
{
	$jabatan = $datap['jabatan'];
}

if ($view_btn && $ref)
{ //-1

$query = "select a.*, b.* from intrayinfo a, intrayprofile b where a.idinfo = '$ref' and a.userid = b.userid ";
$result = mysql_query($query);
//echo $query; die;
 	if(!$result) 
	{
		echo "Error:";
		exit();
	}
		  
$existke = mysql_num_rows($result);

if ($existke)
{ //2
	$bil = 1;
	while ($datachild = mysql_fetch_array($result))
	{ //3
		$mydate = $datachild['tarikhpermohonan'];
		$useridpemohon = $datachild['userid'];
		$myname = $datachild['nama_pgw'];
		$myjawatan = $datachild['jawatan'];
		$gredjwtn = $datachild['gred_jwtn'];
		$myjabatan = $datachild['jabatan'];
		$tarikhlantikan = $datachild['tkh_lantikan'];
		$gaji = $datachild['gaji_skrg'];
		$jenispermohonan = $datachild['jenispermohonan'];
		$namapasangan = $datachild['nama_psgn'];
		$jawpasangan = $datachild['jwtn_psgn'];
		$opispasangan = $datachild['jbtn_psgn'];
		$tanggungan = $datachild['tanggungan'];
		$skahwin= $datachild['status_perkahwinan'];
		$mydate = convertdate($mydate);
		$tarikhlantikan = convertdate($tarikhlantikan);
		//lawatan
		$namarasmi = $datachild['nama_seminar'];
		$tujuan = $datachild['tujuan'];
		$tempat = $datachild['tempat'];
		$tarikhpergi = $datachild['tarikhpergi'];
		$tarikhpergi = convertdate($tarikhpergi);
		$tarikhpulang = $datachild['tarikhpulang'];
		$tarikhpulang = convertdate($tarikhpulang);
		$surat = $datachild['surat'];
		$bil_peserta = $datachild['bil_peserta'];
		$nama_ketua = $datachild['nama_ketua'];
		$duta = $datachild['duta'];
		$kekerapan = $datachild['kekerapan'];
		$belanja = $datachild['belanja'];
		$nilai_perbelanjaan = $datachild['nilai_perbelanjaan'];
		$kelayakancuti = $datachild['kelayakan_cuti'];
		$faedah = $datachild['faedah'];
		$lulus_kdn = $datachild['lulus_kdn'];
		
		//tambah 26/1/2017 - arahan TKSUO
		$koslawatan = $datachild['kos_lawatan'];
		$biayaioleh = $datachild['biayai_oleh'];
		$ahli_rombongan = $datachild['ahli_rombongan'];
		
		//counday
		$dari = convertdate_back($tarikhpergi);
		$hingga = convertdate_back($tarikhpulang);
	
		$tarikhpergiku = convertdate_mdy($dari);
		$tarikhpulangnya = convertdate_mdy($hingga);
		$date1 = strtotime($tarikhpergiku);
		$date2 = strtotime($tarikhpulangnya);
		$tempohlawatan = count_days($date1,$date2);

    //insurans
    $insurans= $datachild['insurans'];
		
	} //3
} //2

$ref4 = mysql_query("select role from intrayusers where userid ='$useridpemohon'");
$rowData4 = mysql_fetch_array($ref4);
$rolepemohon = $rowData4["role"];

$ref1 = "select kodstatus, waiting_for  from intraystatussemasa where idinfo='$ref'";
$result3 = mysql_query($ref1);
$rowData = mysql_fetch_array($result3);
$kodref1 = $rowData["kodstatus"];
$_SESSION["currentstatus"] = "$kodref1";
$waitingfor = $rowData["waiting_for"];

$ref2 = mysql_query("select * from intrayrefstatus where idstatus='$kodref1'");
$rowData2 = mysql_fetch_array($ref2);
$kodref2 = $rowData2["descstatus"];
$tindakan = $rowData2["tindakan"];
//$tindakanPeribadi = $rowData2["tindakan_peribadi"];

//check kahwin
// ref status
$query2 = "select * from intrayrefstatusperkahwinan where kodkahwin = '$skahwin'";
$result2 = mysql_query($query2);

 	if(!$result2) 
	{
		echo "Error2:";
		exit();
	}
	$data2 = mysql_fetch_array($result2);
	$statusdesc = $data2['desckahwin'];
	
	// ref jawatan
$query2 = "select * from intrayrefjawatan where kod_jwtn = '$myjawatan'";
$result2 = mysql_query($query2);

 	if(!$result2) 
	{
		echo "Error8:";
		exit();
	}
	$data2 = mysql_fetch_array($result2);
	$myjawatandesc = $data2['nama_jwtn'];
	
	// ref jabatan
$query2 = "select * from intrayrefjabatan where kod_jbtn = '$myjabatan'";
$result2 = mysql_query($query2);

 	if(!$result2) 
	{
		echo "Error9:";
		exit();
	}
	$data2 = mysql_fetch_array($result2);
	$myjabatandesc = $data2['nama_jbtn'];
	

	// ref negara
$query21 = "select * from ref_country where country_code = '$tempat'";
$result21 = mysql_query($query21);

 	if(!$result21) 
	{
		echo "Error91:";
		exit();
	}
	$data21 = mysql_fetch_array($result21);
	$mytempatbest = $data21['description'];
	
	
	 $query24= "select * from ref_punca_belanja where kod = '$belanja'";
     $result24= mysql_query($query24);

 	if(!$result24) 
	{
		echo "Error91:";
		exit();
	}
	$data24 = mysql_fetch_array($result24);
	$mybelanja = $data24['description'];
?>
<table width="850" border="0" align="center" cellpadding="5"  cellspacing="0" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0">
<tr bgcolor="#a4c8e0">
<td width="980" height="25" bgcolor="#cc3333"><strong>Permohonan Lawatan Ke Luar Negeri :</strong></td>
</tr>
<tr>
<td><table width="979" border="0" align="center" cellpadding="0" cellspacing="0" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0">
  <tr>
    <td><table width="100%" border="0" align="center" cellpadding="5"  cellspacing="0">
      <tr bgcolor="#DF7B7B">
        <td height="25" colspan="8" style="border-bottom: 1px solid #a4c8e0"><strong>Maklumat Pegawai Memohon | Tarikh Memohon :
          <?php echo $mydate?>
        </strong></td>
      </tr>
      <tr>
        <td height="25">Nama </td>
        <td>:</td>
        <td><?php echo $myname;?></td>
        <td width="166">Tarikh Lantikan</td>
        <td width="5" height="25">:</td>
        <td width="232"><?php echo $tarikhlantikan?></td>
      </tr>
      <tr>
        <td width="202">Jawatan </td>
        <td width="7">:</td>
        <td width="307"><?php echo $myjawatandesc . " - " . $gredjwtn;?></td>
        <td>Gaji Sekarang </td>
        <td>:</td>
        <td>RM
          <?php echo $gaji?></td>
      </tr>
      <tr> </tr>
      <tr>
        <td>Jabatan/Pejabat</td>
        <td>:</td>
        <td><?php echo $myjabatandesc?>
         <!-- /
          <?php echo $mypejabat?>--></td>
      </tr>
	  <tr> </tr>
      <tr>
        <td>Status Perkahwinan </td>
        <td>:</td>
        <td><?php echo $statusdesc?></td>
        <!--<td>Tanggungan </td>
        <td>:</td>
        <td><?php echo $tanggungan?></td>-->
      </tr>
	  <?php if($skahwin=='02'){ ?>
      <tr>
        <td><ul>
            <li>Nama Isteri/Suami </li>
        </ul></td>
        <td>:</td>
        <td><?php echo $namapasangan?></td>
      </tr>
      <tr>
        <td><ul>
            <li>Jawatan isteri /suami </li>
        </ul></td>
        <td>:</td>
        <td><?php echo $jawpasangan?></td>
      </tr>
      <tr>
        <td><ul>
            <li>Jabatan / Pejabat </li>
        </ul></td>
        <td>:</td>
        <td><?php echo $opispasangan?></td>
      </tr>
      <?php } ?>
    </table>
      <?php
	if ($jenispermohonan == 'F0000001')
	{ // 77
	?>
  <table width="979" border="0" align="center" cellpadding="5"  cellspacing="0">
    <tr bgcolor="#DF7B7B">
      <td height="25" colspan="6" style="border-bottom: 1px solid #a4c8e0"><strong>Maklumat Lawatan : </strong></td>
         </tr>
    <tr>
      <td height="45">Negara yang hendak dilawati </td>
              <td>:</td>
              <td><?php echo $mytempatbest;?></td>
            </tr>
    <tr>
      <td>Tarikh Pergi </td>
              <td>:</td>
              <td><?php echo $tarikh?><?php echo $tarikhpergi?></td>
              <td width="79">Tarikh Pulang </td>
              <td width="5">:</td>
              <td width="278"><?php echo $tarikhpulang?></td>
            </tr>
	 <tr>
        <td>Kos Lawatan (RM)</td>
        <td>:</td>
        <td><?php echo $koslawatan;?></td>
        <td>Dibiayai oleh</td>
        <td>:</td>
        <td><?php echo $biayaioleh;?></td>
      </tr>
	<tr>
      <td>Bilangan Hari di Luar Negara</td>
              <td>:</td>
              <td><?php echo $tarikh?><?php echo $tempohlawatan;?> hari</td>
              <td width="79">Bilangan ahli keluarga/rombongan </td>
              <td width="5">:</td>
              <td width="278"><?php echo $ahli_rombongan;?></td>
            </tr>
    <tr>
    <tr>
      <td width="210">Tujuan</td>
              <td width="8" height="25">:</td>
              <td width="339"><?php echo $tujuan?></td>
            </tr>
    <tr>
      <td>Status</td>
      <td>:</td>
      <td><strong><?php if ($mainkod != NULL || $mainkod !=' ') {	echo 'Permohonan'; } else { echo $kodref2; } 
						 ?></strong> - <strong> <?php echo $tindakan;?> </strong></td>
      </tr>
    <tr>
      <td width="210">Maklumat Insurans</td>
      <td width="8" height="25">:</td>
      <td width="339"><a href="insurans/<?php echo $useridpemohon; ?>/<?php echo $insurans;?>" target="_blank">[<?php echo $insurans; ?>]</a></td>
    </tr>
			
			
			  <tr>
      <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
    </table>
		  <?php
		} //77
		else
		{ // 88
		?>
      <table width="979" border="0" align="center" cellpadding="5"  cellspacing="0">
        <tr bgcolor="#DF7B7B">
          <td height="25" colspan="6" style="border-bottom: 1px solid #a4c8e0"><strong>Maklumat Lawatan Rasmi</strong></td>
            </tr>
        <tr>
          <td height="45">Nama Persidangan/Seminar/
            Lawatan Rasmi</td>
              <td>:</td>
              <td><?php echo $namarasmi?></td>
			  <td width="179">Tempat</td>
              <td width="5">:</td>
              <td width="280"><?php echo $tempat?></td>
            </tr>
        <tr>
          <td>Tarikh Pergi </td>
              <td>:</td>
              <td><?php echo $tarikhpergi?></td>
              <td width="179">Tarikh Pulang </td>
              <td width="5">:</td>
              <td width="280"><?php echo $tarikhpulang?></td>
            </tr>
        <tr>
          <td width="259">Tujuan</td>
              <td width="6" height="25">:</td>
              <td width="190"><?php echo $tujuan?></td>
            </tr>
        <tr>
          <td>Bilangan Peserta </td>
              <td>:</td>
              <td><?php echo $bil_peserta?> orang </td>
              <td>Nama Ketua </td>
              <td>:</td>
              <td><?php echo $nama_ketua?></td>
            </tr>
        <tr>
          <td>Pegawai kedutaan Malaysia di negara tempat persidangan</td>
              <td>:</td>
              <td><?php echo $duta?></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
        <tr>
          <td>Perbelanjaan ditanggung</td>
              <td>:</td>
              <td><?php echo $belanja?></td>
            </tr>
        <tr>
          <td>Faedah kepada Negara </td>
              <td>:</td>
              <td><?php echo $faedah?></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
        <tr>
          <td>Surat Tawaran</td>
              <td>:</td>
              <td><a href="upload/<?=$useridpemohon; ?>/<?=$surat; ?>" target="_blank">Muat turun surat</a></td>
            </tr>
			
				  <tr>
      <td>Status</td>
              <td>:</td>
              <td><strong><?php  echo $kodref2; ?></strong> - <strong><?php echo $tindakan?></strong></td>
            </tr>
			
      </table>
		  <?php
		} //88
		?>
<table width="979" border="0" align="center" cellpadding="5"  cellspacing="0">
        <tr bgcolor="#DF7B7B">
          <td height="25" colspan="5" style="border-bottom: 1px solid #a4c8e0"><strong>Sejarah Lawatan 2 Tahun Lepas</strong></td>
            </tr>
        <tr bgcolor="#a4c8e0">
          <td width="234" align="center" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0"><strong>Nama Tempat </strong></td>
              <td width="271" align="center" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0"><strong>Tujuan</strong></td>
              <td width="158" align="center" bgcolor="#a4c8e0" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0"><strong>Tarikh Pergi </strong></td>
              <td width="138" align="center" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0"><strong>Tarikh Pulang </strong></td>
              <td width="128" align="center" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0"><strong>Tempoh (Hari) </strong></td>
            </tr>
        <?php
  	$query1 = "select * from intrayinfo where userid = '$useridpemohon' and idinfo != '$ref' and jenispermohonan='$jenispermohonan' ";
	$result1 = mysql_query($query1);
	$exist = mysql_num_rows($result1);
	
	if ($exist > 0)
	{ //4
	
		while ($data1 = mysql_fetch_array($result1))
		{ //5
		$tempat = $data1["tempat"];
		$tujuan = $data1["tujuan"];
		$tarikhpergi = $data1["tarikhpergi"];
		$tarikhpergii = convertdate($tarikhpergi);
		$tarikhpergiku = convertdate_mdy($tarikhpergi);
		$tarikhpulang = $data1["tarikhpulang"];
		$tarikhpulangg = convertdate($tarikhpulang);
		$tarikhpulangku = convertdate_mdy($tarikhpulang);
		$date1 = strtotime($tarikhpergiku);
		$date2 = strtotime($tarikhpulangku);
		$tempoh = count_days($date1,$date2);
		
		
		
		$query3 = "select description from ref_country where country_code = '$tempat'";
				$result3 = mysql_query($query3);
				
				if(!$result3) 
				{
				echo "Error2:";
				exit();
				}
				
				$data3 = mysql_fetch_array($result3);
				$tempat3 = $data3['description'];
	?>
        <tr>
          <td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0"><?php echo $tempat3;?></td>
              <td width="271" align="center" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0"><?php echo $tujuan;?></td>
              <td align="center" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0"><?php echo $tarikhpergii;?></td>
              <td width="138" align="center" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0"><?php echo $tarikhpulangg;?></td>
              <td align="center" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0"><?php echo $tempoh;?></td>
            </tr>
        <?php 
	 }// end while 5
} //4
 else
{ //6
?>
        <tr>
          <td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" colspan="5" align="center"> <strong>Data Tiada</strong></td>
    </tr>
        <?php
} // -6
?>
</table>
<?php
if ($role <> '')
{ //7
?>
<table width="979" border="0" align="center" cellpadding="5"  cellspacing="0" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0">
  <tr bgcolor="#DF7B7B">
    <td colspan="7" style="border-bottom: 1px solid #a4c8e0"><strong>Sejarah Permohonan</strong></td>
  </tr>
  <tr bgcolor="#C8E954">
    <td width="30" height = "25" align="center" bgcolor="#a4c8e0" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" ><strong>Bil.</strong></td>
    <td width="269" align="center" bgcolor="#a4c8e0" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" ><strong>Status</strong></td>
    <td width="27" align="center" bgcolor="#a4c8e0" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" ><strong>Cuti</strong></td>
	<td width="27" align="center" bgcolor="#a4c8e0" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" ><strong>Lengkap?</strong></td>
	<td width="260" align="center" bgcolor="#a4c8e0" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" ><strong>Catatan</strong></td>
    <td width="110" align="center" bgcolor="#a4c8e0" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" ><strong>Tarikh Kemaskini</strong></td>
	<td width="102" align="center" bgcolor="#a4c8e0" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" ><strong>Dikemaskini Oleh</strong></td>
  </tr>
<?php
// kes khas
$query1 = "select * from intrayhistory where idinfo='$ref' order by id";
$result1 = mysql_query($query1);
$bil = mysql_num_rows($result1);

for($i=0;$i<$bil;$i++)
{ //8
$row = mysql_fetch_array($result1);

$status = mysql_query("select * from intrayrefstatus where idstatus='$row[kodstatus]'");
$rowStatus = mysql_fetch_array($status);

?>

  <tr>
    <td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" align="center"><?php echo ($i+1);?>.</td>
    <td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0"><b><?php echo $rowStatus["descstatus"];?></b> - <?php if ($jenispermohonan == 'F0000001')
	{
	echo $rowStatus["tindakan_peribadi"];
	}
	else
	{
	echo $rowStatus["tindakan"];
	}?></td>
    <td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" align="center"><?php echo $row["cuti"]; ?></td>
	 <td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" align="center">
	 <?php echo $row["lengkap"];?></td>
	 <td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0"><?php echo $row["catatan"];?></td>
    <td align="center" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0"><?php echo $row["updateddate"]; ?></td>
    <td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0"><?php echo $row["updatedby"]; ?></td>
  </tr>
  <?php
} // 8
?>
</table></td></tr>
  <tr>
    <td colspan="3"></td>
  </tr>
</table>
<?php 
}  // 7
?>
  <table width="979" border="0" align="center" cellpadding="5"  cellspacing="0">
   <?php
   /*if ($jenispermohonan == 'F0000001')
   {
   		if ($waitingfor == $userid && $kodref1 == '10')
		{
		?>
		<tr bgcolor="#DF7B7B">
		<td colspan="3"><strong>PERIBADI  : Untuk Kelulusan : </strong></td>
		</tr>
		<tr>
		<td width="325">Keputusan  : </td>
		<td width="5">:</td>
		<td width="619"><input type="radio" name="sokong" value="Y" checked="checked"/>
		Lulus
		<input type="radio" name="sokong" value="T" />
		Tidak Lulus </td>
		</tr>
		<tr>
		<td>Catatan/Ulasan : </td>
		<td>:</td>
		<td><textarea name="catatan" rows="8" cols="35"></textarea></td>
		</tr>
		<?php
		}
	} */
//hanya urusan rasmi
 //else
 // {
  	if ($waitingfor == $userid)
	{
		if ($kodref1  == '10')
		{
		?>
		<tr bgcolor="#DF7B7B">
		<td colspan="3"><strong>RASMI / PERIBADI: Untuk disokong oleh Setiausaha Bahagian/ Ketua Jabatan : </strong></td>
		</tr>
		<tr>
		<td width="325">Keputusan SUB / Ketua Jabatan : </td>
		<td width="5">:</td>
		<td width="619"><input type="radio" name="sokong" value="Y" checked="checked"/>
		Sokong
		<input type="radio" name="sokong" value="T" />
		Tidak Sokong</td>
		</tr>
		<tr>
		<td>Catatan/Ulasan : </td>
		<td>:</td>
		<td><textarea name="catatan" rows="8" cols="35"></textarea></td>
		</tr>
		<?php
		}
		else if ($kodref1 == '20')
		{
		?>
		<tr bgcolor="#DF7B7B">
		<td colspan="3"><strong>RASMI / PERIBADI : Untuk disokong oleh Ketua Jabatan (Agensi) : </strong></td>
		</tr>
		<tr>
		<td width="325">Keputusan Ketua Jabatan (Agensi) : </td>
		<td width="5">:</td>
		<td width="619"><input type="radio" name="sokong" value="Y" checked="checked"/>
		Sokong
		<input type="radio" name="sokong" value="T" />
		Tidak Sokong</td>
		</tr>
		<tr>
		<td>Catatan/Ulasan : </td>
		<td>:</td>
		<td><textarea name="catatan" rows="8" cols="35"></textarea></td>
		</tr>
		<?php
		}
		else if ($kodref1 == '30')
		{
		?>
		<tr bgcolor="#DF7B7B">
		<td colspan="3"><strong>Untuk disemak oleh Admin PSM </strong></td>
		</tr>
		<tr>
		<td>Maklumat Lengkap</td>
		<td>:</td>
		<td><input type="radio" name="sokong" value="L" checked="checked"/>
		Lengkap
		<input type="radio" name="sokong" value="T" />
		Tidak Lengkap </td>
		</tr>
		<tr>
		<td>Permohonan Cuti Selesai</td>
		<td>:</td>
		<td><input type="radio" name="cuti" value="Y" checked="checked"/>
		Ya
		<input type="radio" name="cuti" value="T" />
		Tidak</td>
		</tr>
		<tr>
		<td valign="top">Catatan/Ulasan</td>
		<td>:</td>
		<td><textarea name="catatan" rows="8" cols="35"></textarea></td>
		</tr>
		<?php
		}
		else if ($kodref1 == '40')
		{
		?>
		<tr bgcolor="#DF7B7B">
		<td colspan="3"><strong>Untuk disemak oleh SUB PSM (Penyokong): </strong></td>
		</tr>
		<tr>
		<td>Keputusan PSM : </td>
		<td>:</td>
		<td><input type="radio" name="sokong" value="Y" checked="checked"/>
		Sokong
		<input type="radio" name="sokong" value="T" />
		Tidak Sokong</td>
		</tr>
		<tr>
		<td valign="top">Catatan/Ulasan : </td>
		<td>:</td>
		<td><textarea name="catatan" rows="8" cols="35"></textarea></td>
		</tr>
		<?php
		}
		else if ($kodref1 == '50')
		{
		?>
		<tr bgcolor="#DF7B7B">
		<td colspan="3"><strong>Untuk Kelulusan KSU/TKSU : </strong></td>
		</tr>
		<tr>
		<td>Keputusan KSU/TKSU : </td>
		<td>:</td>
		<td><input type="radio" name="sokong" value="Y" />
		Lulus
		<input type="radio" name="sokong" value="T" />
		Tidak Lulus </td>
		</tr>
		<tr>
		<td valign="top">Catatan/Ulasan : </td>
		<td>:</td>
		<td><textarea name="catatan" rows="8" cols="35"></textarea></td>
		</tr>
		<?php
		} //else 99
	}
//} // rasmi
?>
    <tr>
      <td></td>
      <td height = "25"></td>
      <td align="right">
	        <?php
			if($kodref1 == '90')
			{
			
			?>
	  <input type="button"  name="Submit" value="Cetak " onclick="window.open('print_all_rasmi.php')"/>
		  <?php
		  	}
		 
if ($waitingfor == $userid)
{
?>
	  <input type="submit" name="Submit_btn" value=" Hantar " />
      <input type="submit" name="reset" value="  Reset  " />
	  <?php
}
	  ?>
	  </td>
    </tr>
 </table>
  <br /></td>
</tr>
</table>

	 <!-- entable besar -->  
	</td>
  </tr>
    <tr><td><br /></td></tr>
</table>
<?php
} // 1

if ($view2_btn && $ref)
{
?>
<table width="860" border="0" align="center" cellpadding="5"  cellspacing="0" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0">
  <tr bgcolor="#cc3333">
    <td colspan="6" style="border-bottom: 1px solid #a4c8e0"><strong>SEJARAH PERMOHONAN</strong></td>
  </tr>
  <tr bgcolor="#C8E954">
    <td width="30" height = "25" align="center" bgcolor="#DF7B7B" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" ><strong>Bil.</strong></td>
    <td width="269" align="center" bgcolor="#DF7B7B" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" ><strong>Status</strong></td>
    <td width="27" align="center" bgcolor="#DF7B7B" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" ><strong>Cuti</strong></td>
	<td width="260" align="center" bgcolor="#DF7B7B" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" ><strong>Catatan</strong></td>
    <td width="110" align="center" bgcolor="#DF7B7B" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" ><strong>Tarikh Kemaskini</strong></td>
	<td width="102" align="center" bgcolor="#DF7B7B" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" ><strong>Dikemaskini Oleh</strong></td>
  </tr>
<?php
// kes khas
$query1 = "select * from intrayhistory where idinfo='$ref' order by id";
$result1 = mysql_query($query1);
$bil = mysql_num_rows($result1);

for($i=0;$i<$bil;$i++)
{
$row = mysql_fetch_array($result1);

$status = mysql_query("select * from intrayrefstatus where idstatus='$row[kodstatus]'");
$rowStatus = mysql_fetch_array($status);

?>
<tr>
    <td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" align="center"><?php echo ($i+1);?>.</td>
    <td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0"><b><?php echo $rowStatus["descstatus"];?></b>-<?php echo $rowStatus["tindakan"];?></td>
    <td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" align="center"><?php echo $row["cuti"]; ?></td>
	 <td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0"><?php echo $row["catatan"];?></td>
    <td align="center" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0"><?php echo $row["updateddate"]; ?></td>
    <td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0"><?php echo $row["updatedby"]; ?></td>
  </tr>
  <?php

} 
?>

</table>
</td>
  </tr>
    <tr><td><br /></td></tr>
</table>
<?php
}
?>
<?php include "footer.php";?>
</body>
</form>
</html>
