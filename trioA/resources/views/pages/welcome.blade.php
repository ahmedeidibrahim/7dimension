@extends('layouts.app')
@section('content')
    <div class="jumbotron text-center">
        <h1>trioA</h1>
        <p> التريو هي اول و اكبر منصة الكترونية للتحول الرقمي في مجال التدريبات الوعي السكاني</p>
        @guest
            <p>
                <a class="btn btn-primary btn-lg" href="/login" role="button">login</a>
                <a class="btn btn-success btn-lg" href="/register" role="button">Register</a>
            </p>
        @else
            <a class="btn btn-outline-success" href="/dashboard">
                <p>{{ Auth::user()->name }}</p>
                <p>Dashboard</p>
            </a>
        @endguest
    </div>
@endsection