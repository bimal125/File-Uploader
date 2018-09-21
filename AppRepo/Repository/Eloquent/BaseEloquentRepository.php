<?php
namespace AppRepo\Repository\Eloquent;
use Illuminate\Database\Eloquent\Model;
use AppRepo\Repository\BaseRepositoryInterface;

class BaseEloquentRepository implements BaseRepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }
    
    public function create($data)
    {
        return $this->model->create($data);
    }

    public function update($id,$data)
    {
        return $this->model->find($id)->update($data);
    }

    public function findById($id)
    {
        return $this->model->find($id);
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function destroy(array $id)
    {
        return $this->model->destroy($id);
    }

    public function getAllEnable()
    {
        return $this->model->where('status','=',1)->get();
    }

    public function findBySlug($slug)
    {
        return $this->model->where('slug','=',$slug)->first();
    }
}