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
                <div class="card-header text-center"> Welcome {{ auth()->user()->name }}</div>
                <div class="card-body">
                    <div class="alert alert-success" role="alert">
                        Welcome! Experience the full range of our services by subscribing today. Choose a plan that suits your needs and enjoy exclusive benefits. Subscribe now and unlock a world of possibilities!
                    </div>

                    {{ __('Before proceeding, kindly choose a plan that best fit') }}
                    <form method="POST" action="{{ route('reseller.subscriptions.new.subscriber', ['id'=> auth()->user()->id, 'status'=>0]) }}">

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

                        <div class="form-group mt-4">
                            <label>Product</label>
                            <select name="product" id="product" class="form-control select2  @error('product') is-invalid @enderror" style="width: 100%" value="{{ old('product') }}" autocomplete="name" autofocus onchange="fetchPlans()">
                                <option>--choose--</option>
                                @foreach($products as $product)
                                <option value="{{$product->id}}"> {{$product->name}}</option>
                                @endforeach
                            </select>
                            @error('product')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>



                        <div class="form-group mt-4">
                            <label>Plan</label>
                            <select name="product_plan_id" id="product_plan_id" class="form-control select2  @error('product_plan_id') is-invalid @enderror" style="width: 100%" value="{{ old('product_plan_id') }}" autocomplete="product_plan_id" autofocus>
                            </select>
                            @error('product_plan_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label>Duration</label>
                            <select name="subscription_duration" class="form-control select2  @error('subscription_duration') is-invalid @enderror" style="width: 100%" value="{{ old('subscription_duration') }}" autocomplete="subscription_duration" autofocus>
                                <option value="">--choose--</option>
                                <option value="monthly">Monthly</option>
                                <option value="quarterly">Quarterly</option>
                                <option value="anually">Anually</option>
                            </select>
                            @error('subscription_duration')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>


                        <div class="form-group mt-4">
                            <button class="btn btn-warning">Proceed</button>
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