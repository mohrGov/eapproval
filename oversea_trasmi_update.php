<?php
require ("_common/conn.php");
require ("_common/global.php");
require ("_common/session.php");
///require ("_common/timeout.php");
include "convertdate.php";
include "current_date.php";
include "calculateDay.php";

$queryp = "select jabatan from intrayprofile where userid = '$userid'";
$resultp = mysql_query($queryp);

while ($datap = mysql_fetch_array($resultp))
{
	$jabatan = $datap['jabatan'];
}



$ref = (isset($_GET['idinfo'])) ? mysql_real_escape_string(trim($_GET['idinfo'])) : '';
$tugas = 'K';

$_SESSION["ref"] = "$ref";
$_SESSION["tugas"] = "$tugas";

$query = "select a.*, b.* from intrayinfo a, intrayprofile b where a.idinfo = '$ref' and a.userid = b.userid ";
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
		//lawatan
		$tujuan = $datachild['tujuan'];
		$neg_lawat = $datachild['tempat'];
		$tarikh_mula = $datachild['tarikhpergi'];
		$tarikh_mula = convertdate($tarikh_mula);
		$tarikh_tmt = $datachild['tarikhpulang'];
		$tarikh_tmt = convertdate($tarikh_tmt);
		$punca = $datachild['belanja'];
		$nilai_perbelanjaan = $datachild['nilai_perbelanjaan'];
		$kelayakancuti = $datachild['kelayakan_cuti'];
		$nama_pgw = $datachild['nama_pgw'];
		$nokp = $datachild['nokp'];
		$jawatan = $datachild['jawatan'];
		$tkh_lantikan = $datachild['tkh_lantikan'];
		$tkh_lantikan=convertdate($tkh_lantikan);
		$jabatan = $datachild['jabatan'];
		$gaji_skrg = $datachild['gaji_skrg'];
		$email	 = $datachild['email'];
		$s_kahwin = $datachild['status_perkahwinan'];
		$n_psgn	 = $datachild['nama_psgn'];
		$jwtn_psgn	 = $datachild['jwtn_psgn'];
		$jbtn_psgn	 = $datachild['jbtn_psgn'];
		$tggugan	 = $datachild['tanggungan'];
    
    //insurans
    $insurans= $datachild['insurans'];

		
		//tambah 26/1/2017 - arahan TKSUO
		$koslawatan = $datachild['kos_lawatan'];
		$biayaioleh = $datachild['biayai_oleh'];
		$ahli_rombongan = $datachild['ahli_rombongan'];
		
		//counday
		$dari = convertdate_back($tarikhpergi);
		$hingga = convertdate_back($tarikhpulang);
	
		$tarikhpergiku = convertdate_mdy($dari);
		$tarikhpulangnya = convertdate_mdy($hingga);
		$date1 = strtotime($tarikhpergiku);
		$date2 = strtotime($tarikhpulangnya);
		$tempohlawatan = count_days($date1,$date2);
		
		
$belanja = explode(".", $gaji_skrg);
$ringgit = $belanja[0]; // piece1
$sen = $belanja[1]; // piece2

// awin tutup	
/*$belanja = explode(".", $nilai_perbelanjaan);
$ringgit=$belanja[0]; // piece1
$sen=$belanja[1]; // piece2 */


	}
}

$query1 = "select b.userid from intrayprofile a, intrayusers b where a.jabatan = '$jabatan' and b.role = '05' and a.userid = b.userid";
	$result1 = mysql_query($query1);
	
	while ($data1 = mysql_fetch_array($result1))
	{
		$emailketuajabatan = $data1['userid'];
	}

	date('Y', $time); 
	
	//////////////kawin ??
if(isset($_POST['s_kahwin'])){
$s_kahwin=$_POST['s_kahwin'];
} else { 
$s_kahwin=$s_kahwin;
}

$querysk = "select * from intrayrefstatusperkahwinan where kodkahwin = '$s_kahwin'";
$result = mysql_query($querysk);
$existke = mysql_num_rows($result);

if ($existke > 0)
{
	
	while ($data = mysql_fetch_array($result))
	{
		$desckahwin = $data['desckahwin'];

}
}
//////////////////// jabatan //////////////
$queryj = "select * from intrayrefjabatan where kod_jbtn = '$jabatan'";
$result = mysql_query($queryj);
$existke = mysql_num_rows($result);

if ($existke > 0)
{
	
	while ($data = mysql_fetch_array($result))
	{
		$nama_jbtn = $data['nama_jbtn'];

}
}
//////////////////// jabatan //////////////
$queryj = "select * from intrayrefjawatan where kod_jwtn = '$jawatan'";
$result = mysql_query($queryj);
$existke = mysql_num_rows($result);

if ($existke > 0)
{
	
	while ($data = mysql_fetch_array($result))
	{
		$nama_jwtn = $data['nama_jwtn'];
		$gred = $data['gred'];


} 
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo SYSTEM_TITLE ?></title>
</head>
<link rel="stylesheet" href="css/main.css" type="text/css">
<form action="oversea_trasmiupd.php" method="post" name="intray" enctype="multipart/form-data">
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
<!-- table besar -->
<table width="1035" border="0" align="center" cellpadding="0"  cellspacing="0" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0">
<?php include "header.php";?>
<?php include "menumenu.php";?>
<tr><td width="1033"><br /></td></tr>
<tr>
<td>
<!-- table tab -->
<table width="973" border="0" align="center" cellpadding="5"  cellspacing="0" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0">
<tr bgcolor="#a4c8e0">
<td width="961" height="30" bgcolor="#cc3333"><strong>Kemaskini Maklumat Lawatan Di atas Urusan Persendirian</strong></td>
</tr>
<tr>
<td><br />
  <table width="761" border="0" align="center" cellpadding="5"  cellspacing="0" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0">
    <tr bgcolor="#DF7B7B">
<td height="30" colspan="8" style="border-bottom: 1px solid #a4c8e0"><strong>Maklumat Pegawai </strong></td>
</tr>
<tr bgcolor="#DF7B7B">
<td height="30" colspan="8" bgcolor="#FFFFFF" style="border-bottom: 1px solid #a4c8e0"><div align="justify"><span class="style2">** </span><strong>Perhatian:</strong> Pegawai dan Kakitangan Perlu Memastikan Profail Peribadi Ini <strong>Mengandungi Maklumat Terkini</strong>. Kegagalan Untuk Mengemaskini Maklumat Profail, Boleh Menyebabkan Permohonan Anda Tidak Diluluskan. </div></td>
</tr>
<tr>
  <td height="33">Userid</td>
  <td>:</td>
  <td><?php echo $userid;?></td>
</tr>
<tr>
  <td height="33">No. Kad Pengenalan<span class="style1">*</span></td>
  <td>:</td>
  <td><input name="nokp" type="text" id="nokp" value="<?php echo $nokp?>" size="12" maxlength="12"/>
  [cth: 820104240378] </td>
</tr>
<tr>
  <td height="33">Nama Penuh <span class="style1">*</span> </td>
  <td>:</td>
  <td><input name="nama_pgw" type="text" id="nama_pgw" size="50" value="<?php echo $nama_pgw?>" /></td>
</tr>
<tr>
  <td>Jawatan <span class="style1">*</span> </td>
  <td>:</td>
        <td>          <select name="jwtn" id="jwtn"> 
		<option value="<?php echo $jawatan; ?>" > <?php echo $nama_jwtn;?> </option>
       <?php
	   $gen = mysql_query("select * from intrayrefjawatan order by kod_jwtn");
	   $bilgen = mysql_num_rows($gen);
	   for($ig=0;$ig < $bilgen;$ig++){
	   	$datagen = mysql_fetch_array($gen);
	   	echo'<option value="'.$datagen["kod_jwtn"].'" >'.$datagen["nama_jwtn"]."-".$datagen["gred"].'</option>';
	   }
	   ?>
    </select>
          </select></td>
</tr>
      <tr>
        <td width="162">Tarikh Lantikan <span class="style1">*</span></td>
        <td width="3" height="30">:</td>
          <td width="446"><span class="style4">
            <input name="tkh_lantikan" type="text" id="tkh_lantikan" value="<?php echo $tkh_lantikan;?>"  readonly=true />
            <a onclick="if(self.gfPop)gfPop.fPopCalendar(document.intray.tkh_lantikan);return false;" href="javascript:void(0)"> <img src="images/calendar.png" width="24" height="24" border='0'/> </a></span></td>
        </tr>
        <tr>
          <td>Jabatan/Pejabat <span class="style1">*</span></td>
          <td>:</td>
          <td><select name="jbtn" id="jbtn">
            <option value="<?php echo $jabatan; ?>" > <?php echo $nama_jbtn;?> </option>
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
      <td>Gaji Sekarang (RM) </td>
      <td>:</td>
      <td>RM
        <input name="rm" type="text" id="rm" value="<?php echo $ringgit;?>" size="7" maxlength="7" />
        :
        <input name="sen" type="text" id="sen" value="<?php echo $sen?>" size="7" maxlength="7" /></td>
    </tr>
        <tr>
          <td><p>Alamat Email<span class="style1">*</span> </p></td>
          <td height="34">:</td>
          <td ><input name="email" type="text" size="50" value="<?php echo $email; ?>"/></td>
          </tr>
        <tr>
          <td>Status Perkahwinan <span class="style1">*</span></td>
          <td>:</td>
          <td><select name="s_kahwin" id="s_kahwin" onchange="disp_text()"  >
            <option value="<?php if(isset($_POST['s_kahwin'])){ echo $_POST['s_kahwin']; } else { echo $s_kahwin; }?>"><?php echo $desckahwin;?> </option>
            <?php
	   $gen = mysql_query("select * from intrayrefstatusperkahwinan order by kodkahwin");
	   $bilgen = mysql_num_rows($gen);
	   for($ig=0;$ig < $bilgen;$ig++){
	   	$datagen = mysql_fetch_array($gen);
	   	echo'<option value="'.$datagen["kodkahwin"].'" >'.$datagen["desckahwin"].'</option>';
	   }
	   ?>
          </select></td>
        </tr>
		  <?php 
	
	if ($_POST['s_kahwin']=='02' || $s_kahwin=='02')
	
	 { ?>
    
	    <tr>
        <td height="29" bgcolor="#FF9999" >   <strong>Maklumat Keluarga </strong></td>
          <td bgcolor="#FF9999">&nbsp;</td>
          <td bgcolor="#FF9999">&nbsp;</td>
          </tr>
        <tr>
          <td>Nama Isteri/Suami </td>
          <td>:</td>
          <td><input name="nama_psgn" type="text" id="nama_psgn" size="50" value="<?php echo $n_psgn?>" /></td>
        </tr>
        <tr>
          <td>Jika bekerja, nyatakan jawatan isteri /suami </td>
          <td>:</td>
          <td><input name="jwtn_psgn" type="text" id="jwtn_psgn" size="50" value="<?php echo $jwtn_psgn?>" /></td>
        </tr>
        <tr>
          <td>Jabatan / Pejabat </td>
          <td>:</td>
          <td><input name="jbtn_psgn" type="text" id="jbtn_psgn" size="50" value="<?php echo $jbtn_psgn?>"/></td>
        </tr><tr>
          <td>Tanggungan(bilangan anak / tanggunggan)</td>
          <td>:</td>
          <td><input name="bil_anak" type="text" id="bil_anak" size="20" value="<?php echo $tggugan?>"/></td>
        </tr>
		<?php
		}
		?>

   <tr bgcolor="#FF9999">
      <td height="29" bgcolor="#FF9999"><strong>Maklumat Lawatan </strong></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="45">Negara yang hendak dilawati </td>
      <td>:</td>
      <td><select name="neg_lawat" id="select">
          <option value="" > &lt;&lt; Sila Pilih Negara &gt;&gt; </option>
          <?php
			$query01= "SELECT country_code, description_en  FROM ref_country ORDER BY description_en ASC ";
										 // echo $query01;
										  $result02=mysql_query($query01);

                                          for ($row=0; $row<mysql_num_rows($result02); $row++)
                                          {
										  
                                          $values=mysql_fetch_array($result02);
                                          $kod = $values["country_code"];
                                         $nama = $values["description_en"];
										// $kod_kump = $values['kod_kumpulan'];
                                          if ($neg_lawat==$kod){
										  
                                          ?>
          <option value="<?php echo $kod ?>" selected="selected"><?php echo $nama ?></option>
          <?php
										  }else{
										  
                                          ?>
          <option value="<?php echo $kod ?>" ><?php echo $nama ?></option>
          <?php
										  }
                                          }
                                          ?>
        </select></td>
    </tr>
    <tr>
      <td>Tarikh dan tempoh lawatan </td>
      <td>:</td>
      <td><input name="tarikh_mula" type="text" id="tarikh_mula" value="<?php echo $tarikh_mula?>
      " />
          <a onclick="if(self.gfPop)gfPop.fPopCalendar(document.intray.tarikh_mula);return false;" href="javascript:void(0)"> <img src="images/calendar.png" width="24" height="24" border='0'/> </a>
          <input name="tarikh_tmt" type="text" id="tarikh_tmt" value="<?php echo$tarikh_tmt?>
      " />
          <a onclick="if(self.gfPop)gfPop.fPopCalendar(document.intray.tarikh_tmt);return false;" href="javascript:void(0)"> <img src="images/calendar.png" width="24" height="24" border='0'/> </a></td>
    </tr>
    <tr>
      <td width="148">Tujuan</td>
      <td width="3" height="30">:</td>
      <td width="475"><input name="tujuan" type="text" id="tujuan" size="50" value="<?php echo $tujuan?>" /></td>
    </tr>
    <tr>
      <td width="210">Maklumat Insurans</td>
      <td width="8" height="25">:</td>
      <td width="339"><a href="insurans/<?php echo $userid ?>/<?php echo $insurans;?>" target="_blank">[<?php echo $insurans; ?>]</a>
        <input type="file" name="insurans" id="insurans"  value="<?php $_GET['insurans']; ?>" required /> <br>
      (hanya format : pdf, jpeg,gif,png). Tidak melebihi 2MB.
        </td>
    </tr>


    <!--<tr>
      <td width="230">Alamat Semasa Bercuti  <span class="style1">*</span> </td>
      <td width="5" height="30">:</td>
      <td width="515"><input name="add1" type="text" id="add1" size="50" value="" />
	  </td>
    </tr>
	<tr>
      <td width="230">&nbsp;</td>
      <td width="5" height="30">:</td>
      <td width="515"><input name="add2" type="text" id="add2" size="50" value="" />
	  </td>
    </tr>
	<tr>
      <td width="230">&nbsp;</td>
      <td width="5" height="30">:</td>
      <td width="515"><input name="add3" type="text" id="add3" size="50" value="" />
	  </td>
    </tr>-->
    <tr bgcolor="#FF9999">
      <td colspan="3"><b>Maklumat Tambahan :</b> </td>
     </tr>
	<tr>
      <td>Kos Lawatan (RM) </td>
      <td>:</td>
      <td width="515"><span class="style4">
           <input name="koslawatan" type="text" id="koslawatan" size="50" value="<?php echo $koslawatan;?>" />
		</td>
    </tr>
	<tr>
      <td>Dibiayai Oleh</td>
      <td>:</td>
      <td width="515"><span class="style4">
           <input name="biayaioleh" type="text" id="biayaioleh" size="50" value="<?php echo $biayaioleh;?>" />
		</td>
    </tr>
	<tr>
      <td>Bilangan Ahli Keluarga/Rombongan</td> 
      <td>:</td>
   <td width="515"><span class="style4">
           <input name="ahli_rombongan" type="text" id="ahli_rombongan" size="50" value="<?php echo $ahli_rombongan;?>" />
		</td>
	</tr>
	<!--<tr bgcolor="#FF9999">
      <td colspan="3"><b>Maklumat Kelulusan Cuti Rehat (Sekiranya memerlukan kelulusan cuti rehat )</b> </td>
     </tr>
	<tr>
      <td>Tarikh Mula Cuti Rehat  </td>
      <td>:</td>
      <td width="515"><span class="style4">
            <input name="tkh_mula" type="text" id="tkh_mula" value="<?php echo $tkh_mula;?>"  readonly=true />
            <a onclick="if(self.gfPop)gfPop.fPopCalendar(document.intray.tkh_mula);return false;" href="javascript:void(0)"> <img src="images/calendar.png" width="24" height="24" border='0'/> </a></span></td>
    </tr>
	<tr>
      <td>Tarikh Akhir Cuti Rehat  </td>
      <td>:</td>
     <td width="515"><span class="style4">
            <input name="tkh_akhir" type="text" id="tkh_akhir" value="<?php echo $tkh_akhir;?>"  readonly=true />
            <a onclick="if(self.gfPop)gfPop.fPopCalendar(document.intray.tkh_akhir);return false;" href="javascript:void(0)"> <img src="images/calendar.png" width="24" height="24" border='0'/> </a></span></td>
    </tr>
	<tr>
      <td>Tarikh Kembali Bertugas </td>
      <td>:</td>
      <td width="515"><span class="style4">
            <input name="tkh_tugas" type="text" id="tkh_tugas" value="<?php echo $tkh_tugas;?>"  readonly=true />
            <a onclick="if(self.gfPop)gfPop.fPopCalendar(document.intray.tkh_tugas);return false;" href="javascript:void(0)"> <img src="images/calendar.png" width="24" height="24" border='0'/> </a></span></td>
    </tr>
	<tr bgcolor="#FF9999">
      <td colspan="3"><b>Maklumat Tambahan ( Sekiranya pegawai sering berulang alik ke negara jiran - kadar kekerapan 4 kali sebulan )</b></td>
      </tr>
	  <tr>
      <td>Adakah anda sering berulang alik ke negara jiran - kekerapan 4 kali sebulan </td>
      <td>:</td>
      <td width="515">
           <input name="kerap" type="radio" value="Y" onclick="toggle(this);"/>
	Ya, Kerap
	<input name="kerap" type="radio" value="N" onclick="toggle(this);"/>
      Tidak
	 </td>
    </tr>
	<tr>
	<td colspan="3"><div id="withdiv4" style="display:none;">
	<table width="650" border="0" align="center" cellpadding="5" cellspacing="0" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0">
	<tr bgcolor="#FF9999" >
      <td colspan="3"><b>Maklumat Pasangan/Keluarga/Saudara Pegawai di Luar Negara</b></td>
      </tr>
	<tr>
      <td>Nama</td>
      <td>:</td>
      <td>
            <input name="namasedara" type="text" id="add1" size="50" value="" /></td>
    </tr>
	<tr>
      <td>Hubungan </td>
      <td>:</td>
     <td>
            <input name="hubungansedara" type="text" id="add1" size="50" value="" /></td>
    </tr>
	<tr>
      <td>Alamat </td>
      <td>:</td>
      <td><input name="addsedara" type="text" id="add1" size="50" value="" /></td>
    </tr>
	<tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input name="add2sedara" type="text" id="add1" size="50" value="" /></td>
    </tr>
	<tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input name="add3sedara" type="text" id="add1" size="50" value="" /></td>
    </tr>
	<tr>
      <td>No Telefon  </td>
      <td>:</td>
      <td><input name="telsedara" type="text" id="add1" size="50" value="" /></td>
    </tr>
	<tr>
      <td>Emel</td>
      <td>:</td>
      <td><input name="emelsedara" type="text" id="add1" size="50" value="" /></td>
    </tr>
	<tr>
      <td>Alasan </td>
      <td>:</td>
      <td><textarea rows="5" cols="38" name="alasan"></textarea></td>
    </tr>-->
    <tr>
      <td></td>
      <td height="34"></td>
      <td align="right"><input type="hidden" name="ref" id="ref" value="<?php echo $ref; ?>">
      <input type="submit" name="Submit" value=" Hantar  " />
          <input type="reset" name="reset" value="  Reset  " /></td>
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