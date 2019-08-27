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
<table width="860" border="0" align="center" cellpadding="5"  cellspacing="0" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0">
  <tr bgcolor="#cc3333">
    <td colspan="5" style="border-bottom: 1px solid #a4c8e0"><strong>KES KHAS : SENARAI KES KHAS ANDA</strong></td>
  </tr>
  <tr bgcolor="#C8E954">
    <td width="32" height="34" align="center" bgcolor="#DF7B7B" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" ><strong>Bil.</strong></td>
    <td width="300" align="center" bgcolor="#DF7B7B" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" ><strong>Nama </strong></td>
    <td width="323" align="center" bgcolor="#DF7B7B" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" ><strong>Sebab</strong></td>
	<td width="163" align="center" bgcolor="#DF7B7B" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" ><strong>Sudah Mohon ? </strong></td>
	</tr>
<?php
// kes khas
if ($role == '09')
{
$query1 = "select a.*, b.nama_pgw from intrayinfo a, intrayprofile b where substr(a.idinfo,1,1) = 'H' and a.userid = b.userid";
}
else
{
$query1 = "select a.*, b.nama_pgw from intrayinfo a, intrayprofile b where substr(a.idinfo,1,1) = 'K' and a.userid = b.userid";
}
$result1 = mysql_query($query1);

 	if(!$result1) 
	{
		echo "Error4:";
		exit();
	}
	  
$existmana = mysql_num_rows($result1);
if ($existmana > 0)
{
// loop kat sini
	$bil = 1;
	while ($data = mysql_fetch_array($result1))
	{
		$myidkhas = $data['idinfo'];
		$mydate = $data['tarikhpermohonan'];
		$mydate = convertdate($mydate);
		$catatankhas = $data['catatan_khas'];
		$mynamekhas = $data['nama_pgw'];
		$flag = $data['flag_khas'];


		if ($flag == 'Y')
		{
			$flag = 'Belum';
		}
		else
		{
			$flag = 'Ya';
		}
?>	

  <tr>
    <td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" align="center"><?php echo $bil;?>.</td>
    <td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0"><?php echo $mynamekhas?></td>
    <td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" align="center"><?php echo $catatankhas;?></td>
	<td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" align="center"><?php echo $flag;?></td>
</tr>
  <?php
	$bil = $bil +1;
	} // end while
} // enf exist
else
{
?>
  <tr>
    <td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" colspan="5" align="center"> <strong>Data Tiada</strong></td>
  </tr>
  <?php
}
?>
</table>
</td>
  </tr>
  <tr><td><br /></td></tr>
</table>
<?php include "footer.php";?>
</body>
</html>

