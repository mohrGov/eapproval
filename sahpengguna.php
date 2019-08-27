<?php
//menu nih hanya agensi jer dapat
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
<form action="sahkanpengguna.php" name="formpengguna" method="post">
<!-- table besar --------------------------------------------------------------------------------------------------------------------------->
<table width="894" border="0" align="center" cellpadding="0"  cellspacing="0" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0">
<?php include "header.php";?>
<?php include "menumenu.php";?>
<tr><td><br /></td></tr>
<tr>
<td>
<table width="860" border="0" align="center" cellpadding="5"  cellspacing="0" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0">
  <tr bgcolor="#cc3333">
    <td colspan="6" style="border-bottom: 1px solid #a4c8e0"><strong>SENARAI PENGGUNA LUAR YANG MENDAFTAR </strong></td>
  </tr>
  <tr bgcolor="#C8E954">
    <td width="28" height="34" align="center" bgcolor="#DF7B7B" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" ><strong>Bil.</strong></td>
	<td width="23" height="34" align="center" bgcolor="#DF7B7B" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" >&nbsp;</td>
    <td width="263" align="center" bgcolor="#DF7B7B" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" ><strong>Nama </strong></td>
    <td width="253" align="center" bgcolor="#DF7B7B" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" ><strong>Jabatan</strong></td>
	<td width="102" align="center" bgcolor="#DF7B7B" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" ><strong>Jawatan </strong></td>
    <td width="129" align="center" bgcolor="#DF7B7B" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" ><strong>Tarikh Mohon </strong></td>
	</tr>
<?php
// sahkan kes
$query1 = "select * from intraytempuserluar where flagsah = 'N' and jabatan = '$offcode' order by tarikhmohon desc";
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
		$jabatanluar = $data['jabatan'];
		$jawatanluar = $data['jawatan'];
		$tarikhmohon = $data['tarikhmohon'];
		$tarikhmohon = convertdate($tarikhmohon);
		
		$query3 = "select * from intrayrefjawatan where kod_jwtn = '$jawatanluar'";
		$result3 = mysql_query($query3);
		
		if(!$result3) 
		{
		echo "Error2:";
		exit();
		}
		
		$data3 = mysql_fetch_array($result3);
		$jawatanluarn = $data3['nama_jwtn'];
	?>	

  <tr>
    <td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" align="center"><?php echo $bil;?>.</td>
	<td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" align="center"><input type="checkbox" name="namebaru[]" value="<?php echo $katanama?>" /></td>
    <td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0"><?php echo $katanama?></td>
    <td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" align="center"><?php echo $jabatanluar?></td>
	 <td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" align="center"><?php echo $jawatanluarn?></td>
    <td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" align="center"><?php echo $tarikhmohon;?></td>
</tr>
  <?php
	$bil = $bil +1;
	} // end while
?>
<tr>
    <td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" colspan="6" align="right"><input type="submit" name="Submit_btn" value=" Sahkan " /></td>
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

