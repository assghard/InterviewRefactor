<?php

declare(strict_types=1);

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository
{
    protected Model $model;

    public function save(array $data): void
    {
        $this->model->create($data);
    }

    public function getById($id): array
    {
        return $this->model->where('id', $id)->get();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function getAll()
    {
        return $this->model->get();
    }

    public function getByEmail(string $email): array
    {
        return $this->model->where('email', $email)->get();
    }
}
