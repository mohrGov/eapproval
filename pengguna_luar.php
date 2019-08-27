<?php
require ("_common/conn.php");
require ("_common/global.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style type="text/css">
<!--
.style1 {color: #CC0000}
-->
</style>
<script type="text/javascript"> 
//**********************************************************************
function validate_form(){

	
	/* if(document.form1.email.value == ""){ // Name field cannot be empty
      alert("Sila isi maklumat Emel.")
       document.form1.email.focus()
     return false;
    }*/
	 if(document.intray.userid.value != ""){
	 var goodEmail = document.intray.userid.value.match(/\b(^(\S+@).+((\.edu)|(\.gov.my)|(\..{2,2}))$)\b/gi);
	if (!goodEmail)
	{
	alert("Sila isi maklumat Emel rasmi anda yang betul. [cth: abc@ciast.gov.my ]")
	document.intray.userid.focus()
	return (false);
	}
	}
	   	
    return true;
}
 
</script>
<title><?php echo SYSTEM_TITLE ?></title></head>
<link rel="stylesheet" href="css/main.css" type="text/css">
<form action="pro_agensi.php" method="post" name="intray" onSubmit="return validate_form();">
<body>
<!-- table besar --------------------------------------------------------------------------------------------------------------------------->
<table width="1035" border="0" align="center" cellpadding="0"  cellspacing="0" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0">
<?php include "header.php";?>
<tr><td width="1033"><br /></td></tr>
<tr>
<td>
<!-- table tab -->
<table width="955" border="0" align="center" cellpadding="5"  cellspacing="0" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0">
<tr bgcolor="#a4c8e0">
<td width="940" height="30" bgcolor="#cc3333"><strong>Pendaftaran Akaun : Pendaftaran ini adalah khusus bagi pegawai-pegawai dari agensi luar KSM (PSMB, PERKESO, PTPK,NIOSH) yang memerlukan kelulusan KSU untuk berurusan ke luar negara, yang diuruskan oleh BPSM KSM sahaja.</strong></td>
</tr>
<tr>
<td>
<table width="643" border="0" align="center" cellpadding="5"  cellspacing="0" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0">
<tr bgcolor="#DF7B7B">
<td height="30" colspan="8" style="border-bottom: 1px solid #a4c8e0"><strong>Sila isi maklumat pegawai berikut :</strong></td>
</tr>
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
  <td width="202" height="33">Userid (sila gunakan emel rasmi anda) <span class="style1">*</span></td>
  <td width="5">:</td>
  <td width="404"><input name="userid" type="text" id="userid"/><!--<span class="style1">[TANPA DOMAIN: '@ciast.gov.my']</span>-->
  <tr>
  <td height="33">Kata Laluan<span class="style1"> * </span></td>
  <td>:</td>
  <td><input name="password" type="password" id="password" size="20"/></td>
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
	   $gen = mysql_query("select * from intrayrefjawatan order by kod_jwtn");
	   $bilgen = mysql_num_rows($gen);
	   for($ig=0;$ig < $bilgen;$ig++){
	   	$datagen = mysql_fetch_array($gen);
	   	echo'<option value="'.$datagen["kod_jwtn"].'" >'.$datagen["nama_jwtn"].'</option>';
	   }
	   ?>
    </select>
          </select></td>
</tr>
         <tr>
           <td><a href="index.php"><img src="images/webl_red_emboss_home.gif" border="0" /></a></td>
           <td height="34"></td>
           <td align="right"><input type="submit" name="Submit" value=" Hantar  " />
            <input type="reset" name="reset" value="  Reset  " /></td>
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
</body></form>
</html>

<iframe name="gToday:normal:agenda.js" id="gToday:normal:agenda.js"
src="ipopeng.php" scrolling="no" frameborder="0"
style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>