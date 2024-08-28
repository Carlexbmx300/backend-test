<?php

use PHPUnit\Framework\TestCase;
use App\Entity\User;
use App\Repository\UserRepository;
use App\UseCase\SaveUser;
use App\DTO\UserDTO;
class SaveUserTest extends TestCase
{
    public function testUserIsSaved()
    {
        $repository = new UserRepository();
        $useCase = new SaveUser($repository);

        $userRequest = new UserDTO('1', 'Carlos Aguilar', 'carlosaguilarangulo@gmail.com', '12345678');
        $useCase->execute($userRequest);
        
        $user = $repository->findById('1');

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals('Carlos Aguilar', $user->getName());
    }
    public function testWhenUserIsNotFoundByIdErrorIsThrown()
    {
        $this->expectException(\Exception::class);

        $repository = new UserRepository();
        $user = $repository->findById('invalid_id');

        if (!$user) {
            throw new \Exception("User does not exist");
        }
    }
}
