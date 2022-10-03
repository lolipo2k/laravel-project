@extends('layouts.admin')

@section('content')
    <div class="row g-2">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Order #{{ $order->id }}</div>
                <div class="card-body">
                    <table class="table table-borderless mb-0">
                        <tbody>
                            <tr>
                                <th>Service</th>
                                <td>{{ $order->service()->first()->title }}</td>
                            </tr>
                            <tr>
                                <th>Payment</th>
                                @if ($order->pay == 0)
                                    <td>Cash</td>
                                @else
                                    @if ($order->payment()->first()->status == 1)
                                        <td>Paid up</td>
                                    @else
                                        <td>Not paid</td>
                                    @endif
                                @endif
                            </tr>
                            <tr>
                                <th>The cost</th>
                                <td>{{ $order->cost }} zł</td>
                            </tr>
                            <tr>
                                <th>Cleaning date</th>
                                <td>{{ \Carbon\Carbon::parse($order->cleaning_date)->isoFormat("LL HH:mm") }}</td>
                            </tr>
                            <tr>
                                <th>Cleaning frequency</th>

                                @if ($order->sub_id == 0)
                                    <td>Once</td>
                                @else
                                    <td>{{ $order->sub()->first()->title }}</td>
                                @endif
                            </tr>
                            <tr>
                                <th>Keys:</th>
                                @if ($order->keys == 1)
                                    <td>One way</td>
                                @elseif ($order['keys'] == 2)
                                    <td>In two directions</td>
                                @else
                                    <td>None</td>
                                @endif
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card">
                <div class="card-header">Addresses</div>
                <div class="card-body">
                    <table class="table table-borderless mb-0">
                        <tbody>
                            <tr>
                                <th>Street</th>
                                <td>{{ $order->address->first()->street }}</td>
                            </tr>
                            <tr>
                                <th>House</th>
                                <td>{{ $order->address->first()->house_number }}</td>
                            </tr>
                            <tr>
                                <th>Apartment</th>
                                <td>{{ $order->address->first()->apartment_number }}</td>
                            </tr>
                            <tr>
                                <th>Entrance</th>
                                <td>{{ $order->address->first()->entrance }}</td>
                            </tr>
                            <tr>
                                <th>Floor</th>
                                <td>{{ $order->address->first()->floor }}</td>
                            </tr>
                            <tr>
                                <th>Intercom</th>
                                <td>{{ $order->address->first()->intercom }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card">
                <div class="card-header">Additional services [{{ $order->apps()->count() }}]</div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead class="table-dark">
                        <tr>
                            <th>Title</th>
                            <th>Price</th>
                            <th>Count</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($order->apps()->get() as $app)
                            <tr>
                                <th scope="row">{{ $app->title }}</th>
                                <td>{{ $app->price }} zł</td>
                                <td>{{ $app->pivot['count'] }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card">
                <div class="card-header">Furnitures [{{ $order->furnitures->count() }}]</div>
                <div class="card-body">
                    <table class="table table-borderless table-hover">
                        <thead class="table-dark">
                        <tr>
                            <th>Title</th>
                            <th>Price</th>
                            <th>Count</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($order->furnitures()->get() as $furniture)
                            <tr>
                                <th scope="row">{{ $furniture['title'] }}</th>
                                <td>{{ $furniture['price'] }} zł</td>
                                <td>{{ $furniture->pivot['count'] }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @if ($order->information)
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">Order information</div>
                    <div class="card-body">{{ $order->information }}</div>
                </div>
            </div>
        @endif

        <div class="col-md-3">
            <div class="card">
                <div class="card-header">Contact (<a href="{{ route('admin.users.show', $order->user()->first()->id) }}">Go to user</a>)</div>
                <div class="card-body">
                    <table class="table table-borderless mb-0">
                        <tbody>
                            <tr>
                                <th>Name</th>
                                <td>{{ $order->name }}</td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td>{{ $order->phone }}</td>
                            </tr>
                            <tr>
                                <th>E-Mail</th>
                                <td>{{ $order->email }}</td>
                            </tr>
                            <tr>
                                <th>User registered</th>
                                <td>{{ $order->user()->first()->created_at }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @if ($order->window)
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">Window</div>
                    <div class="card-body">
                        <table class="table table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <th>Number of windows</th>
                                    <td>{{ $order->window_count }}</td>
                                </tr>

                                <tr>
                                    <th>Cost per window</th>
                                    <td>{{ $order->service()->first()->window_price }} zł</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif

        @if ($order->service()->first()->apartment)
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">Apartment</div>
                    <div class="card-body">
                        <table class="table table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <th>Number of rooms</th>
                                    <td>{{ $order->rooms }}</td>
                                </tr>

                                <tr>
                                    <th>Number of bathrooms</th>
                                    <td>{{ $order->bathrooms }}</td>
                                </tr>

                                <tr>
                                    <th>A private house</th>
                                    <td>{{ $order['private_house'] == 1 ? 'Yes':'No' }}</td>
                                </tr>

                                <tr>
                                    <th>kitchen</th>
                                    <td>{{ $order['kitchen'] == 1 ? 'Yes':'No' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif

        @if ($order->service()->first()->repairs)
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">After renovation</div>
                    <div class="card-body">
                        <table class="table table-borderless mb-0">
                            <tbody>
                            <tr>
                                <th>m²</th>
                                <td>{{ $order->repair_m2 }}</td>
                            </tr>

                            <tr>
                                <th>Number of windows</th>
                                <td>{{ $order->repair_window }}</td>
                            </tr>

                            <tr>
                                <th>Stairs</th>
                                <td>{{ $order->repair_stairs ? 'Yes':'No' }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif

    </div>
@endsection
