<?php

function getWpLoadPath() {
	$path=$_SERVER['SCRIPT_FILENAME'];

	for ($i=0; $i<4; $i++)
		$path=dirname($path);

	return $path."/wp-load.php";
}

function esc_vals($array) {
	$escArray=array();

	foreach ($array as $arrayElement)
		$escArray[]="'".esc_sql($arrayElement)."'";

	return "(".join(",",$escArray).")";
}

function fail($message) {
	http_response_code(500);
	echo json_encode(array(
		"error"=>TRUE,
		"message"=>$message
	));
}

require_once getWpLoadPath();
global $wpdb;

switch ($_REQUEST["state"]) {
	case "publish":
		$statusArray=array("publish");
		break;

	case "draft":
		$statusArray=array("draft");
		break;

	case "any":
		$statusArray=array("publish","draft");
		break;

	default:
		fail("Bad value for state: ".$_REQUEST["state"]);
		break;
}

switch ($_REQUEST["type"]) {
	case "post":
		$typeArray=array("post");
		break;

	case "page":
		$typeArray=array("page");
		break;

	case "attachment":
		$typeArray=array("attachment");
		break;

	case "any":
		$typeArray=array("post","page","attachment");
		break;

	default:
		fail("Bad value for type: ".$_REQUEST["type"]);
		break;
}

$q="SELECT COUNT(*) FROM {$wpdb->prefix}posts ";
$q.="WHERE post_status IN ".esc_vals($statusArray)." ";
$q.="AND post_type IN ".esc_vals($typeArray)." ";

$value=$wpdb->get_var($q);

header('Content-Type: application/json');

if ($wpdb->last_error)
	fail($wpdb->last_error);

echo json_encode(array(
	"posts"=>array(
		"label"=>$_REQUEST["label"],
		"type"=>"integer",
		"value"=>$value,
		"strategy"=>"continuous",
	)
));