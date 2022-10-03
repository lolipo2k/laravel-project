@extends('layouts.admin')

@section('content')
    @if ($service['id'])
        <a class="btn btn-primary mb-3" href="{{ route('admin.pattern.create') }}" role="button">Add new pattern</a>
    @else
        <div class="alert alert-danger" role="alert">
            Service with name not found: Zwykłe
        </div>
    @endif
    <table class="table">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Rooms</th>
                <th>Bathrooms</th>
                <th></th>
            </tr>
        </thead>
        <tbody class="align-middle">
            @foreach($patterns as $pattern)
                <tr>
                    <th scope="row">{{ $pattern->id }}</th>
                    <td>{{ $pattern->title }}</td>
                    <td>{{ $pattern['rooms'] }}</td>
                    <td>{{ $pattern['bathrooms'] }}</td>
                    <td class="text-end">
                        <a class="btn btn-primary btn-sm" href="{{ route('admin.pattern.edit', $pattern) }}" role="button">Edit</a>
                        <form onsubmit="if(confirm('Удалить ?')){ return true }else{ return false }" action="{{ route('admin.pattern.destroy', $pattern) }}" method="POST" style="display: inline-table;">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
