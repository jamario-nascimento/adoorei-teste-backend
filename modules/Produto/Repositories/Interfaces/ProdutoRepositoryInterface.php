<?php

namespace Modules\Produto\Repositories\Interfaces;

interface ProdutoRepositoryInterface
{
    public function all();
    public function find($id,$param);
    public function create(array $data);
    public function update($update);
    public function delete($delete);
}
