<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Api\ClientService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ClientController extends Controller
{
    protected $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    public function addFavoriteApi(Request $request)
    {
        $data = [
            'client_id' => $request->get('client_id'),
            'comic_id' => $request->get('comic_id'),
        ];
        $this->data['result'] =  $this->clientService->addFavorite($data);
        return $this->sendResult(Response::HTTP_OK, 'Add Favorite Success', $this->data);
    }

    public function removeFavoriteApi(Request $request)
    {
        $params = [
            'client_id' => $request->get('client_id'),
            'comic_id' => $request->get('comic_id'),
        ];
        $this->data['detele'] = $this->clientService->removeFavorite($params);
        return $this->sendResult(Response::HTTP_OK, 'Remove Favorite Success', $this->data['detele']);
    }

    public function getListComicFavoriteApi($clientId)
    {
        $this->data['clients'] = $this->clientService->getListComicFavorite($clientId);
        return $this->sendResult(Response::HTTP_OK, 'Get List Favorite', $this->data);
    }

    public function checkFavoriteApi($clientId, $comicId)
    {
        $this->data['favorite'] = $this->clientService->checkFavorite($clientId, $comicId);
        if(empty($this->data['favorite'])){
            return $this->sendError(Response::HTTP_BAD_REQUEST, 'Not Favorite');
        }
        return $this->sendResult(Response::HTTP_OK, 'Is Favorite', '');
    }
}
