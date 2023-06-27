
$(function () {
    $('#addDailyTask').validate({
        rules: {
            task: {
                required: true
            },
            no_accom: {
                required: true
            } 
        },
        messages: {
            task: {
                required: "Please enter a your Task"
            },
            no_accom: {
                required: "Please enter number of accommodation of task"
            },
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
