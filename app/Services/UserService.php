<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Requests\UserRequest;
use App\Repositories\UserRepository;
use Exception;

final class UserService
{
    public function __construct(private UserRepository $UserRepository)
    {}

    public function save(UserRequest $request): void
    {
        $this->UserRepository->save([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);
    }

    public function GetById($id)
    {
        $user = $this->UserRepository->find($id);

        if (null !== $user) {
            return $user;
        } else {
            throw new Exception('User doesnt exist');
        }
    }

    public function update(int $id, array $data): void
    {
        $user = $this->GetById($id);
        $this->UserRepository->update($id, [
            'name' => $data['name'],
            'email' => $data['email'],
        ]);
    }
}
