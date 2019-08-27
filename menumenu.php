<?php
require ("_common/conn.php");
?>
<link rel="stylesheet" type="text/css" href="chrometheme/chromestyle4.css" />
<script type="text/javascript" src="chromejs/chrome.js">
/***********************************************
* Chrome CSS Drop Down Menu- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
***********************************************/
</script>
<tr> 
<td>
<div class="chromestyle" id="chromemenu">
<ul>
	<li><a href="inbox.php">Peti Masuk</a></li>
	<?php 
	if ($role != '99')
	{
	?>
	<li><a href="syarat.php">Permohonan Baru</a></li>
	<?php
	}
	
	if ($role <> '')
	{
	?>
		<li><a href="carian.php">Carian</a></li>
		<li><a href="carianlaporan.php">Laporan</a></li>
		<?php
		if ($role == '03' || $role == '00' || $role == '09')
		{
		?>
		<li><a href="#" rel="dropmenu1">Kes Khas</a></li>
		<li><a href="#" rel="dropmenu2">Admin</a></li>
		<?php
		}
	}
	?>
	
	<li><a href="#" rel="dropmenu3">Bantuan</a></li>
	<li><a href="logout_user.php">Keluar</a></li>
</ul>
</div>
<!--1st drop down menu -->                                                   
<div id="dropmenu1" class="dropmenudiv" style="width: 210px;">
<?php if ($role == '03' || $role == '00')
{
?>
<a href="khas.php">Daftar Kes Khas</a>
<a href="listkhas.php">Senarai Kes Khas</a>
</div>
<?php 
}
if ($role == '09')
{ ?>
<a href="khas_agensi.php">Daftar Kes Khas</a>
<a href="listkhas_agensi.php">Senarai Kes Khas</a>
<?php 
}
?>
</div>
<!--1st drop down menu -->                                                   
<div id="dropmenu2" class="dropmenudiv" style="width: 249px;">
<?php
if ($role == '03' || $role == '00')
{
?>
<a href="addagensi.php">Admin Agensi</a>
<a href="myuser.php">Pengurusan Pengguna</a>
<?php
}

if ($role == '09')
{
?>
<a href="sahpengguna.php">Pengguna Baru</a>
<a href="usermgmt_staffagensi.php">Pengurusan Pengguna</a>
<a href="myuser_agensi.php">Pengurusan Peranan Pengguna</a>
<?php
}
?>
</div>

<!--1st drop down menu -->                                                   
<div id="dropmenu3" class="dropmenudiv" style="width: 249px;">
<a href="manual.php">Manual Pengguna</a>
<a href="changepasswd.php">Tukar Katalaluan</a>

</div>
<script type="text/javascript">

cssdropdown.startchrome("chromemenu")

</script>

