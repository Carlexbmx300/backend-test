<?php

use PHPUnit\Framework\TestCase;
use App\Entity\User;

class UserTest extends TestCase
{
    public function testUserCreation()
    {
        $user = new User('1', 'Carlos Aguilar', 'carlosaguilarangulo@gmail.com', '12345678');
        $this->assertEquals('Carlos Aguilar', $user->getName());
        $this->assertEquals('carlosaguilarangulo@gmail.com', $user->getEmail());
    }

    public function testUserModification()
    {
        $user = new User('1', 'Carlos Aguilar', 'carlosaguilarangulo@gmail.com', '12345678');
        $user->setName('Eduardo Angulo');
        $this->assertEquals('Eduardo Angulo', $user->getName());
    }
}
