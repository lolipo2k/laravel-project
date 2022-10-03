<div class="common__subtitle">
    Nasi pracownicy posiadają wszystkie niezbędne środki czystości, narzędzia oraz odkurzacz
</div>
<div class="common__form-pay">
{{--    <div class="common__price">--}}
{{--        {{ $service->title }} <span>{{ sprintf("%01.2f", $service['price']) }} zł</span>--}}
{{--    </div>--}}
    <div class="common__price" id="time-repair-common">
        Przybliżony czas sprzątania <span>~ </span><span id="time-repair" data-starttime="{{ $service['minutes'] / 60 }}">0</span>
        <span>godz.</span>
    </div>
	 <div class="common__price">
		 	Minimalny koszt zamówienia 100zł
		 </div>
         <div class="cart__listing__all">
             <h2>Usługi dodatkowe</h2>
         <div class="cart__listing">
         </div>
         </div>
         <div class="promocode__wrap">
        <span> Kod rabatowy</span>
        <div class="promocode">
            <input type="text" placeholder="Wpisz kod rabatowy" id="promocode__inp" name="promocode">
            <button id="promocode__btn">Zastosuj</button>
        </div>
    @php
        foreach(DB::table('promocodes')->get() as $row)
        {
            $namePromo= $row->name;
            $idPromo = $row->id;
            $percentPromo = $row->percent;
            echo '<p class="wrapPromos" style="display:none">' . '<span class="namesPromos">'. ($row->name). '</span>'. '<br>' . '<span class="percentPromos">' . ($row->percent). '</span>' . '</p>';
        }
    @endphp
    </div>
    <div class="common__pay">
        <div class="pay__price-text">
            Do zapłaty:
        </div>
        <div class="pay__price-number">
            <div class="last-result"><span class="last-result-span"></span>zł</div>
            <span id="result" data-start="{{ $service['price'] }}">0</span> <span>zł</span>
        </div>
    </div>
	 <div class="common__pay _mobile">
							<div class="pay__price-text">
								Do zapłaty:
							</div>
							<div class="pay__price-number">
								<span id="result-mobile"></span><span>zł</span>
							</div>
						</div>
    <div class="_container">
        <div class="pay__btn _btn">
            <button type="submit" form="form-choice">Zamów</button>
        </div>
    </div>
</div>
