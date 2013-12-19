$(document).ready(function() {
		

	function noNegs() {
			var value = $(this).val();
			if (value<0) {
				$(this).next().html("No negative numbers")
			} else {
				$(this).next().html("");
			}
	}
	
	function formatCurrency() {
			$(this).val(parseFloat($(this).val()).toFixed(2));
	}
	
	function maxChars() {
			//make the maxchar thing DRY?
		    // Find out what is in the field
	        var value = $(this).val();
	
	        var how_many_characters = value.length;
	
	        var how_many_left = $(this).attr('maxlength') - how_many_characters;
	
	        if(how_many_left == 0) {
	                $(this).next().css('color','red');
	        }
	        else if(how_many_left < 5) {
	                $(this).next().css('color','orange');
	        }
			$(this).next().html(how_many_left + ' characters left.');	
	}
		
		
		$('input[name=location]').on("keyup", maxChars);
		$('input[name=price]').on("keyup", noNegs);
		$('input[name=price]').on("change", noNegs);
		$('input[name=price]').on("blur", formatCurrency);
		
		// Description text area on v_bricks_add
		$('#description').on("keyup", maxChars);

		$('#logo').sidr('open','sidr');
		
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

		$('.availableBtn').bind("click",function(){
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
