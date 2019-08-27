<?php
require ("_common/conn.php");
require ("_common/global.php");
require ("_common/session.php");
include "convertdate.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script>
function Get_item()
{
  document.form1.action="carian.php?tarikh=<?php echo $tarikh?>";
  document.form1.method="post";
  document.form1.submit();
/** 
var val1=document.fcomposite_d.jnsrumah.value ;
var val2=document.fcomposite_d.LOKASI.value ;
var val3=document.fcomposite_d.bayaran.value ;
var val4=document.fcomposite_d.jnspohon.value ;
self.location='fcomposite_d.php?jnsrumah=' + val1+ '&LOKASI=' + val2 + '&bayaran=' + val3 + '&jnspohon=' + val4;
**/
}


</script>

<script>
   function disp_text()
   {
   index = document.form1.tarikh.selectedIndex; 
   var selected_sektor = document.form1.tarikh.options[index].value;
   //alert(selected_sektor);
   //document.bhg1.action="maklumat.php?sektor=<?php echo $sektor?>";
   document.form1.action="carian.php?action=reload&tarikh="+selected_sektor;
   document.form1.method="post";
   document.form1.submit();

   }
   window.onload = function(){
   }
</script>






<?php
	if (isset( $_POST[ 'tarikh' ] )) {$tarikh = mysql_real_escape_string($_POST["tarikh"]);}
?>
</head>
<title><?php echo SYSTEM_TITLE ?></title>
<link rel="stylesheet" href="css/main.css" type="text/css">

<form action="listcarian.php" method="post"  name="form1">

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
<table width="1000" border="0" align="center" cellpadding="0"  cellspacing="0" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0">
<?php include "header.php";?>
<?php include "menumenu.php";?>
<tr><td width="1033"><br /></td></tr>
<tr>
<td>
<!-- table tab -->
<table width="900" border="0" align="center" cellpadding="5"  cellspacing="0" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0">
  <tr bgcolor="#a4c8e0">
    <td width="961" height="30" bgcolor="#cc3333"><strong>Carian maklumat kelulusan luar negeri </strong></td>
  </tr>
  <tr>
    <td height="30">
      <table width="670" border="0" cellpadding="5" cellspacing="0" align="center">
        <tr bgcolor="#DF7B7B">
          <td height="25" colspan="3" style="border-bottom: 1px solid #000000; border-right: 1px solid #000000; border-left: 1px solid #000000; border-top: 1px solid #000000"><strong>Sila masukkan kata kunci carian tuan/puan.</strong> </td>
        </tr>
		<!--<tr bgcolor="#e1e1e1">
    <td width="225" height="45" style="border-bottom: 1px solid #000000; border-left: 1px solid #000000">Jabatan</td>
    <td width="5"style="border-bottom: 1px solid #000000; border-left: 1px solid #000000">:</td>
    <td width="717" style="border-bottom: 1px solid #000000; border-right: 1px solid #000000;border-left: 1px solid #000000">
	<?php
	if ($role <> '03')
	{
		echo $offcode;
	}
	else
	{
	?>
	<select name="jbtn" id="jbtn">
      <option value=""><< Sila Pilih >></option>
      <?php
	   $gen = mysql_query("select * from intrayrefjabatan order by kod_jbtn");
	   $bilgen = mysql_num_rows($gen);
	   for($ig=0;$ig < $bilgen;$ig++){
	   	$datagen = mysql_fetch_array($gen);
	   	echo'<option value="'.$datagen["kod_jbtn"].'" >'.$datagen["nama_jbtn"].'</option>';
	   }
	   ?>
    </select>
	<?php
	}
	?></td>
  </tr>-->
        <tr bgcolor="#e1e1e1">
          <td width="155" height="30" style="border-bottom: 1px solid #000000; border-left: 1px solid #000000">Nama Pemohon </td>
          <td width="10" style="border-bottom: 1px solid #000000; border-left: 1px solid #000000">:</td>
          <td width="455" style="border-bottom: 1px solid #000000; border-right: 1px solid #000000; border-left: 1px solid #000000"><input name="nama" type="text" id="nama" size="50" /></td>
        </tr>
		<tr bgcolor="#e1e1e1">
          <td height="30" style="border-bottom: 1px solid #000000; border-left: 1px solid #000000">Tarikh</td>
          <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000">:</td>
          <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000; border-left: 1px solid #000000">
		  <select name="tarikh" id="tarikh" onchange="Get_item()">
		  	<?php if($tarikh=='semuatarikh')
			{
			?>
			<option value="semuatarikh" selected>Semua Tarikh</option>
            <option value="tarikhpermohonan">Tarikh Permohonan</option>
            <option value="tarikhpergi">Tarikh Pergi</option>
            <option value="tarikhpulang">Tarikh Pulang</option>
			<?php
			}
			else if($tarikh=='tarikhpermohonan')
			{
			?>
			<option value="semuatarikh">Semua Tarikh</option>
            <option value="tarikhpermohonan" selected>Tarikh Permohonan</option>
            <option value="tarikhpergi">Tarikh Pergi</option>
            <option value="tarikhpulang">Tarikh Pulang</option>
			<?php
			}
			else if($tarikh=='tarikhpergi')
			{
			?>
           <option value="semuatarikh">Semua Tarikh</option>
            <option value="tarikhpermohonan" >Tarikh Permohonan</option>
            <option value="tarikhpergi" selected>Tarikh Pergi</option>
            <option value="tarikhpulang">Tarikh Pulang</option>
			<?php
			}
			else if($tarikh=='tarikhpulang')
			{
			?>
            <option value="semuatarikh">Semua Tarikh</option>
            <option value="tarikhpermohonan">Tarikh Permohonan</option>
            <option value="tarikhpergi">Tarikh Pergi</option>
            <option value="tarikhpulang" selected>Tarikh Pulang</option>
			<?php
			}
			else
			{
			?>
			<option value="semuatarikh">Semua Tarikh</option>
            <option value="tarikhpermohonan">Tarikh Permohonan</option>
            <option value="tarikhpergi">Tarikh Pergi</option>
            <option value="tarikhpulang">Tarikh Pulang</option>
			<?php
			}
			?>
          </select>
		  <?php if($tarikh!='semuatarikh')
		  {
		  if(isset($_POST['tarikh'])){
		  ?>
            <input name="tarikhmula" type="text" id="tarikhmula" size="12" />
            <a onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.tarikhmula);return false;" href="javascript:void(0)"> <img src="images/calendr4.gif" alt="" width="21" height="20" border="0" /></a> hingga
            <input name="tarikhhingga" type="text" id="tarikhhingga" size="12" />
            <a onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.tarikhhingga);return false;" href="javascript:void(0)"> <img src="images/calendr4.gif" alt="" width="21" height="20" border="0" /></a>
			<?php
			}
			}
			?>			</td>
        </tr>
        <tr bgcolor="#e1e1e1">
          <td height="30" style="border-bottom: 1px solid #000000; border-left: 1px solid #000000">Jenis Permohonan </td>
          <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000">:</td>
          <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000; border-left: 1px solid #000000">
   <select name="tujuan" id="tujuan">
   <option value="">Pelbagai Tujuan</option>
   <?php //jenis permohonan
  $jenisPermohonan = mysql_query("select * from intrayreftujuan");
  $bilJenis = mysql_num_rows($jenisPermohonan);

		  for($i=0;$i<$bilJenis;$i++) {
		  $dataJenis = mysql_fetch_array($jenisPermohonan);
		  ?>
              <option value="<?php echo $dataJenis["jenispermohonan"]; ?>"><?php echo $dataJenis["descpermohonan"]; ?></option>
          <?php } ?>
            </select>            </td>
        </tr>
        <!--<tr bgcolor="#e1e1e1">
          <td height="30" style="border-bottom: 1px solid #000000; border-left: 1px solid #000000">Status</td>
          <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000">:</td>
          <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000; border-left: 1px solid #000000">
          <select name="status" id="status">
           <option value="">Pelbagai Status</option>
   <?php //jenis status
  $jenisStatus = mysql_query("select * from intrayrefstatus");
  $bilStatus = mysql_num_rows($jenisStatus);

		  for($i2=0;$i2<$bilStatus;$i2++) {
		  $dataStatus = mysql_fetch_array($jenisStatus);
		  ?>
            <option value="<?php echo $dataStatus["idstatus"]; ?>">
              <?php echo $dataStatus["descstatus"]; ?> ( <?php echo $dataStatus["tindakan"]; ?>)              </option>
            <?php } ?>
          </select></td>
        </tr>-->
        <tr>
          <td align="right" colspan="3"><input type="submit" name="cari_btn" value="    Cari    " />
              <input type="reset" name="reset" value="  Reset  " />          </td>
        </tr>
        <tr>
          <td align="right" colspan="3">&nbsp;</td>
        </tr>
      </table>
      
    </td>
  </tr>
</table>
<!-- entable besar -->  
	</td>
  </tr>
    <tr><td><br /></td></tr>
</table>
<?php include "footer.php";?>
</body>
</form>
</html>

<iframe name="gToday:normal:agenda.js" id="gToday:normal:agenda.js"
src="ipopeng.php" scrolling="no" frameborder="0"
style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>
