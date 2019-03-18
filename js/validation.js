$(function(){

	$("#sign_up").validate({

		rules: {
			fullname: {
				required: true

			},
			username: {
				required:true
			},
			email: {
				required: true,
				email: true,
			},
			
			birthdate: {
				required: true
			}

		},
		messages: {
			fullname:{
				required: 'This field is required'
			},
			username: 'This field is require'

		}
	});



});




$(function(){

	$("#message_form").validate({

		rules: {
			message: {
				required: true,

			}
			
		},
		file: {

			required:true,
		},
		recipients: {
			required: true
		}
	



});
});


$(function(){

	$("#message_list").validate({

		rules: {
			message: {
				required: true,

			}
			
		},
	



});
});