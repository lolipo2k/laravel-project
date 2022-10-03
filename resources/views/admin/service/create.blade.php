@extends('layouts.admin')

@section('content')
    <form action="{{ route('admin.service.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row row-cols-1 row-cols-md-3 g-2">
            <div class="col">
                <div class="card">
                    <div class="card-header">Setting service</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}">

                            @error('title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Menu name</label>
                            <input type="text" class="form-control @error('menu_title') is-invalid @enderror" name="menu_title" value="{{ old('menu_title') }}">

                            @error('menu_title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Price</label>
                            <input type="number" min="1" max="100000" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}">

                            @error('price')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Сleaning time</label>
                            <input type="number" min="0" class="form-control @error('minutes') is-invalid @enderror" name="minutes" value="{{ old('minutes') ?? 0 }}">

                            @error('minutes')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Top index <span class="text-muted">(On the main page, a selection of rooms and bathrooms)</span></label>
                            <select class="form-select" name="top_index">
                                <option value="1" @if(old('top_index') == 1) selected @endif>Yes</option>
                                <option value="0" @if(old('top_index') == 0) selected @endif>No</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Additional services</label>
                            <select class="form-select" name="additionals[]" id="serviceCreateAdditional" multiple>
                                @foreach($additionals as $additional)
                                    <option value="{{ $additional->id }}">{{ $additional->title }} (Price: {{ sprintf("%01.2f", $additional->price) }} zł)</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="cover" class="form-label">Cover</label>
                            <input class="form-control @error('cover') is-invalid @enderror" type="file" id="cover" name="cover">

                            @error('cover')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="menu_icon" class="form-label">Menu Icon</label>
                            <input class="form-control @error('menu_icon') is-invalid @enderror" type="text" id="menu_icon" name="menu_icon" value="{{ old('menu_icon') }}">

                            @error('menu_icon')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card">
                    <div class="card-header">Window</div>
                    <div class="card-body">

                        <div class="mb-3">
                            <label class="form-label">Active</label>
                            <select class="form-select" name="window">
                                <option value="0" @if(old('window') == 0) selected @endif>No</option>
                                <option value="1" @if(old('window') == 1) selected @endif>Yes</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Minimum number of windows</label>
                            <input type="number" min="1" class="form-control" name="window_min" value="{{ old('window_min') }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Price one window</label>
                            <input type="number" class="form-control" name="window_price" value="{{ old('window_price') ?? 20 }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Cleaning time for one window</label>
                            <input type="number" min="0.0" step="0.10" class="form-control" name="window_time" value="{{ old('window_time') ?? 0.5 }}">
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
                                    <option value="1" @if(old('furniture') == 1) selected @endif>Yes</option>
                                    <option value="0" @if(old('furniture') == 0) selected @endif>No</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Furniture</label>
                                <select class="form-select" name="furnitures[]" id="serviceCreateSubs" multiple>
                                    @foreach($furnitures as $furniture)
                                        <option value="{{ $furniture['id'] }}">{{ $furniture['title'] }} (Price: {{ sprintf("%01.2f", $furniture['price']) }} zł)</option>
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
                            <label class="form-label">Active <span class="text-muted">(If top-index is selected it will be selected automatically)</span></label>
                            <select class="form-select" name="apartment">
                                <option value="1" @if(old('apartment') == 1) selected @endif>Yes</option>
                                <option value="0" @if(old('apartment') == 0) selected @endif>No</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Price for one room</label>
                            <input type="number" min="1" class="form-control" name="rooms_price" value="{{ old('rooms_price') ?? 10 }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Cleaning time for one room</label>
                            <input type="number" min="0.0" step="0.10" class="form-control" name="rooms_time" value="{{ old('rooms_time') ?? 0.5 }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Price for one bathroom</label>
                            <input type="number" class="form-control" name="bathrooms_price" value="{{ old('bathrooms_price') ?? 10 }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Cleaning time for one bathroom</label>
                            <input type="number" min="0.0" step="0.10" class="form-control" name="bathrooms_time" value="{{ old('bathrooms_time') ?? 0.5 }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Private house multiplier</label>
                            <input type="number" class="form-control" step="0.10" name="private_house" value="{{ old('private_house') ?? 1.2 }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card">
                    <div class="card-header">Repairs</div>
                    <div class="card-body">

                        <div class="mb-3">
                            <label class="form-label">Active</label>
                            <select class="form-select" name="repairs">
                                <option value="1" @if(old('repairs') == 1) selected @endif>Yes</option>
                                <option value="0" @if(old('repairs') == 0) selected @endif>No</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Cost per m²</label>
                            <input type="number" min="1" class="form-control" name="repair_price" value="{{ old('repair_price') ?? 40 }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Cleaning time for one m²</label>
                            <input type="number" min="0.0" step="0.10" class="form-control" name="repair_time" value="{{ old('repair_time') ?? 0.5 }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Cost per window</label>
                            <input type="number" class="form-control" name="repair_window_price" value="{{ old('repair_window_price') ?? 10 }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Cleaning time for one window</label>
                            <input type="number" min="0.0" step="0.10" class="form-control" name="repair_window_time" value="{{ old('repair_window_time') ?? 0.5 }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Cost per staircase</label>
                            <input type="number" class="form-control" name="repair_stairs_price" value="{{ old('repair_stairs_price') ?? 10 }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-3 w-100">Add</button>
    </form>
@endsection



















































