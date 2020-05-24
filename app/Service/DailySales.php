<?php

namespace App\Service;

use App\Repositories\CurlConnectionRepository;
use App\Repositories\DailySalesRepository;
use Matrix\Exception;

class DailySales
{
    protected $dsmk_service;
    private $curl_connect;

    public function __construct(DailySalesRepository $dsmk_service, CurlConnectionRepository $curl_connect)
    {
        $this->dsmk_service = $dsmk_service;
        $this->curl_connect = $curl_connect;
    }

    public function dailysalelList($today) {
        try {
            return $this->dsmk_service->dailysalelList($today);
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function dailysalecountList($today) {
        try {
            return $this->dsmk_service->dailysalecountList($today);
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function createDailySale($data, $user, $today, $count) {
        try {
            return $this->dsmk_service->createDailySale($data, $user, $today, $count);
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function showdailysalelList() {
        try {
            return $this->dsmk_service->showdailysalelList();
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function showdailysalecountList() {
        try {
            return $this->dsmk_service->showdailysalecountList();
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
