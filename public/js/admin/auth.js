var isSlugNameChanged = false;
var Login = function() {
	var handleValidationLoginPage = function() {
		$('.js-login-frm').validate({
			messages: {
			},
			rules :{
				login: {
					required: true,
					email: true
				},
				password : {
					required: true,
				}
			},
			errorPlacement: function (error, element) { // render error placement for each input type
                element.parent().append(error);
            },
            submitHandler: function (form) {                
                $.ajax({
			        url: "/en/login",
			        data: { 'login' : $("#email_address").val(), 'password' : $("#password").val()  },
			        type: 'POST',
			        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
			    }).done(function(response) {
					$(".js-companies-modal-content").append(response);
					$("#select-company-modal").show();
				});
            }
		});
	};

	return {
        init: function() {
            handleValidationLoginPage();
        }
    }
}();

$(document).ready(function() {
	
	Login.init();
	
	$(".forget-form").hide();

	$(document).on('click', "#forget-password", function() {
		$(".login-form").hide();
		$(".forget-form").show();
	});

	$(document).on('click', "#back-btn", function() {
		$(".login-form").show();
		$(".forget-form").hide();
	});

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


  	// $(document).on('click', '#login_btn', function() {
  	//   	$.ajax({
	//        url: "/en/login",
	//        data: { 'login' : $("#email_address").val(), 'password' : $("#password").val()  },
	//        type: 'POST',
	//        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
	//    }).done(function(response) {
	// 	$(".js-companies-modal-content").append(response);
	// 	$("#select-company-modal").show();
	// });
  	//});

	$(document).on('click', '.btn-select-company', function() {
		var companyId = $(this).data('company-id');
		var companySlug = $(this).data('company-slug');
		$.ajax({
	    	type: "POST",
	    	url: "/" + window.locale + "/admin/companyselect",
	    	headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
	    	data: {'companyslug': companySlug, 'roleid': $("#user_company_roles_" + companyId).val()},
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