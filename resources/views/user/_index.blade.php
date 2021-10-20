@extends('app')

@section('content')
    <div class="auth-form-container">
        <a href="{{route('login')}}" class="btn app-btn-primary btn-block theme-btn mx-auto">Вход</a>
    </div><!--//auth-form-container-->
    <div class="auth-form-container mt-2">
        <a href="{{route('register')}}" class="btn app-btn-primary btn-block theme-btn mx-auto">Регистрация</a>
    </div><!--//auth-form-container-->
@endsection
