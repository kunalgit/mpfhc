<?php
require './includes/bootstrap.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);
//$_SERVER['REQUEST_METHOD'] = 'wget';
$_SERVER['REMOTE_ADDR'] = '10.0.1.4';  // to prvent the warning Undefined index: REMOTE_ADDR in /home/kunal/drupal/includes/bootstrap.inc on line 1317
?>
<?php
$con = mysql_connect("localhost","root","kunalmysql");
if (!$con)
{
        die('Could not connect: ' . mysql_error());
}
mysql_select_db('site1',$con);
$sqlmt = "SELECT * from ddetails limit 0,20";
$rsmd = mysql_query($sqlmt) or die($sqlmt. mysql_error());
while($rowmd = mysql_fetch_array($rsmd))
{
//print_r($rowmd);
print_r("\n".$rowmd['id']);

// Construct the new node object.

$node = new stdClass();
// Your script will probably pull this information from a database.
$node->title = "".(trim($rowmd['fname']))."";
$node->body = "";
$node->type = 'obit_user_links';   // Your specified content type
$node->created = time();
$node->changed = $node->created;
$node->status = 1;
$node->promote = 0;
$node->sticky = 0;
$node->format = 1;       // Filtered HTML
$node->uid = 1;          // UID of content owner
$node->language = 'en';
$node->field_obit_user_url[0]['url'] = "obituary/user/show/template?id=".trim($rowmd['obit_member_id'])."";
$node->field_obit_user_url[0]['title'] = "".(trim($rowmd['fname']))." ".(trim($rowmd['mname']))." ".(trim($rowmd['lname']))."";
$node->field_obit_user_url[0]['attributes'] =""; 
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
?>
DONE
