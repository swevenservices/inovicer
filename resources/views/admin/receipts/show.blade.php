@extends('layouts.admin')
@section('content')
    <div class="flex flex-wrap justify-between mb-4">
        <h3><i class="fa-fw fas fa-file-invoice-dollar"></i>
            View
            Receipts
            <div class="action-buttons text-right" style="float: right;">
                <button onclick="printDiv()"  class="btn bg-white btn-light mx-1px text-95" href="#" data-title="Print">
                    <i class="mr-1 fa fa-print text-primary-m1 text-120 w-2"></i>
                    Print
                </button>
                <button onclick="generatePDF()" class="btn bg-white btn-light mx-1px text-95" href="#" data-title="PDF">
                    <i class="mr-1 fa fa-file-pdf-o text-danger-m1 text-120 w-2"></i>
                    Export
                </button>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-paper-plane"></i>  Send Mail </button>
            </div>
        </h3>
    </div>

    <div class="row">

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.receipt.title') }}
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <table class="table table-bordered table-striped">
                            <tbody>
                            <tr>
                                <th>
                                    {{ trans('cruds.receipt.fields.id') }}
                                </th>
                                <td>
                                    {{ $receipt->id }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.receipt.fields.invoice') }}
                                </th>
                                <td>
                                    {{ $receipt->invoice->invoice_number ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.receipt.fields.received') }}
                                </th>
                                <td>
                                    {{ $receipt->received }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.receipt.fields.pending') }}
                                </th>
                                <td>
                                    {{ $receipt->pending }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.receipt.fields.pending') }}
                                </th>
                                <td>
                                    {{ $receipt->material }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.receipt.fields.pending') }}
                                </th>
                                <td>
                                    {{ $receipt->total }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.receipt.fields.pending') }}
                                </th>
                                <td>
                                    {{ $receipt->profit }}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.receipts.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">

                    <style>
                        h1 {
                            color: #88B04B;
                            font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
                            font-weight: 900;
                            font-size: 40px;
                            margin-bottom: 10px;
                        }
                        p {
                            color: #404F5E;
                            font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
                            font-size: 16px;
                            margin-bottom: 10px;
                        }
                        .checkmark {
                            color: #9ABC66;
                            font-size: 70px;
                            line-height: 70px;
                            position: relative;
                            left: 20px;
                        }
                    </style>
                    <div id="receipt" style="padding: 20px" class="receipt card">
                       <div style="border-radius:100px; height:100px; width:100px; background: #F8FAF5; margin:0 auto;">
                            <span class="checkmark">✓</span>
                        </div>
                        <h1>Payment Received</h1>
                        <div class="number">
                            <h3>Hi , {{$receipt->invoice->customer_name}}</h3>
                            <div class="date" style="text-align: right">Invoice Number # <b>{{$receipt->invoice->invoice_number}}</b></div>
                            <br>
                            <div class="date">Dated: {{$receipt->invoice->invoice_date}}</div>
                            <br>
                            @if($receipt->invoice->due_date)
                                <div class="ref">Due Date : {{$receipt->invoice->due_date}}</div>
                            @endif
                        </div>
                        <br>
                        <hr>
                        <p>We have received a total payment of : <b>AED {{$receipt->received}}  </b></p>
                        <p> Pending payment is : <b>AED {{$receipt->pending}}</b></p>
                        <p class="mt-3">Thanks & Regards, <img style="width: 230px; padding-bottom: 20px; text-align: right" src="{{asset('img/company_logo.png')}}">
                        </p>
                    </div>
        </div>


    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">SEND EMAIL RECEIPT</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('admin.receipts.sendMail')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="recepit_id" value="{{$receipt->id}}">
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Content Of Mail</label>
                            <textarea name="content" class="form-control" id="exampleFormControlTextarea1"
                                      rows="5"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Send mail</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
    <script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
    <script>
        function generatePDF() {
            var HTML_Width = $(".receipt").width();
            var HTML_Height = $(".receipt").height();
            var top_left_margin = 15;
            var PDF_Width = HTML_Width + (top_left_margin * 2);
            var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
            var canvas_image_width = HTML_Width;
            var canvas_image_height = HTML_Height;

            var totalPDFPages = Math.ceil(HTML_Height / HTML_Height) - 1;

            html2canvas($(".receipt")[0]).then(function (canvas) {
                var imgData = canvas.toDataURL("image/jpeg", 1.0);
                var pdf = new jsPDF('p', 'pt', [PDF_Width, HTML_Height+100]);
                pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
                for (var i = 1; i <= totalPDFPages; i++) {
                    pdf.addPage(PDF_Width, HTML_Height);
                    pdf.addImage(imgData, 'JPG', top_left_margin, -(HTML_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
                }
                pdf.save("{{$receipt->invoice->customer_name}}{{rand(99,999)}}.pdf");
                $(".html-content").hide();
                console.log(btoa(pdf.output()) );
            });
        }
    </script>

    <script>
        function printDiv() {
            var printContents, popupWin;
            printContents = document.getElementById('receipt').innerHTML;
            popupWin = window.open('', '_blank', 'top=0,left=0,height=100%,width=auto');
            popupWin.document.open();
            popupWin.document.write('<html><head><link rel="stylesheet"href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" crossorigin="anonymous"> <body  onload="window.print();window.close() ">' + printContents + '</body> </html>'
            );
            popupWin.document.close();
        }
    </script>
@endsection