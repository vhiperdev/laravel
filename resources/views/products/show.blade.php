@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{$product->name}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Products</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <a href="{{ URL::previous() }}">
                        <button class="btn btn-sm"><i class="fa fa-arrow-left fa-1x"></i></button>
                    </a>
                </div>
                <div class="col-md-6 text-end">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Asign Plan
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card mt-3 mb-5 border-0">
                        <div class="card-body">
                            <div class="row mt-4">
                                <div class="col-md-6 text-start">
                                    <div class='profile-item'>
                                        <div class='customer_details_name'>Product Name</div>
                                        <div class='customer_details_value'>
                                            {{$product->name}}
                                        </div>
                                    </div>
                                    <div class='profile-item'>
                                        <div class='customer_details_name'>Value</div>
                                        <div class='customer_details_value'>
                                            {{$product->value}}
                                        </div>
                                    </div><br />
                                    <div class='profile-item'>
                                        <div class='customer_details_name'>Created At</div>
                                        <div class='customer_details_value'>
                                            {{$product->created_at}}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 text-start">
                                    <h2 class="fs-5 fw-bolder">Product Plans</h2>
                                    @if(count($productPlan))

                                    @foreach( $productPlan as $productPl)

                                    <div class="card card-default shadow-none border">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-10">

                                                    <div>
                                                        {{$productPl->plan->name}}
                                                    </div>
                                                    <div>
                                                        {{$productPl->plan->value}}
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <a href="{{ route('product.unasign.plan', ['id' => $productPl->id]) }}"><button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    @else
                                    <div class="text-secondary">No plan found</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Asign New Plan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{ route('product.asign.plan', ['id' =>$product->id]) }}">
                        <div class="modal-body">

                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            @csrf()
                            <div class="form-group">
                                <label>Plan</label>
                                <select name="plan" class="form-control select2  @error('plan') is-invalid @enderror" style="width: 100%" autocomplete="plan" autofocus>
                                    <option>--choose--</option>

                                    @foreach($plans as $plan)
                                    <option value="{{$plan->id}}">{{$plan->name}}</option>
                                    @endforeach
                                </select>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Asign</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
</div>@endsection