<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Api\ClientService;
use App\Services\Admin\ComicService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ClientController extends Controller
{
    protected $clientService;
    protected $comicService;

    public function __construct(ClientService $clientService, ComicService $comicService)
    {
        $this->clientService = $clientService;
        $this->comicService = $comicService;
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

    public function checkFavoriteApi($clientId, $slug)
    {
        $comicId = $this->comicService->findComicBySlug($slug, ['id']);
        $this->data['favorite'] = $this->clientService->checkFavorite($clientId, $comicId->id);
        if(empty($this->data['favorite'])){
            return $this->sendError(Response::HTTP_BAD_REQUEST, 'Not Favorite');
        }
        return $this->sendResult(Response::HTTP_OK, 'Is Favorite', '');
    }

    // Follow
    public function addFollowApi(Request $request)
    {
        $data = [
            'client_id' => $request->get('client_id'),
            'comic_id' => $request->get('comic_id'),
        ];
        $this->data['result'] =  $this->clientService->addFollow($data);
        return $this->sendResult(Response::HTTP_OK, 'Add Follow Success', $this->data);
    }

    public function removeFollowApi(Request $request)
    {
        $params = [
            'client_id' => $request->get('client_id'),
            'comic_id' => $request->get('comic_id'),
        ];
        $this->data['detele'] = $this->clientService->removeFollow($params);
        return $this->sendResult(Response::HTTP_OK, 'Remove Follow Success', $this->data['detele']);
    }

    public function getListComicFollowApi($clientId)
    {
        $this->data['clients'] = $this->clientService->getListComicFollow($clientId);
        return $this->sendResult(Response::HTTP_OK, 'Get List Follow', $this->data);
    }

    public function checkFollowApi($clientId, $slug)
    {
        $comicId = $this->comicService->findComicBySlug($slug, ['id']);
        $this->data['follow'] = $this->clientService->checkFollow($clientId, $comicId->id);
        if(empty($this->data['follow'])){
            return $this->sendError(Response::HTTP_BAD_REQUEST, 'Not Follow');
        }
        return $this->sendResult(Response::HTTP_OK, 'Is Follow', '');
    }
}
