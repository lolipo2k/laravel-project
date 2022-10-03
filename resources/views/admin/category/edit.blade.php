@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">Account</div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.category.update', $category) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" class="form-control" name="title" value="{{ old('title') ?? $category->title }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Main page</label>
                    <select class="form-select" name="index">
                        <option value="0" @if($category->index == 0) selected @endif>No</option>
                        <option value="1" @if($category->index == 1) selected @endif>Yes</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary mt-3 w-100">Update</button>
            </form>
        </div>
    </div>
@endsection
