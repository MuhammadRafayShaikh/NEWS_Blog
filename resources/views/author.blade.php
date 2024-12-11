@extends('master', ['allCategory' => $allCategory])

@section('content')
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <!-- post-container -->
                    <div class="post-container">
                        <h2 class="page-heading">{{ $authorname->first_name . ' ' . $authorname->last_name }}</h2>
                        @foreach ($posts as $post)
                            <div class="post-content">
                                <div class="row">
                                    <div class="col-md-4">
                                        <a class="post-img" href="{{ route('singlePost', $post->post_id) }}"><img
                                                src="{{ asset('uploads/' . $post->post_img) }}" alt="" /></a>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="inner-content clearfix">
                                            <h3><a href='{{ route('singlePost', $post->post_id) }}'>{{ $post->title }}</a>
                                            </h3>
                                            <div class="post-information">
                                                <span>
                                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                                    <a
                                                        href='{{ route('allcategory', $post->category) }}'>{{ $post->categoryname->category_name }}</a>
                                                </span>
                                                <span>
                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                                    <a
                                                        href='{{ route('allusers', $post->author) }}'>{{ $post->user->first_name . ' ' . $post->user->last_name }}</a>
                                                </span>
                                                <span>
                                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    {{ $post->created_at }}
                                                </span>
                                            </div>
                                            <p class="description">
                                                {{ $post->description }}
                                            </p>
                                            <a class='read-more pull-right'
                                                href='{{ route('singlePost', $post->post_id) }}'>read more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        {{ $posts->links('vendor.pagination.bootstrap-4') }}
                    </div><!-- /post-container -->
                </div>
                @include('sidebar', ['recentPosts' => $recentPosts])
            </div>
        </div>
    </div>
@endsection
