@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">Edit F.A.Q.</div>
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

            <form action="{{ route('admin.faq.update', $faq) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="mb-3 col-md-4">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" value="{{ old('title') ?? $faq->title}}">
                    </div>

                    <div class="mb-3 col-md-2">
                        <label class="form-label">Home</label>
                        <select class="form-select" name="index">
                            <option value="0" @if ($faq['index'] == 0) selected @endif>No</option>
                            <option value="1" @if ($faq['index'] == 1) selected @endif>Yes</option>
                        </select>
                    </div>

                    <div class="mb-3 col-md-2">
                        <label class="form-label">Vacancy</label>
                        <select class="form-select" name="vacancies">
                            <option value="0" @if ($faq['vacancies'] == 0) selected @endif>No</option>
                            <option value="1" @if ($faq['vacancies'] == 1) selected @endif>Yes</option>
                        </select>
                    </div>

                    <div class="mb-3 col-md-4">
                        <label class="form-label">Category</label>
                        <select class="form-select" name="category_id">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" @if($category->id == $faq->category_id) selected @endif>{{ $category->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" name="description" rows="4">{{ old('description') ?? $faq->description  }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary mt-3 w-100">Update</button>
            </form>
        </div>
    </div>
@endsection
