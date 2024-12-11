@extends('admin/master')

@section('content')
    <div id="admin-content">
        <div class="container">
            <div class="row">
                @if (session('category'))
                    <div class="col-lg-12">
                        <div class="text-success text-center">
                            <h2 class="text-center">{{ session('category') }}</h2>
                        </div>
                    </div>
                @endif
                <div class="col-md-10">
                    <h1 class="admin-heading">All Categories</h1>
                </div>
                <div class="col-md-2">
                    <a class="add-new" href="{{ route('category.create') }}">add category</a>
                </div>
                <div class="col-md-12">
                    <table class="content-table">
                        <thead>
                            <th>S.No.</th>
                            <th>Category Name</th>
                            <th>No. of Posts</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </thead>
                        <tbody>
                            @foreach ($category as $categories)
                                <tr>
                                    <td class='id'>{{ $categories->category_id }}</td>
                                    <td>{{ $categories->category_name }}</td>
                                    <td>{{ $categories->post }}</td>
                                    <td class='edit'><a href='{{ route('category.edit', $categories->category_id) }}'><i
                                                class='fa fa-edit'></i></a>
                                    </td>
                                    {{-- <td class='delete'><a href=''><i class='fa fa-trash-o'></i></a></td> --}}
                                    <form action="{{ route('category.destroy', $categories->category_id) }}" method="POST">
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
                    {{ $category->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection
