@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">Edit pattern: {{ $pattern['title'] }}</div>
        <div class="card-body">
            <form action="{{ route('admin.pattern.update', $pattern) }}" method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" name="service_id" value="{{ $service['id'] }}">

                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') ?? $pattern->title }}">

                    @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Count rooms</label>
                    <input type="text" class="form-control @error('rooms') is-invalid @enderror" name="rooms" value="{{ old('rooms') ?? $pattern['rooms'] }}">

                    @error('rooms')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Count bathrooms</label>
                    <input type="text" class="form-control @error('bathrooms') is-invalid @enderror" name="bathrooms" value="{{ old('bathrooms') ?? $pattern['bathrooms'] }}">

                    @error('bathrooms')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="10">{{ old('description') ?? $pattern->description }}</textarea>

                    @error('description')
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
