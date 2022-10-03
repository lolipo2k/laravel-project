@extends('layouts.admin')

@section('content')
    <a class="btn btn-primary mb-3" href="{{ route('admin.service.create') }}" role="button">Add new service</a>
    <table class="table">
        <thead class="table-dark">
            <tr>
                <th>Title</th>
                <th>Basic price</th>
                <th>Window</th>
                <th>top_index</th>
                <th>Count apps</th>
                <th></th>
            </tr>
        </thead>
        <tbody class="align-middle" id="serviceTable">
        @forelse($services as $service)
            <tr id="{{ $service->id }}">
                <td>{{ $service->title }}</td>
                <td>{{ $service->price }} zł</td>
                <td>{{ $service->window == 1 ? 'Yes':'No' }}</td>
                <td>{{ $service['top_index'] == 1 ? 'Yes':'NO' }}</td>
                <td>{{ $service->apps()->count() }}</td>
                <td class="text-end">
                    <a class="btn btn-primary btn-sm" href="{{ route('admin.service.edit', $service) }}" role="button">Edit</a>
                    <form onsubmit="if(confirm('Удалить ?')){ return true }else{ return false }" action="{{ route('admin.service.destroy', $service) }}" method="POST" style="display: inline-table;">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="table-danger text-center">No service</td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endsection
