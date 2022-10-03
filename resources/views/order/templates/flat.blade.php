@if($service['apartment'])
    <div class="common__options" id="result-common">
        <div class="common__title">
            Twoje mieszkanie
        </div>
        <div class="clean__forms-list">
            <div class="clean__forms-item common__forms-item">
                <div class="clean__minus" id="minus__room">-</div>
                <div class="clean__text" id="room-common">
                    <span id="num__room" data-value="{{ $service['rooms_price'] }}" data-time="{{ $service['rooms_time'] / 60 }}"></span>
                    <span id="room">pokój</span>
                    <input type="hidden" value="{{ old('rooms') ?? request()->get('rooms') ?? 1 }}" id="input__rooms" name="rooms">
                </div>
                <div class="clean__plus" id="plus__room">+</div>
            </div>
            <div class="clean__forms-item common__forms-item">
                <div class="clean__minus" id="minus__bath">-</div>
                <div class="clean__text" id="bath-common">
                    <span id="num__bath" data-value="{{ $service['bathrooms_price'] }}" data-time="{{ $service['bathrooms_time'] / 60 }}"></span>
                    <span id="bath">łazienka</span>
                    <input type="hidden" value="{{ old('bathrooms') ?? request()->get('bathrooms') ?? 1 }}" id="input__bath" name="bathrooms">
                </div>
                <div class="clean__plus" id="plus__bath">+</div>
            </div>
        </div>
        <div class="common__house _frequency">
            <label for="house-1" id="house-price" data-price="{{ $service['private_house'] }}"></label>
            <input type="checkbox" class="service" id="house-1" name="private_house" value="1">
            <p class="_icon-31">Dom prywatny <span>x{{ $service['private_house'] }}</span></p>
        </div>
    </div>
@endif
