<?php

namespace App\Http\Requests\Posts;

use App\Models\Comment;
use App\Traits\ValidateIdFromRouteParameterTrait;
use Illuminate\Foundation\Http\FormRequest;

class CommentPostRequest extends FormRequest
{
    use ValidateIdFromRouteParameterTrait;

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
        return [
            'id' => 'exists:posts,id',
            'comment' => 'required|string|max:255|min:1',
        ];
    }
}
