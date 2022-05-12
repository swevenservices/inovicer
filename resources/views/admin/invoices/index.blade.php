@extends('layouts.admin')
@section('content')

    <div class="flex flex-wrap justify-between mb-4">
        <h3><i class="fa-fw fas fa-file-invoice-dollar"></i>
            All Invoices
            <div class="text-right">

                <a class="btn btn-success" href="{{ route('admin.invoices.create') }}">
                    <i class="fa fa-plus"></i> {{ trans('global.add') }} {{ trans('cruds.invoice.title_singular') }}
                </a>
                <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                    <i class="fas fa-file-import"> </i>  {{ trans('global.app_csvImport') }}
                </button>
                @include('csvImport.modal', ['model' => 'Invoice', 'route' => 'admin.invoices.parseCsvImport'])
            </div>
        </h3>
    </div>

<div class="card">
    <div class="card-header">
        {{ trans('cruds.invoice.title_singular') }} {{ trans('global.list') }}
         <span class="text-right float-right">{{$invoices->links('pagination::bootstrap-4')}}</span> 
    </div>
    <div class="card-body">
        <table class="table table-responsive-sm  ajaxTable datatable datatable-Invoice">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>
                        {{ trans('cruds.invoice.fields.invoice_number') }}
                    </th>
                    <th>
                        {{ trans('cruds.invoice.fields.customer_name') }}
                    </th>
                    <th>Type</th>
                    <th>
                        {{ trans('cruds.invoice.fields.total') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
                <tbody>
                    @foreach($invoices as $invoice)
                    <tr @if($invoice->cloned_at != null) style="background:#5851d814" @endif >
                          <td> {{ $invoice->created_at->format('d-M-Y')}}</td> 
                          <td> {{ $invoice->invoice_number}}</td> 
                          <td> {{ $invoice->customer_name}}</td> 
                          <td> {{ $invoice->type }} </td>
                          <td> {{ number_format($invoice->total)}} AED</td>
                           <td>
                           <a href="{{ route('admin.invoices.edit', $invoice->id) }}" class="btn btn-xs btn-info">
                                Edit
                            </a>
                           <a href="{{ route('admin.invoices.detail.invoice', $invoice->id) }}" class="btn btn-xs btn-warning"> Print </a>
                           <a href="{{ route('admin.invoices.clone', $invoice->id) }}" class="btn btn-xs btn-dark">
                               Clone
                           </a>
                           </td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </thead>
        </table>
    </div>
      {{$invoices->links('pagination::bootstrap-4')}}
</div>

@endsection
@section('scripts')
@parent

@endsection