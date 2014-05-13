//STUDENT DASHBOARD JS

(function ($) {
 $(document).ready(function() {
  	
  	//ALL jQuery HERE
	//alert('1');
		//*************************
		//JAVASCRIPT Mouse-tracking
		//*************************
		var points = new Array();
		var i = 0;
		var time = 0;
		
		
		window.setInterval(function() {
			time += 50;
		}, 50);
		
		$(document).mousemove(function(event){
		  	//if(time%150 == 0) {
		  		if(i > 0) {
		  			if(time != points[i-1][2]) {
		  				points[i] = new Array();
						
						//Actual position x = mouse_x - div_x (SAME FOR Y-AXIS)
							//POSITION IS RELATIVE (pos or neg) to the top left of the navigation
						var position = $("#nav").position();
						var mouse_x = event.pageX;
						var mouse_y = event.pageY;
						var div_x = position.left;
						var div_y = position.top;
						
						points[i][0] = mouse_x - div_x;
						points[i][1] = mouse_y - div_y;
						points[i][2] = time;
						
						i++;
		  			}
		  		}else {
		  			points[i] = new Array();
					
					//Actual position x = mouse_x - div_x (SAME FOR Y-AXIS)
						//POSITION IS RELATIVE (pos or neg) to the top left of the navigation
					var position = $("#nav").position();
					var mouse_x = event.pageX;
					var mouse_y = event.pageY;
					var div_x = position.left;
					var div_y = position.top;
					
					points[i][0] = mouse_x - div_x;
					points[i][1] = mouse_y - div_y;
					points[i][2] = time;
					
					i++;
		  		}
		  	//}
		}); 
		
		$(document).click(function() {
			//temporarily comment for viewing
			
			echo = "";
			for(e=0;e<points.length;e++) {
				echo += points[e][0] + "," + points[e][1] + "," + points[e][2] + "<->";
			}
			alert(echo);
			
		});
		
		/*******
		
		MOUSE POSITION NOT RELATIVE TO DIV BUT THE CLIENT'S WINDOW
		-need to get dashboard coords in same terms, then get the difference to find the actual value
		
		********/
		
	
	
	
	//alert('2');
	
  	
  	
  	
 });
})(jQuery);

//$("#edit-nid").value();


	/*$( "#dash_ajax" ).click(function() {
		$.get( "../sites/all/themes/otw/templates/block--block--9.tpl.php", function( data ) {
			$( "#testing" ).html( data );
			alert( "Load was performed." );
		});
	});*/