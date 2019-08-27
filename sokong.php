<?php
require ("_common/conn.php");
require ("_common/session.php");
require ("_common/global.php");
include "convertdate.php";
include "current_date.php";
// sbb dkt sokomh kita dah tau flow dia

$sokong = (isset($_POST['sokong'])) ? mysql_real_escape_string(trim($_POST['sokong'])) : '';
$cuti = (isset($_POST['cuti'])) ? mysql_real_escape_string(trim($_POST['cuti'])) : '';
$catatan = (isset($_POST['catatan'])) ? mysql_real_escape_string(trim($_POST['catatan'])) : '';
$Submit_btn= (isset($_POST['Submit_btn'])) ? mysql_real_escape_string(trim($_POST['Submit_btn'])) : '';

if ($Submit_btn)  // kalau button###################################################################################
{ //1
//check dulu jenis  permohonan
	$queryj = "select jenispermohonan, userid from intrayinfo where idinfo = '$ref'";
	$resultj = mysql_query($queryj);
	$existke = mysql_num_rows($resultj);
	
	while ($dataj = mysql_fetch_array($resultj))
	{//2
		$jp = $dataj['jenispermohonan']; //rasmi atau peribadi
		$pemilik = $dataj['userid']; // siapa mohon
	} //2

	//tambah nak tgk kodref
	############################################
	
	$queryy = "select kodref from intrayrefjabatan where kod_jbtn = '$offcode'";
	$resulty = mysql_query($queryy);
	$existy = mysql_num_rows($resulty);
	
	while ($datay = mysql_fetch_array($resulty))
	{//2
		$refkodpejabat = $datay['kodref']; //nak tau jabatan atau agensi atau bahagian
	} //2
	############################################
	
	
		// cehck dulu sokong atau tidak **********************************************************************************************************
		if ($sokong == 'T') //kalau tak sokong
		{ // 3
			if ($currentstatus == '30') // kalau admin kata tidak lengkap
			{ // 4
				// update intray status semasa
				$query = "update intraystatussemasa set waiting_for =  '$pemilik',  catatan = '$catatan', cuti = '$cuti', keputusan = '$sokong', updatedDate = '$datum', updatedBy = '$userid' where idinfo = '$ref' and kodstatus = '$currentstatus'";
			$result = mysql_query($query);
			if(!$result) 
				{//5
					echo "Errorffff 1:";
					exit();
				}//5
				
				//hantar mail ditolak
				#############################################################
				$email1 = $pemilik. "@mohr.gov.my";
				$headers = 'From: admineap@mohr.gov.my' . "\r\n" .
		   		'Reply-To: admineap@mohr.gov.my' . "\r\n" .
		   		'X-Mailer: PHP/' . phpversion();
				$subject1 = "eapproval : Penolakan Kelulusan eApproval";
				$message1 = "Mohon perhatian YBhg Dato'/Tuan/Puan, \r\nUntuk makluman permohonan anda tidak disokong.\r\n Mohon login ke:  \r\n 1) http://myhos.mohr.gov.my/eapproval atau \r\n  2) melalui Intranet MOHR (http://www.mohr.gov.my) \r\n untuk semakan. \r\n Terima kasih."; 
				mail($email1, $subject1, $message1, $headers);
				
				############################################################
				// chcek dulu ader tak 
				$query2 = "select * from intrayhistory where idinfo = '$ref' and kodstatus = '$currentstatus'";
				$result2 = mysql_query($query2);
				if(!$result2) 
					{ //6
						echo "Error 2:";
						exit();
					} //6
				$data2 = mysql_num_rows($result2);
				
				if ($data2 > 0)
				{ // 7
				$query3 = "update intrayhistory set kodstatus = '$currentstatus', catatan = '$catatan', cuti = '$cuti', lengkap = '$sokong', updatedDate = '$datum', updatedBy = '$userid' where idinfo = '$ref'";
				$result3 = mysql_query($query3);
				if(!$result3) 
					{ //8
						echo "Error 3:";
						exit();
					} //8
				} // 7
				else 
				{	 // 9
					$query1 = "insert into intrayhistory (idinfo,kodstatus,catatan,cuti, lengkap, updateddate,updatedby) values ('$ref','$currentstatus','$catatan','$cuti','$sokong','$datum','$userid')";
				$result1 = mysql_query($query1);
				if(!$result1) 
					{ //10
						echo "Error 1:";
						exit();
					} // 10 end else
				} // 9
				?>
				<script>
				alert("Maklumat telah dikemaskini");
				window.location="inbox.php";
				</script>
				<?php
			}  /// 4 sokong == Y
			else //4 kalau bukan curren sattus 30
			{ //11
				$kodstatus = '99';
				// update intray status semasa
				$query = "update intraystatussemasa set kodstatus = '$kodstatus', waiting_for =  '$pemilik',  catatan = '$catatan', cuti = '$cuti', keputusan = '$sokong', updatedDate = '$datum', updatedBy = '$userid' where idinfo = '$ref'";
			$result = mysql_query($query);
			if(!$result) 
				{//12
					echo "Errorffff 2:";
					exit();
				}//12
				// history
				// chcek dulu ader tak 
				$query2 = "select * from intrayhistory where idinfo = '$ref' and kodstatus = '$kodstatus'";
				$result2 = mysql_query($query2);
				if(!$result2) 
					{//13
						echo "Error 2:";
						exit();
					} //13
				$data2 = mysql_num_rows($result2);
				
				if ($data2 > 0)
				{ // 14
				$query3 = "update intrayhistory set kodstatus = '$kodstatus', catatan = '$catatan', cuti = '$cuti', lengkap = '$sokong', updatedDate = '$datum', updatedBy = '$userid' where idinfo = '$ref'";
				$result3 = mysql_query($query3);
				if(!$result3) 
					{ //15
						echo "Error 3:";
						exit();
					} //15
				} // 14
				else
				{	 // 16
				$query1 = "insert into intrayhistory (idinfo,kodstatus,catatan,cuti, lengkap, updateddate,updatedby) values ('$ref','$kodstatus','$catatan','$cuti','$sokong','$datum','$userid')";
			$result1 = mysql_query($query1);
				if(!$result1) 
					{ //17
						echo "Error 1:";
						exit();
					} //17
				} // end 16
				?>
				<script>
				alert("Maklumat telah dikemaskini");
				window.location="inbox.php";
				</script>
				<?php
			} //11
		//****************************************************************************************************************************************************
		} //kalau sokong 3
else
{ // 18
	// ubah 8/5
	//check next rank dulu
	if ($rank == 'KJ' || $rank == 'T1' || $rank == 'T2' || $rank == 'SU')
	{ //2
		$pcode = 'D';
	} // 2
	else if ($rank == 'KA') // agensi
	{ // 3
		$pcode = 'A';
	} // 3
	else
	{ // 4
		$pcode = 'B';
	} // 4
	//untuk turun kuasa ###########################################awin 15102015##################
	if ($jp == 'F0000002' || ($jp == 'F0000001' && $refkodpejabat == '3')) //rasmi atau bahagain peribadi
	{
		$query10 = "select nextrole, kodstatus from intrayprosesflow where currentstatus = '$currentstatus' and Pcode = '$pcode'"; //lama
	}
	else
	{
		$query10 = "select nextrole, kodstatus from intrayflowperibadi where currentstatus = '$currentstatus' and Pcode = '$pcode'";//baru
	} 
	
	$result10 = mysql_query($query10);
	while ($data10 = mysql_fetch_array($result10))
	{ //19
		$nxrole = $data10['nextrole'];
		$kodstatus = $data10['kodstatus'];
	} //19

//####################################################################################
if ($nxrole <> '')
{ //awin
// siap anex role
//kalau nextrole KJ
	if ($rank == 'KA') //ketua agensi
	{ // 21
		//tgk main jabatan
		$query = "select mainkod from intrayrefjabatan where kod_jbtn = '$offcode'";
		$result = mysql_query($query);
		$existke = mysql_num_rows($result);
	
		while ($data = mysql_fetch_array($result))
		{ //20
			$mainkod = $data['mainkod'];
		} //20
		
		$profile = "select a.userid from intrayprofile a, intrayusers b where a.jabatan = '$mainkod' and b.rank = 'KJ' and a.userid = b.userid";
	} // 21
	else
	{ // 22
			if ($nxrole == '99')
			{ //23
			if ($jp == 'F0000002') //rasmi ksu
			{ //24
				$profile = "select a.userid from intrayprofile a, intrayusers b where b.role = '$nxrole' and b.rank = 'SU' and a.userid = b.userid";
			} //24
			else // peribadi- tksu
			{ //25
				//kalau ketua jabatan - KSU jugak
				//select dari users
				$squery = "select count(*) as ketua from intrayusers where userid = '$pemilik'";
				$sresult = mysql_query($squery);
				
				while ($data = mysql_fetch_array($sresult))
				{ //26
					$ketua = $data['ketua'];
				}
				//kalau ader
				if ($ketua > 0)
				{ //40
				//ksu pelulus
					$profile = "select a.userid from intrayprofile a, intrayusers b where b.role = '$nxrole' and b.rank = 'SU' and a.userid = b.userid";
				} // tutup 40
				else
				{ // 41
				//select jabatan pemohon //tksu
				$query = "select a.jabatan, b.unit_pengurusan from intrayprofile a, intrayrefjabatan b  where a.userid = '$pemilik' AND a.jabatan = b.kod_jbtn";
				$result = mysql_query($query);
				
				while ($data = mysql_fetch_array($result))
				{ //26
					$jabatan = $data['jabatan'];
					$hod = $data['unit_pengurusan'];
				} //26
			
			//select rank //utk KJ
			/*$queryj = "select rank from intrayusers where userid = '$pemilik'";
			$resultj = mysql_query($queryj);
			$dataj = mysql_fetch_array($resultj);
			$newrank = $dataj['rank'];*/
		
				//if ($newrank == '') 
				//{
					if ($hod == 'O')  // kalau operasi
					{ //27
					$profile = "select a.userid from intrayprofile a, intrayusers b where b.role = '$nxrole' and b.rank = 'T1' AND a.userid = b.userid";
					} //27
					else
					{ //28
					$profile = "select a.userid from intrayprofile a, intrayusers b where b.role = '$nxrole' and b.rank = 'T2' AND a.userid = b.userid";
					} //28
				//}
				//else
				//{
				//$profile = "select a.userid from intrayprofile a, intrayusers b where b.role = '$nxrole' and b.rank = 'SU' and a.userid = b.userid";
				//}
			}// else 41
			} //25 else tak rasmi
		}	//23
		else  // bukan 99 nexrole lain 00
		{
		$profile = "select a.userid from intrayprofile a, intrayusers b where b.role = '$nxrole' and a.userid = b.userid"; // selain 99
		}
		
	}  // 22
		$result1 = mysql_query($profile);
		$dataku = mysql_fetch_array($result1);
		$waitingfor = $dataku['userid'];
	
	} //if else
	else
	{
		$waitingfor = '';
	}
	
		
	
		
//******************************************************************************************************************************************************
$query = "update intraystatussemasa set kodstatus = '$kodstatus', waiting_for =  '$waitingfor',  catatan = '$catatan', cuti = '$cuti', keputusan = '$sokong', updatedDate = '$datum', updatedBy = '$userid' where idinfo = '$ref'";
$result = mysql_query($query);
if(!$result) 
	{
		echo "Errorffff 4:";
		exit();
	}

// chcek dulu ader tak 
$query2 = "select * from intrayhistory where idinfo = '$ref' and kodstatus = '$kodstatus'";
$result2 = mysql_query($query2);
if(!$result2) 
	{
		echo "Error 21:";
		exit();
	}
$data2 = mysql_num_rows($result2);

if ($data2 > 1)
{ // 5
$query3 = "update intrayhistory set kodstatus = '$kodstatus', catatan = '$catatan', cuti = '$cuti', lengkap = '$sokong', updatedDate = '$datum', updatedBy = '$userid' where idinfo = '$ref'";
$result3 = mysql_query($query3);
if(!$result3) 
	{
		echo "Error 31:";
		exit();
	}
} // 5
else
{	 // 6
$query1 = "insert into intrayhistory (idinfo,kodstatus,catatan,cuti, lengkap, updateddate,updatedby) values ('$ref','$kodstatus','$catatan','$cuti','$sokong','$datum','$userid')";
$result1 = mysql_query($query1);
if(!$result1) 
	{
		echo "Error 11:";
		exit();
	}
} // 6
//hantar mail kepada next ######################################################
//emel start ********************************************************************************************************************
if (($nxrole <> '99') || ($nxrole <> '')) // kalau bukan ksu
{ // 7
	//kalau nextrole KJ
	if ($rank == 'KA')
	{ // 8
		//tgk main jabatan
		$query = "select mainkod from intrayrefjabatan where kod_jbtn = '$offcode'";
		$result = mysql_query($query);
		$existke = mysql_num_rows($result);
	
		while ($data = mysql_fetch_array($result))
		{
			$mainkod = $data['mainkod'];
		}
		
		$profile = "select a.email from intrayprofile a, intrayusers b where a.jabatan = '$mainkod' and b.rank = 'KJ' and a.userid = b.userid";
	} // 8
	else
	{ // 9
	// sini awin tambah htr emel kat semua yang jaga eapproval haslina. arni, miza#################################################################
		if($nxrole == '03')
		{
			$profile = "select email from refemeladmin";
		}
		##########################################################################
		else
		{
			$profile = "select a.email from intrayprofile a, intrayusers b where b.role = '$nxrole' and a.userid = b.userid";
		}
	}  // 9
		$result1 = mysql_query($profile);
		
		while ($row = mysql_fetch_array($result1))
		{ //10
		$email1 = $row["email"];
		$headers = 'From: admineap@mohr.gov.my' . "\r\n" .
		   'Reply-To: admineap@mohr.gov.my' . "\r\n" .
		   'X-Mailer: PHP/' . phpversion();
		$subject1 = "eapproval : Kelulusan Keluar Negara : Perlu Sokongan/Kelulusan";
		$message1 = "Mohon perhatian YBhg Dato'/Tuan/Puan, \r\n Terdapat satu permohonan keluar negara yang memerlukan sokong/kelulusan YBhg Dato'/Tuan/Puan .\r\n Mohon login ke:  \r\n 1) http://myhos.mohr.gov.my/eapproval atau \r\n  2) melalui Intranet MOHR (http://www.mohr.gov.my) \r\n\r\n Terima kasih."; 
		mail($email1, $subject1, $message1, $headers);
		} // end while end 27/11*/10
} // end kalau bukan ksu // 7
##############################################################
//} // end else
?>
<script>
alert("Maklumat telah dikemaskini");
window.location="inbox.php";
</script>
<?php
} //18
} // end submit button 1
?>