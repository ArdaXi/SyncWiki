jQuery.fn.fadeToggle = function(speed, easing, callback) {
   return this.animate({opacity: 'toggle'}, speed, easing, callback);
};

function showProtection()
{
	$('#protect_options').fadeToggle();
	
	return false;
}