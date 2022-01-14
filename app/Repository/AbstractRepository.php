<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

abstract class AbstractRepository implements RepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    abstract public function getModelClass(): string;

    public function __construct()
    {
        $this->model = $this->make();
    }

    public function getOneById($id): ?Model
    {
        return $this->model->find($id);
    }

    public function getByIds(array $ids): Collection
    {
        return $this->model->whereIn($this->model->getKeyName(), $ids)->get();
    }

    /**
     * @return Collection|Model[]
     */
    public function getAll(): Collection
    {
        return $this->model->all();
    }

    public function make(array $attributes = []): Model
    {
        $model = app($this->getModelClass());

        foreach ($attributes as $key => $value) {
            $model->$key = $value;
        }

        return $model;
    }

    public function create(array $attributes = []): Model
    {
        $model = $this->make($attributes);
        $model->save();

        return $model;
    }

    public function save(array $data, ?Model $model = null): Model
    {
        if (!$model) {
            $model = $this->model;
        }
        foreach ($data as $key => $value) {
            $model->{$key} = $value;
        }

        $model->save();

        return $model;
    }
}
