@extends('layouts.app')

@section('content')
    <div class="about _container">
        <h2 class="about__title">
            Jesteśmy firmą sprzątającą
            i naszym celem jest — <span>uprościć Ci życie</span>
        </h2>
        <div class="about__subtitle">
        Jesteśmy firmą sprzątającą Extra Cleaning. Działamy na terenie Warszawy i okolicach. Sprzątanie to nasza pasja. 
        Nie lubimy dużo gadać o sobie, cały nasz profesjonalizm widać po skończonej pracy.
        </div>
        <div class="about__text">
            Sprzątamy mieszkania, domy i biura, czyścimy meble.
        </div>
        <div class="about__items-list">
            <div class="about__item">
                <div class="about__item-img">
                    <picture><source srcset="/images/about/01.webp" type="image/webp"><img src="/images/about/01.jpg" alt="Photo"></picture>
                </div>
                <div class="about__item-title">
                    Stałe i przejrzyste ceny
                </div>
                <div class="about__item-text">
                    Od razu widzisz ostateczną cenę zamówienia. Wszystkie ceny sprzątania i usług dodatkowych są
                    przedstawione na stronie
                </div>
            </div>
            <div class="about__item">
                <div class="about__item-img">
                    <picture><source srcset="/images/about/02.webp" type="image/webp"><img src="/images/about/02.jpg" alt="Photo"></picture>
                </div>
                <div class="about__item-title">
                    Szybkie i wygodne składanie zamówienia
                </div>
                <div class="about__item-text">
                    Zamówić sprzątanie lub czyszczenie chemiczne można w ciągu jednej minuty. Wskaż ilość pokoi i opcje
                    dodatkowe, wybierz datę i godzinę
                </div>
            </div>
            <div class="about__item">
                <div class="about__item-img">
                    <picture><source srcset="/images/about/03.webp" type="image/webp"><img src="/images/about/03.jpg" alt="Photo"></picture>
                </div>
                <div class="about__item-title">
                    Płatność gotówką lub on-line
                </div>
                <div class="about__item-text">
                    Płatność zawsze po zakończonej usłudze
                </div>
            </div>
            <div class="about__item">
                <div class="about__item-img">
                    <picture><source srcset="/images/about/04.webp" type="image/webp"><img src="/images/about/04.jpg" alt="Photo"></picture>
                </div>
                <div class="about__item-title">
                    Doświadczony zespół
                </div>
                <div class="about__item-text">
                    Wszyscy nasi pracownicy przechodzą rekrutację i szkolenie
                </div>
            </div>
            <div class="about__item">
                <div class="about__item-img">
                    <picture><source srcset="/images/about/05.webp" type="image/webp"><img src="/images/about/05.jpg" alt="Photo"></picture>
                </div>
                <div class="about__item-title">
                    Posprzątane idealnie lub bezpłatnie
                </div>
                <div class="about__item-text">
                    Jeżeli nie spodoba Ci się wykonanie, zrobimy to bezpłatnie
                </div>
            </div>
            <div class="about__item">
                <div class="about__item-img">
                    <picture><source srcset="/images/about/06.webp" type="image/webp"><img src="/images/about/06.jpg" alt="Photo"></picture>
                </div>
                <div class="about__item-title">
                    Regulamin
                </div>
                <div class="about__item-text">
                    Zawsze pracujemy na umowach i wszelkich innych niezbędnych dokumentach
                </div>
            </div>
            <div class="about__item">
                <div class="about__item-img">
                    <picture><source srcset="/images/about/07.webp" type="image/webp"><img src="/images/about/07.jpg" alt="Photo"></picture>
                </div>
                <div class="about__item-title">
                    Punktualność i odpowiedzialność
                </div>
                <div class="about__item-text">
                    Nasi pracownicy przyjeżdżają na czas i traktują swoją pracę odpowiedzialnie
                </div>
            </div>
            <div class="about__item">
                <div class="about__item-img">
                    <picture><source srcset="/images/about/08.webp" type="image/webp"><img src="/images/about/08.jpg" alt="Photo"></picture>
                </div>
                <div class="about__item-title">
                    Program bonusowy
                </div>
                <div class="about__item-text">
                    Mamy zniżki zniżki za regularne sprzątanie i bonusy za zaproszenie znajomych
                </div>
            </div>
            <div class="about__item">
                <div class="about__item-img">
                    <picture><source srcset="/images/about/09.webp" type="image/webp"><img src="/images/about/09.jpg" alt="Photo"></picture>
                </div>
                <div class="about__item-title">
                    Karty podarunkowe
                </div>
                <div class="about__item-text">
                    Opłać online kartę podarunkową i w tej samej chwili dostaniesz ją na maila
                </div>
            </div>
            <div class="about__item">
                <div class="about__item-img">
                    <picture><source srcset="/images/about/10.webp" type="image/webp"><img src="/images/about/10.jpg" alt="Photo"></picture>
                </div>
                <div class="about__item-title">
                    Zamówienie sprzątania tego samego dnia i dostawa kluczy
                </div>
                <div class="about__item-text">
                    Możemy przyjechać do Ciebie już 2 godziny po złożeniu zamówienia
                </div>
            </div>
        </div>
    </div>

    <div class="work _container">
        <div class="work__title">
            Zobacz, jak pracujemy
        </div>
        <div class="slider__container _swiper">            
            <div class="slider__item">
                <picture><source srcset="/images/slider/02.webp" type="image/webp"><img src="/images/slider/02.jpg" alt="Photo"></picture>
            </div>
            <div class="slider__item">
                <picture><source srcset="/images/slider/03.webp" type="image/webp"><img src="/images/slider/03.jpg" alt="Photo"></picture>
            </div>
            <div class="slider__item">
                <picture><source srcset="/images/slider/04.webp" type="image/webp"><img src="/images/slider/04.jpg" alt="Photo"></picture>
            </div>
            <div class="slider__item">
                <picture><source srcset="/images/slider/05.webp" type="image/webp"><img src="/images/slider/05.jpg" alt="Photo"></picture>
            </div>            
            <div class="slider__item">
                <picture><source srcset="/images/slider/07.webp" type="image/webp"><img src="/images/slider/07.jpg" alt="Photo"></picture>
            </div>
            <div class="slider__item">
                <picture><source srcset="/images/slider/08.webp" type="image/webp"><img src="/images/slider/08.jpg" alt="Photo"></picture>
            </div>
        </div>
        <div class="work__instagram">
            <a href="https://www.instagram.com/extra_cleaning.pl/" target="_blank">Obserwuj nas na instagramie</a>
        </div>
    </div>
@endsection
