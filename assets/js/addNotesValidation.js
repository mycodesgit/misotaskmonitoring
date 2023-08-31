
$(function () {
    $('#addNotes').validate({
        rules: {
            note_title: {
                required: true
            },
            note_content: {
                required: true
            } 
        },
        messages: {
            note_title: {
                required: "Please enter a your Note title"
            },
            note_content: {
                required: "Please enter a your Note Content"
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
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
    });
});
