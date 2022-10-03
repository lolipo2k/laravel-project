@if ($service->repairs)
    <div class="common__options" id="result-repair">
        <div class="common__title">Mieszkanie po remoncie</div>
        <div class="clean__forms-list">
            <div class="clean__forms-item common__forms-item repair">
                <div class="clean__item-top">
                    <div class="clean__minus" id="minus__square">-</div>
                    <div class="clean__text">
                        <span id="num__square" data-time="{{ $service['repair_time'] / 60 }}" data-value="{{ $service['repair_price'] }}" data-result="1">0</span>
                        <span>m²</span>
                        <input type="hidden" value="0" id="input__square" name="repair_m2">
                    </div>
                    <div class="clean__plus" id="plus__square">+</div>
                </div>
                <div class="clean__item-bottom _btn">{{ sprintf("%01.2f", $service->repair_price) }} zł /m²</div>
            </div>

            <div class="clean__forms-item common__forms-item repair">
                <div class="clean__item-top">
                    <div class="clean__minus" id="minus__window">-</div>
                    <div class="clean__text">
                        <span id="num__window" data-time="{{ $service['repair_window_time'] / 60 }}" data-value="{{ $service['repair_window_price'] }}" data-result="1">0</span>
                        <span id="window">okien</span>
                        <input type="hidden" value="0" id="input__window" name="repair_window">
                    </div>
                    <div class="clean__plus" id="plus__window">+</div>
                </div>
                <div class="clean__item-bottom _btn">{{ sprintf("%01.2f", $service->repair_window_price) }} zł</div>
            </div>
        </div>

        <div class="common__house">
            <label for="stair" id="stairs" data-price="{{ $service['repair_stairs_price'] }}"></label>
            <input type="checkbox" class="service" id="stair" name="repair_stairs">
            <p class="_icon-32">Potrzebna drabina<span>{{ sprintf("%01.2f", $service['repair_stairs_price']) }} </span><span>zł</span></p>
        </div>
    </div>
@endif
