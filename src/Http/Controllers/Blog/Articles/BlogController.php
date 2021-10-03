<?php

namespace Cms\Http\Controllers\Blog\Articles;

use Cms\Models\Blog\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $posts = Post::when(
            $request->search, function ($query) use ($request) {
                        $search = $request->search;
                        
                        return $query->where('title', 'like', "%$search%")
                            ->orWhere('body', 'like', "%$search%");
            }
        )->with('tags', 'category', 'user')
                    ->withCount('comments')
                    ->published()
                    ->simplePaginate(5);

        return view('features.frontend.index', compact('posts'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function post(Post $post)
    {
        $post = $post->load(['comments.user', 'tags', 'user', 'category']);

        return view('features.frontend.post', compact('post'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function comment(Request $request, Post $post)
    {
        $this->validate($request, ['body' => 'required']);

        $post->comments()->create(
            [
            'body' => $request->body
            ]
        );
        flash()->overlay('Comment successfully created');

        return redirect("/posts/{$post->id}");
    }
}
