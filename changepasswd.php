<?php
require ("_common/conn.php");
require ("_common/global.php");
require ("_common/session.php");
require ("_common/timeout.php");
include "convertdate.php";
include "current_date.php";

//////////paparkan data////////////////////////////////////////////////

$query = "select * from intrayprofile where userid = '$userid'";
$result = mysql_query($query);
$existke = mysql_num_rows($result);

if ($existke > 0)
{
	$bil = 1;
	while ($data = mysql_fetch_array($result))
	{
		$nama_pgw = $data['nama_pgw'];
		$nokp = $data['nokp'];
		$passwd = $data['passwd'];
		$jwtn = $data['jawatan'];
		$jabatan = $data['jabatan'];

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
$queryj = "select * from intrayrefjawatan where kod_jwtn = '$jwtn'";
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
<script type="text/javascript" language="JavaScript">
<!--
//--------------------------------
// This code compares two fields in a form and submit it
// if they're the same, or not if they're different.
//--------------------------------
function checkPasswd(theForm) {
	if(document.form1.password.value == ""){ //  field cannot be empty
      alert("Sila isi maklumat katalaluan.")
       document.form1.password.focus()
     return false;
    }
	if(document.form1.pwVerified.value == ""){ //  field cannot be empty
      alert("Sila isi maklumat sahkan katalaluan.")
       document.form1.pwVerified.focus()
     return false;
    }
	
    if (form1.password.value != form1.pwVerified.value)
    {
        alert('Those password don\'t match!');
		document.form1.password.focus()
        return false;
    } 
	
	//if(document.form1.getElementById("password").value.length >= 12 && document.form1.getElementById("password").value.length <= 6)
    //{
    //    alert('Invalid length, must be 6 - 12 characters!');
    //    return false;
    //}
	
	return true;
}
//-->
</script> 

<style type="text/css">
<!--
.style2 {color: #FF0000}
-->
</style>
</head>
<title><?php echo SYSTEM_TITLE ?></title>
<link rel="stylesheet" href="css/main.css" type="text/css">
<body>
<form action="pro_katalaluan.php" method="post" name="form1" onsubmit="return checkPasswd(this);" >
<!-- table besar --------------------------------------------------------------------------------------------------------------------------->
<table width="1035" border="0" align="center" cellpadding="0"  cellspacing="0" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0">
<?php include "header.php";?>
<?php include "menumenu.php";?>
<tr><td width="1033"><br /></td></tr>
<tr>
<td>
<!-- table tab -->
<table width="1012" border="0" align="center" cellpadding="5"  cellspacing="0" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0">
<tr bgcolor="#a4c8e0">
<td width="980" height="30" bgcolor="#cc3333"><strong>Pengurusan Katalaluan  : <?php echo $nama_pgw . $role;?></strong></td>
</tr>
<tr>
<td><table width="979" border="0" align="center" cellpadding="5"  cellspacing="0" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0">
  <tr bgcolor="#DF7B7B">
    <td height="30" colspan="8" style="border-bottom: 1px solid #a4c8e0"><strong>Kemaskini Maklumat </strong></td>
  </tr>
  <tr>
    <td width="192" height="45" align="right" >Id Pengguna  : </td>
    <td width="308"><strong><?php echo $userid; ?></strong></td>
    <td width="447"> 
	<input type="hidden" name="jabatan" value="<?php echo $offcode;?>" /></td>
  </tr>
      <tr>
      <td align="right"><label for="txtPassword">Katalaluan Baru : <br />(6-12 characters)<span class="required style2">*</span></label></td>
      <td><input name="password" type="password" id="txtPassword" maxlength="12"></td>
      </tr>
    <tr>
      <td align="right"><label for="txtPWVerified">Sahkan Katalaluan Baru : <span class="required style2">*</span></label></td>
      <td><input name="pwVerified" type="password" id="txtPWVerified" maxlength="12"></td>
      </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" value="Hantar" name="btnSubmit">&nbsp;
          <input type="reset" value="Set Semula" name="btnReset"></td>
      <td>&nbsp;</td>
	</tr>
  <tr>
    <td></td>
    
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
</form>
<?php include "footer.php";?>
</body>
</html>

<iframe name="gToday:normal:agenda.js" id="gToday:normal:agenda.js"
src="ipopeng.php" scrolling="no" frameborder="0"
style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>