@extends('master', ['allCategory' => $allCategory])

@section('content')
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <!-- post-container -->
                    <div class="post-container">
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
                                                <span>
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                    @if ($post->views == 0)
                                                        No View
                                                    @elseif ($post->views == 1)
                                                        {{ $post->views }} View
                                                    @else
                                                        {{ $post->views }} Views
                                                    @endif
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
                        {{-- <ul class='pagination'>
                            <li class="active"><a href="">1</a></li>
                            <li><a href="">2</a></li>
                            <li><a href="">3</a></li>
                        </ul> --}}
                    </div>
                    <!-- /post-container -->

                </div>
                {{-- @include('sidebar') --}}

                @include('sidebar', ['recentPosts' => $recentPosts]) <!-- Pass recentPosts to sidebar -->

            </div>
        </div>
    </div>
@endsection
