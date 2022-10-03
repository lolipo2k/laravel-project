@extends('layouts.admin')

@section('content')
    <div class="row g-2">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">Account</div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.users.update', $user) }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') ?? $user->name }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Phone number</label>
                            <input type="text" class="form-control" name="phone" value="{{ old('phone') ?? $user->phone }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">E-Mail</label>
                            <input type="email" class="form-control" name="email" value="{{ old('email') ?? $user->email }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3 w-100">Update</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Addresses</div>
                <div class="card-body">
                    <table class="table text-center mb-0 table-borderless">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Street</th>
                                <th>House number</th>
                                <th>Apartment number</th>
                                <th>Entrance</th>
                                <th>Floor</th>
                                <th>Intercom Code</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($user->addresses()->get() as $address)
                                <tr class="table-{{ $address->deleted == 0 ? 'success':'danger' }}">
                                    <th scope="row">{{ $address->id }}</th>
                                    <td>{{ $address->street }}</td>
                                    <td>{{ $address->house_number }}</td>
                                    <td>{{ $address->apartment_number }}</td>
                                    <td>{{ $address->entrance }}</td>
                                    <td>{{ $address->floor }}</td>
                                    <td>{{ $address->intercom }}</td>
                                </tr>
                            @empty
                                <td colspan="2">Larry the Bird</td>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
