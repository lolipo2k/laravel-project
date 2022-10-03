@extends('layouts.app')

@section('content')
    <div class="panel _container">
        <div class="panel__top">
            @include('profile.left-profile-info')
            <div class="panel__info">
                <form action="{{ route('addresses.edit', $address) }}" method="POST">
                    @csrf
                    <div class="info__block block-3">
                        <div class="info__title">Adres</div>
                        <div class="block-3">
                            <input autocomplete="off" type="text" name="street" value="{{ old('street') ?? $address['street'] }}" placeholder="Ulica" class="input info__input street @error('street') _error @enderror">
                            <input autocomplete="off" type="text" name="house_number" value="{{ old('house_number') ?? $address['house_number'] }}" placeholder="Numer domu" class="input info__input number @error('house_number') _error @enderror">
                            <input autocomplete="off" type="text" name="apartment_number" value="{{ old('apartment_number') ?? $address['apartment_number'] }}" placeholder="Numer mieszkania" class="input info__input number @error('apartment_number') _error @enderror">
                            <input autocomplete="off" type="text" name="entrance" value="{{ old('entrance') ?? $address['entrance'] }}" placeholder="Numer klatki" class="input info__input number @error('entrance') _error @enderror">
                            <input autocomplete="off" type="text" name="floor" value="{{ old('floor') ?? $address['floor'] }}" placeholder="Piętro" class="input info__input number @error('floor') _error @enderror">
                            <input autocomplete="off" type="text" name="intercom" value="{{ old('intercom') ?? $address['intercom'] }}" placeholder="Kod od domofonu" class="input info__input number @error('intercom') _error @enderror">
                        </div>
                    </div>

                    <div class="_btn">
                        <button type="submit">Zapisz</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
