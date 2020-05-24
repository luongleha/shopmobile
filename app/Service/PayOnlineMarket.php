<?php

namespace App\Service;

use App\Repositories\CurlConnectionRepository;
use App\Repositories\PayOnlineMarketRepository;
use Matrix\Exception;

class PayOnlineMarket
{
    protected $pomk_service;
    private $curl_connect;

    public function __construct(PayOnlineMarketRepository $pomk_service, CurlConnectionRepository $curl_connect)
    {
        $this->pomk_service = $pomk_service;
        $this->curl_connect = $curl_connect;
    }

    public function payonlineList() {
        try {
            return $this->pomk_service->payonlineList();
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function payonlineconfirm($id, $user) {
        try {
            return $this->pomk_service->payonlineconfirm($id, $user);
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function fbmarketListID($id) {
        try {
            return $this->pomk_service->getListID($id);
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function payonlinecountList() {
        try {
            return $this->pomk_service->payonlinecountList();
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function createPostOrder($data, $user) {
        try {
            return $this->pomk_service->createPostOrder($data, $user);
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function editPostOrder($data, $user) {
        try {
            return $this->pomk_service->editPostOrder($data, $user);
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function getPostCategory() {
        try {
            return $this->pomk_service->getPostCategory();
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function deletePost($id) {
        try {
            $this->pomk_service->deletePost($id);
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
