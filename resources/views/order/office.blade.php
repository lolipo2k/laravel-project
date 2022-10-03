@extends('layouts.app')

@section('content')
    <div class="office _container">
        <div class="office__title _title">
            Sprzątanie biur
        </div>
        <div class="office__img _img_bg">
            <img src="/images/office/01.jpg" alt="Photo">
        </div>
        <div class="office__subtitle _subtitle">
            Zajmujemy się zarówno regularnym sprzątaniem biur, jak i jednorazowymi zamówieniami. Możemy
            przygotować
            wasze
            biuro do pracy po budowie oraz remoncie, umyć tylko okna lub wykonać czyszczenie chemiczne mebli i
            wykładziny.
        </div>
{{--        <div class="office__btn _btn">--}}
{{--            <button type="submit">Wyślij zapytanie</button>--}}
{{--        </div>--}}
        <div class="office__title _title">
            Jak to działa?
        </div>
        <div class="office__subtitle _subtitle">
            Naszym celem jest sprawienie, by ta usługa była cenowo porównywalna z kosztami, jakie ponosisz
            zatrudniając osoby
            dedykowane do utrzymania czystości. W naszym przypadku jednak nie będziesz musiał opłacać podatków, dni
            wolnych,
            czy też szukać zastępstwa na wypadek choroby - tym zajmiemy się my.
        </div>
        <div class="office__subtitle _subtitle">
            Możemy również zapewnić zniżki na podstawową usługę sprzątania dla Twoich pracowników oraz pomóc w
            obsłudze imprez
            firmowych.
        </div>
        <form action="{{ route('office') }}" method="POST" class="office__form">
            @csrf

            <div class="office__inp">
                <input autocomplete="off" type="text" name="name" value="{{ old('name') }}" data-error="Ошибка" placeholder="Imię" class="input office__input @error('name') _error @enderror">
                <input autocomplete="off" type="phone" name="phone" value="{{ old('phone') }}" data-error="Ошибка" placeholder="Telefon kontaktowy" class="input office__input @error('phone') _error @enderror">
                <input autocomplete="off" type="email" name="email" value="{{ old('email') }}" data-error="Ошибка" placeholder="Adres e-mai" class="input office__input @error('email') _error @enderror">
                <input autocomplete="off" type="text" name="m2" value="{{ old('m2') }}" data-error="Ошибка" placeholder="Powierzchnia m2" class="input office__input @error('m2') _error @enderror">
            </div>

            <div class="office__btn-form @if (old('window')) _active @endif">
                <label for="window" class="additional__label"></label>
                <input type="checkbox" class="service" id="window" name="window" @if (old('window')) checked @endif>
                <p class="_icon-22">Potrzebne mycie okien</p>
            </div>

            <div class="office__btn-form @if (old('chemical_cleaning')) _active @endif">
                <label for="chemical_cleaning" class="additional__label"></label>
                <input type="checkbox" class="service" id="chemical_cleaning" name="chemical_cleaning" @if (old('chemical_cleaning')) checked @endif>
                <p class="_icon-23">Potrzebne czyszczenie chemiczne</p>
            </div>

            <div class="office__btn-form @if (old('repairs')) _active @endif">
                <label for="repairs" class="additional__label"></label>
                <input type="checkbox" class="service" id="repairs" name="repairs" @if (old('repairs')) checked @endif>
                <p class="_icon-24">Sprzątanie po remoncie</p>
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
