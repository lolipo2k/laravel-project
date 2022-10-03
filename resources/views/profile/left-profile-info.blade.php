<div class="panel__left">
    <div class="panel__konto">
        <div class="konto__img">
            <picture><source srcset="/images/panel/01.webp" type="image/webp"><img src="/images/panel/01.png" alt="Photo"></picture>
        </div>
        <div class="panel__user"><a href="{{ route('profile.edit') }}" class="link">Edytuj konto</a></div>
        <div class="panel__user"><a href="{{ route('logout') }}" class="link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Wyloguj</a></div>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>

    <div class="panel__bottom">
        <div class="panel__bottom-txt">
            Podziel się z przyjaciółmi i dostań dodatkowe pieniądze na sprzątanie.
        </div>
        <div class="panel__bottom-links">
            fafaAWf
        </div>
    </div>
</div>
