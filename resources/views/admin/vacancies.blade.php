@extends('layouts.admin')

@section('content')
<table class="table table-hover">
    <caption>{{ $vacancies->links() }}</caption>
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Phone</th>
            <th>E-mail</th>
            <th>Information</th>
            <th>Created by</th>
        </tr>
    </thead>
    <tbody class="align-middle">
        @forelse($vacancies as $vacancy)
            <tr>
                <td>{{ $vacancy['id'] }}</td>
                <td>{{ $vacancy['name'] }}</td>
                <td>{{ $vacancy['phone'] }}</td>
                <td>{{ $vacancy['email'] }}</td>
                <td>{{ $vacancy['information'] ?? 'none' }}</td>
                <td>{{ Carbon\Carbon::parse($vacancy->created_at)->isoFormat('LLLL') }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="table-danger text-center">No vacancies...</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection
