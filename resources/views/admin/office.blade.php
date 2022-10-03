@extends('layouts.admin')

@section('content')
<table class="table table-hover">
    <caption>{{ $offices->links() }}</caption>
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Phone</th>
            <th>E-mail</th>
            <th>m2</th>
            <th>Window</th>
            <th>Chemical cleaning</th>
            <th>Repairs</th>
            <th>Information</th>
            <th>Created by</th>
        </tr>
    </thead>
    <tbody class="align-middle">
        @forelse($offices as $office)
            <tr>
                <td>{{ $office->id }}</td>
                <td>{{ $office->name }}</td>
                <td>{{ $office->phone }}</td>
                <td>{{ $office->email }}</td>
                <td>{{ $office->m2 }}</td>
                <td>{{ $office->window == 1 ? 'Yes':'No' }}</td>
                <td>{{ $office->chemical_cleaning == 1 ? 'Yes':'No' }}</td>
                <td>{{ $office->repairs == 1 ? 'Yes':'No' }}</td>
                <td>{{ $office->information }}</td>
                <td>{{ Carbon\Carbon::parse($office->created_at)->isoFormat('LLLL') }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="10" class="table-danger text-center">No offices orders</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection
