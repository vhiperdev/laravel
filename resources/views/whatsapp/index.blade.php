@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Whatsapp</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Whatsapp</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="@if($last_session) row @else row justify-content-center @endif">
                <div class="col-md-4">
                    <div class="card bg-secondary">
                        @if($last_session) <div class="card-body text-center">
                            <img src="{{$last_session->qr_code}}" class="w-100 mb-5">
                        </div>
                        <div class="card-footer mt-5">
                            <a class="" href="{{route('whatsapp.scanned.status', ['id'=>$last_session->id])}}" onclick="return confirm('Are you sure you have scanned and authenticated your whatsapp?')"> <button class="btn btn-warning">I have scanned the code</button></a>
                        </div>
                        @else
                        Whatsapp is authenticated
                        @endif
                    </div>
                </div>
                <div class="col-md-8">
                    <div id="loader"> Checking authentication status, please wait <span class="spinner-border spinner-border-sm"></span></div>
                    <div id="loader-done" style="display: none;"> Whatsapp is currently authenticated</div>

                    <div class="card shadow-none">
                        <div class="table-responsive ">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>QR</th>
                                        <th>last session</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($whatsapp_session as $whatsapp)
                                    <tr>
                                        <td>{{$whatsapp->id}}</td>
                                        <td><img src="{{$whatsapp->qr_code}}" style="width: 30px;"></td>
                                        <td>{{$whatsapp->created_at}}</td>
                                    </tr>
                                    @endforeach

                                    @if(count($whatsapp_session) == 0)
                                    <tr>
                                        <td colspan="3" class="text-center text-danger"> No session exist</td>
                                    </tr>
                                    @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</section>
</div>
@endsection


@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', async function() {
        fetchPlans();
    });

    const loader = document.getElementById("loader");
    const loader_done = document.getElementById("loader-done");

    async function fetchPlans() {
        loader.style.display = "block";

        const response = await axios.post("http://localhost:3000/authenticate", {
            userId: <?php echo auth()->user()->id; ?>
        }).then((response) => {
            // Handle the response data
            console.log("response", response);

            if (response.data.qrCode) {
                axios.post('/api/whatsapp/save', {
                    qr_code: response.data.qrCode,
                    user_id: '<?php echo auth()->user()->id; ?>'
                }).then(() => {
                    window.location.reload();
                })
            } else {
                loader.style.display = "none";
                // loader_done.style.display = "block";
            }

        }, (error) => {
            // Handle errors
            loader.style.display = "none";
            console.error('Error during Axios request:', error.message);
        });
    }
</script>

@endpush