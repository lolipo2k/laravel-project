@extends('layouts.app')

@section('content')
    <div class="reg _container">
        <div class="reg__title _title">Załoguj się</div>

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ route('password.email') }}" method="POST" class="reg__form">
            @csrf

            <input autocomplete="off" type="email" name="email" placeholder="E-Mail" class="reg__input input @error('email') @enderror">

            @error('email')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror

            <div class="reg__btn _btn">
                <button type="submit">Zaloguj sie</button>
            </div>
        </form>
    </div>
@endsection
