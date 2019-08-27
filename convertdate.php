<?php

function convertdate($tarikh) {

$timestamp = strtotime($tarikh);
$convertdate = date('d/m/Y', $timestamp);
return($convertdate);
}

function convertdate_back($tarikh) {
//'explode' tarikh to Malaysian version
$str = explode("/", $tarikh);
//$trk = mktime(0,0,0,$str[1],$str[2],$str[0]);
$trk = $str[2] . "-" . $str[1] . "-" . $str[0];
return($trk);
}

function convertdate_mdy($tarikh) {

//'explode' tarikh to Malaysian version
$str = explode("-", $tarikh);
//$trk = mktime(0,0,0,$str[1],$str[2],$str[0]);
$trk = $str[1] . "/" . $str[2] . "/" . $str[0];
return($trk);

}

function convertdatenorm($tarikh) {

//'explode' tarikh to US version
$str = explode("-", $tarikh);
$convertdate = "".$str[2]."-".$str[1]."-".$str[0].""; 
return($convertdate);
}

function convertdatecalculate($tarikh) {
//'explode' tarikh to US version
$str = explode("-", $tarikh);
$convertdate = "".$str[2]."-".$str[1]."-".$str[0].""; 
return($convertdate);

}

function convert_time($time){
$str = explode(":",$time);
$true_time = date('g:i a', mktime($str[0],$str[1],$str[2]));
return($true_time);
}
?>