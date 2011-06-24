<?php

$con = mysql_connect("localhost","root","kunalmysql");
if (!$con)
{
	die('Could not connect: ' . mysql_error());
}
mysql_select_db('site2',$con);
$sqlmt = "SELECT nid,field_obit_member_id_value from content_type_obit_user_links";
$rsmd = mysql_query($sqlmt) or die($sqlmt. mysql_error());
$r = 0;
$oldCode = "";
//echo "<pre>";
//$rowmd = mysql_fetch_array($rsmd);
//print_r($rowmd['id']);
$r=100;

while($rowmd = mysql_fetch_array($rsmd))
{
//print_r($rowmd);
print_r("\n".$rowmd['nid']);

$r=$r+1;
$sqlnp = "INSERT INTO url_alias (pid,src,dst)VALUES ( $r,'node/".trim($rowmd['nid'])."','obituary/user/show/template?id=".trim($rowmd['field_obit_member_id_value'])."')";
$ins = mysql_query($sqlnp) or die($sqlnp." :: ".mysql_error());


//$sqlnp2 = "INSERT INTO node (nid,vid,type,title,uid,status)VALUES ( $r,$r,'obit_user_links','".mysql_real_escape_string(trim($rowmd['fname']))."','1','1')";
//$ins2 = mysql_query($sqlnp2) or die($sqlnp." :: ".mysql_error());

}

?>

