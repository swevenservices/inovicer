@extends('layouts.admin')
@section('content')
    <div class="flex flex-wrap justify-between mb-4">
        <h3><i class="fa-fw fas fa-calendar-alt "></i> Calender</h3>
        <div class="text-right">
            <button class="btn btn-primary" data-toggle="modal" data-target="#calenderAddModal">
                <i class="fas fa-file-import"> </i> Add Event
            </button>
        </div>
    </div>
    <style>
        .fc-title {
            color: white !important;
        }

        .fc-time {
            color: white !important;
        }
    </style>

    <div class="card">

        <div class="card-body">
            <link rel='stylesheet'
                  href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css'/>
            <div id='calendar'></div>
        </div>
    </div>
    <div id="calendarModal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Event</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span
                                class="sr-only">close</span></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="event-update-form">
                        @csrf
                        <input id="id" name="id" type="hidden">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <p> Current Invoice <strong id="current_invoice"> </strong></p>
                                <label class="required" for="invoices_select">Invoice</label>
                                <select class="form-control select2"
                                        name="invoice" id="invoices_select" required>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="required" for="start">{{ trans('cruds.event.fields.start') }}</label>
                                <input class="form-control datetime {{ $errors->has('start') ? 'is-invalid' : '' }}"
                                       type="text" name="start" id="start" value="{{ old('start') }}" required>
                                @if($errors->has('start'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('start') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.event.fields.start_helper') }}</span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="end">{{ trans('cruds.event.fields.end') }}</label>
                                <input class="form-control datetime {{ $errors->has('end') ? 'is-invalid' : '' }}"
                                       type="text" name="end" id="end" value="{{ old('end') }}">
                                @if($errors->has('end'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('end') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.event.fields.end_helper') }}</span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="description">{{ trans('cruds.event.fields.description') }}</label>
                                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                                       type="text" name="description" id="description"
                                       value="{{ old('description', '') }}">
                                @if($errors->has('description'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('description') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.event.fields.description_helper') }}</span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="color">Color</label>
                                <input class="form-control {{ $errors->has('color') ? 'is-invalid' : '' }}"
                                       type="color" name="color" id="color"
                                       value="{{ old('color', '') }}">
                                @if($errors->has('color'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('color') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group col-md-12">
                                <p>Currently Working <strong id="current_employees"> </strong></p>
                                <label class="required" for="employees">Employees Working</label>
                                <select class="form-control select2 employeeSelect"
                                        name="employees[]" id="employees" multiple required>
                                </select>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="updateEvent()" id="btn-ajax-submit"
                            data-dismiss="modal">Save Changes
                    </button>
                       @can('event_delete')
                        <form action="{{ route('admin.events.permanent.remove')}}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                            <input id="del_id" name="id" type="hidden">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                        </form>
                    @endcan
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div id="calenderAddModal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Event</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span
                                class="sr-only">close</span></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="event-add-form">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="required" for="invoices_select">Invoice</label>
                                <select class="form-control invoices_select select2"
                                        name="invoice" id="invoices_select2" required>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="required" for="start">{{ trans('cruds.event.fields.start') }}</label>
                                <input class="form-control datetime {{ $errors->has('start') ? 'is-invalid' : '' }}"
                                       type="text" name="start"  value="{{ old('start') }}" required>
                                @if($errors->has('start'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('start') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.event.fields.start_helper') }}</span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="end">{{ trans('cruds.event.fields.end') }}</label>
                                <input class="form-control datetime {{ $errors->has('end') ? 'is-invalid' : '' }}"
                                       type="text" name="end"  value="{{ old('end') }}">
                                @if($errors->has('end'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('end') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.event.fields.end_helper') }}</span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="description">{{ trans('cruds.event.fields.description') }}</label>
                                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                                       type="text" name="description"
                                       value="{{ old('description', '') }}">
                                @if($errors->has('description'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('description') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.event.fields.description_helper') }}</span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="color">Color</label>
                                <input class="form-control {{ $errors->has('color') ? 'is-invalid' : '' }}"
                                       type="color" name="color"
                                       value="{{ old('color', '') }}">
                                @if($errors->has('color'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('color') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group col-md-12">
                                <label class="required" for="employees">Employees Working</label>
                                <select class="form-control select2 employees"
                                        name="employees[]" id="employees2" multiple required>
                                </select>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="saveEvent()" id="btn-ajax-add-submit"
                            data-dismiss="modal">Save Event
                    </button>
                   
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
    <script>
        var events = [];
        $(document).ready(function () {
            getData();
            employeeSelectInit2();
            invoicesSelectInit2();
        });
        function getData() {
            axios.get('{{route('admin.events.ajax')}}')
                .then(function (response) {
                    events = response.data;
                    initCalender();
                })
                .catch(function (error) {
                    toastr.error("smothing went wrong ", 'error');
                });
        }
        function initCalender() {
            $('#calendar').fullCalendar({
                initialView: 'listMonth',
                events: events,
                eventClick: function (event, jsEvent, view) {
                    $('#title').val(event.s_title);
                    $('#start').val(moment(event.start).format("YYYY-MM-DD HH:mm:ss"));
                    $('#end').val(moment(event.end).format("YYYY-MM-DD HH:mm:ss"));
                    $('#id').val(event.id);
                     $('#del_id').val(event.id);
                    $('#color').val(event.color);
                    $('#current_employees').html(event.employees);
                    $('#current_invoice').html('<a href="http://127.0.0.1:8000/admin/invoices/' + event.model +'/edit">'+event.invoice +'</a>');
                    $('#description').val(event.description);
                    $('#calendarModal').modal();
                    employeeSelectInit();
                    invoicesSelectInit();
                }
            })
        }
        function updateEvent() {
            $('#btn-ajax-submit').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>' + ' saving');
            var data = $('#event-update-form').serialize();
            axios.post('{{route('admin.events.ajax.update')}}', data)
                .then(function (response) {
                    if (response.data.status === 200) {
                        $('#customer_create_form').find("input[type=text], textarea").val("");
                        toastr.success("Event has been updated successfully", 'Event Updated');
                        $('#calendarModal').hide();
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();
                        $('#calendar').fullCalendar('destroy');
                        getData();
                    }
                    if (response.data.status === 400) {
                        toastr.error("something went wrong", 'error')
                    }
                    $('#btn-ajax-submit').html('save');
                })
                .catch(function (error) {
                    toastr.error("smothing went wrong ", 'error');
                })
            ;
        }
        function employeeSelectInit() {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $('#employees').select2({
                ajax: {
                    url: "{{route('admin.users.ajax.employees')}}",
                    type: "get",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            _token: CSRF_TOKEN,
                            search: params.term // search term
                        };
                    },
                    processResults: function (response) {
                        return {
                            results: response
                        };
                    },
                    cache: true
                }
            });
        }
        function invoicesSelectInit() {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $('#invoices_select').select2({
                ajax: {
                    url: "{{route('admin.invoices.get.ajax')}}",
                    type: "get",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            _token: CSRF_TOKEN,
                            search: params.term // search term
                        };
                    },
                    processResults: function (response) {
                        return {
                            results: response
                        };
                    },
                    cache: true
                }
            });
        }

        function saveEvent() {
            $('#btn-ajax-add-submit').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>' + ' saving');
            var data = $('#event-add-form').serialize();
            axios.post('{{route('admin.events.ajax.save')}}', data)
                .then(function (response) {
                    if (response.data.status === 200) {
                        $('#event-add-form').find("input[type=text], textarea").val("");
                        toastr.success("Event has been saved successfully", 'Event Updated');
                        $('#calendarModal').hide();
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();
                        $('#calendar').fullCalendar('destroy');
                        getData();
                    }
                    if (response.data.status === 400) {
                        toastr.error("something went wrong", 'error')
                    }
                    $('#btn-ajax-add-submit').html('save');
                })
                .catch(function (error) {
                    toastr.error("smothing went wrong ", 'error');
                })
            ;
        }

        function employeeSelectInit2() {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $('#employees2').select2({
                ajax: {
                    url: "{{route('admin.users.ajax.employees')}}",
                    type: "get",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            _token: CSRF_TOKEN,
                            search: params.term // search term
                        };
                    },
                    processResults: function (response) {
                        return {
                            results: response
                        };
                    },
                    cache: true
                }
            });
        }
        function invoicesSelectInit2() {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $('#invoices_select2').select2({
                ajax: {
                    url: "{{route('admin.invoices.get.ajax')}}",
                    type: "get",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            _token: CSRF_TOKEN,
                            search: params.term // search term
                        };
                    },
                    processResults: function (response) {
                        return {
                            results: response
                        };
                    },
                    cache: true
                }
            });
        }


    </script>
@stop