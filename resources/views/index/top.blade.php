@if($top_index_service)
    <div class="bg" style="background-image: url('/images/bg.png');">
        <div class="clean__price _container">
            <h1 class="clean__title">
                Sprzątanie mieszkania
            </h1>
            <div class="clean__subtitle">Usługa obejmuje kuchnię, łazienkę, pokoje oraz przedpokój
            </div>
            <form action="{{ route('order.choice', $top_index_service->id) }}" class="clean__form">
                <div class="clean__forms-list">
                    <div class="clean__forms-item">
                        <div class="clean__minus" id="minus__room">-</div>
                        <div class="clean__text">
                            <span id="num__room">1</span>
                            <span id="room">pokój</span>
                            <input type="hidden" value="1" id="input__rooms" name="rooms">
                        </div>
                        <div class="clean__plus" id="plus__room">+</div>
                    </div>
                    <div class="clean__forms-item">
                        <div class="clean__minus" id="minus__bath">-</div>
                        <div class="clean__text">
                            <span id="num__bath">1</span>
                            <span id="bath">łazienka</span>
                            <input type="hidden" value="1" id="input__bath" name="bathrooms">
                        </div>
                        <div class="clean__plus" id="plus__bath">+</div>
                    </div>
                </div>
                <div class="clean__button _btn">
                    <button type="submit">Policz koszty</button>
                </div>
            </form>
        </div>
    </div>
@endif
