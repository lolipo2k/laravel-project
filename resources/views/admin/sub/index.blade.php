@extends('layouts.admin')

@section('content')
    <a class="btn btn-primary mb-3" href="{{ route('admin.sub.create') }}" role="button">Add new subscription</a>
    <table class="table">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Percent</th>
                <th></th>
            </tr>
        </thead>
        <tbody class="align-middle">
            @foreach($subs as $sub)
                <tr>
                    <th scope="row">{{ $sub->id }}</th>
                    <td>{{ $sub->title }}</td>
                    <td>{{ $sub->percent }}%</td>
                    <td class="text-end">
                        <a class="btn btn-primary btn-sm" href="{{ route('admin.sub.edit', $sub) }}" role="button">Edit</a>
                        <form onsubmit="if(confirm('Удалить ?')) { return true } else { return false }" action="{{ route('admin.sub.destroy', $sub) }}" method="POST" style="display: inline-table;">
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
