<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait ModelBelongsToUserTrait
{
    public function authorize(): bool
    {
        $modelId = $this->route('id');

        return app($this->model)::where('id', $modelId)
            ->where('user_id', Auth::id())->exists();
    }
}
