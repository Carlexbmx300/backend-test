<?php

namespace App\Repository;

use App\Entity\User;
use App\Exception\UserDoesNotExistException;
class UserRepository implements UserRepositoryInterface
{
    private $users = [];

    public function save(User $user): void
    {
        $this->users[$user->getId()] = $user;
    }

    public function update(User $user): void
    {
        if (isset($this->users[$user->getId()])) {
            $this->users[$user->getId()] = $user;
        }
    }

    public function delete(string $userId): void
    {
        unset($this->users[$userId]);
    }

    public function findById(string $userId): ?User
    {
        return $this->users[$userId] ?? null;
    }
    public function getByIdOrFail(string $id): User
    {
        foreach ($this->users as $user) {
            if ($user->getId() === $id) {
                return $user;
            }
        }
        throw new UserDoesNotExistException("User with ID $id does not exist");
    }
}