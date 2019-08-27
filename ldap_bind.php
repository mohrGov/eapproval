<?php
include ("_common/conn.php");
include ("controlfx.php");
session_start();

$login1 = isset($_GET['user_id']) ? $_GET['user_id'] : NULL;

$getStaff = file_get_contents("http://ksmclan.mohr.gov.my/api/aduser/staff?ad_action=authentication&ad_uid=".$login1);
$staff = json_decode($getStaff);

$des = $staff->employeetype;
$mstatus = $staff->userstatus;
$no_kp =  $staff->employeenumber;
$nama =  $staff->displayname;
$email =  $staff->mail;
$design =  $staff->employeetype;
$title =  $staff->title;
$dept = $staff->physicaldeliveryofficename;
$bhgn =  $staff->departmentNumber;
$unit =  $staff->description;
$tel =  $staff->telephonenumber;
$gred =  $staff->manager;
$st =  $staff->st;

array_multisort($nama, $no_kp, $email, $design, $gred, $title, $descjob, $descdept, $st, $namanegeri, $bhgn, $unit, $namabhgn, $namaunit);

$query = "Select userid from intrayprofile where userid ='$login1'";
$result = mysql_query($query);
$wujud = mysql_num_rows($result);

if ($wujud > 0)
{//-- 5
		$data = mysql_fetch_array($result);
		$userid = $data['userid'];
		$role = $data['role'];
		
		$namaku = addslashes($nama);
		$jabatan = addslashes($dept);
		//update profile
		//
		$query6 = "Update intrayprofile set nama_pgw='$namaku',nokp='$no_kp',email= '$email',jawatan ='$title',jabatan='$dept',gred_jwtn='$gred' where userid='$userid'";
	//echo $query6; die;
$result6 = mysql_query($query6);
			if (!$result6)
			{exit("Error in SQL 6");}
		
}
else
{
	$userid = $login1;
		
	
	// insert dalam table
	// select dulu adaer tak userid nih :
	$namaku = addslashes($nama);
	$jabatan = addslashes($dept);
	$query4 = "Insert INTO intrayprofile(userid,nama_pgw,nokp,email,jawatan,jabatan) VALUES ('$userid','$namaku','$no_kp','$email','$title','$dept')";
	$result4 = mysql_query($query4);
		
		if (!$result4)
		{exit("Error in SQL 4 :".mysql_error());}
	

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

//kalau dah ader masuk terus inbox

header("Location:inbox.php");


?>