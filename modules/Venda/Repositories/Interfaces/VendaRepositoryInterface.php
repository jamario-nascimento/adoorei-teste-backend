<?php

namespace Modules\Venda\Repositories\Interfaces;

interface VendaRepositoryInterface
{
    public function all();
    public function find($id,$param);
    public function create(array $data);
    public function update($update);
    public function delete($delete);
}
