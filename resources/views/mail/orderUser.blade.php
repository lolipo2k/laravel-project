<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family:Arial, Helvetica, sans-serif;
            background-color: #fff;
            margin: 0;
            padding: 0;
        }

        table {
            border-spacing: 0px;
        }

        th {
            text-align: center;
        }

        th, td {
            padding: 5px;
        }

        table, th, td {
            width: 100%;
            border: 1px solid rgb(229, 229, 229);
        }

        .header {
            background: #00a0e3;
            color: white;
            padding: 25px 13px;
            margin-bottom: 25px;
        }

        .container {
            margin: 0 auto;
            padding: 0px 15px;
        }

        .order-text {
            color: #00a0e3;
            font-size: 24px;
            font-weight: bold;
        }

        .address-text {
            margin: 20px 0px;
            color: #00a0e3;
        }

        .address {
            border: 2px solid rgb(229, 229, 229);
            padding: 10px;
        }

        .site {
            margin: 15px 0px;
        }
    </style>
</head>
<body>
    <div class="header">
        Dziękujemy za Twoje zamówienie
    </div>

    <div class="container">
        <p>Hej {{ $order['name'] }},</p>
        <p>Właśnie otrzymaliśmy Twoje zamówienie #{{ $order['id'] }} i rozpoczęliśmy jego realizację:</p>
        <p class="order-text">[Zamówienie {{ $order['id'] }}] ({{ \Carbon\Carbon::parse($order['created_at'])->isoFormat('D.m.Y') }})</p>
        <table>
            <tr>
                <th>Nazwa</th>
                <th>Cena</th>
                <th>Ilość</th>
            </tr>

            {{-- Repairs --}}
            @if ($order->service()->first()->repairs)
                <tr>
                    <th colspan="3">Repairs</th>
                </tr>
                <tr>
                    <td>After renovation</td>
                    <td>{{ sprintf("%01.2f", ($order->service()->first()->window_price * $order['repair_m2'])) }} zł</td>
                    <td>{{ $order['repair_m2'] }} &#13217;</td>
                </tr>
                <tr>
                    <td>Windows</td>
                    <td>{{ sprintf("%01.2f", ($order->service()->first()->repair_window * $order['repair_window'])) }} zł</td>
                    <td>{{ $order['repair_window'] }}</td>
                </tr>
                <tr>
                    <td colspan="2">Stairs:</td>
                    <td>{{ $order['repair_stairs'] == 1 ? 'Yes':'No' }}</td>
                </tr>
            @endif

            {{-- Window --}}
            @if ($order->service()->first()->window)
                <tr>
                    <th colspan="3">Window</th>
                </tr>
                <tr>
                    <td>Window</td>
                    <td>{{ sprintf("%01.2f", ($order->service()->first()->window_price * $order['window_count'])) }} zł</td>
                    <td>{{ $order['window_count'] }}</td>
                </tr>
            @endif

            {{-- Apartment --}}
            @if ($order->service()->first()->apartment)
                <tr>
                    <th colspan="3">Apartment</th>
                </tr>
                <tr>
                    <td>Rooms:</td>
                    @if ($order['private_house'] == 1)
                        <td>{{ ($order['rooms'] * $order->service()->first()->rooms_price) * $order->service()->first()->private_house }} zł</td>
                    @else
                        <td>{{ $order['rooms'] * $order->service()->first()->rooms_price }} zł</td>
                    @endif
                    <td>{{ $order['rooms'] }}</td>
                </tr>
                <tr>
                    <td>Bathrooms:</td>
                    @if ($order['private_house'] == 1)
                        <td>{{ ($order['bathrooms'] * $order->service()->first()->bathrooms_price) * $order->service()->first()->private_house }} zł</td>
                    @else
                        <td>{{ $order['bathrooms'] * $order->service()->first()->bathrooms_price }} zł</td>
                    @endif
                    <td>{{ $order['bathrooms'] }}</td>
                </tr>
                <tr>
                    <td colspan="2">A private house:</td>
                    <td>{{ $order['private_house'] == 1 ? 'Yes':'No' }}</td>
                </tr>
            @endif

            {{-- Apps --}}
            @if ($order->apps()->count())
                <tr>
                    <th colspan="3">Additional services</th>
                </tr>

                @foreach($order->apps()->get() as $app)
                    <tr>
                        <td>{{ $loop->iteration }}. {{ $app['title'] }}</td>
                        <td>{{ sprintf("%01.2f", $app['price']) }} zł</td>
                        <td>{{ $app->pivot['count'] }}</td>
                    </tr>
                @endforeach
            @endif

            {{-- Furniture --}}
            @if ($order->furnitures()->count())
                <tr>
                    <th colspan="3">Furnitures services</th>
                </tr>

                @foreach($order->furnitures()->get() as $furniture)
                    <tr>
                        <td>{{ $loop->iteration }}. {{ $furniture['title'] }}</td>
                        <td>{{ sprintf("%01.2f", $furniture['price']) }} zł</td>
                        <td>{{ $furniture->pivot['count'] }}</td>
                    </tr>
                @endforeach
            @endif

            <tr>
                <td colspan="2">Suma:</td>
                <td>{{ sprintf("%01.2f", $order['cost']) }} zł</td>
            </tr>
            <tr>
                <td colspan="2">Metoda płatności:</td>
                <td>{{ $order->pay == 0 ? 'Gotówka':'Kartą online' }}</td>
            </tr>
        </table>
        <div class="address-text">Informacja o zamówieniu</div>
        <div class="address">
            <p>Service: {{ $order->service()->first()->title }}</p>
            <p>Address: ul. {{ $order->address->first()->street }}, dom. {{ $order->address->first()->house_number }}, kw. {{ $order->address->first()->apartment_number }}</p>
            <p>Cleaning date: {{ $order['cleaning_date'] }}</p>
        </div>
        <p class="site">Dziękujemy za korzystanie z <a href="http://extracleaning.pl" target="_blank">extracleaning.pl</a>!</p>
    </div>
</body>
</html>
