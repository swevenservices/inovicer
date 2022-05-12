@extends('layouts.admin')
@section('content')
    <div class="flex flex-wrap justify-between mb-4">
        <h3><i class="fa fa-users"></i> Show  User ({{$user->name}})  </h3>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.user.title') }}
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.users.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.id') }}
                                </th>
                                <td>
                                    {{ $user->id }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.name') }}
                                </th>
                                <td>
                                    {{ $user->name }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.email') }}
                                </th>
                                <td>
                                    {{ $user->email }}
                                </td>
                            </tr>

                            <tr>
                                <th>
                                    Mobile
                                </th>
                                <td>
                                    {{ $user->mobile }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.email_verified_at') }}
                                </th>
                                <td>
                                    {{ $user->email_verified_at }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.roles') }}
                                </th>
                                <td>
                                    @foreach($user->roles as $key => $roles)
                                        <span class="label label-info">{{ $roles->title }}</span>
                                    @endforeach
                                </td>
                            </tr>
                            </tbody>
                        </table>

                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.users.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">

            @php
                $totalInvoices = 0 ;
                $totalReceipts = 0 ;
                $totalSpent = 0 ;
                $totalProfit = 0 ;
                $totalPending = 0 ;
                $totalRecevied = 0 ;
                $totalMaterialCost = 0 ;
            @endphp
            @if($user->invoices)
                @foreach($user->invoices as $invoice)
                    @if($invoice->recepit )
                        @php
                            $totalPending +=  $invoice->recepit->pending;
                            $totalRecevied +=  $invoice->recepit->received;
                            $totalMaterialCost +=  $invoice->recepit->material;
                            $totalSpent += $invoice->recepit->total;
                            $totalProfit += $invoice->recepit->profit;
                            $totalReceipts++;
                        @endphp
                    @endif
                    @php $totalInvoices++;
                    @endphp
                @endforeach
            @endif
            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.user.title') }}
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 ">
                            <div class="card">
                                <div class="card-body p-3 d-flex align-items-center">
                                    <div class="bg-primary p-3 mfe-3">
                                        <i class="fa-fw fas fa-file-invoice-dollar fa-2x"></i>
                                    </div>
                                    <div>
                                        <div class="text-value text-primary">{{  $totalInvoices}}</div>
                                        <div class="text-muted text-uppercase font-weight-bold small">total invoices
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 ">
                            <div class="card">
                                <div class="card-body p-3 d-flex align-items-center">
                                    <div class="bg-primary p-3 mfe-3">
                                        <i class="fa-fw fas fa-file-invoice-dollar fa-2x"></i>
                                    </div>
                                    <div>
                                        <div class="text-value text-primary">{{  $totalReceipts}}</div>
                                        <div class="text-muted text-uppercase font-weight-bold small">total Payments
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 ">
                            <div class="card">
                                <div class="card-body p-3 d-flex align-items-center">
                                    <div class="bg-success p-3 mfe-3">
                                        <i class="fa-fw fas fa-file-invoice-dollar fa-2x"></i>
                                    </div>
                                    <div>
                                        <div class="text-value text-primary"> AED {{  $totalRecevied}}</div>
                                        <div class="text-muted text-uppercase font-weight-bold small">total Recevied
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 ">
                            <div class="card">
                                <div class="card-body p-3 d-flex align-items-center">
                                    <div class="bg-danger p-3 mfe-3">
                                        <i class="fa-fw fas fa-file-invoice-dollar fa-2x"></i>
                                    </div>
                                    <div>
                                        <div class="text-value text-primary"> AED {{  $totalPending}}</div>
                                        <div class="text-muted text-uppercase font-weight-bold small">total Pending
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 ">
                            <div class="card">
                                <div class="card-body p-3 d-flex align-items-center">
                                    <div class="bg-info p-3 mfe-3">
                                        <i class="fa-fw fas fa-file-invoice-dollar fa-2x"></i>
                                    </div>
                                    <div>
                                        <div class="text-value text-primary"> AED {{  $totalSpent}}</div>
                                        <div class="text-muted text-uppercase font-weight-bold small">Customer Spent
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 ">
                            <div class="card">
                                <div class="card-body p-3 d-flex align-items-center">
                                    <div class="bg-warning p-3 mfe-3">
                                        <i class="fa-fw fas fa-file-invoice-dollar fa-2x"></i>
                                    </div>
                                    <div>
                                        <div class="text-value text-primary"> AED {{  $totalMaterialCost}}</div>
                                        <div class="text-muted text-uppercase font-weight-bold small">We Spent
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 ">
                            <p>In total the customer purchased for <strong>AED {{$totalSpent}} </strong> we purchased items for <strong class="text-danger">AED {{$totalMaterialCost}}</strong> and we earned total of <strong class="text-success">AED {{$totalProfit}}  </strong></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Payments
                </div>
                <div class="card-body">
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
                        @foreach($user->invoices as $invoice)
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
                                    <td>
                                        @can('receipt_show')
                                            <a class="btn btn-xs btn-primary"
                                               href="{{ route('admin.receipts.show', $invoice->recepit->id) }}">
                                                {{ trans('global.view') }}
                                            </a>
                                        @endcan
                                        @can('receipt_edit')
                                            <a class="btn btn-xs btn-info"
                                               href="{{ route('admin.receipts.edit', $invoice->recepit->id) }}">
                                                {{ trans('global.edit') }}
                                            </a>
                                        @endcan

                                    </td>

                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Invoices
                </div>
                <div class="card-body">
                    <table class="table table-responsive-sm  ajaxTable datatable datatable-Invoice">
                        <thead>
                        <tr>
                            <th>
                                {{ trans('cruds.invoice.fields.invoice_number') }}
                            </th>
                            <th>
                                Invoice Date
                            </th>
                            <th>
                                {{ trans('cruds.invoice.fields.company') }}
                            </th>
                            <th>
                                {{ trans('cruds.invoice.fields.total') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($user->invoices as $invoice)
                            <tr>
                                <td>{{$invoice->invoice_number}} </td>
                                <td>{{$invoice->invoice_date}}</td>
                                <td>{{$invoice->company}}</td>
                                <td>AED {{$invoice->total}}</td>
                                <td>
                                    <a href="{{route('admin.invoices.show', $invoice->id)}}"
                                       class="btn btn-sm btn-primary">View </a>
                                    <a href="{{route('admin.invoices.edit', $invoice->id)}}"
                                       class="btn btn-sm btn-info">edit </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection