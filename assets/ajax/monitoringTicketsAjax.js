$(document).ready(function() {
    var dataTable = $('#example').DataTable({
        ajax: {
            url: 'pages/viewMonitoringTicketsTable.php',
            dataSrc: 'data'
        },
        columns: [
            { data: 'ticket_no' },
            { data: 'category' },
            { data: 'office' },
            { data: 'concern' },
            { data: 'urgency_level' },
            { data: 'status' }
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