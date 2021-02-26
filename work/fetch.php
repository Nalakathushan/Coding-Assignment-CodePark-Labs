<?php

//fetch.php
/*Inserted data fetching and display control from this api */

$api_url = "http://localhost/phpCrud/api/test_api.php?action=fetch_all"; //folder url

$client = curl_init($api_url);

curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($client);

$result = json_decode($response);

$output = '';

if ($result > 0) {
	foreach ($result as $row) {
		$output .= '
		<tr>
			<td>' . $row->title . '</td>
			<td>' . $row->note . '</td>
			<td><button type="button" name="edit" class="btn btn-warning btn-xs edit" id="' . $row->id . '">Edit</button></td>
			<td><button type="button" name="delete" class="btn btn-danger btn-xs delete" id="' . $row->id . '">Delete</button></td>
		  <td><form action="#" method="POST"><input type="text" value="' . $row->id . '" name="ids" hidden><button type="submit" name="archive" class="btn btn-primary btn-xs archive" id="' . $row->id . '">Archive</button></form></td>
		</tr>
		';
	}
} else {
	$output .= '
	<tr>
		<td colspan="4" align="center">No Data Found</td>
	</tr>
	';
}

echo $output;