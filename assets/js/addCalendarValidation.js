
$(function () {
    $('#addCalendarEvent').validate({
        rules: {
            title: {
                required: true
            },
            start_date: {
                required: true
            },
            end_date: {
                required: true
            } 
        },
        messages: {
            title: {
                required: "Please enter a your Event Title"
            },
            start_date: {
                required: "Please select Date to start"
            },
            end_date: {
                required: "Please select Date to start"
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
