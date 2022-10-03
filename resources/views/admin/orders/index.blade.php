@extends('layouts.admin')

@section('content')
    <table class="table table-borderless table-hover">
        <caption>{{ $orders->links() }}</caption>
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Service</th>
                <th>Pay</th>
                <th>Cost</th>
                <th>Additional services</th>
                <th>Cleaning frequency</th>
                <th>Cleaning date</th>
                <th></th>
            </tr>
        </thead>
        <tbody class="align-middle">
            @foreach($orders as $order)
                <tr class="@if ($order->status == 1) table-success @endif">
                    <th scope="row">{{ $order->id }}</th>
                    <td><a href="{{ route('admin.users.show', $order->user()->first()->id) }}">{{ $order->user()->first()->name }}</a></td>
                    <td>fwa</td>

                    @if ($order->pay == 0)
                        <td>Cash</td>
                    @else
                        @if ($order->payment()->first()->status == 1)
                            <td>[CARD] Pay</td>
                        @else
                            <td>[CARD] No pay</td>
                        @endif
                    @endif

                    <td>{{ $order->cost }} zł</td>
                    <td>{{ $order->apps()->count() }} apps</td>

                    @if ($order->sub_id)
                        <td>{{ $order->sub()->first()->title }}</td>
                    @else
                        <td>One-time</td>
                    @endif

                    <td>{{ \Carbon\Carbon::parse($order->cleaning_date)->isoFormat('LLLL') }}</td>
                    <th>
                        <a class="btn btn-primary btn-sm" href="{{ route('admin.orders.show', $order) }}" role="button">Detail</a>
                    </th>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
