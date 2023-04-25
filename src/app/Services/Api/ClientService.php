<?php

namespace App\Services\Api;

use App\Services\BaseService;
use App\Repositories\Contracts\ClientRepository;

class ClientService extends BaseService
{
    protected $clientRepository;

    public function __construct(ClientRepository $clientRepository)
    {
        parent::__construct($clientRepository);
        $this->clientRepository = $clientRepository;
    }

    public function addFavorite($data)
    {
        return $this->clientRepository->create(
            [
                'client_id' => $data['client_id'],
                'comic_id' => $data['comic_id'],
            ]
        );
    }

    public function removeFavorite($params)
    {
        $favorite = $this->clientRepository
            ->whereHas('favorites', function ($query) use ($params) {
                $query->where('comic_id', $params['comic_id']);
                $query->where('client_id', $params['client_id']);
            })
            ->first();
        $favorite->delete();
    }

    public function getListComicFavorite($clientId)
    {
        return $this->clientRepository->with('favorites')->select('id')->find($clientId);
    }

    public function checkFavorite($clientId, $comicId)
    {
        return $this->clientRepository
            ->whereHas('favorites', function ($query) use ($params) {
                $query->where('comic_id', $params['comic_id']);
                $query->where('client_id', $params['client_id']);
            })
            ->first();
    }

}
