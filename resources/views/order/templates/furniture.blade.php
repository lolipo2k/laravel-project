@if ($service['furniture'] && $service->furnitures->count())
    <div class="common__title main-title">Wybierz usługi</div>
    <div class="additional__list">
        @foreach($service->furnitures()->get() as $furniture)
            <div class="additional__item hide-service">
                <label for="service_{{ $furniture['id'] }}" class="additional__label" data-value="{{ $furniture['price'] }}" data-time="{{ $furniture['minutes'] / 60 }}"></label>
                <input type="checkbox" class="service" id="service_{{ $furniture['id'] }}" name="furnitures[]" value="{{ $furniture['id'] }}" autocomplete="off">
                <div class="additional__img">
                    <img src="{{ Storage::url($furniture['cover']) }}" alt="Photo">
                </div>
                @if ($furniture['multi'])
                    <div class="add-form__item">
                        <div class="clean__minus add-minus" data-time="{{ $furniture['minutes'] / 60 }}" data-value="{{ $furniture['price'] }}">-</div>
                        <span class="add-inner">1</span>
                        <div class="clean__plus add-plus" data-time="{{ $furniture['minutes'] / 60 }}" data-value="{{ $furniture['price'] }}">+</div>
                        <input type="hidden" value="1" class="add-input" name="furnitures_counts[]">
                    </div>
                @else
                    <div class="add-form__item _single">
                        <input type="hidden" class="add-input" value="1" name="furnitures_counts[]">
                    </div>
                @endif
                <div class="additional__text">
                    {{ $furniture['title'] }}
                </div>
                <div class="additional__price">
                    {{ sprintf("%01.2f", $furniture['price']) }} zł
                </div>
            </div>
        @endforeach
    </div>
	 <div class="common-showmore" id="show-more">
        Zobacz więcej
    </div>
@endif
