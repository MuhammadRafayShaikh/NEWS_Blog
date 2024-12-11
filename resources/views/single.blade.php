@extends('master', ['allCategory' => $allCategory])

@section('content')
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <!-- post-container -->
                    <div class="post-container">
                        <div class="post-content single-post">
                            <h3>{{ $post->title }}</h3>
                            <div class="post-information">
                                <a href="{{ route('allcategory', $post->category) }}">
                                    <span>
                                        <i class="fa fa-tags" aria-hidden="true"></i>
                                        {{ $post->categoryname->category_name }}
                                    </span>
                                </a>

                                <span>
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <a
                                        href='{{ route('allusers', $post->author) }}'>{{ $post->user->first_name . ' ' . $post->user->last_name }}</a>
                                </span>
                                <span>
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                    {{ $post->created_at }}
                                </span>
                                <span>
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                    @if ($post->views <= 1)
                                        {{ $post->views }} View
                                    @else
                                        {{ $post->views }} Views
                                    @endif
                                </span>

                            </div>
                            <img class="single-feature-image" src="{{ asset('uploads/' . $post->post_img) }}"
                                alt="" />
                            <p class="description">
                                {{ $post->description }}
                            </p>
                        </div>
                    </div>
                    <!-- /post-container -->
                </div>
                @include('sidebar', ['recentPosts', $recentPosts])
            </div>
        </div>
    </div>
@endsection
