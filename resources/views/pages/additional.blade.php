@extends('layouts.app')

@section('content')
    <div class="services _container">
        <div class="services__title _title">{{ $app->title }}</div>

        <div class="price__wind">
            <div class="wing__img">
                <img src="{{ Storage::url($app->big_cover) }}" alt="Photo">
            </div>
            <div class="wind__text">{{ $app->description }}</div>
            <div class="wind__price">{{ sprintf("%01.2f", $app->price) }} zł</div>
        </div>
    </div>
@endsection
