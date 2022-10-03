<div class="questions _container">
    <div class="questions__title">Często zadawane pytania</div>
    <div class="questions__tabs-list _spollers _one">
    @foreach($faqs as $faq)
        <div class="questions__tabs-item">
            <div class="questions__tabs-title _spoller">{{ $faq->title }}</div>
            <div class="questions__tabs-text">{{ $faq->description }}</div>
        </div>
    @endforeach
    </div>
</div>
