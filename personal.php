<?php
require ("_common/conn.php");
require ("_common/global.php");
require ("_common/session.php");
require ("_common/timeout.php");
include "convertdate.php";

if(isset($_POST['Submit2'])){ // value dr previous form
if($_POST['setuju']!='Y'){
	echo'<script language="JavaScript">
	alert("Sila tick pada syarat sebelum memilih permohonan");
	window.location="syarat.php";
	</script>';
}
}

$query = "select * from intrayprofile where userid = '$userid'";
$result = mysql_query($query);

 	if(!$result) 
	{
		echo "Error:";
		exit();
	}
		  
$existke = mysql_num_rows($result);

if ($existke)
{
	$bil = 1;
	while ($datachild = mysql_fetch_array($result))
	{
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
		}
}

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
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
</head>
<title><?php echo SYSTEM_TITLE ?></title>
<link rel="stylesheet" href="css/main.css" type="text/css">
<form action="personaladd.php" method="post" name="mof">
<body>
<!-- table besar --------------------------------------------------------------------------------------------------------------------------->
<table width="850" border="0" align="center" cellpadding="0" cellspacing="0" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0">
<?php include "header.php";?>
<?php include "menumenu.php";?>
<tr><td width="1033"><br /></td></tr>
<tr>
<td>
<!-- table tab -->
<table width="955" border="0" align="center" cellpadding="5"  cellspacing="0" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0">
<tr bgcolor="#a4c8e0">
<td width="940" height="30" bgcolor="#cc3333"><strong>Permohonan Lawatan Ke Luar Negeri </strong></td>
</tr>
<tr>
<td>
<table width="979" border="0" align="center" cellpadding="0" cellspacing="0" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0">
  <tr>
    <td><table width="100%" border="0" align="center" cellpadding="5"  cellspacing="0">
      <tr bgcolor="#DF7B7B">
        <td height="30" colspan="8" style="border-bottom: 1px solid #a4c8e0"><strong>Profail Pegawai : <?php echo $userid;?></strong></td>
      </tr>
      <tr>
        <td height="45">Nama </td>
        <td>:</td>
        <td><?php echo $myname;?></td>
        <td width="139">Tarikh Lantikan</td>
        <td width="10" height="30">:</td>
        <td width="191"><?php echo $tarikhlantikan?></td>
      </tr>
      <tr>
        <td width="255">Jawatan </td>
        <td width="5">:</td>
        <td width="319"><?php echo $myjawatandesc . " - " . $gredjwtn;?></td>
        <td>Gaji Sekarang </td>
        <td>:</td>
        <td>RM
          <?php echo $gaji?></td>
      </tr>
      <tr> </tr>
      <tr>
        <td>Jabatan/Pejabat</td>
        <td>:</td>
        <td><?php echo $myjabatandesc?><br/><?php echo $mypejabat?></td>
      </tr>
      <tr> </tr>
      <tr>
        <td>Status Perkahwinan </td>
        <td>:</td>
        <td><?php echo $statusdesc?></td>
        <td>Tanggungan (bilangan anak / tanggunggan)</td>
        <td>:</td>
        <td><?php echo $tanggungan?></td>
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
            <li>Jika bekerja, Nyatakan jawatan isteri /suami </li>
        </ul></td>
        <td>:</td>
        <td><?php echo $jawpasangan; ?></td>
      </tr>
      <tr>
        <td><ul>
            <li>Jabatan / Pejabat </li>
        </ul></td>
        <td>:</td>
        <td><?php echo $opispasangan?></td>
      </tr>
      <?php } ?>
	   <tr>
        <td colspan="6" align="right"><input type="submit" value="Teruskan Permohonan" name="edit_btn" /></td>
        </tr>
    </table>
</td>
</tr>
</table>
 <!-- entable besar -->  
	</td>
  </tr>
    <tr><td><br /></td></tr>
</table>
<?php include "footer.php";?>
</body></form>
</html>

<iframe name="gToday:normal:agenda.js" id="gToday:normal:agenda.js"
src="ipopeng.php" scrolling="no" frameborder="0"
style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>