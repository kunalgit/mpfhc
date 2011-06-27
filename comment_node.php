<?php
require './includes/bootstrap.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);
//$_SERVER['REQUEST_METHOD'] = 'wget';
//$_SERVER['REMOTE_ADDR'] = '10.0.1.4';  // to prvent the warning Undefined index: REMOTE_ADDR in /home/kunal/drupal/includes/bootstrap.inc on line 1317
?>
<?php
$con = mysql_connect("localhost","root","kunalmysql");
if (!$con)
{
        die('Could not connect: ' . mysql_error());
}
mysql_select_db('site2',$con);
$sqlmt = "SELECT * from messages";
$rsmd = mysql_query($sqlmt) or die($sqlmt. mysql_error());
print_r("start: ".strftime('%c')."");
while($rowmd = mysql_fetch_array($rsmd))
{
//print_r($rowmd);
print_r("\n".$rowmd['id']);

// Construct the new node object.

$node = new stdClass();
//print_r("k ".$node->nid);
// Your script will probably pull this information from a database.
//$node->nid=10000000;
$node->title = "";
$node->body = "".(trim($rowmd['message']))."";
$node->type = 'comment';   // Your specified content type
$node->created = "".(trim($rowmd['created_at']))."";
$node->changed = $node->created;
$node->status = 1;
$node->promote = 1;
$node->sticky = 0;
$node->format = 1;       // Filtered HTML
$node->uid = 1;          // UID of content owner
$node->language = 'en';
//$node->field_obit_user_url[0]['url'] = "obituary/user/show/template?id=".trim($rowmd['obit_member_id'])."";
//$node->field_obit_user_url[0]['title'] = "".(trim($rowmd['fname']))." ".(trim($rowmd['mname']))." ".(trim($rowmd['lname']))."";
//$node->field_obit_user_url[0]['attributes'] =""; 
$node->field_name[0]['value'] = "".(trim($rowmd['name'])).""; 
$node->field_email[0]['value'] = "".(trim($rowmd['email']))."";
$node->field_light_candle[0]['value'] = "".(trim($rowmd['light_candle']))."";
//$node->field_user_id[0]['value'] = "".(trim($rowmd['user_id']))."";
//$node->field_location_id[0]['value'] = "".(trim($rowmd['location_id']))."";
//$node->field_test_id[0]['value'] = "".(trim($rowmd['test_id']))."";
//$node->field_display[0]['value'] = "".(trim($rowmd['display']))."";
//$node->field_obit_member_id[0]['value'] = "".trim($rowmd['obit_member_id'])."";

// If known, the taxonomy TID values can be added as an array.
//$node->taxonomy = array(2,3,1,);
node_save($node);
$sqlmt2 = "SELECT nid from content_type_obit_user_links where field_obit_member_id_value='".trim($rowmd['obit_member_id'])."'";
$rsmd2 = mysql_query($sqlmt2) or die($sqlmt2. mysql_error());
$rowmd2 = mysql_fetch_array($rsmd2);
//print_r(trim($rowmd['obit_member_id']));
//print_r("kunal".trim($rowmd2['nid']));
$sqlmt1 = "insert into node_comments (cid,nid)values('".$node->nid."','".trim($rowmd2['nid'])."')";
//'node/".trim($rowmd['nid'])."'


$rsmd1 = mysql_query($sqlmt1) or die($sqlmt1. mysql_error());

#$sqlmt4 = "insert into node_comments (cid,nid)values('".$node->nid."','".trim($rowmd2['nid'])."')";
#$rsmd1 = mysql_query($sqlmt4) or die($sqlmt4. mysql_error());
//$node->cid= $node->nid;
//$node->nid= "".(trim($rowmd2['nid']))."";
//$sqlmt3 = "UPDATE {node_comment_statistics} SET comment_count = comment_count + 1 WHERE nid ='".trim($rowmd['nid'])."'";
//nodecomment_save($node);
//print_r("kunal ".(trim($rowmd2['nid'])));
$sqlmt3 = "UPDATE node_comment_statistics SET comment_count = comment_count + 1 WHERE nid ='".trim($rowmd2['nid'])."'";
mysql_query($sqlmt3);
}
print_r("end: ".strftime('%c')."");
?>
DONE
