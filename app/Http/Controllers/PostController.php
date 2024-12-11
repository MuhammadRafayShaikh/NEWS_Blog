<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role == 1) {
            $posts = Post::with('user', 'categoryname')->orderBy('post_id','DESC')->paginate(4);
        } else {
            $posts = Post::with('user', 'categoryname')->where('author', Auth::id())->orderBy('post_id','DESC')->paginate(2);
        }
        // return $posts->current_page;
        // return $posts;

        return view('admin.post', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all();
        return view('admin.add-post', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $postValidation = validator($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'category' => 'required',
            'image' => 'required|image|mimes:png,jpg,jpeg,webp,gif'
        ]);

        $file = $request->file('image');

        $fileExtension = $file->extension();

        $filename = time() . '.' . $fileExtension;

        $file->move(public_path('uploads/'), $filename);

        $cateogry = Category::find($request->category);
        // return $cateogry;

        $cateogry->update([
            'post' => $cateogry->post + 1
        ]);
        $post = Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'author' => Auth::id(),
            'post_img' => $filename
        ]);

        if ($post && $cateogry) {
            return redirect()->route('posts.index')->with('post', 'Post Created Successfully');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::find($id);

        // return $id;
        if (Gate::allows('postadmin', $post)) {

            $category = Category::all();
            // return $post;
            return view('admin.update-post', ['post' => $post, 'category' => $category]);
        } else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $postValidation = validator($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'category' => 'required',
            'image' => 'required|image|mimes:png,jpg,jpeg,webp,gif'
        ]);

        $post = Post::find($id);
        if (Gate::allows('postadmin', $post)) {

            $postImage = Post::select('post_id', 'post_img')->find($id);


            if ($request->hasFile('image')) {
                $path = public_path('uploads/');
                if ($postImage->post_img && file_exists($path . $postImage->post_img)) {
                    unlink($path . $postImage->post_img);
                }

                $file = $request->file('image');
                $fileExtension = $file->extension();
                $filename = time() . '.' . $fileExtension;
                $file->move(public_path('uploads/'), $filename);
            } else {
                $filename = $postImage->post_img;
            }



            if ($request->old_category != $request->category) {
                $oldcategory = Category::find($request->old_category);
                $oldcategory->update([
                    'post' => $oldcategory->post - 1
                ]);

                $category = Category::find($request->category);
                $category->update([
                    'post' => $category->post + 1
                ]);
            }

            $post->update([
                'title' => $request->title,
                'description' => $request->description,
                'category' => $request->category,
                'post_img' => $filename,
                // 'updated_at' => date('Y-m-d') . date('H:i:s')
            ]);

            if ($post) {
                return redirect()->route('posts.index')->with('post', 'Post Updated Successfully');
            }
        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, string $catid)
    {
        $post = Post::find($id);

        if (Gate::allows('postadmin', $post)) {

            $category = Category::find($catid);

            $postImage = Post::select('post_id', 'post_img')->find($id);

            // return $postImage;
            $path = public_path('uploads/') . $postImage->post_img;

            if ($postImage->post_img && file_exists($path)) {
                unlink($path);
            }
            // return $category;
            // return $category->post;

            $category->update([
                'post' => $category->post - 1
            ]);

            $post->delete();

            return redirect()->route('posts.index')->with('post', 'Post Deleted Successfully');
        } else {
            abort(403);
        }
    }
}
