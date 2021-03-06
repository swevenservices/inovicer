@extends('layouts.admin')
@section('content')
    <div class="flex flex-wrap justify-between mb-4">
        <h3><i class="fa-fw fas fa-money-bill c-sidebar-nav-icon"></i>
            Create Category  </h3>
    </div>
<div class="card col-md-8">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.expenseCategory.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.expense-categories.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.expenseCategory.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.expenseCategory.fields.name_helper') }}</span>
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