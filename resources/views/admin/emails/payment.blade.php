<html>
<head>
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,900&display=swap" rel="stylesheet">
</head>
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
<body>
<div class="card">
    <div style="border-radius:100px; height:100px; width:100px; background: #F8FAF5; margin:0 auto;">
        <span class="checkmark">✓</span>
    </div>
    <h1>Payment Received</h1>
    <div class="number">
        <h3>Hi , {{$invoice->customer_name}}</h3>
        <div class="date text-right">Dated: {{$invoice->invoice_date}}</div>
        <br>
        <div class="date">Invoice Number: <b>{{$invoice->invoice_number}}</b></div>
        <br>
        @if( $invoice->due_date)
            <div class="ref">Due Date : {{$invoice->due_date}}</div>
        @endif
    </div>
    <br>
    <p>{{$request->content}}</p>
    <hr>
    <p>We have received a total payment of <b>AED {{$invoice->recepit->received}}</b></p>
    <p> Pending payment is <b> AED {{$invoice->recepit->pending}}</b></p>
    <p class="mt-3">Thanks & Regards,</p>
    <p><img style="width: 230px; padding-bottom: 20px; text-align: right" src="{{asset('img/company_logo.png')}}"></p>
</div>
</body>
</html>