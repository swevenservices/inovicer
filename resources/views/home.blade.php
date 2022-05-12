@extends('layouts.admin')
@section('content')
    <div class="flex flex-wrap justify-between mb-4">
        <h3><i class="fa fa-users"></i>
            Welcome , {{Auth()->user()->name}}
        </h3>
    </div>
    <div class="content">
        <div class="row">
            @if(session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="col-6 col-lg-3">
                <div class="card">
                    <div class="card-body p-3 d-flex align-items-center">
                        <div class="bg-primary p-3 mfe-3">
                            <i class="fa-fw fas fa-file-invoice-dollar fa-2x"></i>
                        </div>
                        <div>
                            <div class="text-value text-primary">{{ number_format($settings1['total_number']) }}</div>
                            <div class="text-muted text-uppercase font-weight-bold small">{{ $settings1['chart_title'] }}</div>
                        </div>
                    </div>
                    <div class="card-footer px-3 py-2">
                        <a class="btn-block text-muted d-flex justify-content-between align-items-center"
                           href="{{route('admin.invoices.index')}}"><span
                                    class="small font-weight-bold">View Invoices</span>
                            <i class="fa fa-angle-right"></i>
                        </a>
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
                            <div class="text-value text-primary">{{ number_format($settings2['total_number']) }}</div>
                            <div class="text-muted text-uppercase font-weight-bold small">Total Sale</div>
                        </div>
                    </div>
                    <div class="card-footer px-3 py-2">
                        <a class="btn-block text-muted d-flex justify-content-between align-items-center"
                           href="{{route('admin.receipts.index')}}"><span
                                    class="small font-weight-bold">View Payments</span>
                            <i class="fa fa-angle-right"></i>
                        </a>
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
                            <div class="text-value text-primary">{{ number_format($settings3['total_number']) }}</div>
                            <div class="text-muted text-uppercase font-weight-bold small">{{ $settings3['chart_title'] }}</div>
                        </div>
                    </div>
                    <div class="card-footer px-3 py-2">
                        <a class="btn-block text-muted d-flex justify-content-between align-items-center"
                           href="{{route('admin.receipts.index')}}"><span
                                    class="small font-weight-bold">View Payments</span>
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-6 col-lg-3">
                <div class="card">
                    <div class="card-body p-3 d-flex align-items-center">
                        <div class="bg-primary p-3 mfe-3">
                            <i class="fa fa-shopping-cart fa-2x"></i>
                        </div>
                        <div>
                            <div class="text-value text-primary">{{ number_format($settings4['total_number']) }}</div>
                            <div class="text-muted text-uppercase font-weight-bold small">{{ $settings4['chart_title'] }}</div>
                        </div>
                    </div>
                    <div class="card-footer px-3 py-2">
                        <a class="btn-block text-muted d-flex justify-content-between align-items-center"
                           href="{{route('admin.invoices.index')}}"><span
                                    class="small font-weight-bold">View Invoices</span>
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                </div>
            </div>


            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                            <h3>Income (this year)</h3>
                            {!! $chart5->renderHtml() !!}
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">

                            <h3>Pending (this year)</h3>
                            {!! $chart7->renderHtml() !!}
                    </div>
                </div>
            </div>

            </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>{!! $chart5->renderJs() !!}{!! $chart7->renderJs() !!}
@endsection