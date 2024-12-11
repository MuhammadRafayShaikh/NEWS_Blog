<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function post()
    {
        $posts = Post::with('user')->with('categoryname')->paginate(3);
        $recentPosts = Post::with('user')->with('categoryname')->orderBy('post_id', 'DESC')->limit(3)->get();
        $allCategory = Category::all();

        // return $posts;

        return view('index', compact('posts', 'recentPosts', 'allCategory'));
    }

    public function singlePost(string $id, Request $request)
    {
        $post = Post::with('user', 'categoryname')->find($id);

        // Check if the user has already viewed this post in this session
        $sessionKey = 'post_' . $id;

        if (!$request->session()->has($sessionKey)) {
            // Increase the view count
            $post->increment('views');

            // Store in session so the user can't increment it again
            $request->session()->put($sessionKey, true);
        }

        $recentPosts = Post::with('user', 'categoryname')->orderBy('post_id', 'DESC')->limit(3)->get();
        $allCategory = Category::all();

        return view('single', compact('post', 'recentPosts', 'allCategory'));
    }


    public function category(string $cid)
    {
        $categoryname = Category::find($cid);
        $posts = Post::with('user')->with('categoryname')->where('category', $cid)->paginate(3);
        $recentPosts = Post::with('user')->with('categoryname')->orderBy('post_id', 'DESC')->limit(3)->get();
        $allCategory = Category::all();

        // return $posts;

        return view('category', ['posts' => $posts, 'categoryname' => $categoryname, 'recentPosts' => $recentPosts, 'allCategory' => $allCategory]);
    }

    public function users($uid)
    {
        $authorname = User::find($uid);
        $posts = Post::with('user')->with('categoryname')->where('author', $uid)->paginate(3);
        $recentPosts = Post::with('user')->with('categoryname')->orderBy('post_id', 'DESC')->limit(3)->get();
        $allCategory = Category::all();

        // return $posts;

        return view('author', ['posts' => $posts, 'authorname' => $authorname, 'recentPosts' => $recentPosts, 'allCategory' => $allCategory]);
        // return view('author', ['posts' => $posts, 'authorname' => $authorname, 'recentPosts', $recentPosts]);
    }

    public function allCategory()
    {
        $allCategory = Category::all();

        return view('master', compact('allCategory'));
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $search = $request->get('search');

            // Search posts based on title
            $posts = Post::with('user', 'categoryname')
                ->where(function ($query) use ($search) {
                    // Post title search
                    $query->where('title', 'like', '%' . $search . '%')
                        // Search in user's first_name and last_name
                        ->orWhereHas('user', function ($sql) use ($search) {
                            $sql->where('first_name', 'like', '%' . $search . '%')
                                ->orWhere('last_name', 'like', '%' . $search . '%');
                        })
                        // Search in category_name
                        ->orWhereHas('categoryname', function ($sql) use ($search) {
                            $sql->where('category_name', 'like', '%' . $search . '%');
                        });
                })
                ->get();


            $output = '';

            if ($posts->count() > 0) {
                foreach ($posts as $post) {
                    $output .= '
                <div class="recent-post">
                    <a class="post-img" href="' . route('singlePost', $post->post_id) . '">
                        <img src="' . asset('uploads/' . $post->post_img) . '" alt="" />
                    </a>
                    <div class="post-content">
                        <h5><a href="' . route('singlePost', $post->post_id) . '">' . $post->title . '</a></h5>
                        <span>
                            <i class="fa fa-tags" aria-hidden="true"></i>
                            <a href="' . route('allcategory', $post->category) . '">' . $post->categoryname->category_name . '</a>
                        </span>
                        <span>
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            ' . $post->created_at . '
                        </span>
                        <a class="read-more" href="' . route('singlePost', $post->post_id) . '">read more</a>
                    </div>
                </div>';
                }
            } else {
                $output = '<h5>No posts found</h5>';
            }

            return $output;
        }
    }
}
