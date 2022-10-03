<div class="common__rabat">
    <div class="common__title">Częstsze sprzątanie - większa zniżka</div>
    <div class="common__subtitle">Koszt Twojego następnego zamówienia, jeśli wybierzesz abonament</div>
    <div class="rabat__list">
        @foreach($service->subs()->orderBy('percent')->get() as $sub)
            <div class="rabat__item">
                <label for="rabat-{{ $sub->id }}" class="rabat-label"></label>
                <input type="checkbox" class="service" id="rabat-{{ $sub->id }}" name="sub_id" value="{{ $sub->id }}">
                <div class="rabat__item-top"><span>-{{ $sub->percent }}%</span></div>
                <div class="rabat__item-medium">{{ $sub->title }}</div>
                <div class="rabat__item-bottom">{{ $service->price - ($service->price * $sub->percent / 100) }} zł</div>
            </div>
        @endforeach
    </div>
</div>
