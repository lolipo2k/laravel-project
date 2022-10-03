@extends('layouts.app')

@section('content')
    <div class="panel _container">
        <div class="panel__top">
            @include('profile.left-profile-info')
            <div class="panel__info">
                <div class="info__adres">
                    <div class="adres__add">
                        <div class="add__title">Zapisane adresy</div>
                        <a href="{{ route('addresses.create') }}"><div class="add__btn"><span>Dodaj nowy</span></div></a>
                    </div>
                    <div class="buy__adres">
                        @foreach($user->addresses()->get() as $address)
                            <a href="{{ route('addresses.edit', $address['id']) }}" class="link">
                                <div class="adres__item">
                                    <p class="_icon-14">ul. {{ $address->street }}, dom. {{ $address->house_number }}, kw. {{ $address->apartment_number }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
                <div class="info__message">
                    <div class="message__title">Prośby o sprzątanie biura</div>
                    <div class="message__btn _btn">
                        <a href="{{ route('office') }}" class="link _link">Wyślij zapytanie</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
