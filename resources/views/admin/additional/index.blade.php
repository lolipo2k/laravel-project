@extends('layouts.admin')

@section('content')
    <a class="btn btn-primary mb-3" href="{{ route('admin.additional.create') }}" role="button">Add new Additional</a>
    <table class="table">
        <thead class="table-dark">
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Price</th>
                <th>Service</th>
                <th>Multi</th>
                <th></th>
            </tr>
        </thead>
        <tbody class="align-middle">
            @foreach($additionals as $additional)
                <tr>
                    <td>{{ $additional->id }}</td>
                    <td>{{ $additional->title }}</td>
                    <td>{{ $additional->price }} zł</td>
                    <td>{{ $additional->service['title'] ?? 'None' }}</td>
                    <td>{{ $additional->multi == 1 ? 'Yes':'No' }}</td>
                    <td class="text-end">
                        <a class="btn btn-primary btn-sm" href="{{ route('admin.additional.edit', $additional) }}" role="button">Edit</a>
                        <form onsubmit="if(confirm('Удалить ?')){ return true }else{ return false }" action="{{ route('admin.additional.destroy', $additional) }}" method="POST" style="display: inline-table;">
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
