<?php
require ("_common/conn.php");
require ("_common/global.php");
require ("_common/session.php");

$Submit_btn = (isset($_POST['Submit_btn'])) ? mysql_real_escape_string(trim($_POST['Submit_btn'])) : '';
$jbtn = (isset($_POST['jbtn'])) ? mysql_real_escape_string(trim($_POST['jbtn'])) : '';
$rolebaru = (isset($_POST['rolebaru'])) ? mysql_real_escape_string(trim($_POST['rolebaru'])) : '';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo SYSTEM_TITLE ?></title></head>
<link rel="stylesheet" href="css/main.css" type="text/css">
<body>
<form action="usermgmt2.php" name="formpengguna" method="post">
<!-- table besar --------------------------------------------------------------------------------------------------------------------------->
<table width="894" border="0" align="center" cellpadding="0"  cellspacing="0" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0">
<?php include "header.php";?>
<?php include "menumenu.php";?>
<tr><td><br /></td></tr>
<tr>
<td>
<table width="860" border="0" align="center" cellpadding="5"  cellspacing="0" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0">
  <tr bgcolor="#cc3333">
    <td colspan="6" style="border-bottom: 1px solid #a4c8e0" height="30"><strong>SENARAI PENGGUNA :</strong></td>
  </tr>
  <tr bgcolor="#C8E954">
    <td width="27" height="34" align="center" bgcolor="#DF7B7B" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" ><strong>Bil.</strong></td>
	<td width="27" height="34" align="center" bgcolor="#DF7B7B" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" >&nbsp;</td>
	<td width="260" align="center" bgcolor="#DF7B7B" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" ><strong>Nama</strong></td>
    <td width="173" align="center" bgcolor="#DF7B7B" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" ><strong>Jabatan</strong></td>
	<td width="169" align="center" bgcolor="#DF7B7B" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" ><strong>Jawatan </strong></td>
    <td width="142" align="center" bgcolor="#DF7B7B" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" ><strong>Peranan</strong></td>
	</tr>
<?php
$query1 = "select distinct a.userid, a.role, b.nama_pgw, b.jabatan, b.jawatan from intrayusers a, intrayprofile b";
//kalau jabatan & role 
if ($jbtn && $rolebaru)
{
	$query1 .= " where a.userid = b.userid and b.jabatan = '$jbtn' and a.role = '$rolebaru'";
}
else if ($jbtn)
{
	$query1 .= " where a.userid = b.userid and b.jabatan = '$jbtn'";
}
else if ($rolebaru)
{
	$query1 .= " where a.userid = b.userid and b.jabatan = '$offcode' and a.role = '$rolebaru'";
}
else // kalau tak pilih apa -apa
{
	$query1 .= " where a.userid = b.userid";
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
		$katanama = $data['userid'];
		$mynama = $data['nama_pgw'];
		$myrole = $data['role'];
		$jawatan = $data['jawatan'];
		$jabatan = $data['jabatan'];
//ref role

$query2 = "select descrole from intrayrefrole where idrole = '$myrole'";
$result2 = mysql_query($query2);

 	if(!$result2) 
	{
		echo "Error2:";
		exit();
	}

$data2 = mysql_fetch_array($result2);
$mydescrole = $data2['descrole'];
?>	
  <tr>
    <td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" align="center"><?php echo $bil;?>.</td>
	<td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" align="center"><input type="radio" name="kn" value="<?php echo $katanama?>" /></td>

	<td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0"><?php echo $mynama;?></a></td>
    <td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" align="center"><?php echo $jabatan?></td>
	 <td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" align="center"><?php echo $jawatan?></td>
    <td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" align="center"><?php echo $mydescrole;?>
	</td>
</tr>
  <?php
	$bil = $bil +1;
	} // end while
	?>
	<tr>
    <td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" colspan="6" align="right"><input type="submit" name="view_btn" value=" Kemaskini Maklumat " /></td>
</tr>
	<?php
} // enf exist
else
{
?>
  <tr>
    <td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" colspan="6" align="center"> <strong>Data Tiada</strong></td>
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
</form>
</body>
</html>

