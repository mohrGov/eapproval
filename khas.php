<?php
require ("_common/conn.php");
require ("_common/session.php");
require ("_common/global.php");
include "convertdate.php";
include "current_date.php";

$ref = (isset($_GET['ref'])) ? mysql_real_escape_string(trim($_GET['ref'])) : '';

$_SESSION["ref"] = "$ref";

$query = "select * from intrayinfo where idinfo = '$ref'";
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
		$mynameid = $datachild['userid'];
		$mydate = convertdate($mydate);
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
</head>
<title><?php echo SYSTEM_TITLE ?></title></head>
<link rel="stylesheet" href="css/main.css" type="text/css">
<form action="prokhas.php" method="post" name="mof">
<body>
<!-- table besar --------------------------------------------------------------------------------------------------------------------------->
<table width="1035" border="0" align="center" cellpadding="0"  cellspacing="0" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0">
<?php include "header.php";?>
<?php include "menumenu.php";?>
<tr><td width="1033"><br /></td></tr>
<tr>
<td>
<!-- table tab -->
<table width="1012" border="0" align="center" cellpadding="5"  cellspacing="0" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0">
<tr bgcolor="#a4c8e0">
<td width="980" height="30" bgcolor="#cc3333"><strong>Permohonan Lawatan Ke Luar Negeri : <?=$userid . $role;?></strong></td>
</tr>
<tr>
<td><table width="979" border="0" align="center" cellpadding="5"  cellspacing="0" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0">
  <tr bgcolor="#DF7B7B">
    <td height="30" colspan="8" style="border-bottom: 1px solid #a4c8e0"><strong>Kes - Kes Khas </strong></td>
  </tr>
  <tr>
    <td width="225" height="45">Userid Pegawai </td>
    <td width="5">:</td>
    <td width="717"><input type="text" name="useridkhas" value="" /></td>
  </tr>
  <tr>
    <td width="225" height="45">Dibenarkan memohon </td>
    <td width="5">:</td>
    <td width="717"><input type="radio" name="khas" value="Y" checked="checked"/>
        Ya
          <input type="radio" name="khas" value="N" />
        Tidak</td>
  </tr>
  <tr>
    <td valign="top">Ulasan bagi kes khas ini  : </td>
    <td valign="top">:</td>
    <td><textarea name="catatankhas" rows="8" cols="35"></textarea></td>
  </tr>
  <tr>
    <td></td>
    <td height="34"></td>
    <td align="right"><input type="submit" name="Submit_btn" value=" Hantar " />
        <input type="submit" name="reset" value="  Reset  " /></td>
  </tr>
   <tr>
    <td height="34" colspan="3"><table border="0" cellpadding="5" cellspacing="0" width="330">
    </table></td>
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
<?php include "footer.php";?>
</body></form>
</html>

<iframe name="gToday:normal:agenda.js" id="gToday:normal:agenda.js"
src="ipopeng.php" scrolling="no" frameborder="0"
style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>