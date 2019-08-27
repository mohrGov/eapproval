<?php
//hantar mail
	$email = "norazwin@mohr.gov.my";
	$headers = 'From: eApproval@mohr.gov.my' . "\r\n" .
	   'Reply-To: eApproval@mohr.gov.my' . "\r\n" .
	   'X-Mailer: PHP/' . phpversion();
	$subject1 = "eapproval : Kelulusan Keluar Negara";
	$message1 = "Untuk makluman : \r\n Terdapat satu permohonan kelulusan keluar negara yang perlu disokong segera.\r\n Sila login : \r\n 1)sistem (http://myhos.mohr.gov.my/eapproval) atau \r\n 2) login melalui web (http://www.mohr.gov.my --> intranet) untuk membuat semakan tersebut"; 
	mail($email, $subject1, $message1, $headers);
?>
