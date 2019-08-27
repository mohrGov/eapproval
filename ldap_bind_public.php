<?php
include ("_common/conn.php");
include ("controlfx.php");
session_start();

$login1 = (isset($_POST['login1'])) ? trim($_POST['login1']) : '';
$passwd = (isset($_POST['passwd'])) ? trim($_POST['passwd']) : '';

$login1 = quote2entities($login1);
$passwd = quote2entities($passwd);

define('LDAP_OPT_DIAGNOSTIC_MESSAGE', 0x0032);


############################################# awin tambah #########################################
$query7 = "Select userid, passwd, jabatan from intraytempuserluar where userid ='$login1' and passwd = '$passwd' and flagsah = 'Y'";
$result7 = mysql_query($query7);
$wujud7 = mysql_num_rows($result7);

 if (!$result7)
	{exit("Error in SQL 7");}

	if ($wujud7)
	{
		$data7 = mysql_fetch_array($result7);
		$userid = $data7['userid'];
		$mydept = $data7['jabatan'];
				
		$query8 = "Select role, rank from intrayusers where userid ='$login1'";
		$result8 = mysql_query($query8);
		 if (!$result7)
			{exit("Error in SQL 8");}
			
		$data8 = mysql_fetch_array($result8);
		$role = $data8['role'];
		$myrank = $data8['rank'];
				
		$_SESSION["userid"] = "$userid";
		$_SESSION["role"] = "$role";
		$_SESSION["offcode"] = "$mydept";
		$_SESSION["rank"] = "$myrank";
?>
		<script>
		location.href="inbox.php";
		</script>
<?php
	}
	else
	{
		session_unset(); 
		session_destroy(); 
		?>
		<script>
		alert("Anda tak dibenarkan menggunakan sistem");
		location.href="index.php";
		</script>
	<?php
	}

?>