<div class="modal fade" id="createEventModal" tabindex="-1" role="dialog" aria-labelledby="createEventModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                @php
                    $user = Auth::user();
                @endphp

                {{-- @if ($user->role_name == 'Admin') --}}
                <h5 class="modal-title" id="createEventModalLabel">Create Event</h5>
                {{-- @endif --}}
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.event') }}" method="POST">
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
                    @if ($user->role_name == 'Admin')
                        <button type="submit" class="btn btn-primary">Save Event</button>
                    @endif
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
    document.addEventListener('DOMContentLoaded', function() {
        var myModal = new bootstrap.Modal(document.getElementById('createEventModal'));
        var calendarEl = document.getElementById('calendarContainer');
        var eventsData = {!! json_encode($events) !!}; // Convert PHP array to JavaScript variable
        const url = 'http://127.0.0.1:8000/AdminDashboard'; // Replace with your actual base URL


        var calendar = new FullCalendar.Calendar(calendarEl, {
            // eventColor: '#FF0000',
            // eventTextColor:'#fff',
            // eventBackgroundColor: '#FF0000', // Set background color for all events to red

             showNonCurrentDates: false,
            events: [
                @foreach ($events as $event)
                    {
                        title: '{{ $event->title }}',
                        start: '{{ $event->start }}',
                        end: '{{ date('Y-m-d', strtotime($event->end . ' +1 day')) }}',
                        eventId: '{{ $event->id }}'

                    },
                @endforeach
            ],
            dateClick: function(info) {
                myModal.show();
                $('#start').val(info.dateStr);
                $('#end').val('');
                $('#end').attr('min', info.dateStr);
            },
            eventContent: function(arg) {
                const eventId = arg.event.extendedProps.eventId;
                return {
                    html: `<div class="" style="display:flex; justify-content:center;">
                        <span>${arg.event.title} </span>
                        </div>
                        <div style="display:flex; justify-content:center;">
                            <a href="${url}/del-event/${eventId}" class="btn btn-danger">Del</a>
                        </div>
                            `
                };
            }
        });
        calendar.render();
    });
</script>
<style>
 