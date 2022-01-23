<?php

namespace App\Traits;

trait ValidateIdFromRouteParameterTrait
{
    protected function prepareForValidation()
    {
        $this->merge(['id' => $this->route('id')]);
    }

    public function getModelId(): int
    {
        return $this->id;
    }
}
