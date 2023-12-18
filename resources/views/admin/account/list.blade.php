@extends('admin.layouts.master')

@section('title', 'Category List Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Admin List</h2>
                            </div>
                        </div>
                    </div>

                    @if (session('deleteSuccess'))
                        <div class="col-4 offset-8">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <i class=" fa-solid fa-circle-xmark"></i> {{ session('deleteSuccess') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    @if (session('updateSuccess'))
                        <div class="col-4 offset-8">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class=" fa-solid fa-circle-xmark"></i> {{ session('updateSuccess') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-3">
                            <h3 class=" text-secondary">Search Key : <span class=" text-danger">{{ request('key') }}</span>
                            </h3>
                        </div>
                        <div class="col-3 offset-6">
                            <form action="{{ route('admin#list') }}" method="get">
                                @csrf
                                <div class="d-flex">
                                    <input type="text" name="key" class=" form-control" placeholder="Search.."
                                        value=" {{ request('key') }}">
                                    <button type="submit" class=" btn btn-dark ">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row mt-2 ">
                        <div class="col-1 offset-10 shadow-sm bg-white p-2 text-center">
                            <i class="fa-solid fa-database mr-2"></i> {{ $admin->total() }}
                        </div>
                    </div>

                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Gender</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admin as $a)
                                    <tr class="tr-shadow">
                                        <td class=" col-2">
                                            @if ($a->image == null)
                                                @if ($a->gender == 'male')
                                                    <img src="{{ asset('image/default_image.jpg') }}"
                                                        class=" img-thumbnail shadow-sm">
                                                @else
                                                    <img src="{{ asset('image/female_defaule_image.jpg') }}"
                                                        class="img-thumbnail shadow-sm">
                                                @endif
                                            @else
                                                <img src="{{ asset('storage/' . $a->image) }}"
                                                    class=" img-thumbnail shadow-sm">
                                            @endif
                                        </td>
                                        <input type="hidden" class="roleId" value="{{ $a->id }}">
                                        <td class="userName">{{ $a->name }}</td>
                                        <td> {{ $a->email }}</td>
                                        <td> {{ $a->gender }}</td>
                                        <td> {{ $a->phone }}</td>
                                        <td> {{ $a->address }}</td>
                                        <td>
                                            <div class="table-data-feature">
                                                @if (Auth::user()->id == $a->id)
                                                @else
                                                    <div class="form-group col-9 mt-2">
                                                        <select name="role" class="form-control roleChange">
                                                            <option value="" class="ms-2">Role</option>
                                                            <option value="admin" class="ms-2">Admin</option>
                                                            <option value="user" class="ms-2">User</option>
                                                        </select>
                                                    </div>

                                                    <a href="{{ route('admin#delete', $a->id) }}">
                                                        <button class="item mt-2 " data-toggle="tooltip"
                                                            data-placement="top" title="Delete">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class=" my-3">
                            {{ $admin->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection

@section('scriptScoure')
    <script>
        $(document).ready(function() {
            $('.roleChange').change(function() {

                $currentStatus = $(this).val();
                $parentNode = $(this).parents('tr');
                $roleId = $parentNode.find('.roleId').val();
                console.log($roleId);
                $data = {
                    'roleId': $roleId,
                    'status': $currentStatus
                };

                $.ajax({
                    url: '/admin/ajax/role/change/status',
                    data: $data,
                    type: 'GET',
                    dataType: 'json',
                })
            })
        })
    </script>
@endsection
