@extends('admin.layouts.master')

@section('content')
    <div class="container mt-5">

        <div class="d-flex justify-content-end">
            <form action="{{ route('userListPage') }}" method="get">
                <div class="input-group">
                    <input type="text" name="searchKey" class="form-control" value="{{ request('searchKey') }}" placeholder="Enter Search Key...">
                    <button type="submit" class="text-white btn btn-dark"><i
                            class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </form>
        </div>

        <h1 class="mb-4">User List</h1>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Address</th>
                    <th scope="col">Role</th>
                    <th scope="col">Created Date</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->address ? $user->address : 'N/A' }}</td>
                        <td>{{ $user->role }}</td>
                        <td> {{ $user->created_at->format('F d, Y') }}</td>
                        <td>
                            <a href="{{ route('deleteUser', $user->id) }}" class="btn btn-sm btn-danger"
                                onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">No users found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <span class=" d-flex justify-content-end">{{ $users->links() }}</span>
    </div>
@endsection
