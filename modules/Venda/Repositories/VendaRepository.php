<?php

namespace Modules\Vennda\Repositories;

use App\Http\Repositories\BaseRepository;
use Modules\Venda\Entities\Venda;
use Modules\Venda\Repositories\Interfaces\VendaRepositoryInterface;

class VendaRepository extends BaseRepository implements VendaRepositoryInterface
{
    public function __construct(Venda $venda)
    {
        $this->model = $venda;
    }

}
