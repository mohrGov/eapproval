<?php
require ("_common/conn.php");
require ("_common/session.php");
require ("_common/global.php");
include "convertdate.php";
include "current_date.php";
include "calculateDay.php";

$a = $_POST['joversea'];
$tugas = (isset($_POST['tugas'])) ? trim($_POST['tugas']) : '';

//session kan tugas
$_SESSION["tugas"] = "$tugas";
////////////////////////////////////

if(isset($_POST['Submit']))
{

if ($a!='up' and $a!='ur')
{

?>
	<script language="JavaScript">
	alert("Sila buat pemilihan jenis permohonan");
	window.location.href="oversea.php";
	</script>
<?php

} 

if(empty($_POST['dari']) or empty($_POST['hingga']))
{
	?>
	<script language="JavaScript">
		alert("Sila masukkan tarikh lawatan.");
		window.location.href="oversea.php";
		</script>
	<?php
	
}


	if (isset($a) and ($a=='ur'))
	{
	//check tarikh ok tak?
	$dari = (isset($_POST['dari'])) ? trim($_POST['dari']) : '';
	$hingga = (isset($_POST['hingga'])) ? trim($_POST['hingga']) : '';
	
	$dari = convertdate_back($dari);
	$hingga = convertdate_back($hingga);
	
	$tarikhpergiku = convertdate_mdy($dari);
	$datetoday = convertdate_mdy($datum);
	$date1 = strtotime($tarikhpergiku);
	$date2 = strtotime($datetoday);
	$tempoh = count_days($date1,$date2);
	
	if ($tempoh < 14 && $khas == '')
	{
	?>
	<script language="JavaScript">
		alert("Permohonan anda kurang dari 14 hari sebelum anda bertolak. Sila maklumkan kepada PSM sebagai kes khas.");
		window.location.href="oversea.php";
		</script>
	<?php
	}
	else
	{
	?>
	<script language="JavaScript">
	window.location.href="oversea_rasmi.php";
	</script>
	
	
	
<?php

	}
} 

if (isset($a) and ($a=='up'))
{
	//check tarikh ok tak?
	$dari = (isset($_POST['dari'])) ? trim($_POST['dari']) : '';
	$hingga = (isset($_POST['hingga'])) ? trim($_POST['hingga']) : '';
	$dari=convertdate_back($dari);
	$hingga=convertdate_back($hingga);
	
	$tarikhpergiku = convertdate_mdy($dari);
	$datetoday = convertdate_mdy($datum);
	$date1 = strtotime($tarikhpergiku);
	$date2 = strtotime($datetoday);
	$tempoh = count_days($date1,$date2);
		
	if ($tempoh < 14 && $khas == '')
	{
	?>
	<script language="JavaScript">
		alert("Permohonan anda kurang dari 14 hari sebelum anda bertolak. Sila emelkan maklumkan kepada PSM untuk kes khas ini.");
		window.location.href="oversea.php";
		</script>
	<?php
	}
	else
	{
	?>
	<script language="JavaScript">
		window.location.href="oversea_trasmi.php";
		</script>
	
	<?php
	} 
} // 
$_SESSION["dari"] = "$dari";
$_SESSION["hingga"] = "$hingga";

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
</head>
<style type="text/css">
<!--
.style1 {color: #FF0000}
-->
</style>
<script language="JavaScript">
function myFunction() {
    document.getElementById("intray").reset();
}
</script>
<title><?php echo SYSTEM_TITLE ?></title>
<link rel="stylesheet" href="css/main.css" type="text/css">

<body>

<table width="1035" border="0" align="center" cellpadding="0"  cellspacing="0" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0">
<?php include "header.php";?>
<?php include "menumenu.php";?>
<tr><td width="1033"><br /></td></tr>
<tr>
<td>
<form action="<?php echo $PHP_SELF; ?>"  method="post" name="intray" id="intray">
<!-- table tab -->
<table width="675" border="0" align="center" cellpadding="5"  cellspacing="0" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0">
<tr>
<td width="961" height="30" bgcolor="#cc3333"><strong>Permohonan Lawatan Ke Luar Negeri : <?=$userid;?></strong></td>
</tr>
<tr>
<td>
<table width="630" border="0" align="center" cellpadding="5"  cellspacing="0" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0">
<tr bgcolor="#DF7B7B">
<td height="30" colspan="8" style="border-bottom: 1px solid #a4c8e0"><strong>Jenis Permohonan</strong></td>
</tr>
<tr>
  <td width="109" height="74">Pilihan Menu </td>
  <td width="5">:</td>
  <td width="413" align="left">
   <label>
      <input type="radio" name="joversea" value="up" />
    Urusan Peribadi</label>
	 <br />
  <?php
  
  $query = "select kodref from intrayrefjabatan where kod_jbtn = '$offcode'";
  $result = mysql_query($query);
  $data = mysql_fetch_array($result);
  $refpej = $data['kodref'];
  //echo $refpej;
 // echo $role;
 // echo $rank;

 // if ($role <> '01' && $rank != 'KJ' && $refpej != '2')
 // {
  ?>
      <label>
      <input type="radio" name="joversea" value="ur" />
    Urusan Rasmi (Setelah mendapat surat kelulusan PSM)</label>
	<?
 // }
  ?>
   </td>
</tr>
<tr>
          <td>Tempoh Lawatan <span class="style1">*</span></td>
          <td>:</td>
          <td>Dari : 
            
            <input name="dari" type="text" readonly=true size="15" id="dari" />
			<a onClick="if(self.gfPop)gfPop.fPopCalendar(document.intray.dari);return false;" href="javascript:void(0)"> 
            <img src="images/calendar.png" width="24" height="24" border='0' /></a> 
			
			Hingga : 
            <input name="hingga" type="text" id="hingga" size="15" readonly=true/>
			<a onClick="if(self.gfPop)gfPop.fPopCalendar(document.intray.hingga);return false;" href="javascript:void(0)"> 
            <img src="images/calendar.png" width="24" height="24" border='0'/></a></td>
        </tr>
		 <!--<tr>
          <td height="34"></td>
          <td align="left"><a href="getkLalauan.php">Lupa Kata Laluan ?</a></td>
        </tr>-->
         <tr>
           <td></td>
           <td height="34"></td>
           <td align="right"><input name="tugas" type="hidden" id="tugas" size="50" value="M" />
		   <input type="submit" name="Submit" value=" Hantar  " />
            <input type="submit" onclick="myFunction()" value="  Reset  " /></td>
         </tr>
         <tr>
           <td height="34" colspan="3"><table border="0" cellpadding="5" cellspacing="0" width="330">

           </table>
           Catatan : <span class="style1">*</span> Permohonan hanya dibenarkan dalam tempoh  2 minggu sebelum tarikh lawatan</td>
          </tr>
</table>
<br /></td>
</tr>
</table>
</form>
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