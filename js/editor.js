function reportSubmit()
{
	var radios = $('#report_form #reason_radio');
	var canSubmit = false;
	
	for(i=0;i<radios.length;i++)
	{
		if(radios[i].checked == true)
		{
			if(radios[i].value == '9999')
			{
				canSubmit = ($('#report_form #other_box').val() != '');
			}
			else
			{
				canSubmit = true;
			}
			break;
		}
	}
	
	if(canSubmit)
	{
		$('#report').html('<p>Thank you, your report has been submitted.</p>');
		var height = $('#report').height() + 34;
        
        $('.panels').animate({
          height: height
        }, 500);
	}
	
	return false;
}

function deleteSubmit()
{
	if($("#delete_reason").val() == '')
	{
		alert('Please provide a reason!');
		return false;
	}
	
	var $content = $(".content"),
		contentHeight = $content.height() + 30;
	$content.css('height', contentHeight);
	$content.children().fadeOut('fast', function() {
			$content.html("<div class=\"delete delete_img\">This page has been successfully deleted.</div>")
				.fadeIn('fast', function() { 
					$content.animate({height: 48}, 500);
				});
		});
		
	return false;
}

$(document).ready(function (){
	$("#report_form").submit(function() {
		return reportSubmit();
	});
	$("#delete_form").submit(function() {
		return deleteSubmit();
	});
});