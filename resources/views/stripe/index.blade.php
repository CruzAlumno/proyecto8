<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="theme-color" content="#000000"/>
    <meta name="description" content="Testing Laravel Cashier"/>
    <meta name="keywords" content="HTML5, CSS, JavaScript, Laravel, Cashier"/>
    <meta name="author" content="KavX"/>
    <title>Stripe Laravel</title>
    <!-- BS4 Dependencyes -->
    <link rel="stylesheet" type="text/css" href="/assets/BS4/bootstrap.min.css"/>
    <!-- Stripe STYLE -->
    <style>
        .StripeElement {
            background-color: white;
            padding: 8px 12px;
            border-radius: 4px;
            border: 1px solid transparent;
            box-shadow: 0 1px 3px 0 #e6ebf1;
            -webkit-transition: box-shadow 150ms ease;
            transition: box-shadow 150ms ease;
        }
        .StripeElement--focus {
            box-shadow: 0 1px 3px 0 #cfd7df;
        }
        .StripeElement--invalid {
            border-color: #fa755a;
        }
        .StripeElement--webkit-autofill {
            background-color: #fefde5 !important;
        }
    </style>
</head>
<body>
    <main>
        <header class="container text-center mt-5">
            <h1>Stripe Payment</h1>
        </header>
        <form class="text-center" action="/payments/checkout" method="POST">
            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
            <button class="btn btn-lg btn-primary btn-block mt-3" type="submit">Checkout</button>
        </form>
    </main>
    <noscript>Sorry, your browser does not support JavaScript!</noscript>
    <!-- BS4 JQUery & Popper.js -->
    <script src="/assets/BS4/popper.min.js"></script>
</body>
</html>

