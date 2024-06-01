<div class="modal fade" id="createEventModal" tabindex="-1" role="dialog" aria-labelledby="createEventModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createEventModalLabel">Create Event</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="eventForm" action="{{ route('admin.event') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Event Title:</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="start">Start Date:</label>
                        <input type="date" class="form-control" id="start" name="start" required>
                    </div>
                    <div class="form-group">
                        <label for="end">End Date:</label>
                        <input type="date" class="form-control" id="end" name="end" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Event</button>
                    <button type="button" class="btn btn-danger" id="deleteEventButton" style="display: none;"
                        onclick="deleteEvent()">Delete Event</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container">
    <div id='calendarContainer'></div>
</div>

<script src='https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.10/index.global.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.10/index.global.min.js'></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>

<script>
    let currentEventId = null;

    document.addEventListener('DOMContentLoaded', function() {
        var myModal = new bootstrap.Modal(document.getElementById('createEventModal'));
        var calendarEl = document.getElementById('calendarContainer');
        var eventsData = {!! json_encode($events) !!};

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            showNonCurrentDates: false,
            events: eventsData.map(event => ({
                title: event.title,
                start: event.start,
                end: new Date(new Date(event.end).setDate(new Date(event.end).getDate() +
                    1)).toISOString().split('T')[0],
                id: event.id
            })),
            dateClick: function(info) {
                myModal.show();
                document.getElementById('eventForm').action = "{{ route('admin.event') }}";
                document.getElementById('title').value = '';
                document.getElementById('start').value = info.dateStr;
                document.getElementById('end').value = '';
                document.getElementById('end').setAttribute('min', info.dateStr);
                document.getElementById('deleteEventButton').style.display = 'none';
                currentEventId = null;
            },
            eventClick: function(info) {
                var event = info.event;
                document.getElementById('eventForm').action = "{{ route('admin.event') }}/" + event
                    .id;
                document.getElementById('title').value = event.title;
                document.getElementById('start').value = event.startStr;
                document.getElementById('end').value = event.endStr ? event.endStr.split('T')[0] :
                    '';
                document.getElementById('deleteEventButton').style.display = 'inline-block';
                currentEventId = event.id;
                myModal.show();
            }
        });

        calendar.render();
    });

    function deleteEvent() {
        if (currentEventId) {
            var url = "{{ route('admin.eventDel', ':id') }}".replace(':id', currentEventId);
            window.location.href = url;
        }
    }
</script>
