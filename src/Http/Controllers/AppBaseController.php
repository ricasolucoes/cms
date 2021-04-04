<?php

namespace Cms\Http\Controllers;

use InfyOm\Generator\Utils\ResponseUtil;
use Response;

/**
 * @SWG\Swagger(
 *   basePath="/api/v1",
 * @SWG\Info(
 *     title="Laravel Generator APIs",
 *     version="1.0.0",
 *   )
 * )
 * This class should be parent class for other API controllers
 * Class AppBaseController
 */
class AppBaseController extends Controller
{
    public $modelFeatures = [
        'page' => [
            'model' => 'Cms\\Models\\Negocios\\Page',
            'repository' => 'Cms\\Repositories\\Negocios\\PageRepository',
        ]
    ];
    public function sendResponse($result, $message)
    {
        return Response::json(ResponseUtil::makeResponse($message, $result));
    }

    public function sendError($error, $code = 404)
    {
        return Response::json(ResponseUtil::makeError($error), $code);
    }

    public function getFeature($code)
    {
        if (!isset($this->modelFeatures[$code])) {
            return false;
        }
        return $this->modelFeatures[$code];
    }
    // public function getFeatures($code = false, $atr = 'model')
    // {

    // }
}
