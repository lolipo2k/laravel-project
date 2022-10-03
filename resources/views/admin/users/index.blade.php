@extends('layouts.admin')

@section('content')
    <table class="table">
        <caption>{{ $users->links() }}</caption>
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>E-Mail</th>
                <th>Phone</th>
                <th>Number of addresses</th>
                <th>Created</th>
                <th></th>
            </tr>
        </thead>
        <tbody class="align-middle">
            @foreach($users as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->addresses->count() }}</td>
                    <td>{{ Carbon\Carbon::parse($user->created_at)->isoFormat('LL') }}</td>
                    <td class="text-end">
                        <a class="btn btn-primary btn-sm" href="{{ route('admin.users.show', $user) }}" role="button">View</a>
                        {{-- <form onsubmit="if(confirm('Удалить ?')){return true}else{return false}" action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display: inline-table;"> --}}
                        {{--     @csrf --}}
                        {{--     @method('DELETE') --}}
                        {{--     <button type="submit" class="btn btn-danger btn-sm">Delete</button> --}}
                        {{-- </form> --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
