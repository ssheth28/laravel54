var vueUser;
var User = function() {
    var form = $('#submit_user_form');
    // var editForm = $('#submit_edit_user_form');
    var error = $('.alert-danger', form);
    var success = $('.alert-success', form);

    var handleValidationAddPage = function() {
        $('.js-frm-save-general-info').validate({
            messages: {
                general_primary_email: {
                    email: "Please enter valid email"
                },
                general_secondary_email: {
                    email: "Please enter valid email"
                },
                general_mobile_number: {
                    number: "Please enter valid number"
                },
                general_home_phone: {
                    number: "Please enter valid number"
                },
                general_work_phone: {
                    number: "Please enter valid number"
                }
            },
            rules: {
                general_first_name: {
                    required: true
                },
                general_last_name: {
                    required: true
                },
                general_primary_email: {
                    required: true,
                    email: true
                },
                general_secondary_email: {
                    required: true,
                    email: true
                },
                general_address1: {
                    required: true
                },
                general_city: {
                    required: true
                },
                general_state: {
                    required: true  
                },
                general_pin: {
                    required: true  
                },
                general_mobile_number: {
                    required: true,
                    number: true
                },
                general_home_phone: {
                    required: true,
                    number: true
                },
                general_work_phone: {
                    required: true,
                    number: true
                },
                general_date_of_birth: {
                    required: true  
                },
                general_gender: {
                    required: true  
                }
            },
            errorPlacement: function (error, element) { // render error placement for each input type
                element.parent().append(error);
            },
            submitHandler: function (form) {                
                form.submit();
            }
        });

        $('.js-frm-save-change-password').validate({
            messages: {
                change_password_retype_new_password: {
                    equalTo: "Please enter the same password as above"
                }
            },
            rules: {
                change_password_current_password: {
                    required: true
                },
                change_password_new_password: {
                    required: true
                },
                change_password_retype_new_password: {
                    required: true,
                    equalTo: "#change_password_new_password"
                }
            },
            errorPlacement: function (error, element) { // render error placement for each input type
                element.parent().append(error);
            },
            submitHandler: function (form) {
                $.ajax({
                    type: "POST",
                    url: "checkPassword", 
                    data: $('#js-frm-save-change-password').serialize(),
                    success: function(result){
                        console.log(result);
                        if (result === 'false') {
                            $('#current_password_error_msg').show();
                            $("#current_password_error_msg").html("Entered password does not matched");
                            return;
                        }
                        form.submit();
                    }
                });
            }
        });
    };

    return {
        init: function() {
            handleValidationAddPage();
        }
    }
}();

$(document).ready(function() {
    User.init();
});