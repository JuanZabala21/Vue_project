@extends('layouts.master')

@section('content')
<div class="container">
<br>
<br>
<br>
<br>
    <div class="row justify-content-center">
        <div class="col-md-15">
            <div class="card">
                <div class="card-header">Bienvenido</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                   
                    ¡Has iniciado sesión!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
