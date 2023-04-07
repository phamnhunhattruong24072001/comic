<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Admin\FigureService;
use Illuminate\Http\Request;

class FigureController extends Controller
{
    protected $figureService;
    public function __construct(FigureService $figureService)
    {
        $this->figureService = $figureService;
    }
}
