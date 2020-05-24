<?php

namespace App\Service;

use App\Repositories\CurlConnectionRepository;
use App\Repositories\CategoryMarketRepository;
use Matrix\Exception;

class CategoryMarket
{
    protected $ctmk_repository;
    private $curl_connect;

    public function __construct(CategoryMarketRepository $ctmk_repository, CurlConnectionRepository $curl_connect)
    {
        $this->ctmk_repository = $ctmk_repository;
        $this->curl_connect = $curl_connect;
    }

    public function catemarketList() {
        try {
            return $this->ctmk_repository->getList();
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function catemarketListID($id) {
        try {
            return $this->ctmk_repository->getListID($id);
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function catemarketcountList() {
        try {
            return $this->ctmk_repository->countList();
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function createCategory($data, $user) {
        try {
            return $this->ctmk_repository->createCategory($data, $user);
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function updateCategory($data, $user) {
        try {
            return $this->ctmk_repository->updateCategory($data, $user);
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function deleteCategory($id, $user) {
        try {
            $this->ctmk_repository->deleteCategory($id, $user);
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
