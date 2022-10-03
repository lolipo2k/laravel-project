@extends('layouts.admin')

@section('content')
    <a class="btn btn-primary mb-3" href="{{ route('admin.faq.create') }}" role="button">Add new F.A.Q.</a>

    <table class="table">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Category</th>
                <th>Home</th>
                <th>Vacancy</th>
                <th></th>
            </tr>
        </thead>
        <tbody class="align-middle">
            @foreach($items as $item)
                <tr>
                    <th scope="row">{{ $item->id }}</th>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->category()->first()->title ?? 'none' }}</td>
                    <td>{{ $item['index'] == 1 ? 'Yes':'No' }}</td>
                    <td>{{ $item['vacancies'] == 1 ? 'Yes':'No' }}</td>
                    <td class="text-end">
                        <a class="btn btn-primary btn-sm" href="{{ route('admin.faq.edit', $item) }}" role="button">Edit</a>
                        <form onsubmit="if(confirm('Удалить ?')){ return true }else{ return false }" action="{{ route('admin.faq.destroy', $item) }}" method="POST" style="display: inline-table;">
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
