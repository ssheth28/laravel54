var isSlugNameChanged = false;

var Registration = function() {
    var handleValidationRegistrationPage = function() {
        $('.js-register-frm').validate({
			messages: {
				company_name: 'Company name is required.',
				company_slug: 'Company URL is required.',
				first_name: 'First name is required.',
				last_name: 'Last name is required.',
				username: 'Username is required.',
				email: {
					required: 'Email Id is required.'
				},
				password: 'Password is required.',
				password_confirmation: {
					required: 'Confirmation password is required.',
					equalTo: 'Password does not match.'
				},
				// terms_condition: 'You must agree with the terms and conditions.',
			},
            rules: {
            	company_name: {
            		required: true,
            	},
            	company_slug: {
            		required: true
            	},
            	first_name: {
            		required: true
            	},
            	last_name: {
            		required: true
            	},
            	username: {
            		required: true
            	},
            	email: {
            		required: true,
            		email: true
            	},
				password : {
					required: true,
				},
				password_confirmation: {
					required: true,
					equalTo : "#password"
				},
				// terms_condition: {
				// 	required: true,
				// }
            },
            errorPlacement: function (error, element) { // render error placement for each input type
                element.parent().parent().append(error);
            },
            submitHandler: function (form) {
            	if (grecaptcha.getResponse()) {
            		form.submit();
            	} else {
            		$('#recaptcha-error').show();
            	}
            }
        });
    };

    return {
        init: function() {
            handleValidationRegistrationPage();
        }
    }
}();

var Login = function() {
	var handleValidationLoginPage = function() {
		$('.js-login-frm').validate({
			rules :{
				login: {
					required: true,
					email: true
				},
				password : {
					required: true,
				},
			},
			errorPlacement: function (error, element) { // render error placement for each input type
                element.parent().parent().append(error);
            },
            submitHandler: function (form) {
            	$('.js-login-error-message').html("");
            	$(".js-login-error-message").hide();
                $.ajax({
			        url: "/en/login",
			        data: { 'login' : $("#email_address").val(), 'password' : $("#password").val(), 'remember' : $("#remember_me").val()  },
			        type: 'POST',
			        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
			        success: function(response) {
			        	$('.overlay').addClass('modal-backdrop');
						$(".js-companies-modal-content").append(response);
						$("#select-company-modal").show();
			        },
			        error: function(xhr, ajaxOptions, thrownError) {
			        	$(".js-login-error-message").show();
			        	$('.js-login-error-message').html(xhr.responseJSON.email);
			        },
			    })
            }
		});
	};

    var formEvents = function() {
    	$("#email_address, #password").on('keyup', function (e) {
		    if (e.keyCode == 13) {
		        $('.js-login-frm').submit();
		    }
		});
    };
	return {
        init: function() {
            handleValidationLoginPage();
            formEvents();
        }
    }
}();

var ForgotPassword = function() {
	var handleValidationForgotPasswordPage = function() {
		$('.js-forgot-password-frm').validate({
			rules :{
				email: {
					required: true,
					email: true
				}
			},
			errorPlacement: function (error, element) { // render error placement for each input type
                element.parent().parent().append(error);
            },
            submitHandler: function (form) {
            	form.submit();
            }
		});
	};

	return {
        init: function() {
            handleValidationForgotPasswordPage();
        }
    }
}();

var ResetPassword = function() {
	var handleValidationResetPasswordPage = function() {
		$('.js-reset-password-frm').validate({
			rules :{
				password: {
                    required: true,
                    minlength: 6
                },
                password_confirmation: {
                    equalTo: "#reset_password"
                },
			},
			errorPlacement: function (error, element) { // render error placement for each input type
                element.parent().parent().append(error);
            },
            submitHandler: function (form) {
            	form.submit();
            }
		});
	};

	return {
        init: function() {
            handleValidationResetPasswordPage();
        }
    }
}();

$(document).ready(function() {
	
	Login.init();
	Registration.init();
	ForgotPassword.init();
	ResetPassword.init();
	
	$(document).on('keyup', '#company_name', debounce(function(){
        if ($(this).val() !== "" && isSlugNameChanged == false) {
	        $.ajax({
		        url: window.locale + "/company/generateSlug",
		        data: { 'company_name' : $("#company_name").val() },
		        type: 'POST',
		        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
		    }).done(function(response) {
				$("#company_slug").val(response);
			});
		}
    },500));

	$(document).on('click', '.btn-select-company', function() {
		var companyId = $(this).data('company-id');
		var companySlug = $(this).data('company-slug');
		$.ajax({
	    	type: "POST",
	    	url: "/" + window.locale + "/admin/companyselect",
	    	headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
	    	data: {'companyslug': companySlug, 'companyid': companyId},
	    	success: function(result){
	    		window.location.href = result.redirecturl;
		    }
		});
	});

    $("#company_slug").blur(function(){
    	isSlugNameChanged = true
    });

    //http://davidwalsh.name/javascript-debounce-function
	function debounce(func, wait, immediate) {
		var timeout;
		return function() {
			var context = this, args = arguments;
			var later = function() {
				timeout = null;
				if (!immediate) func.apply(context, args);
			};
			var callNow = immediate && !timeout;
			clearTimeout(timeout);
			timeout = setTimeout(later, wait);
			if (callNow) func.apply(context, args);
		};
	};
});