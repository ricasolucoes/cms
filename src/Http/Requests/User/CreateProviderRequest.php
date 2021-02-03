<?php

namespace Cms\Http\Requests\User;

class CreateProviderRequest extends Request
{
    /**
     * Class constructor.
     *
     * @param  array
     * @return void
     */
    public function __construct(array $rules = [])
    {
        parent::__construct(
            [
            'name' => [_('Name'), 'required|max:255|unique:providers,name{excludeCurrentId}'],
            ]
        );
    }
}
