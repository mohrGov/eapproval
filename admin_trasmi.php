<?php
require ("_common/conn.php");
require ("_common/global.php");
require ("_common/session.php");
///require ("_common/timeout.php");
include "convertdate.php";
include "current_date.php";
include "calculateDay.php";


	$query = "select * from intrayprofile where userid = '$userid'";
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
</head>
<title><?php echo SYSTEM_TITLE ?></title>
<link rel="stylesheet" href="css/main.css" type="text/css">
<form action="proadmin_trasmiadd.php" method="post" name="rasmi">
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
<td>
<!-- table tab -->
<br />
<table width="973" border="0" align="center" cellpadding="5"  cellspacing="0" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0">
<tr bgcolor="#a4c8e0">
<td width="961" height="30" bgcolor="#cc3333"><strong>Permohonan Lawatan Ke Luar Negeri </strong></td>
</tr>
<tr>
<td><br />
  <table width="761" border="0" align="center" cellpadding="5"  cellspacing="0" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0">
    <tr bgcolor="#DF7B7B">
      <td height="30" colspan="5" style="border-bottom: 1px solid #a4c8e0"><strong>Di atas Urusan Persendirian</strong></td>
    </tr>
    <tr>
      <td height="29" bgcolor="#FF9999"><strong>Maklumat Pemohon </strong></td>
      <td bgcolor="#FF9999">&nbsp;</td>
      <td bgcolor="#FF9999">&nbsp;</td>
    </tr>
    <tr>
      <td height="29">Userid / Email</td>
      <td>:</td>
      <td><input name="user" type="text" id="user" size="40" maxlength="100" /></td>
    </tr>
    <tr bgcolor="#FF9999">
      <td height="29" bgcolor="#FFFFFF">Nama</td>
      <td bgcolor="#FFFFFF">:</td>
      <td bgcolor="#FFFFFF"><input name="namapeg" type="text" id="namapeg" size="50" maxlength="100" /></td>
      </tr>
    <tr bgcolor="#FF9999">
      <td height="29" bgcolor="#FFFFFF">Jabatan/Pejabat</td>
      <td bgcolor="#FFFFFF">:</td>
      <td bgcolor="#FFFFFF"><select name="jabatan" id="jabatan">
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
    <tr bgcolor="#FF9999">
      <td height="29" bgcolor="#FF9999"><strong>Maklumat Lawatan </strong></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="45">Negara yang hendak dilawati </td>
      <td>:</td>
      <td><input name="neg_lawat" type="text" id="neg_lawat" size="50" /></td>
    </tr>
   
    <tr>
      <td width="148">Tujuan</td>
      <td width="3" height="30">:</td>
      <td width="475"><input name="tujuan" type="text" id="tujuan" size="50" /></td>
    </tr>
    <tr>
      <td>Tarikh Pergi<span class="style1"></span></td>
      <td height="30">:</td>
      <td><span class="style4">
        <input name="dari" type="text" id="dari" />
      <a onclick="if(self.gfPop)gfPop.fPopCalendar(document.rasmi.dari);return false;" href="javascript:void(0)"> <img src="images/calendar.png" width="24" height="24" /> </a></span></td>
      </tr>
    <tr>
      <td>Tarikh Pulang<span class="style1"></span></td>
      <td height="30">:</td>
      <td><span class="style4">
        <input name="pulang" type="text" id="pulang" />
      <a onclick="if(self.gfPop)gfPop.fPopCalendar(document.rasmi.pulang);return false;" href="javascript:void(0)"> <img src="images/calendar.png" width="24" height="24" /> </a></span></td>
      </tr>
    <tr>
      <td>Jumlah Perbelanjaan Yang Dijangka </td>
      <td>:</td>
      <td><input name="rm_dijangka" type="text" id="rm_dijangka" size="50" /></td>
    </tr>
    <tr>
      <td>Punca Perbelanjaan </td>
      <td>:</td>
      <td><input name="punca" type="text" id="punca" size="50" /></td>
    </tr>
    <tr>
      <td>Kelayakan Cuti </td>
      <td>:</td>
      <td><input name="klykn_cuti" type="text" id="klykn_cuti" size="50" /></td>
    </tr>
    <!--<tr bgcolor="#FF9999">
      <td><b>Email Ketua Jabatan</b> </td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Alamat Email Ketua Jabatan </td>
      <td>:</td>
      <td><input name="email_kp" type="text" id="email_kp" size="50" /></td>
    </tr>-->
    <?php
		  $query = "SELECT count( idinfo ) AS xrasmi,YEAR(tarikhpermohonan) as tahun_ini
			FROM intrayinfo WHERE jenispermohonan = 'F0000001' and YEAR(curdate())=YEAR(tarikhpermohonan) and userid = '$userid'";
			$result = mysql_query($query);
			$existke = mysql_num_rows($result);

			while ($data = mysql_fetch_array($result))
			{
				$jum_thnini = $data['xrasmi'];
		
			}
		  
		  ?>
    <tr>
      <td colspan="3">&nbsp;</td>
      </tr>
    <!--<tr>
          <td height="34"></td>
          <td align="left"><a href="getkLalauan.php">Lupa Kata Laluan ?</a></td>
        </tr>-->
    <tr>
      <td></td>
      <td height="34"></td>
      <td align="right"><input type="submit" name="Submit" value=" Hantar  " />
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
