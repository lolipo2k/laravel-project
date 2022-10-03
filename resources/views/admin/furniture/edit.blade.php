@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">Edit furniture</div>
        <div class="card-body">
            <form action="{{ route('admin.furniture.update', $furniture) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="mb-3 col-md-4">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') ?? $furniture['title'] }}">

                        @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-2">
                        <label class="form-label">Price</label>
                        <input type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') ?? $furniture['price'] }}">

                        @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-3">
                        <label class="form-label">Cleaning time <span class="text-muted">(In minutes)</span></label>
                        <input type="number" min="1" class="form-control @error('minutes') is-invalid @enderror" name="minutes" value="{{ old('minutes') ?? $furniture['minutes'] }}">

                        @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-3">
                        <label class="form-label">Multi</label>
                        <select class="form-select" name="multi">
                            <option value="1" @if ($furniture['multi'] == 1) selected @endif>Yes</option>
                            <option value="0" @if ($furniture['multi'] == 0) selected @endif>No</option>
                        </select>
                    </div>
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

                <button type="submit" class="btn btn-primary mt-3 w-100">Update</button>
            </form>
        </div>
    </div>
@endsection
