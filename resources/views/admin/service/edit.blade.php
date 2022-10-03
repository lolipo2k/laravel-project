@extends('layouts.admin')

@section('content')
    <form action="{{ route('admin.service.update', $service) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row g-2">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Setting service</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') ?? $service->title }}">

                            @error('title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Menu name</label>
                            <input type="text" class="form-control @error('menu_title') is-invalid @enderror" name="menu_title" value="{{ old('menu_title') ?? $service->menu_title }}">

                            @error('menu_title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Price</label>
                            <input type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') ?? $service->price }}">

                            @error('price')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Сleaning time</label>
                            <input type="number" min="0" class="form-control" name="minutes" value="{{ old('minutes') ?? $service->minutes }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Top index <span class="text-muted">(On the main page, a selection of rooms and bathrooms)</span></label>
                            <select class="form-select" name="top_index">
                                <option value="1" @if($service['top_index'] == 1) selected @endif>Yes</option>
                                <option value="0" @if($service['top_index'] == 0) selected @endif>No</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Additional services</label>
                            <select class="form-select" name="additionals[]" id="serviceCreateAdditional" multiple>
                                @foreach($additionals as $additional)
                                    <option value="{{ $additional->id }}" @if($service->apps->contains($additional->id)) selected @endif>{{ $additional->title }} (Price: {{ sprintf("%01.2f", $additional->price) }} zł)</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="cover" class="form-label">Cover<span class="text-muted ms-1">(Do not select a picture if you do not change)</span></label>
                            <input class="form-control" type="file" id="cover" name="cover">
                        </div>

                        <div class="mb-3">
                            <label for="menu_icon" class="form-label">Menu Icon<span class="text-muted ms-1">(Do not select a picture if you do not change)</span></label>
                            <input class="form-control" type="file" id="menu_icon" name="menu_icon">
                        </div>

                        <div class="mb-3">
                            <label for="menu_icon" class="form-label">Menu Icon</label>
                            <input class="form-control @error('menu_icon') is-invalid @enderror" type="text" id="menu_icon" name="menu_icon" value="{{ old('menu_icon') ?? $service['menu_icon'] }}">

                            @error('menu_icon')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Window</div>
                    <div class="card-body">

                        <div class="mb-3">
                            <label class="form-label">Active</label>
                            <select class="form-select" name="window">
                                <option value="0" @if ($service->window == 0) selected @endif>No</option>
                                <option value="1" @if ($service->window == 1) selected @endif>Yes</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Minimum number of windows</label>
                            <input type="number" min="1" class="form-control" name="window_min" value="{{ old('window_min') ?? $service->window_min }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Price one window</label>
                            <input type="number" class="form-control" name="window_price" value="{{ old('window_price') ?? $service->window_price }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Cleaning time for one window</label>
                            <input type="number" min="0.0" step="0.10" class="form-control" name="window_time" value="{{ old('window_time') ?? $service['window_time'] }}">
                        </div>

                    </div>
                </div>

                <div class="col mt-3">
                    <div class="card">
                        <div class="card-header">Furniture</div>
                        <div class="card-body">

                            <div class="mb-3">
                                <label class="form-label">Active</label>
                                <select class="form-select" name="furniture">
                                    <option value="1" @if($service['furniture'] == 1) selected @endif>Yes</option>
                                    <option value="0" @if($service['furniture'] == 0) selected @endif>No</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Furniture</label>
                                <select class="form-select" name="furnitures[]" id="serviceCreateSubs" multiple>
                                    @foreach($furnitures as $furniture)
                                        <option value="{{ $furniture['id'] }}" @if ($service->furnitures->contains($furniture['id'])) selected @endif>{{ $furniture['title'] }} (Price: {{ sprintf("%01.2f", $furniture['price']) }} zł)</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-header">Apartment</div>
                    <div class="card-body">

                        <div class="mb-3">
                            <label class="form-label">Active</label>
                            <select class="form-select" name="apartment">
                                <option value="1" @if($service->apartment == 1) selected @endif>Yes</option>
                                <option value="0" @if($service->apartment == 0) selected @endif>No</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Price for one room</label>
                            <input type="number" min="1" class="form-control" name="rooms_price" value="{{ old('rooms_price') ?? $service->rooms_price }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Cleaning time for one room</label>
                            <input type="number" min="0.0" step="0.10" class="form-control" name="rooms_time" value="{{ old('rooms_time') ?? $service['rooms_time'] }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Price for one bathroom</label>
                            <input type="number" class="form-control" name="bathrooms_price" value="{{ old('bathrooms_price') ?? $service->bathrooms_price }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Cleaning time for one bathroom</label>
                            <input type="number" min="0.0" step="0.10" class="form-control" name="bathrooms_time" value="{{ old('bathrooms_time') ?? $service['bathrooms_time'] }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Private house multiplier</label>
                            <input type="number" class="form-control" step="0.10" name="private_house" value="{{ old('private_house') ?? $service['private_house'] }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Repairs</div>
                    <div class="card-body">

                        <div class="mb-3">
                            <label class="form-label">Active</label>
                            <select class="form-select" name="repairs">
                                <option value="1" @if($service->repairs == 1) selected @endif>Yes</option>
                                <option value="0" @if($service->repairs == 0) selected @endif>No</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Cost per m²</label>
                            <input type="number" min="1" class="form-control" name="repair_price" value="{{ old('repair_price') ?? 40 }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Cleaning time for one m²</label>
                            <input type="number" min="0.0" step="0.10" class="form-control" name="repair_time" value="{{ old('repair_time') ?? $service['repair_time'] }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Cost per window</label>
                            <input type="number" class="form-control" name="repair_window_price" value="{{ old('repair_window_price') ?? 10 }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Cleaning time for one window</label>
                            <input type="number" min="0.0" step="0.10" class="form-control" name="repair_window_time" value="{{ old('repair_window_time') ?? $service['repair_window_time'] }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Cost per staircase</label>
                            <input type="number" class="form-control" name="repair_stairs_price" value="{{ old('repair_stairs_price') ?? 10 }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-3 w-100">Save</button>
    </form>
@endsection



















































