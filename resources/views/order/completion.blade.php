@extends('layouts.app')

@section('content')
    <div class="buy _container">
    <form action="{{ route('order.completion', [ 'order' => $order, 'service' => $service ]) }}" class="form__adres" method="POST" id="order_one">
        @csrf

        @if (Auth::check() && Auth::user()->addresses()->count())
            <div class="buy__title">Wybierz jeden z zapisanych adresów</div>
            <div class="buy__adres">
                @foreach(Auth::user()->addresses()->get() as $address)
                    <div class="adres__item @if (old('address') == $address->id) active @endif">
                        <label class="city" for="adres-{{ $address->id }}"></label>
                        <input type="checkbox" class="service" id="adres-{{ $address->id }}" name="address" value="{{ $address->id }}" @if (old('address') == $address->id) checked @endif>
                        <p class="_icon-14">ul. {{ $address->pay__btnstreet }}, dom. {{ $address->house_number }}, kw. {{ $address->apartment_number }}</p>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="buy__title">Lub wprowadź swój adres</div>
        <div class="buy__text">
            Wybierz jedną z opcji jeśli klucze trzeba odebrać z pod innego adresu, lub dostarczyć je po sprzątaniu
        </div>

        <div class="my__adres">
            <div class="adres__item dostawa">
                <label for="key-1" class="_key" data-price="{{ Config('price.1') }}" id="one-side"></label>
                <input type="checkbox" class="service _checks" id="key-1" name="keys" value="1">
                W jedną stronę<span>{{ sprintf("%01.2f", Config('price.1')) }} zł</span>
            </div>
            <div class="adres__item dostawa">
                <label for="key-2" class="_key" data-price="{{ Config('price.2') }}" id="two-side"></label>
                <input type="checkbox" class="service _checks" id="key-2" name="keys" value="2">
                W dwie strony<span>{{ sprintf("%01.2f", Config('price.2')) }} zł</span>
            </div>
            <div class="adres__key">
                <p class="_icon-19">Dostawa kluczy</p>
            </div>
        </div>

        <label class="label__form">Adres @if (Auth::check() && Auth::user()->addresses()->count() > 0) (Jeśli wybrany jest powyższy adres, nic nie pisz) @endif</label>
        <div class="input__row-1">
            <input autocomplete="off" type="text" name="street" data-error="Ошибка" placeholder="Ulica" value="{{ old('street') }}" class="order__input input @error('street') _error @enderror">
            <input autocomplete="off" type="text" name="house_number" data-error="Ошибка" placeholder="Numer domu" value="{{ old('house_number') }}" class="order__input input @error('house_number') _error @enderror">
            <input autocomplete="off" type="text" name="apartment_number" data-error="Ошибка" placeholder="Numer mieszkania" value="{{ old('apartment_number') }}" class="order__input input @error('apartment_number') _error @enderror">
        </div>

        <div class="input-row-2">
            <input autocomplete="off" type="text" name="entrance" data-error="Ошибка" placeholder="Numer klatki" value="{{ old('entrance') }}" class="order__input input @error('entrance') _error @enderror">
            <input autocomplete="off" type="text" name="floor" data-error="Ошибка" placeholder="Piętro" value="{{ old('floor') }}" class="order__input input @error('floor') _error @enderror">
            <input autocomplete="off" type="text" name="intercom" data-error="Ошибка" placeholder="Kod od domofonu" value="{{ old('intercom') }}" class="order__input input @error('intercom') _error @enderror">
        </div>

        <label class="label__form">Dane kontaktowe</label>
        <div class="input-row-3">
            <input autocomplete="off" type="text" name="name" value="{{ old('name') ?? Auth::user()->name ?? "" }}" placeholder="Imię" class="order__input input @error('name') _error @enderror">
            <input autocomplete="off" type="text" name="phone" value="{{ old('phone') ?? Auth::user()->phone ?? "" }}" placeholder="Telefon kontaktowy" class="order__input input @error('phone') _error @enderror">
            <input autocomplete="off" type="text" name="email" value="{{ old('email') ?? Auth::user()->email ?? "" }}" placeholder="Adres e-mail" class="order__input input @error('email') _error @enderror">
        </div>

        <div class="txt-area">
            <textarea cols="30" rows="10" name="information" placeholder="Dodatkowa informacja do zamówienia">{{ old('information') }}</textarea>
        </div>

        <div class="buy__title">
            Wybierz metodę płatności
        </div>
        <div class="pay__item-list">
            <div class="pay__item @if (old('pay') == 1) _active-2 @endif">
                <label for="cash-1" class="pay-label"></label>
                <input type="checkbox" class="service" id="cash-1" name="pay" value="1" @if (old('pay') == 1) checked @endif>
                <p class="_icon-20">Gotówką</p>
            </div>

            <div class="pay__item @if (old('pay') == 2) _active-2 @endif">
                <label for="cash-2" class="pay-label"></label>
                <input type="checkbox" class="service" id="cash-2" name="pay" value="2" @if (old('pay') == 2) checked @endif>
                <p class="_icon-21">Kartą online</p>
            </div>
        </div>

        <div class="pay__check-list">
            <div class="pay__check">
                <label class="checkbox @error('rules') _error @enderror" for="rules">
                    <input class="checkbox__input _req" type="checkbox" name="rules" id="rules" value="1" @if (old('rules')) checked @endif>
                    <span class="checkbox__text"><span>Składając zamówienie zgadzam się z <a href="/docs/Regulamin.pdf" target="_blank" class="link">Regulaminem</a> i <a href="https://extracleaning.pl/privacy" target="_blank" class="link">Polityką prywatności</a></span></span>
                </label>
            </div>

            <div class="pay__check">
                <label class="checkbox @error('data') _error @enderror" for="data">
                    <input class="checkbox__input" type="checkbox" name="data" id="data" value="2" @if(old('data')) checked @endif>
                    <span class="checkbox__text"><span>Wyrażam zgodę na przetwarzanie moich danych osobowych przez administratora w celach marketingowych</span></span>
                </label>
            </div>
        </div>

        <div class="pay__btn">
            <button type="submit">Zamów za <span id="order-price" data-start="{{ $order['cost'] }}">{{ sprintf("%01.2f", $order->cost) }}</span><span> zł</span></button>
        </div>
    </form>
</div>
@endsection
