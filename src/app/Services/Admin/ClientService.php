<?php

namespace App\Services\Admin;

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
}
