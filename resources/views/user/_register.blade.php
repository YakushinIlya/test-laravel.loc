@extends('app')

@section('content')
    <div class="auth-form-container text-left">
        <form class="auth-form login-form" action="{{route('register')}}" method="post">
            @csrf
            <div class="email mb-3">
                <label class="sr-only" for="signin-email">E-mail</label>
                <input id="signin-email" name="email" type="email" class="form-control signin-email" placeholder="E-mail адрес" required="required">
            </div><!--//form-group-->
            <div class="password mb-3">
                <label class="sr-only" for="signin-password">Пароль</label>
                <input id="signin-password" name="password" type="password" class="form-control signin-password" placeholder="Пароль" required="required">
            </div><!--//form-group-->
            <div class="text-center">
                <button type="submit" class="btn app-btn-primary btn-block theme-btn mx-auto">Зарегистрироваться</button>
            </div>
        </form>

        <div class="auth-option text-center pt-5"> <a class="text-link" href="{{route('login')}}" >Войти</a> </div>
    </div><!--//auth-form-container-->
@endsection
