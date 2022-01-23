<?php

namespace App\Http\Requests\Posts;

use App\Models\Post;
use App\Traits\ModelBelongsToUserTrait;
use App\Traits\ValidateIdFromRouteParameterTrait;
use Illuminate\Foundation\Http\FormRequest;

class EditPostRequest extends FormRequest
{
    use ModelBelongsToUserTrait, ValidateIdFromRouteParameterTrait;

    protected string $model = Post::class;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'exists:posts',
            'body' => 'string|nullable|max:255',
        ];
    }
}
