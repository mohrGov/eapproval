<?php
require ("_common/conn.php");
require ("_common/global.php");
require ("_common/session.php");
include "convertdate.php";
include "current_date.php";

$edit_btn = (isset($_POST['edit_btn'])) ? trim($_POST['edit_btn']) : '';
$submit_btn = (isset($_POST['submit_btn'])) ? trim($_POST['submit_btn']) : '';

if ($edit_btn)
{
############################################################################################################################################################
?>

<script>
window.location.href="oversea_personal.php";
</script>
<?php
}
else
{
?>

<script>
window.location.href="oversea.php";
</script>
<?php
}
?>
