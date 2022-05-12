<div class="modal fade item_model" id="product_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-cart"></i> Create new Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <form id="item_create_form" >
                        @csrf
                        <div class="row">
                        <div class="form-group col-md-4">
                            <label for="name">{{ trans('cruds.item.fields.name') }}</label>
                            <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}">
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.item.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="cost_price">{{ trans('cruds.item.fields.cost_price') }}</label>
                            <input class="form-control {{ $errors->has('cost_price') ? 'is-invalid' : '' }}" type="number" name="cost_price" id="cost_price" value="{{ old('cost_price', '') }}" step="0.01">
                            @if($errors->has('cost_price'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('cost_price') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.item.fields.cost_price_helper') }}</span>
                        </div>
                        <div class="form-group col-md-4">
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
                        </div>
                    </form>
                    <div class="form-group col-md-12">
                        <button id="btn-ajax-submit-2" class="btn btn-success" type="button" onclick="createItem()">
                            {{ trans('global.save') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>