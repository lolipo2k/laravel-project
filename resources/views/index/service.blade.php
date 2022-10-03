<div class="services _container">
    <div class="services__title">
        Nasze usługi
    </div>
    <div class="services__img-list">
        @foreach($services as $service)
            <div class="sevices__img-item">
                <div class="services-img"><img src="{{ Storage::url($service->cover) }}" alt="Photo"></div>					 
                <div class="services-text">{{ $service->title }}</div>
                <a href="{{ route('order.choice', $service['id']) }}" class="link main-additional__link"></a>
            </div>
        @endforeach
    </div>
</div>
