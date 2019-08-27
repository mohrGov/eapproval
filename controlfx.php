<?php
function quote2entities($string,$entities_type='number')
{
    $search                     = array("\"","'");
    $replace_by_entities_name   = array("&quot;","&apos;");
    $replace_by_entities_number = array("&#34;","&#39;");
    $do = null;
    if ($entities_type == 'number')
    {
        $do = str_replace($search,$replace_by_entities_number,$string);
    }
    else if ($entities_type == 'name')
    {
        $do = str_replace($search,$replace_by_entities_name,$string);
    }
    else
    {
        $do = addslashes($string);
    }
    return $do;
}
?>