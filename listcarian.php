<?php
require ("_common/conn.php");
require ("_common/global.php");
require ("_common/session.php");
include "convertdate.php";
$currentyear = date('Y');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo SYSTEM_TITLE ?></title></head>
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
<table width="801" border="0" align="center" cellpadding="5"  cellspacing="0" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0">
  <tr bgcolor="#cc3333">
    <td colspan="7" style="border-bottom: 1px solid #a4c8e0"><strong>KEPUTUSAN CARIAN</strong></td>
  </tr>
  <tr bgcolor="#C8E954">
    <td width="35" height="34" align="center" bgcolor="#DF7B7B" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" ><strong>Bil</strong></td>
	<td width="22" align="center" bgcolor="#DF7B7B" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" >&nbsp;</td>
    <td width="244" align="center" bgcolor="#DF7B7B" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" ><strong>Nama</strong></td>
    <td width="147" align="center" bgcolor="#DF7B7B" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" ><strong>Tarikh Permohonan </strong></td>
	<td width="114" align="center" bgcolor="#DF7B7B" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0"><strong><strong><strong>Bahagian / Jabatan</strong></strong></strong></td>
    <td width="177" align="center" bgcolor="#DF7B7B" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" ><strong>Status</strong></td>
	
  </tr>
<?php
$query = "select intrayinfo.*,intraystatussemasa.*,intrayprofile.*,intrayrefjabatan.nick_desc as jabatan from intrayinfo,intraystatussemasa,intrayprofile,intrayrefjabatan where intrayprofile.jabatan=intrayrefjabatan.kod_jbtn and intrayinfo.idinfo=intraystatussemasa.idinfo and intrayinfo.userid=intrayprofile.userid";

if($_POST['tarikh']!="semuatarikh")
{
	$tmula = explode("/",$_POST['tarikhmula']);
	$tmula1 = $tmula[2]."-".$tmula[1]."-".$tmula[0];
	$thingga = explode("/",$_POST['tarikhhingga']);
	$thingga1 = $thingga[2]."-".$thingga[1]."-".$thingga[0];
	
	$date = "intrayinfo.".$_POST['tarikh'] ." > "."'".$tmula1."'"." and intrayinfo.".$_POST['tarikh'] ." < "."'".$thingga1."'";
	
	if($_POST['nama'] and !$_POST['tujuan'] and !$_POST['status']){
	$query=$query." and intrayprofile.userid like '%$_POST[nama]%' and ".$date;
	}
	if($_POST['nama'] and $_POST['tujuan'] and !$_POST['status']){
	$query=$query." and intrayprofile.userid like '%$_POST[nama]%' and intrayinfo.jenispermohonan = '$_POST[tujuan]' and ".$date;
	}
	if($_POST['nama'] and !$_POST['tujuan'] and $_POST['status']){
	$query=$query." and intrayprofile.userid like '%$_POST[nama]%' and intraystatussemasa.kodstatus = '$_POST[status]' and ".$date;
	}
	if($_POST['nama'] and $_POST['tujuan'] and $_POST['status']){
	$query=$query." and intrayprofile.userid like '%$_POST[nama]%' and intrayinfo.jenispermohonan = '$_POST[tujuan]' and intraystatussemasa.kodstatus = '$_POST[status]' and ".$date;
	}
	if(!$_POST['nama'] and $_POST['tujuan'] and $_POST['status']){
	$query=$query." and intrayinfo.jenispermohonan = '$_POST[tujuan]' and intraystatussemasa.kodstatus = '$_POST[status]' and ".$date;
	}
	if(!$_POST['nama'] and !$_POST['tujuan'] and $_POST['status']){
	$query=$query." and intraystatussemasa.kodstatus = '$_POST[status]' and ".$date;
	}
	if(!$_POST['nama'] and $_POST['tujuan'] and !$_POST['status']){
	$query=$query." and intrayinfo.jenispermohonan = '$_POST[tujuan]' and ".$date;
	}
	
	if($_POST['tarikh'] and !$_POST['nama'] and !$_POST['tujuan'] and !$_POST['status']){
	$query=$query." and ".$date;
	}
	
}

//------------------------------------------------ DATE ------------------------------------------------------------------

if($_POST['tarikh']=="semuatarikh")
{
	if($_POST['nama'] and !$_POST['tujuan'] and !$_POST['status']){
	$query=$query." and intrayprofile.userid like '%$_POST[nama]%'";
	}
	if($_POST['nama'] and $_POST['tujuan'] and !$_POST['status']){
	$query=$query." and intrayprofile.userid like '%$_POST[nama]%' and intrayinfo.jenispermohonan = '$_POST[tujuan]'";
	}
	if($_POST['nama'] and !$_POST['tujuan'] and $_POST['status']){
	$query=$query." and intrayprofile.userid like '%$_POST[nama]%' and intraystatussemasa.kodstatus = '$_POST[status]'";
	}
	if($_POST['nama'] and $_POST['tujuan'] and $_POST['status']){
	$query=$query." and intrayprofile.userid like '%$_POST[nama]%' and intrayinfo.jenispermohonan = '$_POST[tujuan]' and intraystatussemasa.kodstatus = '$_POST[status]'";
	}
	if(!$_POST['nama'] and $_POST['tujuan'] and $_POST['status']){
	$query=$query." and intrayinfo.jenispermohonan = '$_POST[tujuan]' and intraystatussemasa.kodstatus = '$_POST[status]'";
	}
	if(!$_POST['nama'] and !$_POST['tujuan'] and $_POST['status']){
	$query=$query." and intraystatussemasa.kodstatus = '$_POST[status]'";
	}
	if(!$_POST['nama'] and $_POST['tujuan'] and !$_POST['status']){
	$query=$query." and intrayinfo.jenispermohonan = '$_POST[tujuan]'";
	}
}

if($role == '01')
	{
		$query = $query . " and intrayprofile.jabatan = '$offcode'";
	}
	else
	{
		$query = $query . " ";
	}
$result = mysql_query($query);
 	if(!$result) 
	{
		echo "Error:";
		exit();
	}
		  
$existke = mysql_num_rows($result);

if ($existke > 0){
	for($i=0;$i<$existke;$i++){
		$row = mysql_fetch_array($result);
	//	echo $row['userid'];
		
$profile = mysql_query("select * from intrayprofile where userid='$row[userid]'");
$rowProfile = mysql_fetch_array($profile);

$status = mysql_query("select * from intrayrefstatus where idstatus='$row[kodstatus]'");
$rowStatus = mysql_fetch_array($status);

?>
  <tr>
    <td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" align="center"><?php echo ($i+1);?></td>
	<td align="center" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0"><input type="radio" name="ref" value="<?php echo $row["idinfo"];?>"></td>
    <td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0"><?php echo $rowProfile["nama_pgw"];?></td>
    <td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" align="center"><?php echo $row["tarikhpermohonan"];?></td>
	 <td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" align="center"><?php echo $row["jabatan"];?> </td>
    <td align="center" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0"><b><?php echo $rowStatus["descstatus"];?></b>-<?php echo $rowStatus["tindakan"];?> </td>
	
  </tr>
  <?php
} //end for
?>
<tr>
    <td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" colspan="6" align="right">
	<?php
	if ($role == '03' || $role == '04' || $role == '09') //admin PSM, SUB PSM, ADMIN Agensi
	{
	?>
	<input type="submit" name="view_btn" value=" Papar Maklumat " />
	<?php
	}
	?>
	<input type="submit" name="view2_btn" value=" Sejarah Maklumat " />
	</td>
</tr>
<?php
}
else
{
?>
  <tr>
    <td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" colspan="7" align="center"> Data Tiada </td>
  </tr>
  <?php
}
?>
</table>
</form>
<!-- entable besar --></td>
  </tr>
  <tr><td><br /></td></tr>
</table>
<?php include "footer.php";?>
</body>
</html>

