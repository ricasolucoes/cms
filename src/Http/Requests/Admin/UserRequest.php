<?php

namespace Cms\Http\Requests\Admin;

use Cms\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return null|string[]
     *
     * @psalm-return array{name?: 'required|min:3', email?: string, password?: 'required'}|null
     */
    public function rules(): ?array
    {
        if($this->segment(3)!="") {
            $user = User::find($this->segment(3));
        }

        switch($this->method())
        {
        case 'GET':
        case 'DELETE':
        {
              return [];
        }
        case 'POST':
        {
            return [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            ];
        }
        case 'PUT':
        case 'PATCH':
        {
            return [
                    'name' => 'required|min:3',
                    'email' => 'required|email|unique:users,email,'.$user->id,
                ];
        }
        default:
            break;
        }
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

}
