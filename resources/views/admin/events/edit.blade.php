@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.event.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.events.update", [$event->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="form-group col-md-12">
                        <label class="required" for="invoices_select">Invoice ( Search invoice number or customer
                            name)</label>
                        <select class="form-control select2" name="invoice" id="invoices_select" required>
                            <option value="{{$event->model}}"> {{$event->model}} </option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="required" for="start">{{ trans('cruds.event.fields.start') }}</label>
                        <input class="form-control datetime {{ $errors->has('start') ? 'is-invalid' : '' }}"
                               type="text" name="start" id="start" value="{{ old('start' , $event->start) }}" required>
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
                               type="text" name="end_time" id="end" value="{{ old('end_time' , $event->end) }}">
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
                               value="{{ old('description', $event->description) }}">
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
                               value="{{ old('color', $event->color) }}">
                        @if($errors->has('color'))
                            <div class="invalid-feedback">
                                {{ $errors->first('color') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-md-12">
                        <p>Currently Working <strong id="current_employees"> </strong></p>
                        <label class="required" for="employees">Employees Working</label>
                        <select class="form-control select2 employeeSelect" name="employees[]" id="employees" multiple
                                required>
                            @if($event->employees)
                                @foreach(json_decode($event->employees) as $employee)
                                <option selected value="{{$employee}}">{{$employee}}  </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
@section('scripts')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        $(document).ready(function () {
            employeeSelectInit();
            invoicesSelectInit();
        });
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
    </script>
@endsection