@extends('layouts.app')

@section('content')
    <order-component
        :service="{{ $service }}"
        :auth="{{ Auth::check() == true ? 1:0 }}"
        @if (Auth::check())
            :userid="{{ json_encode(auth()->id()) }}"
            :addresslist="{{ json_encode(Auth::user()->addresses()->get()) }}"
            :username="{{ json_encode(auth()->user()->name) }}"
            :userphone="{{ json_encode(auth()->user()->phone) }}"
            :useremail="{{ json_encode(auth()->user()->email) }}"
        @endif
    ></order-component>
@endsection
