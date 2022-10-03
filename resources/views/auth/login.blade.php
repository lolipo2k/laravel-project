@extends('layouts.app')

@section('content')
    <div class="reg _container">
        <div class="reg__title _title">Zaloguj się lub zarejestruj</div>

        <form action="{{ route('login') }}" method="POST" class="reg__form">
            @csrf

            <input autocomplete="off" type="email" name="email" placeholder="E-Mail" class="reg__input input @error('email') @enderror">
            <input autocomplete="off" type="password" name="password" placeholder="Password" class="reg__input input @error('password') _error @enderror">

            <div class="_btn">
                <button type="submit">Zaloguj się</button>
            </div>

            <div class="reg-text">
                <div class="reg-text__item">
                    <a href="{{ route('register') }}" class="link">Rejestracja</a>
                </div>
                <div class="reg-text__item">
                    <a href="{{ route('password.request') }}" class="link">Zapomniałeś hasło?</a>
                </div>
            </div>
        </form>
    </div>
@endsection
