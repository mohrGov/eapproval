<?php
require ("_common/global.php");
include "convertdate.php";
include "current_date.php";

session_start();

if($_SESSION['userid']){
  header("Location:inbox.php");
}

$check = file_get_contents("http://ksmclan.mohr.gov.my/api/aduser/staff?ad_action=authentication&ad_uid=".$_GET['user_id']);
$data = json_decode($check);

$currentip = $_SERVER['REMOTE_ADDR'];

if($data->status == "success" && $data->online == 1 && $data->currentip == $currentip && in_array("EAP", $data->businesscategory)){
  header("Location:ldap_bind.php?user_id=".$_GET['user_id']);
}else{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script language="JavaScript" src="my.js">
</script>
<style type="text/css">

.style1 {font-size: 12px}
  .logo-kategori:hover{
    background:#dcdcdc; 
  }
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
<?php include "header.php";?>
<tr><td width="1033"><br /></td></tr>
<tr>
<td>
<!-- table tab -->
<table width="973" border="0" align="center" cellpadding="5"  cellspacing="0" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0">
<tr bgcolor="#a4c8e0">
<td height="30" colspan="3" bgcolor="#cc3333" style="color:#fff"><strong>Sila pilih kategori pengguna : </strong></td>
</tr>
<tr>
<td width="280" align="left">


<table width="250" border="0" align="center" cellpadding="5"  cellspacing="0">
  <tr >
    <td height="30" colspan="7">
      <a href='http://gerbang.mohr.gov.my'><img src='images/staff_mohr.png' width="100" class="logo-kategori"/></a>&nbsp;
      <a href='login.php'><img src='images/agensi.png' width="100" class="logo-kategori"/></a>
    </td>
  </tr>
</table>



</td>
        <td width="503" align="left" valign="top"><!--<marquee behavior="scroll" scrollamount="2" direction="up"  ONMOUSEOVER="this.stop();" ONMOUSEOUT="this.start();">
        <div align="justify"><span class="style1">
    <img src="images/Perspective-Button-Stop-icon.png" width="16" height="16" /><strong><span class="style3">Disebabkan sistem E-Approval mempunyai masalah longgokan emel kepada pengguna di Kementerian, sistem akan menutup penghantaran emel kepada penyokong dan pelulus. Pengguna perlu memaklumkan kepada Ketua Jabatan setelah memohon. Harap Maklum. </span><span class="style1"><br />
            </span></strong> --> 
          <p align="justify"><img src="images/Perspective-Button-Stop-icon.png" width="16" height="16" /> </span>Sistem  Ini Adalah Untuk Pendaftaran Permohonan Dan Proses Kelulusan Ke Luar Negara.<br />
              <br />
              <img src="images/Perspective-Button-Stop-icon.png" width="16" height="16" /> Sistem Ini Dibangunkan Berasaskan Web, Oleh Itu Ia Mudah Dicapai Dimana-mana. <br /> 
              <br />
              <img src="images/Perspective-Button-Stop-icon.png" width="16" height="16" /> Log Masuk Adalah  Menggunakan Userid Dan Katalaluan <strong> LDAP </strong><br /> 
              <br />
            <img src="images/Perspective-Button-Stop-icon.png" width="16" height="16" /> Sebarang Masalah Berkenaan Userid dan Kata laluan, Boleh Hubungi Terus Meja bantu KSM di talian <strong>03-8886 5177 atau 03-8886 5202</strong><br /> 
              <br />
            <img src="images/Perspective-Button-Stop-icon.png" width="16" height="16" />Untuk <strong>KETUA JABATAN SAHAJA, PERMOHONAN RASMI </strong> adalah secara <strong>MANUAL</strong>, manakala bagi permohonan peribadi adalah melaui eapproval</p>
          <p align="justify"><img src="images/terkini.gif" width="50" height="11" /> Harap maklum bahawa perkhidmatan sistem eapproval akan <strong> TERGENDALA </strong> sementara&nbsp;bagi tujuan penyelenggaraan bermula 7hb Feb 2017 (6.00 Petang) sehingga 8hb Feb 2017 (10.00 Pagi). <br /> 
              <br />
                      <strong><span class="style1"><br />
                              </span></strong>        
              </div>
            </p>
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
<?php include "footer.php";?>
</body>
</html>

<iframe name="gToday:normal:agenda.js" id="gToday:normal:agenda.js"
src="ipopeng.php" scrolling="no" frameborder="0"
style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>
<?php
}

?>