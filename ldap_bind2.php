<?php
include ("_common/conn.php");
include ("controlfx.php");
session_start();

$login1 = (isset($_GET['user'])) ? trim($_GET['user']) : '';
$login1 = quote2entities($login1);

define('LDAP_OPT_DIAGNOSTIC_MESSAGE', 0x0032);

$handle = ldap_connect("ldap://10.21.81.174/");

############################################# awin tambah #########################################
$query = "Select userid from intrayprofile where userid ='$login1'";
$result = mysql_query($query);
$wujud = mysql_num_rows($result);

 if (!$result)
	{exit("Error in SQL 1");}

//nak masukkan jabatan nama pegawaidalam table kita one time only
//ldaps search
$mailnya = $login1 . "@mohr.gov.my";
$sr=ldap_search($handle, "ou=People,o=mohr.gov.my", "mail=$mailnya");
$jum = ldap_count_entries($handle, $sr);  
// vie
$info = ldap_get_entries($handle, $sr);
			
	if ($jum != 0)
	{ //-- 2
    	$j = 0;
    	for ($i=0; $i<$info["count"]; $i++) 
		{ //-- 3
			// only valid record
			$des = $info[$i]["employeetype"][0];
			$mstatus = $info[$i]["mailuserstatus"][0];

			if (! ($des == 'CMID' || $des == '' || $des == 'X' || $mstatus == 'Inactive') ) 
			{ //-- 4
			
			$no_kp[$j] = $info[$i]["employeenumber"][0];
			$nama[$j] = $info[$i]["cn"][0];
			$email[$j] = $info[$i]["mail"][0];
			$design[$j] = $info[$i]["employeetype"][0];
			$title[$j] = $info[$i]["title"][0];
			$dept[$j] = $info[$i]["physicaldeliveryofficename"][0];
			$bhgn[$j] = $info[$i]["departmentNumber"][0];
			$unit[$j] = $info[$i]["description"][0];
			$tel[$j] = $info[$i]["telephonenumber"][0];
			$gred[$j] = $info[$i]["manager"][0];
			$st[$j] = $info[$i]["st"][0];
			
			$j = $j + 1;	
			
				} // end if cmd //-- 4
			} // enf dor //-- 3
			array_multisort($nama, $no_kp, $email, $design, $gred, $title, $descjob, $descdept, $st, $namanegeri, $bhgn, $unit, $namabhgn, $namaunit);
if ($wujud > 0)
{//-- 5
		$data = mysql_fetch_array($result);
		$userid = $data['userid'];
		$role = $data['role'];
		for ($i=0; $i < $j; $i++) 
		{ //-- 6
		$namaku = addslashes($nama[$i]);
		$jabatan = addslashes($dept[$i]);
		//update profile
		//
		$query6 = "Update intrayprofile set nama_pgw='$namaku',nokp='$no_kp[$i]',email= '$email[$i]',jawatan ='$title[$i]',jabatan='$dept[$i]',gred_jwtn='$gred[$i]' where userid='$userid'";
		$result6 = mysql_query($query6);
			if (!$result6)
			{exit("Error in SQL 6");}
		} //6	
}
else
{
	$userid = $login1;
		
	for ($i=0; $i < $j; $i++) 
	{ //-- 7
	// insert dalam table
	// select dulu adaer tak userid nih :
	$namaku = addslashes($nama[$i]);
	$jabatan = addslashes($dept[$i]);
	$query4 = "Insert INTO intrayprofile(userid,nama_pgw,nokp,email,jawatan,jabatan) VALUES ('$userid','$namaku','$no_kp[$i]','$email[$i]','$design[$i]','$dept[$i]')";
	$result4 = mysql_query($query4);
		
		if (!$result4)
		{exit("Error in SQL 4");}
	} //7

} // end else wujud -- //-- 5
		
		//cari role
		$query99 = "Select b.jabatan, a.role, a.rank from intrayusers a, intrayprofile b where b.userid ='$login1' and a.userid = b.userid";
		$result99 = mysql_query($query99);
		$wujud99 = mysql_num_rows($result99);

 		if (!$result99)
			{exit("Error in SQL 99");}

		if ($wujud99)
		{
		$data99 = mysql_fetch_array($result99);
		$role = $data99['role'];
		$mydept = $data99['jabatan'];
		$myrank = $data99['rank'];
		}
		
		$_SESSION["userid"] = "$userid";
		$_SESSION["role"] = "$role";
		$_SESSION["offcode"] = "$mydept";
		$_SESSION["rank"] = "$myrank";
} // enf if //-- 2
//kalau dah ader masuk terus inbox
?>
		<script>
		location.href="inbox.php";
		</script>
<?php
################################## end ######################################################################
