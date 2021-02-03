<?php

namespace Cms\Http\Requests;

use Cms\Http\Rules\ReCaptchaRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CreateAuthRequest.
 *
 * @package Cms\Http\Requests
 */
class CreateAuthRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];

        $reCaptchaRule = $this->container->make(ReCaptchaRule::class);
        if ($reCaptchaRule->isEnabled()) {
            $rules['g_recaptcha_response'] = ['required', $reCaptchaRule];
        }

        return $rules;
    }
}
