<?php

namespace Modules\Produto\Repositories;

use App\Http\Repositories\BaseRepository;
use Modules\Produto\Entities\Produto;
use Modules\Produto\Repositories\Interfaces\ProdutoRepositoryInterface;

class ProdutoRepository extends BaseRepository implements ProdutoRepositoryInterface
{
    public function __construct(Produto $produto)
    {
        $this->model = $produto;
    }

}
