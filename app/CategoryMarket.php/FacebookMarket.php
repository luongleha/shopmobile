<?php

namespace App\Service;

use App\Repositories\CurlConnectionRepository;
use App\Repositories\FacebookMarketRepository;
use Matrix\Exception;

class FacebookMarket
{
    protected $fbmk_repository;
    private $curl_connect;

    public function __construct(FacebookMarketRepository $fbmk_repository, CurlConnectionRepository $curl_connect)
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

    public function getPostSignature() {
        try {
            return $this->fbmk_repository->getPostSignature();
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

    // public function getListFacebookAccount($request) {
    //     $limit = '?limit=';
    //     if($request->limit) {
    //         $limit = $limit.$request->limit;
    //     }
    //     $page = '&page=';
    //     if($request->page) {
    //         $page = $page.$request->page;
    //     }

    //     $option = 1;
    //     $url = config('system.url_account').config('system.prefix_api').config('system.uri.fb_user.list').$limit.$page;

    //     $token = 'Authorization: JWT '.$_COOKIE['auth_user'];
    //     $curl = $this->curl_connect->curl_set_get($option, $url, $token);
    //     return $this->curl_connect->curl_get($curl);
    // }

    public function getPostResource() {
        try {
            return $this->fbmk_repository->getAllPost();
        } catch (\Throwable $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getHistoryResource() {
        try {
            return $this->fbmk_repository->getAllHistory();
        } catch (\Throwable $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getCookieResource() {
        try {
            return $this->fbmk_repository->getAllCookie();
        } catch (\Throwable $e) {
            throw new Exception($e->getMessage());
        }
    }

    // public function getHistoryPost($request) {
    //     try {
    //         return $this->fbmk_repository->getHistoryPost($request);
    //     } catch (\Throwable $e) {
    //         throw new Exception($e->getMessage());
    //     }
    // }

}
