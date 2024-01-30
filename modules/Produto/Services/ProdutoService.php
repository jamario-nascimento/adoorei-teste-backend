<?php

namespace Modules\Produto\Services;

use Illuminate\Support\Facades\DB;
use Modules\Produto\Repositories\Interfaces\ProdutoRepositoryInterface;
use Modules\Produto\Services\Interfaces\ProdutoServiceInterface;

class ProdutoService implements ProdutoServiceInterface
{

    protected $produtoRepository;

    public function __construct(ProdutoRepositoryInterface $produtoRepository)
    {
        $this->produtoRepository = $produtoRepository;
    }

    public function list()
    {
        return $this->produtoRepository->all();
    }

    public function find($id, $param = null)
    {
        return $this->produtoRepository->find($id,$param);
    }

    public function create(array $produto)
    {
        $produto['name'] = $produto['name'];
        $produto['price'] = $produto['price'];
        $produto['description'] = $produto['description'];

        DB::beginTransaction();
        $objProduto = $this->produtoRepository->create($produto);

        DB::commit();
        return $objProduto;
    }

    public function update(array $produto)
    {
        DB::beginTransaction();
        $update = $this->find($produto['id']);
        $update['name'] = $produto['name'];
        $update['price'] = $produto['price'];
        $update['description'] = $produto['description'];



        DB::commit();
        return $this->produtoRepository->update($update);
    }

    public function delete($livro)
    {
        $delete = $this->find($livro['id']);

        return $this->produtoRepository->delete($delete);
    }
}
