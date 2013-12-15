$(document).ready(function() {
		$('#simple-menu').sidr();
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
