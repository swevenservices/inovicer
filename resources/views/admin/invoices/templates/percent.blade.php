<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
<!--  This file has been downloaded from bootdey.com @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <title>YALLA WRAP IT -{{$invoice->customer_name}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
</head>
<body>

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

<div class="page-content container">


    <div  class="container p-0 m-0" style="width: 100%;">
        <div class="row mt-4">
            <div id="invoice" class="col-12 invoice" style="width: 100%;margin-left: -9px;">
                <style type="text/css">

                    .text-secondary-d1 {
                        color: #728299!important;
                    }
                    .page-header {
                        margin: 0 0 1rem;
                        padding-bottom: 1rem;
                        padding-top: .5rem;
                        border-bottom: 1px dotted #e2e2e2;
                        display: -ms-flexbox;
                        display: flex;
                        -ms-flex-pack: justify;
                        justify-content: space-between;
                        -ms-flex-align: center;
                        align-items: center;
                    }
                    .page-title {
                        padding: 0;
                        margin: 0;
                        font-size: 1.75rem;
                        font-weight: 300;
                    }
                    .brc-default-l1 {
                        border-color: #dce9f0!important;
                    }

                    .ml-n1, .mx-n1 {
                        margin-left: -.25rem!important;
                    }
                    .mr-n1, .mx-n1 {
                        margin-right: -.25rem!important;
                    }
                    .mb-4, .my-4 {
                        margin-bottom: 1.5rem!important;
                    }
                    .brc-default-l2{
                        background-color: aliceblue;
                    }
                    .bcr-1{
                       background-color: #afa3a32b;
                    }
                    hr {
                        margin-top: 0.5rem;
                        margin-bottom: 1rem;
                        border: 0;
                        border-top: 1px solid rgba(0,0,0,.1);
                    }

                    .text-grey-m2 {
                        color: white!important;
                    }

                    .text-success-m2 {
                        color: #86bd68!important;
                    }

                    .font-bolder, .text-600 {
                        font-weight: 600!important;
                    }

                    .text-110 {
                        font-size: 110%!important;
                    }
                    .text-blue {
                        color: #478fcc!important;
                    }
                    .pb-25, .py-25 {
                        padding-bottom: .75rem!important;
                    }

                    .pt-25, .py-25 {
                        padding-top: .75rem!important;
                    }
                    .bgc-default-tp1 {
                        background-color: rgba(121,169,197,.92)!important;
                    }
                    .bgc-default-l4, .bgc-h-default-l4:hover {
                        background-color: aliceblue!important;
                    }
                    .page-header .page-tools {
                        -ms-flex-item-align: end;
                        align-self: flex-end;
                    }

                    .btn-light {
                        color: #757984;
                        background-color: #f5f6f9;
                        border-color: #dddfe4;
                    }
                    .w-2 {
                        width: 1rem;
                    }

                    .text-120 {
                        font-size: 120%!important;
                    }
                    .text-primary-m1 {
                        color: #4087d4!important;
                    }

                    .text-danger-m1 {
                        color: #dd4949!important;
                    }
                    .text-blue-m2 {
                        color: #68a3d5!important;
                    }
                    .text-150 {
                        font-size: 150%!important;
                    }
                    .text-60 {
                        font-size: 60%!important;
                    }
                    .text-grey-m1 {
                        color: #7b7d81!important;
                    }
                    .align-bottom {
                        vertical-align: bottom!important;
                    }
                </style>
                <div class="row">
            @if($invoice->type =="invoice")
                         @if($invoice->admin_company =="yr")
                           <img style="width: 100%" src="{{asset('img/i_r.png')}}">
                          @else
                             <img style="width: 100%" src="{{asset('img/i_r.png')}}">
                           @endif
                        @endif
                     @if($invoice->type == "qoute")
                       @if($invoice->admin_company =="yr")
                         <img style="width: 100%" src="{{asset('img/q_r.png')}}">
                         @else
                          <img style="width: 100%" src="{{asset('img/q_r.png')}}">
                         @endif
                      @endif
                 @if($invoice->type == "receipt")
                      @if($invoice->admin_company =="yr")
                          <img style="width: 100%" src="{{asset('img/r.png')}}">
                            @else
                           <img style="width: 100%" src="{{asset('img/r.png')}}">
                       @endif
                @endif
               @if($invoice->type == "p_invoice")
                @if($invoice->admin_company =="yr")
               <img style="width: 100%" src="{{asset('img/p-r.png')}}">
               @else
                <img style="width: 100%" src="{{asset('img/p_i.png')}}">
               @endif
                @endif
                </div>
                <div class="row">
                   <div class="col-md-6">
                    <div class="row">
                    @if($invoice->type == "qoute")
                     <div class="col-sm-6 col-4 text-center" style="background-color: #df7626 ; height:120px">
                        <div class="mt-2">
                            <i class="fa fa-file-text-o fa-2x" style="color: white"></i>
                        </div>
                        <div class="text-grey-m2">
                            <div class="my-1">
                                QUOTATION NO #
                            </div>
                            <div class="my-1" style="font-size: 18px;">
                                {{$invoice->invoice_number}}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-4 text-center" style="background-color: #252968 ; height:120px">
                        <div class="mt-2">
                            <i class="fa fa-calendar fa-2x" style="color: white"></i>
                        </div>
                        <div class="text-grey-m2">
                            <div class="my-1">
                                QUOTATION DATE
                            </div>
                            <div class="my-1" style="font-size: 18px;">
                                {{$invoice->invoice_date}}
                            </div>
                        </div>
                    </div>
                    @if($invoice->purchase_order_number)
                    <div class="col-sm-12 col-4 text-center" style="background-color: #879aa1 ; height:120px">
                        <div class="mt-2">
                            <i class="fa fa-calendar fa-2x" style="color: white"></i>
                        </div>
                        <div class="text-grey-m2">
                            <div class="my-1">
                                PURCHASE ORDER
                            </div>
                            <div class="my-1" style="font-size: 18px;">
                                {{$invoice->purchase_order_number}}
                            </div>
                        </div>
                    </div>
                    @endif
                    @else
                    
                    
                    @if($invoice->type == "p_invoice")
                     <div class="col-sm-6 col-4 text-center" style="background-color: #df7626 ; height:120px">
                        <div class="mt-2">
                            <i class="fa fa-file-text-o fa-2x" style="color: white"></i>
                        </div>
                        <div class="text-grey-m2">
                            <div class="my-1">
                                QUOTATION NO #
                            </div>
                            <div class="my-1" style="font-size: 18px;">
                                {{$invoice->invoice_number}}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-4 text-center" style="background-color: #252968 ; height:120px">
                        <div class="mt-2">
                            <i class="fa fa-calendar fa-2x" style="color: white"></i>
                        </div>
                        <div class="text-grey-m2">
                            <div class="my-1">
                                QUOTATION DATE
                            </div>
                            <div class="my-1" style="font-size: 18px;">
                                {{$invoice->invoice_date}}
                            </div>
                        </div>
                    </div>
                    @if($invoice->purchase_order_number)
                    <div class="col-sm-12 col-4 text-center" style="background-color: #879aa1 ; height:120px">
                        <div class="mt-2">
                            <i class="fa fa-calendar fa-2x" style="color: white"></i>
                        </div>
                        <div class="text-grey-m2">
                            <div class="my-1">
                                PURCHASE ORDER
                            </div>
                            <div class="my-1" style="font-size: 18px;">
                                {{$invoice->purchase_order_number}}
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    @else
                    <div class="col-sm-6 col-4 text-center" style="background-color: #df7626 ; height:120px">
                        <div class="mt-2">
                            <i class="fa fa-file-text-o fa-2x" style="color: white"></i>
                        </div>
                        <div class="text-grey-m2">
                            <div class="my-1">
                                INVOICE NO #
                            </div>
                            <div class="my-1" style="font-size: 18px;">
                                {{$invoice->invoice_number}}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-4 text-center" style="background-color: #252968 ; height:120px">
                        <div class="mt-2">
                            <i class="fa fa-calendar fa-2x" style="color: white"></i>
                        </div>
                        <div class="text-grey-m2">
                            <div class="my-1">
                                INVOICE DATE
                            </div>
                            <div class="my-1" style="font-size: 18px;">
                                {{$invoice->invoice_date}}
                            </div>
                        </div>
                    </div>
                    @if($invoice->purchase_order_number)
                    <div class="col-sm-12 col-4 text-center" style="background-color: #879aa1 ; height:120px">
                        <div class="mt-2">
                            <i class="fa fa-calendar fa-2x" style="color: white"></i>
                        </div>
                        <div class="text-grey-m2">
                            <div class="my-1">
                                PURCHASE ORDER
                            </div>
                            <div class="my-1" style="font-size: 18px;">
                                {{$invoice->purchase_order_number}}
                            </div>
                        </div>
                    </div>
                    @endif
                    @endif
                    
                   @endif
                   </div>
                   </div>
                 <div class="col-sm-6 text-right" style="position: relative; right: 10px ">
                        <div>
                        </div>
                        <div class="text-grey-m2 mt-2">
                            <input disabled  style="margin-bottom: 5px;min-height: 33px;background-color: #80808021; width: 100%;border: none;text-align: center;font-size: 19px;" value="{{$invoice->customer_name}}">
                             <p disabled style="margin-bottom: 5px;padding:5px; min-height: 73px;color:black;background-color: #80808021; width: 100%;border: none;text-align: center;font-size: 17px;" >  {!! $customer->address !!}  </p>
                        </div>
                    </div>
                </div>
               <div class="row">
                    <div class="col-md-8 p-l-3 mt-3">
                        <p style="font-size:20px;color:#252968">{{ $invoice->attention}}</p>
                    </div>
                </div>
                <div class="mt-4 text-center">
                    <div class="row text-600 text-white " style="height: 40px">
                       <div class="col-1 col-sm-1" style="background-color: #252968;padding: 5px;"> S.N</div>
                        <div class="col-8 col-sm-6" style="background-color: #252968;padding: 10px;"> DESCRIPTION</div>
                         <div class="d-none d-sm-block col-sm-1" style="background-color: #df7626;padding: 10px;">QUANTITY</div>
                         <div class="d-none d-sm-block col-4 col-sm-2" style="background-color: #df7626;padding: 10px;">UNIT PRICE</div>
                         <div class="d-none d-sm-block col-4 col-sm-2" style="background-color: #df7626;padding: 10px;">TOTAL PRICE</div>
                         
                    
                    </div>
                    <div class="text-95 text-secondary-d3">
                        @php $total = 0 ;
                           $vat =0;
                           $discount = 0 ; 
                           $recieved = 0 ; 
                          $counter = 1;
                        @endphp
                        @if($invoice->invoiceInvoiceItems)
                        @foreach($invoice->invoiceInvoiceItems as $key => $item)
                            <div class="row mb-2 mb-sm-0 py-25 {{$counter % 2? 'bcr-1': 'brc-default-l2' }}">
                                <div class="col-1 col-sm-1">{{$key +1 }}</div>
                                <div class="col-8 col-sm-6">{{$item->name}}<br>
                                  {!! $item->description !!}
                                </div>
                                 <div class="d-none d-sm-block col-1">{{$item->qty}}</div>
                                <div class="d-none d-sm-block col-2">  @if($invoice->currency) {{$invoice->currency->symbol}} @endif 
                                {{ number_format( $item->total ,2)}}</div>
                                <div class="d-none d-sm-block col-2">  @if($invoice->currency) {{$invoice->currency->symbol}} @endif 
                                {{ number_format($item->qty* $item->total ,2)}}</div>
                            
                            </div>
                        @php
                        $total += $item->qty * $item->total;
                        $counter++; 
                        @endphp
                        
                        @endforeach
                        
                        @endif
                        
                        @if($invoice->vat)
                            @php $vat = ($invoice->vat/100) * $total; @endphp
                        @endif
                        
                        @if($invoice->discount)
                        @php 
                        if($invoice->discount_type == "fixed")
                        {
                        $discount = $invoice->discount;
                        }
                        else{
                        $discount = ($invoice->discount / 100) * $total;
                        }
                        @endphp
                        @endif

                    </div>
                    <div >
                       @if($invoice->notes) 
                       <p style="width: 90%;border: none; padding:10px;  font-size: 17px;  text-align: left; background: none; color: darkred;" >
                       Note * : {{$invoice->notes}}
                        </p>
                        @endif
                    </div>
                
                    <div class="row border-b-2 "></div>
                    <div class="row mt-3">
                        <div class="col-12 col-sm-7 text-grey-d2 text-95 mt-2 mt-lg-0">
                            <img style="width: 70%; text-align:left; float:left" src="{{asset('img/account.png')}}" >
                        </div>
                        <div class="col-12 col-sm-5 text-grey text-90 order-first order-sm-last">
                                @php $result =  round( (( $total - $discount  ) + $vat) ,2 ) @endphp
                              <div class="row ">
                                    <div class="col-6 text-left" style="color: #252968;">
                                        <b> Total   </b>
                                    </div>
                                     <div class="col-6" style="background-color: #df7626; color: white">
                                        <span class="text-120 ">  {{$invoice->currency ? $invoice->currency->symbol : ''}}    {{ number_format( $result , 2) }} </span>
                                    </div>
                                    <hr style="width: 100%"/>
                                </div>
                           
                            <div class="row my-2 align-items-center bgc-primary-l3 ">
                                <div class="col-7" style="background-color: #252968;padding: 10px; color: white">
                                    @if($invoice->type == "receipt")
                                      RECEIVED 
                                    @else
                                       AMOUNT DUE 
                                    @endif
                                 </div>
                                 <div class="col-5" style="background-color: #252968;padding: 10px; color: white">
                                 <span class=" text-success-d3 opacity-2"> @if($invoice->currency)
                                 {{ $invoice->currency->symbol}} 
                                 @endif 
                                    
                                    @if($invoice->percentage && $invoice->percentage > 0 )
                                    @php $percentage = $invoice->percentage/100  @endphp
                                        {{ number_format($percentage * $result , 2) }}
                                     @else
                                         {{ number_format($resulret/2 , 2) }}
                                     @endif
                                   </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                      @if($invoice->privacy_policy)
                         <div class="col-md-12" style="margin-top:20px;text-align:left">
                          {!!   $invoice->privacy_policy !!}
                      </div>
                     @endif
                     <div class="row">
                      <div class="col-md-6" style="margin-top:20px;font-size:20px;padding:7px;text-align:left; background-color:#252968 ;color:white ">
                         <p>THANK YOU FOR YOUR BUSINESS!</p>
                      </div>
                       <div class="col-md-6" style="margin-top:20px;font-size:20px;padding:7px;text-align:left; background-color:#d2d2d8 ;color:white ">
                       <p style="color:black">Signature</p>
                       </div>
                     
                      </div>
                     <div class="row mt-4">
                        <div class="col-md-2 p-3 mt-5">
                           <a style="color:#252968;  font-size:18px" href="tel:045686225"> 04 568 6225</a>
                      </div>
                        @if($invoice->admin_company =="yr")
                       <div class="col-md-3  p-3">
                           <img style="height: 50px; width:50px" src="{{asset('img/webqr.svg')}}"><br>
                            <a style="color:#252968; font-size:18px" href="www.yallarepairs.com"> www.yallarepairs.com</a>
                      </div>
                         <div class="col-md-3  p-3">
                             <img style="height: 50px; width:50px" src="{{asset('img/emailqr.svg')}}"><br>
                           <a style="color:#252968; font-size:18px" href="mailto:info@yallarepairs.com"> info@yallarepairs.com</a>
                      </div> 
                     
                      @else
                       <div class="col-md-3  p-3">
                           <img style="height: 50px; width:50px" src="{{asset('img/webqr.svg')}}"><br>
                            <a style="color:#252968; font-size:18px" href="www.yallawrapit.com"> www.yallawrapit.com</a>
                      </div>
                         <div class="col-md-3  p-3">
                             <img style="height: 50px; width:50px" src="{{asset('img/emailqr.svg')}}"><br>
                           <a style="color:#252968; font-size:18px" href="mailto:info@yallawrapit.com"> info@yallawrapit.com</a>
                      </div> 
                      @endif
                         <div class="col-md-4  p-3 ">
                             <h5>Yalla Repairs Building Maintenance LLC</h5>
                          <a style="color:#252968;margin-top:50px; font-size:14px" href="https://www.google.com/maps/place/Yalla+Wrap+It/@25.0988566,55.1773102,15z/data=!4m2!3m1!1s0x0:0x84afe7b4a8829177?sa=X&ved=2ahUKEwjp8eXruan1AhVKyYUKHbMiCIIQ_BJ6BAgoEAU"><i class="fa fa-map-marker"></i> 1201 Grossvenor Business Tower <br> Tecom, Dubai, United Arab Emirates</a>
                      </div>
                     </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Send Invoice</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('admin.invoices.sendMail')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="invoice_id" value="{{$invoice->id}}">
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Content Of Mail</label>
                        <textarea name="content" class="form-control" id="exampleFormControlTextarea1" rows="5"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Choose PDF </label>
                        <input  name="pdf_file" type="file" class="form-control-file" id="exampleFormControlFile1">
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

<script>
    function generatePDF() {
        const element = document.getElementById('invoice');
        html2pdf()
            .from(element)
            .save();
    }
</script>

<script>
    function printDiv() {
        var printContents, popupWin;
        printContents = document.getElementById('invoice').innerHTML;
        popupWin = window.open('', '_blank', 'top=0,left=0,height=100%,width=auto');
        popupWin.document.open();
        popupWin.document.write('<html><head><link rel="stylesheet"href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" crossorigin="anonymous"> <body  onload="window.print();window.close() ">' + printContents + '</body> </html>'
        );
        popupWin.document.close();
    }
</script>
</body>
</html>
