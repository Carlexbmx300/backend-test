<?php

use PHPUnit\Framework\TestCase;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Exception\UserDoesNotExistException;
class UserRepositoryTest extends TestCase
{
    public function testUserCanBeSavedAndRetrieved()
    {
        $repository = new UserRepository();
        $user = new User('1', 'Carlos Aguilar', 'carlosaguilarangulo@gmail.com', '12345678');

        $repository->save($user);

        $retrievedUser = $repository->findById('1');

        $this->assertInstanceOf(User::class, $retrievedUser);
        $this->assertEquals('Carlos Aguilar', $retrievedUser->getName());
    }

    public function testWhenUserIsNotFoundByIdErrorIsThrown()
    {
        $this->expectException(UserDoesNotExistException::class);

        $repository = new UserRepository();
        $repository->getByIdOrFail('invalid_id');
    }
}
