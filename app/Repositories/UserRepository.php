<?php

namespace App\Repositories;

use App\Models\User;

final class UserRepository extends AbstractRepository
{
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function update(int $id, array $updateData): void
    {
        $this->model->where('id', $id)->update($updateData);
    }
}
