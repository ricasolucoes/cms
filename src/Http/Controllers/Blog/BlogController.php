<?php

namespace Cms\Http\Controllers\Blog;

use Cms\Http\Controllers\Controller;
use Cms\Repositories\BlogRepository;

class BlogController extends Controller
{
    /**
     * @var BlogRepository 
     */
    private $blogRepository;

    public function __construct(BlogRepository $blogRepo)
    {
        $this->blogRepository = $blogRepo;

        if (!in_array('blog', config('Cms.active-core-features'))) {
            return redirect('/')->send();
        }
    }

    /**
     * Display all Blog entries.
     *
     * @param int $id
     *
     * @return Response
     */
    public function all()
    {
        $blogs = $this->blogRepository->publishedAndPaginated();
        $tags = $this->blogRepository->allTags();

        if (empty($blogs)) {
            abort(404);
        }

        return view('features.blogs.blogs.all')
            ->with('tags', $tags)
            ->with('blogs', $blogs);
    }

    /**
     * Display all Blog entries.
     *
     * @param int $id
     *
     * @return Response
     */
    public function tag($tag)
    {
        $blogs = $this->blogRepository->tags($tag);
        $tags = $this->blogRepository->allTags();

        if (empty($blogs)) {
            abort(404);
        }

        return view('features.blogs.blogs.all')
            ->with('tags', $tags)
            ->with('blogs', $blogs);
    }

    /**
     * Display the specified Blog.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($url)
    {
        $blog = $this->blogRepository->findBlogsByURL($url);

        if (empty($blog)) {
            abort(404);
        }

        return view('features.blog.'.$blog->template)->with('blog', $blog);
    }
}
