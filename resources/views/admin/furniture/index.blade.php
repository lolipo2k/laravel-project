@extends('layouts.admin')

@section('content')
    <a class="btn btn-primary mb-3" href="{{ route('admin.furniture.create') }}" role="button">Add new Furniture</a>
    <table class="table">
        <thead class="table-dark">
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Multi</th>
                <th></th>
            </tr>
        </thead>
        <tbody class="align-middle">
            @foreach($furnitures as $furniture)
                <tr>
                    <td>{{ $furniture['title'] }}</td>
                    <td>{{ $furniture['price'] }} zł</td>
                    <td>{{ $furniture['multi'] == 1 ? 'Yes':'No' }}</td>
                    <td class="text-end">
                        <a class="btn btn-primary btn-sm" href="{{ route('admin.furniture.edit', $furniture) }}" role="button">Edit</a>
                        <form onsubmit="if(confirm('Удалить ?')){ return true }else{ return false }" action="{{ route('admin.furniture.destroy', $furniture) }}" method="POST" style="display: inline-table;">
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
