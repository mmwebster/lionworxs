/*On cal item click, show edit window with selected node*/


/*views-exposed-form-teacher-dashboard-edit-assignment-block

javascript:document.getElementById('edit-nid').value='[nid]';

document.getElementById('views-exposed-form-teacher-dashboard-edit-assignment-block').submit();

*/
//alert('V1');

(function ($) {
 $(document).ready(function() {
  	
  	//ALL jQuery HERE
  	
  	//onready definition of event listener
  	$('.teacher_calendar_item_title_inner').click(function() {
  		//alert('has been clicked');
  		//get nid
  		var nid = this.title;
  		//set edit block filter to this nid
  		document.getElementById('edit-nid').value=nid;
  		
  		//submit filter form
  		//document.getElementById('views-exposed-form-teacher-dashboard-edit-assignment-block').submit();
  		//$('#views-exposed-form-teacher-dashboard-edit-assignment-block').trigger('submit');
  		$('#edit-submit-teacher-dashboard-edit-assignment').click();
  		
  		$('#block-views-a16f876710b9321ac44a4e8e04470596').css('display', 'block');
  		
  	});
  	
  	/*$('#editableviews-entity-form-teacher-dashboard-edit-assignment #edit-actions-submit').click(function() {
  		$('#block-views-a16f876710b9321ac44a4e8e04470596').css('display', 'none');
  	});*/
  	
  	//Ajax request has finished and may re-attach event listeners
  	$(document).bind("ajaxStop", function(){

     	$('.teacher_calendar_item_title_inner').click(function() {
			//get nid
			var nid = this.title;
			
			//set edit block filter to this nid
			document.getElementById('edit-nid').value=nid;
			
			//submit filter form
			$('#edit-submit-teacher-dashboard-edit-assignment').click();
			
  			//display the form
  			$('#block-views-a16f876710b9321ac44a4e8e04470596').css('display', 'block');
			
		});

     });
  	
  	
 });
})(jQuery);

//alert('end');
//$("#edit-nid").value();