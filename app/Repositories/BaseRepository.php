<?php

namespace App\Repositories;

use App\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements RepositoryInterface
{
    protected Model $model;

    /**
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        return $this->model->all();
    }

    /**
     * @param array $params
     * @return array
     */
    public function getWhere(array $params): array
    {
        return $this->model->where(function ($query) use ($params) {
            foreach ($params as $key => $value) {
                $query->andwhere($key, $value);
            }
        })->get();
    }
}
