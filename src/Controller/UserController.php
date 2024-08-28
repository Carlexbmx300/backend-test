<?php

namespace App\Controller;

use App\DTO\UserDTO;
use App\UseCase\SaveUser;
use App\Exception\UserDoesNotExistException;
use InvalidArgumentException;

class UserController
{
    private $saveUser;

    public function __construct(SaveUser $saveUser)
    {
        $this->saveUser = $saveUser;
    }

    public function createUser(array $requestData): void
    {
        try {
            $this->validate($requestData);
            $userRequest = new UserDTO(
                $requestData['id'],
                $requestData['name'],
                $requestData['email'],
                $requestData['password']
            );
            try {
                $this->saveUser->execute($userRequest);
                echo json_encode(
                    ['message' => 'User saved successfully.']);
            } catch (UserDoesNotExistException $e) {
                http_response_code(400);
                echo json_encode(['error' => $e->getMessage()]);
            }
        } catch (InvalidArgumentException  $th) {
            http_response_code(400);
            echo json_encode(['error' => $th->getMessage()]);
        }
       
    }
    private function validate(array $data): void
    {
        if (empty($data['id'])) {
            throw new InvalidArgumentException('Id is required');
        }

        if (empty($data['name'])) {
            throw new InvalidArgumentException('Name is required');
        }

        if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Valid email is required');
        }

        if (empty($data['password']) || strlen($data['password']) < 6) {
            throw new InvalidArgumentException('Password must be at least 6 characters long');
        }
    }
}
