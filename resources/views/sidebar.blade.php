<div id="sidebar" class="col-md-4">
    <!-- search box -->
    <div class="search-box-container">
        <h4>Search</h4>
        <form class="search-post" action="javascript:void(0);">
            <div class="input-group">
                <input type="text" name="search" id="search" class="form-control" placeholder="Search .....">
                <span class="input-group-btn">
                    <button type="button" class="btn btn-danger" id="search-btn">Search</button>
                </span>
            </div>
        </form>
    </div>
    <!-- /search box -->
    <!-- recent posts box -->
    <div class="recent-post-container">
        <h4 id="posts-heading">Recent Posts</h4> <!-- Heading -->
        <div id="search-results">
            @foreach ($recentPosts as $post)
                <div class="recent-post">
                    <a class="post-img" href="{{ route('singlePost', $post->post_id) }}">
                        <img src="{{ asset('uploads/' . $post->post_img) }}" alt="" />
                    </a>
                    <div class="post-content">
                        <h5><a href="{{ route('singlePost', $post->post_id) }}">{{ $post->title }}</a></h5>
                        <span>
                            <i class="fa fa-tags" aria-hidden="true"></i>
                            <a href="{{ route('allcategory', $post->category) }}">{{ $post->categoryname->category_name }}</a>
                        </span>
                        <span>
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            {{ $post->created_at }}
                        </span>
                        <a class="read-more" href="{{ route('singlePost', $post->post_id) }}">read more</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- /recent posts box -->
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#search').on('keyup', function() {
            var query = $(this).val();
            
            // Check if search query is not empty
            if(query.length > 0) {
                $('#posts-heading').text('Searching...');  // Change heading to "Search Results"
            } else {
                $('#posts-heading').text('Recent Posts');  // Change back to "Recent Posts" if search is cleared
            }
            
            $.ajax({
                url: "{{ route('search') }}", // Server route
                type: "GET",
                data: {'search': query},
                success: function(data) {
                    $('#search-results').html(data);
                }
            });
        });
    });
</script>
