<?php

namespace Cms\Http\Requests;

use Cms\Http\Rules\ReCaptchaRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ContactMessageRequest.
 *
 * @package Cms\Http\Requests
 */
class ContactMessageRequest extends FormRequest
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
            'email' => ['required', 'email', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:65535'],
        ];

        $reCaptchaRule = $this->container->make(ReCaptchaRule::class);
        if ($reCaptchaRule->isEnabled()) {
            $rules['g_recaptcha_response'] = ['required', $reCaptchaRule];
        }

        return $rules;
    }
}
