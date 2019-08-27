<?php
require ("_common/conn.php");
require ("_common/global.php");
require ("_common/session.php");
include "convertdate.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo SYSTEM_TITLE ?></title>
</head>
<link rel="stylesheet" href="css/main.css" type="text/css">
<body>
<!-- table besar --------------------------------------------------------------------------------------------------------------------------->
<table width="894" border="0" align="center" cellpadding="0"  cellspacing="0" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0">
<?php include "header.php";?>
<?php include "menumenu.php";?>
<tr><td><br /></td></tr>
<tr>
<td>
<!-- table tab -->
<form action="detail.php" method="post" name="form1">
<table width="999" border="0" align="center" cellpadding="5"  cellspacing="0" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0">
  <tr bgcolor="#CC3333">
    <td colspan="11" style="border-bottom: 1px solid #a4c8e0" height="25"><strong>My INBOX : <?php echo $userid;?> </strong></td>
  </tr>
  <tr>
    <td colspan="5" style="border-bottom: 1px solid #a4c8e0" bgcolor="#CC3333" height="25" align="center"><strong>[ <a href="inbox.php">URUSAN RASMI</a> ]</strong></td>
	<td colspan="5" style="border-bottom: 1px solid #a4c8e0" bgcolor="#CC9966" align="center"><strong>[ URUSAN PERIBADI ]</strong></td>
  </tr>
  <tr bgcolor="#DF7B7B">
    <td width="27" height="34" align="center" bgcolor="#DF7B7B" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" ><strong>Bil.</strong></td>
	<td width="22" align="center" bgcolor="#DF7B7B" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" >&nbsp;</td>
    <td width="179" align="center" bgcolor="#DF7B7B" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" ><strong>Nama</strong></td>
    <!--<td width="94" align="center" bgcolor="#DF7B7B" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" ><strong>Tujuan</strong></td>-->
    <td width="92" align="center" bgcolor="#DF7B7B" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" ><strong>Tarikh Permohonan </strong></td>
	<td width="81" align="center" bgcolor="#DF7B7B" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0"><strong><strong><strong>Bahagian / Jabatan</strong></strong></strong></td>
    <td width="105" align="center" bgcolor="#DF7B7B" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" ><strong>Status</strong></td>
	<td width="163" align="center" bgcolor="#DF7B7B" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" ><strong>Catatan</strong></td>
	<td align="center" bgcolor="#DF7B7B" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" ><strong>Untuk Tindakan</strong></td>
	<td align="center" bgcolor="#DF7B7B" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0">&nbsp;</td>
    </tr>
  <?php
  		$query = "select a.*, b.* from intrayinfo a, intraystatussemasa b, intrayprofile c where a.jenispermohonan = 'F0000001' AND (a.userid = '$userid' or b.waiting_for = '$userid') and a.idinfo = b.idinfo and a.userid = c.userid order by a.tarikhpermohonan desc";
		//echo $query;
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
		$myid = $datachild['idinfo'];
		$mydate = $datachild['tarikhpermohonan'];
		$mynameid = $datachild['userid'];
		$mystatus = $datachild['kodstatus'];
		$keputusan = $datachild['keputusan'];
		$mytujuan = $datachild['jenispermohonan'];
		$mycatatan = $datachild['catatan'];
		$mydate = convertdate($mydate);
		
		$tjuan = mysql_query("select descpermohonan from intrayreftujuan where jenispermohonan='$mytujuan'");
		$rowtujuan = mysql_fetch_array($tjuan);

// check nama
$query1 = "select a.nama_pgw, b.nick_desc as jabatan from intrayprofile a, intrayrefjabatan b where a.jabatan=b.kod_jbtn and a.userid = '$mynameid'";
$result1 = mysql_query($query1);
 	if(!$result1) 
	{
		echo "Error1:";
		exit();
	}
	$data1 = mysql_fetch_array($result1);
	$myname = $data1['nama_pgw'];
	$myjabatan = $data1['jabatan'];
	
// ref status
$query2 = "select * from intrayrefstatus where idstatus = '$mystatus'";
$result2 = mysql_query($query2);

 	if(!$result2) 
	{
		echo "Error2:";
		exit();
	}
	$data2 = mysql_fetch_array($result2);
	$idstatus = $data2['idstatus'];
	$mystatusdesc = $data2['descstatus'];
	$mytindakan = $data2['tindakan'];
	
	
	/*if ($mytujuan == 'F0000001')
	{
		$mytindakan = $data2['tindakan_peribadi'];
	}
	else
	{
		$mytindakan = $data2['tindakan'];
	}*/
?>
  <tr>
    <td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" align="center"><?php echo $bil;?>.</td>
	<?php if ($mystatus == '30' && $keputusan == 'T' || $mystatus == '99') 
	{
	?>
	<td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" align="center">&nbsp;</td>
	<?php
	}
	else
	{
	?>
	<td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" align="center"><input type="radio" name="ref" value="<?php echo $myid;?>" /></td>
	<?php 
	}
	?>
    <td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0"><?php echo $myname;?></td>
    <!--<td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" align="center"><?php echo $rowtujuan["descpermohonan"];?></td>-->
    <td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" align="center"><?php echo $mydate;?></td>
	 <td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" align="center"><?php echo $myjabatan;?></td>
    <td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" align="center"><?php 
			if ($mystatus == '90' && $mainkod != NULL)
			 {
				echo 'Kelulusan KP Selesai';
			}
			 else
			 {
				echo $mystatusdesc;
			}
			?></td>
	 <td width="163" align="center" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0"><?php echo $mycatatan;?></td>
	 <td width="97" align="center" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0"><?php if ($mystatus == '30' && $keputusan == 'T')
	 {
	 	echo "Maklumat Tidak Lengkap";
	 }
	  else if ($mystatus == '20' && $mainkod != NULL)
	 {
	 	echo 'Untuk Kelulusan Pelulus - KP';
	}
	 else
	 {
	 	echo $mytindakan;
	}
	?></td>
<td width="37" align="center" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0">
<?php
// check balik 14/6______________________________________________________________________________________________________
if (($mystatus == '10' && $role == '') || ($role == '03'))
{
?>
 <a href="detail_delete.php?ref=<?php echo $myid?>"><img src="images/delete.jpg" width="30" height="27" border="0" title="Hapus Rekod Ini"></a>
<?php
}
else if ($mystatus == '30' && $keputusan == 'T')
{
	if ($mytujuan == 'F0000001')
	{
		$url = 'oversea_trasmi_update.php';
	}
	else
	{
		$url = 'oversea_edit_rasmi.php';
	}
?>
<a href="<?php echo $url;?>?idinfo=<?php echo $myid?>"><img src="images/pencil.jpg" width="23" height="23" border="0" title="Kemaskini Maklumat Semula" /></a>
<?php
}
?></td>	
  </tr>
 <?php
	$bil = $bil +1;
	}
	?>
	<tr>
    <td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" colspan="10" align="right">
	<input type="submit" name="view_btn" value=" Papar Maklumat " />	</td>
</tr>
	<?php
}
else
{
?>
  <tr>
    <td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" colspan="11" align="center"> <strong>Data Tiada</strong></td>
  </tr>
  <?php
}
?>
</table>
</form>
<br />
<?php // cehck balik jugak 8/5 penting---------------------------------------------------------
/*if (($role == '01')||($role == '02') ||($role == '05'))
{*/
// kes khas
$query1 = "select * from intrayinfo where userid = '$userid' and flag_khas = 'Y'";
$result1 = mysql_query($query1);

 	if(!$result1) 
	{
		echo "Error4:";
		exit();
	}
	  
$existmana = mysql_num_rows($result1);
if ($existmana > 0)
{
?>
<form action="syarat.php" method="post" name="FORM2">
<table width="877" border="0" align="center" cellpadding="5"  cellspacing="0" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0">
  <tr bgcolor="#cc3333">
    <td colspan="3" style="border-bottom: 1px solid #a4c8e0"><strong>KES KHAS : SENARAI KES KHAS ANDA </strong></td>
  </tr>
  <tr bgcolor="#C8E954">
    <td width="34" height="34" align="center" bgcolor="#DF7B7B" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" ><strong>Bil.</strong></td>
    <td width="551" align="center" bgcolor="#DF7B7B" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" ><strong>No Kes </strong></td>
    <td width="260" align="center" bgcolor="#DF7B7B" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" ><strong>Tarikh</strong></td>
	</tr>
<?php
// loop kat sini
	$bil = 1;
	while ($data = mysql_fetch_array($result1))
	{
		$myidkhas = $data['idinfo'];
		$mydate = $data['tarikhpermohonan'];

?>	
<tr>
    <td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" align="center"><?php echo $bil;?>.</td>
    <td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0"><a href="syarat.php?khas=<?php echo $myidkhas?>"><?php echo $myidkhas?></a></td>
    <td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" align="center"><?php echo $mydate;?></td>
</tr>
  <?php
	$bil = $bil +1;
	} // end while
	?>
	<tr>
    <td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" colspan="3" align="right">
	<input type="submit" name="view2_btn" value=" Papar Maklumat " />
	</td>
</tr>
	<?PHP
} // enf exist
?>
</table>
</form>
<?php 
//} // end khas
?>
<!-- entable besar --></td>
  </tr>
  <tr><td><br /></td></tr>
</table>
<?php include "footer.php";?>
</body>
</html>

