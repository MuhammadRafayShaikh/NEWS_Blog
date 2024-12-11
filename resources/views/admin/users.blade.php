@extends('admin/master')

@section('content')
    <div id="admin-content">
        <div class="container">
            <div class="row">
                @if (session('status'))
                    <div class="col-lg-12">
                        <div class="text-success text-center">
                            <h2 class="text-center">{{ session('status') }}</h2>
                        </div>
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col-md-10">
                    <h1 class="admin-heading">All Users</h1>
                </div>
                <div class="col-md-2">
                    <a class="add-new" href="{{ route('users.create') }}">add user</a>
                </div>
                <div class="col-md-12">
                    <table class="content-table">
                        <thead>
                            <th>S.No.</th>
                            <th>Full Name</th>
                            <th>User Name</th>
                            <th>Role</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td class='id'>{{ $user->user_id }}</td>
                                    <td>{{ $user->first_name . ' ' . $user->last_name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if ($user->role == 1)
                                            {{ 'admin' }}
                                        @else
                                            {{ 'normal user' }}
                                        @endif
                                    </td>
                                    <td class='edit'><a href='{{ route('users.edit', $user->user_id) }}'><i
                                                class='fa fa-edit'></i></a>
                                    </td>
                                    {{-- <td class='delete'><a href='{{ route('users.destroy', $user->user_id) }}'><i
                                                class='fa fa-trash-o'></i></a></td> --}}
                                    <form action="{{ route('users.destroy', $user->user_id) }}" method="POST">
                                        <td>
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" value="Delete" class="btn btn-danger fa fa-trash-o">

                                        </td>
                                    </form>

                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                    {{-- Pagination Links --}}
                    {{-- Showing Results Text --}}
                    

                    {{-- Pagination Links --}}
                    {{ $users->links('vendor.pagination.bootstrap-4') }}

                </div>
            </div>
        </div>
    </div>
@endsection
