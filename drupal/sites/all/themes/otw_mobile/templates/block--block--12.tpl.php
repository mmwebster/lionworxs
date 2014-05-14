<?php
	//facilitate ajax uid request
	//$_SESSION['user'] = $user;
	//print_r($_SESSION['user']);
?>

<div id="student_classes_custom_block" class="block block-block">
	<h2 id='testing'>Classes</h2>
		<style>
		
			/*BOTH LEFT AND RIGHT*/
			#student_classes_custom_block h4 {
				font-family: 'Open Sans';
				font-weight: 100;
				text-align: center;
				padding: 10px;
				border-bottom: 1px solid #aaa;
				margin-bottom:10px;
			}
			#student_classes_custom_block input[type="text"] {
				width: 328px;
				padding: 10px;
				border: 1px solid #aaa;
				border-radius: 3px;
				margin-bottom: 10px;
			}
			
			
			
			
			/*LEFT STYLES*/
			
			#classes_left {
				width: 350px;
				float: left;
			}
			#classes_list {
				width:350px;
			}
			#classes_list li {
				list-style: none;
				padding: 10px;
				
				-webkit-box-shadow:inset 0 0 80px 2px #00aaee;
				-moz-box-shadow:inset 0 0 80px 2px #00aaee;
				-o-box-shadow:inset 0 0 80px 2px #00aaee;
				-ms-box-shadow:inset 0 0 80px 2px #00aaee;
				box-shadow:inset 0 0 80px 2px #00aaee;
				
				border-radius: 5px;
				margin-bottom: 5px;
			}
			#classes_list li a {
				font-family: 'Open Sans';
				font-size: 14px;
				color: #666;
			}
			#classes_list li a:hover {
				text-decoration: underline;
			}
			
			.class_info {
				width: 250px;
				float:left;
				padding: 5px;
			}
			.class_edit {
				width: 45px;
				padding: 5px;
				border-radius:3px;
				float:right;
				background-color: #b00;
				color: #fff;
				font-size: 14px;
				font-family: 'Lato';
				-webkit-box-shadow:inset 0 0 10px .1px #000000;
				-moz-box-shadow:inset 0 0 10px .1px #000000;
				-o-box-shadow:inset 0 0 10px .1px #000000;
				-ms-box-shadow:inset 0 0 10px .1px #000000;
				box-shadow:inset 0 0 10px .1px #000000;
				opacity: .5;
			}
			.class_edit:hover {
				opacity: 1;
				cursor:pointer;
			}
			
			
			
			/*RIGHT section classes*/
			#classes_right {
				width: 350px;
				float: right;
			}
			#browser_list {
				width: 350px;
				max-height: 400px;
				overflow: scroll;
				border-bottom: 2px solid #aaa;
			}
			#browser_list li {
				list-style: none;
				padding: 10px;
				
				-webkit-box-shadow:inset 0 0 80px 2px #00aaee;
				-moz-box-shadow:inset 0 0 80px 2px #00aaee;
				-o-box-shadow:inset 0 0 80px 2px #00aaee;
				-ms-box-shadow:inset 0 0 80px 2px #00aaee;
				box-shadow:inset 0 0 80px 2px #00aaee;
				
				border-radius: 5px;
				margin-bottom: 5px;
			}
			#browser_list li a {
				font-family: 'Open Sans';
				font-size: 14px;
				color: #666;
			}
			#browser_list li a:hover {
				text-decoration: underline;
			}
			
			.browser_class_info {
				width: 250px;
				float:left;
				padding: 5px;
			}
			.browser_class_edit {
				width: 30px;
				padding: 5px;
				border-radius:3px;
				float:right;
				background-color: #0e7;
				color: #fff;
				font-size: 14px;
				font-family: 'Lato';
				-webkit-box-shadow:inset 0 0 10px .1px #000000;
				-moz-box-shadow:inset 0 0 10px .1px #000000;
				-o-box-shadow:inset 0 0 10px .1px #000000;
				-ms-box-shadow:inset 0 0 10px .1px #000000;
				box-shadow:inset 0 0 10px .1px #000000;
				opacity: .5;
			}
			.browser_class_edit:hover {
				opacity: 1;
				cursor:pointer;
			}
			/*bottom gradient*/
			#browser_bottom {
				height:1px;
				width:350px;
				border-bottom: 2px solid #bbb;
			}
			#browser_bottom2 {
				height:1px;
				width:350px;
				border-bottom: 2px solid #ccc;
			}
			#browser_bottom3 {
				height:1px;
				width:350px;
				border-bottom: 2px solid #ddd;
			}
			#browser_bottom4 {
				height:1px;
				width:350px;
				border-bottom: 2px solid #eee;
			}
			
			
			/*REQUEST FORM*/
			#request_form {
				background-color:#ddd;
				-webkit-box-shadow:inset 0 0 1px .1px #000000;
				-moz-box-shadow:inset 0 0 1px .1px #000000;
				-o-box-shadow:inset 0 0 1px .1px #000000;
				-ms-box-shadow:inset 0 0 1px .1px #000000;
				box-shadow:inset 0 0 1px .1px #000000;
				display: none;
				height: 0px;
				opacity: 0;
				border-radius: 4px;
				-webkit-border-radius: 4px;
				-moz-border-radius: 4px;
				-o-border-radius: 4px;
				-ms-border-radius: 4px;
				
				padding: 15px;
			}
			#request_form input[type='button'] {
				width: 200px;
			}
			
			
		</style>
		<form id='request_form'>
			<input type='hidden' id='request_string' />
			<input type='hidden' value="0" id='request_count' />
			<input type='button' value='Save your changes' id='request_submit'/>
		</form>
		<?php
		
		/*********************
		CLASSES QUERY
		*********************/
		
		$classes = array();
		
		//Get student classes (array)
		$student_classes = array();
		$classes_result = db_query("SELECT n.field_classes_nid FROM {field_data_field_classes} n WHERE n.entity_id = :uid", array(':uid' => $user->uid));
		foreach($classes_result as $row) {
			array_push($student_classes,$row->field_classes_nid);
		}
		
		//add nid, title, and teacher to $classes array
		foreach($student_classes as $key=>$nid) {
			//select title
			$title_result = db_query("SELECT n.title FROM {node} n WHERE n.nid = :nid", array(':nid' => $nid));
			foreach($title_result as $row) {
				$classes[$key][0] = $nid;
				$classes[$key][1] = $row->title;
			}
			
			//select teacher
				//->possible bug due to the multi-teacher functionality
			//get uid
			$teacher_result = db_query("SELECT n.field_teacher_uid FROM {field_data_field_teacher} n WHERE n.entity_id = :nid LIMIT 1", array(':nid' => $nid));
			foreach($teacher_result as $row) {
				$teacher_uid = $row->field_teacher_uid;
				//get name
				$teacher_final_result = db_query("SELECT n.name FROM {users} n WHERE n.uid = :uid LIMIT 1", array(':uid' => $teacher_uid));
				foreach($teacher_final_result as $row2) {
					$classes[$key][2] = $row2->name;
				}
			}
		}
		
		//PRINT Classes.
		
		echo "
		<div id='classes_left'>
			
			<h4>
				Current Classes
			</h4>
			
			<ul id='classes_list'>";
		
		foreach($classes as $class) {
			echo "<li>
					<div class='class_info'>
						<a href='../node/" . $class[0] . "'>" . $class[1] . " | " . $class[2] . "</a>
					</div>
					
					<div id='classes_edit_" . $class[0] . "' class='class_edit classes_edit' title='delete->" . $class[0] . "'>
						 Delete
					</div>
					
					<div class='clear'></div>
				</li>";
		}
		
		echo "</ul>
		</div><!--end classes left-->
		";
		
		
		/*********************
		BROWSER QUERY
		*********************/
		
		//search for all classes associated with school(s)
		$browser = array();
		
		//get user school(s)
		$student_schools = array();
		$schools_result = db_query("SELECT n.field_school_nid FROM {field_data_field_school} n WHERE n.entity_id = :type", array(':type' => $user->uid));
		foreach($schools_result as $row) {
			array_push($student_schools,$row->field_school_nid);
		}
		
		//if student has a school
		if(count($student_schools) > 0) {
			//Get all classes (filtered by school)
			$browser_classes = array();
			$browser_result = db_query("SELECT n.entity_id FROM {field_data_field_school} n WHERE n.field_school_nid = :school AND n.bundle = :type", array(':school' => $student_schools[0], ':type' => 'otw_class'));
			foreach($browser_result as $row) {
				array_push($browser_classes,$row->entity_id);
			}
			
			//add nid, title, and teacher to $browser array
			foreach($browser_classes as $key=>$nid) {
				//select title
				$title_result = db_query("SELECT n.title FROM {node} n WHERE n.nid = :nid", array(':nid' => $nid));
				foreach($title_result as $row) {
					$browser[$key][0] = $nid;
					$browser[$key][1] = $row->title;
				}
				
				//select teacher
					//->possible bug due to the multi-teacher functionality
				//get uid
				$teacher_result = db_query("SELECT n.field_teacher_uid FROM {field_data_field_teacher} n WHERE n.entity_id = :nid LIMIT 1", array(':nid' => $nid));
				
				foreach($teacher_result as $row) {
					$teacher_uid = $row->field_teacher_uid;
					//get name
					$teacher_final_result = db_query("SELECT n.name FROM {users} n WHERE n.uid = :uid LIMIT 1", array(':uid' => $teacher_uid));
					foreach($teacher_final_result as $row2) {
						$browser[$key][2] = $row2->name;
					}
				}
			}
		}
		
		
		
		//PRINT Browser Class Searchs
		
		echo "
		<div id='classes_right'>
			
			<h4>Add Classes</h4>
			
			<form>
				<input type='text' placeholder='Search class name' />
			</form>
			
			<ul id='browser_list'>
			";
			
		if(count($student_schools) > 0) {
			foreach($browser as $class) {
				echo "<li>
						<div class='browser_class_info'>
							<a href='../node/" . $class[0] . "'>" . $class[1] . " | " . $class[2] . "</a>
						</div>
						
						<div id='classes_edit_" . $class[0] . "' class='browser_class_edit classes_edit' title='add->" . $class[0] . "'>
							 Add
						</div>
						
						<div class='clear'></div>
					</li>";
			}
		}else {
			echo "<li>
					<div class='browser_class_info'>
						You must <a href='settings'>select a school</a> in your settings
					</div>
					
					<div class='clear'></div>
				</li>";
		}
		
		
		echo "		
			</ul>
			<div id='browser_bottom'></div>
			<div id='browser_bottom2'></div>
			<div id='browser_bottom3'></div>
			<div id='browser_bottom4'></div>
		
		</div><!--end classes_right-->
		";
		
		
		?>
		<div class='clear'></div>
		
		<script type='text/javascript' src='../sites/all/themes/otw/assets/js/student_classes.js'></script>
		
	</div>
</div>
