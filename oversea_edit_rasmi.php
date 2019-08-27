<?php
require ("_common/conn.php");
require ("_common/global.php");
require ("_common/session.php");
include "convertdate.php";
include "current_date.php";

$ref = (isset($_GET['idinfo'])) ? mysql_real_escape_string(trim($_GET['idinfo'])) : '';

$query = "select * from intrayprofile where userid = '$userid'";
$result = mysql_query($query);
$existke = mysql_num_rows($result);

	while ($data = mysql_fetch_array($result))
	{
		$nama_pgw = $data['nama_pgw'];
		$nokp = $data['nokp'];
		$jawatan = $data['jawatan'];
		$tkh_lantikan = $data['tkh_lantikan'];
		$tkh_lantikan=convertdate($tkh_lantikan);
		$jabatan = $data['jabatan'];
		$gaji_skrg = $data['gaji_skrg'];
		$email	 = $data['email'];
		$s_kahwin = $data['status_perkahwinan'];
		$n_psgn	 = $data['nama_psgn'];
		$jwtn_psgn	 = $data['jwtn_psgn'];
		$jbtn_psgn	 = $data['jbtn_psgn'];
		$tggugan	 = $data['tanggungan'];
		
		$belanja = explode(".", $gaji_skrg);
		$ringgit=$belanja[0]; // piece1
		$sen=$belanja[1]; // piece2

	}
	
	$query = "select * from intrayinfo where userid = '$userid' and idinfo='$ref'";
	$result = mysql_query($query);
	$existke = mysql_num_rows($result);

	while ($data1 = mysql_fetch_array($result))
	{

		$nama_persidangan = $data1['nama_seminar'];
		$tujuan = $data1['tujuan'];
		$tempat = $data1['tempat'];
		$tarikhpergi = convertdate($data1['tarikhpergi']);
		$tarikhpulang = convertdate($data1['tarikhpulang']);
		$bilpeserta = $data1['bil_peserta'];
		
		$namaketua = $data1['nama_ketua'];
		$duta = $data1['duta'];
		$kekerapan = $data1['kekerapan'];
		
		$belanja = $data1['belanja'];
		$faedah = $data1['faedah'];
		$kekerapan = $data1['kekerapan'];
		
		$lulus_kdn = $data1['lulus_kdn'];
		$surat = $data1['surat'];
		
	}
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
//////////////////// jawatan //////////////
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

//////////////////// nama tempat //////////////
$queryt = "select description_en  FROM ref_country where country_code = '$tempat'";
$resultt = mysql_query($queryt);
$existket = mysql_num_rows($resultt);

if ($existket > 0)
{
	while ($datat = mysql_fetch_array($resultt))
	{
		$namatpt = $datat['description_en'];
	} 
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style type="text/css">
<!--
.style1 {color: #FF0000}
.style2 {font-weight: bold}
-->
</style>
</head>
<title><?php echo SYSTEM_TITLE ?></title>
<link rel="stylesheet" href="css/main.css" type="text/css">
<form action="pro_editrasmi.php" method="post" name="rasmi" enctype="multipart/form-data">
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
<tr><td width="1033"><br /></td></tr>
<tr>
<td height="746">
<!-- table tab -->
<table width="973" border="0" align="center" cellpadding="5"  cellspacing="0" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0">
<tr bgcolor="#a4c8e0">
<td width="961" height="30" bgcolor="#cc3333"><strong>Kemaskini Maklumat Pemohon : Urusan Rasmi</strong></td>
</tr>
<tr>
<td height="710"><table width="813" border="0" align="center" cellpadding="5"  cellspacing="0" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0">
<tr bgcolor="#DF7B7B">
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
<tr>
  <td height="33">No. Kad Pengenalan<span class="style1">*</span></td>
  <td>:</td>
  <td><input name="nokp" type="text" id="nokp" value="<?php echo $nokp?>" size="12" maxlength="12"/>
  [cth: 820104240378] </td>
</tr>
<tr>
  <td height="33">Nama Penuh <span class="style1">*</span> </td>
  <td>:</td>
  <td><input name="nama_pgw" type="text" id="nama_pgw" size="50" value="<?php echo $nama_pgw?>" />
  <input name="ref" type="text" id="ref" value="<?php echo $ref; ?>" /></td>
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
	   	echo'<option value="'.$datagen["kod_jwtn"].'" >'.$datagen["nama_jwtn"] . '</option>';
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
<tr bgcolor="#DF7B7B">
    <td height="30" colspan="8" style="border-bottom: 1px solid #a4c8e0"><strong>Maklumat Lawatan </strong></td>
</tr>
<tr>
  <td height="45">Nama Persidangan/Seminar/
  Lawatan Rasmi <span class="style1">*</span> </td>
  <td>:</td>
  <td><input name="nama" type="text" id="nama" size="70" maxlength="100" value="<?php echo $nama_persidangan; ?>"></td>
</tr>
<tr>
  <td>Tujuan <span class="style1">*</span></td>
  <td>:</td>
        <td><label>
          <textarea name="tujuan" cols="50" rows="5" id="tujuan"><?php echo $tujuan; ?></textarea>
        </label></td>
</tr>
      <tr>
        <td width="263">Tempat Hendak Diadakan <span class="style1">*</span></td>
        <td width="5" height="30">:</td>
          <td width="613"><select name="neg_lawat" id="neg_lawat">
         <option value="<?php echo $tempat; ?>" > <?php echo $namatpt;?> 
          <?php
			$query01= "SELECT country_code, description_en  FROM ref_country ORDER BY description_en ASC ";
										 $result02=mysql_query($query01);

                                          for ($row=0; $row<mysql_num_rows($result02); $row++)
                                          {
										  $values=mysql_fetch_array($result02);
                                          $kod = $values["country_code"];
                                         $nama = $values["description_en"];
										if ($neg_lawat==$kod)
										{
										?>
          <option value="<?php echo $kod ?>" selected="selected"><?php echo $nama ?></option>
          <?php
										  }else{
										  
                                          ?>
          <option value="<?php echo $kod ?>" ><?php echo $nama ?></option>
          <?php
										  }
                                          } // end for
                                          ?>
        </select></td>
        </tr>
        <tr>
          <td>Tempoh <span class="style1">*</span></td>
          <td>:</td>
          <td>Dari : 
            
            <input name="dari" type="text"  id="dari" value="<?php echo $tarikhpergi; ?>">
			<a onclick="if(self.gfPop)gfPop.fPopCalendar(document.rasmi.dari);return false;" href="javascript:void(0)"> 
            <img src="images/calendar.png" width="24" height="24" border='0' /></a> 
			
			Hingga : 
            <input name="hingga" type="text" id="hingga"  value="<?php echo $tarikhpulang; ?>">
			<a onclick="if(self.gfPop)gfPop.fPopCalendar(document.rasmi.hingga);return false;" href="javascript:void(0)"> 
            <img src="images/calendar.png" width="24" height="24" border='0'/></a></td>
        </tr>
        <tr>
          <td>Bilangan peserta </td>
          <td>:</td>
          <td><input name="bil" type="text" id="bil" size="4" maxlength="4"  value="<?php echo $bilpeserta; ?>">            
            orang</td>
        </tr>
        <tr>
          <td>Nama Ketua</td>
          <td>:</td>
          <td><label></label>
            <input name="nama_ketua" type="text" id="nama_ketua" size="50"  value="<?php echo $namaketua; ?>"></td>
        </tr>
        
        <tr>
          <td><div align="justify">Sebutkan samaada pegawai kedutaan Malaysia di negara tempat persidangan, seminar, lawatan rasmi itu diadakan akan menyertai persidangan, nyatakan mengapa kehadiran pegawai-pegawai daripada negara ini diperlukan </div></td>
          <td>:</td>
          <td><textarea name="duta" cols="50" rows="5" id="duta"><?php echo $duta; ?></textarea></td>
        </tr>
        <tr>
          <td>Kekerapan Persidangan/Seminar/Lawatan Rasmi <span class="style1">*</span></td>
          <td>:</td>
          <td><input name="kekerapan" type="text" id="kekerapan" size="3" maxlength="3"  value="<?php echo $kekerapan; ?>"></td>
        </tr>
        <tr>
          <td>Perbelanjaan ditanggung oleh <span class="style1">*</span></td>
          <td height="29">:</td>
          <td><input name="belanja" type="text" id="belanja" size="50"  value="<?php echo $belanja; ?>"></td>
        </tr>
        <tr>
          <td>Faedah kepada negara <span class="style1">*</span></td>
          <td>:</td>
          <td><textarea name="faedah" cols="50" rows="5" id="faedah"><?php echo$faedah; ?></textarea></td>
        </tr>
        <tr>
          <td>Kelulusan Kementerian Dalam Negeri dan Kementerian Luar (Jika Persidangan/Seminar/Lawatan<br />
Rasmi itu diadakan di Negara Israel) </td>
          <td>:</td>
          <td><input name="kelulusan" type="text" id="kelulusan" size="70" maxlength="100" value="<?php echo $lulus_kdn; ?>"></td>
        </tr>
		<tr>
          <td>Muat naik Surat Tawaran  </td>
          <td>:</td>
          <td><input type="file" name="surat" id="surat" />
          <a href="upload/<?=$userid; ?>/<?=$surat; ?>" target="_blank">Muat turun surat</a></td>
        </tr>
		<tr>
           <td></td>
           <td height="34"></td>
           <td align="right"><input name="submit_btn" type="submit" id="submit_btn" value=" Kemaskini  " /></td>
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