<?php

namespace App\Services\Api;

use App\Services\BaseService;
use App\Repositories\Contracts\ClientRepository;
use Illuminate\Support\Facades\DB;

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
        return DB::table('comic_favorites')->insert(
            [
                'client_id' => $data['client_id'],
                'comic_id' => $data['comic_id'],
            ]
        );
    }

    public function removeFavorite($params)
    {
        $client = $this->clientRepository->with('favorites')->find($params['client_id']);
        return $client->favorites()->wherePivot('comic_id', $params['comic_id'])->detach();
    }

    public function getListComicFavorite($clientId)
    {
        return $this->clientRepository->with('favorites')->find($clientId);
    }

    public function checkFavorite($clientId, $comicId)
    {
        return $this->clientRepository
            ->whereHas('favorites', function ($query) use ($clientId, $comicId) {
                $query->where('comic_id', $comicId);
                $query->where('client_id', $clientId);
            })
            ->first();
    }

    public function addFollow($data)
    {
        return DB::table('comic_favorites')->insert(
            [
                'client_id' => $data['client_id'],
                'comic_id' => $data['comic_id'],
            ]
        );
    }

    public function removeFollow($params)
    {
        $client = $this->clientRepository->with('favorites')->find($params['client_id']);
        return $client->favorites()->wherePivot('comic_id', $params['comic_id'])->detach();
    }

    public function getListComicFollow($clientId)
    {
        return $this->clientRepository->with('favorites')->find($clientId);
    }

    public function checkFollow($clientId, $comicId)
    {
        return $this->clientRepository
            ->whereHas('follows', function ($query) use ($clientId, $comicId) {
                $query->where('comic_id', $comicId);
                $query->where('client_id', $clientId);
            })
            ->first();
    }
}
