<?php
namespace App\Repositories\Interface;

interface BaseRepositoryInterface{
    public function all();

    public function get($column = ["*"]);
    public function paginate($number);
    public function find($id);

    public function create(array $data);

    public function update($id, array $data);

    public function delete($id);

}