<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FriendInvitationRequest extends FormRequest
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
        return [
            'invitee_id' => 'required|exists:users,id',
            'message' => 'string'
        ];
    }

    public function messages()
    {
        return [
            'id.required' => __('validation.friendlist.id.required'),
            'id.exists' => __('validation.friendlist.id.exists'),
        ];
    }
}
