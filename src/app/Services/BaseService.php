<?php

namespace App\Services;

class BaseService
{
    protected $repository;

    public function __construct($repository)
    {
        $this->repository = $repository;
    }

    public function getListModelPaginate($param, $columns = ['*'])
    {
        $result = $this->repository->scopeQuery(function ($query) use ($param) {
            return $query;
        })
            ->orderBy('created_at', 'DESC');
        return $result->paginate($param['limit'], $columns);
    }

    public function storeModel($data)
    {
        return $this->repository->create($data);
    }

    public function updateModel($data, $id)
    {
        return $this->repository->update($data, $id);
    }

    public function forceDeleteMultiple(array $ids)
    {
        return $this->repository->forceDeleteMultiple($ids);
    }

    public function restoreMultiple(array $ids)
    {
        return $this->repository->restoreMultiple($ids);
    }

    public function deleteMultiple(array $ids)
    {
        return $this->repository->deleteMultiple($ids);
    }

    public function getAll($columns = ['*'])
    {
        return $this->repository->active()->select($columns)->get();
    }

    public function findModelById($id, $columns = ['*'])
    {
        return $this->repository->find($id, $columns);
    }

    public function getListTrashModelPaginate($param, $columns = ['*'])
    {
        $result = $this->repository->scopeQuery(function ($query) use ($param) {
            $query->onlyTrashed();
            return $query;
        });
        $result->orderBy('created_at', 'DESC');
        return $result->paginate($param['limit'], $columns);
    }

    public function findModelByField($field, $value, $columns = ['*'])
    {
        return $this->repository->findByField($field, $value, $columns)->first();
    }

    public function getListByField($field, $value, $columns = ['*'], $col = "created_at", $order = "DESC")
    {
        $result = $this->repository->scopeQuery(function ($query) use ($field, $value) {
            $query->where($field, $value);
            return $query;
        });
        $result->orderBy($col, $order);
        return $result->get($columns);
    }
}
