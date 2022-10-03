@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">Add new promocode</div>
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

            <form action="{{ route('admin.promocode.update', $promocode) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="mb-3 col-md-4">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') ?? $promocode['name'] }}">
                    </div>

                    <div class="mb-3 col-md-4">
                        <label class="form-label" id="percent">Percent</label>
                        <input type="number" class="form-control" id="percent" name="percent" value="{{ old('percent') ?? $promocode['percent'] }}" min="1" max="99">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mt-3 w-100">Update</button>
            </form>
        </div>
    </div>
@endsection
