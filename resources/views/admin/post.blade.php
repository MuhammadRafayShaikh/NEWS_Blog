@extends('admin/master')

@section('content')
    <div id="admin-content">
        <div class="container">
            @if (session('post'))
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-success text-center">
                            <h2 class="text-center">{{ session('post') }}</h2>
                        </div>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-md-10">
                    <h1 class="admin-heading">All Posts</h1>
                </div>
                <div class="col-md-2">
                    <a class="add-new" href="{{ route('posts.create') }}">add post</a>
                </div>
                <div class="col-md-12">
                    <table class="content-table">
                        <thead>
                            <th>S.No.</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Date</th>
                            <th>Author</th>
                            <th>Image</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <td class='id'>{{ $post->post_id }}</td>
                                    <td>{{ $post->title }}</td>
                                    <td>
                                        {{-- Yahan truncate karenge aur "Read more" link denge --}}
                                        <span class="short-description">
                                            {{ Str::limit($post->description, 6) }} {{-- Sirf 50 characters show karenge --}}
                                        </span>
                                        <span class="full-description" style="display: none;">
                                            {{ $post->description }} {{-- Puri description --}}
                                        </span>
                                        <a href="javascript:void(0);" class="read-more" style="font-size: 12px">Read More</a>
                                    </td>

                                    <td>{{ $post->categoryname->category_name }}</td>
                                    <td>{{ $post->created_at }}</td>
                                    <td>{{ $post->user->first_name . ' ' . $post->user->last_name }}</td>
                                    <td><img loading="lazy" height="100" src="{{ asset('uploads/' . $post->post_img) }}"
                                            alt="">
                                    </td>
                                    <td class='edit'><a href='{{ route('posts.edit', $post->post_id) }}'><i
                                                class='fa fa-edit'></i></a>
                                    </td>
                                    {{-- <td class='delete'><a href='delete-post.php'><i class='fa fa-trash-o'></i></a></td> --}}
                                    <form
                                        action="{{ route('posts.destroy', ['id' => $post->post_id, 'catid' => $post->category]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <td>
                                            <input type="submit" value="Delete" class="btn btn-danger">
                                        </td>
                                    </form>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $posts->links('vendor.pagination.bootstrap-4') }} <!-- Aapko yahan custom view ka naam dena hoga -->

                    {{-- <ul class='pagination admin-pagination'>
                        <li class="active"><a>1</a></li>
                        <li><a>2</a></li>
                        <li><a>3</a></li>
                    </ul> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const readMoreLinks = document.querySelectorAll('.read-more');

        readMoreLinks.forEach(function(link) {
            link.addEventListener('click', function() {
                const shortDescription = this.previousElementSibling.previousElementSibling;
                const fullDescription = this.previousElementSibling;

                if (fullDescription.style.display === 'none') {
                    fullDescription.style.display = 'inline';
                    shortDescription.style.display = 'none';
                    this.textContent = 'Show less';
                } else {
                    fullDescription.style.display = 'none';
                    shortDescription.style.display = 'inline';
                    this.textContent = 'Read more';
                }
            });
        });
    });
</script>
