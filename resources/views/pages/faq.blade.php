@extends('layouts.app')

@section('content')
    <div class="questions _container">
        <div class="questions__title">Często zadawane pytania</div>
        @foreach($categories as $category)
            <div class="questions__subtitle">{{ $category->title }}</div>
            <div class="questions__tabs-list _spollers _one">
                @foreach($category->faq()->where('vacancies', 0)->get() as $faq)
                    <div class="questions__tabs-item">
                        <div class="questions__tabs-title _spoller">{{ $faq->title }}</div>
                        <div class="questions__tabs-text">{{ $faq->description }}</div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
@endsection
