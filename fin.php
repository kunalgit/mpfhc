<?php
require './includes/bootstrap.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);
$_SERVER['REMOTE_ADDR'] = '10.0.1.4';  // to prvent the warning Undefined index: REMOTE_ADDR in /home/kunal/drupal/includes/bootstrap.inc on line 1317

$con = mysql_connect("localhost","root","kunalmysql");
if (!$con)
{
        die('Could not connect: ' . mysql_error());
}
mysql_select_db('site2',$con);
$sqlmt = "SELECT * from ddetails";
$rsmd = mysql_query($sqlmt) or die($sqlmt. mysql_error());
print_r("start: ".strftime('%c')."");
while($rowmd = mysql_fetch_array($rsmd))
{
//print_r($rowmd);
//print_r("\n".$rowmd['id']);
// Construct the new node object.

$node = new stdClass();
// Your script will probably pull this information from a database.
$node->title = "".(trim($rowmd['fname']))."";
$node->body = "";
$node->type = 'obit_user_links';   // Your specified content type
$node->comment = 1;
$node->created = time();
$node->changed = $node->created;
$node->status = 1;
$node->promote = 0;
$node->sticky = 0;
$node->format = 1;       // Filtered HTML
$node->uid = 1;          // UID of content owner
$node->language = 'en';
$node->field_fname[0]['value'] = "".(trim($rowmd['fname']))."";
$node->field_mname[0]['value'] = "".(trim($rowmd['mname']))."";
$node->field_lname[0]['value'] = "".(trim($rowmd['lname']))."";
$node->field_nickname[0]['value'] = "".(trim($rowmd['nickname']))."";
$node->field_sex[0]['value'] = "".(trim($rowmd['sex']))."";
$node->field_birth_date[0]['value'] = "".(trim($rowmd['birth_date']))."";
$node->field_birth_end_date[0]['value'] = "".(trim($rowmd['birth_end_date']))."";
$node->field_birth_country[0]['value'] = "".(trim($rowmd['birth_country']))."";
$node->field_birth_city[0]['value'] = "".(trim($rowmd['birth_city']))."";
$node->field_birth_state[0]['value'] = "".(trim($rowmd['birth_state']))."";
$node->field_display_nickname_or_name[0]['value'] = "".(trim($rowmd['display_nickname_or_name']))."";
$node->field_birth_region[0]['value'] = "".(trim($rowmd['birth_region']))."";
$node->field_birth_place[0]['value'] = "".(trim($rowmd['birth_place']))."";
$node->field_death_city[0]['value'] = "".(trim($rowmd['death_city']))."";
$node->field_death_date[0]['value'] = "".(trim($rowmd['death_date']))."";
$node->field_death_state[0]['value'] = "".(trim($rowmd['death_state']))."";
$node->field_death_country[0]['value'] = "".(trim($rowmd['death_country']))."";
$node->field_death_place[0]['value'] = "".(trim($rowmd['death_place']))."";
$node->field_current_city[0]['value'] = "".(trim($rowmd['current_city']))."";
$node->field_current_state[0]['value'] = "".(trim($rowmd['current_state']))."";
$node->field_zipcode[0]['value'] = "".(trim($rowmd['zipcode']))."";
$node->field_occupation[0]['value'] = "".(trim($rowmd['occupation']))."";
$node->field_organization[0]['value'] = "".(trim($rowmd['organization']))."";
$node->field_biography[0]['value'] = "".(trim($rowmd['biography']))."";
$node->field_created_at[0]['value'] = "".(trim($rowmd['created_at']))."";
$node->field_updated_at[0]['value'] = "".(trim($rowmd['updated_at']))."";
$node->field_template_id[0]['value'] = "".(trim($rowmd['template_id']))."";
$node->field_link[0]['value'] = "".(trim($rowmd['link']))."";
$node->field_services_at[0]['value'] = "".(trim($rowmd['services_at']))."";
$node->field_hobbies[0]['value'] = "".(trim($rowmd['hobbies']))."";
$node->field_obit_template_id[0]['value'] = "".(trim($rowmd['obit_template_id']))."";
$node->field_death_month[0]['value'] = "".(trim($rowmd['death_month']))."";
$node->field_death_day[0]['value'] = "".(trim($rowmd['death_day']))."";
$node->field_death_year[0]['value'] = "".(trim($rowmd['death_year']))."";
$node->field_birth_day[0]['value'] = "".(trim($rowmd['birth_day']))."";
$node->field_birth_month[0]['value'] = "".(trim($rowmd['birth_month']))."";
$node->field_birth_year[0]['value'] = "".(trim($rowmd['birth_year']))."";
$node->field_current_address[0]['value'] = "".(trim($rowmd['current_address']))."";
$node->field_maiden[0]['value'] = "".(trim($rowmd['maiden']))."";
$node->field_user_id[0]['value'] = "".(trim($rowmd['user_id']))."";
$node->field_location_id[0]['value'] = "".(trim($rowmd['location_id']))."";
$node->field_test_id[0]['value'] = "".(trim($rowmd['test_id']))."";
$node->field_display[0]['value'] = "".(trim($rowmd['display']))."";
$node->field_obit_member_id[0]['value'] = "".trim($rowmd['obit_member_id'])."";
// If known, the taxonomy TID values can be added as an array.
$node->taxonomy = array(2,3,1,);
node_save($node);
}
print_r("obituaries migrated".strftime('%c')."");
$con1 = mysql_connect("localhost","root","kunalmysql");
if (!$con1)
{
	die('Could not connect: ' . mysql_error());
}
mysql_select_db('site2',$con1);
$sqlmt2 = "SELECT nid,field_obit_member_id_value from content_type_obit_user_links";
$rsmd2 = mysql_query($sqlmt2) or die($sqlmt2. mysql_error());
$r = 0;
$oldCode = "";
//echo "<pre>";
//$rowmd2 = mysql_fetch_array($rsmd2);
//print_r($rowmd2['id']);
$r=100;
print_r("url aliases initiated ".strftime('%c')."");
while($rowmd2 = mysql_fetch_array($rsmd2))
{
//print_r($rowmd2);
//print_r("\n".$rowmd2['nid']);

$r=$r+1;
$sqlnp = "INSERT INTO url_alias (pid,src,dst)VALUES ( $r,'node/".trim($rowmd2['nid'])."','obituary/user/show/template?id=".trim($rowmd2['field_obit_member_id_value'])."')";
$ins = mysql_query($sqlnp) or die($sqlnp." :: ".mysql_error());


//$sqlnp2 = "INSERT INTO node (nid,vid,type,title,uid,status)VALUES ( $r,$r,'obit_user_links','".mysql_real_escape_string(trim($rowmd['fname']))."','1','1')";
//$ins2 = mysql_query($sqlnp2) or die($sqlnp." :: ".mysql_error());

}
print_r("urls done".strftime('%c')."");


//drush en pathauto;

$str= 's:36:"obituary/user/show/template?id=[nid]";';
$sqlvt = "UPDATE variable SET value = '".mysql_real_escape_string($str)."' WHERE name = 'pathauto_node_obit_user_links_pattern'";
$ins = mysql_query($sqlvt) or die($sqlvt." :: ".mysql_error());
print_r("url rewrite rule also added: ".strftime('%c')."");

?>

