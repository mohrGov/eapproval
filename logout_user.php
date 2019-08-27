<?php
require ("_common/global.php");
require ("_common/conn.php");
			


session_start();

		$query7 = "Select userid, passwd, jabatan from intraytempuserluar where userid ='".$_SESSION["userid"]."'";
		$result7 = mysql_query($query7);
		$wujud7 = mysql_num_rows($result7);

		 if (!$wujud7){
		 	session_unset();
		 	session_destroy();
		 	header("Location:http://gerbang.mohr.gov.my");
		 }

		 session_unset();
		 session_destroy();
?>
<script language="JavaScript">
alert ("Terima kasih kerana menggunakan sistem ini");
window.location="index.php";
</script>
	
			
	
