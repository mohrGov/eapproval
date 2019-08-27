<?php
require ("_common/conn.php");
require ("_common/session.php");
require ("_common/global.php");
include "convertdate.php";
include "current_date.php";

$kn = (isset($_POST['kn'])) ? mysql_real_escape_string(trim($_POST['kn'])) : '';

$query = "select b.descrole from intrayusers a, intrayrefrole b where a.userid = '$kn' and a.role = b.idrole";
$result = mysql_query($query);

 	if(!$result) 
	{
		echo "Error:";
		exit();
	}
		  
	$datachild = mysql_fetch_array($result);
	$myrole = $datachild['descrole'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head></head>
<title><?php echo SYSTEM_TITLE ?></title></head>
<link rel="stylesheet" href="css/main.css" type="text/css">
<form action="proadagensi.php" method="post" name="mof">
<body>
<!-- table besar --------------------------------------------------------------------------------------------------------------------------->
<table width="1035" border="0" align="center" cellpadding="0"  cellspacing="0" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0">
<?php include "header.php";?>
<?php include "menumenu.php";?>
<tr><td width="1033"><br /></td></tr>
<tr>
<td>
<!-- table tab -->
<table width="979" border="0" align="center" cellpadding="5"  cellspacing="0" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0">
  <tr bgcolor="#cc3333">
    <td height="30" colspan="8" style="border-bottom: 1px solid #a4c8e0"><strong>Tambah Maklumat Admin Agensi : </strong></td>
  </tr>
  <!--<tr>
    <td width="225" height="45">Jabatan</td>
    <td width="5">:</td>
    <td width="717"><select name="jbtn" id="jbtn">
      <option value=""><< Sila Pilih >></option>
      <?php
	   $gen = mysql_query("select * from intrayrefjabatan order by kod_jbtn");
	   $bilgen = mysql_num_rows($gen);
	   for($ig=0;$ig < $bilgen;$ig++){
	   	$datagen = mysql_fetch_array($gen);
	   	echo'<option value="'.$datagen["kod_jbtn"].'" >'.$datagen["nama_jbtn"].'</option>';
	   }
	   ?>
    </select></td>
  </tr>-->
  <tr>
          <td>Jabatan/Pejabat <span class="style1">*</span></td>
          <td>:</td>
          <td><select name="jbtn" id="jbtn">
            <option value="<?php echo $jabatan; ?>" > <?php echo $nama_jbtn;?> </option>
            <?php
	   $gen = mysql_query("select * from intrayrefjabatan where kodref=1 order by kod_jbtn");
	   $bilgen = mysql_num_rows($gen);
	   for($ig=0;$ig < $bilgen;$ig++){
	   	$datagen = mysql_fetch_array($gen);
	   	echo'<option value="'.$datagen["kod_jbtn"].'" >'.$datagen["nama_jbtn"].'</option>';
	   }
	   ?>
          </select></td>
        </tr>		
        
<tr>
  <td width="202" height="33">Userid (sila gunakan userid emel rasmi) <span class="style1">*</span></td>
  <td width="5">:</td>
  <td width="404"><input name="userid" type="text" id="userid"/>
  <tr>
  <td height="33">Kata Laluan<span class="style1"> * </span></td>
  <td>:</td>
  <td><input name="passwrd" type="password" id="password" size="20"/></td>
</tr>
<tr>
  <td height="33">Nama Penuh <span class="style1">*</span> </td>
  <td>:</td>
  <td><input name="nama" type="text" id="nama" size="50" /></td>
</tr>
<tr>
  <td height="33">No.KP<span class="style1"> * </span></td>
  <td>:</td>
  <td><input name="nokp" type="text" id="nokp" size="20"/></td>
  </tr>
<tr>
  <td>Jawatan <span class="style1">*</span> </td>
  <td>:</td>
        <td>          <select name="jwtn" id="jwtn"> 
		<option value="<?php echo $jawatan; ?>" > <?php echo $nama_jwtn;?> </option>
       <?php
	   $gen = mysql_query("select * from intrayrefjawatan order by nama_jwtn");
	   $bilgen = mysql_num_rows($gen);
	   for($ig=0;$ig < $bilgen;$ig++){
	   	$datagen = mysql_fetch_array($gen);
	   	echo'<option value="'.$datagen["kod_jwtn"].'" >'.$datagen["nama_jwtn"].'</option>';
	   }
	   ?>
    </select>
          </select></td>
</tr>
    <td></td>
    <td height="34"></td>
    <td align="right"><input type="submit" name="Submit_btn" value=" Hantar " />
        <input type="submit" name="reset" value="  Reset  " /></td>
  </tr>
   </table></td>
  </tr>
  <tr><td><br /></td></tr>
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