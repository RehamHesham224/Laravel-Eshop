@extends('layouts.front')
@section('title')
    Checkout
@endsection
@section('content')
<div class="py-3 mb-4 shadow-sm bg-warning border-top">
    <div class="container">

        <h6 class="mb-0">
         <a href="{{url('/')}}">Home</a> /
        <a href="{{url('checkout')}}">Checkout </a>

        </h6>
    </div>
    </div>
    <div class="container mt-5">
        <form action="/place-order" method="post" >
            @csrf
        <div class="row">
        <div class="col-md-7">
            <div class="card">
            <div class="card-body">
                <h6>Basic details</h6>
                <hr>
                <div class="row checkout-form">
                    <div class="col-md-6 mb-4">
                        <label > First Name</label>
                        <input name="fname" value="{{Auth::user()->name}}" type="text"  class="form-control firstname" required placeholder="Enter First Name">
                        <div class="invalid-feedback">
                            Please write your First Name
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label > Last Name</label>
                        <input name="lname" value="{{Auth::user()->lname}}" type="text"  class="form-control lastname" required placeholder="Enter Last Name">
                        <div class="invalid-feedback">
                            Please write your Last Name
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label > Email</label>
                        <input name="email" value="{{Auth::user()->email}}" type="text"  class="form-control email" required placeholder="Enter Email">
                        <div class="invalid-feedback">
                            Please write your email
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label >Phone Number</label>
                        <input name="phone" value="{{Auth::user()->phone}}" type="text"  class="form-control phone" required placeholder="Enter Phone Number">
                        <div class="invalid-feedback">
                            Please write your Phone
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label > Address 1</label>
                        <input name="address1" value="{{Auth::user()->address1}}" type="text"  class="form-control address1" required placeholder="Enter Address">
                        <div class="invalid-feedback">
                            Please write your Address1
                        </div>
                    </div>
                        <div class="col-md-6 mb-4">
                        <label >Address 2</label>
                        <input name="address2" value="{{Auth::user()->address2}}" type="text"  class="form-control address2" required placeholder="EnterAddress 2">
                        <div class="invalid-feedback">
                            Please write your Address2
                        </div>
                    </div>
                        <div class="col-md-6 mb-4">
                        <label >  City</label>
                        <input name="city"type="text"  value="{{Auth::user()->city}}" class="form-control city" required placeholder="Enter  City">
                        <div class="invalid-feedback">
                            Please write your City
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label > State</label>
                        <input  name="state"type="text"  value="{{Auth::user()->state}}" class="form-control state" required placeholder="Enter State">
                        <div class="invalid-feedback">
                            Please write your State
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label > Country</label>
                        <input name="country" type="text" value="{{Auth::user()->country}}"  class="form-control country" required placeholder="Enter Country">
                        <div class="invalid-feedback">
                            Please write your Country
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label > Pin Code </label>
                        <input name="pincode" type="text"  value="{{Auth::user()->pincode}}" class="form-control pincode " placeholder="Enter Pin Code ">
                        <div class="invalid-feedback">
                            Please write your PinCode
                        </div>
                    </div>

                </div>
            </div>
            </div>
        </div>
        <div class="col-md-5 mt-4 mt-md-0">


        <div class="card">
            <div class="card-body">
            Order Details
            @if($cartitems->count()>0 )
            <table class="table table-striped table-responsive table-bordered">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
                </thead>
                <tbody>

                @foreach($cartitems as $item)
                    <tr>
                    <td>{{$item->products->name}}</td>
                    <td>{{$item->prod_qty}}</td>
                    <td>{{$item->products->selling_price}}</td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
            <hr>
            <input type="hidden" name="payment_mode" value="COD" id="">
            <button type="submit" class="btn btn-success w-100 mb-3">Place Order | COD</button>
            <button type="button"  class="btn btn-primary w-100 razorpay-btn">Pay with Razorpay</button>
            <div id="paypal-button-container" class="mt-3"></div>
            @else
            <hr>
            <h4 class=" py-2 text-center">No Products In Cart</h4>
            @endif
            </div>
            </div>



    </div>
        </div>
        </form>
    </div>
    @endsection
    @section('scripts')

        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
        <script src="https://www.paypal.com/sdk/js?client-id=Aaw8otvUyyBFrtAoC34L74_KGqpDU6IFjqv949JDsXEo7NrT8Pe2k8U0ZGQ-oRl6T869Dh4uPzCKBJrU"></script>
        <script>
                paypal.Buttons({
                createOrder: function(data, actions) {
                // This function sets up the details of the transaction, including the amount and line item details.
                return actions.order.create({
                    purchase_units: [{
                    amount: {
                        value: '1'
                    }
                    }]
                });
                },
                onApprove: function(data, actions) {
                // This function captures the funds from the transaction.
                return actions.order.capture().then(function(details) {
                    // This function shows a transaction success message to your buyer.
                    var firstname=$('.firstname').val();
                    var lastname=$('.lastname').val();
                    var email=$('.email').val();
                    var phone=$('.phone').val();
                    var address1=$('.address1').val();
                    var address2=$('.address2').val();
                    var city=$('.city').val();
                    var state=$('.state').val();
                    var country=$('.country').val();
                    var pincode=$('.pincode').val();
                    // alert('Transaction completed by ' + details.payer.name.given_name);
                    $.ajax({
                    method: "POST",
                    url: "/place-order",
                    data:{
                        'fname':firstname,
                        'lname':lastname,
                        'email':email,
                        'phone':phone,
                        'address1':address1,
                        'address2':address2,
                        'city':city,
                        'state':state,
                        'country':country,
                        'pincode':pincode,
                        'payment_mode':"Paid by Paypal",
                        'payment_id':details.id,
                    },

                    success: function (response) {
                        swal(response.status);
                        window.location.href="/my-orders";
                    },
                    });
            });
                }
            }).render('#paypal-button-container');
          //This function displays payment buttons on your web page.

        </script>
    @endsection
