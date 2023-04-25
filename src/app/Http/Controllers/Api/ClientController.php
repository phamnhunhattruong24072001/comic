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
        $this->clientService->addFavorite($data);
        return $this->sendResult(Response::HTTP_OK, 'Get Header', '');
    }

    public function removeFavoriteApi(Request $request)
    {
        $params = [
            'client_id' => $request->get('client_id'),
            'comic_id' => $request->get('comic_id'),
        ];
        $this->clientService->removeFavorite($params);
        return $this->sendResult(Response::HTTP_OK, 'Get Header', '');
    }

    public function getListComicFavoriteApi($clientId)
    {
        $this->data['comics'] = $this->clientService->getListComicFavorite($clientId);
        return $this->sendResult(Response::HTTP_OK, 'Get Header', $this->data);
    }

    public function checkFavorite($clientId, $comicId)
    {
        $this->data['favorite'] = $this->clientService->checkFavorite($clientId, $comicId);
        return $this->sendResult(Response::HTTP_OK, 'Get Header', $this->data);
    }
}
