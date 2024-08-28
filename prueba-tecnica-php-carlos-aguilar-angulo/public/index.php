<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controller\UserController;
use App\Repository\UserRepository;
use App\UseCase\SaveUser;

$userRepository = new UserRepository();
$saveUserUseCase = new SaveUser($userRepository);
$userController = new UserController($saveUserUseCase);

if ($_SERVER['REQUEST_URI'] === '/save-user' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $jsonData = file_get_contents('php://input');
    $data = json_decode($jsonData, true);

    $id = $data['id'] ?? '';
    $name = $data['name'] ?? '';
    $email = $data['email'] ?? '';
    $password = $data['password'] ?? '';

    $userController->createUser($data);
} else {
    echo "404 Not Found";
}
