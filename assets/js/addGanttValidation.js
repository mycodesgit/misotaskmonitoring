
$(function () {
    $('#addGantt').validate({
        rules: {
            task: {
                required: true
            },
            accommodation: {
                required: true
            },
            start_date: {
                required: true
            },
            end_date: {
                required: true
            },
            'user_id[]': {
                required: true
            }  
        },
        messages: {
            task: {
                required: "Please enter a your Task"
            },
            accommodation: {
                required: "Please enter number of accommodation of task"
            },
            start_date: {
                required: "Please select Date"
            },
            end_date: {
                required: "Please select Date"
            },
            'user_id[]': {
                required: "Please select Person(s) Involve"
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
    });
});
