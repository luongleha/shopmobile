<?php

namespace App\Service;

use App\Repositories\CurlConnectionRepository;
use App\Repositories\UserRepository;
use Matrix\Exception;

class UserSevice
{
    protected $us_repository;
    private $curl_connect;

    public function __construct(UserRepository $us_repository, CurlConnectionRepository $curl_connect)
    {
        $this->us_repository = $us_repository;
        $this->curl_connect = $curl_connect;
    }

    public function userList() {
        try {
            return $this->us_repository->userList();
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function fbmarketListID($id) {
        try {
            return $this->us_repository->getListID($id);
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function userCountList() {
        try {
            return $this->us_repository->countList();
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function createUser($data, $user) {
        try {
            return $this->us_repository->createUser($data, $user);
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function editUser($data, $user) {
        try {
            return $this->us_repository->editUser($data, $user);
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function deleteUser($id, $user) {
        try {
            $this->us_repository->deleteUser($id, $user);
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
