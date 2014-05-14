(function ($) {
 $(document).ready(function() {
  	
  	//ALL jQuery HERE
	$(".classes_edit").click(function() {
		var title = this.title;
		var parts = title.split('->');
		var type = parts[0];
		var nid = parts[1];
		var request = "";
		request += type + "->" + nid + "<->";
		
		//alter request string
		curr_request = $("#request_string").val();
		$("#request_string").val(curr_request + request);
		
		//show submit button
		$("#request_form").css('display','block');
		$( "#request_form" ).animate({
			opacity: 1,
			height: "32px"
		}, 300);
		
		//alter submit button to reflect changes
		//get count
		var request_count = $("#request_count").val();
		request_count = parseInt(request_count) + 1;
		//set val
		$("#request_submit").val("Save your " + request_count + " changes");
		//increment counter
		$("#request_count").val(request_count);
		
		//max opacity permanently
		$("#classes_edit_" + nid).css('opacity', '1');
	});
	
	$("#request_submit").click(function() {
		//alert('begin');
		
		//pull request string
		var request = $("#request_string").val()
		var request = request.split("<->");
		//hide each element in request
		
		//COMMENT->not functioning 
		/*for(i=0;i<request.length;i++) {
			var components = request[i].split("->");
			if(components[0] == "delete" || components[0] == "add") {
				var items = $(".classes_edit");
				for(e=0;e<items.length;e++) {
					var title = items[e].title;
					var parts = title.split('->');
					var type = parts[0];
					var nid = parts[1];
					
					//check if current itt. is the choice element
					if(type == components[0] && nid == components[1]) {
						alert("They're equal->" + nid + "==" + components[1]);
					}
				}
			}
		}*/
		
		
		//COMMENT-> for presentation
		/*$.ajax({
		  type: "POST",
		  url: "../sites/all/themes/otw/requests/student_classes_request.php",
		  data: { request_string: request}
		}).done(function(data) {
			alert( "Data Saved: " + data);
		});*/
	});
	
	
  	//alert('loading');
  	
  	/*
  	NOT properly getting input value and altering
  	
  	*/
  	
  	
 });
})(jQuery);


