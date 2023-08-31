 <script>
    $(document).ready(function() {
        var calendar = $('#calendar').fullCalendar({
            editable:true,
            header:{
                left:'prev,next today',
                center:'title',
                right:'month,agendaWeek,agendaDay'
            },
            events: '../app/actions/loadcalendar.php',
            themeSystem: 'bootstrap',
            selectable:true,
            selectHelper:true,
            navLinks: true,
            displayEventTime: true,
            editable:false,
            eventResize:function(event){
                var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                var title = event.title;
                var id = event.id;
                $.ajax({
                    url:"actions/update.php",
                    type:"POST",
                    data:{title:title, person_req:person_req, start:start, end:end, start_time:start_time, no_participants:no_participants, id:id},
                    success:function(){
                       calendar.fullCalendar('refetchEvents');
                       alert('Event Update');
                    }
                })
            },

            eventDrop:function(event){
                var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                var title = event.title;
                var id = event.id;
                $.ajax({
                    url:"actions/update.php",
                    type:"POST",
                    data:{title:title, person_req:person_req, start:start, end:end, start_time:start_time, no_participants:no_participants, id:id},
                    success:function(){
                        calendar.fullCalendar('refetchEvents');
                         alert("Event Updated");
                    }
                });
            },
            navLinks:true,
            eventClick: function(calEvent, jsEvent, view, resourceObj) {
            Swal.fire({
                title: calEvent.title,
                text: "From: " + moment(calEvent.start).format("MMMM Do YYYY") + // Event Start Date
                      "\n To: " + moment(calEvent.end).format("MMMM Do YYYY"),
                icon: "info",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Edit",
                cancelButtonText: "Delete",
            }).then((result) => {
                if (result.value) {
                    // Edit button clicked
                    Swal.fire({
                        title: 'Edit Event',
                        html: `
                                <textarea id="editEventTitle" class="swal2-input" row="4">${calEvent.title}</textarea>
                               <input type="date" id="editEventStartDate" value="${moment(calEvent.start).format('YYYY-MM-DD')}" placeholder="Start Date" class="swal2-input">
                               <input type="date" id="editEventEndDate" value="${moment(calEvent.end).format('YYYY-MM-DD')}" placeholder="End Date" class="swal2-input">`,
                        showCancelButton: true,
                        confirmButtonText: 'Save',
                        cancelButtonText: 'Cancel',
                        preConfirm: () => {
                            const title = document.getElementById('editEventTitle').value;
                            const startDate = document.getElementById('editEventStartDate').value;
                            const endDate = document.getElementById('editEventEndDate').value;
                            // Perform the edit action here
                            // You can redirect to another page or make an AJAX request to update the event
                            //return { title, startDate, endDate };
                            $.ajax({
                                url: "../app/actions/calendarEventAction.php",
                                type: "POST",
                                data: {
                                    eventId: calEvent.id,
                                    title: title,
                                    start_date: start_date,
                                    end_date: end_date
                                },
                                success: function(response) {
                                    // Handle the success response
                                    console.log(response);
                                    // You can refresh the calendar or perform any other action as needed
                                },
                                error: function(xhr, status, error) {
                                    // Handle the error response
                                    console.log(xhr.responseText);
                                    // Display an error message or handle the error in an appropriate way
                                }
                            });
                        }
                    }).then((result) => {
                        if (result.value) {
                            const { title, start_date, end_date } = result.value;
                            // Update the event details
                            calEvent.title = title;
                            calEvent.start = moment(start_date).toDate();
                            calEvent.end = moment(end_date).toDate();
                            calendar.fullCalendar('updateEvent', calEvent);
                            Swal.fire({
                                icon: 'success',
                                title: 'Event updated successfully!',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    // Delete button clicked
                    // Perform the delete action here
                    // You can make an AJAX request to delete the event
                }
            });
        }

            
        });
    });
</script>