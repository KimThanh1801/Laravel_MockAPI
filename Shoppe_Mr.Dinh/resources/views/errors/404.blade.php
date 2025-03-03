@extends('master')

@section('content')
<div class="container text-center">
    <div class="logo-404">
        <a href="/master"><img src="{{ asset('eshopper/eshopper/images/home/logo.png') }}" alt="Logo" /></a>
    </div>
    <div class="content-404">
        <img src="{{ asset('eshopper/eshopper/images/404/404.png') }}" class="img-responsive" alt="404 Error" />
        <h1><b>OPPS!</b> We Couldn’t Find this Page</h1>
        <p>Uh... So it looks like you broke something. The page you are looking for has up and vanished.</p>
        <h2><a href="/master">Bring me back Home</a></h2>
    </div>
</div>
@endsection
