@extends('layouts.app')

@section('content')
    <div class="reg _container">
        <div class="reg__title _title">Zarejestruj się</div>
        <form action="{{ route('register') }}" method="POST" class="reg__form">
            @csrf

            <input autocomplete="off" type="text" placeholder="Name" name="name" class="reg__input input @error('name') _error @enderror" value="{{ old('name') }}">
            <input autocomplete="off" type="email" placeholder="E-Mail" name="email" class="reg__input input @error('email') _error @enderror" value="{{ old('email') }}">
            <input autocomplete="off" type="text" placeholder="Phone number" name="phone" class="reg__input input @error('phone') _error @enderror" value="{{ old('phone') }}">
{{--            <input autocomplete="off" type="text" placeholder="Ref code" name="ref_code" class="reg__input input @error('ref_code') _error @enderror" value="{{ old('ref_code') ?? Cookie::get('ref') ?? '' }}">--}}
            <input autocomplete="off" type="password" placeholder="Password" name="password" class="reg__input input @error('password') _error @enderror" value="{{ old('password') }}">
            <input autocomplete="off" type="password" placeholder="Repeat password" name="password_confirmation" class="reg__input input @error('password_confirmation') _error @enderror" value="{{ old('password_confirmation') }}">

            <div class="reg__btn _btn">
                <button type="submit">Register</button>
            </div>
        </form>
    </div>
@endsection
