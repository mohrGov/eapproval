<?php
session_cache_expire(2);
$cache_expire = session_cache_expire();

if(!isset($_SESSION['userid']))
{

    $msg = "Your session is expired...Please login again";
    header("Location: index.php?msg=".$msg);

}	

?>