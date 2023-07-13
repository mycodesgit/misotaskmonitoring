 <script>
    $(document).ready(function() {
        var calendar = $('#calendar').fullCalendar({
            editable:true,
            header:{
                left:'prev,next today',
                center:'title',
                right:'month,agendaWeek,agendaDay'
            },
            events: '../app/actions/calendarEvent.php',
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
                    text: "From : "+moment(calEvent.start).format("MMMM Do YYYY") +//Event Start Date
                           "\n To : "+moment(calEvent.end).format("MMMM Do YYYY"),
                    icon: "info",
                  });
              }

            
        });
    });
</script>