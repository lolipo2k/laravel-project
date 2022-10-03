@if ($service['window'])
<div class="window" id="result-window">
	<div class="common__title">
		Wybierz odpowiednią ilość okien
	</div>
	<div class="window__img">
		<img src="/images/window/01.jpg" alt="Photo">
	</div>
	<div class="clean__forms-item common__forms-item window">
		<div class="clean__minus" id="minus__wind">-</div>
		<div class="clean__text">
			<span id="num__wind" data-value="{{ $service['window_price'] }}" data-time="{{ $service['window_time'] / 60 }}"
				data-min="{{ $service['window_min'] }}">{{ $service['window_min'] }}</span>
			<span id="wind">okien</span>
			<input type="hidden" value="{{ $service['window_min'] }}" id="input__wind" name="window_count">
		</div>
		<div class="clean__plus" id="plus__wind">+</div>
	</div>
	<div class="price__window">
		<p class="_icon-33">Koszt mycia jednego okna <span>{{ sprintf("%01.2f", $service['window_price']) }} zł</span></p>
	</div>
	<div class="common-count _spollers">
		<div class="common__tab-item">
			<div class="common__tabs-title _spoller">
				<p>Jak liczymy ilość okien</p>
			</div>
			<div class="common__tabs-list">
				<div class="common-tab">
					<div class="common__tabs-item">
						<div class="common-tabs__img">
							<img src="/images/window/02.jpg" alt="">
						</div>
						<div class="common-tabs__text">
							jedno okno
						</div>
					</div>
					<div class="common__tabs-item">
						<div class="common-tabs__img">
							<img src="/images/window/03.jpg" alt="">
						</div>
						<div class="common-tabs__text">
							pół okna
						</div>
					</div>
					<div class="common__tabs-item">
						<div class="common-tabs__img">
							<img src="/images/window/04.jpg" alt="">
						</div>
						<div class="common-tabs__text">
							1,5 okna
						</div>
					</div>
					<div class="common__tabs-item">
						<div class="common-tabs__img">
							<img src="/images/window/05.jpg" alt="">
						</div>
						<div class="common-tabs__text">
							2 okna
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	{{-- <div class="common__text">--}}
		{{-- <div class="common__text-item">* Minimalna liczba okien to {{ $service['window_min'] }}. Jeżeli masz mniej
			okien, zamów--}}
			{{-- sprzątanie jednopokojowego mieszkania i wskaż ich odpowiednią ilość</div>--}}
		{{-- </div>--}}
</div>
@endif
