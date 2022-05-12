@extends('layouts.admin')
@section('content')
    <div class="flex flex-wrap justify-between mb-4">
        <h3><i class="fa-fw fas fa-file-invoice-dollar"></i>
            View
            {{ trans('cruds.invoice.title_singular') }}
            <div class="action-buttons">
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
   
     @if($invoice->show_fifty =="yes")
        @include('admin.invoices.templates.percent')
        @else
         @include('admin.invoices.templates.default')
    @endif
      
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
    <script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
    <script>
        function generatePDF() {
            var HTML_Width = $(".invoice").width();
            var HTML_Height = $(".invoice").height();
            var top_left_margin = 15;
            var PDF_Width = HTML_Width + (top_left_margin * 2);
            var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
            var canvas_image_width = HTML_Width;
            var canvas_image_height = HTML_Height;

            var totalPDFPages = Math.ceil(HTML_Height / HTML_Height) - 1;

            html2canvas($(".invoice")[0]).then(function (canvas) {
                var imgData = canvas.toDataURL("image/jpeg", 1.0);
                var pdf = new jsPDF('p', 'pt', [PDF_Width, HTML_Height+100]);
                pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
                for (var i = 1; i <= totalPDFPages; i++) {
                    pdf.addPage(PDF_Width, HTML_Height);
                    pdf.addImage(imgData, 'JPG', top_left_margin, -(HTML_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
                }
                pdf.save("{{$invoice->customer_name}}.pdf");
                $(".html-content").hide();
                console.log(btoa(pdf.output()) );
            });
        }
    </script>
    <script>
        function printDiv() {
            var printContents, popupWin;
            printContents = document.getElementById('invoice').innerHTML;
            popupWin = window.open('', '_blank', 'top=0,left=0,height=100%,width=auto');
            popupWin.document.open();
            popupWin.document.write('<html><head><link rel="stylesheet"href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" crossorigin="anonymous"> <body  onload="window.print();window.close() ">' + printContents + '</body> </html>'
            );
            popupWin.document.close();
        }
    </script>
@endsection
