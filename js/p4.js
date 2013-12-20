$(document).ready(function() {
		

	function noNegsNaN() {
			var value = $(this).val();
			if (isNaN(value)) {
				$(this).next().html("Entry must be a number");
			}
			else if (value<0) {
				$(this).next().html("No negative numbers");
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
		$('input[name=price]').on("keyup", noNegsNaN);
		$('input[name=price]').on("change", noNegsNaN);
		$('input[name=price]').on("blur", formatCurrency);
		
		// Description text area on v_bricks_add
		$('#description').on("keyup", maxChars);

		//$('#logo').sidr('open','sidr');
		
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
		


		$('.statusBtn').bind("click",function(){
			//$(this).parent().append(php_user);
			var current_id = "#status"+$(this).parent().attr('id');
			console.log(current_id);
			$.ajax({ url: '/bricks/p_updatebrickstatus',
			         data: {availability: $(this).attr('id'), brick_id: $(this).parent().attr('id')},
			         type: 'post',
			         success: function(output) {
			                      new_class = output;
			                      console.log(new_class);
			                      //$(this).parent().prev().removeClass('AVAILABLE','PPU','SOLD').addClass(output);
			                      console.log($(this).parent().attr('class'));
			                      $(current_id).attr('class',output);
			                  }
							  });

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
