@extends('layouts.admin')
@section('content')
    <div class="flex flex-wrap justify-between mb-4">
        <h3><i class="fa-fw fas fa-file-invoice c-sidebar-nav-icon"></i>
            Edit Payments  </h3>
    </div>
<div class="card col-md-6 ">
    <div class="card-body">
        <form method="POST" action="{{ route("admin.receipts.update", [$receipt->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <input type="hidden" name="invoice_id" value="{{$receipt->invoice->id}}">
            <div class="form-group">
                <label for="received">{{ trans('cruds.receipt.fields.received') }}</label>
                <input class="form-control {{ $errors->has('received') ? 'is-invalid' : '' }}" type="number" name="received" id="received" value="{{ old('received', $receipt->received) }}" step="0.01">
                @if($errors->has('received'))
                    <div class="invalid-feedback">
                        {{ $errors->first('received') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.receipt.fields.received_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="pending">{{ trans('cruds.receipt.fields.pending') }}</label>
                <input class="form-control {{ $errors->has('pending') ? 'is-invalid' : '' }}" type="number" name="pending" id="pending" value="{{ old('pending', $receipt->pending) }}" step="0.01">
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