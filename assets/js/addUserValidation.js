$(function () {
    $('#addUser').validate({
        rules: {
            fname: {
                required: true
            },
            mname: {
                required: true
            },
            lname: {
                required: true
            },
            username: {
                required: true,
                minlength: 5
            },
            password: {
                required: true,
                minlength: 5
            },
            off_id: {
                required: true
            },
            emp_gender: {
                required: true
            },
            usertype: {
                required: true
            },
        },
        messages: {
            fname: {
                required: "Please enter a First Name"
            },
            mname: {
                required: "Please enter a Middle Name"
            },
            lname: {
                required: "Please enter a Last Name"
            },
            username: {
                required: "Please enter a username",
                minlength: "Your username must be at least 5 characters long"
            },
            password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 5 characters long"
            },
            off_id: {
                required: "Please select an Office"
            },
            emp_gender: {
                required: "Please select a Gender"
            },
            usertype: {
                required: "Please select a User Type"
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.col-md-12', '.col-md-4').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
    });
});