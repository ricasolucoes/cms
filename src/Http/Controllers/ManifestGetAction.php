<?php

namespace Cms\Http\Controllers;

use Cms\Services\Manifest\Contracts\Manifest;
use Illuminate\Routing\ResponseFactory;

/**
 * Class ManifestGetAction.
 *
 * @package Cms\Http\Controllers
 */
class ManifestGetAction extends Controller
{
    /**
     * @var ResponseFactory
     */
    private $responseFactory;

    /**
     * @var Manifest
     */
    private $manifest;

    /**
     * ManifestGetAction constructor.
     *
     * @param ResponseFactory $responseFactory
     * @param Manifest        $manifest
     */
    public function __construct(ResponseFactory $responseFactory, Manifest $manifest)
    {
        $this->responseFactory = $responseFactory;
        $this->manifest = $manifest;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke()
    {
        $manifest = $this->manifest->get();

        return $this->responseFactory->json($manifest);
    }
}
