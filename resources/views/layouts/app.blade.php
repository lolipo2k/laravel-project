<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/style.min.css') }}">

    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <title>{{ $title ?? 'no name' }}</title>
</head>
<body>
    <div class="wrapper">
        <header class="header">
            <div class="header__content">
                <div class="header__top__container">
                    <div class="header__top _container">
                        <div class="menu__icon icon-menu">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <div class="header__contacts">
                            <ul class="header__contacts-list">
                                <li class="header__contacts-item">
                                    <a href="https://wa.me/+48794643097" target="_blank" class="link _icon-01 link-desktop">
                                        WhatsApp
                                    </a>
                                    <a href="https://wa.me/+48794643097" target="_blank" class="link _icon-01 link-mobile">
                                    </a>
                                </li>
                                <li class="header__contacts-item">
                                    <a href="https://www.facebook.com/Extra-Cleaning-108367061524638/" target="_blank" class="link _icon-02 link-desktop">
                                        Facebook
                                    </a>
                                    <a href="https://www.facebook.com/Extra-Cleaning-108367061524638/" target="_blank" class="link _icon-02 link-mobile">
                                    </a>
                                </li>
                                <li class="header__contacts-item">
                                    <a href="https://www.instagram.com/extra_cleaning.pl/" target="_blank" class="link _icon-03 link-desktop">
                                        Instagram
                                    </a>
                                    <a href="https://www.instagram.com/extra_cleaning.pl/" target="_blank" class="link _icon-03 link-mobile">
                                    </a>
                                </li>
                                <li class="header__contacts-item">
                                    <a href="tel:+48794643097" class="link _icon-04">
                                        +48 794 643 097
                                    </a>
                                    @guest
                                        <a href="{{ route('login') }}" class="link _icon-05 link-mobile"></a>
                                    @else
                                        <a href="{{ route('profile.index') }}" class="link _icon-05 link-mobile"></a>
                                    @endguest
                                </li>
                            </ul>
                        </div>
                        <div class="header__user">
                            @guest
                                <div class="header__login">
                                    <a href="{{ route('login') }}" class="link">Login</a>
                                </div>
                                <div class="header__login">
                                    <a href="{{ route('register') }}" class="link">Register</a>
                                </div>
                            @else
                                <div class="header__user-name">
                                    <a href="{{ route('profile.index') }}" class="link link-desktop">{{ Auth::user()->name }}</a>
                                </div>
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
            <div class="header__bottom _container">
                <div class="header__logo">
                    <a href="/">
                        <img src="/images/logo.png" alt="logo">
                    </a>
                </div>
                <div class="header__menu menu">
                    <nav class="header__menu menu__body">
                        <ul class="header__menu-list menu__list">
                            @foreach($menuServices as $service)
                                <li class="header__menu-item">
                                    <a href="{{ route('order.choice', $service['id']) }}" class="link menu__link {{ $service->menu_icon }}">
                                        {{ $service->menu_title }}
                                    </a>
                                </li>
                            @endforeach
                            <li class="header__menu-item">
                                <a href="{{ route('office') }}" class="link menu__link _icon-11">
                                    Biuro
                                </a>
                            </li>
                        </ul>
                        <div class="menu__drop" id="config-btn">
                            <ul class="drop-list">
                                <li class="drop-item">
                                    <a href="{{ route('about') }}" class="link">
                                        O nas
                                    </a>
                                </li>
                                <li class="drop-item">
                                    <a href="{{ route('price') }}" class="link">
                                        Cennik
                                    </a>
                                </li>
                                <li class="drop-item">
                                    <a href="{{ route('faq') }}" class="link">
                                        Pytania i odpowiedzi
                                    </a>
                                </li>
                                <li class="drop-item">
                                    <a href="{{ route('review') }}" class="link">
                                        Opinie
                                    </a>
                                </li>
                                <li class="drop-item">
                                    <a href="{{ route('office') }}" class="link">
                                        Propozycje dla biznesu
                                    </a>
                                </li>
                                <li class="drop-item">
                                    <a href="{{ route('vacancy') }}" class="link">
                                        Praca
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
                <div class="header__button-menu" id="hider">
                    <div class="button__menu-item">Menu</div>
                    <div class="_icon-18"></div>
                </div>
            </div>
        </header>

        <main class="page" id="app">
            @yield('content')

            @if ($defaultService && !Request::is('order/*') && !Request::is('vacancy'))
                <div class="order _container" style="background-image: url('/images/bg_footer.png')">
                    <div class="order__title">Zamów sprzątanie mieszkania</div>
                    <form action="{{ route('order.choice', $defaultService->id) }}" class="order__form">
                        <div class="order__forms-list">
                            <div class="order__forms-item">
                                <div class="order__minus" id="minus__room-1">-</div>
                                <div class="order__text">
                                    <span id="num__room-1">1</span>
                                    <span id="room-1">pokój</span>
                                    <input type="hidden" name="rooms" id="input__rooms-1">
                                </div>
                                <div class="order__plus" id="plus__room-1">+</div>
                            </div>
                            <div class="order__forms-item">
                                <div class="order__minus" id="minus__bath-1">-</div>
                                <div class="order__text">
                                    <span id="num__bath-1">1</span>
                                    <span id="bath-1">łazienka</span>
                                    <input type="hidden" name="bathrooms" id="input__bath-1">
                                </div>
                                <div class="order__plus" id="plus__bath-1">+</div>
                            </div>
                        </div>
                        <div class="order__button _btn">
                            <button type="submit">Policz koszty</button>
                        </div>
                    </form>
                </div>
            @endif
        </main>

        <footer class="footer">
            <div class="footer__content _container">
                <div class="footer__logo">
                    <a href="#"><picture><source srcset="/images/logo.webp" type="image/webp"><img src="/images/logo.png" alt="Logo"></picture></a>
                </div>
                <div class="footer__contacts">
                    <div class="footer__contacts-item">
                        <a href="tel:+48794643097" class="link _icon-12">+48 794 643 097</a>
                    </div>
                    <div class="footer__contacts-item">
                        <a href="mailto:extracleaningspzoo@gmail.com" class="link _icon-13">extracleaningspzoo@gmail.com</a>
                    </div>
                    <div class="footer__contacts-item">
                        <a href="https://www.google.com/maps/place/Leonidasa+50A,+02-239+Warszawa/data=!4m2!3m1!1s0x4719335faaf086cd:0xcf4d597af894c42?sa=X&ved=2ahUKEwjJkcKu5OLxAhXho4sKHXZlDXkQ8gF6BAgIEAE" target="_blank" class="link _icon-14">Leonidasa 50a, 02-239 Warszawa</a>
                    </div>
                </div>
            </div>
            <div class="footer__visa-bg">
                <div class="footer__visa _container">
                    <div class="footer__visa-text">
						  Extra Cleaning Sp. z o.o., KRS 0000881802, NIP: 5223197195, REGON: 388148785
						  Leonidasa 50a, 02-239 Warszawa
                    </div>
                    <div class="footer__visa-img">
                        <div class="img-1">
                            <picture><source srcset="/images/footer/01.webp" type="image/webp"><img src="/images/footer/01.png" alt="Photo"></picture>
                        </div>
                        <div class="img-2">
                            <picture><source srcset="/images/footer/02.webp" type="image/webp"><img src="/images/footer/02.png" alt="Photo"></picture>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer__rights _container">
                <div class="footer__rights-text">
                    2021 All rights reserved
                    | Created by: <a href="https://www.mx-studio.pl/" target="_blank" class="link">MX&nbsp;Studio</a>
                </div>
                <div class="footer__rights-links">
                    <div class="footer__rights-link">
                        <a href="/docs/Regulamin.pdf" target="_blank" class="link">Regulamin</a>
                    </div>
                    <div class="footer__rights-link">
                        <a href="#" class="link">Polityka cookies</a>
                    </div>
                    <div class="footer__rights-link">
                        <a href="/docs/Polityka-prywatnosci.pdf" class="link">Polityka prywatności</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script src="{{ asset('js/vendors.min.js') }}" defer></script>
    <script src="{{ asset('js/test.js') }}" defer></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
