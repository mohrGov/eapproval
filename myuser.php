<?php
require ("_common/conn.php");
require ("_common/session.php");
require ("_common/global.php");
include "convertdate.php";
include "current_date.php";

$kn = (isset($_POST['kn'])) ? trim($_POST['kn']) : '';

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
<form action="usermgmt.php" method="post" name="mof">
<body>
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
<td width="980" height="30" bgcolor="#cc3333"><strong>Pengurusan Pengguna  :</strong></td>
</tr>
<tr>
<td><table width="979" border="0" align="center" cellpadding="5"  cellspacing="0" style="border-left: 1px solid #a4c8e0; border-right: 1px solid #a4c8e0; border-top: 1px solid #a4c8e0; border-bottom: 1px solid #a4c8e0">
  <tr bgcolor="#DF7B7B">
    <td height="30" colspan="8" style="border-bottom: 1px solid #a4c8e0"><strong>Paparan Maklumat Pengguna </strong></td>
  </tr>
  <tr>
    <td width="225" height="45">Jabatan</td>
    <td width="5">:</td>
    <td width="717">
	<?php
	if ($role == '09')
	{
		$query1 = "select nama_jbtn from intrayrefjabatan where kod_jbtn = '$offcode'";
		$result1 = mysql_query($query1);

 		if(!$result1) 
		{
		echo "Error4:";
		exit();
		}
	  	$data = mysql_fetch_array($result1);
		$namaoffice = $data['nama_jbtn'];
		
		echo $offcode . " - " . $namaoffice; 
	}
	else
	{
	?>
	<select name="jbtn" id="jbtn">
      <option value=""><< Sila Pilih >></option>
      <?php
	 		$gen = mysql_query("select * from intrayrefjabatan where kodref <> '1' order by kod_jbtn");
			$bilgen = mysql_num_rows($gen);
			for($ig=0;$ig < $bilgen;$ig++){
			$datagen = mysql_fetch_array($gen);
			echo'<option value="'.$datagen["kod_jbtn"].'" >'.$datagen["nama_jbtn"].'</option>';
			}
	}
	  ?>
    </select>
	</td>
  </tr>
  <tr>
    <td width="225" height="45">Peranan </td>
    <td width="5">:</td>
    <td width="717"><select name="rolebaru" id="rolebaru">
   		<option value=""><< Sila Pilih >></option>
   <?php //jenis permohonan
   if ($role == '09')
	{
		$query = mysql_query("select * from intrayrefrole where idrole in ('01','02')");
	}
	else
	{
 	 	$query = mysql_query("select * from intrayrefrole");
	}
  		$bilJenis = mysql_num_rows($query);

		  for($i=0;$i<$bilJenis;$i++) {
		  $dataJenis = mysql_fetch_array($query);
		  ?>
              <option value="<?php echo $dataJenis["idrole"]; ?>"><?php echo $dataJenis["descrole"]; ?></option>
          <?php } ?>
            </select>            </td>
  </tr>
  <tr>
    <td></td>
    <td height="34"></td>
    <td align="right"><input type="submit" name="Submit_btn" value=" Hantar " />
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
    <tr><td><br /></td></tr>
</table>
<?php include "footer.php";?>
</body></form>
</html>

<iframe name="gToday:normal:agenda.js" id="gToday:normal:agenda.js"
src="ipopeng.php" scrolling="no" frameborder="0"
style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>