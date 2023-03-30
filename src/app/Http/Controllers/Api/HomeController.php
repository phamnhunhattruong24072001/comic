<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\UserService;

class HomeController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function getListTopComic()
    {
        return response()->json([
            [
                'id' => 1,
                'name' => 'Onepiece 1',
                'image' => 'https://m.media-amazon.com/images/M/MV5BODcwNWE3OTMtMDc3MS00NDFjLWE1OTAtNDU3NjgxODMxY2UyXkEyXkFqcGdeQXVyNTAyODkwOQ@@._V1_.jpg',
                'chapter' => '1000/?',
            ],
            [
                'id' => 2,
                'name' => 'Onepiece 2',
                'image' => 'https://m.media-amazon.com/images/M/MV5BODcwNWE3OTMtMDc3MS00NDFjLWE1OTAtNDU3NjgxODMxY2UyXkEyXkFqcGdeQXVyNTAyODkwOQ@@._V1_.jpg',
                'chapter' => '1000/?',
            ],
            [
                'id' => 3,
                'name' => 'Onepiece 3',
                'image' => 'https://m.media-amazon.com/images/M/MV5BODcwNWE3OTMtMDc3MS00NDFjLWE1OTAtNDU3NjgxODMxY2UyXkEyXkFqcGdeQXVyNTAyODkwOQ@@._V1_.jpg',
                'chapter' => '1000/?',
            ],

        ]);
    }

    public function getListUser()
    {

        $data = $this->userService->getListUserPaginate(['limit' => 1]);
        return response()->json([
            $data,
        ]);
    }
}
