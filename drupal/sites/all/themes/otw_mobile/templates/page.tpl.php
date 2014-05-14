<div id="page">
	<?php
	$style = array();
	$primary_result = db_query("SELECT n.field_color_1_rgb FROM {field_data_field_color_1} n WHERE n.entity_id = :uid", array(':uid' => $user->uid));
	$style[0] = "background-color: #0ae;";
	foreach($primary_result as $row) {
		$style[0] = "background-color: " . $row->field_color_1_rgb . ";";
	}
	//background-color: #01a73e;
	$secondary_result = db_query("SELECT n.field_secondary_color_rgb FROM {field_data_field_secondary_color} n WHERE n.entity_id = :uid", array(':uid' => $user->uid));
	$style[1] = "background-color: #fff;";
	foreach($secondary_result as $row) {
		$style[1] = "background-color: " . $row->field_secondary_color_rgb . ";";
	}
	
	echo "
	<style>
		body {
			" . $style[1] . "
		}
		.region-navigation h2 {
			" . $style[0] . "
		}
		#main input[type='submit'], #main input[type='button'] {
			" . $style[0] . "
		}
	</style>
	";
	
	?>
		<div id='header' style='<?php print $style[0] ?>'>
			<div id='header_container'>
			
				<div id='header_name'>
					<h1>Lionworxs</h1>
					<!--Slogan removed for mobile version-->
				</div><!--end header_name-->
			
				<div id='login'>
					<?php print render($page['login']); ?>
					<div class='clear'></div>
				</div><!--end login-->
				
				<div class='clear'></div>
			</div><!--end header container-->
		</div><!--end header-->
		
		<div id='container'>
			
			<div id='notices'>
				<?php print render($page['notices']); ?>
				<div class='clear'></div>
			</div>
			
			<div id='nav'>
				
				<?php
					print render($page['navigation']);
				?>
				
				<div class='clear'></div>
				
			</div><!--end nav-->
			
			<div id='main'>
				<?php 
				
				/*open the dashboard class for styling*/
				if (in_array('student', array_values($user->roles))) {
					echo "<div class='dashboard student_dashboard'>";
				}else if(in_array('teacher', array_values($user->roles))) {
					echo "<div class='dashboard teacher_dashboard'>";
				}else if(in_array('school administrator', array_values($user->roles))) {
					echo "<div class='dashboard admin_dashboard'>";
				}
				

				/*check user to print different region*/
				if (in_array('student', array_values($user->roles))) {
				    print render($page['student_dashboard']); 
					echo "</div><!--end dashboard-->";
				}else if(in_array('teacher', array_values($user->roles))) {
					print render($page['teacher_dashboard']); 
					echo "</div><!--end dashboard-->";
				}else if(in_array('school administrator', array_values($user->roles))) {
					print render($page['admin_dashboard']); 
					echo "</div><!--end dashboard-->";
				}
				
				print render($page['content']); 
				
				?>			
			</div><!--end main-->
			<div class='clear'></div>
		</div><!--end container-->
		
