$(document).ready(function() {
    var dataTable = $('#example').DataTable({
        ajax: {
            url: '../pages/ticketing/ticketsAjaxTable.php',
            dataSrc: 'data'
        },
        columns: [
            { data: 'no' },
            { data: 'ticket_no' },
            { data: 'cat_id' },
            { data: 'concern' },
            { data: 'urgency_level' },
            { data: 'status' },
            { data: 'actions' }
        ],
        responsive: false,
        lengthChange: false,
        searching: false,
        ordering: false,
        paging: false
    });

    // Refresh the DataTable every 5 seconds
    setInterval(function() {
        dataTable.ajax.reload(null, false);
    }, 3000);
});