@extends('layouts.admin')
@section('content')
    <div class="flex flex-wrap justify-between mb-4">
        <h3><i class="fa-fw fas fa-file-invoice-dollar"></i>
            {{ trans('global.view') }}
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
                        <input disabled class="form-control {{ $errors->has('invoice_number') ? 'is-invalid' : '' }}"
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
                        <input disabled class="form-control date {{ $errors->has('invoice_date') ? 'is-invalid' : '' }}"
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
                        <input disabled class="form-control {{ $errors->has('due_date') ? 'is-invalid' : '' }}" type="text"
                               name="due_date" id="due_date" value="{{ old('due_date', $invoice->due_date) }}">
                        @if($errors->has('due_date'))
                            <div class="invalid-feedback">
                                {{ $errors->first('due_date') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.invoice.fields.due_date_helper') }}</span>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="customer_name">{{ trans('cruds.invoice.fields.customer_name') }}</label>
                        <input disabled class="form-control {{ $errors->has('customer_name') ? 'is-invalid' : '' }}"
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
                        <input disabled class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                               type="text" name="email" id="customer_name"
                               value="{{ old('email', $invoice->email) }}">
                        @if($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
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
                        <input  class="form-control {{ $errors->has('company') ? 'is-invalid' : '' }}" type="text"
                               name="company" disabled id="company" value="{{ old('company', $invoice->company) }}">
                        @if($errors->has('company'))
                            <div class="invalid-feedback">
                                {{ $errors->first('company') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.invoice.fields.company_helper') }}</span>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="complete_address">{{ trans('cruds.invoice.fields.complete_address') }}</label>
                        <textarea disabled rows="1"
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
        </div>
        <div class="card">
            <div class="card-header">
                <h5> Items </h5>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <div class="row">
                        <div class="form-group col-md-12 " id="items_container">
                            @foreach($invoice->invoiceInvoiceItems as $item)
                                <div id="invoice_items{{$item->id}}" class="row">
                                    <div class="form-group col-md-3 ">
                                        <label for="name">{{ trans('cruds.invoiceItem.fields.name') }}</label>
                                        <input disabled class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                               type="text" name="item_name[]" id="name" value="{{$item->name}}">
                                        @if($errors->has('name'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('name') }}
                                            </div>
                                        @endif
                                        <span class="help-block">{{ trans('cruds.invoiceItem.fields.name_helper') }}</span>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="description">{{ trans('cruds.invoiceItem.fields.description') }}</label>
                                        <input disabled value="{{$item->description}}"
                                               class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                                               type="text" name="item_description[]" id="description">
                                        @if($errors->has('description'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('description') }}
                                            </div>
                                        @endif
                                        <span class="help-block">{{ trans('cruds.invoiceItem.fields.description_helper') }}</span>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="qty">{{ trans('cruds.invoiceItem.fields.qty') }}</label>
                                        <input disabled class="form-control {{ $errors->has('qty') ? 'is-invalid' : '' }}"
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
                                    <div class="form-group col-md-2">
                                        <label for="qty">Unit Price</label>
                                        <input disabled class="form-control {{ $errors->has('qty') ? 'is-invalid' : '' }}"
                                               type="text" name="item_price[]"
                                               onkeyup="calculateTotalExtra({{$item->id}})" id="price{{$item->id}}"
                                               value="{{ $item->total  }}"
                                               step="1">
                                        <input disabled class="form-control " type="hidden"  value="{{$item->cost_price}}" name="cost_price[]" id="cost_price" step="1">
                                        @if($errors->has('qty'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('qty') }}
                                            </div>
                                        @endif
                                        <span class="help-block">{{ trans('cruds.invoiceItem.fields.qty_helper') }}</span>
                                    </div>
                                    <div class="form-group col-md-2">
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
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5> Payments </h5>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                            <table class=" table  datatable datatable-Receipt">
                                <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.receipt.fields.invoice') }}
                                    </th>
                                    <th>
                                        Pending
                                    </th>
                                    <th>
                                        Received
                                    </th>
                                    <th>
                                        Material Cost
                                    </th>
                                    <th>
                                        Total
                                    </th>
                                    <th>
                                        Profit
                                    </th>

                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                    @if($invoice->recepit)
                                        <tr data-entry-id="{{ $invoice->recepit->id }}">
                                            <td>
                                                {{ $invoice->invoice_number ?? '' }}
                                            </td>
                                            <td>
                                                <label class="badge badge-danger">
                                                    AED {{ $invoice->recepit->pending ?? '' }}</label>
                                            </td>
                                            <td>
                                                <label class="badge badge-success">
                                                    AED {{ $invoice->recepit->received ?? 0 }}</label>
                                            </td>
                                            <td>
                                                <label class="badge badge-info">
                                                    AED {{ $invoice->recepit->material ?? 0 }}</label>
                                            </td>
                                            <td>
                                                <label class="badge badge-warning">
                                                    AED {{ $invoice->recepit->total ?? '' }}</label>
                                            </td>
                                            <td>
                                                <label class="badge badge-success">
                                                    AED {{ $invoice->recepit->profit ?? '' }}</label>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                  </div>
                 </div>
            </div>


        <div class="row">
            <div class="col-md-4">
                <div class="form-group col-md-12">
                    <label for="currency_id">{{ trans('cruds.invoice.fields.currency') }}</label>
                   <input disabled value="{{$invoice->currency->symbol}}" class="form-control">
                </div>
                <div class="form-group col-md-12">
                    <label for="currency_id">Invoice type</label>
                    <select disabled class="form-control select2 " name="type" id="type">
                        <option value="qoute" {{$invoice->type =='qoute' ? 'selected' : ''}} >Qoute</option>
                        <option value="invoice" {{$invoice->type =='invoice' ? 'selected' : ''}} > Invoice
                        </option>
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
                    <select disabled class="form-control select2 " name="template_type" id="template_type">
                        <option value="default" {{$invoice->type =='default' ? 'selected' : ''}} >Default</option>
                        <option value="clean" {{$invoice->type =='clean' ? 'selected' : ''}} > Clean</option>
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
                    <select disabled class="form-control select2 " name="payment_type" id="payment_type">
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
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5> Payments</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="discount">{{ trans('cruds.invoice.fields.discount') }} (%)</label>
                                <input disabled class="form-control {{ $errors->has('discount') ? 'is-invalid' : '' }}"
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
                                <input disabled class="form-control {{ $errors->has('vat') ? 'is-invalid' : '' }}" type="number"
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
                                            disabled
                                            name="is_received" type="checkbox"
                                            class="switch-input" checked> </label>
                                <input disabled class="form-control {{ $errors->has('received') ? 'is-invalid' : '' }}"
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
                                <input disabled class="form-control {{ $errors->has('total') ? 'is-invalid' : '' }}"
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
                                <input disabled name="is_expensed" type="checkbox" class="switch-input" checked>
                            </div>
                            <div class="form-group col-md-6 ">
                                <label> Add to Incomes</label>
                                <input disabled name="is_incomed" type="checkbox" class="switch-input" checked
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group col-md-12">
            <button class="btn btn-success" type="submit">
                <i class="fa fa-save "></i> Save
            </button>
            <h5 class="text-success text-right"> Received
                : {{$invoice->currency ?$invoice->currency->symbol : ''}} {{$invoice->recepit->received}}  </h5>
            <h5 class="text-danger text-right"> Dues
                : {{$invoice->currency ? $invoice->currency->symbol :''}} {{$invoice->recepit->pending}}  </h5>
        </div>
    </form>

@endsection
@section('scripts')

@endsection
