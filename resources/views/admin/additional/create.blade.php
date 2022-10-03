@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">Add new additional</div>
        <div class="card-body">
            <form action="{{ route('admin.additional.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="mb-3 col-md-3">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}">

                        @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-2">
                        <label class="form-label">Price</label>
                        <input type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}">

                        @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-2">
                        <label class="form-label">Cleaning time <span class="text-muted">(In minutes)</span></label>
                        <input type="number" min="1" class="form-control @error('minutes') is-invalid @enderror" name="minutes" value="{{ old('minutes') ?? 1 }}">

                        @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-3">
                        <label class="form-label">Service</label>
                        <select class="form-select" name="service_id">
                            @foreach($services as $service)
                                <option value="{{ $service['id'] }}" @if (old('service_id') == $service['id']) selected @endif>{{ $service['title'] }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3 col-md-2">
                        <label class="form-label">Multi</label>
                        <select class="form-select" name="multi">
                            <option value="1" @if (old('multi') == 1) selected @endif>Yes</option>
                            <option value="0" @if (old('multi') == 0) selected @endif>No</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" rows="5" name="description">{{ old('description') }}</textarea>

                    @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
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
                    <label for="big_cover" class="form-label">Big cover <span class="text-muted">(Serves for the description page)</span></label>
                    <input class="form-control @error('big_cover') is-invalid @enderror" type="file" id="big_cover" name="big_cover">

                    @error('big_cover')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary mt-3 w-100">Add</button>
            </form>
        </div>
    </div>
@endsection
