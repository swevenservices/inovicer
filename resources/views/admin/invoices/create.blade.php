@extends('layouts.admin')
@section('content')
    <div class="flex flex-wrap justify-between mb-4">
        <h3><i class="fa-fw fas fa-file-invoice-dollar"></i>
            {{ trans('global.create') }}
            {{ trans('cruds.invoice.title_singular') }} </h3>
    </div>
    <form method="POST" action="{{ route("admin.invoices.store") }}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="required"
                          for="invoice_number">{{ trans('cruds.invoice.fields.invoice_number') }}</label>
                     @php $id = str_replace('-', '', date('Y-m-d')) .''.$id ; @endphp
                        <input class="form-control {{ $errors->has('invoice_number') ? 'is-invalid' : '' }}"
                               type="text" name="invoice_number" id="invoice_number"
                               value="{{ old('invoice_number', $id) }}"
                               step="1" required>
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
                               value="{{ old('invoice_date', '') }}">
                        @if($errors->has('invoice_date'))
                            <div class="invalid-feedback">
                                {{ $errors->first('invoice_date') }}
                            </div>
                        @endif

                     <span class="help-block">{{ trans('cruds.invoice.fields.invoice_date_helper') }}</span>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="due_date">{{ trans('cruds.invoice.fields.due_date') }}</label>
                        <input class="form-control date {{ $errors->has('due_date') ? 'is-invalid' : '' }}" type="text"
                               name="due_date" id="due_date" value="{{ old('due_date', '') }}">
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
                               name="purchase_order_number" id="due_date" value="{{ old('purchase_order_number', '') }}">
                        @if($errors->has('purchase_order_number'))
                            <div class="invalid-feedback">
                                {{ $errors->first('purchase_order_number') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.invoice.fields.due_date_helper') }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="customer_select">Customer
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                    data-target=".bd-example-modal-lg"><i class="fa fa-plus"></i></button>
                        </label>
                        <select id="customer_select" name="customer" required
                                class=" form-control customer_search_select"></select>
                        @if($errors->has('customer_name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('customer_name') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.invoice.fields.customer_name_helper') }}</span>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="company">{{ trans('cruds.invoice.fields.company') }}</label>
                        <input class="form-control {{ $errors->has('company') ? 'is-invalid' : '' }}" type="text"
                               name="company" id="company" value="{{ old('company', '') }}">
                        @if($errors->has('company'))
                            <div class="invalid-feedback">
                                {{ $errors->first('company') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.invoice.fields.company_helper') }}</span>
                    </div>
                </div>
            </div>
            <div class="form-group col-md-6">
                        <label for="notes">Notes</label>
                        <textarea  rows="2" class="form-control {{ $errors->has('notes') ? 'is-invalid' : '' }}" type="text"
                               name="notes" id="notes" >{{ old('notes', '') }}</textarea>
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
                               value="{{ old('attention') }}">
                        @if($errors->has('attention'))
                            <div class="invalid-feedback">
                                {{ $errors->first('attention') }}
                            </div>
                        @endif
                   </div>
                   <div class="form-group  col-md-12">
                         <label for="project">Project </label>
                        <textarea style="min-height:50px" class="form-control {{ $errors->has('project') ? 'is-invalid' : '' }}"
                                name="project" id="project"> {{ old('project') }}  
                                </textarea>
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
                <h5> Items <span style="color:red; font-size:small"> (item 1 cannot be removed ) </span>
                    <!--<button type="button" class="btn btn-primary btn-sm" data-toggle="modal"-->
                    <!--        data-target=".item_model"><i class="fa fa-plus"></i> Add Product-->
                    <!--</button>-->
                    </h5>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <div class="row">
                        <div class="form-group col-md-12 " id="items_container">
                            <div id="invoice_items" class="row">
                                <div class="form-group col-md-3 ">
                                    <label for="name">{{ trans('cruds.invoiceItem.fields.name') }}
                                    </label>
                                   <input  name="item_name[]" required  class=" form-control ">
                                    @if($errors->has('name'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('name') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.invoiceItem.fields.name_helper') }}</span>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="description">{{ trans('cruds.invoiceItem.fields.description') }}</label>
                                    <textarea style="min-height: 70px !important;" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                                           type="text" name="item_description[]" id="description"></textarea>
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
                                           type="text" onkeyup="calculateTotal()" name="item_qty[]" id="qty"
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
                                               name="item_unit[]" 
                                           >
                                        @if($errors->has('unit'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('unit') }}
                                            </div>
                                        @endif
                                 </div>
                                <div class="form-group col-md-2">
                                    <label for="qty">Unit Price</label>
                                    <input class="form-control {{ $errors->has('qty') ? 'is-invalid' : '' }}"
                                           type="text" onkeyup="calculateTotal()" name="item_price[]" id="price"
                                         
                                           step="1">
                                    <input class="form-control " type="hidden"  name="cost_price[]" id="cost_price" step="1">
                                </div>
                               
                                <div class="form-group col-md-1">
                                    <label for="qty">Total</label>
                                    <p><span id="total_item_price"></span>
                                        <a style="color: #727b7f; font-size: 20px"
                                        ><i class="fa fa-trash"></i>
                                        </a>
                                    <p>
                                </div>
                            </div>
                        </div>
                        <hr style="text-align:center ; width: 100%"/>
                       <div class="col-md-12"><a class="btn btn-primary" style="text-align: right;float: right; color: white"
                       onclick="addItem()"> <i class="fa fa-plus"></i> Add Item </a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group col-md-12">
                    <label for="currency_id">{{ trans('cruds.invoice.fields.currency') }}</label>
                    <select class="form-control select2 {{ $errors->has('currency') ? 'is-invalid' : '' }}"
                            name="currency_id" id="currency_id">
                        @foreach($currencies as $id => $entry)
                            <option selected value="{{ $id }}">{{ $entry }}</option>
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
                    <label for="currency_id">Document Type</label>
                    <select class="form-control select2 " name="type" id="type">
                        <option value="qoute">Qoute</option>
                        <option value="invoice"> Invoice
                        </option>
                        <option value="p_invoice"> Perfoma Invoice
                        </option>
                        <option value="receipt"> Receipt
                        </option
                    </select>
                    @if($errors->has('currency'))
                        <div class="invalid-feedback">
                            {{ $errors->first('currency') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.invoice.fields.currency_helper') }}</span>
                </div>
                <div class="form-group col-md-12">
                    <label for="template_type">Template type</label>
                    <select class="form-control select2 " name="template_type" id="template_type">
                        <option value="default">Default</option>
                        <option value="clean"> Clean</option>
                    </select>
                    @if($errors->has('template_type'))
                        <div class="invalid-feedback">
                            {{ $errors->first('template_type') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.invoice.fields.currency_helper') }}</span>
                </div>
                <div class="form-group col-md-12">
                    <label for="template_type">Payment type</label>
                    <select class="form-control select2 " name="payment_type" id="payment_type">
                        <option value="cash">Cash</option>
                        <option value="card"> Card</option>
                        <option value="bank transfer"> Bank Transfer</option>
                    </select>
                    @if($errors->has('template_type'))
                        <div class="invalid-feedback">
                            {{ $errors->first('template_type') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.invoice.fields.currency_helper') }}</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5> Payments</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="discount">{{ trans('cruds.invoice.fields.discount') }}</label>
                                <select name="discount_type" >
                                    <option selected value="percent">%</option>
                                    <option value="fixed" >AED</option>
                                 </select>
                                <input class="form-control {{ $errors->has('discount') ? 'is-invalid' : '' }}"
                                       type="number"
                                       name="discount" id="discount" value="{{ old('discount', '') }}"
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
                                       name="vat" id="discount" value="{{ old('vat', '') }}"
                                       step="0.01">
                                @if($errors->has('vat'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('discount') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.invoice.fields.discount_helper') }}</span>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="received">Received <input name="is_received" type="checkbox"
                                                                      class="switch-input" checked> </label>
                                <input class="form-control {{ $errors->has('received') ? 'is-invalid' : '' }}"
                                       type="number"
                                       name="received" id="received" value="{{ old('received', '') }}" step="0.01">
                                @if($errors->has('total'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('received') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group col-md-6 ">
                                <label> Add to Expense</label>
                                <input name="is_expensed" type="checkbox" class="switch-input" checked>
                            </div>
                            <div class="form-group col-md-6 ">
                                <label> Add to Incomes</label>
                                <input name="is_incomed" type="checkbox" class="switch-input" checked>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         <input  value="yw" name="admin_company" type="hidden" >
        
          <div class="form-group col-md-5 ">
           <label for="template_type">Show % of invoice <input style="width:20%" type="number" value="" name="percentage"></label>
           <select id="admin_company_select" class="form-control"name="show_fifty" id="payment_type">
           <option  value="yes"> Yes  </option>
           <option selected value="no">No</option>
             </select>
         </div>
          <div  id="policy_area"  class="form-group col-md-12 ">
          <div class="row">
  <textarea style="width:100% !important" name="privacy_policy">
     <p><strong>Terms and Conditions:</strong></p>

<ol>
	<li>Yalla Wrap It will provide wrapping services as stipulated in the above agreement.</li>
	<li>Yalla Wrap It cannot guarantee specific completion times and may change dates of supply and installation if unforeseeable circumstances occur.</li>
	<li>The unit where the work will take place must undergo a deep clean, no dust, grease or dirt in the unit. The unit should be stripped of all domestic goods and surfaces. If not cleaned before the installation a 250 AED service charge will be added to the invoice.</li>
	<li>Change of date and timings should be made no less than 7 days before project start date, if you fail to inform us before this period, you will be charged a penalty of 20% of the total amount of the quotation.</li>
	<li>&nbsp;It is the responsibility of the customer to make sure that she is ready for our team. If we are required to reschedule, a 20% service fee will be applied to the original Invoice.</li>
	<li>Payments to be accepted are Credit, Debit cards and Cash only.</li>
	<li>We do not provide refunds for any work rendered.</li>
	<li>A 24 months material warranty is applicable to this Invoice with a maximum of 3 call outs including the warranty.</li>
	<li>Please note that smooth application of vinyl will depend on the surface. If the surface is uneven, oily, has deep scratches or holes there will be inconsistency in the final.</li>
	<li>50% down payment is required for booking confirmation and final 50% to be paid on the day of installation.</li>
</ol>

<p>&nbsp;</p>

<p><strong>Applicable Law and Jurisdiction:</strong></p>

<ul>
	<li>The Law of the United Arab Emirates governs this Agreement. The parties’ consent to the jurisdiction of the courts of Dubai- United Arab Emirates, any dispute.</li>
</ul>

<p>&nbsp;</p>

</textarea>
                </div>
            </div>
        </div>
        <div  class="form-group col-md-12 mt-5">
            <button class="btn btn-success" type="submit">
                <i class="fa fa-save "></i> Create Invoice
            </button>
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
    
     function changePolicy() {
          var adminCompany = $("#admin_company_select").val();
            if(adminCompany === "yr") 
            {
                document.getElementById('policy_area').style.display="block";
            }
            else{
                document.getElementById('policy_area').style.display="none";
            }
        }
        function addItem() {
            var timestamp = new Date().getUTCMilliseconds();
            $row = itemRow(timestamp);
            $("#items_container").append($row);
            
        }

        function itemRow(timestamp) {
            $html = '<div id="invoice_items' + timestamp + '" class="row"> ' +
                '<div class="form-group col-md-3 "> <label for="name">{{ trans('cruds.invoiceItem.fields.name') }}</label> ' +
                '<input  name="item_name[]"  required class="form-control ">' +
                '</div> ' +
                '<div  class="form-group col-md-4"> <label for="description">{{ trans('cruds.invoiceItem.fields.description') }}</label> ' +
                '<textarea style="min-height: 70px !important;" class="form-control "type="text" name="item_description[]" id="description' + timestamp + '"> </textarea> </div> ' +
                '<div class="form-group col-md-1"> <label for="qty">{{ trans('cruds.invoiceItem.fields.qty') }}</label> ' +
                '<input class="form-control"type="text" onkeyup="calculateTotalExtra(' + timestamp + ')" name="item_qty[]" id="qty' + timestamp + '" step="1"> </div> ' +
                ' <div class="form-group col-md-1"><label for="unit">Unit</label><input class="form-control" type="text" name="item_unit[]" ></div>'+
                '<div class="form-group col-md-2"> <label for="qty">Unit Price</label> <input class="form-control " onkeyup="calculateTotalExtra(' + timestamp + ')" type="text" name="item_price[]" id="price' + timestamp + '" step="1"> <input class="form-control " type="hidden"  name="cost_price[]" id="cost_price' + timestamp + '" step="1"></div> ' +
                ' <div class="form-group col-md-1"> <label for="qty">Total</label> ' +
                '<p><span id="total_item_price' + timestamp + '"></span>' +
                '<a style="color: #727b7f; font-size: 20px"onclick="removeItem(' + timestamp + ')"><i class="fa fa-trash"></i> </a></p> </div></div>';
            return $html;
        }
        function selectInit(timestamp) {
            $('#product_select' + timestamp).select2({
                ajax: {
                    url: "{{route('admin.items.ajax.search')}}",
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
            $('#product_select' + timestamp).on('select2:select', function (e) {
                var data = e.params.data;
                $('#price' + timestamp).val(data.sale_price);
                $('#cost_price'+timestamp).val(data.cost_price);
                $('#qty' + timestamp).val(1);
                $('#description' + timestamp).val(data.description);
                $('#total_item_price' + timestamp).html(data.sale_price);
            });
        }

        function addCustomer() {
           $('#btn-ajax-submit').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>' + ' saving');
            var data = $('#customer_create_form').serialize();
            axios.post('{{route('admin.users.ajax.store')}}', data)
                .then(function (response) {

                    if (response.data.status === 200) {
                        $('#customer_create_form').find("input[type=text], textarea").val("");
                        toastr.success("User has been created successfully ", 'User Registered')
                        
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
            
            // // $('.product_search_select').select2({
            // //     ajax: {
            // //         url: "{{route('admin.items.ajax.search')}}",
            // //         type: "get",
            // //         dataType: 'json',
            // //         delay: 250,
            // //         data: function (params) {
            // //             return {
            // //                 _token: CSRF_TOKEN,
            // //                 search: params.term // search term
            // //             };
            // //         },
            // //         processResults: function (response) {
            // //             return {
            // //                 results: response
            // //             };
            // //         },
            // //         cache: true
            // //     }

            // // });
            // $('.product_search_select').on('select2:select', function (e) {
            //     var data = e.params.data;
            //     $('#price').val(data.sale_price);
            //     $('#cost_price').val(data.cost_price);
            //     $('#qty').val(1);
            //     $('#description').val(data.description);
            //     $('#total_item_price').html(data.sale_price);
            // });

        });
        function calculateTotal() {
            var total = parseFloat($('#qty').val()) * parseFloat($('#price').val());
            $('#total_item_price').html(total);
            calculateGrandTotal();
        }
        function calculateTotalExtra(time) {
            var total = parseFloat($('#qty' + time).val()) * parseFloat($('#price' + time).val());
            $('#total_item_price' + time).html(total);
        }
        function removeItem($id) {
            $("#invoice_items" + $id).remove();
        }
    </script>
@endsection