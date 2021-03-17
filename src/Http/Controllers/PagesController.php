<?php

namespace Cms\Http\Controllers;

use Illuminate\Http\Request;
use Cms\Repositories\Negocios\PageRepository;
use Cms;
use Templeiro;

class PagesController extends Controller
{
    protected $repository;

    public function __construct(PageRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Homepage.
     *
     * @param string $url
     *
     * @return Response
     */
    public function home()
    {
        Cms::notification('Ola');
        $page = $this->repository->findPagesByURL('home');

        $vars = [];
        if (!is_null($page)) {
            $vars = ['page' => $page];
        }

        return Templeiro::populateView('pages.home', $vars);
    }

    /**
     * Display page list.
     *
     * @return Response
     */
    public function all()
    {
        $pages = $this->repository->published();

        if (empty($pages)) {
            abort(404);
        }

        return Templeiro::populateView('pages.all', [
            'pages' => $pages
        ]);
    }

    /**
     * Display the specified Page.
     *
     * @param string $url
     *
     * @return Response
     */
    public function show($url)
    {
        $page = $this->repository->findPagesByURL($url);

        if (empty($page)) {
            abort(404);
        }

        $template = $page->template;
        if (empty($page->template)) {
            $template = 'show';
        }

        return Templeiro::populateView('pages.'.$template, [
            'page' => $page
        ]);
    }
}
