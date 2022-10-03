@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">Edit additional</div>
        <div class="card-body">
            <form action="{{ route('admin.additional.update', $additional) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">

                    <div class="mb-3 col-md-3">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') ?? $additional->title }}">

                        @error('cover')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-2">
                        <label class="form-label">Price</label>
                        <input type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') ?? $additional->price }}">

                        @error('cover')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-2">
                        <label class="form-label">Cleaning time <span class="text-muted">(In minutes)</span></label>
                        <input type="number" min="1" class="form-control @error('minutes') is-invalid @enderror" name="minutes" value="{{ old('minutes') ?? $additional->minutes }}">

                        @error('cover')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-3">
                        <label class="form-label">Service</label>
                        <select class="form-select" name="service_id">
                            @foreach($services as $service)
                                <option value="{{ $service['id'] }}" @if ($service['id'] == $additional['service_id']) selected @endif>{{ $service['title'] }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3 col-md-2">
                        <label class="form-label">Multi</label>
                        <select class="form-select" name="multi">
                            <option value="1" @if ($additional['multi'] == 1) selected @endif>Yes</option>
                            <option value="0" @if ($additional['multi'] == 0) selected @endif>No</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" rows="5" name="description">{{ old('description') ?? $additional->description }}</textarea>

                    @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="cover" class="form-label">Cover<span class="text-muted ms-1">(Do not select a picture if you do not change)</span></label>
                    <input class="form-control @error('cover') is-invalid @enderror" type="file" id="cover" name="cover">

                    @error('cover')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="big_cover" class="form-label">Big cover<span class="text-muted ms-1">(Do not select a picture if you do not change)</span></label>
                    <input class="form-control @error('big_cover') is-invalid @enderror" type="file" id="big_cover" name="big_cover">

                    @error('cover')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary mt-3 w-100">Update</button>
            </form>
        </div>
    </div>
@endsection
