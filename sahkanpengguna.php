<?php
require ("_common/conn.php");
require ("_common/session.php");
require ("_common/global.php");
include "convertdate.php";
include "current_date.php";

$namebaru = ($_POST['namebaru']);
$Submit_btn = (isset($_POST['Submit_btn'])) ? (trim($_POST['Submit_btn'])) : '';

foreach ($namebaru as $value)
{
	if ($Submit_btn)
	{
		$query7 = "Select passwd, nama, jabatan, jawatan from intraytempuserluar where userid ='$value'";
		$result7 = mysql_query($query7);
		$data7 = mysql_fetch_array($result7);
		
		$passwdbaru = $data7['passwd'];
		$namabaru = $data7['nama'];
		$nokpbaru = $data7['nama'];
		$jabbaru = $data7['jabatan'];
		$jawbaru = $data7['jawatan'];
		
		
		$query = "insert into intrayprofile (userid, nokp, nama_pgw, jawatan, jabatan) values ('$value', '$nokpbaru', '$namabaru','$jawbaru', '$jabbaru')";
		$result = mysql_query($query);
		if(!$result) 
		{
			echo "Error 1:";
			exit();
		}
		
		//update flag dulu
		$query6 = "Update intraytempuserluar set  flagsah = 'Y', updateddate = '$datum', updatedby = '$userid' where userid='$value'";
		$result6 = mysql_query($query6);
			if (!$result6)
			{exit("Error in SQL 6");}
			
			?>
			<script>
			alert("Maklumat telah dimasukkan.");
			window.location="sahpengguna.php";
			</script>
			<?php
		} // end submit
	
} // end foreach
?>