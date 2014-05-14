<?php
	print('SESSION->');
	define('DRUPAL_ROOT', '../../../../../');
	require_once DRUPAL_ROOT . '/includes/bootstrap.inc';
	drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);    
	
	
	print_r($_SESSION['user']);
	
	$request_string = $_POST['request_string'];
	$return_string = "success";
	
	//parse string
	$request_array = explode("<->", $request_string);
	$requests = array();
	foreach($request_array as $key=>$row) {
		$rows = explode("->", $row);
		if(count($rows) > 1) {
			$requests[$key]["type"] = $rows[0];
			$requests[$key]["nid"] = $rows[1];
		}
	}	
	
	//make request to database
	foreach($requests as $request) {
		if($request["type"] == "add") {
			//get current order count
			print('kind');
			$max_count = 0;
			//$classes_result = db_query("SELECT n.delta FROM {field_data_field_classes} n WHERE n.entity_id = :uid", array(':uid' => '2'));
			print("works");
			/*foreach($classes_result as $row) {
				if($row->delta > $max_count) {
					$max_count = $row->delta;
				}
			}
			$curr_count = $max_count+1;
			$return_string = "curr_count = " . $curr_count;
			
			//add item to db
			/*$nid = db_insert('field_data_field_classes')
				->fields(array(
				'entity_type' => 'user',
				'bundle' => 'user',
				'deleted' => '0',
				'entity_id' => $user->uid,
				'revision_id' => $user->uid,
				'language' => 'und',
				'delta' => $curr_count,
				'field_classes_nid' => $request["nid"];
				))
			->execute();*/
			
		}else if($request["type"] == "delete") {
			//remove item from db
			
			
		}else {
			$return_string = "error->" . $request["type"];
		}
	}
	
	print ($return_string);
	
?>