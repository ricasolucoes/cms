<?php

namespace Cms\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RssController extends AppBaseController
{
    protected $repo;

    public function __construct(Request $request)
    {
        parent::__construct();

        $url = $request->segment(1) ?? 'page';

        $this->module = str_singular($url);

        if (!$feature = $this->getFeature($this->module)){
            \Log::info('Não autorizado feature !!');
            return redirect('/')->send();
        }

        $this->repo = app($feature['repository']);
    }

    public function index(Request $request)
    {
        $module = $this->module;

        $meta = \Illuminate\Support\Facades\Config::get(
            'cms.rss', [
            'title' => \Illuminate\Support\Facades\Config::get('app.name'),
            'link' => url('/'),
            ]
        );

        $items = $this->repo->published();

        $contents = view('rss', compact('items', 'meta', 'module'));

        return new Response(
            $contents, 200, [
            'Content-Type' => 'application/xml;charset=UTF-8',
            ]
        );
    }
}
