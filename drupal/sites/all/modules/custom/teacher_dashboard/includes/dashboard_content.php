<?php



function teacher_dashboard_getBlockContent($delta) {
	$content = array();
		
	//ALL BLOCK CONTENT
	
	//HEADER
	//**********************
	//Get user readable date.
	$header_name;
	$header_date;
	$curr_day_num = date("N");
	if($curr_day_num > 5) {
		//on the weekend
		$header_name = "Monday";
		$header_date = date("F j", strtotime("next monday"));
		$date_db = date("n/j/Y", strtotime("next monday"));
	}else {
		//in the week
		$header_name = "Tomorrow";
		$header_date = date("F j", strtotime("+1 day"));
		$date_db = date("n/j/Y", strtotime("+1 day"));
	}
	
	//Set header content.
	$content['teacher_dashboard_header'] = "
		<div id='teacher_dashboard_header'>
			<!--<h3>" . $header_name . " - " . $header_date . "</h2>--!>
		</div>
	";
	
	//PERIODS
	$content['teacher_dashboard_periods'] = "
		<div id='teacher_dashboard_periods'>
			<p>Period info</p>
		</div>
	";
	
	//return content
	return $content[$delta];
	
}
