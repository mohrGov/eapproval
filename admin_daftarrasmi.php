<?php
require ("_common/conn.php");
require ("_common/global.php");
require ("_common/session.php");
include "convertdate.php";
include "current_date.php";

$query = "select * from intrayprofile where userid = '$userid'";
$result = mysql_query($query);
$existke = mysql_num_rows($result);

	while ($data = mysql_fetch_array($result))
	{
		$nama_pgw = $data['nama_pgw'];
		//$nokp = $data['nokp'];
		//$jawatan = $data['jawatan'];
	}
	$query = "select * from intrayinfo where userid = '$userid'";
	$result = mysql_query($query);
	$existke = mysql_num_rows($result);

	while ($data = mysql_fetch_array($result))
	{
		$nama_pgw = $data['nama_pgw'];
		//$nokp = $data['nokp'];
		//$jawatan = $data['jawatan'];
	}
	
	date('Y', $time); 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo SYSTEM_TITLE ?></title>
<style type="text/css">
<!--
.style1 {color: #FF0000}
-->
</style>
</head>
<link rel="stylesheet" href="css/main.css" type="text/css">
<form action="proadmin_daftarrasmi.php" method="post" name="rasmi" enctype="multipart/form-data">
<body>
<?php
	if(strlen($alertMsgDesc)>0):
		echo '<div id="alertMsg" style="width: 300px; position: absolute; top: 250px; right: 50px; border: 1px solid red; background-color: #E2F3A9; padding: 20px; font: 12px Arial; color: #990000;">';
		echo $alertMsgDesc;
		if(sizeof($alertMsg)>0) {
			echo '<ul>';
			foreach($alertMsg as $msgItem) {
				echo '<li>';
				if(strlen($msgItem[0])>0) echo '<a href="#" onclick="document.mof.'.$msgItem[1].'.focus();">';
				echo $msgItem[0];
				if(strlen($msgItem[0])>0) echo '</a>';
				echo '</li>';
			}
			echo '</ul>';
		}
		echo '<div style="text-align: right;"><span onclick="closeAlertMsg();" style="cursor: pointer; text-decoration: underline;">Tutup</span></div>';
		echo '</div>';
	endif;
?> 
<!-- table besar --------------------------------------------------------------------------------------------------------------------------->
<table width="1035" border="0" align="center" cellpadding="0"  cellspacing="0" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0">
<?php include "header.php";?>
<?php include "menumenu.php";?>

<tr>
<td height="746">
<br />
<!-- table tab -->
<table width="973" border="0" align="center" cellpadding="5"  cellspacing="0" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0">
<tr bgcolor="#a4c8e0">
<td width="961" height="30" bgcolor="#cc3333"><strong>Permohonan Lawatan Ke Luar Negeri<?=$dari;?></strong></td>
</tr>
<tr>
<td height="710"><table width="813" border="0" align="center" cellpadding="5"  cellspacing="0" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0">
<tr bgcolor="#DF7B7B">
  <td height="30" colspan="8" bgcolor="#DF7B7B" style="border-bottom: 1px solid #a4c8e0"><strong>Di atas Urusan Rasmi</strong></td>
</tr>
<tr bgcolor="#DF7B7B">
  <td height="30" colspan="8" style="border-bottom: 1px solid #a4c8e0"><strong>Maklumat Pemohon</strong></td>
</tr>
<tr bgcolor="#DF7B7B">
  <td height="29" bgcolor="#FFFFFF">Userid / Email</td>
  <td bgcolor="#FFFFFF">:</td>
  <td height="30" colspan="6" bgcolor="#FFFFFF"><input name="user" type="text" id="user" size="40" maxlength="100" /></td>
  </tr>
<tr>
  <td height="29" bgcolor="#FFFFFF">Nama</td>
  <td>:</td>
  <td><input name="namapeg" type="text" id="namapeg" size="50" maxlength="100" /></td>
</tr>
<tr>
  <td height="29" bgcolor="#FFFFFF">Jabatan/Pejabat</td>
  <td>:</td>
  <td><select name="jabatan" id="jabatan">
    <option value="" ></option>
    <?php
	   $gen = mysql_query("select * from intrayrefjabatan order by kod_jbtn");
	   $bilgen = mysql_num_rows($gen);
	   for($ig=0;$ig < $bilgen;$ig++){
	   	$datagen = mysql_fetch_array($gen);
	   	echo'<option value="'.$datagen["kod_jbtn"].'" >'.$datagen["nama_jbtn"].'</option>';
	   }
	   ?>
  </select></td>
</tr>
<tr>
  <td height="45">Nama Persidangan/Seminar/
  Lawatan Rasmi <span class="style1">*</span> </td>
  <td>:</td>
  <td><input name="nama" type="text" id="nama" size="70" maxlength="100" /></td>
</tr>
<tr>
  <td>Tujuan <span class="style1">*</span></td>
  <td>:</td>
        <td><label>
        <input name="tujuan" type="text" id="tujuan" size="70" maxlength="100" />
        </label></td>
</tr>
      <tr>
        <td width="263">Tempat Hendak Diadakan <span class="style1">*</span></td>
        <td width="5" height="30">:</td>
          <td width="613"><input name="tempat" type="text" id="tempat" size="50" /></td>
        </tr>
        <tr>
          <td>Tarikh Pergi<span class="style1"> * </span></td>
          <td height="30">:</td>
          <td><span class="style4">
            <input name="dari" type="text" id="dari" />
          <a onclick="if(self.gfPop)gfPop.fPopCalendar(document.rasmi.dari);return false;" href="javascript:void(0)"> <img src="images/calendar.png" width="24" height="24" border='0'/> </a></span></td>
          </tr>
        <tr>
          <td>Tarikh Pulang<span class="style1"> * </span></td>
          <td height="30">:</td>
          <td><span class="style4">
            <input name="pulang" type="text" id="pulang" />
          <a onclick="if(self.gfPop)gfPop.fPopCalendar(document.rasmi.pulang);return false;" href="javascript:void(0)"> <img src="images/calendar.png" width="24" height="24" border='0' /> </a></span></td>
          </tr>
        <tr>
          <td>Bilangan peserta </td>
          <td>:</td>
          <td><input name="bil" type="text" id="bil" size="4" maxlength="4" />            
            orang</td>
        </tr>
        <tr>
          <td>Nama Ketua</td>
          <td>:</td>
          <td><label></label>
            <input name="nama_ketua" type="text" id="nama_ketua" size="50" /></td>
        </tr>
        
        <tr>
          <td><div align="justify">Sebutkan samaada pegawai kedutaan Malaysia di negara tempat persidangan, seminar, lawatan rasmi itu diadakan akan menyertai persidangan, nyatakan mengapa kehadiran pegawai-pegawai daripada negara ini diperlukan </div></td>
          <td>:</td>
          <td><textarea name="duta" cols="50" rows="5" id="duta"></textarea></td>
        </tr>
        <tr>
          <td>Kekerapan Persidangan/Seminar/Lawatan Rasmi</td>
          <td>:</td>
          <td><input name="kekerapan" type="text" id="kekerapan" size="3" maxlength="3" /></td>
        </tr>
        <tr>
          <td>Perbelanjaan ditanggung oleh <span class="style1">*</span></td>
          <td height="29">:</td>
          <td><input name="belanja" type="text" id="belanja" size="50" /></td>
        </tr>
        <tr>
          <td>Faedah kepada negara <span class="style1">*</span></td>
          <td>:</td>
          <td><textarea name="faedah" cols="50" rows="5" id="faedah"></textarea></td>
        </tr>
        <tr>
          <td>Kelulusan Kementerian Dalam Negeri dan Kementerian Luar (Jika Persidangan/Seminar/Lawatan<br />
Rasmi itu diadakan di Negara Israel) </td>
          <td>:</td>
          <td><input name="kelulusan" type="text" id="kelulusan" size="70" maxlength="100" /></td>
        </tr>
		<tr>
          <td>Muat naik Surat Tawaran  <span class="style1">*</span></td>
          <td>:</td>
          <td><input type="file" name="surat" id="surat" /></td>
        </tr>
		<!--<tr>
          <td>Email Ketua Pejabat <span class="style1">*</span> </td>
          <td>:</td>
          <td><input name="email_kp" type="text" id="email_kp" size="50" maxlength="50" /></td>
		</tr>
		 <tr>
          <td height="34"></td>
          <td align="left"><a href="getkLalauan.php">Lupa Kata Laluan ?</a></td>
        </tr>-->
         <tr>
           <td></td>
           <td height="34"></td>
           <td align="right"><input name="submit_btn" type="submit" id="submit_btn" value=" Hantar  " />
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
    <tr><td height="180"><br /></td></tr>
</table>
<?php include "footer.php";?>
</body></form>
</html>

<iframe name="gToday:normal:agenda.js" id="gToday:normal:agenda.js"
src="ipopeng.php" scrolling="no" frameborder="0"
style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>