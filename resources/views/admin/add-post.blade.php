@extends('admin/master')

@section('content')
    <div id="admin-content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="admin-heading">Add New Post</h1>
                </div>
                <div class="col-md-offset-3 col-md-6">
                    <!-- Form -->
                    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="post_title">Title</label>
                            <input type="text" name="title" class="form-control" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1"> Description</label>
                            <textarea name="description" class="form-control" rows="5" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Category</label>
                            <select name="category" class="form-control">
                                @foreach ($category as $categories)
                                    <option value="{{ $categories->category_id }}" selected>
                                        {{ $categories->category_name }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Post image</label>
                            <input type="file" name="image" required>
                        </div>
                        <input type="submit" name="submit" class="btn btn-primary" value="Save" required />
                    </form>
                    <!--/Form -->
                </div>
            </div>
        </div>
    </div>
@endsection
