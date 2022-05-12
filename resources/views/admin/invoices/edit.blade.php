@extends('layouts.admin')
@section('content')
    <div class="flex flex-wrap justify-between mb-4">
        <h3><i class="fa-fw fas fa-file-invoice-dollar"></i>
            {{ trans('global.edit') }}
            {{ trans('cruds.invoice.title_singular') }} </h3>
    </div>
    <form method="POST" action="{{ route("admin.invoices.update", [$invoice->id]) }}"
          enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="required"
                               for="invoice_number">{{ trans('cruds.invoice.fields.invoice_number') }}</label>
                        <input class="form-control {{ $errors->has('invoice_number') ? 'is-invalid' : '' }}"
                               type="number" name="invoice_number" id="invoice_number"
                               value="{{ old('invoice_number', $invoice->invoice_number) }}" step="1" required>

                        @if($errors->has('invoice_number'))
                            <div class="invalid-feedback">
                                {{ $errors->first('invoice_number') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.invoice.fields.invoice_number_helper') }}</span>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="invoice_date">{{ trans('cruds.invoice.fields.invoice_date') }}</label>
                        <input class="form-control date {{ $errors->has('invoice_date') ? 'is-invalid' : '' }}"
                               type="text" name="invoice_date" id="invoice_date"
                               value="{{ old('invoice_date', $invoice->invoice_date) }}">
                        @if($errors->has('invoice_date'))
                            <div class="invalid-feedback">
                                {{ $errors->first('invoice_date') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.invoice.fields.invoice_date_helper') }}</span>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="due_date">{{ trans('cruds.invoice.fields.due_date') }}</label>
                        <input class="form-control {{ $errors->has('due_date') ? 'is-invalid' : '' }}" type="text"
                               name="due_date" id="due_date" value="{{ old('due_date', $invoice->due_date) }}">
                        @if($errors->has('due_date'))
                            <div class="invalid-feedback">
                                {{ $errors->first('due_date') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.invoice.fields.due_date_helper') }}</span>
                    </div>
                       <div class="form-group col-md-6">
                        <label for="purchase_order_number">Purchae Order NUMBER</label>
                        <input class="form-control {{ $errors->has('purchase_order_number') ? 'is-invalid' : '' }}" type="text"
                               name="purchase_order_number" id="due_date" value="{{ old('purchase_order_number', $invoice->purchase_order_number) }}">
                        @if($errors->has('purchase_order_number'))
                            <div class="invalid-feedback">
                                {{ $errors->first('purchase_order_number') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.invoice.fields.due_date_helper') }}</span>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="customer_name">{{ trans('cruds.invoice.fields.customer_name') }}</label>
                        <input class="form-control {{ $errors->has('customer_name') ? 'is-invalid' : '' }}"
                               type="text" name="customer_name" id="customer_name"
                               value="{{ old('customer_name', $invoice->customer_name) }}">
                        @if($errors->has('customer_name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('customer_name') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.invoice.fields.customer_name_helper') }}</span>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="customer_name">Email</label>
                        <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                               type="text" name="email" id="customer_name"
                               value="{{ old('email', $invoice->email) }}">
                        @if($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.invoice.fields.customer_name_helper') }}</span>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="customer_select">Customer
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                    data-target=".bd-example-modal-lg"><i class="fa fa-plus"></i></button>
                        </label>
                        <select id="customer_select" name="customer"
                                class=" form-control customer_search_select"></select>
                        @if($errors->has('customer_name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('customer_name') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.invoice.fields.customer_name_helper') }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="company">{{ trans('cruds.invoice.fields.company') }}</label>
                        <input class="form-control {{ $errors->has('company') ? 'is-invalid' : '' }}" type="text"
                               name="company" id="company" value="{{ old('company', $invoice->company) }}">
                        @if($errors->has('company'))
                            <div class="invalid-feedback">
                                {{ $errors->first('company') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.invoice.fields.company_helper') }}</span>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="complete_address">{{ trans('cruds.invoice.fields.complete_address') }}</label>
                        <textarea rows="1"
                                  class="form-control {{ $errors->has('complete_address') ? 'is-invalid' : '' }}"
                                  name="complete_address"
                                  id="complete_address">{{ old('complete_address', $invoice->complete_address) }}</textarea>
                        @if($errors->has('complete_address'))
                            <div class="invalid-feedback">
                                {{ $errors->first('complete_address') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.invoice.fields.complete_address_helper') }}</span>
                    </div>
                </div>
            </div>
           <div class="form-group col-md-6">
                        <label for="notes">Notes</label>
                        <textarea  rows="2" class="form-control {{ $errors->has('notes') ? 'is-invalid' : '' }}" type="text"
                               name="notes" id="notes" >{{ old('notes', $invoice->notes) }}</textarea>
                        @if($errors->has('notes'))
                            <div class="invalid-feedback">
                                {{ $errors->first('notes') }}
                            </div>
                @endif
           </div>
           <div class="col-md-6">
               <div class="row">
                   <div class="form-group  col-md-12">
                         <label for="customer_name">Attention</label>
                        <input class="form-control {{ $errors->has('attention') ? 'is-invalid' : '' }}"
                               type="text" name="attention" id="attention"
                               value="{{ old('attention', $invoice->attention) }}">
                        @if($errors->has('attention'))
                            <div class="invalid-feedback">
                                {{ $errors->first('attention') }}
                            </div>
                        @endif
                   </div>
                   <div class="form-group  col-md-12">
                         <label for="project">Project </label>
                        <textarea style="min-height:50px" class="form-control {{ $errors->has('project') ? 'is-invalid' : '' }}"
                                name="project" id="project"> {{ old('project', $invoice->project) }}  </textarea>
                        @if($errors->has('project'))
                            <div class="invalid-feedback">
                                {{ $errors->first('project') }}
                            </div>
                        @endif
                   </div>
               </div>
            
            </div>
             
             
        </div>
        <div class="card">
            <div class="card-header">
              <h5> Items
                    <!--<button type="button" class="btn btn-primary btn-sm" data-toggle="modal"-->
                    <!--        data-target=".item_model"><i class="fa fa-plus"></i> Add Product-->
                    <!--</button>-->
                    <!--<a class="btn btn-primary" style="text-align: right;float: right; color: white"-->
                    <!--   onclick="addItem()"> <i class="fa fa-plus"></i> Add Item </a></h5>-->
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <div class="row">
                        <div class="form-group col-md-12 " id="items_container">
                            @foreach($invoice->invoiceInvoiceItems as $item)
                                <div id="invoice_items{{$item->id}}" class="row">
                                    <div class="form-group col-md-3">
                                        <label for="name">{{ trans('cruds.invoiceItem.fields.name') }}</label>
                                      <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                               type="text" name="item_name[]" id="name" value="{{$item->name}}">
                                    @if($errors->has('name'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('name') }}
                                            </div>
                                       @endif
                                        <span class="help-block">{{ trans('cruds.invoiceItem.fields.name_helper') }}</span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="description">{{ trans('cruds.invoiceItem.fields.description') }}</label>
                                        <textarea 
                                               class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                                               style="min-height: 70px !important;"
                                               type="text" name="item_description[]" id="description">{{$item->description}} </textarea>
                                        @if($errors->has('description'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('description') }}
                                            </div>
                                        @endif
                                        <span class="help-block">{{ trans('cruds.invoiceItem.fields.description_helper') }}</span>
                                    </div>
                                    <div class="form-group col-md-1">
                                        <label for="qty">{{ trans('cruds.invoiceItem.fields.qty') }}</label>
                                        <input class="form-control {{ $errors->has('qty') ? 'is-invalid' : '' }}"
                                               type="text" onkeyup="calculateTotalExtra({{$item->id}})"
                                               name="item_qty[]" id="qty{{$item->id}}" value="{{ $item->qty }}"
                                               step="1">
                                        @if($errors->has('qty'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('qty') }}
                                            </div>
                                        @endif
                                        <span class="help-block">{{ trans('cruds.invoiceItem.fields.qty_helper') }}</span>
                                    </div>
                                    <div class="form-group col-md-1">
                                        <label for="unit">Unit</label>
                                        <input class="form-control {{ $errors->has('unit') ? 'is-invalid' : '' }}"
                                               type="text" 
                                               value="{{ $item->unit  }}"
                                               name="item_unit[]"
                                           >
                                        @if($errors->has('unit'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('unit') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="item_price">Unit Price</label>
                                        <input class="form-control {{ $errors->has('item_price') ? 'is-invalid' : '' }}"
                                               type="text" name="item_price[]"
                                               onkeyup="calculateTotalExtra({{$item->id}})" id="price{{$item->id}}"
                                               value="{{ $item->total  }}"
                                               step="1">
                                        <input class="form-control " type="hidden"  value="{{$item->cost_price}}" name="cost_price[]" id="cost_price" step="1">
                                       @if($errors->has('item_price'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('item_price') }}
                                            </div>
                                        @endif
                                        <span class="help-block">{{ trans('cruds.invoiceItem.fields.qty_helper') }}</span>
                                    </div>
                                    <div class="form-group col-md-1">
                                        <label>Total </label>
                                        <p><span id="total_item_price{{$item->id}}">{{$item->qty * $item->total}}</span>
                                            <a style="color: #727b7f; font-size: 20px"
                                               onclick="removeItem({{ $item->id }})"><i class="fa fa-trash"></i>
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <hr style="text-align:center ; width: 100%"/>
                    </div>
                    <div class="col-md-12"><a class="btn btn-primary" style="text-align: right;float: right; color: white"
                       onclick="addItem()"> <i class="fa fa-plus"></i> Add Item </a></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group col-md-12">
                    <label for="currency_id">{{ trans('cruds.invoice.fields.currency') }}</label>
                    <select class="form-control select2 {{ $errors->has('currency') ? 'is-invalid' : '' }}"
                            name="currency_id" id="currency_id">
                        @foreach($currencies as $id => $entry)
                            <option value="{{ $id }}" {{ $invoice->currency ? $invoice->currency->id  == $id ? 'selected' : '' :''}}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('currency'))
                        <div class="invalid-feedback">
                            {{ $errors->first('currency') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.invoice.fields.currency_helper') }}</span>
                </div>
                <div class="form-group col-md-12">
                    <label for="currency_id">Invoice type</label>
                    <select class="form-control select2 " name="type" id="type">
                        <option value="qoute" {{$invoice->type =='qoute' ? 'selected' : ''}} >Qoute</option>
                        <option value="invoice" {{$invoice->type =='invoice' ? 'selected' : ''}} > Invoice
                        </option>
                        <option value="p_invoice" {{$invoice->type =='p_invoice' ? 'selected' : ''}} > Perfoma Invoice
                        </option>
                            <option value="receipt" {{$invoice->type =='receipt' ? 'selected' : ''}} > Receipt
                        </option>
                        
                    </select>
                    @if($errors->has('currency'))
                        <div class="invalid-feedback">
                            {{ $errors->first('currency') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.invoice.fields.currency_helper') }}</span>
                </div>

                <!--<div class="form-group col-md-12">-->
                <!--    <label for="template_type">Template type</label>-->
                <!--    <select class="form-control select2 " name="template_type" id="template_type">-->
                <!--        <option value="default" {{$invoice->template_type =='default' ? 'selected' : ''}} >Default</option>-->
                <!--        <option value="clean" {{$invoice->template_type =='clean' ? 'selected' : ''}} > Clean</option>-->
                <!--    </select>-->
                <!--    @if($errors->has('template_type'))-->
                <!--        <div class="invalid-feedback">-->
                <!--            {{ $errors->first('template_type') }}-->
                <!--        </div>-->
                <!--    @endif-->
                <!--    <span class="help-block">{{ trans('cruds.invoice.fields.currency_helper') }}</span>-->
                <!--</div>-->
                <div class="form-group col-md-12">
                    <label for="template_type">Payment type</label>
                    <select class="form-control select2 " name="payment_type" id="payment_type">
                        <option value="cash" {{$invoice->type =='cash' ? 'selected' : ''}} >Cash</option>
                        <option value="card" {{$invoice->type =='card' ? 'selected' : ''}} > Card</option>
                        <option value="bank transfer" {{$invoice->type =='bank transfer' ? 'selected' : ''}} > Bank Transfer</option>

                    </select>
                    @if($errors->has('template_type'))
                        <div class="invalid-feedback">
                            {{ $errors->first('template_type') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.invoice.fields.currency_helper') }}</span>
                </div>
                
             <div class=" form-group col-md-12 ">
                  <label for="template_type">Admin Company</label>
                    <select  id="admin_company_select" class="form-control " name="admin_company" >
                        <option value="yr" {{$invoice->admin_company =='yr' ? 'selected' : ''}} >Yalla Repairs</option>
                        <option value="yw" {{$invoice->admin_company =='yw' ? 'selected' : ''}} > Yalla Wrap it </option>
                    </select>
            </div>
            
            <div class="form-group col-md-12 ">
           <label for="template_type">Show % of invoice <input style="width:20%" type="number" value="{{$invoice->percentage}}" name="percentage"></label>
           <select  id="admin_company_select" class="form-control"name="show_fifty" id="payment_type">
           <option {{$invoice->show_fifty =='yes' ? 'selected' : ''}} value="yes"> Yes  </option>
           <option {{$invoice->show_fifty =='no' ? 'selected' : ''}}  value="no">No</option>
             </select>
         </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5> Payments</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <div class="form-group col-md-6">
                                <label for="discount">{{ trans('cruds.invoice.fields.discount') }} </label>
                                <select name="discount_type" >
                                    <option {{ $invoice->discount_type =="percent" ? 'selected' :'' }} value="percent">%</option>
                                    <option {{ $invoice->discount_type =="fixed" ? 'selected' :'' }}  value="fixed" >AED</option>
                                 </select>
                                <input class="form-control {{ $errors->has('discount') ? 'is-invalid' : '' }}"
                                       type="number"
                                       name="discount" id="discount" value="{{ old('discount', $invoice->discount) }}"
                                       step="0.01">
                                @if($errors->has('discount'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('discount') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.invoice.fields.discount_helper') }}</span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="discount">Vat(%)</label>
                                <input class="form-control {{ $errors->has('vat') ? 'is-invalid' : '' }}" type="number"
                                       name="vat" id="discount" value="{{ old('vat', $invoice->vat) }}"
                                       step="0.01">
                                @if($errors->has('vat'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('discount') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.invoice.fields.discount_helper') }}</span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="received">Received ( {{$invoice->currency ? $invoice->currency->symbol : ''}} )<input
                                            name="is_received" type="checkbox"
                                            class="switch-input" checked> </label>
                                <input class="form-control {{ $errors->has('received') ? 'is-invalid' : '' }}"
                                       type="number"
                                       name="received" id="received" value="{{$invoice->recepit->received}}"
                                       step="0.01">
                                @if($errors->has('total'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('received') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label for="total">Material Cost </label>
                                <input class="form-control {{ $errors->has('total') ? 'is-invalid' : '' }}"
                                       type="number"
                                       name="material_cost" id="total" value="{{$invoice->recepit->material}}"
                                       step="0.01">
                                @if($errors->has('total'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('total') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.invoice.fields.total_helper') }}</span>
                            </div>
                            <div class="form-group col-md-6 ">
                                <label> Add to Expense</label>
                                <input name="is_expensed" type="checkbox" class="switch-input" checked>
                            </div>
                            <div class="form-group col-md-6 ">
                                <label> Add to Incomes</label>
                                <input name="is_incomed" type="checkbox" class="switch-input" checked
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
         <div id="policy_area"  class="form-group col-md-10 ">
                <label> Privacy Policy</label>
             <textarea style="width:100% !important" name="privacy_policy">{{$invoice->privacy_policy}}</textarea>
         </div>
        
            
        <div class="form-group col-md-12 pt-5">
            <button class="btn btn-success" type="submit">
                <i class="fa fa-save "></i> Save
            </button>
            <h5 class="text-success text-right"> Received
                : {{$invoice->currency ?$invoice->currency->symbol : ''}} {{$invoice->recepit->received}}  </h5>
            <h5 class="text-danger text-right"> Dues
                : {{$invoice->currency ? $invoice->currency->symbol :''}} {{$invoice->recepit->pending}}  </h5>
        </div>
    </form>
    @include('admin.invoices.components.customer')
    @include('admin.invoices.components.item')
      <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
        <script>
           CKEDITOR.replace( 'privacy_policy' );
       </script>
@endsection
@section('scripts')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function () {
            $('.customer_search_select').select2({
                ajax: {
                    url: "{{route('admin.users.ajax.search')}}",
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
        });
   
        function addItem() {
            var timestamp = new Date().getUTCMilliseconds();
            $row = itemRow(timestamp);
            $("#items_container").append($row);
            //selectInit(timestamp);
        }
        function itemRow(timestamp) {
            $html = '<div id="invoice_items' + timestamp + '" class="row"> ' +
                '<div class="form-group col-md-3"> <label for="name">{{ trans('cruds.invoiceItem.fields.name') }}</label> ' +
                ' <input class="form-control" type="text" name="item_name[]" id="name" >' +
              '</div> ' +
                '<div class="form-group col-md-4"> <label for="description">{{ trans('cruds.invoiceItem.fields.description') }}</label> ' +
                '<textarea style="min-height: 70px !important;" class="form-control "type="text" name="item_description[]" id="description' + timestamp + '"></textarea> </div> ' +
                '<div class="form-group col-md-1"> <label for="qty">{{ trans('cruds.invoiceItem.fields.qty') }}</label> ' +
                '<input class="form-control"type="text" onkeyup="calculateTotalExtra(' + timestamp + ')" name="item_qty[]" id="qty' + timestamp + '" step="1"> </div> ' +
                '<div class="form-group col-md-1"> <label for="unit">Unit</label> <input class="form-control" type="text" name="item_unit[]"   >'+
                '</div><div class="form-group col-md-2"> <label for="qty">Unit Price</label> <input class="form-control " onkeyup="calculateTotalExtra(' + timestamp + ')" type="text" name="item_price[]" id="price' + timestamp + '" step="1"> </div>     <input class="form-control " type="hidden"  name="cost_price[]" id="cost_price' + timestamp + '" step="1">' +
                ' <div class="form-group col-md-1"> <label for="qty">Total</label> <p><span id="total_item_price' + timestamp + '">0</span>' +
                '<a style="color: #727b7f; font-size: 20px"onclick="removeItem(' + timestamp + ')"><i class="fa fa-trash"></i> </a></p> </div></div>';
            return $html;
        }
        function selectInit(timestamp) {
            // $('#product_select' + timestamp).select2({
            //     ajax: {
            //         url: "{{route('admin.items.ajax.search')}}",
            //         type: "get",
            //         dataType: 'json',
            //         delay: 250,
            //         data: function (params) {
            //             return {
            //                 _token: CSRF_TOKEN,
            //                 search: params.term // search term
            //             };
            //         },
            //         processResults: function (response) {
            //             return {
            //                 results: response
            //             };
            //         },
            //         cache: true
            //     }

            // });
            // $('#product_select' + timestamp).on('select2:select', function (e) {
            //     var data = e.params.data;
            //     $('#price' + timestamp).val(data.sale_price);
            //     $('#cost_price' + timestamp).val(data.cost_price);
            //     $('#qty' + timestamp).val(1);
            //     $('#description' + timestamp).val(data.description);
            //     $('#total_item_price' + timestamp).html(data.sale_price);
            // });
        }
        function calculateTotalExtra(time) {
            var total = parseFloat($('#qty' + time).val()) * parseFloat($('#price' + time).val());
            $('#total_item_price' + time).html(total);
        }

        function addCustomer() {
            $('#btn-ajax-submit').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>' + ' saving');
            var data = $('#customer_create_form').serialize();
            axios.post('{{route('admin.users.ajax.store')}}', data)
                .then(function (response) {
                    if (response.data.status === 200) {
                        toastr.success("User has been created successfully ", 'User Registered')
                          $('#customer_create_form').find("input[type=text], textarea").val("");
                          
                         $('#customer_modal').hide();
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();
                    }
                    if (response.data.status === 400) {
                        toastr.error("user Already exists or Something is empty ", 'error')
                    }
                    $('#btn-ajax-submit').html('save');
                })
                .catch(function (error) {
                    toastr.error("smothing went wrong ", 'error');
                })
            ;
        }
        function createItem() {
            $('#btn-ajax-submit-2').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>' + ' saving');
            var data = $('#item_create_form').serialize();
            axios.post('{{route('admin.items.ajax.store')}}', data)
                .then(function (response) {
                    if (response.data.status === 200) {
                        toastr.success("Item has been created successfully ", 'Product Created');
                        $('#item_create_form').find("input[type=text], textarea").val("");
                      
                        $('#product_modal').hide();
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();
                    }
                    if (response.data.status === 400) {
                        toastr.error("Item or Something is empty ", 'error')
                    }
                    $('#btn-ajax-submit').html('save');
                })
                .catch(function (error) {
                    toastr.error("smothing went wrong ", 'error');
                })
            ;
        }
        function removeItem($id) {
            $("#invoice_items" + $id).remove();
        }
    </script>
@endsection
