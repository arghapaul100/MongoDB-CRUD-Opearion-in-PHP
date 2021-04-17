$(document).ready(function(){
	$('tbody').load('./display.php');
	$('#formId_insert').on('submit',function(e){
		e.preventDefault();

		var formData = new FormData(this);

		$.ajax({
			url:'insert.php',
			type:'post',
			data:formData,
			contentType:false,
			processData:false,
			success:function(data){
				$('input[name=txt_name]').val("");
				$('input[name=txt_roll]').val("");
				$('input[name=txt_address]').val("");
				$('input[name=image]').val("");
				$('#select_year').val("");
				$('#select_grade').val("");

				$('#customLabel').html("Choose File");
				$('tbody').load('display.php');
			}

		})
	})

})