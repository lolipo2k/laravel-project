@extends('layouts.app')

@section('content')
    <div class="price price-2 _container">
        <div class="price__title">Cennik</div>
        <div class="price__subtitle">Ceny sprzątania mieszkań w Warszawie</div>

        <div class="price__apartment-list">
            @foreach($patterns as $pattern)
                <div class="price__apartment-item">
                    <div class="apartment-title">{{ $pattern->title }}</div>
                    <div class="apartment__subtitle">{{ $pattern->description }}</div>
                    <div class="apartment-price">{{ sprintf("%01.2f", $pattern->getPrice()) }} zł</div>
                    <a href="{{ route('order.choice', ['service' => $pattern->service()->first()->id, 'rooms' => $pattern['rooms'], 'bathrooms' => $pattern['bathrooms']]) }}"><div class="apartment-order">Zamów</div></a>
                </div>
            @endforeach
        </div>
    </div>

    <div class="additional _container">
        <div class="additional__list">
            @foreach($additionals as $additional)
                    <div class="additional__item">
                        <div class="additional__img"><img src="{{ Storage::url($additional->cover) }}" alt="Photo"></div>
                        <div class="additional__text">{{ $additional->title }}</div>
                        <div class="additional__price">{{ sprintf("%01.2f", $additional->price) }} zł</div>
                        <a href="{{ route('additionals', $additional['id']) }}" class="main-additional__link"> </a>
                    </div>
            @endforeach
        </div>
    </div>

    <div class="additional _container">
        <div class="price__window">
            <div class="price__title">
                Cena sprzątania po remoncie w Warszawie
            </div>
            <div class="price__img"><img src="/images/price/10.jpg" alt="Photo"></div>
        </div>
        <div class="price__subtitle">
            Efektywne i szybkie zakończenie remontu w Twoim mieszkaniu
        </div>
        <div class="price__advant">
            <div class="price__advant-item">
                <div class="advant__img"><img src="/images/price/17.svg" alt="Photo"></div>
                <div class="advant__text">
                    Całkowite końcowe sprzątanie po budowie lub remoncie
                </div>
            </div>
            <div class="price__advant-item">
                <div class="advant__img"><img src="/images/price/18.svg" alt="Photo"></div>
                <div class="advant__text">
                    Nasze ceny są stałe
                </div>
            </div>
            <div class="price__advant-item">
                <div class="advant__img"><img src="/images/price/19.svg" alt="Photo"></div>
                <div class="advant__text">
                    Skończymy sprzątać
                    w ciągu jednego dnia
                </div>
            </div>
            <div class="price__advant-item">
                <div class="advant__img"><img src="/images/price/20.svg" alt="Photo"></div>
                <div class="advant__text">
                    Wracasz do czystego mieszkania, w którym
                    można żyć
                </div>
            </div>
            <div class="price__advant-item">
                <div class="advant__img"><img src="/images/price/21.svg" alt="Photo"></div>
                <div class="advant__text">
                    Możesz opłacić usługę
                    kartą lub gotówką
                </div>
            </div>
            <div class="price__advant-item">
                <div class="advant__img"><img src="/images/price/22.svg" alt="Photo"></div>
                <div class="advant__text">
                    Mamy profesjonalny sprzęt, niezbędne narzędzia i doświadczony zespół
                </div>
            </div>
        </div>
        <div class="additional__title wind-title">
            Ceny za mycie okien
        </div>
        <div class="additional__subtitle">
            Mycie okien składa się z mycia szyb z obu stron, ramy, parapetu. Nasze ceny są stałe i od razu wiesz,
            jaka jest ostateczna kwota. Możesz opłacić mycie okien kartą lub gotówką.
        </div>

        @if (isset($window))
            <div class="price__wind">
                <div class="wing__img"><img src="/images/price/16.jpg" alt="Photo"></div>
                <div class="wind__text">
                    Mycie okna
                </div>
                <div class="wind__price">
                    {{ sprintf("%01.2f", $window['window_price']) }} zł
                </div>
            </div>
        @endif

        @if (isset($remont))
            <div class="price__order _btn">
                <a href="{{ route('order.choice', $remont['id']) }}" class="link _link">Złóż zamówienie na sprzątanie po remoncie</a>
            </div>
        @endif
    </div>
@endsection
