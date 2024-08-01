@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Relojes Biometricos</h6>
                </div>
                <div class="card-body">
                    @php
                    echo $log;
                    @endphp
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
