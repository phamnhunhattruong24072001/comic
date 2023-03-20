<?php
namespace App\Services\Admin;

use App\Repositories\Contracts\PermissionRepository;
use Illuminate\Http\Request;

class PermissionService
{
   protected $permissionRepository;

   public function __construct(PermissionRepository $permissionRepository)
   {
        $this->permissionRepository = $permissionRepository;
   }

   public function getAll()
   {
        return $this->permissionRepository->whereType('group')->get('*');
   }
}