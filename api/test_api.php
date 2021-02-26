<?php

/*test_api.php
Author:Nalaka Thushan
Copyright 2021
*/

include('Api.php');
// this is api for data pass throuh the server to the web page
$api_object = new API();

if ($_GET["action"] == 'fetch_all') {
	$data = $api_object->fetch_all();
}

if ($_GET["action"] == 'insert') {
	$data = $api_object->insert();
}

if ($_GET["action"] == 'fetch_single') {
	$data = $api_object->fetch_single($_GET["id"]);
}

if ($_GET["action"] == 'update') {
	$data = $api_object->update();
}

if ($_GET["action"] == 'delete') {
	$data = $api_object->delete($_GET["id"]);
}

echo json_encode($data);