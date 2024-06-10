@extends('layouts.master')

@section('css')
    <style>
        .none{
            display: none;
        }
    </style>
@endsection

@section('style')
    {{-- vendor --}}
    <link rel="stylesheet"
        href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/libs/fullcalendar/fullcalendar.css">
    <link rel="stylesheet"
        href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/libs/flatpickr/flatpickr.css">
    <link rel="stylesheet"
        href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/libs/select2/select2.css">
    <link rel="stylesheet"
        href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/libs/@form-validation/form-validation.css">

    {{-- page --}}
    <link rel="stylesheet"
        href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/css/pages/app-calendar.css">
@endsection

@section('content')
    <div class="card app-calendar-wrapper">
        <div class="row g-0">
            <!-- Calendar Sidebar -->
            <div class="col app-calendar-sidebar" id="app-calendar-sidebar">
                <div class="border-bottom p-4 my-sm-0 mb-3">
                    <div class="d-grid">
                        <h3 class="text-center">Calendar Event</h3>
                    </div>
                </div>
                <div class="p-4">
                    <!-- inline calendar (flatpicker) -->
                    <div class="ms-n2">
                        <div class="inline-calendar"></div>
                    </div>

                    <hr class="container-m-nx my-4">

                    <!-- Filter -->
                    <div class="mb-4">
                        <small class="text-small text-muted text-uppercase align-middle">Filter</small>
                    </div>

                    <div class="form-check mb-2">
                        <input class="form-check-input select-all" type="checkbox" id="selectAll" data-value="all" checked>
                        <label class="form-check-label" for="selectAll">View All</label>
                    </div>

                    <div class="app-calendar-events-filter">
                        
                        <div class="form-check mb-2">
                            <input class="form-check-input input-filter" type="checkbox" id="select-business"
                                data-value="business" checked>
                            <label class="form-check-label" for="select-business">engagement and enrollment</label>
                        </div>
                        <div class="form-check form-check-warning mb-2">
                            <input class="form-check-input input-filter" type="checkbox" id="select-family"
                                data-value="family" checked>
                            <label class="form-check-label" for="select-family">Building Management</label>
                        </div>
                        <div class="form-check form-check-success mb-2">
                            <input class="form-check-input input-filter" type="checkbox" id="select-holiday"
                                data-value="holiday" checked>
                            <label class="form-check-label" for="select-holiday">Moon Event</label>
                        </div>
                      
                    </div>
                </div>
            </div>
            <!-- /Calendar Sidebar -->

            <!-- Calendar & Modal -->
            <div class="col app-calendar-content">
                <div class="card shadow-none border-0">
                    <div class="card-body pb-0">
                        <!-- FullCalendar -->
                        <div id="calendar"></div>
                    </div>
                </div>
                <div class="app-overlay"></div>
                <!-- FullCalendar Modal -->
                <div class="modal fade" id="addEventModal" tabindex="-1" aria-labelledby="addEventModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header border-bottom">
                                <h5 class="modal-title mb-2" id="addEventModalLabel">Add Event</h5>
                                <button type="button" class="btn-close text-reset" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="event-form pt-0" id="eventForm" onsubmit="return false">
                                    <div class="mb-3">
                                        <label class="form-label" for="eventTitle">Title</label>
                                        <input type="text" class="form-control" id="eventTitle" name="eventTitle"
                                            placeholder="Event Title" readonly disabled/>
                                    </div>
                                    <div class="mb-3 none">
                                        <label class="form-label" for="eventLabel">Label</label>
                                        <select class="select2 select-event-label form-select" id="eventLabel" name="eventLabel">
                                            <option data-label="primary" value="Business" selected>Business</option>
                                            <option data-label="danger" value="Personal">Personal</option>
                                            <option data-label="warning" value="Family">Family</option>
                                            <option data-label="success" value="Holiday">Holiday</option>
                                            <option data-label="info" value="ETC">ETC</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="eventStartDate">Start Date</label>
                                        <input type="text" class="form-control" id="eventStartDate" name="eventStartDate"
                                            placeholder="Start Date" readonly disabled/>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="eventEndDate">End Date</label>
                                        <input type="text" class="form-control" id="eventEndDate" name="eventEndDate"
                                            placeholder="End Date" readonly disabled/>
                                    </div>
                                    <div class="mb-3 none">
                                        <label class="switch">
                                            <input type="checkbox" class="switch-input allDay-switch" />
                                            <span class="switch-toggle-slider">
                                                <span class="switch-on"></span>
                                                <span class="switch-off"></span>
                                            </span>
                                            <span class="switch-label">All Day</span>
                                        </label>
                                    </div>
                                   
                                   
                                    <div class="mb-3">
                                        <label class="form-label" for="eventLocation">Location</label>
                                        <input type="text" class="form-control" id="eventLocation" name="eventLocation"
                                            placeholder="Enter Location" readonly disabled/>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="eventPhone">Phone</label>
                                        <input class="form-control" name="eventPhone" id="eventPhone" readonly disabled></input>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="eventCapacity">Capacity</label>
                                        <input class="form-control" name="eventCapacity" id="eventCapacity" readonly disabled></input>
                                    </div>
                                    <div class="mb-3 d-flex justify-content-sm-between justify-content-start my-4">
                                        <div>
                                            <button type="submit" class="btn btn-primary btn-add-event me-sm-3 me-1 none">Add</button>
                                            {{-- <button type="reset" class="btn btn-label-secondary btn-cancel me-sm-0 me-1"
                                                data-bs-dismiss="modal">Cancel</button> --}}
                                        </div>
                                        <div><button class="btn btn-label-danger btn-delete-event d-none none">Delete</button></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Calendar & Modal -->
        </div>
    </div>
@endsection

@section('script')
    @parent
    {{-- vendor --}}
    <script
        src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/libs/fullcalendar/fullcalendar.js">
    </script>
    <script
        src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/libs/@form-validation/popular.js">
    </script>
    <script
        src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/libs/@form-validation/bootstrap5.js">
    </script>
    <script
        src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/libs/@form-validation/auto-focus.js">
    </script>
    <script
        src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/libs/select2/select2.js">
    </script>
    <script src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/libs/moment/moment.js">
    </script>
    <script
        src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/libs/flatpickr/flatpickr.js">
    </script>

    {{-- page --}}
    <script src="{{ asset('') }}assets/js/app-calendar-events.js"></script>
    <script src="{{ asset('') }}assets/js/app-calendar.js"></script>
    <script>
        window.events =  [
            @foreach($events as $event){
     id:  "{{ $event->id }}",
     url:  "",
     title:  "{{ $event->title }}",
     start:  "{{ $event->start }}",
     end:  "{{ $event->end }}",
     location:  "{{ $event->location }}",
     phone:  "{{ $event->phone }}",
     capacity:  "{{ $event->capacity }}",
     allDay:  ! 1,
     extendedProps:  {
         calendar:  "{{ $event->type }}"
    }
}, @endforeach
        ];

        // Initialize the modal
        $(document).ready(function () {
            $('#addEventModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var modal = $(this);

                // If editing an event, populate the fields
                var eventId = button.data('event-id');
                if (eventId) {
                    var event = window.events.find(e => e.id == eventId);
                    if (event) {
                        modal.find('#eventTitle').val(event.title);
                        modal.find('#eventLabel').val(event.extendedProps.calendar).trigger('change');
                        modal.find('#eventStartDate').val(event.start);
                        modal.find('#eventEndDate').val(event.end);
                        modal.find('.allDay-switch').prop('checked', event.allDay);
                        modal.find('#eventURL').val(event.url);
                        modal.find('#eventDescription').val(event.description);
                        // Set guests and location if applicable
                    }
                } else {
                    modal.find('form')[0].reset();
                }
            });

            // Initialize FullCalendar
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: window.events,
                dateClick: function(info) {
                    // Show the modal for creating new event
                    $('#addEventModal').modal('show');
                },
                eventClick: function(info) {
                    // Show the modal for editing existing event
                    $('#addEventModal').modal('show');
                }
            });
            calendar.render();
        });
    </script>
@endsection
