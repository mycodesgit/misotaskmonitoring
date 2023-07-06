

function editTicket(id) {
    $.ajax({
        url: "../pages/accomplishment/edit-ticket.php",
        method: "POST",
        data: { id: id },
            success: function (data) {
                $('#editTicket').html(data);
            },
            error: function (xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}


function deleteItem(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "GET",
                url: "../actions/ticketAction.php",
                data: { id:id, btnDelete:true},
                success: function(response) {
                    Swal.fire({
                        title: 'Deleted!',
                        text: 'Your file has been deleted.',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2000 
                    }).then(function() {
                        $('#ticket-'+id).fadeOut(1000, function() {
                            $(this).remove(); 
                        });
                    });
                }
            });
        }
    });
}

setInterval(function() {
    var catid = document.getElementById("cat-id").value;
    if(catid != ""){
        $.ajax({
            type: "GET",
            url: "../actions/ticketAction.php",
            data: { catid:catid, ticketCode:true },
            success: function(response) {
                document.getElementById("ticket_no").value=response;
            }
        });
    }
    else{
        document.getElementById("ticket_no").value="";
    }
}, 1000);

setInterval(function() {
        $.ajax({
            type: "GET",
            url: "../actions/ticketAction.php",
            data: { updateIdnum:true },
            success: function(response) {
                console.log(response);
            }
        });
}, 1000);

setTimeout(function () {
    $( "#alert" ).delay(2500).fadeOut(5000);
}, );

