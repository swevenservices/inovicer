@extends('layouts.admin')
@section('content')

    <div class="flex flex-wrap justify-between mb-4">
        <h3><i class="fa-fw fas fa-file-invoice c-sidebar-nav-icon"></i>
            Create Payments  </h3>
    </div>
<div class="card">

    <div class="card-body">
        <form method="POST" action="{{ route("admin.receipts.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="invoice_id">{{ trans('cruds.receipt.fields.invoice') }}</label>
                <select class="form-control select2 {{ $errors->has('invoice') ? 'is-invalid' : '' }}" name="invoice_id" id="invoice_id" required>
                    @foreach($invoices as $id => $entry)
                        <option value="{{ $id }}" {{ old('invoice_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('invoice'))
                    <div class="invalid-feedback">
                        {{ $errors->first('invoice') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.receipt.fields.invoice_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="received">{{ trans('cruds.receipt.fields.received') }}</label>
                <input class="form-control {{ $errors->has('received') ? 'is-invalid' : '' }}" type="number" name="received" id="received" value="{{ old('received', '') }}" step="0.01">
                @if($errors->has('received'))
                    <div class="invalid-feedback">
                        {{ $errors->first('received') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.receipt.fields.received_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="pending">{{ trans('cruds.receipt.fields.pending') }}</label>
                <input class="form-control {{ $errors->has('pending') ? 'is-invalid' : '' }}" type="number" name="pending" id="pending" value="{{ old('pending', '') }}" step="0.01">
                @if($errors->has('pending'))
                    <div class="invalid-feedback">
                        {{ $errors->first('pending') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.receipt.fields.pending_helper') }}</span>
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