@extends('layouts.admin')

@section('content')
    <div class="row g-4">
        <div class="col-12 col-sm-6 col-xxl-3 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <div class="d-flex align-items-start">
                        <div class="flex-grow-1">
                            <h3 class="mb-2">{{ $users }}</h3>
                            <p class="mb-0">News users</p>
                        </div>
                        <div class="d-inline-block ms-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather align-middle text-success">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xxl-3 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <div class="d-flex align-items-start">
                        <div class="flex-grow-1">
                            <h3 class="mb-2">{{ $orders }}</h3>
                            <p class="mb-0">Orders</p>
                        </div>
                        <div class="d-inline-block ms-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather align-middle text-success">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xxl-3 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <div class="d-flex align-items-start">
                        <div class="flex-grow-1">
                            <h3 class="mb-2">{{ $offices }}</h3>
                            <p class="mb-0">Offices</p>
                        </div>
                        <div class="d-inline-block ms-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather align-middle text-success">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xxl-3 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <div class="d-flex align-items-start">
                        <div class="flex-grow-1">
                            <h3 class="mb-2">{{ $vacancies }}</h3>
                            <p class="mb-0">Vacancies</p>
                        </div>
                        <div class="d-inline-block ms-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather align-middle text-success">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Panel --}}
        <div class="col-12 col-sm-6 d-flex">
            <div class="card flex-fill">
                <div class="card-header border-bottom-0 fw-bold">Платежи</div>
                <div class="card-body">
                    <p class="mb-1">За сегодня: 1 руб.</p>
                    <p class="mb-1">За неделю: 1 руб.</p>
                    <p class="mb-1">За месяц: 1 руб.</p>
                    <p class="mb-0">За все время: 1 руб.</p>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 d-flex">
            <div class="card flex-fill">
                <div class="card-header border-bottom-0 fw-bold">Баланс на кошельках</div>
                <div class="card-body">
                    <p class="mb-1">Заработано за сегодня: 1 руб.</p>
                    <p class="mb-1">Заработано за неделю: 1 руб.</p>
                    <p class="mb-1">Заработано за месяц: 1 руб.</p>
                    <p class="mb-0">Заработано за все время: 1 руб.</p>
                </div>
            </div>
        </div>

    </div>
@endsection
