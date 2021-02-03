<?php

namespace Cms\Http\Requests;

use Auth;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Cms\Models\Blog\Blog;

class BlogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (config('app.env') !== 'testing') {
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
        return app(Blog::class)->rules;
    }
}
