<?php

namespace Modules\Venda\Services;

use Illuminate\Support\Facades\DB;
use Modules\Venda\Entities\Venda;
use Modules\Venda\Repositories\Interfaces\VendaRepositoryInterface;
use Modules\Venda\Services\Interfaces\VendaServiceInterface;

class VendaService implements VendaServiceInterface
{

    protected $vendaRepository;

    public function __construct(VendaRepositoryInterface $vendaRepository)
    {
        $this->vendaRepository = $vendaRepository;
    }

    public function list()
    {
        return $this->vendaRepository->all();
    }

    public function find($id, $param = null)
    {
        return $this->vendaRepository->find($id,$param);
    }

    public function create(array $venda)
    {
        $venda['amount'] = $venda['amount'];
        $venda['sales_id'] = $venda['sales_id'];

        DB::beginTransaction();
        $objVenda = $this->vendaRepository->create($venda); 
        $auxVenda = $this->find($objVenda->id,['with' => ['produtos']]);
        $auxVenda->produtos()->attach($venda['produtos']);
        DB::commit();
 
        return $objVenda;

    }

    public function update(array $venda)
    {
        DB::beginTransaction();
        $update = $this->find($venda['sales_id'],['with' => ['produtos']]);
        $update['amount'] = $venda['amount'];

        $update->produtos()->detach($update->products);

        if(!empty($venda['produtos'])) {
            $update->produtos()->attach($venda['produtos']);
        }
        DB::commit();
        return $this->vendaRepository->update($update);
    }

    public function delete($venda)
    {
        $delete = $this->find($venda['sales_id'],['with' => ['produtos']]);

        $delete->produtos()->detach($delete->produtos);


        return $this->vendaRepository->delete($delete);
    }
}
