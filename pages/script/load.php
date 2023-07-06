 <script>
    $(document).ready(function() {
        var calendar = $('#calendar').fullCalendar({
            editable:true,
            header:{
                left:'prev,next today',
                center:'title',
                right:'month,agendaWeek,agendaDay'
            },
            events: 'actions/load.php',
            themeSystem: 'bootstrap',
            selectable:true,
            selectHelper:true,
            navLinks: true,
            displayEventTime: true,
            // select: function(todo_event, start_date, end_date,){
            //     var start_date = start.format('YYYY-MM-DD');
            //     var end_date = end.format('YYYY-MM-DD');

            //     // Display the selected dates in the modal or perform any other necessary actions
            //     $('#modal-event').modal('show');
            //     $('#start_date_input').val(start_date);
            //     $('#end_date_input').val(end_date);
            
            // },
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
            eventClick:  function(calEvent, jsEvent, view) {                 
                $('#modalTitle').html(calEvent.title);
                    var imgName= calEvent.image;
                    console.log(calEvent);
                    document.getElementById('imageDiv').innerHTML = '<img src='+imgName+' onerror=this.style.display="none" width="100%" height="90%">';
                $('#startTime').html(moment(calEvent.start).format('MMMM Do YYYY, h:mm a'));
                $('#endTime').html(moment(calEvent.end).format('MMMM Do YYYY, h:mm a'));
                $('#modalBodyLoc').html(calEvent.dept);
                $('#modalBodyRec').html(calEvent.person_req);
                $('#fullCalModal').modal('show');
            
             return false;
            }
        });
    });
</script>