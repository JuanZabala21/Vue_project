@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="width: 800px">
                <div class="card-header">Inmuebles Personales</div>
                
                 <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <inmueble-component></inmueble-component>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
