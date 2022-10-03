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
