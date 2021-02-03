<?php

namespace Cms\Http\Requests;

use Auth;
use Gate;
use Cms\Models\Negocios\Page;
use Illuminate\Foundation\Http\FormRequest;

class PagesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (\Illuminate\Support\Facades\Config::get('app.env') !== 'testing') {
            return Gate::allows('siravel', Auth::user());
        }

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return app(Page::class)->rules;
    }
}
