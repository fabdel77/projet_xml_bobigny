$(document).ready(init);
function init()
{
	console.log($('#tabs'));
	/*$('#promotion').datepicker({
		dateFormat: 'yy',	
	});*/
	addYearToPromotion();
	$('#tabs').tabs();
}
function addYearToPromotion(from,how_many)
{
	how_many = how_many!=undefined && !isNaN(how_many) ? how_many : 9; 
	var promos = $('#promotion');
	var start_year;
	console.log(from);
	console.log(how_many);
	if(from==undefined || isNaN(from))
	{
		console.log(promos);
		console.log($(promos).children('option[value!=""]'));
		start_year = parseInt($(promos).children('option[value!=""]').val());
	}
	else
	{
		start_year = from;
	}
	console.log(start_year);
	var pre_option = $(promos).children('option[value="'+start_year+'"]');

	var pre_year = start_year;
	for(var i=0;i<how_many;i++)
	{
		console.log(i);
		var next_option = $(pre_option).next();
		var next_year = pre_year+1;
		console.log(next_option);
		console.log(next_year);
		console.log(pre_option);
		if(next_option.length==0 || $(next_option).val()!=next_year)
		{
			var new_option = $('<option></option')
				.attr('value',next_year)
				.text(next_year);
			console.log(pre_option);
			$(pre_option).after(new_option);
			next_option=new_option;
		}
		pre_year=next_year;
		pre_option=next_option;
	}
}