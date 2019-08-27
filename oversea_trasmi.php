<?php
require ("_common/conn.php");
require ("_common/global.php");
require ("_common/session.php");
include "convertdate.php";
include "current_date.php";
include "calculateDay.php";
session_start();

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
	
	else if ($rank == 'KA' && $offcode=='CIAST')//($rank == 'KA' || $rank == 'AG' ) // cth KP ciast
	{
	//tgk main jabatan
		$query = "select mainkod from intrayrefjabatan where kod_jbtn = '$jabatan'";
		$result = mysql_query($query);
		$existke = mysql_num_rows($result);
	
		while ($data = mysql_fetch_array($result))
		{
			$mainkod = $data['mainkod'];
		}
		
		$query1 = "select distinct a.email from intrayprofile a, intrayusers b where a.jabatan = '$mainkod' and b.rank = 'KJ' and a.userid = b.userid";
	}
	
	else if($offcode=='CIAST')
	{
		$query1 = "select a.email from intrayprofile a, intrayusers b where a.jabatan = '$jabatan' and b.role = '$nxrole' and a.userid = b.userid";
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
<script>
function myFunction() {
    document.getElementById("intray").reset();
}
</script>
<style type="text/css">
<!--
.style1 {color: #FF0000}
-->
</style>
</head>
<title><?php echo SYSTEM_TITLE ?></title>
<link rel="stylesheet" href="css/main.css" type="text/css">
<form action="oversea_trasmiadd.php" method="post" name="intray" id="intray" enctype="multipart/form-data">
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
<td width="961" height="30" bgcolor="#cc3333"><strong>Permohonan Lawatan Ke Luar Negeri </strong></td>
</tr>
<tr>
<td><br />
  <table width="761" border="0" align="center" cellpadding="5"  cellspacing="0" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0">
    <tr bgcolor="#DF7B7B">
      <td height="30" colspan="5" style="border-bottom: 1px solid #a4c8e0"><strong>Di atas Urusan Persendirian : <?php echo $userid;?></strong></td>
    </tr>
    <tr bgcolor="#FF9999">
      <td height="29" bgcolor="#FF9999" colspan="3"><strong>Maklumat Perjalanan Ke Luar Negara </strong></td>
      </tr>
	<?php
		//if ( isset( $_GET['neg_lawat'] ) ) { $neg_lawat = mysql_real_escape_string($_GET["neg_lawat"]) ;  }
	?>
    <tr>
      <td height="45">Negara yang hendak dilawati <span class="style1">*</span> </td>
      <td>:</td>
      <td><select name="neg_lawat" id="neg_lawat">
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
      <td width="230">Tujuan <span class="style1">*</span> </td>
      <td width="5" height="30">:</td>
      <td width="515"><input name="tujuan" type="text" id="tujuan" size="50" value="" />
	  </td>
    </tr>
	 <tr>
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
    </tr>
    <tr>
      <td>Muat naik Salinan Insurans  <br><span class="style1">* (<strong>hanya format : pdf, jpeg,gif,png</strong>)</span></td>
      <td>:</td>
      <td><input type="file" name="insurans" id="insurans"  value="<?php $_GET['insurans']; ?>" required /> <br>
      (hanya format : pdf, jpeg,gif,png). Tidak melebihi 2MB. </td>
    </tr>
    <tr bgcolor="#FF9999">
      <td colspan="3"><b>Maklumat Tambahan :</b> </td>
     </tr>
	<tr>
      <td>Kos Lawatan (RM) </td>
      <td>:</td>
      <td width="515">
           <input name="koslawatan" type="text" id="koslawatan" size="50" value="" />
		</td>
    </tr>
	<tr>
      <td>Dibiayai Oleh</td>
      <td>:</td>
      <td width="515">
           <input name="biayaioleh" type="text" id="biayaioleh" size="50" value="" />
		   </td>
    </tr>
	<tr>
      <td>Bilangan Ahli Keluarga/Rombongan</td>
      <td>:</td>
   <td width="515">
           <input name="ahli_rombongan" type="text" id="ahli_rombongan" size="50" value="" />
		</td>
	</tr>
	<tr bgcolor="#FF9999">
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
    </tr>
	</table>
	</div></td>
	</tr>
    <tr bgcolor="#FF9999">
      <td><b>Email Ketua Jabatan</b> </td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Alamat Email Ketua Jabatan <span class="style1">* </span></td>
      <td>:</td>
      <td><?php 
	  if ($penggunaan == 'D')
	  {
	  echo $emailketuajabatan .'@mohr.gov.my';
	  }
	  else if ($offcode=='CIAST') //utk staff biasa agensi
	  {
	  	echo $emailketuajabatan;
	  }
	  else
	  {
	  echo $emailketuajabatan;
	  }
	  ?>
       </tr>
		    <tr bgcolor="#FF9999">
      <td height="29" colspan="3"><b>Senarai lawatan ke luar negeri di atas urusan persendirian :</b> </td>
    </tr>
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
      <td>a.Tahun Semasa </td>
      <td>:</td>
      <td><?php echo $jum_thnini;?>
      kali </td>
    </tr>
    <tr>
      <td height="98" colspan="3"><table width="770" border="0" align="center" cellpadding="5"  cellspacing="0">
          <tr bgcolor="#a4c8e0">
            <td width="162" scope="col" style="border-bottom: 1px solid #a4c8e0"><div align="center"><strong>Nama Tempat </strong></div></td>
            <td width="268" scope="col" style="border-bottom: 1px solid #a4c8e0"><div align="center"><strong>Tujuan</strong></div></td>
            <td width="102" scope="col" style="border-bottom: 1px solid #a4c8e0"><div align="center"><strong>Tarikh Pergi</strong></div></td>
            <td width="85" scope="col" style="border-bottom: 1px solid #a4c8e0"><div align="center"><strong>Tarikh Pulang </strong></div></td>
            <td width="103" scope="col" style="border-bottom: 1px solid #a4c8e0"><div align="center"><strong>Tempoh Lawatan </strong></div></td>
          </tr>
          <?php
			
			$query = "SELECT  idinfo, tujuan, tempat, tarikhpergi,tarikhpulang,YEAR(tarikhpermohonan)
				FROM intrayinfo where jenispermohonan = 'F0000001' and YEAR(curdate())=YEAR(tarikhpermohonan)
 					and userid = '$userid'";
			$result = mysql_query($query);
			$existke = mysql_num_rows($result);

			while ($data = mysql_fetch_array($result))
			{
				$tujuan = $data['tujuan'];
				$tempat = $data['tempat'];
				$tarikhpergi = $data['tarikhpergi'];
				$tarikhpulang = $data['tarikhpulang'];
				$tarikhpergi1=convertdate($tarikhpergi);
				$tarikhpulang1=convertdate($tarikhpulang);
			    $date1 = strtotime($tarikhpergi);
				$date2 = strtotime($tarikhpulang);
				$tempoh = count_days($date1,$date2);
				
				$query2 = "select description from ref_country where country_code = '$tempat'";
				$result2 = mysql_query($query2);
				
				if(!$result2) 
				{
				echo "Error2:";
				exit();
				}
				
				$data2 = mysql_fetch_array($result2);
				$tempat2 = $data2['description'];
				
		?>
		<tr>
            <td height="25" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0"><?php echo $tempat2?></td>
            <td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0"><?php echo $tujuan?></td>
            <td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0"><?php echo $tarikhpergi1?></td>
            <td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0"><?php echo $tarikhpulang1?></td>
            <td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0"><?=$tempoh?></td>
            <?php
		   }
		   ?>
          </tr>
      </table></td>
    </tr>
    <tr>
      <?php
		$query = "SELECT count( idinfo ) AS xrasmi,YEAR(tarikhpermohonan) as tahun_lepas
				FROM intrayinfo
				WHERE jenispermohonan = 'F0000001' and YEAR(curdate())>YEAR(tarikhpermohonan) and userid = '$userid'";
			$result = mysql_query($query);
			$existke = mysql_num_rows($result);

			while ($data = mysql_fetch_array($result))
			{
				$jum_thnlps = $data['xrasmi'];
		
			}
		?>
      <td>b. Tahun Lepas </td>
      <td>:</td>
      <td><?php echo $jum_thnlps;?>
      kali</td>
    </tr>
    <tr>
      <td colspan="3"><table width="767" border="0" align="center" cellpadding="5"  cellspacing="0">
          <tr bgcolor="#a4c8e0">
            <td width="160" bordercolor="#000000" style="border-bottom: 1px solid #a4c8e0" scope="col"><div align="center"><strong>Nama Tempat </strong></div></td>
            <td width="268" bordercolor="#000000" style="border-bottom: 1px solid #a4c8e0" scope="col"><div align="center"><strong>Tujuan</strong></div></td>
            <td width="102" bordercolor="#000000" style="border-bottom: 1px solid #a4c8e0" scope="col"><div align="center"><strong>Tarikh Pergi</strong></div></td>
            <td width="87" bordercolor="#000000" style="border-bottom: 1px solid #a4c8e0" scope="col"><div align="center"><strong>Tarikh Pulang </strong></div></td>
            <td width="100" bordercolor="#000000" style="border-bottom: 1px solid #a4c8e0" scope="col"><div align="center"><strong>Tempoh Lawatan </strong></div></td>
          </tr>
          <?php
			$query = "SELECT  idinfo, tujuan, tempat, tarikhpergi,tarikhpulang,YEAR(tarikhpermohonan)
				FROM intrayinfo where jenispermohonan = 'F0000001' and YEAR(curdate())>YEAR(tarikhpermohonan)
 					and userid = '$userid'";
			$result = mysql_query($query);
			$existke = mysql_num_rows($result);

			while ($data = mysql_fetch_array($result))
			{
				$tujuan = $data['tujuan'];
				$tempat = $data['tempat'];
				$tarikhpergi = $data['tarikhpergi'];
				$tarikhpulang = $data['tarikhpulang'];
				$tarikhpergi1=convertdate($tarikhpergi);
				$tarikhpulang1=convertdate($tarikhpulang);
				$date1 = strtotime($tarikhpergi);
				$date2 = strtotime($tarikhpulang);
				$tempoh = count_days($date1,$date2);
				
				
				$query3 = "select description from ref_country where country_code = '$tempat'";
				$result3 = mysql_query($query3);
				
				if(!$result3) 
				{
				echo "Error2:";
				exit();
				}
				
				$data3 = mysql_fetch_array($result3);
				$tempat3 = $data3['description'];
				

			?>
          <tr>
            <td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0"><?php echo $tujuan?></td>
            <td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0"><?php echo $tempat3?></td>
            <td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0"><?php echo $tarikhpergi1?></td>
			  <td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0"><?php echo $tarikhpulang1?></td>
			  <td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0"><?php echo $tempoh?></td>
            <?php
			  }
			  ?>
          </tr>
      </table></td>
      </tr>
    <!--<tr>
          <td height="34"></td>
          <td align="left"><a href="getkLalauan.php">Lupa Kata Laluan ?</a></td>
        </tr>-->
    <tr>
      <td></td>
      <td height="34"></td>
      <td align="right"><input type="submit" name="Submit" value=" Hantar  " />
          <input type="button" onclick="myFunction()" value="Reset" /></td>
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