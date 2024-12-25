@extends('layouts.app')

@section('content')
<div class="about-main-content" style="margin-top: -25px; background-image: url('{{asset('assets/images/'.$country->image.'')}}')">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
        <div class="content" style="position: relative; overflow: hidden;">
    <div class="blur-bg" style="background-image: url('{{ asset('assets/images/'.$country->image) }}');"></div>
            <h4>Pay with Paypal</h4>
            <div class="line-dec"></div>
            <div class="main-button">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

    <div class="container">  
    <script src="https://www.paypal.com/sdk/js?client-id=Af4svLRq_gQux-pp1WPU_QLO7x2VPsP4agl0ztJJsSOK2rJBkLcs6_u5Dqh0gE69WiCt_AlP-59wcXs-&currency=USD"></script>
<div id="paypal-button-container"></div>
<script>
    paypal.Buttons({
        createOrder: (data, actions) => {
            const price = '{{ Session::get('price') }}';
            if (!price || isNaN(price)) {
                alert('Invalid price value!');
                throw new Error('Invalid price value');
            }
            return actions.order.create({
                purchase_units: [{
                    amount: { value: price }
                }]
            });
        },
        onApprove: (data, actions) => {
            return actions.order.capture().then(function(orderData) {
                console.log('Order completed:', orderData);
                window.location.href = 'http://127.0.0.1:8000/traveling/success';
            }).catch(err => {
                console.error('Error capturing order:', err);
                alert('An error occurred while capturing the payment.');
            });
        },
        onError: (err) => {
            console.error('PayPal Error:', err);
            alert('An error occurred while processing the payment.');
        }
    }).render('#paypal-button-container');
</script>


                  
                </div>


@endsection