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
            <h1>Cashier Payment</h1>
        </header>
        <!-- Stripe FORM  ¿Integrar en React? -->
        <div class="container w-50 p-4 bg-light rounded shadow border border-light">
            <form action="{{ route('single.charge') }}" method="POST" id="subscribe-form">
                <input placeholder="Card Holder Name" id="card-holder-name" type="text" class="form-control w-50 mb-2">
                <input placeholder="amount" type="number" name="amount" id="amount" class="form-control w-25 mb-2"/>
                @csrf
                <div class="form-row">
                    <label for="card-element">Credit or debit card</label>
                    <div id="card-element" class="form-control"></div>        <!-- Used to display form errors. -->
                    <div id="card-errors" role="alert"></div>
                </div>
                <div class="stripe-errors"></div>
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        {{ $error }}<br>
                        @endforeach
                    </div>
                @endif
                <form class="form-group">
                    <button  id="card-button" data-secret="{{ $intent->client_secret }}" class="btn btn-lg btn-success btn-block mt-3">SUBMIT</button>
                </form>
            </form>
        </div>
    </main>
    <noscript>Sorry, your browser does not support JavaScript!</noscript>
    <!-- SCRIPTS STRIPE -->
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        var stripe = Stripe('{{ env('STRIPE_KEY') }}');
        var elements = stripe.elements();
        var style = {
            base: {
                color: '#32325d',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };
        var card = elements.create('card', {hidePostalCode: true, style: style});
        card.mount('#card-element');
        card.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });
        const cardHolderName = document.getElementById('card-holder-name');
        const cardButton = document.getElementById('card-button');
        const clientSecret = cardButton.dataset.secret;
        cardButton.addEventListener('click', async (e) => {
            // Prevent Events - Test: See The JSON PROPS
            e.preventDefault();
            console.log("attempting");
            const { setupIntent, error } = await stripe.confirmCardSetup(
                clientSecret, {
                    payment_method: {
                        card: card,
                        billing_details: { name: cardHolderName.value }
                    }
                }
                );
            if (error) {
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = error.message;
            } else { paymentMethodHandler(setupIntent.payment_method);}
        });
        function paymentMethodHandler(payment_method) {
            var form = document.getElementById('subscribe-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'payment_method');
            hiddenInput.setAttribute('value', payment_method);
            form.appendChild(hiddenInput);        form.submit();
        }
    </script>
    <!-- BS4 JQUery & Popper.js -->
    <script src="/assets/BS4/popper.min.js"></script>
</body>
</html>
