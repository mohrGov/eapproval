<?php
require ("_common/conn.php");
session_start();

$userid = (isset($_SESSION['userid'])) ? trim($_SESSION['userid']) : '';
$role =  (isset($_SESSION['role'])) ? trim($_SESSION['role']) : '';
$offcode =  (isset($_SESSION['offcode'])) ? trim($_SESSION['offcode']) : '';
$ref =  (isset($_SESSION['ref'])) ? trim($_SESSION['ref']) : '';
$khas =  (isset($_SESSION['khas'])) ? trim($_SESSION['khas']) : '';
$dari =  (isset($_SESSION['dari'])) ? trim($_SESSION['dari']) : '';
$hingga =  (isset($_SESSION['hingga'])) ? trim($_SESSION['hingga']) : '';
$rank =  (isset($_SESSION['rank'])) ? trim($_SESSION['rank']) : '';
$up =  (isset($_SESSION['up'])) ? trim($_SESSION['up']) : '';
$currentstatus =  (isset($_SESSION['currentstatus'])) ? trim($_SESSION['currentstatus']) : '';


if (empty($userid)) 
{
?>
<script>
//alert("Anda Tidak Dibenarkan Untuk Membuat Capaian Tanpa Log Masuk Bagi Sistem Ini");
window.location="http://myhos.mohr.gov.my/eapproval_sso";
</script>
<?php
}
?>

<?php


		$query7 = "Select userid, passwd, jabatan from intraytempuserluar where userid ='".$userid."'";
		$result7 = mysql_query($query7);
		$wujud7 = mysql_num_rows($result7);

		 if (!$wujud7){
		 	$check = file_get_contents("http://ksmclan.mohr.gov.my/api/aduser/staff?ad_action=authentication&ad_uid=".$userid);
			$data = json_decode($check);

			$currentip = $_SERVER['REMOTE_ADDR'];

			if(!($data->status == "success" && $data->online == 1 && $data->currentip == $currentip && in_array("EAP", $data->businesscategory))){
		 		header("Location:index.php");
		 		session_unset();
				session_destroy();
		 	}
		 	
		 }
		 

?>