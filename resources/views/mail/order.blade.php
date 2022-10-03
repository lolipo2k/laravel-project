<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
    <p>Order #{{ $order['id'] }}</p>
    <p>Service: {{ $order->service()->first()->title }}</p>
    <p>Payment: {{ $order->pay == 0 ? 'Cash':'Card' }}</p>
    <p>The cost: {{ sprintf("%01.2f", $order['cost']) }} zł</p>
    <p>Cleaning frequency: {{ $order->sub_id == 0 ? 'Once':$order->sub()->first()->title }}</p>
    <p>Cleaning date: {{ $order['cleaning_date'] }}</p>
    <p>Address: ul. {{ $order->address->first()->street }}, dom. {{ $order->address->first()->house_number }}, kw. {{ $order->address->first()->apartment_number }}</p>
    <p>Created by: {{ $order['created_at'] }}</p>
    @if ($order['information'])
        <p>Order information: {{ $order['information'] }}</p>
    @endif
    <hr>
    @if ($order->service()->first()->apartment)
        <p>Apartment:</p>
        <p>Number of rooms: {{ $order['rooms'] }}</p>
        <p>Number of bathrooms: {{ $order['bathrooms'] }}</p>
        <p>A private house: {{ $order['private_house'] == 1 ? 'Yes':'No' }}</p>
        <p>Aneks kuchenny: {{ $order['kitchen'] == 1 ? 'Yes':'No' }}</p>
    @endif

    @if ($order->service()->first()->window)
        <p>Window:</p>
        <p>Number of windows: {{ $order['window_count'] }}</p>
        <p>Price per window: {{ sprintf("%01.2f", $order->service()->first()->window_price) }} zł</p>
    @endif

    @if ($order->service()->first()->repairs)
        <p>After renovation:</p>
        <p>Area: {{ $order['repair_m2'] }} &#13217;</p>
        <p>Number of windows: {{ $order['repair_window'] }}</p>
        <p>Stairs: {{ $order->repair_stairs ? 'Yes':'No' }}</p>
    @endif

    @if ($order->apps()->count())
        <hr>
        <p>Additional services:</p>

        @foreach($order->apps()->get() as $app)
            <p>{{ $loop->iteration }}) {{ $app['title'] }}: {{ sprintf("%01.2f", $app['price']) }} zł, count: {{ $app->pivot['count'] }}</p>
        @endforeach
    @endif

    @if ($order->furnitures()->count())
        <hr>
        <p>Furniture services:</p>

        @foreach($order->furnitures()->get() as $furniture)
            <p>{{ $loop->iteration }}) {{ $furniture['title'] }}: {{ sprintf("%01.2f", $furniture['price']) }} zł, count: {{ $furniture->pivot['count'] }}</p>
        @endforeach
    @endif

    <hr>
    <p>Customer information:</p>
    <p>Name: {{ $order['name'] }}</p>
    <p>Phone: {{ $order['phone'] }}</p>
    <p>E-Mail: {{ $order['email'] }}</p>
</body>
</html>
