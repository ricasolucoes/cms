<?php

namespace Cms\Http\Controllers;

use Illuminate\Http\Request;
use Cms\Repositories\FaqRepository;
use Templeiro;

class FaqController extends Controller
{
    protected $repository;

    public function __construct(FaqRepository $repository)
    {
        $this->repository = $repository;

        if (!\Features::isActive('faqs')) {
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

        return Templeiro::populateView('faqs.all', ['faqs' => $faqs]);
    }
}
