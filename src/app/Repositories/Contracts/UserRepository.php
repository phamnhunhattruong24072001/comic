<?php

namespace App\Repositories\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface UserRepository.
 *
 * @package namespace App\Repositories\Contracts;
 */
interface UserRepository extends RepositoryInterface
{
   public function deleteMultiple(array $ids);

   public function forceDeleteMultiple(array $ids);

   public function restoreMultiple(array $ids);
}
