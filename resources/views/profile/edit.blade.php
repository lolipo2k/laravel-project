@extends('layouts.app')

@section('content')
    <div class="panel _container">
        <div class="panel__top">
            @include('profile.left-profile-info')
            <div class="panel__info">
                <form action="{{ route('profile.edit') }}" method="POST">
                    @csrf
                    <div class="info__block">
                        <div class="info__title">Edytuj konto</div>

                        <div class="block-1">
                            <input autocomplete="off" type="text" name="name" value="{{ old('name') ?? $user->name }}" placeholder="Imię" class="input info__input @error('name') _error @enderror">
                            <input autocomplete="off" type="phone" name="phone" value="{{ old('phone') ?? $user->phone }}" placeholder="Telefon kontaktowy" class="input info__input @error('phone') _error @enderror">
                            <input autocomplete="off" type="text" name="email" value="{{ old('email') ?? $user->email }}" placeholder="Adres e-mail" class="input info__input @error('email') _error @enderror">
                        </div>
                    </div>
                    <div class="info__block">
                        <div class="info__title">Jeśli nie chcesz zmieniać hasła, pozostaw pola puste</div>

                        <div class="block-2">
                            <input autocomplete="off" type="password" name="password" value="{{ old('password') }}" placeholder="Hasło" class="input info__input password @error('password') _error @enderror">
                            <input autocomplete="off" type="password" name="repeatpassword" value="{{ old('repeatpassword') }}" placeholder="Potwierdź hasło" class="input info__input password @error('repeatpassword') _error @enderror">
                        </div>
                    </div>

                    <div class="info__btn _btn">
                        <button type="submit">Zapisz</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
