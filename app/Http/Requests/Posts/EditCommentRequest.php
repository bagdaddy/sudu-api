<?php

namespace App\Http\Requests\Posts;

use App\Models\Comment;
use App\Traits\ModelBelongsToUserTrait;
use App\Traits\ValidateIdFromRouteParameterTrait;
use Illuminate\Foundation\Http\FormRequest;

class EditCommentRequest extends FormRequest
{
    use ModelBelongsToUserTrait, ValidateIdFromRouteParameterTrait;

    protected string $model = Comment::class;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'exists:comments',
            'comment' => 'required|string|max:255|min:1',
        ];
    }
}
