<?php
namespace App\Repositories;
use App\Repositories\Interface\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseRepositoryInterface{
    protected $model;

    public function __construct(Model $model){
        $this->model = $model;
    }
    public function all(){
        return $this->model->all();
    }
    public function get($column = ["*"]){
        return $this->model->get($column);
    }
    public function find($id){
        return $this->model->find($id);
    }
    public function paginate($number){
        return $this->model->paginate($number);
    }
    public function create(array $data){
        return $this->model->create($data);
    }
    public function update($id, array $data){
        return $this->model->where('id', $id)->update($data);
    }
    public function delete($id){
        return $this->model->where('id', $id)->delete();
    }
}