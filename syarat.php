<?php
require ("_common/conn.php");
require ("_common/global.php");
require ("_common/session.php");
include "convertdate.php";
include "current_date.php";
session_start();

$khas = (isset($_GET['khas'])) ? mysql_real_escape_string(trim($_GET['khas'])) : '';

$_SESSION["khas"] = "$khas";
//destroy session tugas
$_SESSION["tugas"] = "";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
</head>
<title><?php echo SYSTEM_TITLE ?></title></head>
<link rel="stylesheet" href="css/main.css" type="text/css">
<body>
 
<!-- table besar --------------------------------------------------------------------------------------------------------------------------->
<table width="1035" border="0" align="center" cellpadding="0"  cellspacing="0" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0">
<?php include "header.php";?>
<?php include "menumenu.php";?>
<tr><td width="1033"><br /></td></tr>
<tr>
<td><form action="personal.php"  method="post" name="intray">
<!-- table tab -->
<table width="973" border="0" align="center" cellpadding="5" cellspacing="0" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0">
<tr bgcolor="#a4c8e0">
<td width="961" height="30" bgcolor="#cc3333"><strong>Syarat - syarat Permohonan Lawatan Ke Luar Negeri </strong></td>
</tr>
<tr>
<td><table width="717" border="0" align="center" cellpadding="5"  cellspacing="0" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0">
<tr bgcolor="#DF7B7B">
<td colspan="2"><strong>Perakuan Pemohon : Sila baca dan fahamkan syarat-syarat dibawah.</strong>
</td>
</tr>
<tr>
  <td width="20">1.</td>
  <td width="601">Permohonan mestilah dilakukan <strong>2 minggu </strong>sebelum tarikh pergi ke luar negara</td>
 </tr>
 <tr>
  <td width="20">2.</td>
  <td width="601">Pemohon mestilah membuat permohonan cuti dahulu sebelum borang ini diisi.</td>
 </tr>
  <tr>
  <td width="20">3.</td>
  <td width="601">Bagi urusan <strong>RASMI</strong>, surat kelulusan mestilah diperolehi dahulu dari PSM sebelum permohonan ini diisi.</td>
 </tr>
 <tr>
  <td width="20">4.</td>
  <td width="601">Semua maklumat yg diberikan adalah benar. Dan saya bertanggungjawab atas maklumat yang diberikan.</td>
 </tr>
 <tr>
  <td width="20">5.</td>
  <td width="601">Saya dengan ini mematuhi segala peraturan yang ditetapkan di perenggan<strong> 6 (i),(ii) dan perenggan 10</strong> Surat Pekeliling Am Bilangan Tahun 2012.</td>
 </tr>
 <tr>
  <td width="20"></td>
  <td width="601"><input type="checkbox" name="setuju" value="Y" />    
     Ya, Saya faham segala syarat-syarat diatas </td>
 </tr>

		   <tr>
          	<td align="right" colspan="2"><input type="submit" name="Submit2" value=" Hantar " />
            <input type="reset" name="reset" value="  Reset  " /></td>
         </tr>
         <tr>
           <td colspan="23"><table border="0" cellpadding="5" cellspacing="0" width="330">

           </table></td>
          </tr>
</table>
<br /></td>
</tr>
</table>
</form>
	 <!-- entable besar -->  
	</td>
  </tr>
    <tr><td><br /></td></tr>
</table>
<?php include "footer.php";?>
</body>
</html>
