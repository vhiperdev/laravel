@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">

                    <div class="row mt-4">
                        <div class="col-sm-6">
                            <h5>Update Subscription</h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">All Subscription</li>
                            </ol>
                        </div>
                    </div>
                    <a href="{{ URL::previous() }}">
                        <button class="btn btn-sm"><i class="fa fa-arrow-left fa-1x"></i></button>
                    </a>
                    <div class="card card-default mt-2">
                        <div class="card-header">
                            <h3 class="card-title">Update subscription</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body">

                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            <form method="POST" action="{{ route('subscription.update', ['id'=>$subscription->id]) }}">
                                @csrf()
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Duration</label>
                                            <select name="subscription_duration" class="form-control select2  @error('subscription_duration') is-invalid @enderror" style="width: 100%" value="{{ old('subscription_duration') }}" autocomplete="subscription_duration" autofocus>
                                                <option value="{{$subscription->subscription_duration}}">{{$subscription->subscription_duration}}</option>
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

                                        <div class="form-group">
                                            <label>Plan</label>
                                            <select name="product_plan_id" id="product_plan_id" class="form-control select2  @error('product_plan_id') is-invalid @enderror" style="width: 100%" value="{{ old('product_plan_id')?? $subscription->productplan->plan->id }}" autocomplete="product_plan_id" autofocus>
                                                @foreach($productplan as $productp)
                                                <option value="{{$productp->id}}">{{$productp->plan->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('product_plan_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <!-- 
                                        <div class="form-group">
                                            <label>Product Plan</label>
                                            <input name="name" class="form-control select2  @error('name') is-invalid @enderror" style="width: 100%" value="{{ old('name')?? $subscription->productplan->plan->name }}" autocomplete="name" autofocus disabled>
                                        </div>
                                        <div class="form-group">
                                            <label>Product Name</label>
                                            <input name="name" class="form-control select2  @error('name') is-invalid @enderror" style="width: 100%" value="{{ old('name')?? $subscription->productplan->product->name }}" autocomplete="name" autofocus disabled>
                                        </div>

                                        <div class="form-group">
                                            <label>Customer Name</label>
                                            <input name="name" class="form-control select2  @error('name') is-invalid @enderror" style="width: 100%" value="{{ old('name')?? $subscription->customer->name }}" autocomplete="name" autofocus disabled>
                                        </div>

                                        <div class="form-group">
                                            <label>Next Due date</label>
                                            <input class="form-control select2" style="width: 100%" value="{{$subscription->next_due_date }}" autocomplete="name" autofocus disabled>
                                        </div> -->

                                        <div class="form-group">
                                            <button class="btn btn-primary btn-md">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>

                    </div>
                </div>
    </section>
</div>
@endsection