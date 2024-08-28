<?php

namespace App\Repository;

use App\Entity\User;

interface UserRepositoryInterface
{
    public function save(User $user): void;
    public function update(User $user): void;
    public function delete(string $userId): void;
    public function findById(string $userId): ?User;
}