@extends('admin/master')

@section('content')
    <div id="admin-content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="admin-heading">Update Post</h1>
                </div>
                <div class="col-md-offset-3 col-md-6">
                    <!-- Form for show edit-->
                    <form action="{{ route('posts.update', $post->post_id) }}" method="POST" enctype="multipart/form-data"
                        autocomplete="off">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <input type="hidden" name="post_id" class="form-control" value="{{ $post->post_id }}"
                                placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputTile">Title</label>
                            <input type="text" name="title" class="form-control" id="exampleInputUsername"
                                value="{{ $post->title }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1"> Description</label>
                            <textarea name="description" class="form-control" required rows="5">{{ $post->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputCategory">Category</label>
                            <select class="form-control" name="category">
                                @foreach ($category as $categories)
                                    <option
                                        @if ($categories->category_id == $post->category) {{ 'selected' }}
                                        @else
                                            {{ '' }} @endif
                                        value="{{ $categories->category_id }}">{{ $categories->category_name }}
                                    </option>
                                @endforeach

                            </select>
                            <input type="hidden" name="old_category" value="{{ $post->category }}">
                        </div>
                        <div class="form-group">
                            <label for="">Post image</label>
                            <input type="file"
                                onchange="document.querySelector('#old_image').src=window.URL.createObjectURL(this.files[0])"
                                name="image">
                            <img height="100" id="old_image" src="{{ asset('uploads/' . $post->post_img) }}"
                                alt="">
                            {{-- <input type="hidden" name="old-image" value=""> --}}
                        </div>
                        <input type="submit" name="submit" class="btn btn-primary" value="Update" />
                    </form>
                    <!-- Form End -->
                </div>
            </div>
        </div>
    </div>
@endsection
