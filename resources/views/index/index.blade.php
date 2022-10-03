@extends('layouts.app')

@section('content')
    @include('index.top')
    <div class="price _container">
        @include('index.price')
        @include('index.patterns')
    </div>
    @include('index.service')
    @include('index.additional')
    @include('index.work')
    @include('index.reviews')
    @include('index.questions')
@endsection
