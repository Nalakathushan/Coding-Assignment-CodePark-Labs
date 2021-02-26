<?php

/*Api.php
Author:Nalaka Thushan
Copyright 2021
*/

class API
{
	private $connect;

	function __construct()
	{
		$this->database_connection();
	}

	function database_connection()
	{
		$this->connect = new PDO("mysql:host=localhost;dbname=testing", "root", ""); //database connection
	}

	function fetch_all() //data fetching function
	{
		$query = "SELECT * FROM tbl_sample ORDER BY id";
		//$result =
		$statement = $this->connect->prepare($query);
		if ($statement->execute()) {
			while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
				$data[] = $row;
			}
			return $data;
		}
	}

	function insert()   //data insert function
	{
		if (isset($_POST["title"])) {
			$form_data = array(
				':title'		=>	$_POST["title"],
				':note'		=>	$_POST["note"]
			);
			$query = "
			INSERT INTO tbl_sample 
			(title, note) VALUES 
			(:title, :note)
			";
			$statement = $this->connect->prepare($query);
			if ($statement->execute($form_data)) {
				$data[] = array(
					'success'	=>	'1'
				);
			} else {
				$data[] = array(
					'success'	=>	'0'
				);
			}
		} else {
			$data[] = array(
				'success'	=>	'0'
			);
		}
		return $data;
	}

	function fetch_single($id)   //single data fetching function
	{
		$query = "SELECT * FROM tbl_sample WHERE id='" . $id . "'";
		$statement = $this->connect->prepare($query);
		if ($statement->execute()) {
			foreach ($statement->fetchAll() as $row) {
				$data['title'] = $row['title'];
				$data['note'] = $row['note'];
			}
			return $data;
		}
	}

	function update()   //data update function
	{
		if (isset($_POST["title"])) {
			$form_data = array(
				':title'	=>	$_POST['title'],
				':note'	=>	$_POST['note'],
				':id'			=>	$_POST['id']
			);
			$query = "
			UPDATE tbl_sample 
			SET title = :title, note = :note 
			WHERE id = :id
			";
			$statement = $this->connect->prepare($query);
			if ($statement->execute($form_data)) {
				$data[] = array(
					'success'	=>	'1'
				);
			} else {
				$data[] = array(
					'success'	=>	'0'
				);
			}
		} else {
			$data[] = array(
				'success'	=>	'0'
			);
		}
		return $data;
	}
	function delete($id)   //data delete function
	{
		$query = "DELETE FROM tbl_sample WHERE id = '" . $id . "'";
		$statement = $this->connect->prepare($query);
		if ($statement->execute()) {
			$data[] = array(
				'success'	=>	'1'
			);
		} else {
			$data[] = array(
				'success'	=>	'0'
			);
		}
		return $data;
	}
}