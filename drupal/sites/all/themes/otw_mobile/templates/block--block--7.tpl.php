<div id='workload_block''>
	<h2><?php print $block->subject; ?></h2>
	<div class='content'>
		<?php
		/***
		NEXT -> look at query below and columns in db to figure out how to calculate the total mins of work for a student on a given night.
		****/
		global $user;
		$total_mins = 0;
		
		//Get student classes (array)
		$student_classes = array();
		$classes_result = db_query("SELECT n.field_classes_nid FROM {field_data_field_classes} n WHERE n.entity_id = :uid", array(':uid' => $user->uid));
		foreach($classes_result as $row) {
			array_push($student_classes,$row->field_classes_nid);
		}
		
		
		
		//Get homework in classes for tomorrow(array)
		//joined the students classes to pass array into sql query
		$student_classes_sql = join(',',$student_classes);
		$student_hw = array();
		$hw_result = db_query("SELECT n.entity_id FROM {field_data_field_class} n WHERE n.bundle = :type AND n.field_class_nid IN ($student_classes_sql)", array(':type' => 'otw_assignment'));
		foreach($hw_result as $row) {
			//get assignment class
			array_push($student_hw,$row->entity_id);
		}
		
		$homework = true;
		
		//proceed if homework exists
		if(count($student_hw) > 0) {
			//Now filter results to only those assignments due tomorrow
			//get tomorrow
			//NOTE -> below does not account for TRUE next school day; rather just next business day
			$tom_test = date('w', strtotime('tomorrow'));
			$tomorrow;
			if($tom_test != 0 && $tom_test != 6) {
				$tomorrow = date('Y-m-d 00:00:00', strtotime('tomorrow'));
			}else {
				$tomorrow = date('Y-m-d 00:00:00', strtotime('next monday'));
			}
			//now filter
			$student_hw_sql = join(',',$student_hw);
			$student_hw_due = array();
			$student_hw_due_result = db_query("SELECT n.entity_id FROM {field_data_field_due_date} n WHERE n.entity_id IN ($student_hw_sql) AND n.field_due_date_value = '$tomorrow'");
			foreach($student_hw_due_result as $row) {
				array_push($student_hw_due,$row->entity_id);
			}
			
			
			//NOTE -> $student_hw_due contains all assignment due tomorrow!
			
			//Now get the total time (in mins) of these assignments
			$student_hw_length = array();
			$student_hw_length_sql = join(',',$student_hw_due);
			if($student_hw_length_sql != "") {
				$student_hw_length_result = db_query("SELECT n.field_length_value FROM {field_revision_field_length} n WHERE n.entity_id IN ($student_hw_length_sql)");
			
				foreach($student_hw_length_result as $row) {
					array_push($student_hw_length,$row->field_length_value);
				}
			}
			
			$length_time_total = 0;
			foreach($student_hw_length as $num) {
				$length_time_total += $num;
			}
			$length_num = count($student_hw_due);
		}else {
			$homework = false;
		}
		
		
		
		?>
		<p><?php 
		
		if($homework) {
			//Get WORLOAD VARIANCE
			$variance_index;
			$student_workload_variance = db_query("SELECT n.field_workload_estimate_variance_value FROM {field_data_field_workload_estimate_variance} n WHERE n.entity_id = :uid", array(':uid' => $user->uid));
			
			foreach($student_workload_variance as $row) {
				$variance_index = $row->field_workload_estimate_variance_value;
			}
			
			//Use variance index in array of vals
			$variance_vals = [10,25,50,75,100,110,125,150,175,200,250,300,400,500,750,1000];
			$variance = $variance_vals[$variance_index];
			
			//ALTER homework_length_total (after turning variance to decimal from percentage)
			$length_time_total = $length_time_total * ($variance / 100);
			
			$hrs = floor($length_time_total/60);
			$mins = floor($length_time_total-($hrs*60));
			
			if($hrs >= 1) {
				if($hrs == 0 || $hrs >= 2) {
					echo "<span class='bold'>" . $hrs ."hrs and ";	
				}else {
					echo "<span class='bold'>" . $hrs ."hr and ";
				}
			}else {
				echo "<span class='bold'>";
			}
			
			if($mins == 0 || $mins >= 2) {
				echo $mins . "mins</span> for "; 
			}else {
				echo $mins . "min</span> for "; 
			}
			
			
			//print num of assignments
			echo "<span class='bold'>" . $length_num . " assignments</span> ";
			//COMMENT -> code somehow broken
			/*
			if($length_num == 0 || $length_num >= 2) {
				echo "<span class='bold'>" . $length_num . " assignments</span> ";	
			}else 
				echo "<span class='bold'>" . $length_num . " assignment</span> ";
			}
			*/
			
			
			echo "due tomorrow.";
		}else {
			echo "No homework due tomorrow!";
		}
		
		
		
		?></p>
	</div>
</div>