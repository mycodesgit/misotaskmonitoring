$(function () {
    $('#updateUserPass').validate({
        rules: {
            password: {
                required: true,
                minlength: 5
            }
        },
        messages: {
            password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 5 characters long"
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.col-md-12').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
    });
});

$(function () {
    $('#updateUserPhoto').validate({
        rules: {
            profile_image: {
                required: true,
                extension: "png|jpg|jpeg",
            }
        },
        messages: {
            profile_image: {
                required: "Please provide a profile image",
                extension: "Please upload a valid PNG, JPG, or JPEG image",
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.col-md-12').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
    });
});

$(function () {
    $('#updateUserInfo').validate({
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
            element.closest('.col-md-4').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
    });
});