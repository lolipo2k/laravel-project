@extends('layouts.admin')

@section('content')
    <a class="btn btn-primary mb-3" href="{{ route('admin.promocode.create') }}" role="button">Add new Promocode</a>

    <table class="table">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Percent</th>
                <th></th>
            </tr>
        </thead>
        <tbody class="align-middle">
            @foreach($promocodes as $promocode)
                <tr>
                    <th scope="row">{{ $promocode['id'] }}</th>
                    <td>{{ $promocode['name'] }}</td>
                    <td>{{ $promocode['percent'] }}%</td>
                    <td class="text-end">
                        <a class="btn btn-primary btn-sm" href="{{ route('admin.promocode.edit', $promocode) }}" role="button">Edit</a>
                        <form onsubmit="if(confirm('Удалить ?')){ return true }else{ return false }" action="{{ route('admin.promocode.destroy', $promocode) }}" method="POST" style="display: inline-table;">
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
