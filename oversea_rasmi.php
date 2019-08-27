<?php
require ("_common/conn.php");
require ("_common/global.php");
require ("_common/session.php");
include "convertdate.php";
include "current_date.php";
$nama_seminar = (isset($_GET['nama_seminar'])) ? mysql_real_escape_string(trim($_GET['nama_seminar'])) : '';
$tujuan = (isset($_GET['tujuan'])) ? mysql_real_escape_string(trim($_GET['tujuan'])) : '';
$tempat = (isset($_GET['tempat'])) ? mysql_real_escape_string(trim($_GET['tempat'])) : '';
$bil= (isset($_GET['bil'])) ? mysql_real_escape_string(trim($_GET['bil'])) : '';
$nama_ketua = (isset($_GET['nama_ketua'])) ? mysql_real_escape_string(trim($_GET['nama_ketua'])) : '';
$duta = (isset($_GET['duta'])) ? mysql_real_escape_string(trim($_GET['duta'])) : '';
$belanja = (isset($_GET['belanja'])) ? mysql_real_escape_string(trim($_GET['belanja'])) : '';
$faedah = (isset($_GET['faedah'])) ? mysql_real_escape_string(trim($_GET['faedah'])) : '';
$surat = (isset($_GET['surat'])) ? mysql_real_escape_string(trim($_GET['surat'])) : '';

// x session sbb mungkin ada yang tukar jabatan
	$query = "select a.jabatan, b.unit_pengurusan from intrayprofile a, intrayrefjabatan b  where a.userid = '$userid' AND a.jabatan = b.kod_jbtn";
	$result = mysql_query($query);
	$existke = mysql_num_rows($result);

	while ($data = mysql_fetch_array($result))
	{
		$jabatan = $data['jabatan'];
		$up = $data['unit_pengurusan'];
	}
	$_SESSION["offcode"] = "$jabatan";
	$_SESSION["up"] = "$up";
	
	date('Y', $time);
	
	//awin tutup - 8/5
	// emel ketua jabatan akan jadi nexrole
	$nxrole = '01';
	$kodstatus = '10';
	
	if ($rank == 'KJ') // ketua jabatan/ sub
	{
		if ($up == 'O')  // kalau operasi
		{
		$query1 = "select a.email from intrayprofile a, intrayusers b where b.rank = 'T1' AND a.userid = b.userid";
		}
		else
		{
		$query1 = "select a.email from intrayprofile a, intrayusers b where b.rank = 'T2' AND a.userid = b.userid";
		}
	}
	else if ($rank == 'KA') // cth ciast
	{
		//tgk main jabatan
		$query = "select mainkod from intrayrefjabatan where kod_jbtn = '$jabatan'";
		$result = mysql_query($query);
		$existke = mysql_num_rows($result);
	
		while ($data = mysql_fetch_array($result))
		{
			$mainkod = $data['mainkod'];
		}
		
		$query1 = "select a.email from intrayprofile a, intrayusers b where a.jabatan = '$mainkod' and b.rank = 'KJ' and a.userid = b.userid";
	}
	else if ($rank == 'T1'  || $rank == 'T2') // cth TKSU
	{
		$query1 = "select a.email from intrayprofile a, intrayusers b where b.rank = 'SU' AND a.userid = b.userid";
	}
	else
	{
		$query1 = "select a.email from intrayprofile a, intrayusers b where a.jabatan = '$jabatan' and b.role = '$nxrole' and a.userid = b.userid";
	}
	$result1 = mysql_query($query1);
	
	while ($data1 = mysql_fetch_array($result1))
	{
		$emailketuajabatan = $data1['email'];
	}
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

<script>
   
    function closeAlertMsg() {
	document.getElementById('alertMsg').style.display='none';
}
</script>
</head>
<link rel="stylesheet" href="css/main.css" type="text/css">
<form action="pro_daftarrasmi.php" method="post" name="rasmi" enctype="multipart/form-data">
<body>


<?php
	if(strlen($alertMsgDesc)>0):
		echo '<div id="alertMsg" style="width: 300px; position: absolute; top: 250px; right: 50px; border: 1px solid red; background-color: #E2F3A9; padding: 20px; font: 12px Arial; color: #990000;">';
		echo $alertMsgDesc;
		if(sizeof($alertMsg)>0) {
			echo '<ul>';
			foreach($alertMsg as $msgItem) {
				echo '<li>';
				if(strlen($msgItem[0])>0) echo '<a href="#" onclick="document.rasmi.'.$msgItem[1].'.focus();">';
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

<tr>
<td height="746">
<!-- table tab -->
<table width="973" border="0" align="center" cellpadding="5"  cellspacing="0" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0">
<tr bgcolor="#a4c8e0">
<td width="961" height="30" bgcolor="#cc3333"><strong>Permohonan Lawatan Ke Luar Negeri : Sila lengkapkan semua maklumat di bawah </strong></td>
</tr>
<tr>
<td><table width="813" border="0" align="center" cellpadding="5"  cellspacing="0" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0">

<tr bgcolor="#DF7B7B">
<td height="30" colspan="8" style="border-bottom: 1px solid #a4c8e0"><strong>Di atas Urusan Rasmi : <strong><? echo $userid;?></strong></strong></td>
</tr>
<tr>
  <td height="45">Nama Persidangan/Seminar/
  Lawatan Rasmi <span class="style1">*</span> </td>
  <td>:</td>
  <td><input name="nama_seminar" type="text" id="nama_seminar" size="70" maxlength="100"  value="<?php echo $nama_seminar; ?>" /></td>
</tr>
<tr>
  <td>Tujuan <span class="style1">*</span></td>
  <td>:</td>
        <td><label>
        <input name="tujuan" type="text" id="tujuan" size="70" maxlength="100"  value="<?php echo $tujuan; ?>" />
        </label></td>
</tr>
      <tr>
        <td width="263">Tempat Hendak Diadakan <span class="style1">*</span></td>
        <td width="5" height="30">:</td>
          <td width="613"><select name="neg_lawat" id="neg_lawat">
          <option value="" > &lt;&lt; Sila Pilih Negara &gt;&gt; </option>
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
          <td>Bilangan peserta </td>
          <td>:</td>
          <td><input name="bil" type="text" id="bil" size="4" maxlength="4" value="<?php echo $bil; ?>"/>            
            orang</td>
        </tr>
        <tr>
          <td>Nama Ketua</td>
          <td>:</td>
          <td><label></label>
            <input name="nama_ketua" type="text" id="nama_ketua" size="50" value="<?php echo $nama_ketua; ?>"/></td>
        </tr>
        
        <tr>
          <td><div align="justify">Sebutkan samaada pegawai kedutaan Malaysia di negara tempat persidangan, seminar, lawatan rasmi itu diadakan akan menyertai persidangan, nyatakan mengapa kehadiran pegawai-pegawai daripada negara ini diperlukan </div></td>
          <td>:</td>
          <td><textarea name="duta" cols="50" rows="5" id="duta"><?php echo $duta; ?></textarea></td>
        </tr>
        <tr>
          <td>Perbelanjaan ditanggung oleh <span class="style1">*</span></td>
          <td height="29">:</td>
          <td><input name="belanja" type="text" id="belanja" size="50"  value="<?php echo $belanja; ?>"/></td>
        </tr>
        <tr>
          <td>Faedah kepada negara</td>
          <td>:</td>
          <td><textarea name="faedah" cols="50" rows="5" id="faedah" value=""><?php echo $faedah; ?></textarea></td>
        </tr>
		<tr>
          <td>Muat naik Surat Tawaran  <span class="style1">* (<strong>hanya format : pdf, jpeg,gif,png</strong>)</span></td>
          <td>:</td>
          <td><input type="file" name="surat" id="surat"  value="<?=$_GET['surat']; ?>"/> 
          (hanya format : pdf, jpeg,gif,png). Tidak melebihi 2MB. </td>
        </tr>
		<tr>
      <td>Alamat Email Ketua Jabatan <span class="style1">* </span></td>
      <td>:</td>
      <td><?php echo $emailketuajabatan;?>
         </tr>
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
<? include "footer.php";?>
</body></form>


</html>

<iframe name="gToday:normal:agenda.js" id="gToday:normal:agenda.js"
src="ipopeng.php" scrolling="no" frameborder="0"
style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>