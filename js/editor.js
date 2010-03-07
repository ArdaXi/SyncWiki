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

$(document).ready(function (){
	$("#report_form").submit(function() {
		return reportSubmit();
	});
});