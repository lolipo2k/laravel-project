@extends('layouts.app')

@section('content')
    <div class="praca-top _container">
        <div class="praca-img">
            <picture><source srcset="/images/praca/praca.jpg" type="image/webp"><img src="/images/praca/praca.jpg" alt=""></picture>
        </div>
        <div class="praca-text">
            <div class="praca-title _title">
                Szukamy specjalistów <br>
                <span>od sprzątania</span>
            </div>
            <div class="praca-about">
                Zajmujemy się sprzątaniem mieszkań, sprzątaniem po remoncie, sprzątaniem w biurach, obsługą imprez
                masowych.
            </div>
            <div class="praca-button _btn">
                <a href="#formVacancy" class="_link">Aplikuj</a>
            </div>
        </div>
    </div>
    <div class="questions _praca _container _faq">
        <div class="questions__title">
            Często zadawane pytania
        </div>
        <div class="faq-text">
            Odpowiedzi na pytanie kandydatów
        </div>
        <div class="questions__tabs-list _spollers _one">
            @foreach($faqs as $faq)
                <div class="questions__tabs-item">
                    <div class="questions__tabs-title _spoller">
                        {{ $faq['title'] }}
                    </div>
                    <div class="questions__tabs-text">
                        {{ $faq['description'] }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="office _praca _container" id="formVacancy">
        <div class="office__title _title">
            Dane kandydata
        </div>
        <div class="faq-text">
            Menedżerowie skontaktują się z Tobą w ciągu dnia
        </div>

        <form action="{{ route('vacancy') }}" method="POST" class="office__form">
            @csrf

            <div class="office__inp">
                <input autocomplete="off" type="text" name="name" data-error="Ошибка" value="{{ old('name') }}" placeholder="Imię" class="input office__input">
                <input autocomplete="off" type="text" name="phone" data-error="Ошибка" value="{{ old('phone') }}" placeholder="Telefon kontaktowy" class="input office__input">
                <input autocomplete="off" type="email" name="email" data-error="Ошибка" value="{{ old('email') }}" placeholder="Adres e-mai" class="input office__input">
            </div>

            <div class="office__textarea">
                <textarea name="information" class="office__txtarea _textarea" placeholder="Dodatkowa informacja do zamówienia">{{ old('information') }}</textarea>
            </div>

            <div class="office__btn _btn">
                <button type="submit">Wyślij</button>
            </div>
        </form>
    </div>
@endsection
