@extends('layouts.admin')
@section('content')
    <div class="flex flex-wrap justify-between mb-4">
        <h3><i class="fa-fw fas fa-shopping-cart fa-file-invoice-dollar"></i>
            Create  Item
        </h3>
    </div>
<div class="card col-md-8">
    <div class="card-body">
        <form method="POST" action="{{ route("admin.items.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="row">

            <div class="form-group col-md-12">
                <label for="name">{{ trans('cruds.item.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}">
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.item.fields.name_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="cost_price">{{ trans('cruds.item.fields.cost_price') }}</label>
                <input class="form-control {{ $errors->has('cost_price') ? 'is-invalid' : '' }}" type="number" name="cost_price" id="cost_price" value="{{ old('cost_price', '') }}" step="0.01">
                @if($errors->has('cost_price'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cost_price') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.item.fields.cost_price_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="sale_price">{{ trans('cruds.item.fields.sale_price') }}</label>
                <input class="form-control {{ $errors->has('sale_price') ? 'is-invalid' : '' }}" type="text" name="sale_price" id="sale_price" value="{{ old('sale_price', '') }}">
                @if($errors->has('sale_price'))
                    <div class="invalid-feedback">
                        {{ $errors->first('sale_price') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.item.fields.sale_price_helper') }}</span>
            </div>
            <div class="form-group col-md-12">
                <label for="description">{{ trans('cruds.item.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description') }}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.item.fields.description_helper') }}</span>
            </div>
            <div class="form-group col-md-12">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
            </div>
        </form>
    </div>
</div>



@endsection