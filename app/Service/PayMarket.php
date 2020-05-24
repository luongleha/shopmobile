<?php

namespace App\Service;

use App\Repositories\CurlConnectionRepository;
use App\Repositories\PayMarketRepository;
use Matrix\Exception;

class PayMarket
{
    protected $pmk_repository;
    private $curl_connect;

    public function __construct(PayMarketRepository $pmk_repository, CurlConnectionRepository $curl_connect)
    {
        $this->pmk_repository = $pmk_repository;
        $this->curl_connect = $curl_connect;
    }

    public function fbmarketList() {
        try {
            return $this->pmk_repository->getList();
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function fbmarketListID($id) {
        try {
            return $this->pmk_repository->getListID($id);
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function fbmarketcountList() {
        try {
            return $this->pmk_repository->countList();
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function createPostOrder($data, $user) {
        try {
            return $this->pmk_repository->createPostOrder($data, $user);
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function editPostOrder($data, $user) {
        try {
            return $this->pmk_repository->editPostOrder($data, $user);
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function getPostCategory() {
        try {
            return $this->pmk_repository->getPostCategory();
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function deletePost($id) {
        try {
            $this->pmk_repository->deletePost($id);
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function createBillOrder($data, $user, $items) {
        try {
            return $this->pmk_repository->createBillOrder($data, $user, $items);
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
