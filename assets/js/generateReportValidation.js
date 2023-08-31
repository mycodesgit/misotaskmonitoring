
$(function () {
    $('#generateReport').validate({
        rules: {
            start_date: {
                required: true
            },
            end_date: {
                required: true
            }
        },
        messages: {
            start_date: {
                required: "Please select Date"
            },
            end_date: {
                required: "Please select Date"
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.col-md-6').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
    });
});
