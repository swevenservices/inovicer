@extends('layouts.admin')
@section('content')
    <div class="flex flex-wrap justify-between mb-4">
        <h3><i class="fa-fw fas fa-file-invoice c-sidebar-nav-icon"></i>
            All Payments </h3>
    </div>


    <div class="row">

        @php
            $totalInvoices = 0 ;
            $totalReceipts = 0 ;
            $totalSpent = 0 ;
            $totalProfit = 0 ;
            $totalPending = 0 ;
            $totalRecevied = 0 ;
            $totalMaterialCost = 0 ;
        @endphp
        @foreach($receipts as $key => $receipt)
            @php
                $totalPending +=  $receipt->pending;
                $totalRecevied +=  $receipt->received;
                $totalMaterialCost +=  $receipt->material;
                $totalSpent += $receipt->total;
                $totalProfit += $receipt->profit;
                $totalReceipts++;
            @endphp
        @endforeach

        <div class="col-6 col-lg-3">
            <div class="card">
                <div class="card-body p-3 d-flex align-items-center">
                    <div class="bg-danger p-3 mfe-3">
                        <i class="fa-fw fas fa-file-invoice-dollar fa-2x"></i>
                    </div>
                    <div>
                        <div class="text-value text-primary">{{ number_format($totalPending)}} AED</div>
                        <div class="text-muted text-uppercase font-weight-bold small">Total Pending</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="card">
                <div class="card-body p-3 d-flex align-items-center">
                    <div class="bg-success p-3 mfe-3">
                        <i class="fa-fw fas fa-dollar-sign fa-2x"></i>
                    </div>
                    <div>
                        <div class="text-value text-primary">{{ number_format($totalRecevied) }} AED</div>
                        <div class="text-muted text-uppercase font-weight-bold small">Total Received</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="card">
                <div class="card-body p-3 d-flex align-items-center">
                    <div class="bg-danger p-3 mfe-3">
                        <i class="fas fa-percentage fa-2x"></i>
                    </div>
                    <div>
                        <div class="text-value text-primary">{{ number_format($totalMaterialCost) }} AED</div>
                        <div class="text-muted text-uppercase font-weight-bold small">Material Cost</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="card">
                <div class="card-body p-3 d-flex align-items-center">
                    <div class="bg-info p-3 mfe-3">
                        <i class="fa fa-shopping-cart fa-2x"></i>
                    </div>
                    <div>
                        <div class="text-value text-primary">{{ number_format($totalProfit) }} AED</div>
                        <div class="text-muted text-uppercase font-weight-bold small">Total Profit</div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table  datatable datatable-Receipt">
                            <thead>
                            <tr>
                                <th>

                                </th>
                                <th>
                                    {{ trans('cruds.receipt.fields.invoice') }}
                                </th>
                                <th>
                                    Customer
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

                            @foreach($receipts as $key => $receipt)
                                <tr data-entry-id="{{ $receipt->id }}">
                                    <td>

                                    </td>
                                    <td>
                                        {{ $receipt->invoice->invoice_number ?? '' }}
                                    </td>
                                    <td>
                                        @if($receipt->invoice)
                                            <a href="{{$receipt->invoice->user_id ? route('admin.users.show' , $receipt->invoice->user_id) : '#' }}"> {{ $receipt->invoice->customer_name ?? '' }}</a>
                                        @endif
                                    </td>
                                    <td>
                                        <label class="badge badge-danger text-right"> AED {{ $receipt->pending ?? 0 }}</label>
                                    </td>
                                    <td>
                                        <label class="badge badge-success"> AED {{ $receipt->received ?? 0 }}</label>
                                    </td>
                                    <td>
                                        <label class="badge badge-info text-center"> AED {{ $receipt->material ?? 0 }}</label>
                                    </td>
                                    <td>
                                        <label class="badge badge-warning"> AED {{ $receipt->total ?? 0 }}</label>
                                    </td>
                                    <td>
                                        <label class="badge badge-success"> AED {{ $receipt->profit ?? 0 }}</label>
                                    </td>
                                    <td>
                                        @can('receipt_show')
                                            <a class="btn btn-xs btn-primary"
                                               href="{{ route('admin.receipts.show', $receipt->id) }}">
                                                {{ trans('global.view') }}
                                            </a>
                                        @endcan
                                        @can('receipt_edit')
                                            <a class="btn btn-xs btn-info"
                                               href="{{ route('admin.receipts.edit', $receipt->id) }}">
                                                {{ trans('global.edit') }}
                                            </a>
                                        @endcan

                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    @parent
    <script>
        $(function () {
       let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
       $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [[1, 'desc']],
                pageLength: 100,
            });
            let table = $('.datatable-Receipt:not(.ajaxTable)').DataTable({buttons: dtButtons})
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function (e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })

    </script>
@endsection