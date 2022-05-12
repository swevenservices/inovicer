<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /*
     * Reference - https://codepen.io/mmadeira/pen/wWzrwd
     */

        /* basic */
        *,
        *:before,
        *:after {
            box-sizing: border-box;
        }

        html,
        body {
            height: 100%;
        }

        body {
            font: 16px/1.2 "Roboto", sans-serif;
            color: #333;
        }


        svg,
        img {
            display: block;
        }


        /* container */
        .container {
            width: 100%;
            height: auto;
            border-radius: 5px;
            position: relative;
            top: 5%;
            z-index: 1;
        }

        /* receipt_box */
        .receipt_box > * {
            padding: 16px 32px;
        }

        /* head */
        .head {
            display: flex;
            align-items: center;
        }

        .head .logo {
            flex: 1 0 30%;
        }

        .head .number {
            flex: 1 0 70%;
            color: slategray;
            font-size: 14px;
            line-height: 1.6;
        }

        /* body */
        .body .info {
            margin-bottom: 24px;
            position: relative;
        }

        .body .info:before {
            content: "";
            display: block;
            width: 5px;
            height: 100%;
            position: absolute;
            top: 0;
            left: -32px;
        }

        .body .info .welcome {
            margin-bottom: 8px;
            font-weight: bold;
        }

        .body .info p {
            color: #555555;
            font-size: 14px;
        }

        .cart .title {
            margin-bottom: 16px;
            font-size: 20px;
            font-weight: bold;
            text-align: center;
            text-transform: capitalize;
        }

        .cart .title:after {
            content: ":";
            display: inline-block;
            margin-left: 4px;
            margin-right: 4px;
        }

        .cart .content {
            font-size: 14px;
        }

        .cart_list {
            color: dimgray;
        }

        .cart_list .cart_item {
            display: flex;
            padding: 12px 0;
        }

        .cart_list .cart_item + .cart_item {
            border-top: 2px dashed #ccc;
        }

        .cart_list .cart_item .index {
            margin-right: 8px;
            width: 18px;
            overflow: hidden;
        }

        .cart_list .cart_item .name {
            flex-grow: 1;
        }

        .cart_list .cart_item .price {
            color: crimson;
            font-weight: bold;
        }

        .cart .total {
            padding: 12px 0;
            font-weight: bold;
            text-transform: uppercase;
            border-top: 2px solid darkorange;
        }

        .cart .total_price {
            float: right;
            color: crimson;
        }


    </style>

</head>

<body>
<!-- 	<div class="blog">Visit <a href="#" target="_blank">My Blog</a></div> -->
<div class="container">
    <div class="receipt_box">
        <div class="head">
            <div class="logo">
                <img style="width: 80%" src="https://yallawrapit.com/front-end/img/logo.png">
            </div>
            <div class="number">
                <div class="date">Dated: {{$invoice->created_at}}</div>
                <div class="date">Invoice Number: {{$invoice->invoice_number}}</div>
                @if( $invoice->due_date)
                    <div class="ref">DUE : {{$invoice->due_date}}</div>
                @endif
            </div>
        </div>
        <div class="body">
            <div class="info">
                <div class="welcome">Hi, <span class="username">{{$invoice->customer_name}}</span></div>
                <p>Hope you are well,</p>
                <p>You've purchased {{$invoice->invoiceInvoiceItems->count()}} items from YALLAWRAPIT</p>
                <p>Please find the pdf file attached for complete details.</p>
                <p>{{$request->content}}</p>
                <p>Thanks & Regards,</p>
            </div>
            <div class="cart">
                <div class="content">
                    <div class="total">
                        <span>Total</span>
                        <span class="total_price">{{$invoice->currency->symbol}}  {{$invoice->total}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>