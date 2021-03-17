<?php

namespace Cms\Http\Controllers;

use Illuminate\Http\Request;
use Cms\Repositories\FaqRepository;


class FaqController extends Controller
{
    protected $repository;

    public function __construct(FaqRepository $repository)
    {
        $this->repository = $repository;

        if (!in_array('faqs', config('siravel.active-core-features'))) {
            return redirect('/')->send();
        }
    }

    /**
     * Display all Faq entries.
     *
     * @param int $id
     *
     * @return Response
     */
    public function all()
    {
        $faqs = $this->repository->published();

        if (empty($faqs)) {
            abort(404);
        }

        return view('features.writelabel.faqs.all')->with('faqs', $faqs);
    }
}
