@extends('admin.layouts.master')

@section('content')
    <div class="container mt-5">

        <div class="d-flex justify-content-end">
            <form action="{{ route('adminListPage') }}" method="get">
                <div class="input-group">
                    <input type="text" name="searchKey" class="form-control" placeholder="Enter Search Key...">
                    <button type="submit" class="btn btn-dark text-white"><i
                            class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </form>
        </div>

        <h1 class="mb-4">Admin List</h1>

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
                @forelse ($admins as $admin)
                    <tr>
                        <td>{{ $admin->id }}</td>
                        <td>{{ $admin->name }}</td>
                        <td>{{ $admin->email }}</td>
                        <td>{{ $admin->phone }}</td>
                        <td>{{ $admin->address ? $admin->address : 'N/A' }}</td>
                        <td>{{ $admin->role }}</td>
                        <td> {{ $admin->created_at->format('F d, Y') }}</td>
                        <td>
                            <a href="{{ route('deleteAdmin', $admin->id) }}" class="btn btn-sm btn-danger"
                                onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">No admins found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <span class=" d-flex justify-content-end">{{ $admins->links() }}</span>
    </div>
@endsection
