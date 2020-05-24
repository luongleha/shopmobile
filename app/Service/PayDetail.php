<?php

namespace App\Service;

use App\Repositories\CurlConnectionRepository;
use App\Repositories\PayDetailRepository;
use Matrix\Exception;

class PayDetail
{
    protected $pdmk_service;
    private $curl_connect;

    public function __construct(PayDetailRepository $pdmk_service, CurlConnectionRepository $curl_connect)
    {
        $this->pdmk_service = $pdmk_service;
        $this->curl_connect = $curl_connect;
    }

    public function paydetailList() {
        try {
            return $this->pdmk_service->paydetailList();
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function fbmarketListID($id) {
        try {
            return $this->pdmk_service->getListID($id);
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function paydetailcountList() {
        try {
            return $this->pdmk_service->paydetailcountList();
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function createPostOrder($data, $user) {
        try {
            return $this->pdmk_service->createPostOrder($data, $user);
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function editPostOrder($data, $user) {
        try {
            return $this->pdmk_service->editPostOrder($data, $user);
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function getPostCategory() {
        try {
            return $this->pdmk_service->getPostCategory();
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function deletePost($id) {
        try {
            $this->pdmk_service->deletePost($id);
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
