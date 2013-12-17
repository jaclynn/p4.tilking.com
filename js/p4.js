$(document).ready(function() {
		
		
		$('#simple-menu').sidr({
			onOpen: function(){
				$('#simple-menu').html("Hide Menu");
			},
			onClose: function(){
				$('#simple-menu').html("Show Menu");
			}
		});
		
		$.sidr('open', 'sidr');

		$('#sidr li').bind("click",function() { 
			$(this).addClass("active");
			});
		


		$('.interestBtn').bind("click",function(){
			alert("interest button clicked");
			//$(this).parent().append(php_user);
			var current_id = $(this).parent().attr('id');
			console.log(current_id);
			$.ajax({ url: '/bricks/p_interest',
			         data: {user_id: php_user_id, brick_id: $(this).parent().attr('id')},
			         type: 'post',
			         success: function(output) {
			                      current_id = '#'+current_id+' .int_parties';
			                      int_div = "testing";
			                      console.log(output);
			                      $(current_id).html(output);
			                    
			                  }
							  });

		});
		/*
  		var wall = new freewall(".container");
	        wall.reset({
            selector: '.border',
            animate: true,
            onResize: function() {
                this.fitWidth();
            }
        });
 
        wall.fitWidth();
        */

		function loadInterest(brick_id) {
			alert(brick_id);
		}
        
        	var ewall = new freewall("#freewall");
			ewall.reset({
				selector: '.brick',
				animate: true,
				cellW: 200,
				cellH: 'auto',
				onResize: function() {
					ewall.fitWidth();
					// added this, seemed to help:
					ewall.fitHeight();
				}
			});
			
			var images = ewall.container.find('.brick');
			var length = images.length;
			images.css({visibility: 'hidden'});
			images.find('img').load(function() {
				-- length;
				if (!length) {
					setTimeout(function() {
						images.css({visibility: 'visible'});						
						ewall.fitWidth();
						//this made all bricks the height of the tallest:
						//ewall.fitHeight();
					}, 505);
				}

			});
    });
