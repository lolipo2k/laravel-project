@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">Add new Category</div>
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

            <form action="{{ route('admin.category.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Main page</label>
                    <select class="form-select" name="index">
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary mt-3 w-100">Add</button>
            </form>
        </div>
    </div>
@endsection
