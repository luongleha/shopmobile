<?php

namespace App\Service;

use App\Repositories\CurlConnectionRepository;
use App\Repositories\ProductMarketRepository;
use Matrix\Exception;

class ProductMarket 
{
    protected $fbmk_repository;
    private $curl_connect;

    public function __construct(ProductMarketRepository $fbmk_repository, CurlConnectionRepository $curl_connect)
    {
        $this->fbmk_repository = $fbmk_repository;
        $this->curl_connect = $curl_connect;
    }

    public function fbmarketList() {
        try {
            return $this->fbmk_repository->getList();
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function fbmarketListID($id) {
        try {
            return $this->fbmk_repository->getListID($id);
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function fbmarketcountList() {
        try {
            return $this->fbmk_repository->countList();
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function createPostOrder($data, $user) {
        try {
            return $this->fbmk_repository->createPostOrder($data, $user);
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function editPostOrder($data, $user) {
        try {
            return $this->fbmk_repository->editPostOrder($data, $user);
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function getPostCategory() {
        try {
            return $this->fbmk_repository->getPostCategory();
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function deletePost($id) {
        try {
            $this->fbmk_repository->deletePost($id);
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
