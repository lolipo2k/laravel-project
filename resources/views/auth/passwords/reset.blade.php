@extends('layouts.app')

@section('content')
    <div class="reg _container">
        <div class="reg__title _title">Odzyskiwanie hasła</div>

        <form action="{{ route('password.update') }}" method="POST" class="reg__form">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <input autocomplete="off" type="email" name="email" placeholder="E-Mail" value="{{ $email ?? old('email') }}" class="reg__input input @error('email') @enderror">
            <input autocomplete="off" type="password" name="password" placeholder="Password" class="reg__input input @error('password') _error @enderror">
            <input autocomplete="off" type="password" name="password_confirmation" placeholder="Password" class="reg__input input @error('password_confirmation') _error @enderror">

            <div class="reg__btn _btn">
                <button type="submit">Zmień hasło</button>
            </div>
        </form>
    </div>
@endsection
