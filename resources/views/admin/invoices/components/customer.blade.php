<div class="modal fade bd-example-modal-lg"  id="customer_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-users"></i> Add New Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <form id="customer_create_form">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="required" for="name">{{ trans('cruds.user.fields.name') }}</label>
                                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text"
                                       name="name" id="name" value="{{ old('name', '') }}" required>
                                @if($errors->has('name'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('name') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="required" for="email">{{ trans('cruds.user.fields.email') }}</label>
                                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email"
                                       name="email" id="email" value="{{ old('email') }}" required>
                                @if($errors->has('email'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('email') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.user.fields.email_helper') }}</span>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="required" for="mobile">Mobile</label>
                                <input class="form-control {{ $errors->has('mobile') ? 'is-invalid' : '' }}"
                                       type="mobile"
                                       name="mobile" id="mobile" required>
                                @if($errors->has('mobile'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('mobile') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.user.fields.password_helper') }}</span>
                            </div>
                                <input hidden class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                       type="password"
                                       value="123456"
                                       name="password" id="password" required>
                            </div>

                            <div class="form-group col-md-12">
                                <label class="required" for="address">Address</label>
                                <textarea class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}"
                                     type="text"
                                     name="address" id="address" required></textarea>
                            </div>
                            <input type="hidden" value="2" name="role">

                        </div>
                    </form>
                    <div class="form-group col-md-12">
                        <button  id="btn-ajax-submit" class="btn btn-success" type="button" onclick="addCustomer()">

                            {{ trans('global.save') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>