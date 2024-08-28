<?php

namespace App\UseCase;

use App\DTO\UserDTO;
use App\Entity\User;
use App\Repository\UserRepositoryInterface;

class SaveUser
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(UserDTO $request): void
    {
        $user = new User(
            $request->getId(), 
            $request->getName(), 
            $request->getEmail(),
            $request->getPassword()
        );
        $this->userRepository->save($user);
    }
}