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
                    required: "Enter your primary email",
                    email: "Please enter valid email"
                },
                general_secondary_email: {
                    required: "Enter your primary email",
                    email: "Please enter valid email"
                },
                general_mobile_no: {
                    required: "This field is required",
                    number: "Please enter valid number"
                },
                general_home_phone: {
                    required: "This field is required",
                    number: "Please enter valid number"
                },
                general_work_phone: {
                    required: "This field is required",
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
                general_address: {
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
                general_mobile_no: {
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

        $('.js-frm-save-user-avatar').validate({
            messages: {
                user_avatar: {
                    required: "Please upload an image"                    
                }
            },
            rules: {
                user_avatar: {
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