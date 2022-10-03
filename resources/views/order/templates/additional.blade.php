@if ($service->apps()->count())
    <div class="common__title add-title">Dodatkowe usługi</div>
    <div class="additional__list">
        @foreach($service->apps()->get() as $app)
            <div class="additional__item add-service">
                <label class="additional__label" for="app_{{ $app['id'] }}" data-value="{{ $app['price'] }}" data-time="{{ $app['minutes'] / 60 }}"></label>
                <input type="checkbox" class="service" id="app_{{ $app['id'] }}" name="additionals[{{ $app['id'] }}]" value="{{ $app['id'] }}">
                <div class="additional__img">
                    <img src="{{ Storage::url($app['cover']) }}" alt="Photo">
                </div>
                @if ($app['multi'])
                    <div class="add-form__item">
                        <div class="clean__minus add-minus" data-time="{{ $app['minutes'] / 60 }}" data-value="{{ $app['price'] }}">-</div>
                        <span class="add-inner">1</span>
                        <div class="clean__plus add-plus" data-time="{{ $app['minutes'] / 60 }}" data-value="{{ $app['price'] }}">+</div>
                        <input type="hidden" value="1" class="add-input" name="additionals_counts[{{ $app['id'] }}]">
                    </div>
                @else
                    <div class="add-form__item _single">
                        <input type="hidden" class="add-input" value="1" name="additionals_counts[{{$app['id']}}]">
                    </div>
                @endif
                <div class="additional__text">
                    {{ $app['title'] }}
                </div>
                <div class="additional__price">
                    {{ sprintf("%01.2f", $app['price']) }} zł
                </div>
            </div>
        @endforeach
    </div>
    <div class="common-showmore" id="show-more__add">
        Zobacz więcej
    </div>
@endif
