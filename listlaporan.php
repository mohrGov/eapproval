<?php
require ("_common/conn.php");
require ("_common/global.php");
require ("_common/session.php");
include "convertdate.php";

//dari form sbelah
	$jbtn = (isset($_POST['jbtn'])) ? trim($_POST['jbtn']) : ''; 
	$tarikhmula = (isset($_POST['tarikhmula'])) ? trim($_POST['tarikhmula']) : ''; //dd/mm/yyyy
	$tarikhhingga = (isset($_POST['tarikhhingga'])) ? trim($_POST['tarikhhingga']) : '';
	$tmula = explode("/",$_POST['tarikhmula']); // buang /
	$tmula1 = $tmula[2]."-".$tmula[1]."-".$tmula[0];  // tukar format kepada yyyy-mm-dd
	$thingga = explode("/",$_POST['tarikhhingga']); // buang /
	$thingga1 = $thingga[2]."-".$thingga[1]."-".$thingga[0]; // tukar format kepada yyyy-mm-dd
	$tujuan = (isset($_POST['tujuan'])) ? trim($_POST['tujuan']) : '';
	
	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo SYSTEM_TITLE ?></title></head>
<link rel="stylesheet" href="css/main.css" type="text/css">
<body>
<!-- table besar --------------------------------------------------------------------------------------------------------------------------->
<table width="994" border="0" align="center" cellpadding="0"  cellspacing="0" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0">
<?php include "header.php";?>
<?php include "menumenu.php";?>
<tr><td><br /></td></tr>
<tr>
<td>
<!-- table tab -->
<form action="listlaporan.php" method="post" name="form1">
<table width="901" border="0" align="center" cellpadding="5"  cellspacing="0" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0">
  <tr bgcolor="#cc3333">
    <td height="30" colspan="8" style="border-bottom: 1px solid #a4c8e0"><strong>Paparan maklumat kelulusan luar negeri </strong></td>
  </tr>
  <tr bgcolor="#999999">
    <td height="25" colspan="8" align="center" style="border-bottom: 1px solid #a4c8e0"><strong>RASMI</strong></td>
  </tr>
  <tr bgcolor="#C8E954">
    <td width="23" height="34" align="center" bgcolor="#DF7B7B" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" ><strong>Bil</strong></td>
	<td width="129" align="center" bgcolor="#DF7B7B" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" ><strong>Nama</strong></td>
    <td width="82" align="center" bgcolor="#DF7B7B" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" ><strong><strong><strong>Bahagian / Jabatan</strong></strong></strong></td>
    <td width="67" align="center" bgcolor="#DF7B7B" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" ><strong><strong><strong>Destinasi</strong></strong></strong></td>
	 <td width="87" align="center" bgcolor="#DF7B7B" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" ><strong>Tarikh Pergi</strong></td>
	 <td width="109" align="center" bgcolor="#DF7B7B" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0"><strong>Tarikh Pulang</strong></td>
		<td width="182" align="center" bgcolor="#DF7B7B" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0"><strong>Nama Seminar </strong></td>
		   <td width="140" align="center" bgcolor="#DF7B7B" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0"><strong>Perbelanjaan</strong></td>
  </tr>
<?php
$query = "select a.*,c.kod_jbtn from intrayinfo a, intrayprofile b, intrayrefjabatan c where a.userid = b.userid AND b.jabatan=c.kod_jbtn AND a.jenispermohonan = 'F0000002' AND";

//--------------kalau cari by jabatan, tarikhmula, tarikhhingga, jenispermohonan---------------dah
											if ($jbtn <> "" && $tarikhmula <> "" && $tarikhhingga <> "" && $tujuan <> "")
											{
												//echo "1";
												$query .= " c.kod_jbtn = '$jbtn' and a.tarikhpergi >= '$tmula1' AND a.tarikhpergi <= '$thingga1' and a.jenispermohonan = '$tujuan'"; 
											}
//--------------kalau cari by tarikhmula, tarikhhingga, jenispermohonan---------------dah
											else if ($tujuan <> "" && $tarikhmula <> "" && $tarikhhingga <> "")
											{
												//echo "2";
												$query .= " a.tarikhpergi >= '$tmula1' AND a.tarikhpergi <= '$thingga1' and a.jenispermohonan = '$tujuan'"; 
											}

//--------------kalau cari by jabatan, jenispermohonan---------------dah
											else if ($jbtn <> "" && $tujuan <> "")
											{
												//echo "3";
												$query .= " c.kod_jbtn = '$jbtn' and a.jenispermohonan = '$tujuan'"; 
											}
												
//--------------kalau cari by jabatan, tarikhmula dan tarikhhingga---------------dah
											else if ($jbtn <> "" && $tarikhmula <> "" && $tarikhhingga <> "")
											{
												//echo "4";
												$query .= "  c.kod_jbtn = '$jbtn' and a.tarikhpergi >= '$tmula1' and a.tarikhpergi <= '$thingga1'"; 
											}
											
//--------------kalau cari by jabatan jerr---------------dah
											else if ($jbtn <> "")
											{
												//echo "5";
												$query .= " c.kod_jbtn = '$jbtn'"; 
											}
											
//--------------kalau cari by tarikh mula n tarikh hingga---------------dah
											else if ($tarikhmula <> "" && $tarikhhingga <> "")
											{
												//echo "6";
												echo $query .= " a.tarikhpergi >= '$tmula1' AND a.tarikhpergi <= '$thingga1'";
											}
											
//--------------kalau cari by jenis permohonan---------------dah

											else if ($tujuan <> "")
											{
												//echo "7";
												$query .= " a.jenispermohonan = '$tujuan'"; //cari jenis permohonan utk appear description kat output
											}
											else
											{
												$query .= "";
											}
											
											//awin 8/1/2015 - JPK
											if($role == '01')
											{
												$query = $query . " and c.kod_jbtn = '$offcode'";
											}
											else
											{
												$query = $query . " ";
											}


//echo $query;
$result = mysql_query($query);
$ada = mysql_num_rows($result);
$bil = 1;
if ($ada > 0)
{
		while ($data = mysql_fetch_array($result))
		{
			// value dalam table yang u nak view !!!!
			$useridpegawai = $data["userid"];
			$koddestinasi = $data["tempat"];//nak cari destinasi dlm ref_country
			$jnsmohon = $data["jenispermohonan"];
			$pnama_seminar = $data["nama_seminar"];
			$pbelanja = $data["belanja"];
			
			$tpergi = $data["tarikhpergi"]; //yyyy-mm-dd
			$tpergi1 = explode("-",$tpergi); //buang -
			$tpergi2 = $tpergi1[2]."/".$tpergi1[1]."/".$tpergi1[0];  //dd-mm-yyyy
		
			$tpulang = $data["tarikhpulang"]; //yyyy-dd-mm
			$tpulang1 = explode("-",$tpulang); //buang -
			$tpulang2 = $tpulang1[2]."/".$tpulang1[1]."/".$tpulang1[0];  //dd/mm/yyyy
		
		
		//query2 utk appear namapegawai, jabatan, 
		$query2 = "select a.nama_pgw, b.nick_desc as jabatan from intrayprofile a, intrayrefjabatan b where a.jabatan=b.kod_jbtn and a.userid = '$useridpegawai'";
		//echo $query2;
		$result2 = mysql_query($query2);
		$data2 = mysql_fetch_array($result2);
		$namapegawai = $data2["nama_pgw"];
		$namajabatan = $data2["jabatan"];
		
		if ($jnsmohon == 'F0000001')
		{
		//query3 utk ref_country  
		$query3 = "select description from ref_country where country_code = '$koddestinasi'";
		$result3 = mysql_query($query3);
		$data3 = mysql_fetch_array($result3);
		$destinasi = $data3["description"];
		}
		else
		{
		$destinasi = $koddestinasi;
		}
		//$namajabatan = $data2["jabatan"];
		
		//query4 utk appear jenispermohonan
		$query4 = "select descpermohonan from intrayreftujuan where jenispermohonan = '$jnsmohon'";
		$result4 = mysql_query($query4);
		$data4 = mysql_fetch_array($result4);
		$descmohon = $data4["descpermohonan"];
		
		//query untuk appear rasmi - F0000002
		if ($jnsmohon == 'F0000002')
		{
		$query5 = "select nama_seminar, belanja from intrayinfo where userid = '$useridpegawai'";
		$result5 = mysql_query($query5);
		$data5 = mysql_fetch_array($result5);
		$pnama_seminar = $data5["nama_seminar"];
		$pbelanja = $data5["belanja"];
		}
		//output appear data
		?>
		  <tr>
			<td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" align="center"><?php echo $bil;?>.</td>
			<td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0"><?php echo $namapegawai;?></td>
			<td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" align="center"><?php echo $namajabatan;?></td>
			<td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" align="center"><?php echo $destinasi;?></td>
			<td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" align="center"><?php echo $tpergi2;?></td>
			<td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" align="center"><?php echo $tpulang2;?></td>
		<td align="center" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0"><?php 
			if ($jnsmohon == 'F0000002')
			{
			echo $pnama_seminar;
			}
			else
			{
			?>
			&nbsp;
			<?php
			}
			?></td>
			<td align="center" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0"><?php 
			if ($jnsmohon == 'F0000002')
			{
			echo $pbelanja;
			}
			else
			{
			?>
			&nbsp;</td>
			<?php
			}
			?>
			
		  </tr>
		  <?php
		  $bil = $bil + 1;
		  }
		  
}
else
{
?>
<tr>
    <td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" colspan="8" align="center"> Data Tiada </td>
</tr>
<?php
} // tutup else rasmi
?>
<tr bgcolor="#999999">
    <td height="25" colspan="9" align="center" style="border-bottom: 1px solid #a4c8e0"><strong>PERIBADI</strong></td>
  </tr>
  <tr bgcolor="#C8E954">
    <td width="23" height="34" align="center" bgcolor="#DF7B7B" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" ><strong>Bil</strong></td>
	<td align="center" bgcolor="#DF7B7B" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" colspan="2"><strong>Nama</strong></td>
    <td colspan="2" align="center" bgcolor="#DF7B7B" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" ><strong><strong><strong>Bahagian / Jabatan</strong></strong></strong></td>
    <td width="109" align="center" bgcolor="#DF7B7B" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" ><strong><strong><strong>Destinasi</strong></strong></strong></td>
	 <td width="182" align="center" bgcolor="#DF7B7B" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" ><strong>Tarikh Pergi</strong></td>
	 <td width="140" align="center" bgcolor="#DF7B7B" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0"><strong>Tarikh Pulang</strong></td>
		 </tr>
<?php
$query = "select a.*, c.kod_jbtn from intrayinfo a, intrayprofile b, intrayrefjabatan c where a.userid = b.userid AND b.jabatan = c.kod_jbtn AND a.jenispermohonan = 'F0000001' AND";

//--------------kalau cari by jabatan, tarikhmula, tarikhhingga, jenispermohonan---------------dah
											if ($jbtn <> "" && $tarikhmula <> "" && $tarikhhingga <> "" && $tujuan <> "")
											{
												//echo "1";
												$query .= " c.kod_jbtn = '$jbtn' and a.tarikhpergi >= '$tmula1' AND a.tarikhpergi <= '$thingga1' and a.jenispermohonan = '$tujuan'"; 
											}
//--------------kalau cari by tarikhmula, tarikhhingga, jenispermohonan---------------dah
											else if ($tujuan <> "" && $tarikhmula <> "" && $tarikhhingga <> "")
											{
												//echo "2";
												$query .= " a.tarikhpergi >= '$tmula1' AND a.tarikhpergi <= '$thingga1' and a.jenispermohonan = '$tujuan'"; 
											}

//--------------kalau cari by jabatan, jenispermohonan---------------dah
											else if ($jbtn <> "" && $tujuan <> "")
											{
												//echo "3";
												$query .= " c.kod_jbtn = '$jbtn' and a.jenispermohonan = '$tujuan'"; 
											}
												
//--------------kalau cari by jabatan, tarikhmula dan tarikhhingga---------------dah
											else if ($jbtn <> "" && $tarikhmula <> "" && $tarikhhingga <> "")
											{
												//echo "4";
												$query .= "  c.kod_jbtn = '$jbtn' and a.tarikhpergi >= '$tmula1' and a.tarikhpergi <= '$thingga1'"; 
											}
											
//--------------kalau cari by jabatan jerr---------------dah
											else if ($jbtn <> "")
											{
												//echo "5";
												$query .= " c.kod_jbtn = '$jbtn'"; 
											}
											
//--------------kalau cari by tarikh mula n tarikh hingga---------------dah
											else if ($tarikhmula <> "" && $tarikhhingga <> "")
											{
												//echo "6";
												echo $query .= " a.tarikhpergi >= '$tmula1' AND a.tarikhpergi <= '$thingga1'";
											}
											
//--------------kalau cari by jenis permohonan---------------dah

											else if ($tujuan <> "")
											{
												//echo "7";
												$query .= " a.jenispermohonan = '$tujuan'"; //cari jenis permohonan utk appear description kat output
											}
											else
											{
												$query .= "";
											}
											
											//awin 8/1/2015 - JPK
											if($role == '01')
											{
												$query = $query . " and b.jabatan = '$offcode'";
											}
											else
											{
												$query = $query . " ";
											}

//echo $query;
$result = mysql_query($query);
$ada = mysql_num_rows($result);
$bil = 1;
if ($ada > 0)
{
		while ($data = mysql_fetch_array($result))
		{
			// value dalam table yang u nak view !!!!
			$useridpegawai = $data["userid"];
			$koddestinasi = $data["tempat"];//nak cari destinasi dlm ref_country
			$jnsmohon = $data["jenispermohonan"];
			
			$tpergi = $data["tarikhpergi"]; //yyyy-mm-dd
			$tpergi1 = explode("-",$tpergi); //buang -
			$tpergi2 = $tpergi1[2]."/".$tpergi1[1]."/".$tpergi1[0];  //dd-mm-yyyy
		
			$tpulang = $data["tarikhpulang"]; //yyyy-dd-mm
			$tpulang1 = explode("-",$tpulang); //buang -
			$tpulang2 = $tpulang1[2]."/".$tpulang1[1]."/".$tpulang1[0];  //dd/mm/yyyy
		
		
		//query2 utk appear namapegawai, jabatan, 
		$query2 = "select a.nama_pgw, b.nick_desc as jabatan from intrayprofile a, intrayrefjabatan b where a.jabatan=b.kod_jbtn and a.userid = '$useridpegawai'";
		//echo $query2;
		$result2 = mysql_query($query2);
		$data2 = mysql_fetch_array($result2);
		$namapegawai = $data2["nama_pgw"];
		$namajabatan = $data2["jabatan"];
		
		if ($jnsmohon == 'F0000001')
		{
		//query3 utk ref_country  
		$query3 = "select description from ref_country where country_code = '$koddestinasi'";
		$result3 = mysql_query($query3);
		$data3 = mysql_fetch_array($result3);
		$destinasi = $data3["description"];
		}
		else
		{
		$destinasi = $koddestinasi;
		}
		//$namajabatan = $data2["jabatan"];
		
		//query4 utk appear jenispermohonan
		$query4 = "select descpermohonan from intrayreftujuan where jenispermohonan = '$jnsmohon'";
		$result4 = mysql_query($query4);
		$data4 = mysql_fetch_array($result4);
		$descmohon = $data4["descpermohonan"];
		

		//output appear data
		?>
		  <tr>
			<td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" align="center"><?php echo $bil;?>.</td>
			<td colspan="2" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0"><?php echo $namapegawai;?></td>
			<td colspan="2" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" align="center"><?php echo $namajabatan;?></td>
			<td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" align="center"><?php echo $destinasi;?></td>
			<td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" align="center"><?php echo $tpergi2;?></td>
			<td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" align="center"><?php echo $tpulang2;?></td>
				
			
		  </tr>
		  <?php
		  $bil = $bil + 1;
		  }
		  
}
else
{
?>
<tr>
    <td style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0" colspan="9" align="center"> Data Tiada </td>
</tr>
<?php
} // tutup else
?>
</table>
</form>
<!-- entable besar --></td>
  </tr>
  <tr><td><br /></td></tr>
</table>
<?php include "footer.php";?>
</body>
</html>

