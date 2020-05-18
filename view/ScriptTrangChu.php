<script language="javascript">
    $(document).ready(function() {
        $('.slide').each(function() {
			var slide_height = parseInt($(this).height());
		    var window_height = 0.8*slide_height;
		    $(this).children('.slide-window').height(window_height+"px");
		    $(this).children('.slide-element').height(window_height+"px");
		    slide_height = 0.1*slide_height;
		    $(this).children('.slide-button').height(slide_height+"px");	
		});				
        $(window).resize(function() {
		    $('.slide').each(function() {
		        var slide_height = parseInt($(this).height());
		        var window_height = 0.8*slide_height;
	    	    $(this).children('.slide-window').height(window_height+"px");
	    	    $(this).children('.slide-element').height(window_height+"px");
	    	    slide_height = 0.1*slide_height;
	    	    $(this).children('.slide-button').height(slide_height+"px");	
            });					
		});
		$(document).on('click','.slide-prev',function() {
			var parent = $(this).parent();
			parent = parent.parent();
			parent = parent.children(".slide-window");
			var margin_left = parseInt(parent.css("margin-left"));
            var width = parseInt(parent.children(".slide-element").css("width"));
			margin_left = margin_left+width;
			if (margin_left-width<=0) {
				parent.css("margin-left",margin_left+"px");
			}			
		});
		$(document).on('click','.slide-next',function() {
			var parent = $(this).parent();
			parent = parent.parent();
			parent = parent.children(".slide-window");
			var margin_left = parseInt(parent.css("margin-left"));
            var width = parseInt(parent.children(".slide-element").css("width"));
			var wrong = width;
			margin_left = margin_left-width;
			var width = parseInt(parent.parent().width())-parseInt(parent.width());
			if (margin_left+wrong>width) {
				parent.css("margin-left",margin_left+"px");
			}		
		});		
	});    
</script>    