<div id="student_dashboard_custom_block" class="block block-block">
	<h2 id='testing'>What's Due</h2>
	<?php
		//get shift param in url
		$shift = 0;
		$shift_left = -1;
		$shift_right = 1;
		if(isset($_GET['shift'])) {
			$shift = $_GET['shift'];
		}
		
		$days = array();
		$day_trans = array();
		$day_trans[0] = "Sunday";$day_trans[1] = "Monday";$day_trans[2] = "Tuesday";$day_trans[3] = "Wednesday";$day_trans[4] = "Thursday";$day_trans[5] = "Friday";$day_trans[6] = "Saturday";
		//$day_trans = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
		$days_drupal = array();
		$days_show = array();
		
		//mod the shift if lands on a weekend day
		$shift_left_useable = $shift + $shift_left;
		$shift_right_useable = $shift + $shift_right;
		//*****SHIFT LEFT*****
		if($shift_left_useable >= 0) {
			//get day num
			$day_num = date('w', strtotime("+" . $shift_left_useable . " day"));
			//check if sunday or saturday and decrement
			if($day_num == 0) {
				$shift_left = -3;
			}else if($day_num == 6) {
				$shift_left = -2;
			}
		}else {
			//get day num
			$day_num = date('w', strtotime($shift_left_useable . " day"));
			//check if sunday or saturday and decrement
			if($day_num == 0) {
				$shift_left = -3;
			}else if($day_num == 6) {
				$shift_left = -2;
			}
		}
		
		//*****SHIFT RIGHT*****
		if($shift_right_useable >= 0) {
			//get day num
			$day_num = date('w', strtotime("+" . $shift_right_useable . " day"));
			//check if sunday or saturday and decrement
			if($day_num == 0) {
				$shift_right = 2;
			}else if($day_num == 6) {
				$shift_right = 3;
			}
		}else {
			//get day num
			$day_num = date('w', strtotime($shift_right_useable . " day"));
			//check if sunday or saturday and decrement
			if($day_num == 0) {
				$shift_right = 2;
			}else if($day_num == 6) {
				$shift_right = 3;
			}
		}
		
	?>
	<a href='<?php echo "dashboard?shift=" . ($shift + $shift_left) . ""; ?>' id='dash_ajax'>
	<h5 class='load_day' id='load_left'>
	Previous
	</h5>
	</a>
	
	<a href='<?php echo "dashboard?shift=" . ($shift + $shift_right) . ""; ?>' id='dash_ajax'>
	<h5 class='load_day' id='load_right'>
	Next
	</h5>
	</a>
	
	<div class='clear'></div>
		
	<div class="content">
		
		<?php
			//get day of week for next four business days
			for($i=1;$i<20;$i++) {
				$useable_i = $i + $shift;
				if($useable_i >= 0) {
					$day = date('w', strtotime("+" . $useable_i . " day"));
					$day_drupal = date('Y-m-d 00:00:00', strtotime("+" . $useable_i . " day"));
					$day_show = date('n/j', strtotime("+" . $useable_i . " day"));
					if($day_trans[$day] == "Sunday") {
						$i += 1;
						$day = date('w', strtotime("+" . ($i + $shift) . " day"));
						$day_drupal = date('Y-m-d 00:00:00', strtotime("+" . ($i + $shift) . " day"));
						$day_show = date('n/j', strtotime("+" . ($i + $shift) . " day"));
					}else if($day_trans[$day] == "Saturday") {
						$i += 2;
						$day = date('w', strtotime("+" . ($i + $shift) . " day"));
						$day_drupal = date('Y-m-d 00:00:00', strtotime("+" . ($i + $shift) . " day"));
						$day_show = date('n/j', strtotime("+" . ($i + $shift) . " day"));
					}
				}else {
					$day = date('w', strtotime($useable_i . " day"));
					$day_drupal = date('Y-m-d 00:00:00', strtotime($useable_i . " day"));
					$day_show = date('n/j', strtotime($useable_i . " day"));
					
				}
				if($day != 0 && $day != 6) {
					array_push($days, $day);
					array_push($days_drupal, $day_drupal);
					array_push($days_show, $day_show);
				}
				//exit loop if 4 days reached
				if(count($days) > 4) {
					$i = 20;
				}
			}
			
			$classes = array();
			//Get student classes (array)
			$classes_result = db_query("SELECT n.field_classes_nid FROM {field_data_field_classes} n WHERE n.entity_id = :uid", array(':uid' => $user->uid));
			foreach($classes_result as $row) {
				array_push($classes,$row->field_classes_nid);
			}
			
			//Sql compatible array
			$days_string = join('\',\'', $days_drupal);
			$days_string = "'" . $days_string . "'";
			
			//Items array for all schedule items and assignments (day->item_type->nid)
			$items = array();
			//Below handles undefined offset for checking count of array
			for($i=0;$i<7;$i++) {
				$items[$i]["assignments"] = array();
				$items[$i]["schedule_items"] = array();
			}
			
			
			/*********************
			ONLY FOR ASSIGNMENTS
			*********************/
			
			//Get all homework in classes
			//joined the students classes to pass array into sql query
			$student_classes_sql = join(',',$classes);
			$student_hw = array();
			$hw_result = db_query("SELECT n.entity_id FROM {field_data_field_class} n WHERE n.bundle = :type AND n.field_class_nid IN ($student_classes_sql)", array(':type' => 'otw_assignment'));
			foreach($hw_result as $row) {
				//get assignment class
				array_push($student_hw,$row->entity_id);
			}
			
			//now find all assignments
			$student_hw_sql = join(',',$student_hw);
			$student_hw_due_result = db_query("SELECT n.entity_id, n.field_due_date_value FROM drupal_field_data_field_due_date n WHERE n.entity_id IN ($student_hw_sql) AND n.field_due_date_value IN ($days_string)");
			foreach($student_hw_due_result as $row) {
				for($i=0;$i<5;$i++) {
					if($row->field_due_date_value == $days_drupal[$i]) {
						$day_key = $days[$i];
						$arr_count = count($items[$day_key]["assignments"]);
						$items[$day_key]["assignments"][$arr_count]["nid"] = $row->entity_id;
					}
				}
			}
			
			/*********************
			ONLY FOR SCHEDULE ITEMS
			*********************/
			
			//Get all schedule items in classes
			//$student_classes_sql = join classes array
			$student_schedule_items = array();
			$schedule_items_result = db_query("SELECT n.entity_id FROM {field_data_field_class} n WHERE n.bundle = :type AND n.field_class_nid IN ($student_classes_sql)", array(':type' => 'otw_schedule_item'));
			foreach($schedule_items_result as $row) {
				//get assignment class
				array_push($student_schedule_items,$row->entity_id);
			}
			
			//now find all schedule items
			$student_schedule_items_sql = join(',',$student_schedule_items);
			if($student_schedule_items_sql != "") {
				$student_schedule_items_due_result = db_query("SELECT n.entity_id, n.field_assigned_date_value FROM drupal_field_data_field_assigned_date n WHERE n.entity_id IN ($student_schedule_items_sql) AND n.field_assigned_date_value IN ($days_string)");
				//echo "SELECT n.entity_id FROM drupal_field_data_field_due_date n WHERE n.entity_id IN ($student_hw_sql) AND n.field_due_date_value IN ($days_string)";
				foreach($student_schedule_items_due_result as $row) {
					for($i=0;$i<5;$i++) {
						if($row->field_assigned_date_value == $days_drupal[$i]) {
							$arr_count = count($items[$i]["schedule_items"]);
							$day_key = $days[$i];
							$items[$day_key]["schedule_items"][$arr_count]["nid"] = $row->entity_id;
						}
					}
				}
			}
			
			
			
			/*********************
			GET INFO FOR ITEMS
			*********************/
			for($i=1;$i<7;$i++) {
				//loop through assignments
				for($e=0;$e<count($items[$i]["assignments"]);$e++) {
					
					$nid = $items[$i]["assignments"][$e]["nid"];
					
					$name_sql = db_query("SELECT n.title FROM drupal_node n WHERE n.nid = ($nid)");
					//add title
					foreach($name_sql as $row) {
						$items[$i]["assignments"][$e]["name"] = $row->title;
					}
					//add class
					$class_sql = db_query("SELECT n.field_class_nid FROM drupal_field_data_field_class n WHERE n.entity_id = ($nid)");
					foreach($class_sql as $row) {
						$class2_sql = db_query("SELECT n.title FROM drupal_node n WHERE n.nid = ($row->field_class_nid)");
						foreach($class2_sql as $row2) {
							$items[$i]["assignments"][$e]["class"] = $row2->title;
						}
					}
					//add description
					$description_sql = db_query("SELECT n.field_description_value FROM drupal_field_data_field_description n WHERE n.entity_id = ($nid)");
					foreach($description_sql as $row) {
						$items[$i]["assignments"][$e]["description"] = $row->field_description_value;
					}
				}
				//loop through schedule items
				/*for($e=0;$e<count($items[$i]["schedule_items"]);$e++) {
					$nid = $items[$i]["schedule_items"][$e]["nid"];
					$name_sql = db_query("SELECT n.title FROM drupal_node n WHERE n.nid = ($nid)");
					//add title
					foreach($name_sql as $row) {
						$items[$i]["schedule_items"][$e]["name"] = $row->title;
					}
					
				}*/
			}
			
		?>
		<?php
			foreach($days as $day_key=>$day_val) {
				if($day_key<4) {
					//add tomorrow class for highlighting day
					$tomorrow_nj;
					if(date('w',strtotime("+1 day")) == 0) {
						$tomorrow_nj = date('n/j',strtotime("+2 day"));
					}else if(date('w',strtotime("+1 day")) == 6) {
						$tomorrow_nj = date('n/j',strtotime("+3 day"));
					}else {
						$tomorrow_nj = date('n/j',strtotime("+1 day"));
					}
					
					$tomorrow_box;
					$tomorrow_header;
					if($days_show[$day_key] == $tomorrow_nj) {
						$tomorrow_box = "tomorrow_box";
						$tomorrow_header = "tomorrow_header";
					}else {
						$tomorrow_box = "";
						$tomorrow_header = "";
					}
					echo "<div id='day" . ($day_key+1) . "' class='dashboard_day " . $tomorrow_box . "'>";
				
					//print assignments
					
					echo "<h3 class='" . $tomorrow_header . "'>" . $day_trans[$day_val] . " - " . $days_show[$day_key] . "</h3>";
					echo "<div class='dash_container'>";
					foreach ($items[$day_val]["assignments"] as $key=>$item) {
						if(($key+1) == count($items[$day_val]["assignments"])) {
							echo "<a href='../node/" . $item["nid"] . "'><ul class='ul_last'>";
						}else {
							echo "<a href='../node/" . $item["nid"] . "'><ul>";
						}
						echo "<li class='item_title'>" . $item["name"] . "</li>";
						echo "<li class='item_class'> >" . $item["class"] . "</li>";
						echo "</ul></a>";
					}
					echo "</div><!--end dash_container-->";
					
					echo "</div><!--end dashboard_day-->";
				}
			}
			echo "<div class='clear'></div>";
		?>
		
		<script type='text/javascript' src='../sites/all/themes/otw/assets/js/student_dashboard.js'></script>
		
	</div>
</div>
