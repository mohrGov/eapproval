<?
 // connect to ldap server
    $ds = ldap_connect("ldap.mohr.gov.my")
    or die("Could not connect to LDAP server.");

if (!$ds) 
{
    echo "<h4>Unable to connect to LDAP server</h4>";
}
?> 
