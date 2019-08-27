<?php 

  //$db = mysql_connect( "localhost", "username", "password") 
  $db = mysql_connect( "10.21.81.109", "root", "") 
	    or die( "Connection Failed!" );

  mysql_select_db( "kpm_eapproval", $db ) 
        or die( "Select database failed 1" );
?>