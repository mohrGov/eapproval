<?php
require ("_common/conn.php");
require ("_common/global.php");
require ("_common/session.php");
include "convertdate.php";

$idinfo = (isset($_POST['ref'])) ? mysql_real_escape_string(trim($_POST['ref'])) : '';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?phpphp echo SYSTEM_TITLE ?></title>
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
<table width="860" border="0" align="center" cellpadding="5"  cellspacing="0" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0">
  <tr bgcolor="#cc3333">
    <td colspan="6" style="border-bottom: 1px solid #a4c8e0"><strong>SEJARAH PERMOHONAN</strong></td>
  </tr>
  <tr bgcolor="#C8E954">
    <td width="30" height="34" align="center" bgcolor="#DF7B7B" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" ><strong>Bil.</strong></td>
    <td width="269" align="center" bgcolor="#DF7B7B" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" ><strong>Status</strong></td>
    <td width="27" align="center" bgcolor="#DF7B7B" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" ><strong>Cuti</strong></td>
	<td width="260" align="center" bgcolor="#DF7B7B" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" ><strong>Catatan</strong></td>
    <td width="110" align="center" bgcolor="#DF7B7B" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" ><strong>Tarikh Kemaskini</strong></td>
	<td width="102" align="center" bgcolor="#DF7B7B" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" ><strong>Dikemaskini Oleh</strong></td>
  </tr>
<?php
// kes khas
$query1 = "select * from intrayhistory where idinfo='$idinfo' order by id";
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
<?php include "footer.php";?>
</body>
</html>

