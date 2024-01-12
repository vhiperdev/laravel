@extends('layouts.app-auth')

@section('content')
<style>
    .subscription-box {
        height: 100vh;
    }
</style>
<div class="subscription-box">
    <div class="row h-100 justify-content-center">
        <div class="col-md-4 my-auto">
            <div class="card card-outline card-primary">
                <div class="card-header text-center"> Hello {{ auth()->user()->name }}.</div>
                <div class="card-body">
                    <div class="alert alert-warning" role="alert">
                        Your subscription has expired. Please renew your subscription to continue accessing our services.
                    </div>

                    <form method="POST" action="{{ route('payment.createPayment') }}">

                        @csrf

                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <div class="fw-bold">Pay with</div>

                        <img src="{{asset('dist/img/logo-mercadopago.png')}}">


                        @csrf()
                        <button type="submit" class="btn btn-primary w-100 mt-5">Pay Now</button>

                </div>

                </form>

            </div>
        </div>
    </div>
</div>
</div>


@push('scripts')
<script>
    const selectElement = document.getElementById('product_plan_id');

    async function fetchPlans() {
        var inputElement = document.getElementById("product");

        var inputValue = inputElement.value;

        await fetch(`/api/productplan/getplan/${inputValue}`)
            .then(response => {
                // Check if the request was successful (status code 200)
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }

                // Parse the response as JSON  
                return response.json();
            })
            .then(data => {
                // Handle the parsed data
                console.log("inputValue", data);

                selectElement.innerHTML = '';

                // Add a default option
                const defaultOption = document.createElement('option');
                defaultOption.text = 'Select an option';
                selectElement.add(defaultOption);

                // Populate options from the fetched data
                data.forEach(item => {
                    const option = document.createElement('option');
                    option.value = item.id;
                    option.text = item.plan.name;
                    selectElement.add(option);
                });

            })
            .catch(error => {
                // Handle errors
                console.error('Error during fetch operation:', error);
            });

    }
</script>
@endpush
@endsection