@extends('admin/master')

@section('content')
    <div id="admin-content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="admin-heading">Modify User Details</h1>
                </div>
                <div class="col-md-offset-4 col-md-4">
                    <!-- Form Start -->
                    <form action="{{ route('users.update', $user->user_id) }}" method ="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <input type="hidden" value="{{ $user->user_id }}" name="user_id" class="form-control"
                                value="1" placeholder="">
                        </div>
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" value="{{ $user->first_name }}" name="fname" class="form-control"
                                value="Ram" placeholder="" required>
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" value="{{ $user->last_name }}" name="lname" class="form-control"
                                value="Sharma" placeholder="" required>
                        </div>
                        <div class="form-group">
                            <label>User Name</label>
                            <input type="email" value="{{ $user->email }}" name="email" class="form-control"
                                value="ram" placeholder="" required>
                        </div>
                        <div class="form-group">
                            <label>User Role</label>
                            <select class="form-control" name="role" value="{{ $user->role }}">
                                <option
                                    @if ($user->role == 0) {{ 'selected' }}
                                    @else
                                    {{ '' }} @endif
                                    value="0">Normal User</option>
                                <option
                                    @if ($user->role == 1) {{ 'selected' }}
                                    @else
                                    {{ '' }} @endif
                                    value="1">Admin</option>
                            </select>
                        </div>
                        <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                    </form>
                    <!-- /Form -->
                </div>
            </div>
        </div>
    </div>
@endsection
