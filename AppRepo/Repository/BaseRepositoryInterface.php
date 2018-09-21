<?php
namespace AppRepo\Repository;

interface BaseRepositoryInterface
{
    public function create($data);

    public function update($id, $data);

    public function findById($id);

    public function getAll();

    public function destroy(array $id);

    public function findBySlug($slug);

    public function getAllEnable();
}