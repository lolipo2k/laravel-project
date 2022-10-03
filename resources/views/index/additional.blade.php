<div class="additional _container">
    <div class="additional__title">Usługi dodatkowe</div>
    <div class="additional__list">
        @foreach($additionals as $additional)
            <div class="additional__item _item-main">
                <div class="additional__img">
                    <img src="{{ Storage::url($additional->cover) }}" alt="Photo">
                </div>					 
                <div class="additional__text">
                    {{ $additional['title'] }}
                </div>
                <div class="additional__price">
                    {{ sprintf("%01.2f", $additional['price']) }} zł
                </div>
                <a href="{{ route('order.choice', $additional['service_id']) }}" class="main-additional__link"></a>
            </div>
        @endforeach
    </div>
</div>
