<?php
namespace AppRepo\Services;
use AppRepo\Repository\BaseRepositoryInterface;

abstract class BaseService
{
    protected $repo;

    public function __construct(BaseRepositoryInterface $repositoryInterface)
    {
        $this->repo =  $repositoryInterface;
    }

    public function store(array $data)
    {
        return $this->repo->create($data);
    }

    public function update($id,array $data)
    {
        return $this->repo->update($id,$data);
    }

    public function getAll()
    {
        return $this->repo->getAll();
    }

    public function getById($id)
    {
        return $this->repo->findById($id);
    }

    public function destroy($id)
    {
        $id = explode(',',$id);
       return  $this->repo->destroy($id);
    }

    public function getAllEnable()
    {
        return $this->repo->getAllEnable();
    }

    public function getBySlug($slug)
    {
        return $this->repo->findBySlug($slug);
    }
}