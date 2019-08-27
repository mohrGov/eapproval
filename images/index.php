<?
require ("_common/global.php");
include "convertdate.php";
include "current_date.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script language="JavaScript" src="my.js">
</script>
<style type="text/css">
<!--
.style1 {font-size: 12px}
-->
</style>
</head>
<SCRIPT LANGUAGE="JavaScript">
<!-- Original:  Keith Swerling (keiths@topixonline.com) -->
<!-- Web Site:  http://www.TopiXonline.com -->

<!-- This script and many more are available free online at -->
<!-- The JavaScript Source!! http://javascript.internet.com -->

<!-- Begin
ScrollSpeed = 200;
ScrollChars = 1;

function ScrollMarquee() {
window.setTimeout('ScrollMarquee()', ScrollSpeed);
var msg = document.scrollform.box.value;
document.scrollform.box.value = msg.substring(ScrollChars) + msg.substring(0, ScrollChars);
}
//  End -->
</script>

<title><?php echo SYSTEM_TITLE ?></title></head>
<link rel="stylesheet" href="css/main.css" type="text/css">

<body>
<!-- table besar --------------------------------------------------------------------------------------------------------------------------->
<table width="1035" border="0" align="center" cellpadding="0"  cellspacing="0" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0">
<? include "header.php";?>
<tr><td width="1033"><br /></td></tr>
<tr>
<td>
<!-- table tab -->
<table width="973" border="0" align="center" cellpadding="5"  cellspacing="0" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0">
<tr bgcolor="#a4c8e0">
<td height="30" colspan="3" bgcolor="#cc3333"><strong>Login masuk sistem : </strong></td>
</tr>
<tr>
<td width="448" align="left">

<form action="ldap_bind.php" method="post" name="loginform">

<table width="363" border="0" align="center" cellpadding="5"  cellspacing="0" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0">
  <tr bgcolor="#DF7B7B">
    <td height="30" colspan="7" style="border-bottom: 1px solid #a4c8e0"><strong>Login</strong></td>
  </tr>
  <tr>
    <td colspan="2">Sila gunakan katanama dan katalaluan tuan/puan : </td>
  </tr>
  <tr>
    <td width="120" height="30">Userid : </td>
    <td width="221"><input name="login1" type="text" id="login1" size="25" /></td>
  </tr>
  <tr>
    <td>Katalaluan : </td>
    <td><input name="passwd" type="password" id="password" size="25" /></td>
  </tr>
  <!--<tr>
          <td height="34"></td>
          <td align="left"><a href="getkLalauan.php">Lupa Kata Laluan ?</a></td>
        </tr>-->
  <tr>
    <td height="34"></td>
    <td align="right"><input type="submit" name="Submit" value="  Log In  " />
        <input type="reset" name="reset" value="  Reset  " /></td>
  </tr>
  <tr>
    <td height="34" align="right"><img src="images/user.png" /></td>
    <td><a href="pengguna_luar.php">Daftar akaun agensi luar KSM</a></td>
  </tr>
</table>
</form>


</td>
        <td width="503" align="left" valign="top"><marquee behavior="scroll" scrollamount="1" direction="up"  ONMOUSEOVER="this.stop();"
            ONMOUSEOUT="this.start();">
        <span class="style1">
		<img src="images/Perspective-Button-Stop-icon.png" width="16" height="16" /> Sistem  Ini Adalah Bagi Pendaftaran Permohonan Dan Proses Kelulusan Ke Luar Negara.<br />
		<br />
		<img src="images/Perspective-Button-Stop-icon.png" width="16" height="16" /> Sistem Ini Dibangunkan Berasaskan Web, Oleh Itu Ia Mudah Dicapai Dimana-mana Jua. <br /> 
		<br />
		<img src="images/Perspective-Button-Stop-icon.png" width="16" height="16" /> Log Masuk Adalah  Menggunakan Id Dan Katalaluan Seperti Email Rasmi <br /> 
		<br />
		</span>
        </marquee></td>
</table>
<br />
  <br /></td>
<td width="483">&nbsp;</td>
</tr>
</table>

	 <!-- entable besar -->  
	</td>
  </tr>
    <tr><td><br /></td></tr>
</table>
<? include "footer.php";?>
</body>
</html>

<iframe name="gToday:normal:agenda.js" id="gToday:normal:agenda.js"
src="ipopeng.php" scrolling="no" frameborder="0"
style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>